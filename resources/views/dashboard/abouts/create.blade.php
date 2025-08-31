@extends('layouts.admin')

@section('title', 'Create About Section')

@section('content')
<div class="container-fluid mt-4">
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('dashboard.abouts.index') }}">About Sections</a></li>
            <li class="breadcrumb-item active" aria-current="page">Create About Section</li>
        </ol>
    </nav>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Create New About Section</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('dashboard.abouts.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="row">
                            <div class="col-md-8">
                                <div class="mb-3">
                                    <label for="title" class="form-label">Title <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('title') is-invalid @enderror"
                                           id="title" name="title" value="{{ old('title') }}" required>
                                    @error('title')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="subtitle" class="form-label">Subtitle <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('subtitle') is-invalid @enderror"
                                           id="subtitle" name="subtitle" value="{{ old('subtitle') }}" required>
                                    @error('subtitle')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="description" class="form-label">Description <span class="text-danger">*</span></label>
                                    <textarea class="form-control @error('description') is-invalid @enderror"
                                              id="description" name="description" rows="4" required>{{ old('description') }}</textarea>
                                    @error('description')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Features List</label>
                                    <div id="features-container">
                                        <div class="feature-item mb-2">
                                            <div class="input-group">
                                                <input type="text" class="form-control" name="features[]" placeholder="Enter feature text">
                                                <button type="button" class="btn btn-outline-danger remove-feature" style="display: none;">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <button type="button" class="btn btn-outline-primary btn-sm" id="add-feature">
                                        <i class="fas fa-plus"></i> Add Feature
                                    </button>
                                    @error('features')
                                        <div class="text-danger small">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="is_active" name="is_active"
                                               value="1" {{ old('is_active', true) ? 'checked' : '' }}>
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
                                    <div class="form-text">Recommended size: 600x400px. Max file size: 2MB.</div>
                                </div>

                                <div class="mb-3">
                                    <div id="image-preview" class="d-none">
                                        <img id="preview-img" src="" alt="Preview"
                                             style="max-width: 100%; height: auto; border-radius: 5px;">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-end gap-2">
                            <a href="{{ route('dashboard.abouts.index') }}" class="btn btn-secondary">Cancel</a>
                            <button type="submit" class="btn btn-primary">Create About Section</button>
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

    // Dynamic features functionality
    document.getElementById('add-feature').addEventListener('click', function() {
        const container = document.getElementById('features-container');
        const featureItem = document.createElement('div');
        featureItem.className = 'feature-item mb-2';
        featureItem.innerHTML = `
            <div class="input-group">
                <input type="text" class="form-control" name="features[]" placeholder="Enter feature text">
                <button type="button" class="btn btn-outline-danger remove-feature">
                    <i class="fas fa-trash"></i>
                </button>
            </div>
        `;
        container.appendChild(featureItem);
        updateRemoveButtons();
    });

    // Remove feature functionality
    document.addEventListener('click', function(e) {
        if (e.target.classList.contains('remove-feature') || e.target.closest('.remove-feature')) {
            const featureItem = e.target.closest('.feature-item');
            featureItem.remove();
            updateRemoveButtons();
        }
    });

    function updateRemoveButtons() {
        const featureItems = document.querySelectorAll('.feature-item');
        const removeButtons = document.querySelectorAll('.remove-feature');

        if (featureItems.length === 1) {
            removeButtons[0].style.display = 'none';
        } else {
            removeButtons.forEach(button => {
                button.style.display = 'block';
            });
        }
    }

    // Initialize remove buttons
    updateRemoveButtons();
</script>
@endsection
