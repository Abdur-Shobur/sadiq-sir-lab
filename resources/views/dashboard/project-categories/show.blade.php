@extends('layouts.admin')

@section('title', 'View Project Category')

@section('content')
<div  >
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('dashboard.project-categories.index') }}">Project Categories</a></li>
            <li class="breadcrumb-item active" aria-current="page">View Category</li>
        </ol>
    </nav>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header gap-2 d-flex justify-content-between align-items-center">
                    <h4>Category Details</h4>
                    <div class="d-flex gap-2">
                        <a href="{{ route('dashboard.project-categories.edit', $projectCategory) }}" class="btn btn-warning">
                            <i class="fas fa-edit"></i>
                            <span class="d-none d-lg-inline-block">Edit</span>
                        </a>
                        <a href="{{ route('dashboard.project-categories.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i>
                            <span class="d-none d-lg-inline-block">Back</span>
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-8">
                            <h2>{{ $projectCategory->name }}</h2>

                            <div class="row mt-4">
                                <div class="col-md-6">
                                    <p><strong>Status:</strong>
                                        @if($projectCategory->is_active)
                                            <span class="badge bg-success">Active</span>
                                        @else
                                            <span class="badge bg-secondary">Inactive</span>
                                        @endif
                                    </p>
                                </div>
                                <div class="col-md-6">
                                    <p><strong>Created:</strong> {{ $projectCategory->created_at->format('F d, Y H:i') }}</p>
                                    <p><strong>Last Updated:</strong> {{ $projectCategory->updated_at->format('F d, Y H:i') }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-header">
                                    <h6>Category Info</h6>
                                </div>
                                <div class="card-body">
                                    <p><strong>ID:</strong> {{ $projectCategory->id }}</p>
                                    <p><strong>Name:</strong> {{ $projectCategory->name }}</p>
                                    <p><strong>Status:</strong>
                                        @if($projectCategory->is_active)
                                            <span class="badge bg-success">Active</span>
                                        @else
                                            <span class="badge bg-secondary">Inactive</span>
                                        @endif
                                    </p>
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
