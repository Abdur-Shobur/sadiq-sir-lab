@extends('layouts.team-dashboard')

@section('title', 'Create Project')

@section('content')
<div>
	<nav aria-label="breadcrumb" class="mb-4">
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="{{ route('team.dashboard') }}">Dashboard</a></li>
			<li class="breadcrumb-item"><a href="{{ route('team.projects.index') }}">Projects</a></li>
			<li class="breadcrumb-item active" aria-current="page">Create Project</li>
		</ol>
	</nav>

	<div class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-header">
					<h4>Create Project</h4>
				</div>
				<div class="card-body">
					<form action="{{ route('team.projects.store') }}" method="POST" enctype="multipart/form-data">
						@csrf

						<div class="row">
							<div class="col-md-8">
								<div class="mb-3">
									<label for="title" class="form-label">Title <span class="text-danger">*</span></label>
									<input type="text" class="form-control @error('title') is-invalid @enderror"
										   id="title" name="title" value="{{ old('title') }}" required>
									@error('title')<div class="invalid-feedback">{{ $message }}</div>@enderror
								</div>

								<div class="mb-3">
									<label for="subtitle" class="form-label">Subtitle</label>
									<input type="text" class="form-control @error('subtitle') is-invalid @enderror"
										   id="subtitle" name="subtitle" value="{{ old('subtitle') }}">
									@error('subtitle')<div class="invalid-feedback">{{ $message }}</div>@enderror
								</div>

								<div class="mb-3">
									<label for="project_category_id" class="form-label">Category <span class="text-danger">*</span></label>
									<select class="form-control @error('project_category_id') is-invalid @enderror"
											id="project_category_id" name="project_category_id" required>
										<option value="">Select Category</option>
										@foreach($categories as $category)
											<option value="{{ $category->id }}" {{ old('project_category_id') == $category->id ? 'selected' : '' }}>
												{{ $category->name }}
											</option>
										@endforeach
									</select>
									@error('project_category_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
								</div>

								<div class="mb-3">
									<label for="content" class="form-label">Content <span class="text-danger">*</span></label>
									<div id="editor" style="height: 300px;">{!! old('content') !!}</div>
									<input type="hidden" name="content" id="content-input">
									@error('content')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
								</div>

								<div class="mb-3">
									<div class="form-check">
										<input class="form-check-input" type="checkbox" id="is_active" name="is_active"
											   value="1" {{ old('is_active', true) ? 'checked' : '' }}>
										<label class="form-check-label" for="is_active">Active</label>
									</div>
								</div>
							</div>

							<div class="col-md-4">
								<div class="mb-3">
									<label for="image" class="form-label">Project Image</label>
									<input type="file" class="form-control @error('image') is-invalid @enderror"
										   id="image" name="image" accept="image/*">
									@error('image')<div class="invalid-feedback">{{ $message }}</div>@enderror
									<div class="form-text">Recommended size: 600x400px. Max file size: 2MB.</div>
								</div>

								<div class="mb-3">
									<div id="image-preview" class="d-none">
										<img id="preview-img" src="" alt="Preview"
											 style="max-width: 100%; height: auto; border-radius: 5px;">
									</div>
								</div>
							</div>
						</div>

						<div class="d-flex justify-content-end gap-2">
							<a href="{{ route('team.projects.index') }}" class="btn btn-secondary">Cancel</a>
							<button type="submit" class="btn btn-primary">Create Project</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>

<link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
<script src="https://cdn.quilljs.com/1.3.6/quill.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
	var quill = new Quill('#editor', {
		theme: 'snow',
		modules: { toolbar: [[{ 'header': [1, 2, 3, false] }], ['bold','italic','underline','strike'], [{ 'list':'ordered' },{ 'list':'bullet' }], [{ 'color':[] }, { 'background':[] }], [{ 'align':[] }], ['link','image'], ['clean']] },
		placeholder: 'Write your project content here...'
	});
	document.querySelector('form').addEventListener('submit', function() {
		document.getElementById('content-input').value = quill.root.innerHTML;
	});
	document.getElementById('image').addEventListener('change', function() {
		const preview = document.getElementById('image-preview');
		const previewImg = document.getElementById('preview-img');
		if (this.files.length) {
			const reader = new FileReader();
			reader.onload = e => { previewImg.src = e.target.result; preview.classList.remove('d-none'); };
			reader.readAsDataURL(this.files[0]);
		} else {
			preview.classList.add('d-none');
		}
	});
});
</script>
@endsection
