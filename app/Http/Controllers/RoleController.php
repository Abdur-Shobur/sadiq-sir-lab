<?php
namespace App\Http\Controllers;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = Role::with('permissions')->orderBy('created_at', 'desc')->paginate(10);
        return view('dashboard.roles.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $permissions = Permission::where('is_active', true)->orderBy('module')->orderBy('name')->get();
        return view('dashboard.roles.create', compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'          => 'required|string|max:255|unique:roles,name',
            'slug'          => 'required|string|max:255|unique:roles,slug|regex:/^[a-z0-9\-]+$/',
            'description'   => 'nullable|string|max:500',
            'permissions'   => 'nullable|array',
            'permissions.*' => 'exists:permissions,id',
            'is_active'     => 'boolean',
        ]);

        $data = $request->only(['name', 'slug', 'description', 'is_active']);

        $role = Role::create($data);

        // Attach permissions if provided
        if ($request->has('permissions')) {
            $role->permissions()->attach($request->permissions);
        }

        return redirect()->route('dashboard.roles.index')
            ->with('success', 'Role created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Role $role)
    {
        $role->load('permissions', 'teams');
        return view('dashboard.roles.show', compact('role'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Role $role)
    {
        $permissions = Permission::where('is_active', true)->orderBy('module')->orderBy('name')->get();
        $role->load('permissions');
        return view('dashboard.roles.edit', compact('role', 'permissions'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Role $role)
    {
        $request->validate([
            'name'          => 'required|string|max:255|unique:roles,name,' . $role->id,
            'slug'          => 'required|string|max:255|unique:roles,slug,' . $role->id . '|regex:/^[a-z0-9\-]+$/',
            'description'   => 'nullable|string|max:500',
            'permissions'   => 'nullable|array',
            'permissions.*' => 'exists:permissions,id',
            'is_active'     => 'boolean',
        ]);

        $data = $request->only(['name', 'slug', 'description', 'is_active']);

        $role->update($data);

        // Sync permissions
        if ($request->has('permissions')) {
            $role->permissions()->sync($request->permissions);
        } else {
            $role->permissions()->detach();
        }

        return redirect()->route('dashboard.roles.index')
            ->with('success', 'Role updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role)
    {
        // Check if role is assigned to any teams
        if ($role->teams()->count() > 0) {
            return redirect()->route('dashboard.roles.index')
                ->with('error', 'Cannot delete role. It is assigned to one or more team members.');
        }

        $role->delete();

        return redirect()->route('dashboard.roles.index')
            ->with('success', 'Role deleted successfully.');
    }

    /**
     * Toggle role status (active/inactive)
     */
    public function toggleStatus(Role $role)
    {
        $role->update([
            'is_active' => ! $role->is_active,
        ]);

        $status = $role->is_active ? 'activated' : 'deactivated';

        return redirect()->route('dashboard.roles.index')
            ->with('success', "Role {$status} successfully.");
    }
}
