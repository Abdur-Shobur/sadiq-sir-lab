@extends('layouts.app')

@section('title', $blog->title . ' - ' . \App\Models\Setting::getValue('site_name', 'Prof. Sadiq Laboratory'))

@section('content')
<!-- Start Page Title Area -->
<div class="page-title-area">
	<div class="container">
		<div class="page-title-content">
			<h2>{{ $blog->title }}</h2>
                <ul>
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li><a href="{{ route('blog') }}">Blog</a></li>
                    <li>{{ $blog->title }}</li>
                </ul>
		</div>
	</div>
</div>
<!-- End Page Title Area -->

<!-- Start Blog Detail Area -->
<section class="blog-detail-area pt-3 pt-md-5">
    <div class="container">
        <div class="row">
            <!-- Main Content -->
            <div class="col-lg-8">
                <div class="blog-detail-content">
                    <!-- Featured Image -->
                    @if($blog->image)
                     <div class="blog-featured-image mb-4">
                            <img src="{{ $blog->image_url }}" alt="{{ $blog->title }}" class="img-fluid rounded">
                        </div>
                    @endif

                    <!-- Blog Meta -->
                    <div class="blog-meta mb-4">
                        <div class="row align-items-center">
                            <div class="col-md-6">
                                <span class="text-muted">
                                    <i class="fas fa-calendar-alt me-2"></i>
                                    {{ $blog->created_at->format('F d, Y') }}
                                </span>
                            </div>
                            <div class="col-md-6 text-md-end">
                                <span class="badge bg-primary">
                                    <i class="fas fa-tag me-1"></i>
                                    {{ $blog->category->name }}
                                </span>
                            </div>
                        </div>
                    </div>

                    <!-- Blog Title -->
                    <h1 class="blog-title mb-3">{{ $blog->title }}</h1>

                    <!-- Blog Subtitle -->
                    @if($blog->subtitle)
                    <p class="blog-subtitle lead text-muted mb-4">{{ $blog->subtitle }}</p>
                    @endif

                    <!-- Blog Content -->
                    <div class="blog-content">
                        {!! $blog->content !!}
                    </div>

                    <!-- Blog Footer -->
                    <div class="blog-footer mt-5 pt-4 border-top">
                        <div class="row align-items-center">
                            <div class="col-md-6">
                                <span class="text-muted">
                                    <i class="fas fa-clock me-2"></i>
                                    Published {{ $blog->created_at->diffForHumans() }}
                                </span>
                            </div>
                            <div class="col-md-6 text-md-end">
                                <a href="{{ route('blog', ['category' => $blog->category->id]) }}" class="btn btn-outline-primary btn-sm">
                                    <i class="fas fa-arrow-left me-1"></i>
                                    Back to {{ $blog->category->name }}
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="col-lg-4">
                <div class="blog-sidebar">
                    <!-- Category Info -->
                    <div class="sidebar-widget mb-4">
                        <div class="widget-title">
                            <h4>Category</h4>
                        </div>
                        <div class="widget-content">
                            <div class="category-info">
                                <span class="badge bg-primary fs-6">{{ $blog->category->name }}</span>
                                <p class="mt-2 text-muted">This post belongs to the {{ $blog->category->name }} category.</p>
                            </div>
                        </div>
                    </div>

                    <!-- Related Posts -->
                    @if($relatedBlogs->count() > 0)
                    <div class="sidebar-widget">
                        <div class="widget-title">
                            <h4>Related Posts</h4>
                        </div>
                        <div class="widget-content">
                            @foreach($relatedBlogs as $relatedBlog)
                            <div class="related-post mb-3">
                                <div class="row">
                                    <div class="col-4">
                                        <a href="{{ route('blog.detail', $relatedBlog->id) }}">
                                            @if($relatedBlog->image)
                                            <img src="{{ $relatedBlog->image_url }}" alt="{{ $relatedBlog->title }}"
                                                 class="img-fluid rounded" style="width: 100%; height: 80px; object-fit: cover;">
                                            @else
                                                <img src="{{ asset('assets/img/placeholder.svg') }}" alt="{{ $relatedBlog->title }}"
                                                     class="img-fluid rounded" style="width: 100%; height: 80px; object-fit: cover;">
                                            @endif
                                        </a>
                                    </div>
                                    <div class="col-8">
                                        <h6>
                                            <a href="{{ route('blog.detail', $relatedBlog->id) }}" class="text-decoration-none">
                                                {{ Str::limit($relatedBlog->title, 50) }}
                                            </a>
                                        </h6>
                                        <small class="text-muted">{{ $relatedBlog->created_at->format('M d, Y') }}</small>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @endif

                    <!-- Back to Blog -->
                    <div class="sidebar-widget mt-4">
                        <div class="widget-content">
                            <a href="{{ route('blog') }}" class="btn btn-primary w-100">
                                <i class="fas fa-arrow-left me-2"></i>
                                Back to All Posts
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End Blog Detail Area -->
@endsection
