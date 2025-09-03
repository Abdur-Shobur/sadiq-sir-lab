<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <!-- Bootstrap Min CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}" />
    <!-- Animate Min CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/animate.min.css') }}" />
    <!-- FontAwesome Min CSS -->
    <!-- <link rel="stylesheet" href="{{ asset('assets/css/fontawesome.min.css') }}" /> -->
    <!-- FontAwesome CDN for better compatibility -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
    <!-- Flaticon CSS -->
    <!-- <link rel="stylesheet" href="{{ asset('assets/css/flaticon.css') }}" /> -->
    <!-- Magnific Popup Min CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/magnific-popup.min.css') }}" />
    <!-- niceSelect CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/nice-select.min.css') }}" />
    <!-- Odometer Min CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/odometer.min.css') }}" />
    <!-- MeanMenu CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/meanmenu.css') }}" />
    <!-- Owl Carousel Min CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/owl.carousel.min.css') }}" />
    <!-- Progressbar Min CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/progressbar.min.css') }}" />
    <!-- Style CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}" />
    <!-- Responsive CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/responsive.css') }}" />

    <title>@yield('title', \App\Models\Setting::getValue('site_name', 'Prof. Sadiq Laboratory'))</title>
    <meta name="description" content="{{ \App\Models\Setting::getValue('site_description', 'Prof. Sadiq Laboratory is a leading research laboratory and scientific services') }}">
    <link rel="icon" type="image/png" href="{{ asset('assets/img/favicon.png') }}" />
</head>

<body>
    <!-- Start Preloader Area -->
    <div class="preloader">
        <h2 class="loader">Loading...</h2>
    </div>
    <!-- End Preloader Area -->

    @include('components.navbar')

    @yield('content')

    @include('components.footer')

    <div class="go-top"><i class="fas fa-arrow-up"></i></div>

    <!-- jQuery Min JS -->
    <script src="{{ asset('assets/js/jquery.min.js') }}"></script>
    <!-- Bootstrap Min JS -->
    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
    <!-- MeanMenu JS -->
    <script src="{{ asset('assets/js/jquery.meanmenu.js') }}"></script>
    <!-- Appear Min JS -->
    <script src="{{ asset('assets/js/jquery.appear.js') }}"></script>
    <!-- Odometer Min JS -->
    <script src="{{ asset('assets/js/odometer.min.js') }}"></script>
    <!-- Magnific Popup Min JS -->
    <script src="{{ asset('assets/js/jquery.magnific-popup.min.js') }}"></script>
    <!-- Parallax Min JS -->
    <script src="{{ asset('assets/js/parallax.min.js') }}"></script>
    <!-- Owl Carousel Min JS -->
    <script src="{{ asset('assets/js/owl.carousel.min.js') }}"></script>
    <!-- niceSelect Min JS -->
    <script src="{{ asset('assets/js/jquery.nice-select.min.js') }}"></script>
    <!-- Progressbar Min JS -->
    <script src="{{ asset('assets/js/progressbar.min.js') }}"></script>
    <!-- WOW Min JS -->
    <script src="{{ asset('assets/js/wow.min.js') }}"></script>
    <!-- AjaxChimp Min JS -->
    <script src="{{ asset('assets/js/jquery.ajaxchimp.min.js') }}"></script>
    <!-- Form Validator Min JS -->
    <script src="{{ asset('assets/js/form-validator.min.js') }}"></script>
    <!-- Contact Form Min JS -->
    <script src="{{ asset('assets/js/contact-form-script.js') }}"></script>
    <!-- Main JS -->
    <script src="{{ asset('assets/js/main.js') }}"></script>

    <!-- SweetAlert2 for notifications -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>
</html>
