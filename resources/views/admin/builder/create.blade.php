@extends('layouts.admin')

@section('content')
    <div class="right-side-section">
        <div class="right-section-content">
            <div class="admin-sec-btn-area">
                <div class="report-title-section">
                    <h4>Create Builder</h4>
                </div>
                <div class="district-back-del-btn-area">
                    <div class="distrcit-back-btn">
                        <a href="{{url('admin/builders/')}}" data-toggle="" data-target="#search-db-model"  class="btn btn-sm btn-warning">Back</a>

                    </div>
                </div>
            </div>
            <!--  ===============================  -->
            <!--  ======= Builders Section ===========  -->
            <!--  ===============================  -->
            <div class="container mt-3">
                <div class="row">
                    <div class="ajax-msg"></div>
                    <div class="col-xs-12">
                        <div class="">
                            
                            <form class="" method="POST" action="{{url('admin/builders/')}}" enctype="multipart/form-data" id="builder-form">
                                 {{csrf_field()}}
                                
                                    
                                <div class="col-xs-12 mb-3 mt-3">
                                    <div class="form-group">
                                        <label>*Builder Name :</label>
                                        <input type="text" name="builder_name" id="builder_name" title="enter builder name!" class="district-input-field form-control" placeholder="Builder Name" required value="{{old('builder_name')}}">                                    
                                    </div>
                                </div>

                                <div class="col-xs-12 mb-3 mt-3">
                                    <div class="form-group">
                                        <label>*Email :</label>
                                        <input type="text" name="email" id="email" title="enter email!" class="district-input-field form-control" placeholder="Email Address"  value="{{old('email')}}" required >                                    
                                    </div>
                                </div>


                                <div class="col-xs-12 mb-3 mt-3">
                                    <div class="form-group">
                                        <label>*Mobile Number :</label>
                                        <input type="text" name="mobile_number" id="mobile_number" title="Enter mobile number!" class="district-input-field form-control" molaceholder="Mobile Number"  value="{{old('mobile_number')}}" required >                                    
                                    </div>
                                </div>


                                <div class="col-xs-12 mb-3 mt-3">
                                    <div class="form-group">
                                        <label>*Address :</label>
                                        <input type="text" name="address" id="address" title="Enter Address!" class="district-input-field form-control" molaceholder="Address"  value="{{old('address')}}">                                    
                                    </div>
                                </div>                                
                               
                                
                                <div class="col-xs-12 mb-3 mt-3">   
                                    <div class="form-group">
                                        <!-- File Upload -->
                                        
                                        <label>Upload Logo</label>
                                        <input type="file" name="builder_logo_file" id="builder_logo"  class="form-control">
                                            
                                                         
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

                                        <a href="{{url('admin/builders/')}}"  class="btn btn-warning">Back</a>
                                        
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