@extends('layouts.admin')

@section('title', 'Achievement Details')

@section('content')
<div class="container-fluid mt-4">
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('dashboard.achievements.index') }}">Achievements</a></li>
            <li class="breadcrumb-item active" aria-current="page">Achievement Details</li>
        </ol>
    </nav>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">Achievement Details</h4>
                    <div class="d-flex gap-2">
                        <a href="{{ route('dashboard.achievements.edit', $achievement) }}" class="btn btn-warning">
                            <i class="fas fa-edit"></i> Edit
                        </a>
                        <button type="button" class="btn btn-danger"
                                onclick="confirmDelete('{{ route('dashboard.achievements.destroy', $achievement) }}', '{{ $achievement->title }}')">
                            <i class="fas fa-trash"></i> Delete
                        </button>
                        <a href="{{ route('dashboard.achievements.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Back
                        </a>
                    </div>
                </div>

                <div class="card-body">
                    <div class="row g-4">
                        <div class="col-md-8">
                            <div class="mb-3">
                                <h5 class="mb-1">{{ $achievement->title }}</h5>
                                <div class="text-muted">
                                    <i class="fas fa-calendar-alt"></i> {{ $achievement->period }}
                                </div>
                            </div>

                            @if($achievement->description)
                                <div class="mb-4">
                                    <h6 class="mb-2">Description</h6>
                                    <p>{{ $achievement->description }}</p>
                                </div>
                            @endif

                            @if($achievement->link)
                                <div class="mb-4">
                                    <h6 class="mb-2">External Link</h6>
                                    <a href="{{ $achievement->link }}" target="_blank" class="btn btn-outline-primary">
                                        <i class="fas fa-external-link-alt"></i> View Link
                                    </a>
                                </div>
                            @endif

                            <div class="mb-3">
                                <span class="me-2">Status:</span>
                                @if($achievement->is_active)
                                    <span class="badge bg-success">Active</span>
                                @else
                                    <span class="badge bg-secondary">Inactive</span>
                                @endif
                            </div>

                            <div class="text-muted small">
                                <div>Created: {{ $achievement->created_at?->format('M d, Y h:i A') }}</div>
                                <div>Updated: {{ $achievement->updated_at?->format('M d, Y h:i A') }}</div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            @if($achievement->image)
                                <div class="card h-100">
                                    <div class="card-header">
                                        <h6 class="mb-0">Achievement Image</h6>
                                    </div>
                                    <div class="card-body text-center">
                                        <img src="{{ $achievement->image_url }}" alt="{{ $achievement->title }}"
                                             style="max-width: 100%; height: auto; border-radius: 5px;">
                                    </div>
                                </div>
                            @else
                                <div class="card h-100">
                                    <div class="card-header">
                                        <h6 class="mb-0">Achievement Image</h6>
                                    </div>
                                    <div class="card-body text-center">
                                        <i class="fas fa-trophy fa-3x text-muted"></i>
                                        <p class="text-muted mt-2">No image uploaded</p>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>

                    <hr class="my-4">

                    <div class="d-flex justify-content-end gap-2">
                        <a href="{{ route('dashboard.achievements.edit', $achievement) }}" class="btn btn-warning">
                            <i class="fas fa-edit"></i> Edit
                        </a>
                        <button type="button" class="btn btn-danger"
                                onclick="confirmDelete('{{ route('dashboard.achievements.destroy', $achievement) }}', '{{ $achievement->title }}')">
                            <i class="fas fa-trash"></i> Delete
                        </button>
                        <a href="{{ route('dashboard.achievements.index') }}" class="btn btn-secondary">
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
            text: `Do you want to delete the achievement "${title}"?`,
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
