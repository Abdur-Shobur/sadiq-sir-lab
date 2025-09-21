@extends('layouts.admin')

@section('content')
<div>
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Team Categories</li>
        </ol>
    </nav>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4>Team Categories</h4>
                    <a href="{{ route('dashboard.team-categories.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus"></i>
                        <span class="d-none d-lg-inline-block">Create New Category</span>
                    </a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Title</th>
                                    <th>Description</th>
                                    <th>Team Members</th>
                                    <th>Sort Order</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($categories as $category)
                                <tr>
                                    <td>
                                        <strong>{{ $category->title }}</strong>
                                    </td>
                                    <td>
                                        @if($category->description)
                                            {{ Str::limit($category->description, 50) }}
                                        @else
                                            <span class="text-muted">No description</span>
                                        @endif
                                    </td>
                                    <td>
                                        <span class="badge bg-info">{{ $category->teams_count }} members</span>
                                    </td>
                                    <td>{{ $category->sort_order }}</td>
                                    <td>
                                        <span class="badge bg-{{ $category->is_active ? 'success' : 'secondary' }}">
                                            {{ $category->is_active ? 'Active' : 'Inactive' }}
                                        </span>
                                    </td>
                                    <td>
                                        <div class="btn-group gap-2" role="group">
                                            <a href="{{ route('dashboard.team-categories.show', $category) }}"
                                               class="btn btn-sm btn-info" title="View Details">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{ route('dashboard.team-categories.edit', $category) }}"
                                               class="btn btn-sm btn-warning" title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form method="POST" action="{{ route('dashboard.team-categories.toggle-status', $category) }}" class="d-inline">
                                                @csrf
                                                <button type="submit" class="btn btn-sm btn-{{ $category->is_active ? 'warning' : 'success' }}"
                                                        title="{{ $category->is_active ? 'Deactivate' : 'Activate' }}">
                                                    <i class="fas fa-{{ $category->is_active ? 'pause' : 'play' }}"></i>
                                                </button>
                                            </form>
                                            <button type="button" class="btn btn-sm btn-danger delete-category"
                                                    data-id="{{ $category->id }}"
                                                    data-title="{{ $category->title }}"
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
                </div>
            </div>
        </div>
    </div>
</div>

@if($categories->isEmpty())
<div class="text-center py-5">
    <i class="fas fa-users fa-3x text-muted mb-3"></i>
    <h4 class="text-muted">No Team Categories Found</h4>
    <p class="text-muted">Get started by creating your first team category.</p>
    <a href="{{ route('dashboard.team-categories.create') }}" class="btn btn-primary">
        <i class="fas fa-plus"></i> Create First Category
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
            "order": [[3, "asc"]], // Sort by sort_order column
            "language": {
                "search": "Search categories:",
                "lengthMenu": "Show _MENU_ categories per page",
                "info": "Showing _START_ to _END_ of _TOTAL_ categories",
                "infoEmpty": "Showing 0 to 0 of 0 categories",
                "infoFiltered": "(filtered from _MAX_ total categories)"
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

    // Handle delete category buttons
    document.querySelectorAll('.delete-category').forEach(button => {
        button.addEventListener('click', function() {
            const categoryId = this.getAttribute('data-id');
            const categoryTitle = this.getAttribute('data-title');

            // Show confirmation toast
            Swal.fire({
                title: 'Delete Team Category?',
                text: `Are you sure you want to delete "${categoryTitle}"?`,
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
                    form.action = `/dashboard/team-categories/${categoryId}`;

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
