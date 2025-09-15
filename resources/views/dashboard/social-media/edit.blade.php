@extends('layouts.admin')

@section('title', 'Edit Social Media Link')

@section('content')
<div class="">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h3 class="card-title">Edit  Link</h3>
                    <div class="card-tools">
                        <a href="{{ route('dashboard.social-media.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i>
                            <span class="d-none d-lg-inline-block">Back to List</span>
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('dashboard.social-media.update', $social_medium) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="form-group mb-3">
                            <label for="platform">Platform <span class="text-danger">*</span></label>
                            <select name="platform" id="platform" class="form-control @error('platform') is-invalid @enderror" required>
                                <option value="">Select Platform</option>
                                <option value="ResearchGate" {{ old('platform', $social_medium->platform) == 'ResearchGate' ? 'selected' : '' }}>ResearchGate</option>
                                <option value="GoogleScholar" {{ old('platform', $social_medium->platform) == 'GoogleScholar' ? 'selected' : '' }}>GoogleScholar</option>
                                <option value="facebook" {{ old('platform', $social_medium->platform) == 'facebook' ? 'selected' : '' }}>Facebook</option>
                                <option value="twitter" {{ old('platform', $social_medium->platform) == 'twitter' ? 'selected' : '' }}>Twitter</option>
                                <option value="instagram" {{ old('platform', $social_medium->platform) == 'instagram' ? 'selected' : '' }}>Instagram</option>
                                <option value="linkedin" {{ old('platform', $social_medium->platform) == 'linkedin' ? 'selected' : '' }}>LinkedIn</option>
                                <option value="youtube" {{ old('platform', $social_medium->platform) == 'youtube' ? 'selected' : '' }}>YouTube</option>
                                <option value="github" {{ old('platform', $social_medium->platform) == 'github' ? 'selected' : '' }}>GitHub</option>
                                <option value="tiktok" {{ old('platform', $social_medium->platform) == 'tiktok' ? 'selected' : '' }}>TikTok</option>
                                <option value="pinterest" {{ old('platform', $social_medium->platform) == 'pinterest' ? 'selected' : '' }}>Pinterest</option>
                                <option value="reddit" {{ old('platform', $social_medium->platform) == 'reddit' ? 'selected' : '' }}>Reddit</option>
                                <option value="discord" {{ old('platform', $social_medium->platform) == 'discord' ? 'selected' : '' }}>Discord</option>
                                <option value="other" {{ old('platform', $social_medium->platform) == 'other' ? 'selected' : '' }}>Other</option>
                            </select>
                            @error('platform')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="url">URL <span class="text-danger">*</span></label>
                            <input type="url" name="url" id="url" class="form-control @error('url') is-invalid @enderror"
                                   value="{{ old('url', $social_medium->url) }}" placeholder="https://example.com" required>
                            @error('url')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input" id="is_active" name="is_active" value="1"
                                       {{ old('is_active', $social_medium->is_active) ? 'checked' : '' }}>
                                <label class="custom-control-label" for="is_active">Active</label>
                            </div>
                        </div>

                        <div class="form-group mb-3">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Update
                            </button>
                            <a href="{{ route('dashboard.social-media.index') }}" class="btn btn-secondary">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Platform selection change handler
    const platformSelect = document.getElementById('platform');
    const urlInput = document.getElementById('url');

    platformSelect.addEventListener('change', function() {
        const platform = this.value;
        if (platform && platform !== 'other') {
            // Set placeholder based on platform
            const placeholders = {
                'facebook': 'https://www.facebook.com/yourpage',
                'twitter': 'https://twitter.com/yourhandle',
                'instagram': 'https://www.instagram.com/yourprofile',
                'linkedin': 'https://www.linkedin.com/company/yourcompany',
                'youtube': 'https://www.youtube.com/yourchannel',
                'github': 'https://github.com/yourusername',
                'tiktok': 'https://www.tiktok.com/@yourusername',
                'pinterest': 'https://www.pinterest.com/yourprofile',
                'reddit': 'https://www.reddit.com/user/yourusername',
                'discord': 'https://discord.gg/yourinvite'
            };
            urlInput.placeholder = placeholders[platform] || 'https://example.com';
        } else {
            urlInput.placeholder = 'https://example.com';
        }
    });
});
</script>
@endpush
