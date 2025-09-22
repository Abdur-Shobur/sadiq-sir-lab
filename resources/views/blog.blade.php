@extends('layouts.app')

@section('title', 'Blog - ' . \App\Models\Setting::getValue('site_name', 'Prof. Sadiq Laboratory'))

@section('content')
<!-- Start Page Title Area -->
<div class="page-title-area">
	<div class="container">
		<div class="page-title-content">
			<h2>Blog</h2>
                <ul>
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li>Blog</li>
                </ul>
		</div>
	</div>
</div>
<!-- End Page Title Area -->

<!-- Start Blog Area -->
<section class="blog-area ptb-120">
    <div class="container">
        <!-- Category Filter -->
        @if($categories->count() > 0)
        <div class="row mb-4">
            <div class="col-12">
                <div class="category-filter text-center">
                    <a href="{{ route('blog') }}" class="btn {{ request()->routeIs('blog') && !request('category') ? 'btn-primary' : 'btn-outline-primary' }} me-2 mb-2">
                        All Categories
                    </a>
                    @foreach($categories as $category)
                        <a href="{{ route('blog', ['category' => $category->id]) }}"
                           class="btn {{ request('category') == $category->id ? 'btn-primary' : 'btn-outline-primary' }} me-2 mb-2">
                            {{ $category->name }}
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
        @endif

        <div class="row gy-4">
            @forelse($blogs as $blog)
            <div class="col-lg-4 col-md-6 ">
                <div class="single-blog-post">
                    <div class="post-image">
                        <a href="{{ route('blog.detail', $blog->id) }}">
                            @if($blog->image)
                                <img src="{{ $blog->image_url }}" alt="{{ $blog->title }}" />
                            @else
                                <img src="{{ asset('assets/img/placeholder.svg') }}" alt="{{ $blog->title }}" />
                            @endif
                        </a>
                        <div class="date">{{ $blog->created_at->format('d M, Y') }}</div>
                    </div>
                    <div class="post-content">
                        <span>Category: <a href="{{ route('blog', ['category' => $blog->category->id]) }}">{{ $blog->category->name }}</a></span>
                        <h3>
                            <a href="{{ route('blog.detail', $blog->id) }}">
                                {{ $blog->title }}
                            </a>
                        </h3>
                        @if($blog->subtitle)
                        <p>{{ $blog->subtitle }}</p>
                        @else
                        <p>{{ Str::limit(strip_tags($blog->content), 150) }}</p>
                        @endif
                        <a href="{{ route('blog.detail', $blog->id) }}" class="learn-more-btn">
                            Learn More <i class="flaticon-arrow-pointing-to-right"></i>
                        </a>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12">
                <div class="text-center py-5">
                    <h4>No blog posts found</h4>
                    <p class="text-muted">Check back later for new content!</p>
                </div>
            </div>
            @endforelse
        </div>

        <!-- Pagination -->
        @if($blogs->hasPages())
        <div class="row">
            <div class="col-12">
                <div class="pagination-area text-center">
                    {{ $blogs->appends(request()->query())->links() }}
                </div>
            </div>
        </div>
        @endif
    </div>
</section>
<!-- End Blog Area -->
@endsection
