@extends('layouts.admin')

@section('title', 'Edit Event')

@section('content')
<div class="container-fluid mt-4">
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('dashboard.events.index') }}">Events</a></li>
            <li class="breadcrumb-item active" aria-current="page">Edit Event</li>
        </ol>
    </nav>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Edit Event</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('dashboard.events.update', $event) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="row">
                            <div class="col-md-8">
                                <div class="mb-3">
                                    <label for="title" class="form-label">Title <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('title') is-invalid @enderror"
                                           id="title" name="title" value="{{ old('title', $event->title) }}" required>
                                    @error('title')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="subtitle" class="form-label">Subtitle</label>
                                    <input type="text" class="form-control @error('subtitle') is-invalid @enderror"
                                           id="subtitle" name="subtitle" value="{{ old('subtitle', $event->subtitle) }}">
                                    @error('subtitle')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="icon" class="form-label">Icon Class</label>
                                    <input type="text" class="form-control @error('icon') is-invalid @enderror"
                                           id="icon" name="icon" value="{{ old('icon', $event->icon) }}" 
                                           placeholder="e.g., flaticon-coding, fas fa-calendar">
                                    @error('icon')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <div class="form-text">Enter FontAwesome or Flaticon class name</div>
                                </div>

                                <div class="mb-3">
                                    <label for="content" class="form-label">Content <span class="text-danger">*</span></label>
                                    <div id="editor" style="height: 300px;">{!! old('content', $event->content) !!}</div>
                                    <input type="hidden" name="content" id="content-input">
                                    @error('content')
                                        <div class="text-danger small mt-1">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="is_active" name="is_active"
                                               value="1" {{ old('is_active', $event->is_active) ? 'checked' : '' }}>
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
                                        <div id="icon-preview" style="font-size: 48px; color: #007bff;">
                                            @if($event->icon)
                                                <i class="{{ $event->icon }}"></i>
                                            @else
                                                <i class="fas fa-calendar"></i>
                                            @endif
                                        </div>
                                        <small class="text-muted">Icon will appear here</small>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-end gap-2">
                            <a href="{{ route('dashboard.events.index') }}" class="btn btn-secondary">Cancel</a>
                            <button type="submit" class="btn btn-primary">Update Event</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Include Quill CSS -->
<link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">

<!-- Include Quill JS -->
<script src="https://cdn.quilljs.com/1.3.6/quill.min.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Initialize Quill editor
    var quill = new Quill('#editor', {
        theme: 'snow',
        modules: {
            toolbar: [
                [{ 'header': [1, 2, 3, false] }],
                ['bold', 'italic', 'underline', 'strike'],
                [{ 'list': 'ordered'}, { 'list': 'bullet' }],
                [{ 'script': 'sub'}, { 'script': 'super' }],
                [{ 'indent': '-1'}, { 'indent': '+1' }],
                [{ 'direction': 'rtl' }],
                [{ 'size': ['small', false, 'large', 'huge'] }],
                [{ 'color': [] }, { 'background': [] }],
                [{ 'font': [] }],
                [{ 'align': [] }],
                ['link', 'image', 'video'],
                ['clean']
            ]
        },
        placeholder: 'Write your event content here...'
    });

    // Update hidden input before form submission
    document.querySelector('form').addEventListener('submit', function() {
        document.getElementById('content-input').value = quill.root.innerHTML;
    });

    // Icon preview
    const iconInput = document.getElementById('icon');
    const iconPreview = document.getElementById('icon-preview');

    iconInput.addEventListener('input', function() {
        if (this.value.trim()) {
            iconPreview.innerHTML = `<i class="${this.value}"></i>`;
        } else {
            iconPreview.innerHTML = '<i class="fas fa-calendar"></i>';
        }
    });
});
</script>
@endsection
