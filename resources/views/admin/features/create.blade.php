@extends('layouts.admin')

@section('content')
    <div class="right-side-section">
        <div class="right-section-content">
            <div class="admin-sec-btn-area">
                <div class="report-title-section">
                    <h4>Create Feature</h4>
                </div>
                <div class="district-back-del-btn-area">
                    <div class="distrcit-back-btn">
                        <div class="district-back-del-btn-area">
                            <a href="{{url('admin/features')}}" data-toggle="" data-target="#search-db-model"  class="btn btn-sm btn-warning">Back</a>
                            
                        </div>
                        
                    </div>
                </div>
            </div>
            <!--  ===============================  -->
            <!--  ======= Features Section ===========  -->
            <!--  ===============================  -->
            <div class="container mt-3">
                <div class="row">
                    @include('layouts.partials.messages')
                    <div class="ajax-msg"></div>
                    <div class="col-xs-12">
                        <div class="">
                            
                            <form class="has-filepond" method="POST" action="{{url('admin/features/')}}" enctype="multipart/form-data" id="feature-form">
                                 {{csrf_field()}}
                                
                                    
                                <div class="col-xs-12 mb-3 mt-3">
                                    <div class="form-group">
                                        <label>*Feature Name :</label>
                                        <input type="text" name="name" id="name" title="enter feature name!" class="district-input-field form-control" placeholder="Feature Name" required value="{{old('name')}}">                                    
                                    </div>
                                </div>

                                <div class="col-xs-12 mb-3 mt-3">
                                    <div class="form-group">
                                        <label>Icon :</label>
                                        <input type="text" name="icon" id="icon" title="enter feature icon!" class="district-input-field form-control" placeholder="Feature icon"  value="{{old('icon')}}">                                    
                                    </div>
                                </div>
                                
                                <div class="col-xs-12 mb-3 mt-3">   
                                    <div class="form-group">
                                        <!-- File Upload -->
                                        <div class="pond-container">
                                            <label>Upload Images</label>
                                            <input type="file" name="file_url" id="file_url"  class="form-control">
                                        </div>                                       
                                        
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
                                       
                                        <button type="submit" class="btn btn-success mt-3">Save</button>
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