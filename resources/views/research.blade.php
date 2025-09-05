@extends('layouts.app')

@section('title', 'Research')

@section('content')
<!-- Start Page Title Area -->
<div class="page-title-area">
    <div class="container">
        <div class="page-title-content">
            <h2>Research</h2>
            <ul>
                <li><a href="{{ route('home') }}">Home</a></li>
                <li>Research</li>
            </ul>
        </div>
    </div>
</div>
<!-- End Page Title Area -->

<!-- Start Research Area -->
<section class="research-area pt-3 pt-md-5 pb-70">
    <div class="container">


        @if($researches->count() > 0)
            <div class="row gy-4">
                @foreach($researches as $research)
                    <div class="col-lg-4 col-md-6 ">
                        <div class="single-research-item h-100">
                            @if($research->image)
                                <div class="research-image">
                                    <a href="{{ route('research.details', $research) }}">
                                        <img src="{{ $research->image_url }}" alt="{{ $research->title }}">
                                    </a>
                                </div>
                            @endif

                            <div class="research-content">
                                <h3>
                                    <a href="{{ route('research.details', $research) }}">{{ $research->title }}</a>
                                </h3>

                                <p>{{ Str::limit($research->description, 120) }}</p>

                                <div class="research-meta">
                                    <span class="date">
                                        <i class="fas fa-calendar"></i>
                                        {{ $research->created_at->format('M d, Y') }}
                                    </span>
                                </div>

                                <div class="research-actions">
                                    <a href="{{ route('research.details', $research) }}" class="read-more-btn">
                                        Read More <i class="fas fa-arrow-right"></i>
                                    </a>

                                    @if($research->link)
                                        <a href="{{ $research->link }}" target="_blank" class="external-link-btn">
                                            <i class="fas fa-external-link-alt"></i>
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="row">
                <div class="col-12">
                    <div class="text-center py-5">
                        <i class="fas fa-microscope fa-3x text-muted mb-3"></i>
                        <h4 class="text-muted">No Research Available</h4>
                        <p class="text-muted">We are currently working on exciting research projects. Check back soon!</p>
                    </div>
                </div>
            </div>
        @endif
    </div>
</section>
<!-- End Research Area -->

<style>
.research-area {
    background-color: #f8f9fa;
}

.single-research-item {
    background: #fff;
    border-radius: 10px;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
    overflow: hidden;
    transition: all 0.3s ease;
    margin-bottom: 30px;
    height: 100%;
}

.single-research-item:hover {
    transform: translateY(-5px);
    box-shadow: 0 15px 35px rgba(0, 0, 0, 0.15);
}

.research-image {
    position: relative;
    overflow: hidden;
    height: 250px;
}

.research-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.3s ease;
}

.single-research-item:hover .research-image img {
    transform: scale(1.05);
}

.research-content {
    padding: 25px;
}

.research-content h3 {
    margin-bottom: 15px;
    font-size: 20px;
    font-weight: 600;
    line-height: 1.4;
}

.research-content h3 a {
    color: #333;
    text-decoration: none;
    transition: color 0.3s ease;
}

.research-content h3 a:hover {
    color: #007bff;
}

.research-content p {
    color: #666;
    line-height: 1.6;
    margin-bottom: 20px;
}

.research-meta {
    margin-bottom: 20px;
}

.research-meta .date {
    color: #888;
    font-size: 14px;
}

.research-meta .date i {
    margin-right: 5px;
    color: #007bff;
}

.research-actions {
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.read-more-btn {
    color: #007bff;
    text-decoration: none;
    font-weight: 500;
    transition: color 0.3s ease;
}

.read-more-btn:hover {
    color: #0056b3;
}

.read-more-btn i {
    margin-left: 5px;
    transition: transform 0.3s ease;
}

.read-more-btn:hover i {
    transform: translateX(3px);
}

.external-link-btn {
    color: #28a745;
    text-decoration: none;
    font-size: 18px;
    transition: color 0.3s ease;
}

.external-link-btn:hover {
    color: #1e7e34;
}

.section-title {
    text-align: center;
    margin-bottom: 60px;
}

.section-title span {
    color: #007bff;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 1px;
    font-size: 14px;
}

.section-title h2 {
    font-size: 36px;
    font-weight: 700;
    margin: 15px 0;
    color: #333;
}

.section-title p {
    color: #666;
    font-size: 16px;
    line-height: 1.6;
    max-width: 600px;
    margin: 0 auto;
}

@media (max-width: 768px) {
    .section-title h2 {
        font-size: 28px;
    }

    .research-content {
        padding: 20px;
    }

    .research-content h3 {
        font-size: 18px;
    }
}
</style>
@endsection
