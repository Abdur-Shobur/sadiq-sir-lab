@extends('layouts.admin')

@section('title', 'Services Management')

@section('content')
<div class="container-fluid mt-4">
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Services Management</li>
        </ol>
    </nav>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4>Services Management</h4>
                    <a href="{{ route('dashboard.services.create') }}" class="btn btn-primary">Add New Service</a>
                </div>
                <div class="card-body">
                    @if($services->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Order</th>
                                        <th>Icon</th>
                                        <th>Title</th>
                                        <th>Background Color</th>
                                        <th>Status</th>
                                        <th>Created</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($services as $service)
                                        <tr>
                                            <td>{{ $service->order }}</td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <div class="icon-preview me-2" style="background-color: {{ $service->background_color }}; width: 40px; height: 40px; border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                                                        <i class="{{ $service->icon }}" style="color: white; font-size: 18px;"></i>
                                                    </div>
                                                    <span class="text-muted">{{ $service->icon }}</span>
                                                </div>
                                            </td>
                                            <td>{{ $service->title }}</td>
                                            <td>
                                                <span class="badge" style="background-color: {{ $service->background_color }}; color: white;">
                                                    {{ $service->background_color }}
                                                </span>
                                            </td>
                                            <td>
                                                @if($service->is_active)
                                                    <span class="badge bg-success">Active</span>
                                                @else
                                                    <span class="badge bg-secondary">Inactive</span>
                                                @endif
                                            </td>
                                            <td>{{ $service->created_at->format('M d, Y') }}</td>
                                            <td>
                                                    <div class="btn-group gap-2" role="group">
                                                <a href="{{ route('dashboard.services.show', $service) }}"
                                                   class="btn btn-sm btn-info">
                                                    <i class="fas fa-eye"></i>
                                                    </a>
                                                <a href="{{ route('dashboard.services.edit', $service) }}"
                                                   class="btn btn-sm btn-primary">
                                                    <i class="fas fa-edit"></i>
                                                    </a>
                                                <button type="button" class="btn btn-sm btn-danger"
                                                        onclick="confirmDelete('{{ route('dashboard.services.destroy', $service) }}', '{{ $service->title }}')">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="text-center py-4">
                            <p class="text-muted">No services found.</p>
                            <a href="{{ route('dashboard.services.create') }}" class="btn btn-primary">Create First Service</a>
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
            text: `Do you want to delete the service "${title}"?`,
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
