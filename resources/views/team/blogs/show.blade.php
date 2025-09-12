@extends('layouts.team-dashboard')

@section('title', 'Blog Details')

@section('content')
<div>
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('team.dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('team.blogs.index') }}">Blogs</a></li>
            <li class="breadcrumb-item active" aria-current="page">Blog Details</li>
        </ol>
    </nav>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4>Blog Details</h4>
                    <div>
                        @if(auth()->guard('team')->user()->hasPermission('blog.edit'))
                        <a href="{{ route('team.blogs.edit', $blog) }}" class="btn btn-warning">
                            <i class="fas fa-edit"></i> Edit
                        </a>
                        @endif
                        <a href="{{ route('team.blogs.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Back
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            @if($blog->image)
                                <img src="{{ $blog->image_url }}" alt="{{ $blog->title }}" class="img-fluid rounded">
                            @else
                                <img src="/assets/img/placeholder.svg" alt="No Image" class="img-fluid rounded">
                            @endif
                        </div>
                        <div class="col-md-8">
                            <h5>{{ $blog->title }}</h5>
                            <p class="text-muted">{{ $blog->excerpt }}</p>

                            <p><strong>Category:</strong> {{ $blog->category->name ?? 'No Category' }}</p>

                            <p><strong>Status:</strong>
                                <span class="badge {{ $blog->is_active ? 'bg-success' : 'bg-secondary' }}">
                                    {{ $blog->is_active ? 'Active' : 'Inactive' }}
                                </span>
                            </p>

                            <p><strong>Created:</strong> {{ $blog->created_at->format('M d, Y H:i') }}</p>
                            <p><strong>Updated:</strong> {{ $blog->updated_at->format('M d, Y H:i') }}</p>
                        </div>
                    </div>

                    <div class="mt-4">
                        <h6>Content:</h6>
                        <div class="border p-3 rounded">
                            {!! $blog->content !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
