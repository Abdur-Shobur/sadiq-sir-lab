@extends('layouts.admin')

@section('title', 'Projects Management')

@section('content')
<div class="container-fluid mt-4">
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Projects</li>
        </ol>
    </nav>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4>Projects Management</h4>
                    <a href="{{ route('dashboard.projects.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus"></i> Add New Project
                    </a>
                </div>
                <div class="card-body">
                    @if($projects->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Image</th>
                                        <th>Title</th>
                                        <th>Subtitle</th>
                                        <th>Category</th>
                                        <th>Status</th>
                                        <th>Created</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($projects as $project)
                                    <tr>
                                        <td>
                                            @if($project->image)
                                                <img src="{{ Storage::url($project->image) }}"
                                                     alt="{{ $project->title }}"
                                                     style="width: 50px; height: 50px; object-fit: cover; border-radius: 5px;">
                                            @else
                                                <img src="{{ asset('assets/img/placeholder.svg') }}" alt="{{ $project->title }}"
                                                     style="width: 50px; height: 50px; object-fit: cover; border-radius: 5px;">
                                            @endif
                                        </td>
                                        <td>
                                            <strong>{{ $project->title }}</strong>
                                        </td>
                                        <td>{{ $project->subtitle ?? 'N/A' }}</td>
                                        <td>
                                            <span class="badge bg-info">{{ $project->category->name }}</span>
                                        </td>
                                        <td>
                                            @if($project->is_active)
                                                <span class="badge bg-success">Active</span>
                                            @else
                                                <span class="badge bg-secondary">Inactive</span>
                                            @endif
                                        </td>
                                        <td>{{ $project->created_at->format('M d, Y') }}</td>
                                        <td>
                                            <div class="btn-group gap-2" role="group">
                                                <a href="{{ route('dashboard.projects.show', $project) }}"
                                                   class="btn btn-sm btn-info" title="View">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                <a href="{{ route('dashboard.projects.edit', $project) }}"
                                                   class="btn btn-sm btn-warning" title="Edit">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <button type="button" class="btn btn-sm btn-danger" title="Delete"
                                                        onclick="confirmDelete('{{ route('dashboard.projects.destroy', $project) }}', '{{ $project->title }}')">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="text-center py-4">
                            <i class="fas fa-project-diagram fa-3x text-muted mb-3"></i>
                            <h5 class="text-muted">No projects found</h5>
                            <p class="text-muted">Start by adding your first project.</p>
                            <a href="{{ route('dashboard.projects.create') }}" class="btn btn-primary">
                                <i class="fas fa-plus"></i> Add Project
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Delete Confirmation Script -->
<script>
    function confirmDelete(url, title) {
        Swal.fire({
            title: 'Are you sure?',
            text: `Do you want to delete the project "${title}"?`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'Cancel'
        }).then((result) => {
            if (result.isConfirmed) {
                // Create a form and submit it
                const form = document.createElement('form');
                form.method = 'POST';
                form.action = url;
                form.innerHTML = `
                    @csrf
                    @method('DELETE')
                `;
                document.body.appendChild(form);
                form.submit();
            }
        });
    }
</script>
@endsection
