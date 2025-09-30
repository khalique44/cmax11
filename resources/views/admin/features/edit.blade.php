@extends('layouts.admin')

@section('content')
    <div class="right-side-section">
        <div class="right-section-content">
            <div class="admin-sec-btn-area">
                <div class="report-title-section">
                    <h4>Edit Feature</h4>
                </div>
                <div class="district-back-del-btn-area">
                    <div class="distrcit-back-btn">
                        <a href="{{url('admin/features/')}}" data-toggle="" data-target="#search-db-model"  class="btn">Back</a>

                    </div>
                </div>
            </div>
            <!--  ===============================  -->
            <!--  ======= Features Section ===========  -->
            <!--  ===============================  -->
            <div class="container mt-3">
                <div class="row">
                    <div class="ajax-msg"></div>
                    <div class="col-xs-12">
                        <div class="">
                            
                            <form class="" method="POST"  enctype="multipart/form-data" id="feature-form-update" action="{{url('admin/features/'.$record->id)}}">
                                 {{csrf_field()}}
                                @method('PUT')
                                
                                    
                                <div class="col-xs-12 mb-3 mt-3">
                                    <div class="form-group">
                                        <label>*Feature Name :</label>
                                        <input type="text" name="name" id="name" title="enter feature name!" class="district-input-field form-control" placeholder="Feature Name" required value="{{old('name',$record->name)}}">                                    
                                    </div>
                                </div>

                                


                                <div class="col-xs-12 mb-3 mt-3">
                                    <div class="form-group">
                                        <label>Icon : <i class="fa {{old('icon',$record->icon)}}"></i></label>
                                        <input type="text" name="icon" id="icon" title="enter feature icon!" class="district-input-field form-control" placeholder="Feature icon"  value="{{old('icon',$record->icon)}}">                                    
                                    </div>
                                </div>                 
                               
                                
                                <div class="col-xs-12 mb-3 mt-3">   
                                    <div class="form-group">
                                        <!-- File Upload -->
                                        <div class="pond-container">
                                            <label>Upload Images</label>
                                            <input type="file" name="file_url" id="file_url" multiple class="form-control">
                                           
                                        </div>

                                        @if(!empty($record->file_url))
                                            <div class="">                       
                                                <div class="form-group">
                                                    <a href="{!! url('public') !!}/{{$record->file_url}}" target="_blank" class="available-image-area">
                                                        
                                                        <img src="{!! url('public') !!}/{{$record->file_url}}" class="header-image" title="Header Image" alt="" width="100">                                                    
                                                    </a>                                          
                                                    
                                                </div>
                                                
                                            </div>
                                        @endif
                                    </div>


                                </div>  

                                                          

                                <div class="col-xs-12 mb-3 mt-3">
                                    <div class="form-group">
                                       
                                        <div class="form-check form-switch">
                                          <input class="form-check-input" type="checkbox" id="is_active" name="is_active" {{ $record->is_active == 1 ? 'checked' : '' }}>
                                          <label class="form-check-label" for="is_active">Status</label>
                                        </div>                                    
                                    </div>
                                </div>   

                                <div class="col-xs-12">
                                    <div class="form-group">
                                        
                                        <button type="submit" class="btn btn-success mt-3">Update</button>
                                        <a   class="btn btn-warning mt-3" href="{{url('admin/features/')}}" >Back</a>
                                        
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