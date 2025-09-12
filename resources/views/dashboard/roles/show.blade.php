@extends('layouts.admin')

@section('content')
<div>
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('dashboard.roles.index') }}">Roles</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ $role->name }}</li>
        </ol>
    </nav>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4>Role Details: {{ $role->name }}</h4>
                    <div>
                        <a href="{{ route('dashboard.roles.edit', $role) }}" class="btn btn-warning">
                            <i class="fas fa-edit"></i> Edit Role
                        </a>
                        <a href="{{ route('dashboard.roles.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Back to Roles
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <table class="table table-borderless">
                                <tr>
                                    <th width="30%">Name:</th>
                                    <td>{{ $role->name }}</td>
                                </tr>
                                <tr>
                                    <th>Slug:</th>
                                    <td><code>{{ $role->slug }}</code></td>
                                </tr>
                                <tr>
                                    <th>Status:</th>
                                    <td>
                                        <span class="badge bg-{{ $role->is_active ? 'success' : 'secondary' }}">
                                            {{ $role->is_active ? 'Active' : 'Inactive' }}
                                        </span>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Created:</th>
                                    <td>{{ $role->created_at->format('M d, Y H:i') }}</td>
                                </tr>
                                <tr>
                                    <th>Updated:</th>
                                    <td>{{ $role->updated_at->format('M d, Y H:i') }}</td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-6">
                            @if($role->description)
                            <h6>Description:</h6>
                            <p>{{ $role->description }}</p>
                            @endif
                        </div>
                    </div>

                    @if($role->permissions->count() > 0)
                    <hr>
                    <h5>Assigned Permissions ({{ $role->permissions->count() }})</h5>
                    <div class="row">
                        @php
                            $groupedPermissions = $role->permissions->groupBy('module');
                        @endphp

                        @foreach($groupedPermissions as $module => $modulePermissions)
                        <div class="col-md-6 col-lg-4 mb-3">
                            <div class="card">
                                <div class="card-header">
                                    <h6 class="mb-0">{{ ucfirst($module) }}</h6>
                                </div>
                                <div class="card-body">
                                    @foreach($modulePermissions as $permission)
                                    <div class="d-flex align-items-center mb-2">
                                        <i class="fas fa-check-circle text-success me-2"></i>
                                        <span>{{ $permission->name }}</span>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    @endif

                    @if($role->teams->count() > 0)
                    <hr>
                    <h5>Team Members with this Role ({{ $role->teams->count() }})</h5>
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Designation</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($role->teams as $team)
                                <tr>
                                    <td>{{ $team->name }}</td>
                                    <td>{{ $team->email }}</td>
                                    <td>{{ $team->designation }}</td>
                                    <td>
                                        <span class="badge bg-{{ $team->is_active ? 'success' : 'secondary' }}">
                                            {{ $team->is_active ? 'Active' : 'Inactive' }}
                                        </span>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
