@extends('layouts.admin')

@section('title', 'Create Service')

@section('content')
<div class="mt-4">
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('dashboard.services.index') }}">Services</a></li>
            <li class="breadcrumb-item active" aria-current="page">Create Service</li>
        </ol>
    </nav>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Create New Service</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('dashboard.services.store') }}" method="POST">
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
                                    <label for="description" class="form-label">Description <span class="text-danger">*</span></label>
                                    <textarea class="form-control @error('description') is-invalid @enderror"
                                              id="description" name="description" rows="4" required>{{ old('description') }}</textarea>
                                    @error('description')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="icon" class="form-label">Icon <span class="text-danger">*</span></label>
                                            <select class="form-select @error('icon') is-invalid @enderror"
                                                    id="icon" name="icon" required>
                                                <option value="">Select Icon</option>
                                                <option value="fas fa-robot" {{ old('icon') == 'fas fa-robot' ? 'selected' : '' }}>🤖 Robotics</option>
                                                <option value="fas fa-heartbeat" {{ old('icon') == 'fas fa-heartbeat' ? 'selected' : '' }}>❤️ Healthcare</option>
                                                <option value="fas fa-microscope" {{ old('icon') == 'fas fa-microscope' ? 'selected' : '' }}>🔬 Pathology</option>
                                                <option value="fas fa-flask" {{ old('icon') == 'fas fa-flask' ? 'selected' : '' }}>🧪 Laboratory</option>
                                                <option value="fas fa-leaf" {{ old('icon') == 'fas fa-leaf' ? 'selected' : '' }}>🌱 Environment</option>
                                                <option value="fas fa-brain" {{ old('icon') == 'fas fa-brain' ? 'selected' : '' }}>🧠 AI</option>
                                                <option value="fas fa-cog" {{ old('icon') == 'fas fa-cog' ? 'selected' : '' }}>⚙️ Technology</option>
                                                <option value="fas fa-dna" {{ old('icon') == 'fas fa-dna' ? 'selected' : '' }}>🧬 Genetics</option>
                                                <option value="fas fa-atom" {{ old('icon') == 'fas fa-atom' ? 'selected' : '' }}>⚛️ Chemistry</option>
                                                <option value="fas fa-vial" {{ old('icon') == 'fas fa-vial' ? 'selected' : '' }}>🧪 Testing</option>
                                            </select>
                                            @error('icon')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="background_color" class="form-label">Background Color <span class="text-danger">*</span></label>
                                            <select class="form-select @error('background_color') is-invalid @enderror"
                                                    id="background_color" name="background_color" required>
                                                <option value="">Select Color</option>
                                                <option value="#007bff" {{ old('background_color') == '#007bff' ? 'selected' : '' }}>🔵 Blue</option>
                                                <option value="#28a745" {{ old('background_color') == '#28a745' ? 'selected' : '' }}>🟢 Green</option>
                                                <option value="#ffc107" {{ old('background_color') == '#ffc107' ? 'selected' : '' }}>🟡 Yellow</option>
                                                <option value="#dc3545" {{ old('background_color') == '#dc3545' ? 'selected' : '' }}>🔴 Red</option>
                                                <option value="#6f42c1" {{ old('background_color') == '#6f42c1' ? 'selected' : '' }}>🟣 Purple</option>
                                                <option value="#fd7e14" {{ old('background_color') == '#fd7e14' ? 'selected' : '' }}>🟠 Orange</option>
                                                <option value="#20c997" {{ old('background_color') == '#20c997' ? 'selected' : '' }}>🟢 Teal</option>
                                                <option value="#6c757d" {{ old('background_color') == '#6c757d' ? 'selected' : '' }}>⚫ Gray</option>
                                            </select>
                                            @error('background_color')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="order" class="form-label">Display Order</label>
                                    <input type="number" class="form-control @error('order') is-invalid @enderror"
                                           id="order" name="order" value="{{ old('order', 0) }}" min="0">
                                    @error('order')
                                        <div class="invalid-feedback">{{ $message }}</div>
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
                                <div class="card">
                                    <div class="card-header">
                                        <h6>Icon Preview</h6>
                                    </div>
                                    <div class="card-body text-center">
                                        <div id="icon-preview" class="mb-3" style="display: none;">
                                            <div class="icon-display" style="width: 80px; height: 80px; border-radius: 50%; margin: 0 auto; display: flex; align-items: center; justify-content: center;">
                                                <i id="preview-icon" style="color: white; font-size: 32px;"></i>
                                            </div>
                                        </div>
                                        <p class="text-muted small">Select an icon and color to see preview</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-end gap-2 mt-4">
                            <a href="{{ route('dashboard.services.index') }}" class="btn btn-secondary">Cancel</a>
                            <button type="submit" class="btn btn-primary">Create Service</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Icon and color preview functionality
    function updatePreview() {
        const iconSelect = document.getElementById('icon');
        const colorSelect = document.getElementById('background_color');
        const preview = document.getElementById('icon-preview');
        const previewIcon = document.getElementById('preview-icon');
        const iconDisplay = document.querySelector('.icon-display');

        if (iconSelect.value && colorSelect.value) {
            previewIcon.className = iconSelect.value;
            iconDisplay.style.backgroundColor = colorSelect.value;
            preview.style.display = 'block';
        } else {
            preview.style.display = 'none';
        }
    }

    document.getElementById('icon').addEventListener('change', updatePreview);
    document.getElementById('background_color').addEventListener('change', updatePreview);

    // Initialize preview if values are already set
    updatePreview();
</script>
@endsection
