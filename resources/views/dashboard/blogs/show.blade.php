@extends('layouts.admin')

@section('title', 'Blog Post Details - Dashboard')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">Blog Post Details</h4>
                    <div>
                        <a href="{{ route('dashboard.blogs.edit', $blog) }}" class="btn btn-warning">
                            <i class="fas fa-edit"></i> Edit
                        </a>
                        <a href="{{ route('dashboard.blogs.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Back to List
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="mb-4">
                                <h2>{{ $blog->title }}</h2>
                                @if($blog->subtitle)
                                    <p class="text-muted lead">{{ $blog->subtitle }}</p>
                                @endif
                            </div>

                            <div class="mb-4">
                                <img src="{{ $blog->image_url }}" alt="{{ $blog->title }}"
                                     class="img-fluid rounded" style="max-height: 400px; width: 100%; object-fit: cover;">
                            </div>

                            <div class="mb-4">
                                <h5>Content:</h5>
                                <div class="border rounded p-3 bg-light">
                                    {!! $blog->content !!}
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-header">
                                    <h6>Blog Information</h6>
                                </div>
                                <div class="card-body">
                                    <table class="table table-borderless">
                                        <tr>
                                            <th width="120">ID:</th>
                                            <td>{{ $blog->id }}</td>
                                        </tr>
                                        <tr>
                                            <th>Category:</th>
                                            <td>
                                                <span class="badge bg-info">{{ $blog->category->name }}</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Status:</th>
                                            <td>
                                                @if($blog->status)
                                                    <span class="badge bg-success">Active</span>
                                                @else
                                                    <span class="badge bg-danger">Inactive</span>
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Created:</th>
                                            <td>{{ $blog->created_at->format('M d, Y H:i:s') }}</td>
                                        </tr>
                                        <tr>
                                            <th>Updated:</th>
                                            <td>{{ $blog->updated_at->format('M d, Y H:i:s') }}</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>

                            <div class="card mt-3">
                                <div class="card-header">
                                    <h6>Actions</h6>
                                </div>
                                <div class="card-body">
                                    <button type="button" class="btn btn-danger delete-blog"
                                            data-id="{{ $blog->id }}" data-title="{{ $blog->title }}">
                                        <i class="fas fa-trash"></i> Delete Blog Post
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Handle delete blog button
    const deleteButton = document.querySelector('.delete-blog');
    if (deleteButton) {
        deleteButton.addEventListener('click', function() {
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
    }
});
</script>
@endsection
