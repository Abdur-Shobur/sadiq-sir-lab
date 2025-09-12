@extends('layouts.team-dashboard')

@section('title', 'Edit Gallery Item')

@section('content')
<div>
	<nav aria-label="breadcrumb" class="mb-4">
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="{{ route('team.dashboard') }}">Dashboard</a></li>
			<li class="breadcrumb-item"><a href="{{ route('team.galleries.index') }}">Galleries</a></li>
			<li class="breadcrumb-item active" aria-current="page">Edit</li>
		</ol>
	</nav>

	<div class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-header"><h4>Edit Gallery Item</h4></div>
				<div class="card-body">
					<form action="{{ route('team.galleries.update', $gallery) }}" method="POST" enctype="multipart/form-data">
						@csrf
						@method('PUT')

						<div class="row">
							<div class="col-md-8">
								<div class="mb-3">
									<label for="title" class="form-label">Title <span class="text-danger">*</span></label>
									<input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title', $gallery->title) }}" required>
									@error('title')<div class="invalid-feedback">{{ $message }}</div>@enderror
								</div>

								<div class="mb-3">
									<label for="description" class="form-label">Description</label>
									<textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="3">{{ old('description', $gallery->description) }}</textarea>
									@error('description')<div class="invalid-feedback">{{ $message }}</div>@enderror
								</div>

								<div class="mb-3">
									<label for="gallery_category_id" class="form-label">Category <span class="text-danger">*</span></label>
									<select class="form-control @error('gallery_category_id') is-invalid @enderror" id="gallery_category_id" name="gallery_category_id" required>
										<option value="">Select Category</option>
										@foreach($categories as $category)
											<option value="{{ $category->id }}" {{ old('gallery_category_id', $gallery->gallery_category_id) == $category->id ? 'selected' : '' }}>
												{{ $category->name }}
											</option>
										@endforeach
									</select>
									@error('gallery_category_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
								</div>

								<div class="mb-3">
									<div class="form-check">
										<input class="form-check-input" type="checkbox" id="is_active" name="is_active" value="1" {{ old('is_active', $gallery->is_active) ? 'checked' : '' }}>
										<label class="form-check-label" for="is_active">Active</label>
									</div>
								</div>
							</div>

							<div class="col-md-4">
								<div class="mb-3">
									<label for="image" class="form-label">Image</label>
									<input type="file" class="form-control @error('image') is-invalid @enderror" id="image" name="image" accept="image/*">
									@error('image')<div class="invalid-feedback">{{ $message }}</div>@enderror
									<div class="form-text">Leave empty to keep current image.</div>
								</div>

								@if($gallery->image)
									<div class="mb-3">
										<label class="form-label">Current Image</label>
										<div>
											<img src="{{ asset('uploads/'.$gallery->image) }}" alt="{{ $gallery->title }}" style="max-width:100%;height:auto;border-radius:5px;">
										</div>
									</div>
								@endif
							</div>
						</div>

						<div class="d-flex justify-content-end gap-2">
							<a href="{{ route('team.galleries.index') }}" class="btn btn-secondary">Cancel</a>
							<button type="submit" class="btn btn-primary">Update</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
