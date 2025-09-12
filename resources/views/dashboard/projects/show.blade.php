@extends('layouts.admin')

@section('title', 'View Project')

@section('content')
<div  >
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('dashboard.projects.index') }}">Projects</a></li>
            <li class="breadcrumb-item active" aria-current="page">View Project</li>
        </ol>
    </nav>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header gap-2 d-flex justify-content-between align-items-center">
                    <h4>Project Details</h4>
                    <div class="d-flex gap-2">
                        <a href="{{ route('dashboard.projects.edit', $project) }}" class="btn btn-warning">
                            <i class="fas fa-edit"></i>
                            <span class="d-none d-lg-inline-block">Edit</span>
                        </a>
                        <a href="{{ route('dashboard.projects.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i>
                            <span class="d-none d-lg-inline-block">Back</span>
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-8">
                            <h2>{{ $project->title }}</h2>
                            @if($project->subtitle)
                                <h5 class="text-muted">{{ $project->subtitle }}</h5>
                            @endif

                            <div class="row mt-4">
                                <div class="col-md-6">
                                    <p><strong>Category:</strong>
                                        <span class="badge bg-info">{{ $project->category->name }}</span>
                                    </p>
                                    <p><strong>Status:</strong>
                                        @if($project->is_active)
                                            <span class="badge bg-success">Active</span>
                                        @else
                                            <span class="badge bg-secondary">Inactive</span>
                                        @endif
                                    </p>
                                </div>
                                <div class="col-md-6">
                                    <p><strong>Created:</strong> {{ $project->created_at->format('F d, Y H:i') }}</p>
                                    <p><strong>Last Updated:</strong> {{ $project->updated_at->format('F d, Y H:i') }}</p>
                                </div>
                            </div>

                            <div class="mt-4">
                                <h5>Content</h5>
                                <div class="border rounded p-3 bg-light">
                                    {!! $project->content !!}
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            @if($project->image)
                                <div class="card">
                                    <div class="card-header">
                                        <h6>Project Image</h6>
                                    </div>
                                    <div class="card-body">
                                        <img src="{{ asset('uploads/'.$project->image) }}"
                                             alt="{{ $project->title }}"
                                             style="max-width: 100%; height: auto; border-radius: 5px;">
                                    </div>
                                </div>
                            @endif

                            <div class="card mt-3">
                                <div class="card-header">
                                    <h6>Project Info</h6>
                                </div>
                                <div class="card-body">
                                    <p><strong>ID:</strong> {{ $project->id }}</p>
                                    <p><strong>Title:</strong> {{ $project->title }}</p>
                                    @if($project->subtitle)
                                        <p><strong>Subtitle:</strong> {{ $project->subtitle }}</p>
                                    @endif
                                    <p><strong>Category:</strong> {{ $project->category->name }}</p>
                                    <p><strong>Status:</strong>
                                        @if($project->is_active)
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
