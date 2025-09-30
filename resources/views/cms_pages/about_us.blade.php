@extends('layouts.app')

  
@section('content')


  @include('layouts.includes.nav')    

  @php $bg_image = ""; @endphp
  @if(!empty($aboutus_header_image))
    @php $bg_image = asset($aboutus_header_image); @endphp
  @endif

  <section class="my-banner" style="{!! !empty($aboutus_header_image) ? 
    'background: url('.$bg_image.');     
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;' : '' !!}">
     <div class="container">
        <div class="row">
           <div data-aos="fade-in" class="col-lg-12">
              <div class="first-heading mb-5 d-block">
                 <h2 class="first-h text-center">{{$aboutus_title}}</h2>
              </div>
              <!-- <p class="pe-lg-5 me-lg-5 sub-text">We provide a complete service for the sale, purchase or rental pf real estate.</p> -->
           </div>
        </div>

     </div>
  </section>
  <section class="py-5">
     <div class="container">
        <div class="row text-center">
           <h5 class="sub-h">{{$aboutus_section1_title1}}</h5>
           <h2 class="main-h">{{$aboutus_section1_title2}}</h2>
           <div class="row justify-content-center mt-3">
            <div class="col-md-9">
                <p class="mb-0">{!! nl2br($aboutus_section1_description1) !!}</p>
            </div>
           </div>
        </div>
     </div>
  </section>
  
  <section class="dream-sec py-5">
     <div class="container py-5 px-3 px-sm-5">
        <div class="row">
           <div class="col-md-12 text-center">
              <h5 class="sub-h">{{$aboutus_section2_title1}}</h5>
              <h2 class="main-h mb-4">{{$aboutus_section2_title2}}</h2>
           </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-9 text-center">
                <p>{!! nl2br($aboutus_section2_description1) !!}</p>
            </div>
        </div>
     </div>
  </section>
  <section>
     <div class="container pb-5">
        <div class="row">
           <div data-aos="fade-right" class="col-md-6">
            @if(!empty($aboutus_section3_image1))
              <img src="{{asset($aboutus_section3_image1)}}" alt="Image" class="mb-3">
                  
            @else
              <img src="{!! asset('assets/img/mission.png') !!}" alt="" class="mb-3">
            @endif
            
              <h2 class="main-h mb-3">{{$aboutus_section3_title1}}</h2>
              <p>{!! nl2br($aboutus_section3_description1) !!}</p>
           </div>
           <div data-aos="fade-right" class="col-md-6">
            @if(!empty($aboutus_section3_image2))
              <img src="{{asset($aboutus_section3_image2)}}" alt="Image" class="mb-3">
                  
            @else
              <img src="{!! asset('assets/img/vision.png') !!}" alt="" class="mb-3">
            @endif
            
            <h2 class="main-h mb-3">{{$aboutus_section3_title2}}</h2>
              <p>{!! nl2br($aboutus_section3_description2) !!}</p>
           </div>
        </div>
     </div>
  </section>
  
  @include('layouts.includes.inquiry-form')

  @include('layouts.includes.footer')     

       
 @endsection