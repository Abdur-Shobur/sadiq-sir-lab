@extends('layouts.admin')

@section('title', 'View About Section')

@section('content')
<div class="container-fluid mt-4">
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('dashboard.abouts.index') }}">About Sections</a></li>
            <li class="breadcrumb-item active" aria-current="page">View About Section</li>
        </ol>
    </nav>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4>About Section Details</h4>
                    <div>
                        <a href="{{ route('dashboard.abouts.edit', $about) }}" class="btn btn-primary">Edit</a>
                        <a href="{{ route('dashboard.abouts.index') }}" class="btn btn-secondary">Back to List</a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-8">
                            <table class="table table-borderless">
                                <tr>
                                    <th width="150">Title:</th>
                                    <td>{{ $about->title }}</td>
                                </tr>
                                <tr>
                                    <th>Subtitle:</th>
                                    <td>{{ $about->subtitle }}</td>
                                </tr>
                                <tr>
                                    <th>Description:</th>
                                    <td>{{ $about->description }}</td>
                                </tr>
                                <tr>
                                    <th>Features:</th>
                                    <td>
                                        @if(is_array($about->features) && count($about->features) > 0)
                                            <ul class="list-unstyled mb-0">
                                                @foreach($about->features as $feature)
                                                    <li><i class="fas fa-check text-success me-2"></i>{{ $feature }}</li>
                                                @endforeach
                                            </ul>
                                        @else
                                            <span class="text-muted">No features added</span>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>Status:</th>
                                    <td>
                                        @if($about->is_active)
                                            <span class="badge bg-success">Active</span>
                                        @else
                                            <span class="badge bg-secondary">Inactive</span>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>Created:</th>
                                    <td>{{ $about->created_at->format('F d, Y \a\t g:i A') }}</td>
                                </tr>
                                <tr>
                                    <th>Last Updated:</th>
                                    <td>{{ $about->updated_at->format('F d, Y \a\t g:i A') }}</td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-header">
                                    <h6>Image</h6>
                                </div>
                                <div class="card-body text-center">
                                    @if($about->image)
                                        <img src="{{ asset('storage/' . $about->image) }}" 
                                             alt="{{ $about->title }}" 
                                             class="img-fluid" 
                                             style="max-width: 100%; border-radius: 10px;">
                                    @else
                                        <div class="text-muted">
                                            <i class="fas fa-image fa-3x mb-2"></i>
                                            <p>No image uploaded</p>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mt-4">
                        <h5>Preview</h5>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="about-image">
                                    @if($about->image)
                                        <img src="{{ asset('storage/' . $about->image) }}" alt="{{ $about->title }}" />
                                    @else
                                        <img src="{{ asset('assets/img/about-img1.png') }}" alt="Default About Image" />
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="about-content">
                                    <span>About Us</span>
                                    <h2>{{ $about->title }}</h2>
                                    <p>{{ $about->description }}</p>

                                    @if(is_array($about->features) && count($about->features) > 0)
                                        <ul class="about-features-list">
                                            @foreach($about->features as $feature)
                                                <li><i class="flaticon-check-mark"></i> {{ $feature }}</li>
                                            @endforeach
                                        </ul>
                                    @endif
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
