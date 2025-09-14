@extends('layouts.team-dashboard')

@section('title', 'My Profile')

@section('content')
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">My Profile</h1>
</div>

<div class="row">
    <div class="col-lg-8">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Edit Profile Information</h6>
            </div>
            <div class="card-body">
                <form action="{{ route('team.profile.update') }}" method="POST" enctype="multipart/form-data" onsubmit="cleanArrayFields()">
                    @csrf
                    @method('PUT')

                    <div class="row gy-3">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label" for="name">Name *</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror"
                                       id="name" name="name" value="{{ old('name', $team->name) }}" required>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label" for="email">Email *</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror"
                                       id="email" name="email" value="{{ old('email', $team->email) }}" required>
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label" for="designation">Designation *</label>
                                <input type="text" class="form-control @error('designation') is-invalid @enderror"
                                       id="designation" name="designation" value="{{ old('designation', $team->designation) }}" required>
                                @error('designation')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label" for="phone">Phone</label>
                                <input type="text" class="form-control @error('phone') is-invalid @enderror"
                                       id="phone" name="phone" value="{{ old('phone', $team->phone) }}">
                                @error('phone')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label" for="website">Website</label>
                                <input type="url" class="form-control @error('website') is-invalid @enderror"
                                       id="website" name="website" value="{{ old('website', $team->website) }}">
                                @error('website')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label" for="image">Profile Image</label>
                                <input type="file" class="form-control-file @error('image') is-invalid @enderror"
                                       id="image" name="image" accept="image/*" onchange="previewImage(this)">
                                <input type="hidden" id="cropped_image" name="cropped_image">
                                @error('image')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror

                                <!-- Current Image Display -->
                                @if($team->image)
                                    <div id="current-image" class="mt-2">
                                        <img src="{{ $team->image_url }}" alt="Current image" class="img-thumbnail" style="max-width: 200px; max-height: 200px;">
                                        <small class="text-muted d-block">Current image</small>
                                        <div class="mt-2">
                                            <button type="button" class="btn btn-sm btn-primary" onclick="cropCurrentImage('{{ $team->image_url }}')">
                                                <i class="fas fa-crop"></i> Crop Current Image
                                            </button>
                                        </div>
                                    </div>
                                @endif

                                <!-- New Image Preview -->
                                <div id="image-preview" class="mt-2" style="display: none;">
                                    <img id="preview-img" src="" alt="Preview" class="img-thumbnail" style="max-width: 200px; max-height: 200px;">
                                    <div class="mt-2">
                                        <button type="button" class="btn btn-sm btn-primary" onclick="openCropModal()">
                                            <i class="fas fa-crop"></i> Crop Image
                                        </button>
                                        <button type="button" class="btn btn-sm btn-danger" onclick="removeImage()">
                                            <i class="fas fa-trash"></i> Remove
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                        <div class="form-group">
                        <label class="form-label" for="address">Address</label>
                        <textarea class="form-control @error('address') is-invalid @enderror"
                                  id="address" name="address" rows="3">{{ old('address', $team->address) }}</textarea>
                        @error('address')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                        </div>



                    </div>







                    <div class="form-group mt-4">
                        <label class="form-label">Specialities</label>
                        <div id="specialities-container">
                            @if($team->specialities && count($team->specialities) > 0)
                                @foreach($team->specialities as $index => $speciality)
                                    @if(!empty($speciality))
                                        <div class="input-group mb-2">
                                            <input type="text" class="form-control" name="specialities[]"
                                                   value="{{ $speciality }}" placeholder="Enter speciality">
                                            <div class="input-group-append">
                                                <button type="button" class="btn btn-outline-danger remove-field">-</button>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            @endif
                            <div class="input-group mb-2">
                                <input type="text" class="form-control" name="specialities[]" placeholder="Enter speciality">
                                <div class="input-group-append">
                                    <button type="button" class="btn btn-outline-secondary add-speciality">+</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group mt-4">
                        <label class="form-label">Education</label>
                        <div id="education-container">
                            @if($team->education && count($team->education) > 0)
                                @foreach($team->education as $index => $education)
                                    @if(!empty($education))
                                        <div class="input-group mb-2">
                                            <input type="text" class="form-control" name="education[]"
                                                   value="{{ $education }}" placeholder="Enter education">
                                            <div class="input-group-append">
                                                <button type="button" class="btn btn-outline-danger remove-field">-</button>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            @endif
                            <div class="input-group mb-2">
                                <input type="text" class="form-control" name="education[]" placeholder="Enter education">
                                <div class="input-group-append">
                                    <button type="button" class="btn btn-outline-secondary add-education">+</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group mt-4">
                        <label class="form-label">Experience</label>
                        <div id="experience-container">
                            @if($team->experience && count($team->experience) > 0)
                                @foreach($team->experience as $index => $experience)
                                    @if(!empty($experience))
                                        <div class="input-group mb-2">
                                            <input type="text" class="form-control" name="experience[]"
                                                   value="{{ $experience }}" placeholder="Enter experience">
                                            <div class="input-group-append">
                                                <button type="button" class="btn btn-outline-danger remove-field">-</button>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            @endif
                            <div class="input-group mb-2">
                                <input type="text" class="form-control" name="experience[]" placeholder="Enter experience">
                                <div class="input-group-append">
                                    <button type="button" class="btn btn-outline-secondary add-experience">+</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group mt-4">
                        <label class="form-label">Social Media</label>
                        <div id="social-media-container">
                            @if($team->social_media && count($team->social_media) > 0)
                                @foreach($team->social_media as $index => $social)
                                    @if(!empty($social['platform']) || !empty($social['url']))
                                        <div class="row mb-2 gy-1">
                                            <div class="col-md-5">
                                                <input type="text" class="form-control" name="social_media[{{ $index }}][platform]"
                                                       value="{{ $social['platform'] ?? '' }}" placeholder="Platform (e.g., LinkedIn)">
                                            </div>
                                            <div class="col-md-5">
                                                <input type="url" class="form-control" name="social_media[{{ $index }}][url]"
                                                       value="{{ $social['url'] ?? '' }}" placeholder="URL">
                                            </div>
                                            <div class="col-md-2">
                                                <button type="button" class="btn btn-outline-danger remove-field">-</button>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            @endif
                            <div class="row mb-2 gy-1">
                                <div class="col-md-5">
                                    <input type="text" class="form-control" name="social_media[0][platform]" placeholder="Platform (e.g., LinkedIn)">
                                </div>
                                <div class="col-md-5">
                                    <input type="url" class="form-control" name="social_media[0][url]" placeholder="URL">
                                </div>
                                <div class="col-md-2">
                                    <button type="button" class="btn btn-outline-secondary add-social-media">+</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row gy-3">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label" for="current_password">Current Password (required for password change)</label>
                                <input type="password" class="form-control @error('current_password') is-invalid @enderror"
                                       id="current_password" name="current_password">
                                @error('current_password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label" for="new_password">New Password</label>
                                <input type="password" class="form-control @error('new_password') is-invalid @enderror"
                                       id="new_password" name="new_password">
                                @error('new_password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row gy-3 mt-4">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label" for="new_password_confirmation">Confirm New Password</label>
                                <input type="password" class="form-control"
                                       id="new_password_confirmation" name="new_password_confirmation">
                            </div>
                        </div>
                    </div>

                        <div class="form-group mt-4 d-flex justify-content-between">
                        <a href="{{ route('team.dashboard') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i>
                            <span class="d-none d-lg-inline-block">Back to Dashboard</span>
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Update Profile
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Image Crop Modal -->
<div class="modal fade" id="cropModal" tabindex="-1" role="dialog" aria-labelledby="cropModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="cropModalLabel">Crop Image</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="img-container">
                    <img id="crop-image" src="" alt="Crop Image">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" onclick="cropImage()">Crop & Save</button>
            </div>
        </div>
    </div>
</div>

<!-- Include Cropper.js CSS and JS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.13/cropper.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.13/cropper.min.js"></script>

<style>
.img-container {
    max-height: 400px;
    overflow: hidden;
}

.img-container img {
    max-width: 100%;
    height: auto;
}

.cropper-container {
    direction: ltr;
    font-size: 0;
    line-height: 0;
    position: relative;
    -ms-touch-action: none;
    touch-action: none;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
}
</style>

<script>
let cropper = null;
let currentFile = null;

// Image preview and crop functions
function previewImage(input) {
    if (input.files && input.files[0]) {
        currentFile = input.files[0];
        const reader = new FileReader();

        reader.onload = function(e) {
            document.getElementById('preview-img').src = e.target.result;
            document.getElementById('image-preview').style.display = 'block';
            // Hide current image when new image is selected
            const currentImageDiv = document.getElementById('current-image');
            if (currentImageDiv) {
                currentImageDiv.style.display = 'none';
            }
        };

        reader.readAsDataURL(input.files[0]);
    }
}

function openCropModal() {
    if (currentFile) {
        const reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('crop-image').src = e.target.result;
            // Show modal using Bootstrap's vanilla JS API
            const modal = new bootstrap.Modal(document.getElementById('cropModal'));
            modal.show();

            // Initialize cropper when modal is shown
            const modalElement = document.getElementById('cropModal');
            modalElement.addEventListener('shown.bs.modal', function() {
                if (cropper) {
                    cropper.destroy();
                }
                cropper = new Cropper(document.getElementById('crop-image'), {
                    aspectRatio: 1, // Square aspect ratio for profile images
                    viewMode: 1,
                    dragMode: 'move',
                    autoCropArea: 0.8,
                    restore: false,
                    guides: false,
                    center: false,
                    highlight: false,
                    cropBoxMovable: true,
                    cropBoxResizable: true,
                    toggleDragModeOnDblclick: false,
                });
            });

            // Clean up cropper when modal is hidden
            modalElement.addEventListener('hidden.bs.modal', function() {
                if (cropper) {
                    cropper.destroy();
                    cropper = null;
                }
            });
        };
        reader.readAsDataURL(currentFile);
    }
}

function cropCurrentImage(imageUrl) {
    // Create a temporary image element to load the current image
    const tempImg = new Image();
    tempImg.crossOrigin = 'anonymous';
    tempImg.onload = function() {
        // Create a canvas to convert the image to a file
        const canvas = document.createElement('canvas');
        const ctx = canvas.getContext('2d');
        canvas.width = tempImg.width;
        canvas.height = tempImg.height;
        ctx.drawImage(tempImg, 0, 0);

        canvas.toBlob(function(blob) {
            // Create a file from the blob
            currentFile = new File([blob], 'current-image.jpg', {
                type: 'image/jpeg',
                lastModified: Date.now()
            });

            // Open crop modal with current image
            document.getElementById('crop-image').src = imageUrl;
            // Show modal using Bootstrap's vanilla JS API
            const modal = new bootstrap.Modal(document.getElementById('cropModal'));
            modal.show();

            // Initialize cropper when modal is shown
            const modalElement = document.getElementById('cropModal');
            modalElement.addEventListener('shown.bs.modal', function() {
                if (cropper) {
                    cropper.destroy();
                }
                cropper = new Cropper(document.getElementById('crop-image'), {
                    aspectRatio: 1, // Square aspect ratio for profile images
                    viewMode: 1,
                    dragMode: 'move',
                    autoCropArea: 0.8,
                    restore: false,
                    guides: false,
                    center: false,
                    highlight: false,
                    cropBoxMovable: true,
                    cropBoxResizable: true,
                    toggleDragModeOnDblclick: false,
                });
            });

            // Clean up cropper when modal is hidden
            modalElement.addEventListener('hidden.bs.modal', function() {
                if (cropper) {
                    cropper.destroy();
                    cropper = null;
                }
            });
        }, 'image/jpeg', 0.9);
    };
    tempImg.src = imageUrl;
}

function cropImage() {
    if (cropper) {
        const canvas = cropper.getCroppedCanvas({
            width: 300,
            height: 300,
            minWidth: 256,
            minHeight: 256,
            maxWidth: 1024,
            maxHeight: 1024,
            fillColor: '#fff',
            imageSmoothingEnabled: true,
            imageSmoothingQuality: 'high',
        });

        if (canvas) {
            // Convert canvas to blob
            canvas.toBlob(function(blob) {
                // Create a new file from the blob
                const croppedFile = new File([blob], currentFile ? currentFile.name : 'cropped-image.jpg', {
                    type: 'image/jpeg',
                    lastModified: Date.now()
                });

                // Update the file input
                const dataTransfer = new DataTransfer();
                dataTransfer.items.add(croppedFile);
                document.getElementById('image').files = dataTransfer.files;

                // Update preview
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('preview-img').src = e.target.result;
                    document.getElementById('image-preview').style.display = 'block';
                    // Hide current image
                    const currentImageDiv = document.getElementById('current-image');
                    if (currentImageDiv) {
                        currentImageDiv.style.display = 'none';
                    }
                };
                reader.readAsDataURL(croppedFile);

                // Close modal
                const modal = bootstrap.Modal.getInstance(document.getElementById('cropModal'));
                modal.hide();

                // Destroy cropper
                if (cropper) {
                    cropper.destroy();
                    cropper = null;
                }
            }, 'image/jpeg', 0.9);
        }
    }
}

