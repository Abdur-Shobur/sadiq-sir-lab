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
                            <img src="{{ asset('uploads/' . $about->image) }}" alt="{{ $about->title }}" />
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
                                    <li><i class="fas fa-check"></i> {{ $feature }}</li>
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
                        <h2>Innovating the Future Through Technology</h2>
                        <p>Our advanced research lab, under the guidance of expert faculty, is committed to driving innovation in computing. We focus on cutting-edge technologies and real-world applications in areas such as artificial intelligence, cybersecurity, data science, and smart systems. Our mission is to empower students and researchers to build the technology of tomorrow.</p>

                        <ul class="about-features-list">
                            <li><i class="fas fa-check"></i> Artificial Intelligence</li>
                            <li><i class="fas fa-check"></i> Cybersecurity & Privacy</li>
                            <li><i class="fas fa-check"></i> Data Science & Analytics</li>
                            <li><i class="fas fa-check"></i> Internet of Things (IoT)</li>
                            <li><i class="fas fa-check"></i> Internet of Things (IoT)</li>
                            <li><i class="fas fa-check"></i> Machine Learning Models</li>
                            <li><i class="fas fa-check"></i> Cloud Computing</li>
                            <li><i class="fas fa-check"></i> Robotics & Automation</li>
                            <li><i class="fas fa-check"></i> High Performance Computing</li>
                        </ul>
                    </div>
                </div>
            </div>
        @endif
    </div>


</section>
<!-- End About Area -->
