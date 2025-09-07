@extends('layouts.admin')

@section('title', 'Banner Management')

@section('content')
<div class="mt-4">
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Banner Management</li>
        </ol>
    </nav>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4>Banner Management</h4>
                    <a href="{{ route('dashboard.banners.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus"></i>
                        <span class="d-none d-sm-inline-block">Add New Banner</span>
                    </a>
                </div>
                <div class="card-body">
                    @if($banners->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Image</th>
                                        <th>Title</th>
                                        <th>Subtitle</th>
                                        <th>Status</th>
                                        <th>Created</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($banners as $banner)
                                        <tr>
                                            <td>
                                                @if($banner->banner_image)
                                                    <img src="{{ asset('uploads/' . $banner->banner_image) }}"
                                                         alt="Banner"
                                                         style="width: 80px; height: 60px; object-fit: cover;">
                                                @else
                                                    <span class="text-muted">No image</span>
                                                @endif
                                            </td>
                                            <td>{{ $banner->title }}</td>
                                            <td>{{ $banner->subtitle }}</td>
                                            <td>
                                                @if($banner->is_active)
                                                    <span class="badge bg-success">Active</span>
                                                @else
                                                    <span class="badge bg-secondary">Inactive</span>
                                                @endif
                                            </td>
                                            <td>{{ $banner->created_at->format('M d, Y') }}</td>
                                            <td>
                                                        <div class="btn-group gap-2" role="group">
                                                <a href="{{ route('dashboard.banners.show', $banner) }}"
                                                   class="btn btn-sm btn-info">
                                                    <i class="fas fa-eye"></i>
                                                    </a>
                                                <a href="{{ route('dashboard.banners.edit', $banner) }}"
                                                   class="btn btn-sm btn-primary">
                                                    <i class="fas fa-edit"></i>
                                                    </a>
                                                <button type="button" class="btn btn-sm btn-danger"
                                                        onclick="confirmDelete('{{ route('dashboard.banners.destroy', $banner) }}', '{{ $banner->title }}')">
                                                    <i class="fas fa-trash"></i>
                                                    </button>
                                                </div>
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="text-center py-4">
                            <p class="text-muted">No banners found.</p>
                            <a href="{{ route('dashboard.banners.create') }}" class="btn btn-primary">Create First Banner</a>
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
            text: `Do you want to delete the banner "${title}"?`,
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
