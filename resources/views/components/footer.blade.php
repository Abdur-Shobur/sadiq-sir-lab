<!-- Start Footer Area -->
<footer class="footer-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="single-footer-widget">
                    <div class="logo">
                        <a href="{{ route('home') }}">
                            @if(\App\Models\Setting::getValue('footer_logo'))
                                <img src="{{ asset('storage/' . \App\Models\Setting::getValue('footer_logo')) }}" alt="{{ \App\Models\Setting::getValue('site_name', 'lab') }}" />
                            @else
                                <img src="{{ asset('assets/img/logo.png') }}" alt="{{ \App\Models\Setting::getValue('site_name', 'lab') }}" />
                            @endif
                        </a>

                        <p>
                            {{ \App\Models\Setting::getValue('footer_description', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magnacing elit, sed do.') }}
                        </p>
                    </div>

                    <div class="newsletter-box">
                        <h4>Newsletter</h4>

                        <form class="newsletter-form" data-toggle="validator">
                            <input
                                type="email"
                                class="form-control"
                                placeholder="Your Email Address"
                                name="EMAIL"
                                required
                                autocomplete="off"
                            />
                            <button type="submit">
                                <i class="fas fa-paper-plane"></i>
                            </button>
                            <div id="validator-newsletter" class="form-result"></div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="single-footer-widget ms-5">
                    <h3>Useful Links</h3>

                    <ul class="useful-links-list">
                        <li><a href="{{ route('about') }}">About Us</a></li>
                        <li><a href="{{ route('team') }}">Team</a></li>
                        <li><a href="{{ route('contact') }}">Contacts</a></li>
                        <li><a href="{{ route('research') }}">Research</a></li>
                        <li><a href="{{ route('blog') }}">Blog</a></li>
                    </ul>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="single-footer-widget">
                    <h3>Our Project</h3>

                    <ul class="useful-links-list">
                        @php
                            $recentProjects = \App\Models\Project::with('category')->active()->ordered()->take(5)->get();
                        @endphp

                        @forelse($recentProjects as $project)
                            <li>
                                <a href="{{ route('project.details', $project->id) }}">
                                    <i class="fas fa-flask me-2"></i>
                                    {{ Str::limit($project->title, 30) }}
                                </a>
                            </li>
                        @empty
                            <li><span class="text-muted">No projects available</span></li>
                        @endforelse
                    </ul>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="single-footer-widget">
                    <h3>Contact Info</h3>

                    <ul class="footer-contact-info">
                        <li>
                            <i class="fas fa-map-marker-alt"></i>
                            {{ \App\Models\Setting::getValue('contact_address', '49, Suitland Street, c.g square, USA') }}
                        </li>
                        <li>
                            <i class="fas fa-phone"></i>
                            @if(\App\Models\Setting::getValue('contact_phone'))
                                <a href="tel:{{ \App\Models\Setting::getValue('contact_phone') }}">{{ \App\Models\Setting::getValue('contact_phone') }}</a>
                            @else
                                <a href="tel:+199999999999">+1 999 9999 9999</a>
                            @endif
                        </li>

                        <li>
                            <i class="fas fa-envelope"></i>
                            @if(\App\Models\Setting::getValue('contact_email'))
                                <a href="mailto:{{ \App\Models\Setting::getValue('contact_email') }}">{{ \App\Models\Setting::getValue('contact_email') }}</a>
                            @endif
                        </li>
                        <li>
                            <i class="fas fa-globe"></i>
                            @if(\App\Models\Setting::getValue('contact_website'))
                                <a href="{{ \App\Models\Setting::getValue('contact_website') }}" target="_blank">{{ str_replace(['https://', 'http://'], '', \App\Models\Setting::getValue('contact_website')) }}</a>
                            @endif
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="copyright-area">
            <div class="row align-items-center">
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <p>
                        {{ \App\Models\Setting::getValue('footer_copyright', '© ' . date('Y') . '') }}
                    </p>
                </div>

                <div class="col-lg-6 col-md-6 col-sm-6">
                    <ul>
                        @php
                            $socialMedia = \App\Models\SocialMedia::getActive();
                        @endphp

                        @forelse($socialMedia as $social)
                            <li>
                                <a href="{{ $social->url }}" target="_blank" title="{{ ucfirst($social->platform) }}">
                                    <i class="{{ $social->getIconClass() }}"></i>
                                </a>
                            </li>
                        @empty
                            <li>
                                <a href="#" class="text-muted">
                                    <i class="fas fa-share-alt"></i>
                                </a>
                            </li>
                        @endforelse
                    </ul>
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- End Footer Area -->
