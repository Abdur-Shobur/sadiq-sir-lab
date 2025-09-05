@extends('layouts.admin')

@section('title', 'Portfolio Abouts')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h3 class="card-title">Portfolio Abouts</h3>
                    <a href="{{ route('dashboard.portfolio-abouts.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus"></i> Add New Portfolio About
                    </a>
                </div>
                <div class="card-body">
                    @if($portfolioAbouts->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Image 1</th>
                                        <th>Image 2</th>
                                        <th>Title</th>
                                        <th>Subtitle</th>
                                        <th>Status</th>
                                        <th>Created</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($portfolioAbouts as $about)
                                        <tr>
                                            <td>
                                                @if($about->image1)
                                                    <img src="{{ $about->image1_url }}" alt="{{ $about->title }}"
                                                         class="img-thumbnail" style="width: 60px; height: 60px; object-fit: cover;">
                                                @else
                                                    <span class="text-muted">No Image</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if($about->image2)
                                                    <img src="{{ $about->image2_url }}" alt="{{ $about->title }}"
                                                         class="img-thumbnail" style="width: 60px; height: 60px; object-fit: cover;">
                                                @else
                                                    <span class="text-muted">No Image</span>
                                                @endif
                                            </td>
                                            <td>{{ $about->title }}</td>
                                            <td>{{ $about->subtitle ?? 'N/A' }}</td>
                                            <td>
                                                <span class="badge {{ $about->is_active ? 'bg-success' : 'bg-secondary' }}">
                                                    {{ $about->is_active ? 'Active' : 'Inactive' }}
                                                </span>
                                            </td>
                                            <td>{{ $about->created_at->format('M d, Y') }}</td>
                                            <td>
                                                    <a href="{{ route('dashboard.portfolio-abouts.show', $about) }}"
                                                       class="btn btn-sm btn-info" title="View">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                    <a href="{{ route('dashboard.portfolio-abouts.edit', $about) }}"
                                                       class="btn btn-sm btn-warning" title="Edit">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <button type="button" class="btn btn-sm btn-danger" title="Delete"
                                                            onclick="confirmDelete('{{ route('dashboard.portfolio-abouts.destroy', $about) }}', '{{ $about->title }}')">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="text-center py-4">
                            <i class="fas fa-info-circle fa-3x text-muted mb-3"></i>
                            <h5 class="text-muted">No Portfolio Abouts Found</h5>
                            <p class="text-muted">Get started by creating your first portfolio about.</p>
                            <a href="{{ route('dashboard.portfolio-abouts.create') }}" class="btn btn-primary">
                                <i class="fas fa-plus"></i> Create Portfolio About
                            </a>
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
            text: `Do you want to delete the portfolio about "${title}"?`,
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
