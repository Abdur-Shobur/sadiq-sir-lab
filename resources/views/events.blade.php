@extends('layouts.app')

@section('title', 'Events - Labto')

@section('content')
<!-- Start Page Title Area -->
<div class="page-title-area">
	<div class="container">
		<div class="page-title-content">
			<h2>Events</h2>
                <ul>
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li>Events</li>
                </ul>
		</div>
	</div>
</div>
<!-- End Page Title Area -->

<!-- Start Events Area -->
<section class="services-area pt-3 pt-md-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-6 col-sm-6">
                <div class="single-services-box">
                    <div class="icon">
                        <i class="flaticon-coding"></i>
                    </div>

                    <h3>Advanced Robotics</h3>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Quis ipsum sus.</p>

                    <a href="single-services.html" class="learn-more-btn">Learn More <i class="flaticon-arrow-pointing-to-right"></i></a>
                </div>
            </div>

            <div class="col-lg-4 col-md-6 col-sm-6">
                <div class="single-services-box">
                    <div class="icon bg-24b765">
                        <i class="flaticon-sugar-blood-level"></i>
                    </div>

                    <h3>Diabetes Testing</h3>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Quis ipsum sus.</p>

                    <a href="single-services.html" class="learn-more-btn">Learn More <i class="flaticon-arrow-pointing-to-right"></i></a>
                </div>
            </div>

            <div class="col-lg-4 col-md-6 col-sm-6">
                <div class="single-services-box">
                    <div class="icon bg-f59f00">
                        <i class="flaticon-computer"></i>
                    </div>

                    <h3>Pathology Testing</h3>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Quis ipsum sus.</p>

                    <a href="single-services.html" class="learn-more-btn">Learn More <i class="flaticon-arrow-pointing-to-right"></i></a>
                </div>
            </div>

            <div class="col-lg-4 col-md-6 col-sm-6">
                <div class="single-services-box">
                    <div class="icon bg-f7b232">
                        <i class="flaticon-microscope"></i>
                    </div>

                    <h3>Healthcare Lab</h3>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Quis ipsum sus.</p>

                    <a href="single-services.html" class="learn-more-btn">Learn More <i class="flaticon-arrow-pointing-to-right"></i></a>
                </div>
            </div>

            <div class="col-lg-4 col-md-6 col-sm-6">
                <div class="single-services-box">
                    <div class="icon bg-fe5d24">
                        <i class="flaticon-green-earth"></i>
                    </div>

                    <h3>Alternative Energy</h3>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Quis ipsum sus.</p>

                    <a href="single-services.html" class="learn-more-btn">Learn More <i class="flaticon-arrow-pointing-to-right"></i></a>
                </div>
            </div>

            <div class="col-lg-4 col-md-6 col-sm-6">
                <div class="single-services-box">
                    <div class="icon bg-45c27c">
                        <i class="flaticon-ai"></i>
                    </div>

                    <h3>Artificial Intelligent</h3>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Quis ipsum sus.</p>

                    <a href="single-services.html" class="learn-more-btn">Learn More <i class="flaticon-arrow-pointing-to-right"></i></a>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End Events Area -->
@endsection
