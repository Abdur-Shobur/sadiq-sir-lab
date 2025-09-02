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

        <div class="row">
            @forelse($teams->take(4) as $member)
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="single-team-member">
                        <div class="member-image">
                            @if($member->image)
                                <img src="{{ $member->image_url }}" alt="{{ $member->name }}" />
                            @else
                                <img src="{{ asset('assets/img/placeholder.svg') }}" alt="{{ $member->name }}" />
                            @endif

                            <a href="{{ route('team.member', $member->id) }}" class="details-btn">
                                <i class="fas fa-plus"></i>
                            </a>
                        </div>

                        <div class="member-content">
                            <h3><a href="{{ route('team.member', $member->id) }}">{{ $member->name }}</a></h3>
                            <span>{{ $member->designation }}</span>
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
