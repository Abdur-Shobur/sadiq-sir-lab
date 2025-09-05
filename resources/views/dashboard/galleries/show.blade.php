@extends('layouts.admin')

@section('title', 'Gallery Item Details')

@section('content')
<div class="container-fluid mt-4">
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('dashboard.galleries.index') }}">Gallery</a></li>
            <li class="breadcrumb-item active" aria-current="page">Gallery Item Details</li>
        </ol>
    </nav>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">Gallery Item Details</h4>
                    <div class="d-flex gap-2">
                        <a href="{{ route('dashboard.galleries.edit', $gallery) }}" class="btn btn-warning">
                            <i class="fas fa-edit"></i> Edit
                        </a>
                        <button type="button" class="btn btn-danger"
                                onclick="confirmDelete('{{ route('dashboard.galleries.destroy', $gallery) }}', '{{ $gallery->title }}')">
                            <i class="fas fa-trash"></i> Delete
                        </button>
                        <a href="{{ route('dashboard.galleries.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Back
                        </a>
                    </div>
                </div>

                <div class="card-body">
                    <div class="row g-4">
                        <div class="col-md-8">
                            <div class="mb-3">
                                <h5 class="mb-1">{{ $gallery->title }}</h5>
                                <div class="text-muted">
                                    <i class="fas fa-folder"></i> {{ $gallery->category->name }}
                                </div>
                            </div>

                            @if($gallery->description)
                                <div class="mb-4">
                                    <h6 class="mb-2">Description</h6>
                                    <p>{{ $gallery->description }}</p>
                                </div>
                            @endif

                            @if($gallery->link)
                                <div class="mb-4">
                                    <h6 class="mb-2">External Link</h6>
                                    <a href="{{ $gallery->link }}" target="_blank" class="btn btn-outline-primary">
                                        <i class="fas fa-external-link-alt"></i> View Link
                                    </a>
                                </div>
                            @endif

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <strong>Order:</strong> {{ $gallery->order }}
                                </div>
                                <div class="col-md-6">
                                    <strong>Status:</strong>
                                    @if($gallery->is_active)
                                        <span class="badge bg-success">Active</span>
                                    @else
                                        <span class="badge bg-secondary">Inactive</span>
                                    @endif
                                </div>
                            </div>

                            <div class="text-muted small">
                                <div>Created: {{ $gallery->created_at?->format('M d, Y h:i A') }}</div>
                                <div>Updated: {{ $gallery->updated_at?->format('M d, Y h:i A') }}</div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            @if($gallery->image)
                                <div class="card h-100">
                                    <div class="card-header">
                                        <h6 class="mb-0">Gallery Image</h6>
                                    </div>
                                    <div class="card-body text-center">
                                        <img src="{{ $gallery->image_url }}" alt="{{ $gallery->title }}"
                                             style="max-width: 100%; height: auto; border-radius: 5px;">
                                    </div>
                                </div>
                            @else
                                <div class="card h-100">
                                    <div class="card-header">
                                        <h6 class="mb-0">Gallery Image</h6>
                                    </div>
                                    <div class="card-body text-center">
                                        <i class="fas fa-image fa-3x text-muted"></i>
                                        <p class="text-muted mt-2">No image uploaded</p>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>

                    <hr class="my-4">

                    <div class="d-flex justify-content-end gap-2">
                        <a href="{{ route('dashboard.galleries.edit', $gallery) }}" class="btn btn-warning">
                            <i class="fas fa-edit"></i> Edit
                        </a>
                        <button type="button" class="btn btn-danger"
                                onclick="confirmDelete('{{ route('dashboard.galleries.destroy', $gallery) }}', '{{ $gallery->title }}')">
                            <i class="fas fa-trash"></i> Delete
                        </button>
                        <a href="{{ route('dashboard.galleries.index') }}" class="btn btn-secondary">
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
            text: `Do you want to delete the gallery item "${title}"?`,
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
