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
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End Team Area -->
