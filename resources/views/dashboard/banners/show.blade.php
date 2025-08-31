@extends('layouts.admin')

@section('title', 'View Banner')

@section('content')
<div class="container  mt-4">
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('dashboard.banners.index') }}">Banner Management</a></li>
            <li class="breadcrumb-item active" aria-current="page">View Banner</li>
        </ol>
    </nav>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4>Banner Details</h4>
                    <div>
                        <a href="{{ route('dashboard.banners.edit', $banner) }}" class="btn btn-primary">Edit Banner</a>
                        <button type="button" class="btn btn-danger"
                                onclick="confirmDelete('{{ route('dashboard.banners.destroy', $banner) }}', '{{ $banner->title }}')">
                            Delete Banner
                        </button>
                        <a href="{{ route('dashboard.banners.index') }}" class="btn btn-secondary">Back to List</a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h5>Content Information</h5>
                            <table class="table table-borderless">
                                <tr>
                                    <td><strong>Title:</strong></td>
                                    <td>{{ $banner->title }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Subtitle:</strong></td>
                                    <td>{{ $banner->subtitle }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Description:</strong></td>
                                    <td>{{ $banner->description }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Button Text:</strong></td>
                                    <td>{{ $banner->action_button_text }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Button Link:</strong></td>
                                    <td><a href="{{ $banner->action_button_link }}" target="_blank">{{ $banner->action_button_link }}</a></td>
                                </tr>
                                <tr>
                                    <td><strong>Status:</strong></td>
                                    <td>
                                        @if($banner->is_active)
                                            <span class="badge bg-success">Active</span>
                                        @else
                                            <span class="badge bg-secondary">Inactive</span>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td><strong>Created:</strong></td>
                                    <td>{{ $banner->created_at->format('M d, Y H:i') }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Updated:</strong></td>
                                    <td>{{ $banner->updated_at->format('M d, Y H:i') }}</td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <h5>Banner Image</h5>
                            @if($banner->banner_image)
                                <div class="text-center">
                                    <img src="{{ asset('storage/' . $banner->banner_image) }}"
                                         alt="Banner Image"
                                         class="img-fluid rounded"
                                         style="max-width: 100%; height: auto;">
                                    <p class="text-muted mt-2">Image Path: {{ $banner->banner_image }}</p>
                                </div>
                            @else
                                <div class="text-center py-4">
                                    <i class="fas fa-image fa-3x text-muted"></i>
                                    <p class="text-muted mt-2">No image uploaded</p>
                                </div>
                            @endif
                        </div>
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
