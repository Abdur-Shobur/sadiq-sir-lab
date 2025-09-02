@extends('layouts.admin')

@section('title', 'News Articles - Dashboard')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">News Articles</h4>
                    <a href="{{ route('dashboard.news.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus"></i> Add New Article
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
                                    <th>Status</th>
                                    <th>Created At</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($news as $article)
                                    <tr>
                                        <td>{{ $article->id }}</td>
                                        <td>
                                            @if($article->image)
                                            <img src="{{ $article->image_url }}" alt="{{ $article->title }}"
                                                 class="img-thumbnail" style="width: 50px; height: 50px; object-fit: cover;">
                                            @else
                                                <img src="{{ asset('assets/img/placeholder.svg') }}" alt="{{ $article->title }}"
                                                     class="img-thumbnail" style="width: 50px; height: 50px; object-fit: cover;">
                                            @endif
                                        </td>
                                        <td>
                                            <strong>{{ $article->title }}</strong>
                                        </td>

                                        <td>
                                            @if($article->status)
                                                <span class="badge bg-success">Active</span>
                                            @else
                                                <span class="badge bg-danger">Inactive</span>
                                            @endif
                                        </td>
                                        <td>{{ $article->created_at->format('M d, Y H:i') }}</td>
                                        <td>
                                            <a href="{{ route('dashboard.news.show', $article) }}"
                                               class="btn btn-sm btn-info">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{ route('dashboard.news.edit', $article) }}"
                                               class="btn btn-sm btn-warning">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <button type="button" class="btn btn-sm btn-danger delete-news"
                                                    data-id="{{ $article->id }}" data-title="{{ $article->title }}">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center">No news articles found.</td>
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
    // Handle delete news buttons
    document.querySelectorAll('.delete-news').forEach(button => {
        button.addEventListener('click', function() {
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
});
</script>
@endsection
