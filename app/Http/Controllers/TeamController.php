<?php
namespace App\Http\Controllers;

use App\Models\Team;
use App\Models\TeamCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class TeamController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $teams = Team::with('category')->orderBy('created_at', 'desc')->paginate(10);
        return view('dashboard.teams.index', compact('teams'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = TeamCategory::active()->ordered()->get();
        return view('dashboard.teams.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'                    => 'required|string|max:255',
            'image'                   => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'designation'             => 'required|string|max:255',
            'specialities'            => 'nullable|array',
            'specialities.*'          => 'nullable|string|max:255',
            'education'               => 'nullable|array',
            'education.*'             => 'nullable|string|max:500',
            'experience'              => 'nullable|array',
            'experience.*'            => 'nullable|string|max:500',
            'address'                 => 'nullable|string|max:500',
            'phone'                   => 'nullable|string|max:20',
            'email'                   => 'required|email|unique:teams,email',
            'website'                 => 'nullable|url|max:255',
            'social_media'            => 'nullable|array',
            'social_media.*.platform' => 'nullable|string|max:50',
            'social_media.*.url'      => 'nullable|url|max:255',
            'password'                => 'required|string|min:8|confirmed',
            'roles'                   => 'required|array',
            'roles.*'                 => 'exists:roles,id',
            'category_id'             => 'nullable|exists:team_categories,id',
            'sort_order'              => 'nullable|integer|min:0',
        ]);

        $data = $request->except(['roles']);

        // Clean up empty array values
        $data['specialities'] = $this->cleanArrayData($request->specialities);
        $data['education']    = $this->cleanArrayData($request->education);
        $data['experience']   = $this->cleanArrayData($request->experience);
        $data['social_media'] = $this->cleanSocialMediaData($request->social_media);

        // Handle image upload
        if ($request->hasFile('image')) {
            $imagePath     = $request->file('image')->store('teams', 'public');
            $data['image'] = $imagePath;
        }

        // Hash password
        $data['password'] = Hash::make($request->password);

        $team = Team::create($data);

        // Assign roles
        if ($request->has('roles')) {
            $team->roles()->attach($request->roles);
        }

        return redirect()->route('dashboard.teams.index')
            ->with('success', 'Team member created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Team $team)
    {
        return view('dashboard.teams.show', compact('team'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Team $team)
    {
        $categories = TeamCategory::active()->ordered()->get();
        return view('dashboard.teams.edit', compact('team', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Team $team)
    {
        $request->validate([
            'name'                    => 'required|string|max:255',
            'image'                   => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'designation'             => 'required|string|max:255',
            'specialities'            => 'nullable|array',
            'specialities.*'          => 'nullable|string|max:255',
            'education'               => 'nullable|array',
            'education.*'             => 'nullable|string|max:500',
            'experience'              => 'nullable|array',
            'experience.*'            => 'nullable|string|max:500',
            'address'                 => 'nullable|string|max:500',
            'phone'                   => 'nullable|string|max:20',
            'email'                   => ['required', 'email', Rule::unique('teams')->ignore($team->id)],
            'website'                 => 'nullable|url|max:255',
            'social_media'            => 'nullable|array',
            'social_media.*.platform' => 'nullable|string|max:50',
            'social_media.*.url'      => 'nullable|url|max:255',
            'password'                => 'nullable|string|min:8|confirmed',
            'roles'                   => 'required|array',
            'roles.*'                 => 'exists:roles,id',
            'category_id'             => 'nullable|exists:team_categories,id',
            'sort_order'              => 'nullable|integer|min:0',
        ]);

        $data = $request->except(['password', 'password_confirmation', 'roles']);

        // Clean up empty array values
        $data['specialities'] = $this->cleanArrayData($request->specialities);
        $data['education']    = $this->cleanArrayData($request->education);
        $data['experience']   = $this->cleanArrayData($request->experience);
        $data['social_media'] = $this->cleanSocialMediaData($request->social_media);

        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete old image
            if ($team->image) {
                Storage::disk('public')->delete($team->image);
            }
            $imagePath     = $request->file('image')->store('teams', 'public');
            $data['image'] = $imagePath;
        }

        // Update password if provided
        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $team->update($data);

        // Sync roles
        if ($request->has('roles')) {
            $team->roles()->sync($request->roles);
        } else {
            $team->roles()->detach();
        }

        return redirect()->route('dashboard.teams.index')
            ->with('success', 'Team member updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Team $team)
    {
        // Delete image if exists
        if ($team->image) {
            Storage::disk('public')->delete($team->image);
        }

        $team->delete();

        return redirect()->route('dashboard.teams.index')
            ->with('success', 'Team member deleted successfully.');
    }

    /**
     * Toggle team member status (active/inactive)
     */
    public function toggleStatus(Team $team)
    {
        $team->update([
            'is_active' => ! $team->is_active,
        ]);

        $status = $team->is_active ? 'activated' : 'deactivated';

        return redirect()->route('dashboard.teams.index')
            ->with('success', "Team member {$status} successfully.");
    }

    /**
     * Bulk delete team members
     */
    public function bulkDelete(Request $request)
    {
        $request->validate([
            'team_ids'   => 'required|array',
            'team_ids.*' => 'exists:teams,id',
        ]);

        $teams = Team::whereIn('id', $request->team_ids)->get();

        foreach ($teams as $team) {
            // Delete image if exists
            if ($team->image) {
                Storage::disk('public')->delete($team->image);
            }
            $team->delete();
        }

        return redirect()->route('dashboard.teams.index')
            ->with('success', count($teams) . ' team member(s) deleted successfully.');
    }

    /**
     * Export team members to CSV
     */
    public function export()
    {
        $teams = Team::all();

        $filename = 'team_members_' . date('Y-m-d_H-i-s') . '.csv';

        $headers = [
            'Content-Type'        => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ];

        $callback = function () use ($teams) {
            $file = fopen('php://output', 'w');

            // Add CSV headers
            fputcsv($file, [
                'ID', 'Name', 'Email', 'Designation', 'Phone', 'Website',
                'Address', 'Role', 'Status', 'Specialities', 'Education',
                'Experience', 'Social Media', 'Created At',
            ]);

            // Add data rows
            foreach ($teams as $team) {
                fputcsv($file, [
                    $team->id,
                    $team->name,
                    $team->email,
                    $team->designation,
                    $team->phone,
                    $team->website,
                    $team->address,
                    $team->role,
                    $team->is_active ? 'Active' : 'Inactive',
                    $team->specialities ? implode('; ', $team->specialities) : '',
                    $team->education ? implode('; ', $team->education) : '',
                    $team->experience ? implode('; ', $team->experience) : '',
                    $team->social_media ? json_encode($team->social_media) : '',
                    $team->created_at->format('Y-m-d H:i:s'),
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    /**
     * Clean array data by removing empty values
     */
    private function cleanArrayData($array)
    {
        if (! is_array($array)) {
            return null;
        }

        $cleaned = array_filter($array, function ($value) {
            return ! empty(trim($value));
        });

        return empty($cleaned) ? null : array_values($cleaned);
    }

    /**
     * Clean social media data by removing empty entries
     */
    private function cleanSocialMediaData($array)
    {
        if (! is_array($array)) {
            return null;
        }

        $cleaned = array_filter($array, function ($item) {
            return ! empty(trim($item['platform'] ?? '')) && ! empty(trim($item['url'] ?? ''));
        });

        return empty($cleaned) ? null : array_values($cleaned);
    }
}
