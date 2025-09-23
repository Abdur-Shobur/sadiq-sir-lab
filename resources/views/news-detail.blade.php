@extends('layouts.app')

@section('title', $news->title . ' - ' . \App\Models\Setting::getValue('site_name', 'Prof. Sadiq Laboratory'))

@section('content')
<!-- Start Page Title Area -->
<div class="page-title-area">
	<div class="container">
		<div class="page-title-content">
			<h2>{{ $news->title }}</h2>
            <ul>
                <li><a href="{{ route('home') }}">Home</a></li>
                <li><a href="{{ route('news') }}">News</a></li>
                <li>{{ Str::limit($news->title, 30) }}</li>
            </ul>
		</div>
	</div>
</div>
<!-- End Page Title Area -->

<!-- Start News Detail Area -->
<section class="blog-details-area ptb-120">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-12">
                <div class="blog-details-desc">
                    @if($news->image)
                    <div class="article-image">
                        <img src="{{ $news->image_url }}" alt="{{ $news->title }}" class="img-fluid rounded">
                    </div>
                    @endif

                    <div class="article-content">
                        <div class="entry-meta">
                            <ul>
                                <li>
                                    <i class="flaticon-calendar"></i>
                                    {{ $news->created_at->format('F j, Y') }}
                                </li>
                                <li>
                                    <i class="flaticon-clock-circular-outline"></i>
                                    {{ $news->created_at->format('g:i A') }}
                                </li>
                            </ul>
                        </div>

                        <h3>{{ $news->title }}</h3>

                        @if($news->description)
                            <div class="article-description">
                                <p class="lead">{{ $news->description }}</p>
                            </div>
                        @endif

                        <div class="article-body">
                            {!! $news->content !!}
                        </div>

                        <!-- Social Share -->
                        <div class="article-footer">
                            <div class="article-tags">
                                <div class="row align-items-center">
                                    <div class="col-md-6">
                                        <div class="popular-tags">
                                            <span>Share:</span>
                                            <ul>
                                                <li>
                                                    <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->fullUrl()) }}"
                                                       target="_blank" rel="noopener">
                                                        <i class="fab fa-facebook-f"></i>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="https://twitter.com/intent/tweet?url={{ urlencode(request()->fullUrl()) }}&text={{ urlencode($news->title) }}"
                                                       target="_blank" rel="noopener">
                                                        <i class="fab fa-twitter"></i>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="https://www.linkedin.com/sharing/share-offsite/?url={{ urlencode(request()->fullUrl()) }}"
                                                       target="_blank" rel="noopener">
                                                        <i class="fab fa-linkedin-in"></i>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="mailto:?subject={{ urlencode($news->title) }}&body={{ urlencode('Check out this news: ' . request()->fullUrl()) }}">
                                                        <i class="fas fa-envelope"></i>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="article-navigation text-end">
                                            <a href="{{ route('news') }}" class="btn btn-primary">
                                                <i class="fas fa-arrow-left"></i> Back to News
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-12">
                <aside class="widget-area">
                    @if($relatedNews->count() > 0)
                    <section class="widget widget_recent_entries">
                        <h3 class="widget-title">Related News</h3>

                        <ul>
                            @foreach($relatedNews as $related)
                            <li>
                                <a href="{{ route('news.detail', $related->id) }}">
                                    {{ $related->title }}
                                </a>
                                <span class="post-date">{{ $related->created_at->format('M j, Y') }}</span>
                            </li>
                            @endforeach
                        </ul>
                    </section>
                    @endif

                    <!-- Latest News Widget -->
                    <section class="widget widget_recent_entries">
                        <h3 class="widget-title">Latest News</h3>

                        <ul>
                            @php
                                $latestNews = App\Models\News::active()->latest()->limit(5)->get();
                            @endphp
                            @foreach($latestNews as $latest)
                                @if($latest->id != $news->id)
                                <li>
                                    <a href="{{ route('news.detail', $latest->id) }}">
                                        {{ Str::limit($latest->title, 50) }}
                                    </a>
                                    <span class="post-date">{{ $latest->created_at->format('M j, Y') }}</span>
                                </li>
                                @endif
                            @endforeach
                        </ul>
                    </section>

                    <!-- Quick Links -->
                    <section class="widget widget_categories">
                        <h3 class="widget-title">Quick Links</h3>

                        <ul>
                            <li><a href="{{ route('home') }}">Home</a></li>
                            <li><a href="{{ route('projects') }}">Projects</a></li>
                            <li><a href="{{ route('team') }}">Team</a></li>
                            <li><a href="{{ route('blog') }}">Blog</a></li>
                            <li><a href="{{ route('contact') }}">Contact</a></li>
                        </ul>
                    </section>
                </aside>
            </div>
        </div>
    </div>
