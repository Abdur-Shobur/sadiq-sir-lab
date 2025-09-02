@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
    <!-- Page Header -->
    <div class="page-header">
        <h1 class="page-title">Dashboard</h1>
        <p class="page-subtitle">Welcome back, {{ Auth::user()->name }}! Here's what's happening with your account today.</p>
    </div>

    <!-- Welcome Card -->
    <div class="content-card">
        <div class="row align-items-center">
            <div class="col-md-8">
                <h3>Dashboard Overview</h3>
                <p class="text-muted mb-0">
                    Manage your laboratory's projects, publications, team members, and events from this central dashboard.
                </p>
            </div>
            <div class="col-md-4 text-end">
                <i class="fas fa-flask" style="font-size: 4rem; color: var(--primary-color); opacity: 0.3;"></i>
            </div>
        </div>
    </div>

    <!-- Stats -->
    <div class="row">
        <div class="col-md-3">
            <div class="content-card">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <div class="text-muted">Projects</div>
                        <div class="h4 mb-0">{{ $stats['projects']['active'] }} / {{ $stats['projects']['total'] }}</div>
                    </div>
                    <i class="fas fa-diagram-project text-primary" style="font-size: 1.8rem;"></i>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="content-card">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <div class="text-muted">Blogs</div>
                        <div class="h4 mb-0">{{ $stats['blogs']['active'] }} / {{ $stats['blogs']['total'] }}</div>
                    </div>
                    <i class="fas fa-blog text-success" style="font-size: 1.8rem;"></i>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="content-card">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <div class="text-muted">Team Members</div>
                        <div class="h4 mb-0">{{ $stats['teams']['active'] }} / {{ $stats['teams']['total'] }}</div>
                    </div>
                    <i class="fas fa-users text-info" style="font-size: 1.8rem;"></i>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="content-card">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <div class="text-muted">Messages</div>
                        <div class="h4 mb-0">{{ $stats['messages']['unread'] }} unread</div>
                    </div>
                    <i class="fas fa-inbox text-danger" style="font-size: 1.8rem;"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- More stats -->
    <div class="row">
        <div class="col-md-3">
            <div class="content-card">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <div class="text-muted">Events</div>
                        <div class="h5 mb-0">{{ $stats['events']['active'] }} / {{ $stats['events']['total'] }}</div>
                    </div>
                    <i class="fas fa-calendar-days text-warning" style="font-size: 1.6rem;"></i>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="content-card">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <div class="text-muted">News</div>
                        <div class="h5 mb-0">{{ $stats['news']['active'] }} / {{ $stats['news']['total'] }}</div>
                    </div>
                    <i class="fas fa-newspaper text-secondary" style="font-size: 1.6rem;"></i>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="content-card">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <div class="text-muted">Publications</div>
                        <div class="h5 mb-0">{{ $stats['publications']['active'] }}</div>
                    </div>
                    <i class="fas fa-book text-dark" style="font-size: 1.6rem;"></i>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="content-card">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <div class="text-muted">Social Links</div>
                        <div class="h5 mb-0">{{ $stats['social']['active'] }} active</div>
                    </div>
                    <i class="fas fa-share-nodes text-primary" style="font-size: 1.6rem;"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent items -->
    <div class="row">
        <div class="col-lg-8">
            <div class="content-card">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 class="mb-0">Recent Blogs</h5>
                    <a href="{{ route('dashboard.blogs.index') }}" class="btn btn-sm btn-outline-primary">View all</a>
                </div>
                <div class="table-responsive">
                    <table class="table align-middle mb-0">
                        <thead>
                            <tr>
                                <th>Title</th>
                                <th>Category</th>
                                <th>Created</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($recentBlogs as $blog)
                                <tr>
                                    <td>{{ $blog->title }}</td>
                                    <td>{{ optional($blog->category)->name ?? '—' }}</td>
                                    <td>{{ $blog->created_at->diffForHumans() }}</td>
                                    <td>
                                        @if($blog->status)
                                            <span class="badge bg-success">Active</span>
                                        @else
                                            <span class="badge bg-secondary">Inactive</span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr><td colspan="4" class="text-center text-muted">No blogs found.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="content-card mt-3">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 class="mb-0">Recent Projects</h5>
                    <a href="{{ route('dashboard.projects.index') }}" class="btn btn-sm btn-outline-primary">View all</a>
                </div>
                <div class="table-responsive">
                    <table class="table align-middle mb-0">
                        <thead>
                            <tr>
                                <th>Title</th>
                                <th>Category</th>
                                <th>Created</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($recentProjects as $project)
                                <tr>
                                    <td>{{ $project->title }}</td>
                                    <td>{{ optional($project->category)->name ?? '—' }}</td>
                                    <td>{{ $project->created_at->diffForHumans() }}</td>
                                    <td>
                                        @if($project->is_active)
                                            <span class="badge bg-success">Active</span>
                                        @else
                                            <span class="badge bg-secondary">Inactive</span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr><td colspan="4" class="text-center text-muted">No projects found.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="content-card h-100">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 class="mb-0">Latest Messages</h5>
                    <a href="{{ route('dashboard.contact-messages.index') }}" class="btn btn-sm btn-outline-primary">View all</a>
                </div>
                <ul class="list-group list-group-flush">
                    @forelse($recentMessages as $message)
                        <li class="list-group-item px-0 d-flex justify-content-between align-items-start">
                            <div class="me-2">
                                <div class="fw-semibold">{{ $message->name }} <span class="text-muted">({{ $message->email }})</span></div>
                                <div class="text-muted small">{{ \Illuminate\Support\Str::limit($message->subject ?? $message->message, 60) }}</div>
                                <div class="small">{!! $message->status_badge !!}</div>
                            </div>
                            <div class="text-nowrap small text-muted">{{ $message->created_at->diffForHumans() }}</div>
                        </li>
                    @empty
                        <li class="list-group-item px-0 text-muted">No messages yet.</li>
                    @endforelse
                </ul>
            </div>
        </div>
    </div>
@endsection
