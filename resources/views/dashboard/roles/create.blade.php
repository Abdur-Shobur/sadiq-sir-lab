@extends('layouts.admin')

@section('content')
<div>
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('dashboard.roles.index') }}">Roles</a></li>
            <li class="breadcrumb-item active" aria-current="page">Create Role</li>
        </ol>
    </nav>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Create New Role</h4>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('dashboard.roles.store') }}">
                        @csrf

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="name" class="form-label">Role Name <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror"
                                           id="name" name="name" value="{{ old('name') }}" required>
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="is_active" class="form-label">Status</label>
                                    <select class="form-select @error('is_active') is-invalid @enderror"
                                            id="is_active" name="is_active">
                                        <option value="1" {{ old('is_active', '1') == '1' ? 'selected' : '' }}>Active</option>
                                        <option value="0" {{ old('is_active') == '0' ? 'selected' : '' }}>Inactive</option>
                                    </select>
                                    @error('is_active')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control @error('description') is-invalid @enderror"
                                      id="description" name="description" rows="3">{{ old('description') }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        @if($permissions->count() > 0)
                        <div class="mb-4">
                            <label class="form-label">Permissions</label>
                            <div class="row">
                                @php
                                    $groupedPermissions = $permissions->groupBy('module');
                                @endphp

                                @foreach($groupedPermissions as $module => $modulePermissions)
                                <div class="col-md-6 col-lg-4 mb-3">
                                    <div class="card">
                                        <div class="card-header">
                                            <h6 class="mb-0">{{ ucfirst($module) }}</h6>
                                        </div>
                                        <div class="card-body">
                                            @foreach($modulePermissions as $permission)
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox"
                                                       name="permissions[]" value="{{ $permission->id }}"
                                                       id="permission_{{ $permission->id }}"
                                                       {{ in_array($permission->id, old('permissions', [])) ? 'checked' : '' }}>
                                                <label class="form-check-label" for="permission_{{ $permission->id }}">
                                                    {{ $permission->name }}
                                                </label>
                                            </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                            @error('permissions')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        @endif

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('dashboard.roles.index') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left"></i> Back to Roles
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Create Role
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
