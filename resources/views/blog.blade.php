@extends('layouts.app')
@section('meta_title',  "Blog" )


@section('content')


@include('layouts.includes.nav')

<section class="py-5">
  <div class="container blog-posts">
    <div class="row justify-content-center mt-3">
      <div class="col-md-8 " id="blog-posts-list">

        @include('layouts.partials.blog_posts_list')
       
      </div>
      <div class="col-md-4">
        <h4 class="mb-4">Latest Posts</h4>
        @if(!empty($latestPosts))
          @foreach($latestPosts as $key => $latestPost)

          <div class="row news-smalblocl border-bottom mb-2 pb-2">
            <div class="col-4">
              <a href="{{url('blog')}}/{{$latestPost->id}}" ><img src="{!! asset($latestPost->file_url) !!}" alt="" class="w-100"></a>
            </div>
            <div class="col-8">
              <h6><a href="{{url('blog')}}/{{$latestPost->id}}" > {!! $latestPost->title !!}</a></h6>
              <p>{!! ($latestPost->short_description) !!}</p>
            </div>
          </div>
          @endforeach
        @endif
   

      </div>
    </div>
  </div>
</section>


@include('layouts.includes.footer')     

@endsection