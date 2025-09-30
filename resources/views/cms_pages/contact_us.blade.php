@extends('layouts.app')

	
@section('content')


	@include('layouts.includes.nav')    

	@php $bg_image = ""; @endphp
	@if(!empty($contact_header_image))
		@php $bg_image = asset($contact_header_image); @endphp
	@endif

	<section class="my-banner" style="{!! !empty($contact_header_image) ? 
    'background: url('.$bg_image.');     
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;' : '' !!}">
		<div class="container">
			<div class="row">
				<div data-aos="fade-in" class="col-lg-12">
					<div class="first-heading mb-5 d-block">
						<h2 class="first-h text-center">{{ $contact_title }}</h2>
					</div>
					<!-- <p class="pe-lg-5 me-lg-5 sub-text">We provide a complete service for the sale, purchase or rental pf real estate.</p> -->
				</div>
			</div>

		</div>
	</section>
	<section class="py-5">
		<div class="container">
			<div class="row justify-content-center mt-3">
				<div class="col-md-8">
					<div class="row">
						<div class="col-md-8">
							<h4 class="sub-h4 mb-4">Message Us</h4>

							<form class="contact-form" id="contactForm">
							    @csrf
							    <div class="form-group mb-3">
							        <input type="text" title="Full Name" name="name" class="form-control" placeholder="Full Name" required>
							    </div>
							    <div class="form-group mb-3">
							        <input type="email" title="Email" name="email" class="form-control" placeholder="Email" required>
							    </div>
							    <div class="form-group mb-3">
							        <input type="text" title="Phone" name="phone" class="form-control" placeholder="Phone">
							    </div>
							    <div class="form-group mb-3">
							        <textarea name="message" title="Message" class="form-control" placeholder="Message" rows="5" required></textarea>
							    </div>

							    <button type="submit" class="btn btn-red">
							        Submit
							    </button>
							    <div class="contact-ajax-message mt-3"></div>
							</form>

						</div>
						<div class="col-md-4">
							<div class="contact-details">
								<h4 class="sub-h4 text-white mb-5">Drop In Office</h4>

								<div class="mb-4">
									<div class="labeltext">CONTACT NO</div>
									<p>{{ $contact_phone_number }}</p>
								</div>
								<div class="mb-4">
									<div class="labeltext">EMAIL ADDRESS</div>
									<p>{{ $contact_email_address }}</p>
								</div>
								<div class="mb-4">
									<div class="labeltext">ADDRESS</div>
									<p>{{ $contact_address }}</p>
								</div>

							</div>
						</div>
					</div>
				</div>

			</div>
		</div>
	</section>
	<section class="maps-sec mb-5">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-md-12">
					{!! $contact_embed_map !!}
				</div>
			</div>
		</div>
	</section> 
	

	@include('layouts.includes.footer')     

			 
 @endsection