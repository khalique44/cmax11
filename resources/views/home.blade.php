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

  @include('layouts.includes.dream-property')

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
  
  @include('layouts.includes.popular-locations')


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