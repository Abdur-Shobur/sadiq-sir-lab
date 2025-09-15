<!-- Start Footer Area -->
<footer class="footer-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="single-footer-widget">
                    <div class="logo">
                        <a href="{{ route('home') }}">
                            @if(\App\Models\Setting::getValue('footer_logo'))
                                <img style="max-height: 80px;" src="{{ asset('uploads/' . \App\Models\Setting::getValue('footer_logo')) }}" alt="{{ \App\Models\Setting::getValue('site_name', 'lab') }}" />
                            @else
                                <img style="max-height: 80px;" src="{{ asset('assets/img/logo.png') }}" alt="{{ \App\Models\Setting::getValue('site_name', 'lab') }}" />
                            @endif
                        </a>

                        <p>
                            {{ \App\Models\Setting::getValue('footer_description', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magnacing elit, sed do.') }}
                        </p>
                    </div>

                                        <div class="newsletter-box">
                        <h4>Newsletter</h4>

                        @if(session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif

                        <form class="newsletter-form" id="newsletterForm" action="{{ route('newsletter.subscribe') }}" method="POST">
                            @csrf
                            <div class="input-group">
                                <input
                                    type="email"
                                    class="form-control @error('email') is-invalid @enderror"
                                    placeholder="Your Email Address"
                                    name="email"
                                    value="{{ old('email') }}"
                                    required
                                    autocomplete="off"
                                />
                                <button style="z-index: 9; padding: 0" type="submit" class="btn btn-primary">
                                    <i class="fas fa-paper-plane"></i>
                                </button>
                            </div>
                            @error('email')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </form>

                        <script>
                        document.addEventListener('DOMContentLoaded', function() {
                            const form = document.getElementById('newsletterForm');

                            form.addEventListener('submit', function(e) {
                                e.preventDefault();

                                const email = form.querySelector('input[name="email"]').value.trim();
                                if (!email) return;

                                // Show confirmation popup
                                Swal.fire({
                                    title: 'Subscribe to Newsletter?',
                                    text: `Are you sure you want to subscribe with ${email}?`,
                                    icon: 'question',
                                    showCancelButton: true,
                                    confirmButtonColor: '#3085d6',
                                    cancelButtonColor: '#d33',
                                    confirmButtonText: 'Yes, Subscribe!',
                                    cancelButtonText: 'Cancel'
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        // Submit the form
                                        form.submit();
                                    }
                                });
                            });
                        });
                        </script>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="single-footer-widget ms-5">
                    <h3>Useful Links</h3>

                    <ul class="useful-links-list">
                        <li><a href="{{ route('about') }}">About Us</a></li>
                        <li><a href="{{ route('contact') }}">Contacts</a></li>
                        <li><a href="{{ route('research') }}">Research</a></li>
                        <li><a href="{{ route('blog') }}">Blog</a></li>
                        <li><a href="{{ route('team.login') }}">Team Login</a></li>
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
