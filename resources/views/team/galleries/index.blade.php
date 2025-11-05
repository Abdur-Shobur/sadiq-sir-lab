@extends('layouts.team-dashboard')

@section('title', 'Galleries')

@section('content')
<div>
	<nav aria-label="breadcrumb" class="mb-4">
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="{{ route('team.dashboard') }}">Dashboard</a></li>
			<li class="breadcrumb-item active" aria-current="page">Galleries</li>
		</ol>
	</nav>

	<div class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-header d-flex justify-content-between align-items-center">
					<h4>Galleries</h4>
					@if(auth()->guard('team')->user()->hasPermission('gallery.create'))
					<a href="{{ route('team.galleries.create') }}" class="btn btn-primary">
						<i class="fas fa-plus"></i> Create New
					</a>
					@endif
				</div>
				<div class="card-body">
					@if($galleries->count() > 0)
						<div class="table-responsive">
							<table class="table table-bordered table-striped">
								<thead>
								<tr>
									<th>Image</th>
									<th>Title</th>
									<th>Category</th>
                                    <th>Description</th>
                                    <th>Order</th>
									<th>Status</th>
									<th>Created</th>
									<th>Actions</th>
								</tr>
								</thead>
								<tbody>
								@foreach($galleries as $gallery)
									<tr>
										<td>
											@if($gallery->image)
												<img src="{{ asset('uploads/'.$gallery->image) }}" alt="{{ $gallery->title }}" class="img-thumbnail" style="width:60px;height:60px;object-fit:cover;">
											@else
												<span class="text-muted">No Image</span>
											@endif
										</td>
										<td>{{ $gallery->title }}</td>
										<td><span class="badge bg-primary">{{ $gallery->category->name ?? 'Uncategorized' }}</span></td>
                                        <td>{{ Str::limit($gallery->description, 50) }}</td>
                                        <td>{{ $gallery->order }}</td>
										<td>
											<span class="badge {{ $gallery->is_active ? 'bg-success' : 'bg-secondary' }}">
												{{ $gallery->is_active ? 'Active' : 'Inactive' }}
											</span>
										</td>
										<td>{{ $gallery->created_at->format('M d, Y') }}</td>
										<td>
											<div class="btn-group gap-2">
												<a href="{{ route('team.galleries.show', $gallery) }}" class="btn btn-sm btn-info" title="View"><i class="fas fa-eye"></i></a>
												@if(auth()->guard('team')->user()->hasPermission('gallery.edit'))
												<a href="{{ route('team.galleries.edit', $gallery) }}" class="btn btn-sm btn-warning" title="Edit"><i class="fas fa-edit"></i></a>
												@endif
												@if(auth()->guard('team')->user()->hasPermission('gallery.delete'))
												<button type="button" class="btn btn-sm btn-danger" title="Delete"
														onclick="confirmDelete('{{ route('team.galleries.destroy', $gallery) }}', '{{ $gallery->title }}')">
													<i class="fas fa-trash"></i>
												</button>
												@endif
											</div>
										</td>
									</tr>
								@endforeach
								</tbody>
							</table>
						</div>
						<div class="d-flex justify-content-center">
							{{ $galleries->links() }}
						</div>
					@else
						<div class="text-center py-4">
							<i class="fas fa-images fa-3x text-muted mb-3"></i>
							<h5 class="text-muted">No Gallery Items Found</h5>
							<p class="text-muted">Get started by creating your first gallery item.</p>
							@if(auth()->guard('team')->user()->hasPermission('gallery.create'))
							<a href="{{ route('team.galleries.create') }}" class="btn btn-primary">
								<i class="fas fa-plus"></i> Create Gallery Item
							</a>
							@endif
						</div>
					@endif
				</div>
			</div>
		</div>
	</div>
</div>

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
