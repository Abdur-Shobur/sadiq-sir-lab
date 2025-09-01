@extends('layouts.team-dashboard')

@section('title', 'Team Dashboard')

@section('content')
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Team Dashboard</h1>
</div>

<!-- Content Row -->
<div class="row">
    <!-- Welcome Card -->
    <div class="col-xl-12 col-md-12 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            Welcome Back!
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                            {{ $team->name }} - {{ $team->designation }}
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-user fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Content Row -->
<div class="row">
    <!-- Profile Information -->
    <div class="col-xl-6 col-lg-7">
        <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Profile Information</h6>
                <a href="{{ route('team.profile') }}" class="btn btn-sm btn-primary">
                    <i class="fas fa-edit"></i> Edit Profile
                </a>
            </div>
            <!-- Card Body -->
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4 text-center">
                        <img src="{{ $team->image_url }}" alt="{{ $team->name }}"
                             class="img-fluid rounded-circle mb-3" style="width: 100px; height: 100px; object-fit: cover;">
                    </div>
                    <div class="col-md-8">
                        <h5>{{ $team->name }}</h5>
                        <p class="text-muted">{{ $team->designation }}</p>
                        <p><strong>Email:</strong> {{ $team->email }}</p>
                        @if($team->phone)
                            <p><strong>Phone:</strong> {{ $team->phone }}</p>
                        @endif
                        @if($team->website)
                            <p><strong>Website:</strong> <a href="{{ $team->website }}" target="_blank">{{ $team->website }}</a></p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Stats -->
    <div class="col-xl-6 col-lg-5">
        <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Quick Information</h6>
            </div>
            <!-- Card Body -->
            <div class="card-body">
                @if($team->specialities)
                    <div class="mb-3">
                        <h6 class="font-weight-bold">Specialities:</h6>
                        @foreach($team->specialities as $speciality)
                            <span class="badge badge-primary mr-1 mb-1">{{ $speciality }}</span>
                        @endforeach
                    </div>
                @endif

                @if($team->education)
                    <div class="mb-3">
                        <h6 class="font-weight-bold">Education:</h6>
                        <ul class="list-unstyled">
                            @foreach($team->education as $education)
                                <li><i class="fas fa-graduation-cap text-primary mr-2"></i>{{ $education }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @if($team->social_media)
                    <div class="mb-3">
                        <h6 class="font-weight-bold">Social Media:</h6>
                        @foreach($team->social_media as $social)
                            <a href="{{ $social['url'] }}" target="_blank" class="btn btn-outline-primary btn-sm mr-2 mb-2">
                                <i class="fab fa-{{ strtolower($social['platform']) }}"></i> {{ $social['platform'] }}
                            </a>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

<!-- Content Row -->
<div class="row">
    <!-- Recent Activity -->
    <div class="col-xl-12">
        <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Welcome to Your Team Dashboard</h6>
            </div>
            <!-- Card Body -->
            <div class="card-body">
                <p>Welcome to your team dashboard! Here you can:</p>
                <ul>
                    <li>View and update your profile information</li>
                    <li>Manage your specialities, education, and experience</li>
                    <li>Update your contact information and social media links</li>
                    <li>Change your password</li>
                </ul>
                <p>Use the navigation menu on the left to access different sections of your dashboard.</p>
            </div>
        </div>
    </div>
</div>
@endsection
