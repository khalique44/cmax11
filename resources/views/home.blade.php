@extends('layouts.app')

  
@section('content')


  @include('layouts.includes.nav')

  @include('layouts.includes.search-box')

  @include('layouts.includes.project-types')

      
  
  @if($popular_projects->count() > 0)
  @php 
   $popular_projects_title1 = GeneralHelper::getOption('popular_projects_title1');
   $popular_projects_title2 = GeneralHelper::getOption('popular_projects_title2');
  @endphp
    <section class="py-5">
       <div class="container">
          <div class="row text-center pb-3">
             <h5 class="sub-h">{{$popular_projects_title1 ?? 'Discover'}}</h5>
             <h2 class="main-h">{{$popular_projects_title2 ?? 'Popular Projects'}}</h2>
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

  @include('layouts.includes.why-choose-us')
    
  @include('layouts.includes.popular-locations')

   @php 
      $latest_blog_title = GeneralHelper::getOption('latest_blog_title');      
   @endphp
  <section class="py-5">
     <div class="container">
        <div class="row text-center pb-3">
           <h2 class="main-h">{{$latest_blog_title ?? 'Our Latest Blog'}}</h2>
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