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
										 <select name="area" class="form-control select2" id="full_area" >
											<option value="">All Area</option>
											@if(!empty($uniqueAreaSurveys))
												@foreach($uniqueAreaSurveys as $record)
													<option value="{{$record->area_id.'|'.$record->sub_area_id}}">{{$record->full_area}}</option>
												@endforeach
											@endif
										 </select>
										 
									 </div>
									<div class="col-md-2">
										<label class="form-label">Select Year</label>
										@php $currentYear = now()->year; @endphp
										<select id="yearSelect" class="form-select select2">
											<option value="">All Years</option>
											@foreach ($years as $year)
												<option value="{{ $year }}" >
													{{ $year }}
												</option>
											@endforeach
										</select>
									</div>
									<div class="col-md-2">
										<label class="form-label">Select Month</label>
										<select id="monthSelect" class="form-select select2">
											<option value="">All Months</option>
											@foreach ($months as $num => $month)
												<option value="{{ $month }}" >
													{{ \Carbon\Carbon::create()->month($month)->format('F') }}
												</option>
											@endforeach
										</select>
									</div>
									<div class="col-md-4 text-end pt-2">
									 <button type="button" onClick="fetchFilters();" class="btn btn-primary mt-3 w-100">Get Survey</button>
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
			<div class="row" id="surveyResults">
				<div class="text-muted text-center">Select any area, year or month to display surveys.</div>
		 </div>
	 </div>
</section>


@include('layouts.includes.footer')     

@endsection