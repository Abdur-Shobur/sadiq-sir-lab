@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0 text-gray-800">Edit Team Member</h1>
        <a href="{{ route('dashboard.teams.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Back to List
        </a>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Team Member Information</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('dashboard.teams.update', $team) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="name">Name *</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror"
                                   id="name" name="name" value="{{ old('name', $team->name) }}" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="email">Email *</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror"
                                   id="email" name="email" value="{{ old('email', $team->email) }}" required>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="designation">Designation *</label>
                            <input type="text" class="form-control @error('designation') is-invalid @enderror"
                                   id="designation" name="designation" value="{{ old('designation', $team->designation) }}" required>
                            @error('designation')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="role">Role *</label>
                            <select class="form-control @error('role') is-invalid @enderror" id="role" name="role" required>
                                <option value="">Select Role</option>
                                <option value="team" {{ old('role', $team->role) == 'team' ? 'selected' : '' }}>Team Member</option>
                                <option value="admin" {{ old('role', $team->role) == 'admin' ? 'selected' : '' }}>Admin</option>
                            </select>
                            @error('role')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="phone">Phone</label>
                            <input type="text" class="form-control @error('phone') is-invalid @enderror"
                                   id="phone" name="phone" value="{{ old('phone', $team->phone) }}">
                            @error('phone')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="website">Website</label>
                            <input type="url" class="form-control @error('website') is-invalid @enderror"
                                   id="website" name="website" value="{{ old('website', $team->website) }}">
                            @error('website')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="address">Address</label>
                    <textarea class="form-control @error('address') is-invalid @enderror"
                              id="address" name="address" rows="3">{{ old('address', $team->address) }}</textarea>
                    @error('address')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="image">Profile Image</label>
                    @if($team->image)
                        <div class="mb-2">
                            <img src="{{ $team->image_url }}" alt="Current Image" class="img-thumbnail" width="100">
                        </div>
                    @endif
                    <input type="file" class="form-control-file @error('image') is-invalid @enderror"
                           id="image" name="image" accept="image/*">
                    @error('image')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label>Specialities</label>
                    <div id="specialities-container">
                        @if($team->specialities)
                            @foreach($team->specialities as $index => $speciality)
                                <div class="input-group mb-2">
                                    <input type="text" class="form-control" name="specialities[]"
                                           value="{{ $speciality }}" placeholder="Enter speciality">
                                    <div class="input-group-append">
                                        <button type="button" class="btn btn-outline-danger remove-field">-</button>
                                    </div>
                                </div>
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

                <div class="form-group">
                    <label>Education</label>
                    <div id="education-container">
                        @if($team->education)
                            @foreach($team->education as $index => $education)
                                <div class="input-group mb-2">
                                    <input type="text" class="form-control" name="education[]"
                                           value="{{ $education }}" placeholder="Enter education">
                                    <div class="input-group-append">
                                        <button type="button" class="btn btn-outline-danger remove-field">-</button>
                                    </div>
                                </div>
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

                <div class="form-group">
                    <label>Experience</label>
                    <div id="experience-container">
                        @if($team->experience)
                            @foreach($team->experience as $index => $experience)
                                <div class="input-group mb-2">
                                    <input type="text" class="form-control" name="experience[]"
                                           value="{{ $experience }}" placeholder="Enter experience">
                                    <div class="input-group-append">
                                        <button type="button" class="btn btn-outline-danger remove-field">-</button>
                                    </div>
                                </div>
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

                <div class="form-group">
                    <label>Social Media</label>
                    <div id="social-media-container">
                        @if($team->social_media)
                            @foreach($team->social_media as $index => $social)
                                <div class="row mb-2">
                                    <div class="col-md-5">
                                        <input type="text" class="form-control" name="social_media[{{ $index }}][platform]"
                                               value="{{ $social['platform'] }}" placeholder="Platform (e.g., LinkedIn)">
                                    </div>
                                    <div class="col-md-5">
                                        <input type="url" class="form-control" name="social_media[{{ $index }}][url]"
                                               value="{{ $social['url'] }}" placeholder="URL">
                                    </div>
                                    <div class="col-md-2">
                                        <button type="button" class="btn btn-outline-danger remove-field">-</button>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                        <div class="row mb-2">
                            <div class="col-md-5">
                                <input type="text" class="form-control" name="social_media[{{ count($team->social_media ?? []) }}][platform]" placeholder="Platform (e.g., LinkedIn)">
                            </div>
                            <div class="col-md-5">
                                <input type="url" class="form-control" name="social_media[{{ count($team->social_media ?? []) }}][url]" placeholder="URL">
                            </div>
                            <div class="col-md-2">
                                <button type="button" class="btn btn-outline-secondary add-social-media">+</button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="password">New Password (leave blank to keep current)</label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror"
                                   id="password" name="password">
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="password_confirmation">Confirm New Password</label>
                            <input type="password" class="form-control"
                                   id="password_confirmation" name="password_confirmation">
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Update Team Member
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
