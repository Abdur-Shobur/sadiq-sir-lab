@extends('layouts.app')

@section('title', 'Our Team - ' . \App\Models\Setting::getValue('site_name', 'Prof. Sadiq Laboratory'))

@section('content')
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
<section class="team-area ptb-120">
    <div class="container">
        @php
            // Group: Admins + Advisors in one row, others as members
            $admins   = collect();
            $advisors = collect();
            $leaders  = collect();
            $members  = collect();

            if (isset($teams) && $teams->count() > 0) {
                $admins = $teams->filter(function($t) {
                    if (!method_exists($t, 'roles') || !isset($t->roles)) return false;
                    return $t->roles->contains(function($role) {
                        $name = strtolower($role->name ?? '');
                        $slug = strtolower($role->slug ?? '');
                        return str_contains($name, 'system administrator')
                            || str_contains($name, 'administrator')
                            || str_contains($slug, 'system-administrator')
                            || str_contains($slug, 'admin');
                    });
                });

                $advisors = $teams->filter(function($t) {
                    if (!method_exists($t, 'roles') || !isset($t->roles)) return false;
                    return $t->roles->contains(function($role) {
                        $name = strtolower($role->name ?? '');
                        $slug = strtolower($role->slug ?? '');
                        return str_contains($name, 'advisor') || str_contains($name, 'research advisor')
                            || str_contains($slug, 'advisor') || str_contains($slug, 'research-advisor');
                    });
                });

                // Merge leaders (admins + advisors) and dedupe by id
                $leaders = $admins->merge($advisors)->unique('id')->values();

                // Members are those not in leaders
                $leaderIds = $leaders->pluck('id')->all();
                $members   = $teams->filter(fn($t) => !in_array($t->id, $leaderIds));
            }
        @endphp

        {{-- Leaders: System Administrators & Research Advisors (combined row) --}}
        @if($leaders->count() > 0)
            <div class="row mb-4">
                <div class="col-12">
                    <h3 class="mb-3">System Administrators & Research Advisors</h3>
                </div>
                @foreach($leaders as $team)
                    <div class="col-lg-3 col-md-6 col-sm-6">
                        <div class="single-team-member">
                            <div class="member-image">
                                @if($team->image)
                                <img src="{{ $team->image_url }}" alt="{{ $team->name }}">
                                @else
                                    <img src="{{ asset('assets/img/placeholder.svg') }}" alt="{{ $team->name }}">
                                @endif

                                <a href="{{ route('team.member', $team->id) }}" class="details-btn">
                                    <i class="fas fa-plus"></i>
                                </a>
                            </div>

                            <div class="member-content">
                                <h3><a href="{{ route('team.member', $team->id) }}">{{ $team->name }}</a></h3>
                                <span>{{ $team->designation }}</span>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif

        {{-- Other Team Members --}}
        <div class="row">
            <div class="col-12">
                <h3 class="mb-3">Team Members</h3>
            </div>

            @if($members->count() > 0)
                @foreach($members as $team)
                    <div class="col-lg-3 col-md-6 col-sm-6">
                        <div class="single-team-member">
                            <div class="member-image">
                                @if($team->image)
                                <img src="{{ $team->image_url }}" alt="{{ $team->name }}">
                                @else
                                    <img src="{{ asset('assets/img/placeholder.svg') }}" alt="{{ $team->name }}">
                                @endif

                                <a href="{{ route('team.member', $team->id) }}" class="details-btn">
                                    <i class="fas fa-plus"></i>
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
                        <h4 class="mb-1">No team members found</h4>
                        <p class="text-muted mb-0">Our team information will be available soon.</p>
                    </div>
                </div>
            @endif
        </div>
    </div>
</section>
@endsection
