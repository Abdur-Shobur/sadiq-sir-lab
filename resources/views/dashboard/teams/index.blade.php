@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0 text-gray-800">Team Management</h1>
        <a href="{{ route('dashboard.teams.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Add Team Member
        </a>
    </div>



    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">All Team Members</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Image</th>
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
                            <td>
                                <img src="{{ $team->image_url }}" alt="{{ $team->name }}"
                                     class="rounded-circle" width="50" height="50" style="object-fit: cover;">
                            </td>
                            <td>{{ $team->name }}</td>
                            <td>{{ $team->email }}</td>
                            <td>{{ $team->designation }}</td>
                            <td>
                                <span class="badge badge-{{ $team->role === 'admin' ? 'danger' : 'info' }}">
                                    {{ ucfirst($team->role) }}
                                </span>
                            </td>
                            <td>
                                <span class="badge badge-{{ $team->is_active ? 'success' : 'secondary' }}">
                                    {{ $team->is_active ? 'Active' : 'Inactive' }}
                                </span>
                            </td>
                            <td>
                                <div class="btn-group" role="group">
                                    <a href="{{ route('dashboard.teams.show', $team) }}"
                                       class="btn btn-sm btn-info" title="View Details">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('dashboard.teams.edit', $team) }}"
                                       class="btn btn-sm btn-warning" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('dashboard.teams.destroy', $team) }}"
                                          method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger"
                                                onclick="return confirm('Are you sure you want to delete this team member?')"
                                                title="Delete">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
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
$(document).ready(function() {
    // Initialize DataTable if you're using it
    if ($.fn.DataTable) {
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
        $('.alert-success').fadeOut('slow');
    }, 5000);
});
</script>
@endpush
