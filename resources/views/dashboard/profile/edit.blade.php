@extends('layouts.admin')

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
                <form action="{{ route('dashboard.profile.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="name">Name *</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror"
                                       id="name" name="name" value="{{ old('name', $user->name) }}" required>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="email">Email *</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror"
                                       id="email" name="email" value="{{ old('email', $user->email) }}" required>
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="phone">Phone</label>
                                <input type="text" class="form-control @error('phone') is-invalid @enderror"
                                       id="phone" name="phone" value="{{ old('phone', $user->phone) }}">
                                @error('phone')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="profile_image">Profile Image</label>
                                <input type="file" class="form-control-file @error('profile_image') is-invalid @enderror"
                                       id="profile_image" name="profile_image" accept="image/*" onchange="previewImage(this)">
                                <input type="hidden" id="cropped_image" name="cropped_image">
                                @error('profile_image')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror

                                <!-- Current Image Display -->
                                @if($user->profile_image)
                                    <div id="current-image" class="mt-2">
                                        <img src="{{ $user->profile_image_url }}" alt="Current image" class="img-thumbnail" style="max-width: 200px; max-height: 200px;">
                                        <small class="text-muted d-block">Current image</small>
                                        <div class="mt-2">
                                            <button type="button" class="btn btn-sm btn-primary" onclick="cropCurrentImage('{{ $user->profile_image_url }}')">
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

                    <div class="form-group mb-3">
                        <label for="address">Address</label>
                        <textarea class="form-control @error('address') is-invalid @enderror"
                                  id="address" name="address" rows="2">{{ old('address', $user->address) }}</textarea>
                        @error('address')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label for="bio">Bio</label>
                        <textarea class="form-control @error('bio') is-invalid @enderror"
                                  id="bio" name="bio" rows="3" placeholder="Tell us about yourself...">{{ old('bio', $user->bio) }}</textarea>
                        @error('bio')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <hr class="my-4">
                    <h6 class="text-primary mb-3">Change Password</h6>
                    <p class="text-muted small">Leave password fields empty if you don't want to change your password.</p>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="current_password">Current Password</label>
                                <input type="password" class="form-control @error('current_password') is-invalid @enderror"
                                       id="current_password" name="current_password">
                                @error('current_password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="new_password">New Password</label>
                                <input type="password" class="form-control @error('new_password') is-invalid @enderror"
                                       id="new_password" name="new_password">
                                @error('new_password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="new_password_confirmation">Confirm New Password</label>
                                <input type="password" class="form-control"
                                       id="new_password_confirmation" name="new_password_confirmation">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Update
                        </button>
                        <a href="{{ route('dashboard') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i>
                            <span class="d-none d-lg-inline-block">Back to Dashboard</span>
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="col-lg-4 d-none d-lg-block">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Profile Information</h6>
            </div>
            <div class="card-body">
                <div class="text-center mb-3">
                    @if($user->profile_image)
                        <img src="{{ $user->profile_image_url }}" alt="Profile Image" class="rounded-circle mb-3" width="80" height="80" style="object-fit: cover;">
                    @else
                        <div class="user-avatar-large mx-auto mb-3">
                            {{ strtoupper(substr($user->name, 0, 1)) }}
                        </div>
                    @endif
                    <h5 class="mb-1">{{ $user->name }}</h5>
                    <p class="text-muted mb-0">{{ $user->email }}</p>
                    @if($user->phone)
                        <p class="text-muted mb-0"><i class="fas fa-phone me-1"></i>{{ $user->phone }}</p>
                    @endif
                </div>

                @if($user->bio)
                    <hr>
                    <div class="mb-3">
                        <small class="text-muted">Bio:</small>
                        <p class="mb-0">{{ $user->bio }}</p>
                    </div>
                @endif

                @if($user->address)
                    <hr>
                    <div class="mb-3">
                        <small class="text-muted">Address:</small>
                        <p class="mb-0">{{ $user->address }}</p>
                    </div>
                @endif

                <hr>

                <div class="mb-2">
                    <small class="text-muted">Member since:</small>
                    <div>{{ $user->created_at->format('F j, Y') }}</div>
                </div>

                @if($user->email_verified_at)
                    <div class="mb-2">
                        <small class="text-muted">Email verified:</small>
                        <div class="text-success">
                            <i class="fas fa-check-circle"></i> Verified
                        </div>
                    </div>
                @else
                    <div class="mb-2">
                        <small class="text-muted">Email verified:</small>
                        <div class="text-warning">
                            <i class="fas fa-exclamation-triangle"></i> Not verified
                        </div>
                    </div>
                @endif
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
.user-avatar-large {
    width: 80px;
    height: 80px;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 2rem;
    font-weight: bold;
}

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
                document.getElementById('profile_image').files = dataTransfer.files;

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
    document.getElementById('profile_image').value = '';
    document.getElementById('image-preview').style.display = 'none';
    document.getElementById('preview-img').src = '';
    currentFile = null;

    // Show current image again
    const currentImageDiv = document.getElementById('current-image');
    if (currentImageDiv) {
        currentImageDiv.style.display = 'block';
    }
}
</script>
@endsection
