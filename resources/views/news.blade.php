@extends('layouts.app')

@section('title', 'News - ' . \App\Models\Setting::getValue('site_name', 'Prof. Sadiq Laboratory'))

@section('content')
<!-- Start Page Title Area -->
<div class="page-title-area">
	<div class="container">
		<div class="page-title-content">
			<h2>News</h2>
                <ul>
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li>News</li>
                </ul>
		</div>
	</div>
</div>
<!-- End Page Title Area -->

<!-- Start News Area -->
<section class="blog-area ptb-120">
    <div class="container">
        <div class="row">
            @forelse($news as $article)
                <div class="col-lg-4 col-md-6">
                    <div class="single-blog-post">
                        <div class="post-image">
                            <a href="{{ route('news.detail', $article->id) }}">
                                @if($article->image)
                                    <img src="{{ $article->image_url }}" alt="{{ $article->title }}" />
                                @else
                                    <img src="{{ asset('assets/img/placeholder.svg') }}" alt="{{ $article->title }}" />
                                @endif
                            </a>
                            <div class="date">{{ $article->created_at->format('d M, Y') }}</div>
                        </div>
                        <div class="post-content">
                            <span>Published: {{ $article->created_at->format('F j, Y') }}</span>
                            <h3>
                                <a href="{{ route('news.detail', $article->id) }}">
                                    {{ $article->title }}
                                </a>
                            </h3>
                            <p>
                                {{ $article->description ?: Str::limit(strip_tags($article->content), 120) }}
                            </p>
                            <a href="{{ route('news.detail', $article->id) }}" class="learn-more-btn">
                                Read More <i class="flaticon-arrow-pointing-to-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="text-center py-5">
                        <div class="mb-4">
                            <i class="fas fa-newspaper fa-5x text-muted"></i>
                        </div>
                        <h3 class="text-muted">No News Available</h3>
                        <p class="text-muted">There are currently no news articles published. Please check back later.</p>
                    </div>
                </div>
            @endforelse
        </div>

        @if($news->hasPages())
            <div class="row">
                <div class="col-12">
                    <div class="pagination-area text-center">
                        {{ $news->links() }}
                    </div>
                </div>
            </div>
        @endif
    </div>
</section>
<!-- End News Area -->


@endsection
