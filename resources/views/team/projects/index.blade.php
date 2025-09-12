@extends('layouts.team-dashboard')

@section('title', 'Projects')

@section('content')
<div>
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('team.dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Projects</li>
        </ol>
    </nav>

    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h4>Projects</h4>
            @if(auth()->guard('team')->user()->hasPermission('project.create'))
            <a href="{{ route('team.projects.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Create New
            </a>
            @endif
        </div>
        <div class="card-body">
            @if($projects->count())
                <div class="table-responsive">
                    <table class="table table-bordered ">
                        <thead>
                        <tr>
                            <th>Image</th>
                            <th>Title</th>
                            <th>Category</th>
                            <th>Client</th>
                            <th>Date</th>
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
                                        <img src="{{ asset('uploads/'.$project->image) }}" alt="{{ $project->title }}" class="img-thumbnail" style="width:60px;height:60px;object-fit:cover;">
                                    @else
                                       <img src="{{ asset('assets/img/placeholder.svg') }}" alt="{{ $project->title }}" class="img-thumbnail" style="width:60px;height:60px;object-fit:cover;">
                                    @endif
                                </td>
                                <td>{{ $project->title }}</td>
                                <td><span class="badge bg-primary">{{ $project->category->name ?? 'Uncategorized' }}</span></td>
                                <td>{{ $project->client ?? '-' }}</td>
                                <td>{{ optional($project->project_date)->format('M d, Y') }}</td>
                                <td>
                                    <span class="badge {{ $project->is_active ? 'bg-success' : 'bg-secondary' }}">
                                        {{ $project->is_active ? 'Active' : 'Inactive' }}
                                    </span>
                                </td>
                                <td>{{ $project->created_at->format('M d, Y') }}</td>
                                <td class="d-flex gap-2">
                                    <a href="{{ route('team.projects.show', $project) }}" class="btn btn-sm btn-info"><i class="fas fa-eye"></i></a>
                                    @if(auth()->guard('team')->user()->hasPermission('project.edit'))
                                    <a href="{{ route('team.projects.edit', $project) }}" class="btn btn-sm btn-warning"><i class="fas fa-edit"></i></a>
                                    @endif
                                    @if(auth()->guard('team')->user()->hasPermission('project.delete'))
                                    <button type="button" class="btn btn-sm btn-danger" title="Delete" onclick="confirmDelete('{{ route('team.projects.destroy', $project) }}', '{{ $project->title }}')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="d-flex justify-content-center">{{ $projects->links() }}</div>
            @else
                <div class="text-center py-4">
                    <i class="fas fa-briefcase fa-3x text-muted mb-3"></i>
                    <h5 class="text-muted">No projects found</h5>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection

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
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = url;

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
}
</script>
