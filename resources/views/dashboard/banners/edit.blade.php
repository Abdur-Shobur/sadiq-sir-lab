@extends('layouts.admin')

@section('title', 'Edit Banner')

@section('content')
<div class="container mt-4">
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('dashboard.banners.index') }}">Banner Management</a></li>
            <li class="breadcrumb-item active" aria-current="page">Edit Banner</li>
        </ol>
    </nav>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h4>Edit Banner</h4>
                </div>
                <div class="card-body">
                    @if(session('error') || $errors->any())
                        <div class="alert alert-danger">
                            @if(session('error'))
                                {{ session('error') }}
                            @endif
                            @if($errors->any())
                                <ul class="mb-0">
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            @endif
                        </div>
                    @endif

                    <form action="{{ route('dashboard.banners.update', $banner) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="title" class="form-label">Title *</label>
                            <input type="text" class="form-control @error('title') is-invalid @enderror"
                                   id="title" name="title" value="{{ old('title', $banner->title) }}" required>
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="subtitle" class="form-label">Subtitle *</label>
                            <input type="text" class="form-control @error('subtitle') is-invalid @enderror"
                                   id="subtitle" name="subtitle" value="{{ old('subtitle', $banner->subtitle) }}" required>
                            @error('subtitle')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">Description *</label>
                            <textarea class="form-control @error('description') is-invalid @enderror"
                                      id="description" name="description" rows="4" required>{{ old('description', $banner->description) }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="action_button_text" class="form-label">Action Button Text *</label>
                            <input type="text" class="form-control @error('action_button_text') is-invalid @enderror"
                                   id="action_button_text" name="action_button_text" value="{{ old('action_button_text', $banner->action_button_text) }}" required>
                            @error('action_button_text')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="action_button_link" class="form-label">Action Button Link *</label>
                            <input type="text" class="form-control @error('action_button_link') is-invalid @enderror"
                                   id="action_button_link" name="action_button_link" value="{{ old('action_button_link', $banner->action_button_link) }}" required>
                            @error('action_button_link')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="banner_image" class="form-label">Banner Image</label>
                            @if($banner->banner_image)
                                <div class="mb-2">
                                    <img src="{{ asset('storage/' . $banner->banner_image) }}"
                                         alt="Current Banner"
                                         style="max-width: 200px; height: auto;" class="img-thumbnail">
                                    <p class="text-muted small">Current image</p>
                                </div>
                            @endif
                            <input type="file" class="form-control @error('banner_image') is-invalid @enderror"
                                   id="banner_image" name="banner_image" accept="image/*">
                            <div class="form-text">Leave empty to keep current image. Supported formats: JPG, PNG, GIF, SVG, WebP. Max size: 2MB</div>
                            @error('banner_image')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="is_active" name="is_active" value="1"
                                       {{ old('is_active', $banner->is_active) ? 'checked' : '' }}>
                                <label class="form-check-label" for="is_active">
                                    Active
                                </label>
                            </div>
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('dashboard.banners.index') }}" class="btn btn-secondary">Cancel</a>
                            <button type="submit" class="btn btn-primary">Update Banner</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
