<!-- Start Boxes Area -->
<section class="boxes-area ptb-120">
    <div class="container">
        <div class="row section-title">
            <div class="col-12 text-center">
                <h2 style="max-width:100%"  >Research Areas</h2>
            </div>
        </div>
        <div class="row justify-content-center gy-4">
            @php
                $researchAreas = \App\Models\ResearchArea::active()->ordered()->get();
            @endphp

            @forelse($researchAreas as $researchArea)
                <div class="col-lg-4 col-md-6 col-sm-6">
                    <div class="single-box h-100 {{ $researchArea->background_color }}">
                        <div class="icon">
                            @if($researchArea->image)
                                <img src="{{ asset('storage/' . $researchArea->image) }}"
                                     alt="{{ $researchArea->title }}"
                                     style="width: 80px; height: 80px; object-fit: cover; border-radius: 10px; filter: brightness(0) saturate(100%) invert(100%) sepia(0%) saturate(2%) hue-rotate(80deg) brightness(104%) contrast(100%);">
                            @else
                                <i class="flaticon-laboratory"></i>
                            @endif
                        </div>
                        <h3>{{ $researchArea->title }}</h3>
                        <p>{{ $researchArea->description }}</p>
                        <div class="shape-box">
                            <img src="{{ asset('assets/img/shape-image/9.png') }}" alt="image" />
                            <img src="{{ asset('assets/img/shape-image/10.png') }}" alt="image" />
                        </div>
                    </div>
                </div>
            @empty
                <!-- Fallback content if no research areas are found -->
                <div class="col-lg-4 col-md-6 col-sm-6">
                    <div class="single-box">
                        <div class="icon">
                            <img src="{{ asset('assets/img/performance-img1.png') }}" alt="Biotechnology Research" style="width: 80px; height: 80px; object-fit: cover; border-radius: 10px;">
                        </div>
                        <h3>Biotechnology Research</h3>
                        <p>
                            Advanced research in genetic engineering, molecular biology, and bioprocessing technologies.
                            Developing innovative solutions for healthcare, agriculture, and environmental sustainability.
                        </p>
                        <div class="shape-box">
                            <img src="{{ asset('assets/img/shape-image/9.png') }}" alt="image" />
                            <img src="{{ asset('assets/img/shape-image/10.png') }}" alt="image" />
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 col-sm-6">
                    <div class="single-box bg-43c784">
                        <div class="icon">
                            <img src="{{ asset('assets/img/about-img1.png') }}" alt="Analytical Chemistry" style="width: 80px; height: 80px; object-fit: cover; border-radius: 10px;">
                        </div>
                        <h3>Analytical Chemistry</h3>
                        <p>
                            Cutting-edge analytical techniques and instrumentation for chemical analysis,
                            quality control, and research applications in pharmaceuticals and materials science.
                        </p>
                        <div class="shape-box">
                            <img src="{{ asset('assets/img/shape-image/9.png') }}" alt="image" />
                            <img src="{{ asset('assets/img/shape-image/10.png') }}" alt="image" />
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6">
                    <div class="single-box bg-f59f00">
                        <div class="icon">
                            <img src="{{ asset('assets/img/blog-img7.jpg') }}" alt="Environmental Science" style="width: 80px; height: 80px; object-fit: cover; border-radius: 10px;">
                        </div>
                        <h3>Environmental Science</h3>
                        <p>
                            Research focused on environmental monitoring, pollution control, and sustainable
                            development practices for a cleaner and healthier environment.
                        </p>
                        <div class="shape-box">
                            <img src="{{ asset('assets/img/shape-image/9.png') }}" alt="image" />
                            <img src="{{ asset('assets/img/shape-image/10.png') }}" alt="image" />
                        </div>
                    </div>
                </div>
            @endforelse
        </div>
    </div>
</section>
<!-- End Boxes Area -->
