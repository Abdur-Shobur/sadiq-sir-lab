@extends('layouts.admin')

@section('title', 'Portfolio Banners')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h3 class="card-title">Portfolio Banners</h3>
                    <a href="{{ route('dashboard.portfolio-banners.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus"></i> Add New Portfolio Banner
                    </a>
                </div>
                <div class="card-body">
                    @if($portfolioBanners->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Order</th>
                                        <th>Image</th>
                                        <th>Title</th>
                                        <th>Subtitle</th>
                                        <th>Status</th>
                                        <th>Created</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($portfolioBanners as $banner)
                                        <tr>
                                            <td>{{ $banner->order }}</td>
                                            <td>
                                                @if($banner->image)
                                                    <img src="{{ $banner->image_url }}" alt="{{ $banner->title }}"
                                                         class="img-thumbnail" style="width: 60px; height: 60px; object-fit: cover;">
                                                @else
                                                    <span class="text-muted">No Image</span>
                                                @endif
                                            </td>
                                            <td>{{ $banner->title }}</td>
                                            <td>{{ $banner->subtitle ?? 'N/A' }}</td>
                                            <td>
                                                <span class="badge {{ $banner->is_active ? 'bg-success' : 'bg-secondary' }}">
                                                    {{ $banner->is_active ? 'Active' : 'Inactive' }}
                                                </span>
                                            </td>
                                            <td>{{ $banner->created_at->format('M d, Y') }}</td>
                                            <td>
                                                    <a href="{{ route('dashboard.portfolio-banners.show', $banner) }}"
                                                       class="btn btn-sm btn-info" title="View">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                    <a href="{{ route('dashboard.portfolio-banners.edit', $banner) }}"
                                                       class="btn btn-sm btn-warning" title="Edit">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <button type="button" class="btn btn-sm btn-danger" title="Delete"
                                                            onclick="confirmDelete('{{ route('dashboard.portfolio-banners.destroy', $banner) }}', '{{ $banner->title }}')">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="text-center py-4">
                            <i class="fas fa-image fa-3x text-muted mb-3"></i>
                            <h5 class="text-muted">No Portfolio Banners Found</h5>
                            <p class="text-muted">Get started by creating your first portfolio banner.</p>
                            <a href="{{ route('dashboard.portfolio-banners.create') }}" class="btn btn-primary">
                                <i class="fas fa-plus"></i> Create Portfolio Banner
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
            text: `Do you want to delete the portfolio banner "${title}"?`,
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

@endsection
