@extends('layouts.app')

@section('title', 'Our Team - Labto')

@section('content')
<!-- Start Page Title Area -->
<div class="page-title-area">
	<div class="container">
		<div class="page-title-content">
			<h2>Team</h2>
                <ul>
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li>Team</li>
                </ul>
		</div>
	</div>
</div>
<!-- End Page Title Area -->

<!-- Start Team Area -->
<section class="team-area pt-3 pt-md-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="single-team-member">
                    <div class="member-image">
                        <img src="{{ asset('assets/img/team-img1.jpg') }}" alt="image" />
                        <a href="{{ route('team.member', 'agaton-ronald') }}" class="details-btn">
                            <i class="flaticon-add"></i>
                        </a>
                    </div>
                    <div class="member-content">
                        <h3><a href="{{ route('team.member', 'agaton-ronald') }}">Agaton Ronald</a></h3>
                        <span>Dental Assistant</span>
                        <p>Expert in dental laboratory procedures and research.</p>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="single-team-member">
                    <div class="member-image">
                        <img src="{{ asset('assets/img/team-img2.jpg') }}" alt="image" />
                        <a href="{{ route('team.member', 'saray-taylor') }}" class="details-btn">
                            <i class="flaticon-add"></i>
                        </a>
                    </div>
                    <div class="member-content">
                        <h3><a href="{{ route('team.member', 'saray-taylor') }}">Saray Taylor</a></h3>
                        <span>Dentist Expert</span>
                        <p>Leading expert in dental research and treatment.</p>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="single-team-member">
                    <div class="member-image">
                        <img src="{{ asset('assets/img/team-img3.jpg') }}" alt="image" />
                        <a href="{{ route('team.member', 'robert-reed') }}" class="details-btn">
                            <i class="flaticon-add"></i>
                        </a>
                    </div>
                    <div class="member-content">
                        <h3><a href="{{ route('team.member', 'robert-reed') }}">Robert Reed</a></h3>
                        <span>Neck Expert</span>
                        <p>Specialist in neck and spine research.</p>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="single-team-member">
                    <div class="member-image">
                        <img src="{{ asset('assets/img/team-img4.jpg') }}" alt="image" />
                        <a href="{{ route('team.member', 'joe-root') }}" class="details-btn">
                            <i class="flaticon-add"></i>
                        </a>
                    </div>
                    <div class="member-content">
                        <h3><a href="{{ route('team.member', 'joe-root') }}">Joe Root</a></h3>
                        <span>Medicine Expert</span>
                        <p>Leading researcher in medical laboratory sciences.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End Team Area -->
@endsection
