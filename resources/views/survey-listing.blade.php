@extends('layouts.app')


@section('content')


@include('layouts.includes.nav')

<section class="my-banner survey-banner" style="background-image: {{asset('assets/img/clifton-bg1.png')}});">
	<div class="container">
			<div class="row">
				 <div data-aos="fade-in text-center" class="col-lg-12">
					<div class="first-heading mb-5 text-center w-100 d-block">
						 <h2 class="first-h text-center">Know Before You Invest</h2>
						 <h3> Karachi Property Price Survey by Cmax.pk!</h3>
				 	</div>
				 
			 </div>
		</div>
	 <div data-aos="fade-in" class="row justify-content-center">
			 <div class="col-lg-10">
					<form class="banner-form">
						 <div class="row g-2">
								<div class="col-md-12">
									 <div class="row">
										<div class="col-md-4">
										 <label class="form-label">Select Area</label>
										 <input type="text" class="form-control" value="Clifton Block 1" readonly>
									 </div>
									 <div class="col-md-4">
										 <label class="form-label">Choose Category</label>
										 <select class="form-select">
											<option selected>Builder</option>
										</select>
									</div>
									<div class="col-md-4 text-end pt-2">
									 <button type="submit" class="btn btn-primary mt-3 w-100">Get Survey</button>
								 </div>
							 </div>
						 </div>
					 
					</div>
				</form>
			</div>
		</div>


	</div>
</section>

<section class="survey-boxes py-5">
	 <div class="container">
			<div class="row">
				<div class="col-md-4">
					 <div class="survey-box">
							<div class="image">
								 <img src="{!! asset('assets/img/clifton-bg1.png') !!}" alt="">
							</div>
							<div class="text-center mt-2">
								 <button class="btn btn-red w-100"><i class="fa fa-cloud-download"></i> Clifton PDF</button>
							</div>
					 </div>
				</div>
				<div class="col-md-4">
					 <div class="survey-box">
							<div class="image">
								 <img src="{!! asset('assets/img/clifton-bg1.png') !!}" alt="">
							</div>
							<div class="text-center mt-2">
								 <button class="btn btn-red w-100"><i class="fa fa-cloud-download"></i> DHA PDF</button>
							</div>
					 </div>
				</div>
				<div class="col-md-4">
					 <div class="survey-box">
							<div class="image">
								 <img src="{!! asset('assets/img/clifton-bg1.png') !!}" alt="">
							</div>
							<div class="text-center mt-2">
								 <button class="btn btn-red w-100"><i class="fa fa-cloud-download"></i> Scheme 45 PDF</button>
							</div>
					 </div>
				</div>
				<div class="col-md-4">
					 <div class="survey-box">
							<div class="image">
								 <img src="{!! asset('assets/img/clifton-bg1.png') !!}" alt="">
							</div>
							<div class="text-center mt-2">
								 <button class="btn btn-red w-100"><i class="fa fa-cloud-download"></i> Clifton PDF</button>
							</div>
					 </div>
				</div>
				<div class="col-md-4">
					 <div class="survey-box">
							<div class="image">
								 <img src="{!! asset('assets/img/clifton-bg1.png') !!}" alt="">
							</div>
							<div class="text-center mt-2">
								 <button class="btn btn-red w-100"><i class="fa fa-cloud-download"></i> DHA PDF</button>
							</div>
					 </div>
				</div>
				<div class="col-md-4">
					 <div class="survey-box">
							<div class="image">
								 <img src="{!! asset('assets/img/clifton-bg1.png') !!}" alt="">
							</div>
							<div class="text-center mt-2">
								 <button class="btn btn-red w-100"><i class="fa fa-cloud-download"></i> Scheme 45 PDF</button>
							</div>
					 </div>
				</div>
		 </div>
	 </div>
</section>


@include('layouts.includes.footer')     

@endsection