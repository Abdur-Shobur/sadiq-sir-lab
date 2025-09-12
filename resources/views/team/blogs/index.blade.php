@extends('layouts.team-dashboard')

@section('title', 'Blog Posts')

@section('content')
<div>
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('team.dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Blog Posts</li>
        </ol>
    </nav>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">Blog Posts</h4>
                    @if(auth()->guard('team')->user()->hasPermission('blog.create'))
                    <a href="{{ route('team.blogs.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus"></i>
                        <span class="d-none d-lg-inline-block">Create New</span>
                    </a>
                    @endif
                </div>
                <div class="card-body">
                    @if($blogs->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Image</th>
                                        <th>Title</th>
                                        <th>Category</th>
                                        <th>Status</th>
                                        <th>Created At</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($blogs as $blog)
                                        <tr>
                                            <td>{{ $blog->id }}</td>
                                            <td>
                                                @if($blog->image)
                                                <img src="{{ $blog->image_url }}" alt="{{ $blog->title }}"
                                                     class="img-thumbnail" style="width: 50px; height: 50px; object-fit: cover;">
                                                @else
                                                <img src="{{ asset('assets/img/placeholder.svg') }}" alt="{{ $blog->title }}"
                                                     class="img-thumbnail" style="width: 50px; height: 50px; object-fit: cover;">
                                                @endif
                                            </td>
                                            <td>
                                                <strong>{{ $blog->title }}</strong>
                                                @if(!empty($blog->subtitle))
                                                    <br><small class="text-muted">{{ $blog->subtitle }}</small>
                                                @endif
                                            </td>
                                            <td>
                                                @if($blog->category)
                                                    <span class="badge bg-info">{{ $blog->category->name }}</span>
                                                @else
                                                    <span class="text-muted">No Category</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if($blog->status)
                                                    <span class="badge bg-success">Active</span>
                                                @else
                                                    <span class="badge bg-danger">Inactive</span>
                                                @endif
                                            </td>
                                            <td>{{ $blog->created_at->format('M d, Y H:i') }}</td>
                                            <td>
                                                <a href="{{ route('team.blogs.show', $blog) }}" class="btn btn-sm btn-info" title="View">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                @if(auth()->guard('team')->user()->hasPermission('blog.edit'))
                                                <a href="{{ route('team.blogs.edit', $blog) }}" class="btn btn-sm btn-warning" title="Edit">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                @endif
                                                @if(auth()->guard('team')->user()->hasPermission('blog.delete'))
                                                <button type="button"
                                                        class="btn btn-sm btn-danger delete-blog"
                                                        title="Delete"
                                                        data-url="{{ route('team.blogs.destroy', $blog) }}"
                                                        data-title="{{ $blog->title }}">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <!-- Pagination -->
                        <div class="d-flex justify-content-center">
                            {{ $blogs->links() }}
                        </div>
                    @else
                        <div class="text-center py-4">
                            <i class="fas fa-blog fa-3x text-muted mb-3"></i>
                            <h5 class="text-muted">No blog posts found.</h5>
                            @if(auth()->guard('team')->user()->hasPermission('blog.create'))
                            <a href="{{ route('team.blogs.create') }}" class="btn btn-primary">
                                <i class="fas fa-plus"></i> Create Blog
                            </a>
                            @endif
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.delete-blog').forEach(button => {
        button.addEventListener('click', function() {
            const url = this.getAttribute('data-url');
            const title = this.getAttribute('data-title');

            Swal.fire({
                title: 'Delete Blog Post?',
                text: `Are you sure you want to delete "${title}"?`,
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
        });
    });
});
</script>
@endsection
