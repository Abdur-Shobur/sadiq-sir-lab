@extends('layouts.admin')

@section('title', 'About Sections Management')

@section('content')
<div class="container-fluid mt-4">
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">About Sections Management</li>
        </ol>
    </nav>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4>About Sections Management</h4>
                    <a href="{{ route('dashboard.abouts.create') }}" class="btn btn-primary">Add New About Section</a>
                </div>
                <div class="card-body">
                    @if($abouts->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Image</th>
                                        <th>Title</th>
                                        <th>Subtitle</th>
                                        <th>Features Count</th>
                                        <th>Status</th>
                                        <th>Created</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($abouts as $about)
                                        <tr>
                                            <td>
                                                @if($about->image)
                                                    <img src="{{ asset('storage/' . $about->image) }}"
                                                         alt="About Section"
                                                         style="width: 80px; height: 60px; object-fit: cover; border-radius: 5px;">
                                                @else
                                                    <span class="text-muted">No image</span>
                                                @endif
                                            </td>
                                            <td>{{ $about->title }}</td>
                                            <td>{{ $about->subtitle }}</td>
                                            <td>
                                                <span class="badge bg-info">
                                                    {{ is_array($about->features) ? count($about->features) : 0 }} features
                                                </span>
                                            </td>
                                            <td>
                                                @if($about->is_active)
                                                    <span class="badge bg-success">Active</span>
                                                @else
                                                    <span class="badge bg-secondary">Inactive</span>
                                                @endif
                                            </td>
                                            <td>{{ $about->created_at->format('M d, Y') }}</td>
                                            <td>
                                                <div class="btn-group gap-2" role="group">
                                                <a href="{{ route('dashboard.abouts.show', $about) }}"
                                                   class="btn btn-sm btn-info">
                                                    <i class="fas fa-eye"></i>
                                                    </a>
                                                <a href="{{ route('dashboard.abouts.edit', $about) }}"
                                                   class="btn btn-sm btn-primary">
                                                    <i class="fas fa-edit"></i>
                                                    </a>
                                                    <button type="button" class="btn btn-sm btn-danger"
                                                        onclick="confirmDelete('{{ route('dashboard.abouts.destroy', $about) }}', '{{ $about->title }}')">
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
                            <p class="text-muted">No about sections found.</p>
                            <a href="{{ route('dashboard.abouts.create') }}" class="btn btn-primary">Create First About Section</a>
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
            text: `Do you want to delete the about section "${title}"?`,
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
