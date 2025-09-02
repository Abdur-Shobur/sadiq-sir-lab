@extends('layouts.admin')

@section('title', 'Research Areas Management')

@section('content')
<div class="container-fluid mt-4">
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Research Areas Management</li>
        </ol>
    </nav>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4>Research Areas Management</h4>
                    <a href="{{ route('dashboard.research-areas.create') }}" class="btn btn-primary">Add New Research Area</a>
                </div>
                <div class="card-body">
                    @if($researchAreas->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Order</th>
                                        <th>Image</th>
                                        <th>Title</th>
                                        <th>Status</th>
                                        <th>Created</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($researchAreas as $researchArea)
                                        <tr>
                                            <td>{{ $researchArea->order }}</td>
                                            <td>
                                                @if($researchArea->image)
                                                    <img src="{{ asset('storage/' . $researchArea->image) }}"
                                                         alt="Research Area"
                                                         style="width: 80px; height: 60px; object-fit: cover; border-radius: 5px;">
                                                @else
                                                    <span class="text-muted">No image</span>
                                                @endif
                                            </td>
                                            <td>{{ $researchArea->title }}</td>

                                            <td>
                                                @if($researchArea->is_active)
                                                    <span class="badge bg-success">Active</span>
                                                @else
                                                    <span class="badge bg-secondary">Inactive</span>
                                                @endif
                                            </td>
                                            <td>{{ $researchArea->created_at->format('M d, Y') }}</td>
                                            <td>
                                                <div class="btn-group gap-2" role="group">
                                                <a href="{{ route('dashboard.research-areas.show', $researchArea) }}"
                                                    class="btn btn-sm btn-info">
                                                    <i class="fas fa-eye"></i>
                                                    </a>
                                                <a href="{{ route('dashboard.research-areas.edit', $researchArea) }}"
                                                   class="btn btn-sm btn-primary">
                                                    <i class="fas fa-edit"></i>
                                                    </a>
                                                <button type="button" class="btn btn-sm btn-danger"
                                                        onclick="confirmDelete('{{ route('dashboard.research-areas.destroy', $researchArea) }}', '{{ $researchArea->title }}')">
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
                            <p class="text-muted">No research areas found.</p>
                            <a href="{{ route('dashboard.research-areas.create') }}" class="btn btn-primary">Create First Research Area</a>
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
            text: `Do you want to delete the research area "${title}"?`,
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
