@extends('layouts.admin')

@section('title', 'Edit Newsletter Subscriber')

@section('content')
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Edit Newsletter Subscriber</h1>
    <a href="{{ route('dashboard.newsletter-subscribers.index') }}" class="btn btn-secondary btn-sm">
        <i class="fas fa-arrow-left"></i> Back to List
    </a>
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
                <h6 class="m-0 font-weight-bold text-primary">Edit Subscriber Information</h6>
            </div>
            <div class="card-body">
                <form action="{{ route('dashboard.newsletter-subscribers.update', $newsletterSubscriber) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="form-group mb-3">
                        <label for="email">Email Address *</label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror"
                               id="email" name="email" value="{{ old('email', $newsletterSubscriber->email) }}" required>
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label for="status">Status *</label>
                        <select class="form-control @error('status') is-invalid @enderror" id="status" name="status" required>
                            <option value="active" {{ old('status', $newsletterSubscriber->status) === 'active' ? 'selected' : '' }}>
                                Active - Can receive newsletters
                            </option>
                            <option value="inactive" {{ old('status', $newsletterSubscriber->status) === 'inactive' ? 'selected' : '' }}>
                                Inactive - Temporarily paused
                            </option>
                            <option value="unsubscribed" {{ old('status', $newsletterSubscriber->status) === 'unsubscribed' ? 'selected' : '' }}>
                                Unsubscribed - No longer receives newsletters
                            </option>
                        </select>
                        @error('status')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Update Subscriber
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
                <h6 class="m-0 font-weight-bold text-primary">Subscriber Details</h6>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <strong>ID:</strong> {{ $newsletterSubscriber->id }}
                </div>

                <div class="mb-3">
                    <strong>Current Status:</strong>
                    <span class="badge badge-{{ $newsletterSubscriber->status === 'active' ? 'success' : ($newsletterSubscriber->status === 'inactive' ? 'warning' : 'danger') }}">
                        {{ ucfirst($newsletterSubscriber->status) }}
                    </span>
                </div>

                <div class="mb-3">
                    <strong>Subscribed At:</strong><br>
                    {{ $newsletterSubscriber->subscribed_at?->format('M j, Y g:i A') ?? 'N/A' }}
                </div>

                @if($newsletterSubscriber->unsubscribed_at)
                    <div class="mb-3">
                        <strong>Unsubscribed At:</strong><br>
                        {{ $newsletterSubscriber->unsubscribed_at->format('M j, Y g:i A') }}
                    </div>
                @endif

                <div class="mb-3">
                    <strong>Created At:</strong><br>
                    {{ $newsletterSubscriber->created_at->format('M j, Y g:i A') }}
                </div>

                <div class="mb-3">
                    <strong>Last Updated:</strong><br>
                    {{ $newsletterSubscriber->updated_at->format('M j, Y g:i A') }}
                </div>
            </div>
        </div>

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Status Information</h6>
            </div>
            <div class="card-body">
                <div class="mb-2">
                    <strong>Active:</strong> Subscriber can receive newsletters
                </div>
                <div class="mb-2">
                    <strong>Inactive:</strong> Subscriber is temporarily paused
                </div>
                <div class="mb-2">
                    <strong>Unsubscribed:</strong> Subscriber has opted out
                </div>

                <hr>

                <div class="alert alert-info">
                    <i class="fas fa-info-circle me-2"></i>
                    <strong>Note:</strong> Changing status will automatically update the relevant timestamps.
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
