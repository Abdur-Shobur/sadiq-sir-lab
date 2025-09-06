@extends('layouts.admin')

@section('title', 'Edit Research Area')

@section('content')
<div class="mt-4">
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('dashboard.research-areas.index') }}">Research Areas</a></li>
            <li class="breadcrumb-item active" aria-current="page">Edit Research Area</li>
        </ol>
    </nav>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Edit Research Area</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('dashboard.research-areas.update', $researchArea) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="row">
                            <div class="col-md-8">
                                <div class="mb-3">
                                    <label for="title" class="form-label">Title <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('title') is-invalid @enderror"
                                           id="title" name="title" value="{{ old('title', $researchArea->title) }}" required>
                                    @error('title')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="description" class="form-label">Description <span class="text-danger">*</span></label>
                                    <textarea class="form-control @error('description') is-invalid @enderror"
                                              id="description" name="description" rows="4" required>{{ old('description', $researchArea->description) }}</textarea>
                                    @error('description')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="background_color" class="form-label">Background Color <span class="text-danger">*</span></label>
                                            <select class="form-select @error('background_color') is-invalid @enderror"
                                                    id="background_color" name="background_color" required>
                                                <option value="">Select Color</option>

                                                <option value="bg-43c784" {{ old('background_color', $researchArea->background_color) == 'bg-43c784' ? 'selected' : '' }}>Green</option>
                                                <option value="bg-f59f00" {{ old('background_color', $researchArea->background_color) == 'bg-f59f00' ? 'selected' : '' }}>Orange</option>
                                                <option value="bg-fe5d24" {{ old('background_color', $researchArea->background_color) == 'bg-fe5d24' ? 'selected' : '' }}>Red</option>
                                            </select>
                                            @error('background_color')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="order" class="form-label">Display Order</label>
                                            <input type="number" class="form-control @error('order') is-invalid @enderror"
                                                   id="order" name="order" value="{{ old('order', $researchArea->order) }}" min="0">
                                            @error('order')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="is_active" name="is_active"
                                               value="1" {{ old('is_active', $researchArea->is_active) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="is_active">
                                            Active
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="image" class="form-label">Image</label>
                                    <input type="file" class="form-control @error('image') is-invalid @enderror"
                                           id="image" name="image" accept="image/*">
                                    @error('image')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <div class="form-text">Recommended size: 80x80px. Max file size: 2MB.</div>
                                </div>

                                <div class="mb-3">
                                    @if($researchArea->image)
                                        <div class="mb-2">
                                            <label class="form-label">Current Image:</label>
                                            <img src="{{ asset('storage/' . $researchArea->image) }}"
                                                 alt="Current Image"
                                                 style="max-width: 100%; height: auto; border-radius: 5px;">
                                        </div>
                                    @endif
                                    <div id="image-preview" class="d-none">
                                        <label class="form-label">New Image Preview:</label>
                                        <img id="preview-img" src="" alt="Preview"
                                             style="max-width: 100%; height: auto; border-radius: 5px;">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-end gap-2">
                            <a href="{{ route('dashboard.research-areas.index') }}" class="btn btn-secondary">Cancel</a>
                            <button type="submit" class="btn btn-primary">Update Research Area</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Image preview functionality
    document.getElementById('image').addEventListener('change', function(e) {
        const file = e.target.files[0];
        const preview = document.getElementById('image-preview');
        const previewImg = document.getElementById('preview-img');

        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                previewImg.src = e.target.result;
                preview.classList.remove('d-none');
            }
            reader.readAsDataURL(file);
        } else {
            preview.classList.add('d-none');
        }
    });
</script>
@endsection
