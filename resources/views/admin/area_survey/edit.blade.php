@extends('layouts.admin')

@section('content')
    <div class="right-side-section">
        <div class="right-section-content">
            <div class="admin-sec-btn-area">
                <div class="report-title-section">
                    <h4>Edit Survey</h4>
                </div>
                <div class="district-back-del-btn-area">
                    <div class="distrcit-back-btn">
                        <a href="{{url('admin/surveys/')}}" data-toggle="" data-target="#search-db-model"  class="btn btn-sm btn-warning">Back</a>

                    </div>
                </div>
            </div>
            <!--  ===============================  -->
            <!--  ======= Builders Section ===========  -->
            <!--  ===============================  -->
            <div class="container mt-3">
                @include('layouts.partials.messages')
                <div class="row">
                    <div class="ajax-msg"></div>
                    <div class="col-xs-12">
                        <div class="">
                            
                            <form class="" method="POST"  enctype="multipart/form-data" id="survey-form-update">
                                 {{csrf_field()}}
                                @method('PUT')
                                <input type="hidden" name="survey_id" value="{{ $record->id }}">
                                    
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">                                       
                                            <label class="form-label">Area</label>
                                            <select name="area" id="area" class="form-control select2" required>
                                                <option value="">Select Area</option>
                                                @foreach($areas as $key => $area)
                                                    <option value="{{ $area }}" @selected($area == $areaFullName) >{{ ($area) }}</option>
                                                @endforeach
                                            </select>
                                                            
                                        </div>
                                    </div>
                                     <div class="col-md-6">
                                        <div class="form-group">                                       
                                            <label class="form-label">Survey Date</label>
                                            <div id="datepicker"></div>
                                            <input type="hidden" class="form-control" value="{{ $record->survey_date ?? '' }}" id="survey_date" name="survey_date" placeholder="Survey Date" >
                                            
                                                            
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-{!! !empty($record->file_url) ? '6' : '12' !!} mb-3 mt-3">   
                                        <div class="form-group">
                                            <!-- File Upload -->                                        
                                            <label class="form-label">Upload File (CSV,EXCEL,PDF)</label>
                                            <input type="file" name="file_url" id="file_url"  class="form-control" accept=".xlsx,.xls,.csv,application/pdf" >
                                        </div>
                                    </div>

                                    

                                    @if(!empty($record->file_url))
                                        <div class="col-xs-6 mb-3 mt-3">   
                                            <div class="form-group">
                                                <a href="{{route('file.download',$record->id)}}" class="btn btn-sm btn-success" >Download
                                                </a>

                                                <a href="javascript:;" class="btn btn-sm btn-danger remove_file"  data-path="{{route('file.remove',$record->id)}}">Remove
                                                </a>
                                            </div>
                                        </div>
                                            
                                    @endif
                                </div> 
                                <div class="row">
                                    <div class="col-xs-{!! !empty($record->thumbnail_url) ? '6' : '12' !!} mb-3 mt-3"> 
                                        <div class="form-group">
                                            <!-- File Upload -->
                                            
                                            <label class="form-label">Upload Thumbnail</label>
                                            <input type="file" name="thumbnail_url" id="thumbnail_url"  class="form-control" accept="image/*">
                                                
                                                            
                                        </div>
                                    </div>  
                                    @if(!empty($record->thumbnail_url))
                                        <div class="col-xs-6 mb-3 mt-3">   
                                            <div class="form-group">
                                                <a href="{{asset($record->thumbnail_url)}}" class="" target="_blank" ><img src="{{asset($record->thumbnail_url)}}" class="logo" alt="Logo" width="100px">
                                                </a>
                                            </div>
                                        </div>
                                            
                                    @endif
                                </div>                                                    
                               
                                                         

                                <div class="col-xs-12 mb-3 mt-3">
                                    <div class="form-group">
                                       
                                        <div class="form-check form-switch">
                                          <input class="form-check-input" type="checkbox" id="is_active" name="is_active" @checked($record->is_active == 1)>
                                          <label class="form-check-label" for="is_active">Status</label>
                                        </div>                                    
                                    </div>
                                </div>   

                                <div class="col-xs-12">
                                    <div class="form-group">
                                        <button type="submit" href="javascript:void(0);" id="btn_save" class="btn btn-success">
                                            Save
                                        </button>

                                        <a href="{{url('admin/surveys/')}}" data-toggle="" data-target="#search-db-model"  class="btn btn-warning">Back</a>
                                        
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>


@endsection
@section('scripts')



@endsection