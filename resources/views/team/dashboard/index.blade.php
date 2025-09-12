@extends('layouts.team-dashboard')

@section('title', 'Team Dashboard')

@section('content')
<div>
	@if($team->hasPermission('dashboard.view'))
		<div class="page-header">
			<h1 class="page-title">Dashboard</h1>
			<p class="page-subtitle">Welcome back, {{ $team->name }}!</p>
		</div>

		<div class="row">

			@if($team->hasPermission('blog.view'))
			<div class="col-md-4">
				<div class="content-card d-flex justify-content-between align-items-center">
					<div>
						<div class="text-muted">Blogs</div>
						<div class="h5 mb-0">{{ $stats['blogs']['active'] }} / {{ $stats['blogs']['total'] }}</div>
					</div>
					<a href="{{ route('team.blogs.index') }}" class="btn btn-sm btn-outline-primary">View</a>
				</div>
			</div>
			@endif
			@if($team->hasPermission('contact.view'))
			<div class="col-md-4">
				<div class="content-card d-flex justify-content-between align-items-center">
					<div>
						<div class="text-muted">Contacts</div>
						<div class="h5 mb-0">{{ $stats['contacts']['unread'] }} unread / {{ $stats['contacts']['total'] }}</div>
					</div>
					<a href="{{ route('team.contacts.index') }}" class="btn btn-sm btn-outline-primary">View</a>
				</div>
			</div>
			@endif
			@if($team->hasPermission('event.view'))
			<div class="col-md-4">
				<div class="content-card d-flex justify-content-between align-items-center">
					<div>
						<div class="text-muted">Events</div>
						<div class="h5 mb-0">{{ $stats['events']['active'] }} / {{ $stats['events']['total'] }}</div>
					</div>
					<a href="{{ route('team.events.index') }}" class="btn btn-sm btn-outline-primary">View</a>
				</div>
			</div>
			@endif

			@if($team->hasPermission('gallery.view'))
			<div class="col-md-4 mt-3">
				<div class="content-card d-flex justify-content-between align-items-center">
					<div>
						<div class="text-muted">Galleries</div>
						<div class="h5 mb-0">{{ $stats['galleries']['active'] }} / {{ $stats['galleries']['total'] }}</div>
					</div>
					<a href="{{ route('team.galleries.index') }}" class="btn btn-sm btn-outline-primary">View</a>
				</div>
			</div>
			@endif
			@if($team->hasPermission('project.view'))
			<div class="col-md-4 mt-3">
				<div class="content-card d-flex justify-content-between align-items-center">
					<div>
						<div class="text-muted">Projects</div>
						<div class="h5 mb-0">{{ $stats['projects']['active'] }} / {{ $stats['projects']['total'] }}</div>
					</div>
					<a href="{{ route('team.projects.index') }}" class="btn btn-sm btn-outline-primary">View</a>
				</div>
			</div>
			@endif
			@if($team->hasPermission('research.view'))
			<div class="col-md-4 mt-3">
				<div class="content-card d-flex justify-content-between align-items-center">
					<div>
						<div class="text-muted">Research</div>
						<div class="h5 mb-0">{{ $stats['research']['active'] }} / {{ $stats['research']['total'] }}</div>
					</div>
					<a href="{{ route('team.researches.index') }}" class="btn btn-sm btn-outline-primary">View</a>
				</div>
			</div>
			@endif
		</div>

		<div class="row mt-4">
			<div class="col-lg-6">
				@if($team->hasPermission('blog.view'))
				<div class="content-card">
					<h6 class="mb-3">Recent Blogs</h6>
					<ul class="list-group list-group-flush">
						@forelse($recent['blogs'] as $item)
							<li class="list-group-item px-0 d-flex justify-content-between">
								<span>{{ $item->title }}</span>
								<span class="text-muted small">{{ $item->created_at->diffForHumans() }}</span>
							</li>
						@empty
							<li class="list-group-item px-0 text-muted">No blogs yet.</li>
						@endforelse
					</ul>
				</div>
				@endif
				@if($team->hasPermission('project.view'))
				<div class="content-card mt-3">
					<h6 class="mb-3">Recent Projects</h6>
					<ul class="list-group list-group-flush">
						@forelse($recent['projects'] as $item)
							<li class="list-group-item px-0 d-flex justify-content-between">
								<span>{{ $item->title }}</span>
								<span class="text-muted small">{{ $item->created_at->diffForHumans() }}</span>
							</li>
						@empty
							<li class="list-group-item px-0 text-muted">No projects yet.</li>
						@endforelse
					</ul>
				</div>
				@endif
			</div>

			<div class="col-lg-6">
				@if($team->hasPermission('contact.view'))
				<div class="content-card">
					<h6 class="mb-3">Latest Contacts</h6>
					<ul class="list-group list-group-flush">
						@forelse($recent['contacts'] as $item)
							<li class="list-group-item px-0 d-flex justify-content-between align-items-start">
								<div class="me-2">
									<div class="fw-semibold">{{ $item->name }} <span class="text-muted">({{ $item->email }})</span></div>
									<div class="text-muted small">{{ \Illuminate\Support\Str::limit($item->subject ?? $item->message, 60) }}</div>
								</div>
								<div class="text-nowrap small text-muted">{{ $item->created_at->diffForHumans() }}</div>
							</li>
						@empty
							<li class="list-group-item px-0 text-muted">No messages yet.</li>
						@endforelse
					</ul>
				</div>
				@endif
				@if($team->hasPermission('research.view'))
				<div class="content-card mt-3">
					<h6 class="mb-3">Recent Research</h6>
					<ul class="list-group list-group-flush">
						@forelse($recent['research'] as $item)
							<li class="list-group-item px-0 d-flex justify-content-between">
								<span>{{ $item->title }}</span>
								<span class="text-muted small">{{ $item->created_at->diffForHumans() }}</span>
							</li>
						@empty
							<li class="list-group-item px-0 text-muted">No research yet.</li>
						@endforelse
					</ul>
				</div>
			</div>
			@endif
		</div>
	@else
		<div class="content-card">
			<h3 class="mb-2">Welcome, {{ $team->name }}!</h3>
			<p class="text-muted mb-0">You don’t have permission to view the dashboard. Please contact an administrator if you need access.</p>
		</div>
	@endif
</div>
@endsection
