@extends('layouts.admin')

@section('content')
<div  >
     <!-- Breadcrumb -->
     <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Teams</li>
        </ol>
    </nav>


    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4>Teams</h4>
                    <a href="{{ route('dashboard.teams.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus"></i>
                        <span class="d-none d-lg-inline-block">Create New</span>
                    </a>
                </div>
                <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th class="text-center">Image</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Designation</th>
                            <th>Role</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($teams as $team)
                        <tr>
                            <td class="text-center">
                                @if($team->image)
                                <img src="{{ $team->image_url }}" alt="{{ $team->name }}"
                                     class="rounded-circle" width="50" height="50" style="object-fit: cover;">
                                @else
                                    <img src="{{ asset('assets/img/placeholder.svg') }}" alt="{{ $team->name }}"
                                         class="rounded-circle" width="50" height="50" style="object-fit: cover;">
                                @endif
                            </td>
                            <td>{{ $team->name }}</td>
                            <td>{{ $team->email }}</td>
                            <td>{{ $team->designation }}</td>
                            <td>
                                <span class="badge bg-{{ $team->role === 'admin' ? 'success' : 'info' }}">
                                    {{ ucfirst($team->role) }}
                                </span>
                            </td>
                            <td>
                                <span class="badge bg-{{ $team->is_active ? 'success' : 'secondary' }}">
                                    {{ $team->is_active ? 'Active' : 'Inactive' }}
                                </span>


                            </td>
                            <td>
                                <div class="btn-group gap-2" role="group">
                                    <a href="{{ route('dashboard.teams.show', $team) }}"
                                       class="btn btn-sm btn-info" title="View Details">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('dashboard.teams.edit', $team) }}"
                                       class="btn btn-sm
                                        btn-warning" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <button type="button" class="btn btn-sm btn-danger delete-team"
                                            data-id="{{ $team->id }}"
                                            data-name="{{ $team->name }}"
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

            @if($teams->hasPages())
                <div class="d-flex justify-content-center mt-4">
                    {{ $teams->links() }}
                </div>
            @endif
        </div>
                </div>
            </div>
        </div>
    </div>




</div>

@if($teams->isEmpty())
<div class="text-center py-5">
    <i class="fas fa-users fa-3x text-muted mb-3"></i>
    <h4 class="text-muted">No Team Members Found</h4>
    <p class="text-muted">Get started by adding your first team member.</p>
    <a href="{{ route('dashboard.teams.create') }}" class="btn btn-primary">
        <i class="fas fa-plus"></i> Add First Team Member
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
            "order": [[1, "asc"]], // Sort by name column
            "language": {
                "search": "Search team members:",
                "lengthMenu": "Show _MENU_ team members per page",
                "info": "Showing _START_ to _END_ of _TOTAL_ team members",
                "infoEmpty": "Showing 0 to 0 of 0 team members",
                "infoFiltered": "(filtered from _MAX_ total team members)"
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

    // Handle delete team buttons
    document.querySelectorAll('.delete-team').forEach(button => {
        button.addEventListener('click', function() {
            const teamId = this.getAttribute('data-id');
            const teamName = this.getAttribute('data-name');

            // Show confirmation toast
            Swal.fire({
                title: 'Delete Team Member?',
                text: `Are you sure you want to delete "${teamName}"?`,
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
                    form.action = `/dashboard/teams/${teamId}`;

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
