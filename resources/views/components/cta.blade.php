<!-- Start CTA Area -->
@php
    $cta = \App\Models\Cta::active()->first();
@endphp

<section class="cta-area ptb-120">
    <div class="container">
        <div class="cta-content">
            @if($cta)
                <h3 class="mb-3">{{ $cta->title }}</h3>
                @if($cta->subtitle)
                    <h4 class="mb-3 text-white">{{ $cta->subtitle }}</h4>
                @endif
                <p>{{ $cta->description }}</p>
                <h2><a href="tel:{{ $cta->phone_number }}">{{ $cta->phone_number }}</a></h2>
                <a href="{{ route('contact') }}" class="btn btn-primary">{{ $cta->button_text }}</a>
            @else
                <!-- Fallback static content -->
                <h3>We'll ensure you always get the best Results</h3>
                <p>
                    Duis aute irure dolor in reprehenderit in voluptate velit esse
                    cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat
                    cupidatat non proident, sunt in culpa qui officia deserunt mollit
                    anim id est laborum.
                </p>
                <h2><a href="tel:+0112343874444">+(01)1234 387 4444</a></h2>
                <a href="{{ route('contact') }}" class="btn btn-primary">Contact Us</a>
            @endif
        </div>
    </div>
</section>
<!-- End CTA Area -->
