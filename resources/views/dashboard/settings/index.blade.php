@extends('layouts.admin')

@section('title', 'General Settings - Dashboard')

@section('content')
<div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="mb-0">General Settings</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('dashboard.settings.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="row">
                            <div class="col-md-8">
                                <!-- Site Information -->
                                <div class="card mb-4">
                                    <div class="card-header">
                                        <h5>Site Information</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="mb-3">
                                            <label for="site_name" class="form-label">Site Name <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control @error('site_name') is-invalid @enderror"
                                                   id="site_name" name="site_name" value="{{ $settings->get('site_name')?->value ?? '' }}" required>
                                            @error('site_name')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label for="site_description" class="form-label">Site Description</label>
                                            <textarea class="form-control @error('site_description') is-invalid @enderror"
                                                      id="site_description" name="site_description" rows="3">{{ $settings->get('site_description')?->value ?? '' }}</textarea>
                                            @error('site_description')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <!-- Contact Information -->
                                <div class="card mb-4">
                                    <div class="card-header">
                                        <h5>Contact Information</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="contact_email" class="form-label">Email</label>
                                                    <input type="email" class="form-control @error('contact_email') is-invalid @enderror"
                                                           id="contact_email" name="contact_email" value="{{ $settings->get('contact_email')?->value ?? '' }}">
                                                    @error('contact_email')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="contact_phone" class="form-label">Phone</label>
                                                    <input type="text" class="form-control @error('contact_phone') is-invalid @enderror"
                                                           id="contact_phone" name="contact_phone" value="{{ $settings->get('contact_phone')?->value ?? '' }}">
                                                    @error('contact_phone')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>

                                        <div class="mb-3">
                                            <label for="contact_website" class="form-label">Website</label>
                                            <input type="url" class="form-control @error('contact_website') is-invalid @enderror"
                                                   id="contact_website" name="contact_website" value="{{ $settings->get('contact_website')?->value ?? '' }}">
                                            @error('contact_website')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label for="contact_address" class="form-label">Address</label>
                                            <textarea class="form-control @error('contact_address') is-invalid @enderror"
                                                      id="contact_address" name="contact_address" rows="3">{{ $settings->get('contact_address')?->value ?? '' }}</textarea>
                                            @error('contact_address')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <!-- Logo Settings -->
                                <div class="card mb-4">
                                    <div class="card-header">
                                        <h5>Logo Settings</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="mb-3">
                                            <label for="logo" class="form-label">Site Logo</label>
                                            <input type="file" class="form-control @error('logo') is-invalid @enderror"
                                                   id="logo" name="logo" accept="image/*">
                                            @error('logo')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                            <div class="form-text">Recommended size: 200x60px</div>
                                        </div>

                                        @if($settings->get('logo')?->value)
                                            <div class="mb-3">
                                                <label class="form-label">Current Logo</label>
                                                <img src="{{ asset('uploads/' . $settings->get('logo')->value) }}"
                                                     alt="Current Logo" class="img-fluid" style="max-height: 60px;">
                                            </div>
                                        @endif

                                        <div class="mb-3">
                                            <label for="footer_logo" class="form-label">Footer Logo</label>
                                            <input type="file" class="form-control @error('footer_logo') is-invalid @enderror"
                                                   id="footer_logo" name="footer_logo" accept="image/*">
                                            @error('footer_logo')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                            <div class="form-text">Recommended size: 200x60px</div>
                                        </div>

                                        @if($settings->get('footer_logo')?->value)
                                            <div class="mb-3">
                                                <label class="form-label">Current Footer Logo</label>
                                                <img src="{{ asset('uploads/' . $settings->get('footer_logo')->value) }}"
                                                     alt="Current Footer Logo" class="img-fluid" style="max-height: 60px;">
                                            </div>
                                        @endif
                                    </div>
                                </div>

                                <!-- Footer Settings -->
                                <div class="card mb-4">
                                    <div class="card-header">
                                        <h5>Footer Settings</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="mb-3">
                                            <label for="footer_copyright" class="form-label">Copyright Text <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control @error('footer_copyright') is-invalid @enderror"
                                                   id="footer_copyright" name="footer_copyright" value="{{ $settings->get('footer_copyright')?->value ?? '' }}" required>
                                            @error('footer_copyright')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label for="footer_description" class="form-label">Footer Description</label>
                                            <textarea class="form-control @error('footer_description') is-invalid @enderror"
                                                      id="footer_description" name="footer_description" rows="3">{{ $settings->get('footer_description')?->value ?? '' }}</textarea>
                                            @error('footer_description')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-save"></i> Update Settings
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Image preview functionality
    function handleImagePreview(inputId, previewContainer) {
        const input = document.getElementById(inputId);
        const container = document.getElementById(previewContainer);

        if (input && container) {
            input.addEventListener('change', function(e) {
                const file = e.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        container.innerHTML = `<img src="${e.target.result}" alt="Preview" class="img-fluid" style="max-height: 60px;">`;
                    };
                    reader.readAsDataURL(file);
                }
            });
        }
    }

    // Initialize image previews
    handleImagePreview('logo', 'logo-preview');
    handleImagePreview('footer_logo', 'footer-logo-preview');
});
</script>
@endsection
