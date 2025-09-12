@extends('layouts.team-dashboard')

@section('title', 'Researches')

@section('content')
<div>
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('team.dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Researches</li>
        </ol>
    </nav>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4>Researches</h4>
                    @if(auth()->guard('team')->user()->hasPermission('research.create'))
                    <a href="{{ route('team.researches.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus"></i>
                        <span class="d-none d-lg-inline-block">Create New</span>
                    </a>
                    @endif
                </div>
                <div class="card-body">
                    @if($researches->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Image</th>
                                        <th>Title</th>
                                        <th>Link</th>
                                        <th>Status</th>
                                        <th>Order</th>
                                        <th>Created</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($researches as $research)
                                        <tr>
                                            <td>
                                                @if($research->image)
                                                    <img src="{{ $research->image_url }}" alt="{{ $research->title }}"
                                                        class="img-thumbnail" style="width: 60px; height: 60px; object-fit: cover;">
                                                @else
                                                <img src="/assets/img/placeholder.svg"
                                                class="img-thumbnail" style="width: 60px; height: 60px; object-fit: cover;">
                                                @endif
                                            </td>
                                            <td>{{ $research->title }}</td>
                                            <td>
                                                @if($research->link)
                                                    <a href="{{ $research->link }}" target="_blank" class="btn btn-sm btn-outline-primary">
                                                        <i class="fas fa-external-link-alt"></i> View
                                                    </a>
                                                @else
                                                    <span class="text-muted">No Link</span>
                                                @endif
                                            </td>
                                            <td>
                                                <span class="badge {{ $research->is_active ? 'bg-success' : 'bg-secondary' }}">
                                                    {{ $research->is_active ? 'Active' : 'Inactive' }}
                                                </span>
                                            </td>
                                            <td>{{ $research->order }}</td>
                                            <td>{{ $research->created_at->format('M d, Y') }}</td>
                                            <td>
                                                <a href="{{ route('team.researches.show', $research) }}"
                                                   class="btn btn-sm btn-info" title="View">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                @if(auth()->guard('team')->user()->hasPermission('research.edit'))
                                                <a href="{{ route('team.researches.edit', $research) }}"
                                                   class="btn btn-sm btn-warning" title="Edit">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                @endif
                                                @if(auth()->guard('team')->user()->hasPermission('research.delete'))
                                                <button type="button" class="btn btn-sm btn-danger" title="Delete"
                                                onclick="confirmDelete('{{ route('team.researches.destroy', $research) }}', '{{ $research->title }}')"
                                                   class="btn btn-sm btn-danger" title="Delete">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <!-- Pagination -->
                        <div class="d-flex justify-content-center">
                            {{ $researches->links() }}
                        </div>
                    @else
                        <div class="text-center py-4">
                            <i class="fas fa-flask fa-3x text-muted mb-3"></i>
                            <h5 class="text-muted">No Researches Found</h5>
                            <p class="text-muted">Get started by creating your first research entry.</p>
                            @if(auth()->guard('team')->user()->hasPermission('research.create'))
                            <a href="{{ route('team.researches.create') }}" class="btn btn-primary">
                                <i class="fas fa-plus"></i> Create Research
                            </a>
                            @endif
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

<script>
function confirmDelete(url, title) {
    Swal.fire({
        title: 'Are you sure?',
        text: `Do you want to delete the research "${title}"?`,
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
