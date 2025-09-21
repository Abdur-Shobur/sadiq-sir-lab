<!-- Start Team Area -->
<section class="team-area ptb-120">
    <div class="container">
        <div class="section-title">
            <span>Meet Our Team</span>
            <h2>Led by Passionate Experts</h2>
            <p>
                On the other hand we denounce with righteous indignation and dislike
                men who are so beguiled and demoralized by the pleasure of the
                desire that they cannot foresee.
            </p>

            <a href="{{ route('team') }}" class="btn btn-secondary">Meet All</a>
        </div>

        <div class="row gy-4">
        @forelse($teams  as $team)
                    <div class="col-lg-6">
                        <div class="user-card">
                            <div class="user-card-img">
                                @if($team->image)
                                    <img src="{{ $team->image_url }}" alt="{{ $team->name }}">
                                @else
                                    <img src="{{ asset('assets/img/placeholder.svg') }}" alt="{{ $team->name }}">
                                @endif
                            </div>
                            <div class="user-card-info">
                                <h2>{{ $team->name }}</h2>
                                <p><span>Designation:</span> {{ $team->designation }}</p>

                                @if($team->specialities)
                                    <p><span>Specialties:</span>
                                        @foreach($team->specialities as $speciality)
                                            {{ $speciality }}@if(!$loop->last), @endif
                                        @endforeach
                                    </p>
                                @endif

                                @if($team->education)
                                    <p><span>Education:</span>
                                        @foreach($team->education as $education)
                                            {{ $education }}@if(!$loop->last), @endif
                                        @endforeach
                                    </p>
                                @endif

                                @if($team->experience)
                                    <p><span>Experience:</span>
                                        @foreach($team->experience as $experience)
                                            {{ $experience }}@if(!$loop->last), @endif
                                        @endforeach
                                    </p>
                                @endif

                                <p><span>Location:</span> {{ $team->address }}</p>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <div class="text-center">
                            <p>No team members found.</p>
                        </div>
                    </div>
                @endforelse


        </div>
    </div>
</section>
<!-- End Team Area -->
