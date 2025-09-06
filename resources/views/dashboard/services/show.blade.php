@extends('layouts.admin')

@section('title', 'View Service')

@section('content')
<div class="mt-4">
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('dashboard.services.index') }}">Services</a></li>
            <li class="breadcrumb-item active" aria-current="page">View Service</li>
        </ol>
    </nav>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4>Service Details</h4>
                    <div>
                        <a href="{{ route('dashboard.services.edit', $service) }}" class="btn btn-primary">
                            <i class="fas fa-edit"></i>
                            <span class="d-none d-lg-inline-block">Edit</span>
                        </a>
                        <a href="{{ route('dashboard.services.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i>
                            <span class="d-none d-lg-inline-block">Back to List</span>
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-8">
                           <div class="table-responsive" style="white-space:wrap;">
                             <table class="table table-borderless">
                                <tr>
                                    <th width="150">Title:</th>
                                    <td>{{ $service->title }}</td>
                                </tr>
                                <tr>
                                    <th>Description:</th>
                                    <td>{{ $service->description }}</td>
                                </tr>
                                <tr>
                                    <th>Icon:</th>
                                    <td>{{ $service->icon }}</td>
                                </tr>
                                <tr>
                                    <th>Background Color:</th>
                                    <td>
                                        <span class="badge" style="background-color: {{ $service->background_color }}; color: white;">
                                            {{ $service->background_color }}
                                        </span>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Display Order:</th>
                                    <td>{{ $service->order }}</td>
                                </tr>
                                <tr>
                                    <th>Status:</th>
                                    <td>
                                        @if($service->is_active)
                                            <span class="badge bg-success">Active</span>
                                        @else
                                            <span class="badge bg-secondary">Inactive</span>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>Created:</th>
                                    <td>{{ $service->created_at->format('F d, Y \a\t g:i A') }}</td>
                                </tr>
                                <tr>
                                    <th>Last Updated:</th>
                                    <td>{{ $service->updated_at->format('F d, Y \a\t g:i A') }}</td>
                                </tr>
                            </table>
                           </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-header">
                                    <h6>Icon Preview</h6>
                                </div>
                                <div class="card-body text-center">
                                    <div class="icon-display mb-3" style="width: 100px; height: 100px; border-radius: 50%; margin: 0 auto; display: flex; align-items: center; justify-content: center; background-color: {{ $service->background_color }};">
                                        <i class="{{ $service->icon }}" style="color: white; font-size: 40px;"></i>
                                    </div>
                                    <p class="text-muted small">{{ $service->icon }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mt-4">
                        <h5>Preview</h5>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="single-services-box">
                                    <div class="icon" style="background-color: {{ $service->background_color }};">
                                        <i class="{{ $service->icon }}"></i>
                                    </div>
                                    <h3>{{ $service->title }}</h3>
                                    <p>{{ $service->description }}</p>
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
