@extends('layouts.team-dashboard')

@section('title', 'Project Details')

@section('content')
<div>
	<nav aria-label="breadcrumb" class="mb-4">
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="{{ route('team.dashboard') }}">Dashboard</a></li>
			<li class="breadcrumb-item"><a href="{{ route('team.projects.index') }}">Projects</a></li>
			<li class="breadcrumb-item active" aria-current="page">Project Details</li>
		</ol>
	</nav>

	<div class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-header d-flex justify-content-between align-items-center">
					<h4 class="mb-0">{{ $project->title }}</h4>
					<div class="d-flex gap-2">
						@if(auth()->guard('team')->user()->hasPermission('project.edit'))
						<a href="{{ route('team.projects.edit', $project) }}" class="btn btn-warning">
							<i class="fas fa-edit"></i> <span class="d-none d-lg-inline-block">Edit</span>
						</a>
						@endif
						<a href="{{ route('team.projects.index') }}" class="btn btn-secondary">
							<i class="fas fa-arrow-left"></i> <span class="d-none d-lg-inline-block">Back</span>
						</a>
					</div>
				</div>

				<div class="card-body">
					<div class="row g-4">
						<div class="col-md-8">
							@if(!empty($project->subtitle))
								<p class="text-muted lead">{{ $project->subtitle }}</p>
							@endif

							<div class="mb-3">
								<strong>Category:</strong>
								<span class="badge bg-primary">{{ $project->category->name ?? 'Uncategorized' }}</span>
							</div>

							<div class="mb-3">
								<strong>Status:</strong>
								<span class="badge {{ $project->is_active ? 'bg-success' : 'bg-secondary' }}">
									{{ $project->is_active ? 'Active' : 'Inactive' }}
								</span>
							</div>

							<div class="mb-4">
								<h6>Content</h6>
								<div class="border rounded p-3 bg-light">
									{!! $project->content !!}
								</div>
							</div>

							<div class="text-muted small">
								<div>Created: {{ $project->created_at?->format('M d, Y h:i A') }}</div>
								<div>Updated: {{ $project->updated_at?->format('M d, Y h:i A') }}</div>
							</div>
						</div>

						<div class="col-md-4">
							<div class="card h-100">
								<div class="card-header"><h6 class="mb-0">Project Image</h6></div>
								<div class="card-body text-center">
									@if($project->image)
										<img src="{{ asset('uploads/'.$project->image) }}" alt="{{ $project->title }}" style="max-width: 100%; height: auto; border-radius: 5px;">
									@else
										<img src="{{ asset('assets/img/placeholder.svg') }}" alt="{{ $project->title }}" style="max-width: 100%; height: auto; border-radius: 5px;">
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
