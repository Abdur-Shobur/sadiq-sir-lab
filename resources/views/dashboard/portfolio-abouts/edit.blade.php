@extends('layouts.admin')

@section('title', 'Edit Portfolio About')

@section('content')
<div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h3 class="card-title">Edit About</h3>
                    <a href="{{ route('dashboard.portfolio-abouts.index') }}" class="btn btn-secondary float-end">
                        <i class="fas fa-arrow-left"></i>
                        <span class="d-none d-lg-inline-block">Back to List</span>
                    </a>
                </div>
                <div class="card-body">
                    <form action="{{ route('dashboard.portfolio-abouts.update', $portfolioAbout) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-8">
                                <div class="mb-3">
                                    <label for="title" class="form-label">Title <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('title') is-invalid @enderror"
                                           id="title" name="title" value="{{ old('title', $portfolioAbout->title) }}" required>
                                    @error('title')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="subtitle" class="form-label">Subtitle</label>
                                    <input type="text" class="form-control @error('subtitle') is-invalid @enderror"
                                           id="subtitle" name="subtitle" value="{{ old('subtitle', $portfolioAbout->subtitle) }}">
                                    @error('subtitle')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="description" class="form-label">Description</label>
                                    <textarea class="form-control @error('description') is-invalid @enderror"
                                              id="description" name="description" rows="4">{{ old('description', $portfolioAbout->description) }}</textarea>
                                    @error('description')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="image1" class="form-label">Image 1</label>
                                    @if($portfolioAbout->image1)
                                        <div class="mb-2">
                                            <img src="{{ $portfolioAbout->image1_url }}" alt="{{ $portfolioAbout->title }}"
                                                 class="img-thumbnail" style="width: 100%; max-width: 200px;">
                                            <div class="form-text">Current image 1</div>
                                        </div>
                                    @endif
                                    <input type="file" class="form-control @error('image1') is-invalid @enderror"
                                           id="image1" name="image1" accept="image/*">
                                    @error('image1')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <div class="form-text">Leave empty to keep current image. Recommended size: 800x600px. Max size: 2MB</div>
                                </div>

                                <div class="mb-3">
                                    <label for="image2" class="form-label">Image 2</label>
                                    @if($portfolioAbout->image2)
                                        <div class="mb-2">
                                            <img src="{{ $portfolioAbout->image2_url }}" alt="{{ $portfolioAbout->title }}"
                                                 class="img-thumbnail" style="width: 100%; max-width: 200px;">
                                            <div class="form-text">Current image 2</div>
                                        </div>
                                    @endif
                                    <input type="file" class="form-control @error('image2') is-invalid @enderror"
                                           id="image2" name="image2" accept="image/*">
                                    @error('image2')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <div class="form-text">Leave empty to keep current image. Recommended size: 800x600px. Max size: 2MB</div>
                                </div>

                                <div class="mb-3">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="is_active" name="is_active"
                                               value="1" {{ old('is_active', $portfolioAbout->is_active) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="is_active">
                                            Active
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-save"></i> Update
                                </button>
                                <a href="{{ route('dashboard.portfolio-abouts.index') }}" class="btn btn-secondary">
                                    <i class="fas fa-times"></i> Cancel
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
