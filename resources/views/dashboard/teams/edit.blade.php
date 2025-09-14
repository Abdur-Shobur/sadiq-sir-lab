@extends('layouts.admin')

@section('content')
<div>
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0 text-gray-800">Edit Team</h1>
        <a href="{{ route('dashboard.teams.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i>
            <span class="d-none d-lg-inline-block">Back to List</span>
        </a>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Team Information</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('dashboard.teams.update', $team) }}" method="POST" enctype="multipart/form-data">
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
                </div>

                <div class="row gy-3">
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
                </div>

                <div class="row gy-3">
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
                </div>

                <div class="form-group">
                    <label class="form-label" for="address">Address</label>
                    <textarea class="form-control @error('address') is-invalid @enderror"
                              id="address" name="address" rows="3">{{ old('address', $team->address) }}</textarea>
                    @error('address')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Roles Selection -->
                <div class="form-group">
                    <label class="form-label">Roles *</label>
                    <div class="row">
                        @php
                            $roles = \App\Models\Role::where('is_active', true)->get();
                            $teamRoleIds = $team->roles->pluck('id')->toArray();
                        @endphp
                        @foreach($roles as $role)
                        <div class="col-md-4 mb-2">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox"
                                       name="roles[]" value="{{ $role->id }}"
                                       id="role_{{ $role->id }}"
                                       {{ in_array($role->id, old('roles', $teamRoleIds)) ? 'checked' : '' }}>
                                <label class="form-check-label" for="role_{{ $role->id }}">
                                    {{ $role->name }}
                                    @if($role->description)
                                        <small class="text-muted d-block">{{ $role->description }}</small>
                                    @endif
                                </label>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    @error('roles')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label class="form-label">Specialities</label>
                    <div id="specialities-container">
                        @if($team->specialities && count($team->specialities) > 0)
                            @foreach($team->specialities as $index => $speciality)
                            <div class="input-group mb-2">
                                <input type="text" class="form-control" name="specialities[]" value="{{ $speciality }}" placeholder="Enter speciality">
                                <div class="input-group-append">
                                    <button type="button" class="btn btn-outline-danger remove-field">-</button>
                                </div>
                            </div>
                            @endforeach
                        @else
                            <div class="input-group mb-2">
                                <input type="text" class="form-control" name="specialities[]" placeholder="Enter speciality">
                                <div class="input-group-append">
                                    <button type="button" class="btn btn-outline-secondary add-speciality">+</button>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">Education</label>
                    <div id="education-container">
                        @if($team->education && count($team->education) > 0)
                            @foreach($team->education as $index => $education)
                            <div class="input-group mb-2">
                                <input type="text" class="form-control" name="education[]" value="{{ $education }}" placeholder="Enter education">
                                <div class="input-group-append">
                                    <button type="button" class="btn btn-outline-danger remove-field">-</button>
                                </div>
                            </div>
                            @endforeach
                        @else
                            <div class="input-group mb-2">
                                <input type="text" class="form-control" name="education[]" placeholder="Enter education">
                                <div class="input-group-append">
                                    <button type="button" class="btn btn-outline-secondary add-education">+</button>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">Experience</label>
                    <div id="experience-container">
                        @if($team->experience && count($team->experience) > 0)
                            @foreach($team->experience as $index => $experience)
                            <div class="input-group mb-2">
                                <input type="text" class="form-control" name="experience[]" value="{{ $experience }}" placeholder="Enter experience">
                                <div class="input-group-append">
                                    <button type="button" class="btn btn-outline-danger remove-field">-</button>
                                </div>
                            </div>
                            @endforeach
                        @else
                            <div class="input-group mb-2">
                                <input type="text" class="form-control" name="experience[]" placeholder="Enter experience">
                                <div class="input-group-append">
                                    <button type="button" class="btn btn-outline-secondary add-experience">+</button>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">Social Media</label>
                    <div id="social-media-container">
                        @if($team->social_media && count($team->social_media) > 0)
                            @foreach($team->social_media as $index => $social)
                            <div class="row mb-2">
                                <div class="col-md-5">
                                    <input type="text" class="form-control" name="social_media[{{ $index }}][platform]" value="{{ $social['platform'] ?? '' }}" placeholder="Platform (e.g., LinkedIn)">
                                </div>
                                <div class="col-md-5">
                                    <input type="url" class="form-control" name="social_media[{{ $index }}][url]" value="{{ $social['url'] ?? '' }}" placeholder="URL">
                                </div>
                                <div class="col-md-2">
                                    <button type="button" class="btn btn-outline-danger remove-field">-</button>
                                </div>
                            </div>
                            @endforeach
                        @else
                            <div class="row mb-2">
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
                        @endif
                    </div>
                </div>

                <div class="row gy-3">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label" for="password">Password</label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror"
                                   id="password" name="password">
                            <small class="text-muted">Leave blank to keep current password</small>
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label" for="password_confirmation">Confirm Password</label>
                            <input type="password" class="form-control"
                                   id="password_confirmation" name="password_confirmation">
                        </div>
                    </div>
                </div>

                <div class="form-group mt-3">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Update
                    </button>
                </div>
            </form>
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

document.addEventListener('DOMContentLoaded', function() {
    // Add speciality field
    document.querySelector('.add-speciality')?.addEventListener('click', function() {
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
    document.querySelector('.add-education')?.addEventListener('click', function() {
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
    document.querySelector('.add-experience')?.addEventListener('click', function() {
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
    document.querySelector('.add-social-media')?.addEventListener('click', function() {
        const container = document.getElementById('social-media-container');
        const index = container.children.length;
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
