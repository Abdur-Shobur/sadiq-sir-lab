@extends('layouts.admin')

@section('content')
<div>
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Roles</li>
        </ol>
    </nav>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4>Roles Management</h4>
                    <!-- <a href="{{ route('dashboard.roles.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus"></i>
                        <span class="d-none d-lg-inline-block">Create New Role</span>
                    </a> -->
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Slug</th>
                                    <th>Description</th>
                                    <th>Permissions</th>
                                    <th>Team Members</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($roles as $role)
                                <tr>
                                    <td>
                                        <strong>{{ $role->name }}</strong>
                                    </td>
                                    <td>
                                        <code>{{ $role->slug }}</code>
                                    </td>
                                    <td>{{ $role->description ?? 'No description' }}</td>
                                    <td>
                                        <span class="badge bg-info">{{ $role->permissions->count() }} permissions</span>
                                    </td>
                                    <td>
                                        <span class="badge bg-secondary">{{ $role->teams->count() }} members</span>
                                    </td>
                                    <td>
                                        <span class="badge bg-{{ $role->is_active ? 'success' : 'secondary' }}">
                                            {{ $role->is_active ? 'Active' : 'Inactive' }}
                                        </span>
                                    </td>
                                    <td>
                                        <div class="btn-group gap-2" role="group">
                                            <a href="{{ route('dashboard.roles.show', $role) }}"
                                               class="btn btn-sm btn-info" title="View Details">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{ route('dashboard.roles.edit', $role) }}"
                                               class="btn btn-sm btn-warning" title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <!-- <button type="button" class="btn btn-sm btn-danger delete-role"
                                                    data-id="{{ $role->id }}"
                                                    data-name="{{ $role->name }}"
                                                    title="Delete">
                                                <i class="fas fa-trash"></i>
                                            </button> -->
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    @if($roles->hasPages())
                        <div class="d-flex justify-content-center mt-4">
                            {{ $roles->links('pagination.bootstrap-4-custom') }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

@if($roles->isEmpty())
<div class="text-center py-5">
    <i class="fas fa-shield-alt fa-3x text-muted mb-3"></i>
    <h4 class="text-muted">No Roles Found</h4>
    <p class="text-muted">Get started by creating your first role.</p>
    <a href="{{ route('dashboard.roles.create') }}" class="btn btn-primary">
        <i class="fas fa-plus"></i> Create First Role
    </a>
</div>
@endif

@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Initialize DataTable if you're using it
    if (typeof $ !== 'undefined' && $.fn.DataTable) {
        $('#dataTable').DataTable({
            "pageLength": 10,
            "order": [[0, "asc"]], // Sort by name column
            "language": {
                "search": "Search roles:",
                "lengthMenu": "Show _MENU_ roles per page",
                "info": "Showing _START_ to _END_ of _TOTAL_ roles",
                "infoEmpty": "Showing 0 to 0 of 0 roles",
                "infoFiltered": "(filtered from _MAX_ total roles)"
            }
        });
    }

    // Auto-hide success messages after 5 seconds
    setTimeout(function() {
        const alerts = document.querySelectorAll('.alert-success');
        alerts.forEach(alert => {
            alert.style.transition = 'opacity 0.5s';
            alert.style.opacity = '0';
            setTimeout(() => alert.remove(), 500);
        });
    }, 5000);

    // Handle delete role buttons
    document.querySelectorAll('.delete-role').forEach(button => {
        button.addEventListener('click', function() {
            const roleId = this.getAttribute('data-id');
            const roleName = this.getAttribute('data-name');

            // Show confirmation toast
            Swal.fire({
                title: 'Delete Role?',
                text: `Are you sure you want to delete "${roleName}"?`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Create form and submit
                    const form = document.createElement('form');
                    form.method = 'POST';
                    form.action = `/dashboard/roles/${roleId}`;

                    const csrfToken = document.createElement('input');
                    csrfToken.type = 'hidden';
                    csrfToken.name = '_token';
                    csrfToken.value = '{{ csrf_token() }}';

                    const methodField = document.createElement('input');
                    methodField.type = 'hidden';
                    methodField.name = '_method';
                    methodField.value = 'DELETE';

                    form.appendChild(csrfToken);
                    form.appendChild(methodField);
                    document.body.appendChild(form);
                    form.submit();
                }
            });
        });
    });
});
</script>
@endpush