function removeImage() {
    document.getElementById('image').value = '';
    document.getElementById('image-preview').style.display = 'none';
    document.getElementById('preview-img').src = '';
    currentFile = null;

    // Show current image again
    const currentImageDiv = document.getElementById('current-image');
    if (currentImageDiv) {
        currentImageDiv.style.display = 'block';
    }
}

function cleanArrayFields() {
    // Remove empty array fields before form submission

    // Clean specialities
    const specialitiesContainer = document.getElementById('specialities-container');
    const specialityInputs = specialitiesContainer.querySelectorAll('input[name="specialities[]"]');
    specialityInputs.forEach(input => {
        if (!input.value.trim()) {
            input.closest('.input-group').remove();
        }
    });

    // Clean education
    const educationContainer = document.getElementById('education-container');
    const educationInputs = educationContainer.querySelectorAll('input[name="education[]"]');
    educationInputs.forEach(input => {
        if (!input.value.trim()) {
            input.closest('.input-group').remove();
        }
    });

    // Clean experience
    const experienceContainer = document.getElementById('experience-container');
    const experienceInputs = experienceContainer.querySelectorAll('input[name="experience[]"]');
    experienceInputs.forEach(input => {
        if (!input.value.trim()) {
            input.closest('.input-group').remove();
        }
    });

    // Clean social media
    const socialMediaContainer = document.getElementById('social-media-container');
    const socialMediaRows = socialMediaContainer.querySelectorAll('.row.mb-2');

    socialMediaRows.forEach(row => {
        const platformInput = row.querySelector('input[name*="platform"]');
        const urlInput = row.querySelector('input[name*="url"]');

        if (platformInput && urlInput) {
            const platformValue = platformInput.value.trim();
            const urlValue = urlInput.value.trim();

            // If both fields are empty, remove the entire row
            if (!platformValue && !urlValue) {
                row.remove();
            }
        }
    });
}

