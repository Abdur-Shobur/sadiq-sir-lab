@extends('layouts.admin')

@section('title', 'Gallery Category Details')

@section('content')
<div class="container-fluid mt-4">
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('dashboard.gallery-categories.index') }}">Gallery Categories</a></li>
            <li class="breadcrumb-item active" aria-current="page">Category Details</li>
        </ol>
    </nav>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">Gallery Category Details</h4>
                    <div class="d-flex gap-2">
                        <a href="{{ route('dashboard.gallery-categories.edit', $galleryCategory) }}" class="btn btn-warning">
                            <i class="fas fa-edit"></i> Edit
                        </a>
                        <button type="button" class="btn btn-danger"
                                onclick="confirmDelete('{{ route('dashboard.gallery-categories.destroy', $galleryCategory) }}', '{{ $galleryCategory->name }}')">
                            <i class="fas fa-trash"></i> Delete
                        </button>
                        <a href="{{ route('dashboard.gallery-categories.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Back
                        </a>
                    </div>
                </div>

                <div class="card-body">
                    <div class="row g-4">
                        <div class="col-md-8">
                            <div class="mb-3">
                                <h5 class="mb-1">{{ $galleryCategory->name }}</h5>
                                <div class="text-muted">
                                    <code>{{ $galleryCategory->slug }}</code>
                                </div>
                            </div>

                            @if($galleryCategory->description)
                                <div class="mb-4">
                                    <h6 class="mb-2">Description</h6>
                                    <p>{{ $galleryCategory->description }}</p>
                                </div>
                            @endif

                            <div class="mb-3">
                                <span class="me-2">Status:</span>
                                @if($galleryCategory->is_active)
                                    <span class="badge bg-success">Active</span>
                                @else
                                    <span class="badge bg-secondary">Inactive</span>
                                @endif
                            </div>

                            <div class="mb-4">
                                <h6 class="mb-2">Galleries in this Category</h6>
                                @if($galleryCategory->galleries->count() > 0)
                                    <div class="row">
                                        @foreach($galleryCategory->galleries as $gallery)
                                            <div class="col-md-4 mb-3">
                                                <div class="card">
                                                    @if($gallery->image)
                                                        <img src="{{ $gallery->image_url }}" class="card-img-top" alt="{{ $gallery->title }}" style="height: 150px; object-fit: cover;">
                                                    @endif
                                                    <div class="card-body">
                                                        <h6 class="card-title">{{ $gallery->title }}</h6>
                                                        <a href="{{ route('dashboard.galleries.show', $gallery) }}" class="btn btn-sm btn-primary">View</a>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                @else
                                    <p class="text-muted">No galleries in this category yet.</p>
                                @endif
                            </div>

                            <div class="text-muted small">
                                <div>Created: {{ $galleryCategory->created_at?->format('M d, Y h:i A') }}</div>
                                <div>Updated: {{ $galleryCategory->updated_at?->format('M d, Y h:i A') }}</div>
                            </div>
                        </div>
                    </div>

                    <hr class="my-4">

                    <div class="d-flex justify-content-end gap-2">
                        <a href="{{ route('dashboard.gallery-categories.edit', $galleryCategory) }}" class="btn btn-warning">
                            <i class="fas fa-edit"></i> Edit
                        </a>
                        <button type="button" class="btn btn-danger"
                                onclick="confirmDelete('{{ route('dashboard.gallery-categories.destroy', $galleryCategory) }}', '{{ $galleryCategory->name }}')">
                            <i class="fas fa-trash"></i> Delete
                        </button>
                        <a href="{{ route('dashboard.gallery-categories.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Back to list
                        </a>
                    </div>
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
            text: `Do you want to delete the category "${title}"?`,
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
@endsection
```

```
