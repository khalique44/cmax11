@extends('layouts.app')


@section('content')


@include('layouts.includes.nav')    

@php $bg_image = ""; @endphp
@if(!empty($career_header_image))
@php $bg_image = asset($career_header_image); @endphp
@endif

<section class="my-banner carers-banner" style="{!! !empty($career_header_image) ? 
	'background: url('.$bg_image.');     
	background-size: cover;
	background-position: top;
	background-repeat: no-repeat;' : '' !!}">
	<div class="container">
		<div class="row">
			<div data-aos="fade-in" class="col-lg-12">
				<div class="first-heading mb-5 d-block">
					<h2 class="first-h text-center">{{$career_title}}</h2>
				</div>
				<!-- <p class="pe-lg-5 me-lg-5 sub-text">We provide a complete service for the sale, purchase or rental pf real estate.</p> -->
			</div>
		</div>

	</div>
</section>

<section class="py-5">
	<div class="container py-5 px-3 px-sm-5">
		<div class="row">
			<div class="col-md-8 text-start">
				<div class="career-sec">
					{!! $career_description !!}

				</div>

			</div>
			<div class="col-md-4">
				<div class="calculator_budget">
					<div class="text-center pb-3">
						<h2 class="main-h mb-4">Careers Form</h2>

						<form class="calc-form">
							<div class="form-group mt-3">
								<input type="text" placeholder="Name" class="form-control">
							</div>
							<div class="form-group mt-3">
								<input type="email" placeholder="Email" class="form-control">
							</div>
							<div class="form-group mt-3">
								<input type="text" placeholder="Contact Number" class="form-control">
							</div>

							<div class="form-group mt-3">
								<select name="area_of_interest" id="area_of_interest" class="form-select">
									<option value="">Areas of Interest</option>
									<option value="Marketing">Marketing</option>
									<option value="Sales">Sales</option>
									<option value="HR">HR</option>
								</select>
							</div>

							<div class="form-group mt-3">
								<button class="btn btn-red w-100">Submit Request</button>
							</div>
						</form>

					</div>
				</div>
			</div>
		</div>
	</div>
</section>

@include('layouts.includes.inquiry-form')

@include('layouts.includes.footer')     


@endsection