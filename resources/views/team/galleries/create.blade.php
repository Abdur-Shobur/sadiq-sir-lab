@extends('layouts.team-dashboard')

@section('title', 'Create Gallery Item')

@section('content')
<div>
	<nav aria-label="breadcrumb" class="mb-4">
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="{{ route('team.dashboard') }}">Dashboard</a></li>
			<li class="breadcrumb-item"><a href="{{ route('team.galleries.index') }}">Galleries</a></li>
			<li class="breadcrumb-item active" aria-current="page">Create</li>
		</ol>
	</nav>

	<div class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-header"><h4>Create New Gallery Item</h4></div>
				<div class="card-body">
					<form action="{{ route('team.galleries.store') }}" method="POST" enctype="multipart/form-data">
						@csrf

						<div class="row">
							<div class="col-md-8">
								<div class="mb-3">
									<label for="title" class="form-label">Title <span class="text-danger">*</span></label>
									<input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title') }}" required>
									@error('title')<div class="invalid-feedback">{{ $message }}</div>@enderror
								</div>

								<div class="mb-3">
									<label for="description" class="form-label">Description</label>
									<textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="3">{{ old('description') }}</textarea>
									@error('description')<div class="invalid-feedback">{{ $message }}</div>@enderror
								</div>

								<div class="mb-3">
									<label for="gallery_category_id" class="form-label">Category <span class="text-danger">*</span></label>
									<select class="form-control @error('gallery_category_id') is-invalid @enderror" id="gallery_category_id" name="gallery_category_id" required>
										<option value="">Select Category</option>
										@foreach($categories as $category)
											<option value="{{ $category->id }}" {{ old('gallery_category_id') == $category->id ? 'selected' : '' }}>
												{{ $category->name }}
											</option>
										@endforeach
									</select>
									@error('gallery_category_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
								</div>

								<div class="mb-3">
									<div class="form-check">
										<input class="form-check-input" type="checkbox" id="is_active" name="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }}>
										<label class="form-check-label" for="is_active">Active</label>
									</div>
								</div>
							</div>

							<div class="col-md-4">
								<div class="mb-3">
									<label for="image" class="form-label">Image <span class="text-danger">*</span></label>
									<input type="file" class="form-control @error('image') is-invalid @enderror" id="image" name="image" accept="image/*" required>
									@error('image')<div class="invalid-feedback">{{ $message }}</div>@enderror
									<div class="form-text">Max 2MB.</div>
								</div>

								<div class="mb-3">
									<div id="image-preview" class="d-none">
										<img id="preview-img" src="" alt="Preview" style="max-width:100%;height:auto;border-radius:5px;">
									</div>
								</div>
							</div>
						</div>

						<div class="d-flex justify-content-end gap-2">
							<a href="{{ route('team.galleries.index') }}" class="btn btn-secondary">Cancel</a>
							<button type="submit" class="btn btn-primary">Create</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
	document.getElementById('image').addEventListener('change', function(e) {
		const file = e.target.files[0];
		const preview = document.getElementById('image-preview');
		const previewImg = document.getElementById('preview-img');
		if (file) {
			const reader = new FileReader();
			reader.onload = function(e) {
				previewImg.src = e.target.result;
				preview.classList.remove('d-none');
			}
			reader.readAsDataURL(file);
		} else {
			preview.classList.add('d-none');
		}
	});
});
</script>
@endsection
