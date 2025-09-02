@extends('layouts.admin')

@section('title', 'Event Details')

@section('content')
<div class="container-fluid mt-4">
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('dashboard.events.index') }}">Events</a></li>
            <li class="breadcrumb-item active" aria-current="page">Event Details</li>
        </ol>
    </nav>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">Event Details</h4>
                    <div class="d-flex gap-2">
                        <a href="{{ route('dashboard.events.edit', $event) }}" class="btn btn-warning">
                            <i class="fas fa-edit"></i> Edit
                        </a>
                        <button type="button" class="btn btn-danger"
                                onclick="confirmDelete('{{ route('dashboard.events.destroy', $event) }}', '{{ $event->title }}')">
                            <i class="fas fa-trash"></i> Delete
                        </button>
                        <a href="{{ route('dashboard.events.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Back
                        </a>
                    </div>
                </div>

                <div class="card-body">
                    <div class="row g-4">
                        <div class="col-md-8">
                            <div class="mb-3">
                                <h5 class="mb-1">{{ $event->title }}</h5>
                                @if($event->subtitle)
                                    <div class="text-muted">{{ $event->subtitle }}</div>
                                @endif
                            </div>

                            <div class="mb-3">
                                <span class="me-2">Status:</span>
                                @if($event->is_active)
                                    <span class="badge bg-success">Active</span>
                                @else
                                    <span class="badge bg-secondary">Inactive</span>
                                @endif
                            </div>

                            <div class="mb-4">
                                <h6 class="mb-2">Content</h6>
                                <div class="border rounded p-3">
                                    {!! $event->content !!}
                                </div>
                            </div>

                            <div class="text-muted small">
                                <div>Created: {{ $event->created_at?->format('M d, Y h:i A') }}</div>
                                <div>Updated: {{ $event->updated_at?->format('M d, Y h:i A') }}</div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="card h-100">
                                <div class="card-header">
                                    <h6 class="mb-0">Icon</h6>
                                </div>
                                <div class="card-body text-center">
                                    <div style="font-size: 48px; color: #007bff;">
                                        @if($event->icon)
                                            <i class="{{ $event->icon }}"></i>
                                        @else
                                            <i class="fas fa-calendar"></i>
                                        @endif
                                    </div>
                                    <div class="mt-2">
                                        <span class="text-muted small">Class:</span>
                                        <code class="small">{{ $event->icon ?: 'fas fa-calendar' }}</code>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <hr class="my-4">

                    <div class="d-flex justify-content-end gap-2">
                        <a href="{{ route('dashboard.events.edit', $event) }}" class="btn btn-warning">
                            <i class="fas fa-edit"></i> Edit
                        </a>
                        <button type="button" class="btn btn-danger"
                                onclick="confirmDelete('{{ route('dashboard.events.destroy', $event) }}', '{{ $event->title }}')">
                            <i class="fas fa-trash"></i> Delete
                        </button>
                        <a href="{{ route('dashboard.events.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Back to list
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Delete Confirmation Script (reuses SweetAlert just like index) -->
<script>
    function confirmDelete(url, title) {
        Swal.fire({
            title: 'Are you sure?',
            text: `Do you want to delete the event "${title}"?`,
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
                form.innerHTML = `
                    @csrf
                    @method('DELETE')
                `;
                document.body.appendChild(form);
                form.submit();
            }
        });
    }
</script>
@endsection
