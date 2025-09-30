@if(!empty($latestPosts))
  @foreach($latestPosts as $key => $latestPost)

  <div class="row news-smalblocl border-bottom mb-2 pb-2">
    <div class="col-4">
      <a href="{{url('blog')}}/{{$latestPost->id}}" ><img src="{{ asset($latestPost->file_url) }}" alt="" class="w-100"></a>
    </div>
    <div class="col-8">
      <h6><a href="{{url('blog')}}/{{$latestPost->id}}" > {!! $latestPost->title !!}</a></h6>
      <p>{!! ($latestPost->short_description) !!}</p>
    </div>
  </div>
  @endforeach
@endif