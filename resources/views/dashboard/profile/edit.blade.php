@extends('layouts.admin')

@section('title', 'My Profile')

@section('content')
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">My Profile</h1>
</div>

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<div class="row">
    <div class="col-lg-8">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Edit Profile Information</h6>
            </div>
            <div class="card-body">
                <form action="{{ route('dashboard.profile.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="name">Name *</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror"
                                       id="name" name="name" value="{{ old('name', $user->name) }}" required>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="email">Email *</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror"
                                       id="email" name="email" value="{{ old('email', $user->email) }}" required>
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="phone">Phone</label>
                                <input type="text" class="form-control @error('phone') is-invalid @enderror"
                                       id="phone" name="phone" value="{{ old('phone', $user->phone) }}">
                                @error('phone')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="profile_image">Profile Image</label>
                                @if($user->profile_image)
                                    <div class="mb-2">
                                        <img src="{{ $user->profile_image_url }}" alt="Current Profile Image" class="img-thumbnail" width="100">
                                    </div>
                                @endif
                                <input type="file" class="form-control-file @error('profile_image') is-invalid @enderror"
                                       id="profile_image" name="profile_image" accept="image/*">
                                @error('profile_image')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="form-group mb-3">
                        <label for="address">Address</label>
                        <textarea class="form-control @error('address') is-invalid @enderror"
                                  id="address" name="address" rows="2">{{ old('address', $user->address) }}</textarea>
                        @error('address')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label for="bio">Bio</label>
                        <textarea class="form-control @error('bio') is-invalid @enderror"
                                  id="bio" name="bio" rows="3" placeholder="Tell us about yourself...">{{ old('bio', $user->bio) }}</textarea>
                        @error('bio')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <hr class="my-4">
                    <h6 class="text-primary mb-3">Change Password</h6>
                    <p class="text-muted small">Leave password fields empty if you don't want to change your password.</p>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="current_password">Current Password</label>
                                <input type="password" class="form-control @error('current_password') is-invalid @enderror"
                                       id="current_password" name="current_password">
                                @error('current_password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="new_password">New Password</label>
                                <input type="password" class="form-control @error('new_password') is-invalid @enderror"
                                       id="new_password" name="new_password">
                                @error('new_password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="new_password_confirmation">Confirm New Password</label>
                                <input type="password" class="form-control"
                                       id="new_password_confirmation" name="new_password_confirmation">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Update Profile
                        </button>
                        <a href="{{ route('dashboard') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Back to Dashboard
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Profile Information</h6>
            </div>
            <div class="card-body">
                <div class="text-center mb-3">
                    @if($user->profile_image)
                        <img src="{{ $user->profile_image_url }}" alt="Profile Image" class="rounded-circle mb-3" width="80" height="80" style="object-fit: cover;">
                    @else
                        <div class="user-avatar-large mx-auto mb-3">
                            {{ strtoupper(substr($user->name, 0, 1)) }}
                        </div>
                    @endif
                    <h5 class="mb-1">{{ $user->name }}</h5>
                    <p class="text-muted mb-0">{{ $user->email }}</p>
                    @if($user->phone)
                        <p class="text-muted mb-0"><i class="fas fa-phone me-1"></i>{{ $user->phone }}</p>
                    @endif
                </div>

                @if($user->bio)
                    <hr>
                    <div class="mb-3">
                        <small class="text-muted">Bio:</small>
                        <p class="mb-0">{{ $user->bio }}</p>
                    </div>
                @endif

                @if($user->address)
                    <hr>
                    <div class="mb-3">
                        <small class="text-muted">Address:</small>
                        <p class="mb-0">{{ $user->address }}</p>
                    </div>
                @endif

                <hr>

                <div class="mb-2">
                    <small class="text-muted">Member since:</small>
                    <div>{{ $user->created_at->format('F j, Y') }}</div>
                </div>

                @if($user->email_verified_at)
                    <div class="mb-2">
                        <small class="text-muted">Email verified:</small>
                        <div class="text-success">
                            <i class="fas fa-check-circle"></i> Verified
                        </div>
                    </div>
                @else
                    <div class="mb-2">
                        <small class="text-muted">Email verified:</small>
                        <div class="text-warning">
                            <i class="fas fa-exclamation-triangle"></i> Not verified
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

<style>
.user-avatar-large {
    width: 80px;
    height: 80px;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 2rem;
    font-weight: bold;
}
</style>
@endsection
