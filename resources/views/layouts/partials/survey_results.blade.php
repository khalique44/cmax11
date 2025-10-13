@if($surveys->isEmpty())
    <div class="text-center text-muted"><h5>No surveys found.</h5></div>
@else
   
    @foreach($surveys as $s)
        
        <div class="col-md-4">
                <div class="survey-box">
                    <div class="image">
                            <a class="" href="{!! route('file.download',$s->id) !!}"><img src="{{ $s->thumbnail_url ?? asset('assets/img/clifton-bg1.png') }}" alt="">A</a>
                    </div>
                    <div class="text-center mt-2">
                            <a class="btn btn-red w-100" href="{!! route('file.download',$s->id) !!}"><i class="fa fa-cloud-download"></i> {{ $s->full_area . ', ' ?? ''  }} {{ $s->formatted_survey_date ?? '' }}</a>
                    </div>
                </div>
        </div>
    @endforeach
       
@endif
