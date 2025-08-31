<!-- Start About Area -->
<section class="about-area ptb-120">
    <div class="container">
        @php
            $about = \App\Models\About::active()->first();
        @endphp

        @if($about)
            <div class="row align-items-center">
                <div class="col-lg-6 col-md-12">
                    <div class="about-image">
                        @if($about->image)
                            <img src="{{ asset('storage/' . $about->image) }}" alt="{{ $about->title }}" />
                        @else
                            <img src="{{ asset('assets/img/about-img1.png') }}" alt="About Us" />
                        @endif
                    </div>
                </div>

                <div class="col-lg-6 col-md-12">
                    <div class="about-content">
                        <span>About Us</span>
                        <h2>{{ $about->title }}</h2>
                        <p>{{ $about->description }}</p>

                        @if(is_array($about->features) && count($about->features) > 0)
                            <ul class="about-features-list">
                                @foreach($about->features as $feature)
                                    <li><i class="flaticon-check-mark"></i> {{ $feature }}</li>
                                @endforeach
                            </ul>
                        @endif
                    </div>
                </div>
            </div>
        @else
            <!-- Fallback content if no about section is found -->
            <div class="row align-items-center">
                <div class="col-lg-6 col-md-12">
                    <div class="about-image">
                        <img src="{{ asset('assets/img/about-img1.png') }}" alt="About Us" />
                    </div>
                </div>

                <div class="col-lg-6 col-md-12">
                    <div class="about-content">
                        <span>About Us</span>
                        <h2>We Discoveries We Give Your Solution</h2>
                        <p>
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do
                            eiusmod tempor incididunt ut labore et dolore magna aliqua. Quis
                            ipsum suspendisse ultrices gravida. Risus commodo viverra
                            maecenas accumsan lacus vel facilisis.
                        </p>

                        <ul class="about-features-list">
                            <li><i class="flaticon-check-mark"></i> Chemical Research</li>
                            <li><i class="flaticon-check-mark"></i> Pathology Testing</li>
                            <li><i class="flaticon-check-mark"></i> Sample Preparation</li>
                            <li><i class="flaticon-check-mark"></i> Healthcare Labs</li>
                            <li><i class="flaticon-check-mark"></i> Advanced Microscopy</li>
                            <li><i class="flaticon-check-mark"></i> Advanced Robotics</li>
                            <li><i class="flaticon-check-mark"></i> Environmental Testing</li>
                            <li><i class="flaticon-check-mark"></i> Anatomical Pathology</li>
                        </ul>
                    </div>
                </div>
            </div>
        @endif
    </div>

    <div class="bg-shape1">
        <img src="{{ asset('assets/img/bg-shape1.png') }}" alt="image" />
    </div>
    <div class="shape-img9">
        <img src="{{ asset('assets/img/shape-image/4.png') }}" alt="image" />
    </div>
</section>
<!-- End About Area -->
