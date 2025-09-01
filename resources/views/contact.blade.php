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

                <form id="contactForm" action="{{ route('contact.store') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-lg-6 col-md-6">
                            <div class="form-group">
                                <input type="text" class="form-control @error('name') is-invalid @enderror" placeholder="Your Name" name="name" id="name" value="{{ old('name') }}" required>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-lg-6 col-md-6">
                            <div class="form-group">
                                <input type="email" class="form-control @error('email') is-invalid @enderror" placeholder="Your Email Address" name="email" id="email" value="{{ old('email') }}" required>
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-lg-6 col-md-6">
                            <div class="form-group">
                                <input type="text" class="form-control @error('phone_number') is-invalid @enderror" name="phone_number" placeholder="Phone Number" id="phone_number" value="{{ old('phone_number') }}">
                                @error('phone_number')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-lg-6 col-md-6">
                            <div class="form-group">
                                <input type="text" class="form-control @error('subject') is-invalid @enderror" name="subject" placeholder="Subject" id="subject" value="{{ old('subject') }}" required>
                                @error('subject')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-lg-12 col-md-12">
                            <div class="form-group">
                                <textarea name="message" class="form-control @error('message') is-invalid @enderror" id="message" cols="30" rows="10" placeholder="Type Your Message Here" required>{{ old('message') }}</textarea>
                                @error('message')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-lg-12 col-md-12">
                            <button type="submit" class="btn btn-primary" id="submitBtn">
                                <span class="btn-text">Send Message</span>
                                <span class="btn-loading d-none">
                                    <i class="fas fa-spinner fa-spin"></i> Sending...
                                </span>
                            </button>
                            <div id="msgSubmit" class="mt-3"></div>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </form>


            </div>
        </section>
<!-- End Contact Area -->

<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('contactForm');
    const submitBtn = document.getElementById('submitBtn');
    const btnText = submitBtn.querySelector('.btn-text');
    const btnLoading = submitBtn.querySelector('.btn-loading');
    const msgSubmit = document.getElementById('msgSubmit');

    form.addEventListener('submit', function(e) {
        e.preventDefault();

        // Show loading state
        submitBtn.disabled = true;
        btnText.classList.add('d-none');
        btnLoading.classList.remove('d-none');

        // Get form data
        const formData = new FormData(form);

        // Send AJAX request
        fetch(form.action, {
            method: 'POST',
            body: formData,
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'application/json',
            }
        })
        .then(response => {
            if (!response.ok) {
                return response.json().then(data => {
                    throw new Error(JSON.stringify(data));
                });
            }
            return response.json();
        })
        .then(data => {
            if (data.success) {
                // Success message
                msgSubmit.innerHTML = `
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="fas fa-check-circle me-2"></i>
                        ${data.message}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                `;

                // Reset form
                form.reset();

                // Scroll to message
                msgSubmit.scrollIntoView({ behavior: 'smooth' });
            } else {
                // Error message
                msgSubmit.innerHTML = `
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="fas fa-exclamation-circle me-2"></i>
                        ${data.message}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                `;
            }
        })
        .catch(error => {
            let errorMessage = 'Network error. Please check your connection and try again.';

            try {
                const errorData = JSON.parse(error.message);
                if (errorData.errors) {
                    // Handle validation errors
                    const errorList = Object.values(errorData.errors).flat().join('<br>');
                    errorMessage = `Please fix the following errors:<br>${errorList}`;
                } else if (errorData.message) {
                    errorMessage = errorData.message;
                }
            } catch (e) {
                // If parsing fails, use the original error message
                console.error('Error parsing response:', error);
            }

            // Display error message
            msgSubmit.innerHTML = `
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="fas fa-exclamation-circle me-2"></i>
                    ${errorMessage}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            `;
        })
        .finally(() => {
            // Reset button state
            submitBtn.disabled = false;
            btnText.classList.remove('d-none');
            btnLoading.classList.add('d-none');
        });
    });
});
</script>

<style>
.btn-loading {
    display: none;
}

.d-none {
    display: none !important;
}

.alert {
    border-radius: 8px;
    border: none;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
}

.alert-success {
    background-color: #d4edda;
    color: #155724;
    border-left: 4px solid #28a745;
}

.alert-danger {
    background-color: #f8d7da;
    color: #721c24;
    border-left: 4px solid #dc3545;
}

.alert-dismissible .btn-close {
    padding: 0.75rem 1rem;
}
</style>
@endsection
