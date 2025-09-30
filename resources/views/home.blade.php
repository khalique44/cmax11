@extends('layouts.app')

  
@section('content')


  @include('layouts.includes.nav')

  @include('layouts.includes.search-box')

  @include('layouts.includes.project-types')

      
  
  @if($popular_projects->count() > 0)
    <section class="py-5">
       <div class="container">
          <div class="row text-center pb-3">
             <h5 class="sub-h">Discover</h5>
             <h2 class="main-h">Popular Projects</h2>
          </div>
          <div class="row">
             @include('projects.partials.short_list',['projects' => $popular_projects])
          </div>
          <div class="row mt-4">
             <div class="col-md-12 text-center">
                <a href="{{route('search-results')}}" class="detail-btn d-inline-block">More Details</a>
             </div>
          </div>
       </div>
    </section>
  @endif
  <section class="dream-sec py-5">
     <div class="container py-5 px-3 px-sm-5">
        <div class="row">
           <div class="col-md-12 text-center">
              <h5 class="sub-h">Unlock Your</h5>
              <h2 class="main-h">Dream Property</h2>
           </div>
        </div>
        <div class="row mt-4">
           <div data-aos="fade-up" class="col-md-3 text-center dp-col mb-3 mb-md-0">
              <div class="dp-div text-center position-relative">
                 <i class="fa fa-search" aria-hidden="true"></i>
                 <span class="number">01</span>
              </div>
              <h6 class="mt-3">Discover Property</h6>
              <p class="mb-0">The parties interact with onw another in a digital format,rather than in person or over the phone.</p>
           </div>
           <div data-aos="fade-up" class="col-md-3 text-center dp-col mb-3 mb-md-0">
              <div class="dp-div text-center position-relative">
                 <i class="fa fa-calendar" aria-hidden="true"></i>
                 <span class="number">02</span>
              </div>
              <h6 class="mt-3">Discover Property</h6>
              <p class="mb-0">The parties interact with onw another in a digital format,rather than in person or over the phone.</p>
           </div>
           <div data-aos="fade-up" class="col-md-3 text-center dp-col mb-3 mb-md-0">
              <div class="dp-div text-center position-relative">
                 <i class="fa fa-users" aria-hidden="true"></i>
                 <span class="number">03</span>
              </div>
              <h6 class="mt-3">Discover Property</h6>
              <p class="mb-0">The parties interact with onw another in a digital format,rather than in person or over the phone.</p>
           </div>
           <div data-aos="fade-up" class="col-md-3 text-center dp-col mb-3 mb-md-0">
              <div class="dp-div text-center position-relative">
                 <i class="fa fa-home" aria-hidden="true"></i>
                 <span class="number">04</span>
              </div>
              <h6 class="mt-3">Discover Property</h6>
              <p class="mb-0">The parties interact with onw another in a digital format,rather than in person or over the phone.</p>
           </div>
        </div>
     </div>
  </section>
  <section>
     <div class="container pb-5" style="border-bottom: 1px solid #DCDCEB;">
        <div class="row align-items-center">
           <div data-aos="fade-right" class="col-md-4">
              <h5 class="sub-h">Why choose us?</h5>
              <h2 class="main-h">Benefits of Our Real Estate Services</h2>
           </div>
           <div data-aos="fade-left" class="col-md-8">
              <div class="row">
                 <div class="four col-md-4">
                    <div class="counter-box colored">
                       <span>$</span><span class="counter">520</span><span>+</span>
                       <p>Million Real Estate Sold</p>
                    </div>
                 </div>
                 <div class="four col-md-4">
                    <div class="counter-box">
                       <span class="counter">2000</span><span>+</span>
                       <p>Over 2000 5 Star Reviews</p>
                    </div>
                 </div>
                 <div class="four col-md-4">
                    <div class="counter-box">
                       <span class="counter">675</span> <span>Sold</span>
                       <p>Over 2000 5 Star Reviews</p>
                    </div>
                 </div>
              </div>
           </div>
        </div>
     </div>
  </section>
  <section class="py-5">
     <div class="container">
        <div class="row text-center pb-3">
           <h5 class="sub-h">Explore</h5>
           <h2 class="main-h">Popular Locations</h2>
        </div>
        <div class="row">
           <div data-aos="fade-up" class="col-12 col-md-6 mb-3 mb-md-0">
              <a href="#">
              <div class="loc-div">
                 <p class="pt-4 ps-4 mb-0 loc-p z-index-9 position-relative">8 Properties</p>
                 <p class="ps-4 mb-0 loc-h z-index-9 position-relative">Clifton</p>
              </div>
           </a>
           </div>
           <div data-aos="fade-up" class="col-6 col-md-3 mb-3 mb-md-0">
              <a href="#">
              <div class="loc-div boat-div">
                 <p class="pt-4 ps-4 mb-0 loc-p z-index-9 position-relative">2 Properties</p>
                 <p class="ps-4 mb-0 loc-h z-index-9 position-relative">Boat Basin</p>
              </div>
              </a>
           </div>
           <div data-aos="fade-up" class="col-6 col-md-3 mb-3 mb-md-0">
              <a href="#">
              <div class="loc-div scheme-div">
                 <p class="pt-4 ps-4 mb-0 loc-p z-index-9 position-relative">1 Property</p>
                 <p class="ps-4 mb-0 loc-h z-index-9 position-relative">Scheme 33</p>
              </div>
           </a>
           </div>
        </div>
        <div class="row mt-md-4">
           <div data-aos="fade-up" class="col-12 col-md-3 mb-3 mb-md-0">
              <a href="#">
              <div class="loc-div bahria-div">
                 <p class="pt-4 ps-4 mb-0 loc-p z-index-9 position-relative">0 Properties</p>
                 <p class="ps-4 mb-0 loc-h z-index-9 position-relative">Bahria</p>
              </div>
           </a>
           </div>
           <div data-aos="fade-up" class="col-6 col-md-3 mb-3 mb-md-0">
              <a href="#">
              <div class="loc-div defence-div">
                 <p class="pt-4 ps-4 mb-0 loc-p z-index-9 position-relative">3 Properties</p>
                 <p class="ps-4 mb-0 loc-h z-index-9 position-relative">Defence</p>
              </div>
           </a>
           </div>
           <div data-aos="fade-up" class="col-6 col-md-6 mb-3 mb-md-0">
              <a href="#">
              <div class="loc-div kemari-div">
                 <p class="pt-4 ps-4 mb-0 loc-p z-index-9 position-relative">2 Properties</p>
                 <p class="ps-4 mb-0 loc-h z-index-9 position-relative">Kemari</p>
              </div>
           </a>
           </div>
        </div>
     </div>
  </section>
 
  <section class="py-5">
     <div class="container">
        <div class="row text-center pb-3">
           <h2 class="main-h">Our Latest Blog</h2>
        </div>
        <div class="row">
          @if(!empty($latestPosts))
            @foreach($latestPosts as $key => $latestPost)
             <div data-aos="fade-up" class="col-md-4 mb-3 mb-md-0">
                <div class="project-div position-relative">
                   <img src="{{ asset($latestPost->file_url) }}" alt="" width="100%" style="border-radius: 20px 20px 0px 0px;">
                   <div class="p-4 text-center">
                      <p class="blog-des">{!! $latestPost->formatted_created_at  !!}</p>
                      <h6 class="blog-title">{!! $latestPost->title !!}</h6>
                      <a href="{{url('blog')}}/{{$latestPost->id}}" class="read-more-btn d-inline-block">Read More <i class="fa fa-arrow-right" aria-hidden="true"></i></a>
                   </div>
                </div>
             </div>
            @endforeach
           @endif
           
        </div>
     </div>
  </section>
  

  @include('layouts.includes.inquiry-form')

  @include('layouts.includes.footer')     

       
 @endsection