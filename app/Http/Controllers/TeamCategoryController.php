<?php
namespace App\Http\Controllers;

use App\Models\Team;
use App\Models\TeamCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TeamCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = TeamCategory::withCount('teams')->ordered()->get();
        return view('dashboard.team-categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $availableTeams = Team::whereNull('category_id')->orWhere('category_id', '')->get();
        return view('dashboard.team-categories.create', compact('availableTeams'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title'          => 'required|string|max:255',
            'description'    => 'nullable|string',
            'sort_order'     => 'nullable|integer|min:0',
            'team_members'   => 'nullable|array',
            'team_members.*' => 'exists:teams,id',
            'sort_orders'    => 'nullable|array',
            'sort_orders.*'  => 'nullable|integer|min:1',
        ]);

        $category = TeamCategory::create([
            'title'       => $request->title,
            'description' => $request->description,
            'sort_order'  => $request->sort_order ?? 0,
            'is_active'   => $request->has('is_active'),
        ]);

        // Assign team members to category if provided
        if ($request->has('team_members') && is_array($request->team_members)) {
            foreach ($request->team_members as $index => $teamId) {
                $sortOrder = $request->sort_orders[$teamId] ?? ($index + 1);
                Team::where('id', $teamId)->update([
                    'category_id' => $category->id,
                    'sort_order'  => $sortOrder,
                ]);
            }
        }

        return redirect()->route('dashboard.team-categories.index')
            ->with('success', 'Team category created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(TeamCategory $teamCategory)
    {
        $teamCategory->load(['teams' => function ($query) {
            $query->ordered();
        }]);

        return view('dashboard.team-categories.show', compact('teamCategory'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TeamCategory $teamCategory)
    {
        $availableTeams = Team::where(function ($query) use ($teamCategory) {
            $query->whereNull('category_id')
                ->orWhere('category_id', '')
                ->orWhere('category_id', $teamCategory->id);
        })->get();

        return view('dashboard.team-categories.edit', compact('teamCategory', 'availableTeams'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, TeamCategory $teamCategory)
    {
        $request->validate([
            'title'          => 'required|string|max:255',
            'description'    => 'nullable|string',
            'sort_order'     => 'nullable|integer|min:0',
            'team_members'   => 'nullable|array',
            'team_members.*' => 'exists:teams,id',
            'sort_orders'    => 'nullable|array',
            'sort_orders.*'  => 'nullable|integer|min:1',
        ]);

        $teamCategory->update([
            'title'       => $request->title,
            'description' => $request->description,
            'sort_order'  => $request->sort_order ?? 0,
            'is_active'   => $request->has('is_active'),
        ]);

        // Update team member assignments if provided
        if ($request->has('team_members') && is_array($request->team_members)) {
            // First, remove all current team members from this category
            Team::where('category_id', $teamCategory->id)->update(['category_id' => null]);

            // Then assign new team members
            foreach ($request->team_members as $index => $teamId) {
                $sortOrder = $request->sort_orders[$teamId] ?? ($index + 1);
                Team::where('id', $teamId)->update([
                    'category_id' => $teamCategory->id,
                    'sort_order'  => $sortOrder,
                ]);
            }
        }

        return redirect()->route('dashboard.team-categories.index')
            ->with('success', 'Team category updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TeamCategory $teamCategory)
    {
        // Check if category has teams
        if ($teamCategory->teams()->count() > 0) {
            return redirect()->route('dashboard.team-categories.index')
                ->with('error', 'Cannot delete category that has team members. Please move or delete team members first.');
        }

        $teamCategory->delete();

        return redirect()->route('dashboard.team-categories.index')
            ->with('success', 'Team category deleted successfully.');
    }

    /**
     * Update team member order within a category
     */
    public function updateTeamOrder(Request $request, TeamCategory $teamCategory)
    {
        $request->validate([
            'team_orders'   => 'required|array',
            'team_orders.*' => 'integer|exists:teams,id',
        ]);

        DB::transaction(function () use ($request, $teamCategory) {
            foreach ($request->team_orders as $index => $teamId) {
                Team::where('id', $teamId)
                    ->where('category_id', $teamCategory->id)
                    ->update(['sort_order' => $index + 1]);
            }
        });

        return response()->json(['success' => true]);
    }

    /**
     * Toggle category status
     */
    public function toggleStatus(TeamCategory $teamCategory)
    {
        $teamCategory->update(['is_active' => ! $teamCategory->is_active]);

        $status = $teamCategory->is_active ? 'activated' : 'deactivated';

        return redirect()->route('dashboard.team-categories.index')
            ->with('success', "Team category {$status} successfully.");
    }

    /**
     * Add team members to category
     */
    public function addTeamMembers(Request $request, TeamCategory $teamCategory)
    {
        $request->validate([
            'team_members'   => 'required|array',
            'team_members.*' => 'exists:teams,id',
        ]);

        $maxOrder = Team::where('category_id', $teamCategory->id)->max('sort_order') ?? 0;

        foreach ($request->team_members as $index => $teamId) {
            Team::where('id', $teamId)->update([
                'category_id' => $teamCategory->id,
                'sort_order'  => $maxOrder + $index + 1,
            ]);
        }

        return redirect()->route('dashboard.team-categories.show', $teamCategory)
            ->with('success', 'Team members added to category successfully.');
    }

    /**
     * Remove team member from category
     */
    public function removeTeamMember(Request $request, TeamCategory $teamCategory, Team $team)
    {
        if ($team->category_id == $teamCategory->id) {
            $team->update(['category_id' => null, 'sort_order' => 0]);

            return redirect()->route('dashboard.team-categories.show', $teamCategory)
                ->with('success', 'Team member removed from category successfully.');
        }

        return redirect()->route('dashboard.team-categories.show', $teamCategory)
            ->with('error', 'Team member not found in this category.');
    }

    /**
     * Get available team members for category
     */
    public function getAvailableTeams(TeamCategory $teamCategory)
    {
        $availableTeams = Team::where(function ($query) use ($teamCategory) {
            $query->whereNull('category_id')
                ->orWhere('category_id', '')
                ->orWhere('category_id', $teamCategory->id);
        })->get();

        return response()->json($availableTeams);
    }
}
