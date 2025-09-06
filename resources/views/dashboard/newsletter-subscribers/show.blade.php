@extends('layouts.admin')

@section('title', 'Subscriber Details')

@section('content')
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4 gap-2">
    <h1 class="h3 mb-0 text-gray-800">Subscriber Details</h1>
    <div>
        <a href="{{ route('dashboard.newsletter-subscribers.edit', $newsletterSubscriber) }}" class="btn btn-primary btn-sm">
            <i class="fas fa-edit"></i> Edit
        </a>
        <a href="{{ route('dashboard.newsletter-subscribers.index') }}" class="btn btn-secondary btn-sm">
            <i class="fas fa-arrow-left"></i> Back to List
        </a>
    </div>
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
                <h6 class="m-0 font-weight-bold text-primary">Subscriber Information</h6>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <strong>Email Address:</strong><br>
                            <span class="text-primary">{{ $newsletterSubscriber->email }}</span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <strong>Status:</strong><br>
                            <span class="badge badge-{{ $newsletterSubscriber->status === 'active' ? 'success' : ($newsletterSubscriber->status === 'inactive' ? 'warning' : 'danger') }}">
                                {{ ucfirst($newsletterSubscriber->status) }}
                            </span>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <strong>Subscriber ID:</strong><br>
                            #{{ $newsletterSubscriber->id }}
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <strong>Created:</strong><br>
                            {{ $newsletterSubscriber->created_at->format('M j, Y g:i A') }}
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <strong>Subscribed At:</strong><br>
                            {{ $newsletterSubscriber->subscribed_at?->format('M j, Y g:i A') ?? 'N/A' }}
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <strong>Last Updated:</strong><br>
                            {{ $newsletterSubscriber->updated_at->format('M j, Y g:i A') }}
                        </div>
                    </div>
                </div>

                @if($newsletterSubscriber->unsubscribed_at)
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <strong>Unsubscribed At:</strong><br>
                                <span class="text-danger">{{ $newsletterSubscriber->unsubscribed_at->format('M j, Y g:i A') }}</span>
                            </div>
                        </div>
                    </div>
                @endif

                <hr>

                <div class="d-flex gap-2">
                    <a href="{{ route('dashboard.newsletter-subscribers.edit', $newsletterSubscriber) }}" class="btn btn-primary">
                        <i class="fas fa-edit"></i>
                        <span class="d-none d-lg-inline-block">Edit</span>
                    </a>

                    @if($newsletterSubscriber->status !== 'active')
                        <form action="{{ route('dashboard.newsletter-subscribers.update-status', $newsletterSubscriber) }}" method="POST" class="d-inline">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="status" value="active">
                            <button type="submit" class="btn btn-success" onclick="return confirm('Mark as active?')">
                                <i class="fas fa-check"></i>
                                <span class="d-none d-lg-inline-block">Mark as Active</span>
                            </button>
                        </form>
                    @endif

                    @if($newsletterSubscriber->status !== 'inactive')
                        <form action="{{ route('dashboard.newsletter-subscribers.update-status', $newsletterSubscriber) }}" method="POST" class="d-inline">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="status" value="inactive">
                            <button type="submit" class="btn btn-warning" onclick="return confirm('Mark as inactive?')">
                                <i class="fas fa-pause"></i>
                                <span class="d-none d-lg-inline-block">Mark as Inactive</span>
                            </button>
                        </form>
                    @endif

                    @if($newsletterSubscriber->status !== 'unsubscribed')
                        <form action="{{ route('dashboard.newsletter-subscribers.update-status', $newsletterSubscriber) }}" method="POST" class="d-inline">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="status" value="unsubscribed">
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Mark as unsubscribed?')">
                                <i class="fas fa-times"></i>
                                <span class="d-none d-lg-inline-block">Mark as Unsubscribed</span>
                            </button>
                        </form>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Quick Actions</h6>
            </div>
            <div class="card-body">
                <div class="d-grid gap-2">
                    <a href="{{ route('dashboard.newsletter-subscribers.edit', $newsletterSubscriber) }}" class="btn btn-primary">
                        <i class="fas fa-edit me-2"></i>
                        <span class="d-none d-lg-inline-block">Edit</span>
                    </a>

                    <a href="{{ route('dashboard.newsletter-subscribers.index') }}" class="btn btn-secondary">
                        <i class="fas fa-list me-2"></i>
                        <span class="d-none d-lg-inline-block">View All</span>
                    </a>

                    <a href="{{ route('dashboard.newsletter-subscribers.create') }}" class="btn btn-success">
                        <i class="fas fa-plus me-2"></i>
                        <span class="d-none d-lg-inline-block">Add New</span>
                    </a>
                </div>
            </div>
        </div>

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Status Information</h6>
            </div>
            <div class="card-body">
                <div class="mb-2">
                    <strong>Active:</strong> Can receive newsletters
                </div>
                <div class="mb-2">
                    <strong>Inactive:</strong> Temporarily paused
                </div>
                <div class="mb-2">
                    <strong>Unsubscribed:</strong> Opted out
                </div>

                <hr>

                <div class="alert alert-info">
                    <i class="fas fa-info-circle me-2"></i>
                    <strong>Current Status:</strong> {{ ucfirst($newsletterSubscriber->status) }}
                </div>
            </div>
        </div>

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Danger Zone</h6>
            </div>
            <div class="card-body">
                <form action="{{ route('dashboard.newsletter-subscribers.destroy', $newsletterSubscriber) }}" method="POST" class="d-grid">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this subscriber? This action cannot be undone.')">
                        <i class="fas fa-trash me-2"></i>Delete Subscriber
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
