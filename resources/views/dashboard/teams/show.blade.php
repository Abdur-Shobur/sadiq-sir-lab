@extends('layouts.admin')

@section('content')
<div >
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0 text-gray-800">Team Details</h1>
        <div>
            <a href="{{ route('dashboard.teams.edit', $team) }}" class="btn btn-warning">
                <i class="fas fa-edit"></i>
                <span class="d-none d-lg-inline-block">Edit</span>
            </a>
            <a href="{{ route('dashboard.teams.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i>
                <span class="d-none d-lg-inline-block">Back to List</span>
            </a>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Profile Information</h6>
                </div>
                <div class="card-body text-center">
                    <img src="{{ $team->image_url }}" alt="{{ $team->name }}"
                         class="img-fluid rounded-circle mb-3" style="width: 150px; height: 150px; object-fit: cover;">
                    <h4>{{ $team->name }}</h4>
                    <p class="text-muted">{{ $team->designation }}</p>
                    <span class="badge badge-{{ $team->role === 'admin' ? 'danger' : 'info' }} mb-2">
                        {{ ucfirst($team->role) }}
                    </span>
                    <div class="mt-3">
                        <span class="badge badge-{{ $team->is_active ? 'success' : 'secondary' }}">
                            {{ $team->is_active ? 'Active' : 'Inactive' }}
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-8">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Contact Information</h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <p><strong>Email:</strong> {{ $team->email }}</p>
                            <p><strong>Phone:</strong> {{ $team->phone ?: 'Not provided' }}</p>
                        </div>
                        <div class="col-md-6">
                            <p><strong>Website:</strong>
                                @if($team->website)
                                    <a href="{{ $team->website }}" target="_blank">{{ $team->website }}</a>
                                @else
                                    Not provided
                                @endif
                            </p>
                        </div>
                    </div>
                    @if($team->address)
                        <p><strong>Address:</strong> {{ $team->address }}</p>
                    @endif
                </div>
            </div>

            @if($team->specialities)
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Specialities</h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        @foreach($team->specialities as $speciality)
                            <div class="col-md-6">
                                <span class="badge badge-primary mr-2 mb-2">{{ $speciality }}</span>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            @endif

            @if($team->education)
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Education</h6>
                </div>
                <div class="card-body">
                    <ul class="list-unstyled">
                        @foreach($team->education as $education)
                            <li class="mb-2"><i class="fas fa-graduation-cap text-primary mr-2"></i>{{ $education }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
            @endif

            @if($team->experience)
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Experience</h6>
                </div>
                <div class="card-body">
                    <ul class="list-unstyled">
                        @foreach($team->experience as $experience)
                            <li class="mb-2"><i class="fas fa-briefcase text-primary mr-2"></i>{{ $experience }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
            @endif

            @if($team->social_media)
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Social Media</h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        @foreach($team->social_media as $social)
                            <div class="col-md-6 mb-2">
                                <a href="{{ $social['url'] }}" target="_blank" class="btn btn-outline-primary btn-sm">
                                    <i class="fab fa-{{ strtolower($social['platform']) }}"></i> {{ $social['platform'] }}
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection
