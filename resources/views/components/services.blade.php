<!-- Start Services Area -->
<section class="services-area ptb-120">
    <div class="container">
        <div class="section-title">
            <span>Services</span>
            <h2>There is no Doubt To Get Your Service Over Year of Experience</h2>

            <a href="{{ route('projects') }}" class="btn btn-secondary">Tell Us More</a>
        </div>

        <div class="row gy-4">
            @php
                $services = \App\Models\Service::active()->ordered()->get();
            @endphp

            @forelse($services as $service)
                <div class="col-lg-4 col-md-6 col-sm-6">
                    <div class="single-services-box service-card h-100">
                        <div class="icon" style="background-color: {{ $service->background_color }};">
                            <i class="{{ $service->icon }}"></i>
                        </div>

                        <h3>{{ $service->title }}</h3>
                        <p>{{ $service->description }}</p>
                    </div>
                </div>
            @empty
                <!-- Fallback content if no services are found -->
                <div class="col-lg-4 col-md-6 col-sm-6">
                    <div class="single-services-box">
                        <div class="icon">
                            <i class="flaticon-coding"></i>
                        </div>

                        <h3>Advanced Robotics</h3>
                        <p>
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do
                            eiusmod tempor incididunt ut labore et dolore magna aliqua. Quis
                            ipsum sus.
                        </p>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 col-sm-6">
                    <div class="single-services-box">
                        <div class="icon bg-24b765">
                            <i class="flaticon-sugar-blood-level"></i>
                        </div>

                        <h3>Diabetes Testing</h3>
                        <p>
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do
                            eiusmod tempor incididunt ut labore et dolore magna aliqua. Quis
                            ipsum sus.
                        </p>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 col-sm-6">
                    <div class="single-services-box">
                        <div class="icon bg-f59f00">
                            <i class="flaticon-computer"></i>
                        </div>

                        <h3>Pathology Testing</h3>
                        <p>
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do
                            eiusmod tempor incididunt ut labore et dolore magna aliqua. Quis
                            ipsum sus.
                        </p>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 col-sm-6">
                    <div class="single-services-box">
                        <div class="icon bg-f7b232">
                            <i class="flaticon-microscope"></i>
                        </div>

                        <h3>Healthcare Lab</h3>
                        <p>
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do
                            eiusmod tempor incididunt ut labore et dolore magna aliqua. Quis
                            ipsum sus.
                        </p>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 col-sm-6">
                    <div class="single-services-box">
                        <div class="icon bg-fe5d24">
                            <i class="flaticon-green-earth"></i>
                        </div>

                        <h3>Alternative Energy</h3>
                        <p>
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do
                            eiusmod tempor incididunt ut labore et dolore magna aliqua. Quis
                            ipsum sus.
                        </p>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 col-sm-6">
                    <div class="single-services-box">
                        <div class="icon bg-45c27c">
                            <i class="flaticon-ai"></i>
                        </div>

                        <h3>Artificial Intelligent</h3>
                        <p>
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do
                            eiusmod tempor incididunt ut labore et dolore magna aliqua. Quis
                            ipsum sus.
                        </p>
                    </div>
                </div>
            @endforelse
        </div>
    </div>
</section>
<!-- End Services Area -->
