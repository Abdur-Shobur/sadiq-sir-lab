<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $permissions = Permission::orderBy('module')->orderBy('name')->paginate(15);
        return view('dashboard.permissions.index', compact('permissions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.permissions.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:permissions,name',
            'module' => 'required|string|max:100',
            'description' => 'nullable|string|max:500',
            'is_active' => 'boolean',
        ]);

        $data = $request->only(['name', 'module', 'description', 'is_active']);
        $data['slug'] = Str::slug($request->name);

        Permission::create($data);

        return redirect()->route('dashboard.permissions.index')
            ->with('success', 'Permission created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Permission $permission)
    {
        $permission->load('roles');
        return view('dashboard.permissions.show', compact('permission'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Permission $permission)
    {
        return view('dashboard.permissions.edit', compact('permission'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Permission $permission)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:permissions,name,' . $permission->id,
            'module' => 'required|string|max:100',
            'description' => 'nullable|string|max:500',
            'is_active' => 'boolean',
        ]);

        $data = $request->only(['name', 'module', 'description', 'is_active']);
        $data['slug'] = Str::slug($request->name);

        $permission->update($data);

        return redirect()->route('dashboard.permissions.index')
            ->with('success', 'Permission updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Permission $permission)
    {
        // Check if permission is assigned to any roles
        if ($permission->roles()->count() > 0) {
            return redirect()->route('dashboard.permissions.index')
                ->with('error', 'Cannot delete permission. It is assigned to one or more roles.');
        }

        $permission->delete();

        return redirect()->route('dashboard.permissions.index')
            ->with('success', 'Permission deleted successfully.');
    }

    /**
     * Toggle permission status (active/inactive)
     */
    public function toggleStatus(Permission $permission)
    {
        $permission->update([
            'is_active' => !$permission->is_active,
        ]);

        $status = $permission->is_active ? 'activated' : 'deactivated';

        return redirect()->route('dashboard.permissions.index')
            ->with('success', "Permission {$status} successfully.");
    }
}
