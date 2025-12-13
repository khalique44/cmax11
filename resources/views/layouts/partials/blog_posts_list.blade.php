@if(!empty($records))
  @foreach($records as $key => $record)
    <div class="news-block mb-5 border-bottom pb-5">
      <div class="news-img"><img src="{{ asset($record->file_url) }}" alt="Main Image" class="w-100"></div>
      <div class="content-block">
        <h3 class="mt-3">{!! $record->title !!}</h3>
        <p class="mb-4">{!! nl2br($record->short_description) !!}</p>
        <div class="row mt-4">
          <div class="col-6">
            <a href="{{url('blog')}}/{{$record->id}}" class="btn btn-red">Read More</a>
          </div>
          <div class="col-6 text-end">
            <i class="fa fa-calendar"></i> {!! $record->formatted_created_at  !!}
          </div>
        </div>
      </div>
    </div>
  @endforeach
  {!! $records->links('vendor.pagination.custom') !!}
@else
    <p>No posts found.</p>
@endif