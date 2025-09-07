<!-- Start Navbar Area -->
<div class="navbar-area">
    <div class="labto-mobile-nav">
        <div class="logo">
            <a href="{{ route('home') }}">
                @if(\App\Models\Setting::getValue('logo'))
                    <img src="{{ asset('uploads/' . \App\Models\Setting::getValue('logo')) }}" alt="{{ \App\Models\Setting::getValue('site_name', 'lab') }}" />
                @else
                    <img src="{{ asset('assets/img/logo.png') }}" alt="{{ \App\Models\Setting::getValue('site_name', 'Prof. Sadiq Lab') }}" />
                @endif
            </a>
        </div>
    </div>

    <div class="labto-nav">
        <div class="container">
            <nav class="navbar navbar-expand-md navbar-light">
                <a class="navbar-brand" href="{{ route('home') }}">
                    @if(\App\Models\Setting::getValue('logo'))
                        <img src="{{ asset('uploads/' . \App\Models\Setting::getValue('logo')) }}" alt="{{ \App\Models\Setting::getValue('site_name', 'Prof. Sadiq Lab') }}" />
                    @else
                        <img src="{{ asset('assets/img/logo.png') }}" alt="{{ \App\Models\Setting::getValue('site_name', 'Prof. Sadiq Lab') }}" />
                    @endif
                </a>

                <div class="collapse navbar-collapse mean-menu" id="navbarSupportedContent">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a href="{{ route('home') }}" class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}">Home</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('research') }}" class="nav-link {{ request()->routeIs('research*') ? 'active' : '' }}">Research</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('publications') }}" class="nav-link {{ request()->routeIs('publications') ? 'active' : '' }}">Publications</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('projects') }}" class="nav-link {{ request()->routeIs('projects') ? 'active' : '' }}">Projects</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('team') }}" class="nav-link {{ request()->routeIs('team') ? 'active' : '' }}">Team</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('news') }}" class="nav-link {{ request()->routeIs('news') ? 'active' : '' }}">News</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('blog') }}" class="nav-link {{ request()->routeIs('blog') ? 'active' : '' }}">Blog</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('events') }}" class="nav-link {{ request()->routeIs('events') ? 'active' : '' }}">Events</a>
                        </li>
                    </ul>

                    <div class="others-options">
                        <a href="{{ route('contact') }}" class="btn btn-secondary">Let's Talk</a>
                    </div>
                </div>
            </nav>
        </div>
    </div>
</div>
<!-- End Navbar Area -->