</section>
<!-- End News Detail Area -->

<style>
.article-image {
    margin-bottom: 30px;
}

.article-image img {
    width: 100%;
    height: 400px;
    object-fit: cover;
}

.article-content h3 {
    font-size: 2.5rem;
    font-weight: 700;
    margin: 20px 0;
    color: #333;
    line-height: 1.2;
}

.article-description {
    margin: 20px 0;
    padding: 20px;
    background-color: #f8f9fa;
    border-left: 4px solid #007bff;
    border-radius: 0 8px 8px 0;
}

.article-description p.lead {
    font-size: 1.2rem;
    font-weight: 400;
    margin-bottom: 0;
    color: #555;
}

.article-body {
    margin: 30px 0;
    line-height: 1.8;
    font-size: 1.1rem;
}

.article-body h3 {
    font-size: 1.8rem;
    margin: 30px 0 15px 0;
    color: #333;
}

.article-body ul, .article-body ol {
    margin: 20px 0;
    padding-left: 30px;
}

.article-body li {
    margin-bottom: 8px;
}

.article-body p {
    margin-bottom: 20px;
}

.article-footer {
    margin-top: 40px;
    padding-top: 30px;
    border-top: 1px solid #eee;
}

.popular-tags span {
    font-weight: 600;
    margin-right: 15px;
    color: #333;
}

.popular-tags ul {
    display: inline-flex;
    margin: 0;
    padding: 0;
    list-style: none;
}

.popular-tags ul li {
    margin-right: 10px;
}

.popular-tags ul li a {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 40px;
    height: 40px;
    background-color: #f8f9fa;
    border-radius: 50%;
    color: #666;
    transition: all 0.3s ease;
}

.popular-tags ul li a:hover {
    background-color: #007bff;
    color: white;
    transform: translateY(-2px);
}

.widget-area {
    padding-left: 30px;
}

.widget {
    margin-bottom: 40px;
    padding: 30px;
    background-color: #f8f9fa;
    border-radius: 8px;
}

.widget-title {
    font-size: 1.5rem;
    font-weight: 700;
    margin-bottom: 20px;
    color: #333;
    position: relative;
}

.widget-title::after {
    content: '';
    position: absolute;
    bottom: -8px;
    left: 0;
    width: 50px;
    height: 3px;
    background-color: #007bff;
    border-radius: 2px;
}

.widget ul {
    list-style: none;
    padding: 0;
    margin: 0;
}

.widget ul li {
    padding: 12px 0;
    border-bottom: 1px solid #e9ecef;
}

.widget ul li:last-child {
    border-bottom: none;
}

.widget ul li a {
    color: #333;
    text-decoration: none;
    font-weight: 500;
    transition: color 0.3s ease;
}

.widget ul li a:hover {
    color: #007bff;
}

.post-date {
    display: block;
    font-size: 0.85rem;
    color: #666;
    margin-top: 5px;
}

@media (max-width: 991px) {
    .widget-area {
        padding-left: 0;
        margin-top: 50px;
    }

    .article-content h3 {
        font-size: 2rem;
    }
}
</style>
@endsection
