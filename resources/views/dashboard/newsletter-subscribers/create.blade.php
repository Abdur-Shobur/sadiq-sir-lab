@extends('layouts.admin')

@section('title', 'Add Newsletter Subscriber')

@section('content')
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Add Newsletter Subscriber</h1>
    <a href="{{ route('dashboard.newsletter-subscribers.index') }}" class="btn btn-secondary btn-sm">
        <i class="fas fa-arrow-left"></i> Back to List
    </a>
</div>

<div class="row">
    <div class="col-lg-8">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Add New Subscriber</h6>
            </div>
            <div class="card-body">
                <form action="{{ route('dashboard.newsletter-subscribers.store') }}" method="POST">
                    @csrf

                    <div class="form-group mb-3">
                        <label for="email">Email Address *</label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror"
                               id="email" name="email" value="{{ old('email') }}" required
                               placeholder="Enter email address">
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="form-text text-muted">
                            This email will be automatically subscribed to the newsletter.
                        </small>
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-plus"></i> Add Subscriber
                        </button>
                        <a href="{{ route('dashboard.newsletter-subscribers.index') }}" class="btn btn-secondary">
                            Cancel
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Information</h6>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <h6 class="text-primary">What happens when you add a subscriber?</h6>
                    <ul class="list-unstyled">
                        <li><i class="fas fa-check text-success me-2"></i>Email is added to the newsletter list</li>
                        <li><i class="fas fa-check text-success me-2"></i>Status is set to "Active" by default</li>
                        <li><i class="fas fa-check text-success me-2"></i>Subscribed timestamp is recorded</li>
                        <li><i class="fas fa-check text-success me-2"></i>Email can receive future newsletters</li>
                    </ul>
                </div>

                <div class="alert alert-info">
                    <i class="fas fa-info-circle me-2"></i>
                    <strong>Note:</strong> The subscriber will be automatically marked as active and can receive newsletters immediately.
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
