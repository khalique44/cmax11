@extends('layouts.admin')

@section('content')
    <div class="right-side-section">
        <div class="right-section-content">
            <div class="admin-sec-btn-area">
                <div class="report-title-section">
                    <h4>Create Survey</h4>
                </div>
                <div class="district-back-del-btn-area">
                    <div class="distrcit-back-btn">
                        <a href="{{url('admin/area_surveys/')}}" data-toggle="" data-target="#search-db-model"  class="btn btn-sm btn-warning">Back</a>

                    </div>
                </div>
            </div>
            <!--  ===============================  -->
            <!--  ======= area_surveys Section ===========  -->
            <!--  ===============================  -->
            <div class="container mt-3">
                <div class="row">
                    <div class="ajax-msg"></div>
                    <div class="col-xs-12">
                        <div class="">
                            
                            <form class="" method="POST" action="{{url('admin/area_surveys/')}}" enctype="multipart/form-data" id="area-survey-form">
                                 {{csrf_field()}}
                                
                                    
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">                                       
                                            <label class="form-label">Area</label>
                                            <select name="area" id="area" class="form-control select2" required>
                                                <option value="">Select Area</option>
                                                @foreach($areas as $key => $area)
                                                    <option value="{{ $area }}" >{{ ($area) }}</option>
                                                @endforeach
                                            </select>
                                                            
                                        </div>
                                    </div>
                                     <div class="col-md-6">
                                        <div class="form-group">                                       
                                            <label class="form-label">Survey Date</label>
                                            <div id="datepicker"></div>
                                            <input type="hidden" class="form-control" value="" id="survey_date" name="survey_date" placeholder="Survey Date" required>
                                            
                                                            
                                        </div>
                                    </div>
                                </div>

                                <div class="col-xs-12 mb-3 mt-3">   
                                    <div class="form-group">
                                        <!-- File Upload -->                                        
                                        <label class="form-label">Upload File (CSV,PDF)</label>
                                        <input type="file" name="file_url" id="file_url"  class="form-control" accept=".csv,application/pdf" required>
                                    </div>
                                </div>
                                
                                <div class="col-xs-12 mb-3 mt-3">   
                                    <div class="form-group">
                                        <!-- File Upload -->
                                        
                                        <label class="form-label">Upload Thumbnail</label>
                                        <input type="file" name="thumbnail_url" id="thumbnail_url"  class="form-control" accept="image/*">
                                            
                                                         
                                    </div>
                                </div>  

                                                          

                                <div class="col-xs-12 mb-3 mt-3">
                                    <div class="form-group">
                                       
                                        <div class="form-check form-switch">
                                          <input class="form-check-input" type="checkbox" id="is_active" name="is_active" checked>
                                          <label class="form-check-label" for="is_active">Status</label>
                                        </div>                                    
                                    </div>
                                </div>   

                                <div class="col-xs-12">
                                    <div class="form-group">
                                        <button type="submit" href="javascript:void(0);" id="btn_save" class="btn btn-success">
                                            Save
                                        </button>
                                        
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