@extends('layouts.app')

@section('title', 'Our Team - Labto')

@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-12">
            <h1 class="text-center mb-5">Our Team</h1>
        </div>
    </div>
</div>

<section class="team-area ptb-120">
    <div class="container">
        <div class="row">
            @if(isset($teams) && $teams->count() > 0)
                @foreach($teams as $team)
                    <div class="col-lg-3 col-md-6 col-sm-6">
                        <div class="single-team-member">
                            <div class="member-image">
                                <img src="{{ $team->image_url }}" alt="{{ $team->name }}">

                                <a href="{{ route('team.member', $team->id) }}" class="details-btn">
                                    <i class="flaticon-add"></i>
                                </a>
                            </div>

                            <div class="member-content">
                                <h3><a href="{{ route('team.member', $team->id) }}">{{ $team->name }}</a></h3>
                                <span>{{ $team->designation }}</span>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="col-12">
                    <div class="text-center">
                        <h3>No team members found</h3>
                        <p>Our team information will be available soon.</p>
                    </div>
                </div>
            @endif
        </div>
    </div>
</section>
@endsection
