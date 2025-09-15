@extends('layouts.admin')

@section('title', 'Create Social Media Link')

@section('content')
<div class=" ">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h3 class="card-title">Create New</h3>
                    <div class="card-tools">
                        <a href="{{ route('dashboard.social-media.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i>
                            <span class="d-none d-lg-inline-block">Back to List</span>
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('dashboard.social-media.store') }}" method="POST">
                        @csrf

                        <div class="form-group mb-3">
                            <label for="platform">Platform <span class="text-danger">*</span></label>
                            <select name="platform" id="platform" class="form-control @error('platform') is-invalid @enderror" required>
                                <option value="">Select Platform</option>
                                <option value="ResearchGate" {{ old('platform') == 'ResearchGate' ? 'selected' : '' }}>ResearchGate</option>
                                <option value="GoogleScholar" {{ old('platform') == 'GoogleScholar' ? 'selected' : '' }}>GoogleScholar</option>
                                <option value="facebook" {{ old('platform') == 'facebook' ? 'selected' : '' }}>Facebook</option>
                                <option value="twitter" {{ old('platform') == 'twitter' ? 'selected' : '' }}>Twitter</option>
                                <option value="instagram" {{ old('platform') == 'instagram' ? 'selected' : '' }}>Instagram</option>
                                <option value="linkedin" {{ old('platform') == 'linkedin' ? 'selected' : '' }}>LinkedIn</option>
                                <option value="youtube" {{ old('platform') == 'youtube' ? 'selected' : '' }}>YouTube</option>
                                <option value="github" {{ old('platform') == 'github' ? 'selected' : '' }}>GitHub</option>
                                <option value="tiktok" {{ old('platform') == 'tiktok' ? 'selected' : '' }}>TikTok</option>
                                <option value="pinterest" {{ old('platform') == 'pinterest' ? 'selected' : '' }}>Pinterest</option>
                                <option value="reddit" {{ old('platform') == 'reddit' ? 'selected' : '' }}>Reddit</option>
                                <option value="discord" {{ old('platform') == 'discord' ? 'selected' : '' }}>Discord</option>
                                <option value="other" {{ old('platform') == 'other' ? 'selected' : '' }}>Other</option>
                            </select>
                            @error('platform')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="url">URL <span class="text-danger">*</span></label>
                            <input type="url" name="url" id="url" class="form-control @error('url') is-invalid @enderror"
                                   value="{{ old('url') }}" placeholder="https://example.com" required>
                            @error('url')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input" id="is_active" name="is_active" value="1"
                                       {{ old('is_active', true) ? 'checked' : '' }}>
                                <label class="custom-control-label" for="is_active">Active</label>
                            </div>
                        </div>

                        <div class="form-group mb-3">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Create
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
