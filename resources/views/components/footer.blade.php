<!-- Start Footer Area -->
<footer class="footer-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="single-footer-widget">
                    <div class="logo">
                        <a href="{{ route('home') }}">
                            <img src="{{ asset('assets/img/logo.png') }}" alt="logo" />
                        </a>

                        <p>
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed
                            do eiusmod tempor incididunt ut labore et dolore magnacing
                            elit, sed do.
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
                                <i class="flaticon-paper-plane"></i>
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
                        <li><a href="{{ route('services') }}">Services</a></li>
                        <li><a href="{{ route('team') }}">Team</a></li>
                        <li><a href="{{ route('contact') }}">Contacts</a></li>
                        <li><a href="{{ route('research') }}">Research</a></li>
                        <li><a href="{{ route('pricing') }}">Pricing</a></li>
                        <li><a href="{{ route('blog') }}">Blog</a></li>
                    </ul>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="single-footer-widget">
                    <h3>Our Services</h3>

                    <ul class="widget-services-list">
                        <li><a href="{{ route('services.scientific') }}">Scientific</a></li>
                        <li><a href="{{ route('services.chemistry') }}">Chemistry</a></li>
                        <li><a href="{{ route('services.gemological') }}">Gemological</a></li>
                        <li><a href="{{ route('services.forensic') }}">Forensic science</a></li>
                        <li><a href="{{ route('services.immunology') }}">Immunology</a></li>
                        <li><a href="{{ route('services.healthcare') }}">Healthcare Lab</a></li>
                        <li><a href="{{ route('services.energy') }}">Alternative Energy</a></li>
                    </ul>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="single-footer-widget">
                    <h3>Contact Info</h3>

                    <ul class="footer-contact-info">
                        <li>
                            <i class="flaticon-facebook-placeholder-for-locate-places-on-maps"></i>
                            49, Suitland Street, c.g square, USA
                        </li>
                        <li>
                            <i class="flaticon-phone"></i>
                            <a href="tel:+199999999999">+1 999 9999 9999</a>
                        </li>
                        <li>
                            <i class="flaticon-smartphone-call"></i>
                            <a href="tel:+28885555555">+2 888 555 5555</a>
                        </li>
                        <li>
                            <i class="flaticon-close-envelope"></i>
                            <a href="mailto:info@labto.com">info@labto.com</a>
                        </li>
                        <li>
                            <i class="flaticon-internet"></i>
                            <a href="www.labto.com">www.labto.com</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="copyright-area">
            <div class="row align-items-center">
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <p>
                        © {{ date('Y') }} Labto is Proudly Owned by
                        <a href="https://envytheme.com/" target="_blank">EnvyTheme</a>
                    </p>
                </div>

                <div class="col-lg-6 col-md-6 col-sm-6">
                    <ul>
                        <li>
                            <a href="https://twitter.com/i/flow/login" target="_blank">
                                <i class="fab fa-twitter"></i>
                            </a>
                        </li>
                        <li>
                            <a href="https://www.youtube.com/?app=desktop&gl=SG&hl=en-GB" target="_blank">
                                <i class="fab fa-youtube"></i>
                            </a>
                        </li>
                        <li>
                            <a href="https://www.facebook.com/login/" target="_blank">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                        </li>
                        <li>
                            <a href="https://www.linkedin.com/login" target="_blank">
                                <i class="fab fa-linkedin-in"></i>
                            </a>
                        </li>
                        <li>
                            <a href="https://www.instagram.com/accounts/login/" target="_blank">
                                <i class="fab fa-instagram"></i>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- End Footer Area -->
