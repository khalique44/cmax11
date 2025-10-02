@extends('layouts.app')


@section('content')


@include('layouts.includes.nav')    

@php $bg_image = ""; @endphp
@if(!empty($privacy_policy_header_image))
@php $bg_image = asset($privacy_policy_header_image); @endphp
@endif

<section class="my-banner carers-banner" style="{!! !empty($privacy_policy_header_image) ? 
	'background: url('.$bg_image.');     
	background-size: cover;
	background-position: top;
	background-repeat: no-repeat;' : '' !!}">
	<div class="container">
		<div class="row">
			<div data-aos="fade-in" class="col-lg-12">
				<div class="first-heading mb-5 d-block">
					<h2 class="first-h text-center">{{$privacy_policy_title}}</h2>
				</div>
				<!-- <p class="pe-lg-5 me-lg-5 sub-text">We provide a complete service for the sale, purchase or rental pf real estate.</p> -->
			</div>
		</div>

	</div>
</section>

<section class="py-5">
	<div class="container py-5 px-3 px-sm-5">
		<div class="row">
			<div class="col-md-12 text-start">
				<div class="career-sec">
					{!! $privacy_policy_description !!}

				</div>

			</div>
			
		</div>
	</div>
</section>

@include('layouts.includes.inquiry-form')

@include('layouts.includes.footer')     


@endsection