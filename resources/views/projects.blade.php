@extends('layouts.app')

@section('title', 'Projects - Labto')

@section('content')
<!-- Start Page Title Area -->
<div class="page-title-area">
	<div class="container">
		<div class="page-title-content">
			<h2>Projects</h2>
                <ul>
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li>Projects</li>
                </ul>
		</div>
	</div>
</div>
<!-- End Page Title Area -->

<!-- Start Projects Area -->
<section class="research-area pt-3 pt-md-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-6">
                    <div class="single-research-box">
                        <div class="research-image">
                            <a href="single-research.html"><img src="assets/img/blog-img7.jpg" alt="image"></a>
                        </div>

                        <div class="research-content">
                            <span>Pathology</span>
                            <h3><a href="single-research.html">Nuclear micro-reactors</a></h3>
                            <p>Enhancing Your Vision sit ametcon sec tetur adipisicing.</p>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6">
                    <div class="single-research-box">
                        <div class="research-image">
                            <a href="single-research.html"><img src="assets/img/blog-img8.jpg" alt="image"></a>
                        </div>

                        <div class="research-content">
                            <span>Oncology</span>
                            <h3><a href="single-research.html">Metabolism Regulation</a></h3>
                            <p>Enhancing Your Vision sit ametcon sec tetur adipisicing.</p>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6">
                    <div class="single-research-box">
                        <div class="research-image">
                            <a href="single-research.html"><img src="assets/img/blog-img9.jpg" alt="image"></a>
                        </div>

                        <div class="research-content">
                            <span>Incubator</span>
                            <h3><a href="single-research.html">Translational Research</a></h3>
                            <p>Enhancing Your Vision sit ametcon sec tetur adipisicing.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
<!-- End Projects Area -->
@endsection
