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

    <!-- Stats Grid -->
    <div class="row">
        <div class="col-lg-3 col-md-6 mb-4">
            <div class="content-card text-center">
                <div class="stat-icon users mx-auto mb-3">
                    <i class="fas fa-users"></i>
                </div>
                <h4 class="mb-2">25</h4>
                <p class="text-muted mb-0">Team Members</p>
            </div>
        </div>

        <div class="col-lg-3 col-md-6 mb-4">
            <div class="content-card text-center">
                <div class="stat-icon projects mx-auto mb-3">
                    <i class="fas fa-project-diagram"></i>
                </div>
                <h4 class="mb-2">12</h4>
                <p class="text-muted mb-0">Active Projects</p>
            </div>
        </div>

        <div class="col-lg-3 col-md-6 mb-4">
            <div class="content-card text-center">
                <div class="stat-icon publications mx-auto mb-3">
                    <i class="fas fa-file-alt"></i>
                </div>
                <h4 class="mb-2">{{ \App\Models\Publication::count() }}</h4>
                <p class="text-muted mb-0">Publications</p>
            </div>
        </div>

        <div class="col-lg-3 col-md-6 mb-4">
            <div class="content-card text-center">
                <div class="stat-icon messages mx-auto mb-3">
                    <i class="fas fa-envelope"></i>
                </div>
                <h4 class="mb-2">{{ \App\Models\ContactMessage::unread()->count() }}</h4>
                <p class="text-muted mb-0">Unread Messages</p>
            </div>
        </div>
    </div>

    <!-- Quick Actions & Recent Activity -->
    <div class="row">
        <div class="col-lg-6 mb-4">
            <div class="content-card">
                <h5 class="mb-3"><i class="fas fa-bolt me-2"></i>Quick Actions</h5>
                <div class="d-grid gap-2">
                    <a href="{{ route('dashboard.contact-messages.index') }}" class="btn btn-outline-warning">
                        <i class="fas fa-envelope me-2"></i>View Contact Messages
                    </a>
                    <a href="{{ route('dashboard.banners.index') }}" class="btn btn-outline-primary">
                        <i class="fas fa-image me-2"></i>Manage Banners
                    </a>
                    <a href="{{ route('dashboard.research-areas.index') }}" class="btn btn-outline-success">
                        <i class="fas fa-flask me-2"></i>Manage Research Areas
                    </a>
                    <a href="{{ route('dashboard.ctas.index') }}" class="btn btn-outline-info">
                        <i class="fas fa-phone-alt me-2"></i>Manage CTA Section
                    </a>
                    <a href="{{ route('dashboard.publications.edit') }}" class="btn btn-outline-secondary">
                        <i class="fas fa-file-alt me-2"></i>Edit Publications
                    </a>
                </div>
            </div>
        </div>

        <div class="col-lg-6 mb-4">
            <div class="content-card">
                <h5 class="mb-3"><i class="fas fa-chart-line me-2"></i>Recent Activity</h5>
                <div class="d-flex align-items-center mb-3">
                    <div class="bg-success rounded-circle p-2 me-3">
                        <i class="fas fa-check text-white"></i>
                    </div>
                    <div>
                        <strong>New publication published</strong>
                        <br><small class="text-muted">2 hours ago</small>
                    </div>
                </div>
                <div class="d-flex align-items-center mb-3">
                    <div class="bg-info rounded-circle p-2 me-3">
                        <i class="fas fa-user-plus text-white"></i>
                    </div>
                    <div>
                        <strong>New team member added</strong>
                        <br><small class="text-muted">1 day ago</small>
                    </div>
                </div>
                <div class="d-flex align-items-center">
                    <div class="bg-warning rounded-circle p-2 me-3">
                        <i class="fas fa-calendar text-white"></i>
                    </div>
                    <div>
                        <strong>Event scheduled</strong>
                        <br><small class="text-muted">3 days ago</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
