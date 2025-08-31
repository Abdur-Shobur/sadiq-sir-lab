@extends('layouts.app')

@section('title', 'Blog - Labto')

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
<section class="blog-area pt-3 pt-md-5">
    <div class="container">


        <div class="row">
            <div class="col-lg-4 col-md-6">
                <div class="single-blog-post">
                    <div class="post-image">
                        <a href="{{ route('blog.post', 'antibody-half-life-measurements') }}">
                            <img src="{{ asset('assets/img/blog-img9.jpg') }}" alt="image" />
                        </a>
                        <div class="date">12 Sep, 2024</div>
                    </div>
                    <div class="post-content">
                        <span>By: <a href="{{ route('blog.author', 'john-smith') }}">John Smith</a></span>
                        <h3>
                            <a href="{{ route('blog.post', 'antibody-half-life-measurements') }}">
                                Quick Facts to Improve Antibody Half-Life Measurements
                            </a>
                        </h3>
                        <p>
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed
                            do eiusmod tempor incididunt ut labore et dolore magna.
                        </p>
                        <a href="{{ route('blog.post', 'antibody-half-life-measurements') }}" class="learn-more-btn">
                            Learn More <i class="flaticon-arrow-pointing-to-right"></i>
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6">
                <div class="single-blog-post">
                    <div class="post-image">
                        <a href="{{ route('blog.post', 'mouse-model-rare-disease') }}">
                            <img src="{{ asset('assets/img/blog-img8.jpg') }}" alt="image" />
                        </a>
                        <div class="date">14 Sep, 2024</div>
                    </div>
                    <div class="post-content">
                        <span>By: <a href="{{ route('blog.author', 'joe-root') }}">Joe Root</a></span>
                        <h3>
                            <a href="{{ route('blog.post', 'mouse-model-rare-disease') }}">
                                The Versatile Mouse Model for Rare Disease Research
                            </a>
                        </h3>
                        <p>
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed
                            do eiusmod tempor incididunt ut labore et dolore magna.
                        </p>
                        <a href="{{ route('blog.post', 'mouse-model-rare-disease') }}" class="learn-more-btn">
                            Learn More <i class="flaticon-arrow-pointing-to-right"></i>
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6">
                <div class="single-blog-post">
                    <div class="post-image">
                        <a href="{{ route('blog.post', 'happy-thank-your-bugs') }}">
                            <img src="{{ asset('assets/img/blog-img7.jpg') }}" alt="image" />
                        </a>
                        <div class="date">16 Sep, 2024</div>
                    </div>
                    <div class="post-content">
                        <span>By: <a href="{{ route('blog.author', 'sarah') }}">Sarah</a></span>
                        <h3>
                            <a href="{{ route('blog.post', 'happy-thank-your-bugs') }}">
                                If you're happy and you know it, thank your bugs
                            </a>
                        </h3>
                        <p>
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed
                            do eiusmod tempor incididunt ut labore et dolore magna.
                        </p>
                        <a href="{{ route('blog.post', 'happy-thank-your-bugs') }}" class="learn-more-btn">
                            Learn More <i class="flaticon-arrow-pointing-to-right"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End Blog Area -->
@endsection
