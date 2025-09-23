@extends('layouts.app')

@section('title', $research->title)

@section('content')
<!-- Start Page Title Area -->
<div class="page-title-area">
    <div class="container">
        <div class="page-title-content">
            <h2>{{ $research->title }}</h2>
            <ul>
                <li><a href="{{ route('home') }}">Home</a></li>
                <li><a href="{{ route('publications') }}">Publications</a></li>
                <li>{{ $research->title }}</li>
            </ul>
        </div>
    </div>
</div>
<!-- End Page Title Area -->

<!-- Start Research Details Area -->
<section class="research-details-area ptb-120">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="research-details-content">
                    @if($research->image)
                        <div class="research-details-image">
                            <img src="{{ $research->image_url }}" alt="{{ $research->title }}" class="img-fluid">
                        </div>
                    @endif

                    <div class="research-details-text">
                        <h2>{{ $research->title }}</h2>

                        <div class="research-meta">
                            <span class="date">
                                <i class="fas fa-calendar"></i>
                                Published: {{ $research->created_at->format('F d, Y') }}
                            </span>
                            @if($research->link)
                                <span class="external-link">
                                    <a href="{{ $research->link }}" target="_blank">
                                        <i class="fas fa-external-link-alt"></i>
                                        View External Link
                                    </a>
                                </span>
                            @endif
                        </div>

                        <div class="research-description">
                            <h4>Overview</h4>
                            <p>{{ $research->description }}</p>
                        </div>

                        @if($research->long_description)
                            <div class="research-long-description">
                                <h4>Detailed Description</h4>
                                <div class="rich-content">
                                    {!! $research->long_description !!}
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="research-sidebar">
                    <div class="sidebar-widget">
                        <h3>Research Information</h3>
                        <div class="research-info">
                            <div class="info-item">
                                <strong>Title:</strong>
                                <span>{{ $research->title }}</span>
                            </div>
                            <div class="info-item">
                                <strong>Published:</strong>
                                <span>{{ $research->created_at->format('M d, Y') }}</span>
                            </div>
                            @if($research->link)
                                <div class="info-item">
                                    <strong>External Link:</strong>
                                    <a href="{{ $research->link }}" target="_blank" class="external-link">
                                        View Research <i class="fas fa-external-link-alt"></i>
                                    </a>
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="sidebar-widget">
                        <h3>Quick Actions</h3>
                        <div class="quick-actions">
                            <a href="{{ route('research') }}" class="btn btn-outline-primary">
                                <i class="fas fa-arrow-left"></i> Back to Research
                            </a>
                            @if($research->link)
                                <a href="{{ $research->link }}" target="_blank" class="btn btn-primary">
                                    <i class="fas fa-external-link-alt"></i> View External Link
                                </a>
                            @endif
                        </div>
                    </div>

                    <div class="sidebar-widget">
                        <h3>Related Links</h3>
                        <div class="related-links">
                            <a href="{{ route('publications') }}">
                                <i class="fas fa-book"></i> Publications
                            </a>
                            <a href="{{ route('projects') }}">
                                <i class="fas fa-project-diagram"></i> Projects
                            </a>
                            <a href="{{ route('team') }}">
                                <i class="fas fa-users"></i> Our Team
                            </a>
                            <a href="{{ route('contact') }}">
                                <i class="fas fa-envelope"></i> Contact Us
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End Research Details Area -->

<style>
.research-details-area {
    background-color: #f8f9fa;
}

.research-details-content {
    background: #fff;
    border-radius: 10px;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
    overflow: hidden;
    margin-bottom: 30px;
}

.research-details-image {
    position: relative;
    overflow: hidden;
    height: 400px;
}

.research-details-image img {
    width: 100%;
    height: 100%;
    object-fit: contain;
}

.research-details-text {
    padding: 40px;
}

.research-details-text h2 {
    font-size: 28px;
    font-weight: 700;
    color: #333;
    margin-bottom: 20px;
    line-height: 1.3;
}

.research-meta {
    display: flex;
    flex-wrap: wrap;
    gap: 20px;
    margin-bottom: 30px;
    padding-bottom: 20px;
    border-bottom: 1px solid #eee;
}

.research-meta .date {
    color: #666;
    font-size: 14px;
}

.research-meta .date i {
    margin-right: 5px;
    color: #007bff;
}

.research-meta .external-link a {
    color: #28a745;
    text-decoration: none;
    font-size: 14px;
    transition: color 0.3s ease;
}

.research-meta .external-link a:hover {
    color: #1e7e34;
}

.research-description,
.research-long-description {
    margin-bottom: 30px;
}

.research-description h4,
.research-long-description h4 {
    font-size: 20px;
    font-weight: 600;
    color: #333;
    margin-bottom: 15px;
}

.research-description p {
    color: #666;
    line-height: 1.8;
    font-size: 16px;
}

.rich-content {
    color: #666;
    line-height: 1.8;
    font-size: 16px;
}

.rich-content h1,
.rich-content h2,
.rich-content h3,
.rich-content h4,
.rich-content h5,
.rich-content h6 {
    color: #333;
    margin-top: 25px;
    margin-bottom: 15px;
}

.rich-content p {
    margin-bottom: 15px;
}

.rich-content ul,
.rich-content ol {
    margin-bottom: 15px;
    padding-left: 20px;
}

.rich-content li {
    margin-bottom: 5px;
}

.research-sidebar {
    position: sticky;
    top: 100px;
}

.sidebar-widget {
    background: #fff;
    border-radius: 10px;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
    padding: 30px;
    margin-bottom: 30px;
}

.sidebar-widget h3 {
    font-size: 20px;
    font-weight: 600;
    color: #333;
    margin-bottom: 20px;
    padding-bottom: 10px;
    border-bottom: 2px solid #007bff;
}

.research-info .info-item {
    display: flex;
    flex-direction: column;
    margin-bottom: 15px;
}

.research-info .info-item strong {
    color: #333;
    font-weight: 600;
    margin-bottom: 5px;
}

.research-info .info-item span {
    color: #666;
}

.research-info .info-item .external-link {
    color: #28a745;
    text-decoration: none;
    transition: color 0.3s ease;
}

.research-info .info-item .external-link:hover {
    color: #1e7e34;
}

.quick-actions {
    display: flex;
    flex-direction: column;
    gap: 10px;
}

.quick-actions .btn {
    text-align: center;
    padding: 12px 20px;
    border-radius: 5px;
    text-decoration: none;
    font-weight: 500;
    transition: all 0.3s ease;
}

.quick-actions .btn i {
    margin-right: 8px;
}

.related-links {
    display: flex;
    flex-direction: column;
    gap: 10px;
}

.related-links a {
    color: #666;
    text-decoration: none;
    padding: 10px 15px;
    border-radius: 5px;
    transition: all 0.3s ease;
    border: 1px solid #eee;
}

.related-links a:hover {
    background-color: #007bff;
    color: #fff;
    border-color: #007bff;
}

.related-links a i {
    margin-right: 8px;
    width: 16px;
}

@media (max-width: 768px) {
    .research-details-text {
        padding: 25px;
    }

    .research-details-text h2 {
        font-size: 24px;
    }

    .research-meta {
        flex-direction: column;
        gap: 10px;
    }

    .sidebar-widget {
        padding: 20px;
    }

    .research-details-image {
        height: 250px;
    }
}
</style>
@endsection
