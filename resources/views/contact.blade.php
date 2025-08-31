@extends('layouts.app')

@section('title', 'Contact Us - Labto')

@section('content')
<!-- Start Page Title Area -->
<div class="page-title-area">
	<div class="container">
		<div class="page-title-content">
			<h2>Contact</h2>
                <ul>
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li>Contact</li>
                </ul>
		</div>
	</div>
</div>
<!-- End Page Title Area -->
<!-- Start Contact Area -->
<section class="contact-area pt-3 pt-md-5">
            <div class="container">
                <div class="section-title text-center">
                    <h2>Drop us message for any query</h2>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Quis ipsum suspendisse ultrices gravida. Risus commodo viverra.</p>
                </div>

                <form id="contactForm">
                    <div class="row">
                        <div class="col-lg-6 col-md-6">
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Your Name" name="name" id="name" required data-error="Please enter your name">
                                <div class="help-block with-errors"></div>
                            </div>
                        </div>

                        <div class="col-lg-6 col-md-6">
                            <div class="form-group">
                                <input type="email" class="form-control" placeholder="Your Email Address" name="email" id="email" required data-error="Please enter your email">
                                <div class="help-block with-errors"></div>
                            </div>
                        </div>

                        <div class="col-lg-6 col-md-6">
                            <div class="form-group">
                                <input type="text" class="form-control" name="phone_number" placeholder="Phone Number" id="phone_number" required data-error="Please enter your number">
                                <div class="help-block with-errors"></div>
                            </div>
                        </div>

                        <div class="col-lg-6 col-md-6">
                            <div class="form-group">
                                <input type="text" class="form-control" name="msg_subject" placeholder="Subject" id="msg_subject" required data-error="Please enter your subject">
                                <div class="help-block with-errors"></div>
                            </div>
                        </div>

                        <div class="col-lg-12 col-md-12">
                            <div class="form-group">
                                <textarea name="message" class="form-control" id="message" cols="30" rows="10" placeholder="Type Your Message Here" required data-error="Write your message"></textarea>
                                <div class="help-block with-errors"></div>
                            </div>
                        </div>

                        <div class="col-lg-12 col-md-12">
                            <button type="submit" class="btn btn-primary">Send Message</button>
                            <div id="msgSubmit" class="h3 text-center hidden"></div>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </form>

                <div class="contact-info">
                    <div class="section-title text-center">
                        <h2>Don't Hesitate to contact with us</h2>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Quis ipsum suspendisse ultrices gravida. Risus commodo viverra.</p>
                    </div>

                    <div class="contact-info-content">
                        <h3>Call us for imidiate support to this number</h3>
                        <h2><a href="tel:+0881306298615">+088 130 629 8615</a></h2>

                        <ul class="social">
                            <li><a href="https://twitter.com/i/flow/login" target="_blank"><i class="fab fa-twitter"></i></a></li>
                            <li><a href="https://www.youtube.com/?app=desktop&gl=SG&hl=en-GB" target="_blank"><i class="fab fa-youtube"></i></a></li>
                            <li><a href="https://www.facebook.com/login/" target="_blank"><i class="fab fa-facebook-f"></i></a></li>
                            <li><a href="https://www.linkedin.com/login" target="_blank"><i class="fab fa-linkedin-in"></i></a></li>
                            <li><a href="https://www.instagram.com/accounts/login/" target="_blank"><i class="fab fa-instagram"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>
<!-- End Contact Area -->
@endsection