document.addEventListener('DOMContentLoaded', function() {
    // Add speciality field
    document.querySelector('.add-speciality').addEventListener('click', function() {
        const container = document.getElementById('specialities-container');
        const newField = document.createElement('div');
        newField.className = 'input-group mb-2';
        newField.innerHTML = `
            <input type="text" class="form-control" name="specialities[]" placeholder="Enter speciality">
            <div class="input-group-append">
                <button type="button" class="btn btn-outline-danger remove-field">-</button>
            </div>
        `;
        container.appendChild(newField);
    });

    // Add education field
    document.querySelector('.add-education').addEventListener('click', function() {
        const container = document.getElementById('education-container');
        const newField = document.createElement('div');
        newField.className = 'input-group mb-2';
        newField.innerHTML = `
            <input type="text" class="form-control" name="education[]" placeholder="Enter education">
            <div class="input-group-append">
                <button type="button" class="btn btn-outline-danger remove-field">-</button>
            </div>
        `;
        container.appendChild(newField);
    });

    // Add experience field
    document.querySelector('.add-experience').addEventListener('click', function() {
        const container = document.getElementById('experience-container');
        const newField = document.createElement('div');
        newField.className = 'input-group mb-2';
        newField.innerHTML = `
            <input type="text" class="form-control" name="experience[]" placeholder="Enter experience">
            <div class="input-group-append">
                <button type="button" class="btn btn-outline-danger remove-field">-</button>
            </div>
        `;
        container.appendChild(newField);
    });

    // Add social media field
    document.querySelector('.add-social-media').addEventListener('click', function() {
        const container = document.getElementById('social-media-container');
        // Count existing social media fields to get the next index
        const existingFields = container.querySelectorAll('input[name*="social_media"][name*="platform"]');
        const index = existingFields.length;
        const newField = document.createElement('div');
        newField.className = 'row mb-2';
        newField.innerHTML = `
            <div class="col-md-5">
                <input type="text" class="form-control" name="social_media[${index}][platform]" placeholder="Platform (e.g., LinkedIn)">
            </div>
            <div class="col-md-5">
                <input type="url" class="form-control" name="social_media[${index}][url]" placeholder="URL">
            </div>
            <div class="col-md-2">
                <button type="button" class="btn btn-outline-danger remove-field">-</button>
            </div>
        `;
        container.appendChild(newField);
    });

    // Remove field
    document.addEventListener('click', function(e) {
        if (e.target.classList.contains('remove-field')) {
            e.target.closest('.input-group, .row').remove();
        }
    });
});
</script>
@endsection
