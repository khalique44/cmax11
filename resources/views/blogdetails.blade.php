@extends('layouts.app')


@section('content')
@section('meta_title', html_entity_decode($post->title))
@section('meta_description', html_entity_decode($post->description))


@include('layouts.includes.nav')

<section class="py-3 mt-3 border-top">
   <div class="container">
      <div class="row justify-content-center mt-3">
          <div class="col-md-8">
              <div class="news-block mb-5 pb-5">
                  <h3 class="mb-3">{!!html_entity_decode($post->title)!!}</h3>
                  <p><i class="fa fa-calendar"></i> {!! $post->formatted_created_at  !!}</p>
                  <div class="news-img"><img src="{!! asset($post->file_url) !!}" alt="" class="w-100"></div>
                  <div class="content-block">
                      <p class="mt-4">{!! ($post->description) !!}</p>
                  </div>
              </div>
              
          </div>
          <div class="col-md-4">
              <h4 class="mb-4">Latest Posts</h4>

              @include('layouts.partials.related_posts_sidebar')

          </div>
      </div>
   </div>
</section>


@include('layouts.includes.footer')     

@endsection