@extends('layouts.admin')

@section('title', 'Blog Posts - Dashboard')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">Blog Posts</h4>
                    <a href="{{ route('dashboard.blogs.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus"></i> Add New Blog Post
                    </a>
                </div>
                <div class="card-body">
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
                                @forelse($blogs as $blog)
                                    <tr>
                                        <td>{{ $blog->id }}</td>
                                        <td>
                                            <img src="{{ $blog->image_url }}" alt="{{ $blog->title }}"
                                                 class="img-thumbnail" style="width: 50px; height: 50px; object-fit: cover;">
                                        </td>
                                        <td>
                                            <strong>{{ $blog->title }}</strong>
                                            @if($blog->subtitle)
                                                <br><small class="text-muted">{{ $blog->subtitle }}</small>
                                            @endif
                                        </td>
                                        <td>
                                            <span class="badge bg-info">{{ $blog->category->name }}</span>
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
                                            <a href="{{ route('dashboard.blogs.show', $blog) }}"
                                               class="btn btn-sm btn-info">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{ route('dashboard.blogs.edit', $blog) }}"
                                               class="btn btn-sm btn-warning">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <button type="button" class="btn btn-sm btn-danger delete-blog"
                                                    data-id="{{ $blog->id }}" data-title="{{ $blog->title }}">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center">No blog posts found.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Handle delete blog buttons
    document.querySelectorAll('.delete-blog').forEach(button => {
        button.addEventListener('click', function() {
            const blogId = this.getAttribute('data-id');
            const blogTitle = this.getAttribute('data-title');

            // Show confirmation toast
            Swal.fire({
                title: 'Delete Blog Post?',
                text: `Are you sure you want to delete "${blogTitle}"?`,
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
                    form.action = `/dashboard/blogs/${blogId}`;

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
