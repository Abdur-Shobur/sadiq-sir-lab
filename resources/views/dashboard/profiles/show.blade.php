@extends('layouts.admin')

@section('title', 'Profile Details')

@section('content')
<div>
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('dashboard.profiles.index') }}">Profiles</a></li>
            <li class="breadcrumb-item active" aria-current="page">Profile Details</li>
        </ol>
    </nav>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">Profile Details</h4>
                    <div class="d-flex gap-2">
                        <a href="{{ route('dashboard.profiles.edit', $profile) }}" class="btn btn-warning">
                            <i class="fas fa-edit"></i>
                            <span class="d-none d-lg-inline-block">Edit</span>
                        </a>
                        <button type="button" class="btn btn-danger"
                                onclick="confirmDelete('{{ route('dashboard.profiles.destroy', $profile) }}', 'Profile #{{ $profile->id }}')">
                            <i class="fas fa-trash"></i>
                            <span class="d-none d-lg-inline-block">Delete</span>
                        </button>
                        <a href="{{ route('dashboard.profiles.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i>
                            <span class="d-none d-lg-inline-block">Back</span>
                        </a>
                    </div>
                </div>

                <div class="card-body">
                    <div class="row g-4">
                        <div class="col-md-8">
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <strong>Email:</strong> {{ $profile->email ?? 'N/A' }}
                                </div>
                                <div class="col-md-6">
                                    <strong>Phone:</strong> {{ $profile->phone ?? 'N/A' }}
                                </div>
                            </div>

                            <div class="mb-3">
                                <strong>Address:</strong>
                                <p>{{ $profile->address ?? 'N/A' }}</p>
                            </div>

                            <div class="text-muted small">
                                <div>Created: {{ $profile->created_at?->format('M d, Y h:i A') }}</div>
                                <div>Updated: {{ $profile->updated_at?->format('M d, Y h:i A') }}</div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            @if($profile->logo)
                                <div class="card mb-4">
                                    <div class="card-header">
                                        <h6 class="mb-0">Logo</h6>
                                    </div>
                                    <div class="card-body text-center">
                                        <img src="{{ $profile->logo_url }}" alt="Logo"
                                             style="max-width: 100%; height: auto; border-radius: 5px;">
                                    </div>
                                </div>
                            @endif

                            @if($profile->image)
                                <div class="card">
                                    <div class="card-header">
                                        <h6 class="mb-0">Profile Image</h6>
                                    </div>
                                    <div class="card-body text-center">
                                        <img src="{{ $profile->image_url }}" alt="Profile Image"
                                             style="max-width: 100%; height: auto; border-radius: 5px;">
                                    </div>
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
            text: `Do you want to delete ${title}?`,
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
