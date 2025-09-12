@extends('layouts.team-dashboard')

@section('title', 'Gallery Details')

@section('content')
<div>
	<nav aria-label="breadcrumb" class="mb-4">
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="{{ route('team.dashboard') }}">Dashboard</a></li>
			<li class="breadcrumb-item"><a href="{{ route('team.galleries.index') }}">Galleries</a></li>
			<li class="breadcrumb-item active" aria-current="page">Details</li>
		</ol>
	</nav>

	<div class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-header d-flex justify-content-between align-items-center">
					<h4 class="mb-0">Gallery Item</h4>
					<div>
						@can('gallery.edit')
						<a href="{{ route('team.galleries.edit', $gallery) }}" class="btn btn-warning"><i class="fas fa-edit"></i> Edit</a>
						@endcan
						<a href="{{ route('team.galleries.index') }}" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Back</a>
					</div>
				</div>
				<div class="card-body">
					<div class="row g-4">
						<div class="col-md-8">
							<h5 class="mb-2">{{ $gallery->title }}</h5>
							@if($gallery->description)
							<p class="text-muted">{{ $gallery->description }}</p>
							@endif

							<div class="mb-3">
								<strong>Category:</strong>
								<span class="badge bg-info">{{ $gallery->category->name ?? 'Uncategorized' }}</span>
							</div>

							<div class="mb-3">
								<strong>Status:</strong>
								@if($gallery->is_active)
									<span class="badge bg-success">Active</span>
								@else
									<span class="badge bg-secondary">Inactive</span>
								@endif
							</div>

							<div class="text-muted small">
								<div>Created: {{ $gallery->created_at?->format('M d, Y h:i A') }}</div>
								<div>Updated: {{ $gallery->updated_at?->format('M d, Y h:i A') }}</div>
							</div>
						</div>

						<div class="col-md-4">
							<div class="card h-100">
								<div class="card-header"><h6 class="mb-0">Image</h6></div>
								<div class="card-body text-center">
									@if($gallery->image)
										<img src="{{ asset('uploads/'.$gallery->image) }}" alt="{{ $gallery->title }}" style="max-width:100%;height:auto;border-radius:5px;">
									@else
										<i class="fas fa-image fa-3x text-muted"></i>
										<p class="text-muted mt-2">No image uploaded</p>
									@endif
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
