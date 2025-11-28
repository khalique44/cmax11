@if($surveys->isEmpty())
    <div class="text-center text-muted"><h5>No surveys found.</h5></div>
@else
   
    @foreach($surveys as $s)
        
        <div class="col-md-4">
                <div class="survey-box">
                    @php
                        $isPdf = App\Http\Helpers\FileHelper::isPdf($s->file_url);
                    @endphp
                    <div class="image">
                            <a class="" href="{!! route('file.download',$s->id) !!}"><img src="{{ $s->thumbnail_url ?? asset('assets/img/clifton-bg1.png') }}" alt="">A</a>
                    </div>
                    <div class="text-center mt-2">
                        <p class="btn btn-red w-100">{{ $s->full_area . ', ' ?? ''  }} {{ $s->formatted_survey_date ?? '' }}</p>
                        @if($isPdf)
                            <a href="{{ url('/'.$s->file_url) }}" class="btn btn-success" target="_blank" title="View PDF File">
                                <i class="fa fa-eye"></i>
                            </a>
                            
                        @endif

                        <a href="{{ url('/download/'.$s->file_url) }}" class="btn btn-success" target="_blank" title="Download  File">
                            <i class="fa fa-cloud-download"></i>
                        </a>
                        
                    </div>
                </div>
        </div>
    @endforeach
       
@endif
