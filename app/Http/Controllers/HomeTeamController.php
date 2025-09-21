<?php
namespace App\Http\Controllers;

use App\Models\HomeTeam;
use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeTeamController extends Controller
{
    /**
     * Display a listing of home teams
     */
    public function index()
    {
        $homeTeams = HomeTeam::with('team')
            ->ordered()
            ->get();

        return view('dashboard.home-teams.index', compact('homeTeams'));
    }

    /**
     * Show the form for managing home teams
     */
    public function manage()
    {
        $homeTeams = HomeTeam::with('team')
            ->ordered()
            ->get();

        $availableTeams = Team::whereDoesntHave('homeTeam')
            ->orderBy('name')
            ->get();

        return view('dashboard.home-teams.manage', compact('homeTeams', 'availableTeams'));
    }

    /**
     * Add teams to home page
     */
    public function addTeams(Request $request)
    {
        $request->validate([
            'team_ids'   => 'required|array|min:1',
            'team_ids.*' => 'exists:teams,id',
        ]);

        $maxOrder = HomeTeam::max('sort_order') ?? 0;

        foreach ($request->team_ids as $index => $teamId) {
            HomeTeam::create([
                'team_id'    => $teamId,
                'sort_order' => $maxOrder + $index + 1,
                'is_active'  => true,
            ]);
        }

        return redirect()->route('dashboard.home-teams.manage')
            ->with('success', 'Teams added to home page successfully!');
    }

    /**
     * Remove team from home page
     */
    public function removeTeam(HomeTeam $homeTeam)
    {
        $homeTeam->delete();

        return redirect()->route('dashboard.home-teams.manage')
            ->with('success', 'Team removed from home page successfully!');
    }

    /**
     * Update team order
     */
    public function updateOrder(Request $request)
    {
        $request->validate([
            'team_orders'   => 'required|array',
            'team_orders.*' => 'integer|exists:home_teams,id',
        ]);

        DB::transaction(function () use ($request) {
            foreach ($request->team_orders as $index => $homeTeamId) {
                HomeTeam::where('id', $homeTeamId)
                    ->update(['sort_order' => $index + 1]);
            }
        });

        return response()->json([
            'success' => true,
            'message' => 'Team order updated successfully!',
        ]);
    }

    /**
     * Toggle team active status
     */
    public function toggleStatus(HomeTeam $homeTeam)
    {
        $homeTeam->update([
            'is_active' => ! $homeTeam->is_active,
        ]);

        $status = $homeTeam->is_active ? 'activated' : 'deactivated';

        return redirect()->route('dashboard.home-teams.manage')
            ->with('success', "Team {$status} successfully!");
    }

    /**
     * Get available teams for AJAX
     */
    public function getAvailableTeams()
    {
        $teams = Team::whereDoesntHave('homeTeam')
            ->select('id', 'name', 'designation', 'image')
            ->orderBy('name')
            ->get();

        return response()->json($teams);
    }
}
