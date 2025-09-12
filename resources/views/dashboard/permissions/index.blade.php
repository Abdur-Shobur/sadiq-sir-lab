@extends('layouts.admin')

@section('content')
<div>
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Permissions</li>
        </ol>
    </nav>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4>Permissions Management</h4>
                    <!-- <a href="{{ route('dashboard.permissions.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus"></i>
                        <span class="d-none d-lg-inline-block">Create New Permission</span>
                    </a> -->
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Slug</th>
                                    <th>Module</th>
                                    <th>Description</th>
                                    <th>Roles</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($permissions as $permission)
                                <tr>
                                    <td>
                                        <strong>{{ $permission->name }}</strong>
                                    </td>
                                    <td>
                                        <code>{{ $permission->slug }}</code>
                                    </td>
                                    <td>
                                        <span class="badge bg-info">{{ ucfirst($permission->module) }}</span>
                                    </td>
                                    <td>{{ $permission->description ?? 'N/A' }}</td>
                                    <td>
                                        <span class="badge bg-secondary">{{ $permission->roles->count() }} roles</span>
                                    </td>
                                    <td>
                                        <span class="badge bg-{{ $permission->is_active ? 'success' : 'secondary' }}">
                                            {{ $permission->is_active ? 'Active' : 'Inactive' }}
                                        </span>
                                    </td>
                                    <td>
                                        <div class="btn-group gap-2" role="group">

                                            <button type="button" class="btn btn-sm btn-danger delete-permission"
                                                    data-id="{{ $permission->id }}"
                                                    data-name="{{ $permission->name }}"
                                                    title="Delete">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    @if($permissions->hasPages())
                        <div class="d-flex justify-content-center mt-4">
                            {{ $permissions->links('pagination.bootstrap-4-custom') }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

@if($permissions->isEmpty())
<div class="text-center py-5">
    <i class="fas fa-key fa-3x text-muted mb-3"></i>
    <h4 class="text-muted">No Permissions Found</h4>
    <p class="text-muted">Get started by creating your first permission.</p>
    <a href="{{ route('dashboard.permissions.create') }}" class="btn btn-primary">
        <i class="fas fa-plus"></i> Create First Permission
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
            "pageLength": 15,
            "order": [[2, "asc"], [0, "asc"]], // Sort by module then name
            "language": {
                "search": "Search permissions:",
                "lengthMenu": "Show _MENU_ permissions per page",
                "info": "Showing _START_ to _END_ of _TOTAL_ permissions",
                "infoEmpty": "Showing 0 to 0 of 0 permissions",
                "infoFiltered": "(filtered from _MAX_ total permissions)"
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

    // Handle delete permission buttons
    document.querySelectorAll('.delete-permission').forEach(button => {
        button.addEventListener('click', function() {
            const permissionId = this.getAttribute('data-id');
            const permissionName = this.getAttribute('data-name');

            // Show confirmation toast
            Swal.fire({
                title: 'Delete Permission?',
                text: `Are you sure you want to delete "${permissionName}"?`,
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
                    form.action = `/dashboard/permissions/${permissionId}`;

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
