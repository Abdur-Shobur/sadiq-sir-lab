<!-- Start Main Banner Area -->
<div class="main-banner">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 col-md-12">
                <div class="main-banner-content">
                    @if(isset($banner))
                        <span>{{ $banner->subtitle }}</span>
                        <h1>{{ $banner->title }}</h1>
                        <p>{{ $banner->description }}</p>
                        <a href="{{ $banner->action_button_link }}" class="btn btn-primary">{{ $banner->action_button_text }}</a>
                    @else
                        <span>Laboratory & Science</span>
                        <h1>Science is Nothing But Perception</h1>
                        <p>
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do
                            eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut
                            enim ad minim veniam, quis nostrud exercitation ullamco laboris
                            nisi ut aliquip ex ea commodo consequat.
                        </p>
                        <a href="{{ route('contact') }}" class="btn btn-primary">Make Appointment</a>
                    @endif
                </div>
            </div>

            <div class="col-lg-6 col-md-12">
                <div class="banner-image">
                    @if(isset($banner) && $banner->banner_image)
                        <img src="{{ asset('uploads/' . $banner->banner_image) }}" alt="Banner Image" />
                    @else
                        <img src="{{ asset('assets/img/banner-img1.png') }}" alt="image" />
                    @endif
                    <img src="{{ asset('assets/img/bg-shape2.png') }}" alt="image" />
                </div>
            </div>
        </div>
    </div>


</div>
<!-- End Main Banner Area -->
