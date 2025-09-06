@extends('layouts.admin')

@section('content')
<div  >
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0 text-gray-800">Create Team</h1>
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
            <form action="{{ route('dashboard.teams.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="row gy-3">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label" for="name">Name *</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror"
                                   id="name" name="name" value="{{ old('name') }}" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label" for="email">Email *</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror"
                                   id="email" name="email" value="{{ old('email') }}" required>
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
                                   id="designation" name="designation" value="{{ old('designation') }}" required>
                            @error('designation')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label" for="role">Role *</label>
                            <select class="form-control @error('role') is-invalid @enderror" id="role" name="role" required>
                                <option value="">Select Role</option>
                                <option value="team" {{ old('role') == 'team' ? 'selected' : '' }}>Team Member</option>
                                <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                            </select>
                            @error('role')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row gy-3">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label" for="phone">Phone</label>
                            <input type="text" class="form-control @error('phone') is-invalid @enderror"
                                   id="phone" name="phone" value="{{ old('phone') }}">
                            @error('phone')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label" for="website">Website</label>
                            <input type="url" class="form-control @error('website') is-invalid @enderror"
                                   id="website" name="website" value="{{ old('website') }}">
                            @error('website')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label" for="address">Address</label>
                    <textarea class="form-control @error('address') is-invalid @enderror"
                              id="address" name="address" rows="3">{{ old('address') }}</textarea>
                    @error('address')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label class="form-label" for="image">Profile Image</label>
                    <input type="file" class="form-control-file @error('image') is-invalid @enderror"
                           id="image" name="image" accept="image/*">
                    @error('image')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label class="form-label">Specialities</label>
                    <div id="specialities-container">
                        <div class="input-group mb-2">
                            <input type="text" class="form-control" name="specialities[]" placeholder="Enter speciality">
                            <div class="input-group-append">
                                <button type="button" class="btn btn-outline-secondary add-speciality">+</button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">Education</label>
                    <div id="education-container">
                        <div class="input-group mb-2">
                            <input type="text" class="form-control" name="education[]" placeholder="Enter education">
                            <div class="input-group-append">
                                <button type="button" class="btn btn-outline-secondary add-education">+</button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">Experience</label>
                    <div id="experience-container">
                        <div class="input-group mb-2">
                            <input type="text" class="form-control" name="experience[]" placeholder="Enter experience">
                            <div class="input-group-append">
                                <button type="button" class="btn btn-outline-secondary add-experience">+</button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">Social Media</label>
                    <div id="social-media-container">
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
                    </div>
                </div>

                <div class="row gy-3">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label" for="password">Password *</label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror"
                                   id="password" name="password" required>
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label" for="password_confirmation">Confirm Password *</label>
                            <input type="password" class="form-control"
                                   id="password_confirmation" name="password_confirmation" required>
                        </div>
                    </div>
                </div>

                <div class="form-group mt-3">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Create
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
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
```
