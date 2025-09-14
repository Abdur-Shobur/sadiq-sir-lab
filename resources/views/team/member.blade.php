@extends('layouts.app')

@section('title', $team->name . ' - Our Team Details')

@section('content')

<div class="page-title-area">
	<div class="container">
		<div class="page-title-content">
			<h2>Team Details</h2>
		</div>
	</div>
</div>

<section class="team-details-area ptb-120">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-12">
                <div class="team-details-sidebar">
                    <div class="team-profile">
                        <img src="{{ $team->image_url }}" alt="{{ $team->name }}" />

                        <div class="team-content">
                            <h3>{{ $team->name }}</h3>
                            <p>{{ $team->designation }}</p>
                            @if($team->education && count($team->education) > 0)
                                <span>{{ $team->education[0] }}</span>
                            @endif
                        </div>
                    </div>

                    @if($team->social_media && count($team->social_media) > 0)
                        <div class="social-box">
                            <h3>Social</h3>
                            <ul>
                                @foreach($team->social_media as $social)
                                    <li>
                                        <a href="{{ $social['url'] }}" target="_blank">
                                            @if(str_contains(strtolower($social['platform']), 'twitter'))
                                                <i class="fab fa-twitter"></i>
                                            @elseif(str_contains(strtolower($social['platform']), 'youtube'))
                                                <i class="fab fa-youtube"></i>
                                            @elseif(str_contains(strtolower($social['platform']), 'facebook'))
                                                <i class="fab fa-facebook-f"></i>
                                            @elseif(str_contains(strtolower($social['platform']), 'linkedin'))
                                                <i class="fab fa-linkedin-in"></i>
                                            @elseif(str_contains(strtolower($social['platform']), 'instagram'))
                                                <i class="fab fa-instagram"></i>
                                            @elseif(str_contains(strtolower($social['platform']), 'github'))
                                                <i class="fab fa-github"></i>
                                            @else
                                                <i class="fas fa-link"></i>
                                            @endif
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    @if($team->phone)
                        <div class="call-to-action-box">
                            <a href="tel:{{ $team->phone }}">
                                <i class="fas fa-headset"></i>
                                <h3>Contact Me</h3>
                                <span>{{ $team->phone }}</span>
                            </a>
                        </div>
                    @endif
                </div>
            </div>

            <div class="col-lg-8 col-md-12">
                <div class="team-details-desc">
                    <h3>About Me</h3>
                    <p>
                        @if($team->experience && count($team->experience) > 0)
                            {{ $team->experience[0] }}
                        @else
                            Experienced professional with expertise in {{ $team->designation }}. Dedicated to delivering high-quality results and innovative solutions.
                        @endif
                    </p>

                    <ul class="team-info">
                        @if($team->specialities && count($team->specialities) > 0)
                            <li>
                                <span>Speciality</span>
                                <ul>
                                    @foreach($team->specialities as $speciality)
                                        <li>{{ $speciality }}</li>
                                    @endforeach
                                </ul>
                            </li>
                        @endif

                        @if($team->education && count($team->education) > 0)
                            <li>
                                <span>Education</span>
                                <ul>
                                    @foreach($team->education as $education)
                                        <li>{{ $education }}</li>
                                    @endforeach
                                </ul>
                            </li>
                        @endif

                        @if($team->experience && count($team->experience) > 0)
                            <li>
                                <span>Experience</span>
                                <ul>
                                    @foreach($team->experience as $experience)
                                        <li>{{ $experience }}</li>
                                    @endforeach
                                </ul>
                            </li>
                        @endif

                        @if($team->address)
                            <li>
                                <span>Address</span>
                                <ul>
                                    <li>{{ $team->address }}</li>
                                </ul>
                            </li>
                        @endif

                        @if($team->phone)
                            <li>
                                <span>Phone</span>
                                <ul>
                                    <li><a href="tel:{{ $team->phone }}">{{ $team->phone }}</a></li>
                                </ul>
                            </li>
                        @endif

                        @if($team->email)
                            <li>
                                <span>Email</span>
                                <ul>
                                    <li><a href="mailto:{{ $team->email }}">{{ $team->email }}</a></li>
                                </ul>
                            </li>
                        @endif

                        @if($team->website)
                            <li>
                                <span>Website</span>
                                <ul>
                                    <li><a href="{{ $team->website }}" target="_blank">{{ $team->website }}</a></li>
                                </ul>
                            </li>
                        @endif
                    </ul>
                </div>

            </div>
        </div>
    </div>
</section>
@endsection
