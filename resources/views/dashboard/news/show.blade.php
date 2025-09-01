@extends('layouts.admin')

@section('title', 'View News Article - Dashboard')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">View News Article</h4>
                    <div>
                        <a href="{{ route('dashboard.news.edit', $news) }}" class="btn btn-warning">
                            <i class="fas fa-edit"></i> Edit
                        </a>
                        <a href="{{ route('dashboard.news.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Back to List
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="mb-4">
                                <h5 class="text-muted">Title</h5>
                                <h3>{{ $news->title }}</h3>
                            </div>

                            @if($news->description)
                            <div class="mb-4">
                                <h5 class="text-muted">Description</h5>
                                <p class="lead">{{ $news->description }}</p>
                            </div>
                            @endif

                            <div class="mb-4">
                                <h5 class="text-muted">Content</h5>
                                <div class="content-preview border p-3 rounded">
                                    {!! $news->content !!}
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <h6 class="text-muted">Status</h6>
                                        @if($news->status)
                                            <span class="badge bg-success fs-6">Active</span>
                                        @else
                                            <span class="badge bg-danger fs-6">Inactive</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <h6 class="text-muted">Created At</h6>
                                        <p>{{ $news->created_at->format('F j, Y \a\t g:i A') }}</p>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <h6 class="text-muted">Last Updated</h6>
                                        <p>{{ $news->updated_at->format('F j, Y \a\t g:i A') }}</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <h6 class="text-muted">Article ID</h6>
                                        <p>#{{ $news->id }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-header">
                                    <h6 class="mb-0">Featured Image</h6>
                                </div>
                                <div class="card-body text-center">
                                    <img src="{{ $news->image_url }}"
                                         alt="{{ $news->title }}"
                                         class="img-fluid rounded shadow-sm">
                                </div>
                            </div>

                            <div class="mt-3">
                                <h6 class="text-muted">Quick Actions</h6>
                                <div class="d-grid gap-2">
                                    <a href="{{ route('dashboard.news.edit', $news) }}"
                                       class="btn btn-outline-warning">
                                        <i class="fas fa-edit"></i> Edit Article
                                    </a>
                                    <button type="button" class="btn btn-outline-danger delete-news"
                                            data-id="{{ $news->id }}" data-title="{{ $news->title }}">
                                        <i class="fas fa-trash"></i> Delete Article
                                    </button>
                                    @if($news->status)
                                    <form action="{{ route('dashboard.news.update', $news) }}" method="POST" style="display: inline;">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" name="title" value="{{ $news->title }}">
                                        <input type="hidden" name="description" value="{{ $news->description }}">
                                        <input type="hidden" name="content" value="{{ $news->content }}">
                                        <input type="hidden" name="status" value="0">
                                        <button type="submit" class="btn btn-outline-secondary w-100">
                                            <i class="fas fa-eye-slash"></i> Deactivate
                                        </button>
                                    </form>
                                    @else
                                    <form action="{{ route('dashboard.news.update', $news) }}" method="POST" style="display: inline;">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" name="title" value="{{ $news->title }}">
                                        <input type="hidden" name="description" value="{{ $news->description }}">
                                        <input type="hidden" name="content" value="{{ $news->content }}">
                                        <input type="hidden" name="status" value="1">
                                        <button type="submit" class="btn btn-outline-success w-100">
                                            <i class="fas fa-eye"></i> Activate
                                        </button>
                                    </form>
                                    @endif
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
    // Handle delete news button
    document.querySelector('.delete-news')?.addEventListener('click', function() {
        const newsId = this.getAttribute('data-id');
        const newsTitle = this.getAttribute('data-title');

        // Show confirmation toast
        Swal.fire({
            title: 'Delete News Article?',
            text: `Are you sure you want to delete "${newsTitle}"?`,
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
                form.action = `/dashboard/news/${newsId}`;

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
</script>
@endsection
