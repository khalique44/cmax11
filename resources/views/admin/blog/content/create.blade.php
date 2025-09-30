@extends('layouts.admin')

@section('content')
    <div class="right-side-section">
        <div class="right-section-content">
            <div class="admin-sec-btn-area">
                <div class="report-title-section">
                    <h4>Blog</h4>
                </div>
                <div class="district-back-del-btn-area">
                    <div class="distrcit-back-btn">
                        <a href="{{url('admin/blog/posts')}}" data-toggle="" data-target="#search-db-model"  class="btn">Back</a>

                    </div>
                </div>
            </div>
            <!--  ===============================  -->
            <!--  ======= Blogg Section ===========  -->
            <!--  ===============================  -->
            @if ($errors->any())
                <div class="alert alert-danger">
                    Please remove the following errors.
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            @include("layouts.partials.messages")
            <div class="ajax-msg"></div>
            <div class="row">
                <div class="col-xs-12">
                    <div class="district-form-content add-new-district-form">
                        
                        <form class="" method="POST" action="{{url('admin/blog/posts')}}" enctype="multipart/form-data">
                            {{csrf_field()}}
                            
                            <div class="row">    
                                <div class="col-xs-12">
                                    <div class="form-group">
                                        <label class="form-label">*Title :</label>
                                        <input type="text" name="title" id="title" title="enter title!" class="district-input-field form-control" placeholder="Title" required value="{{old('title')}}">
                                        <div id="msg_1">&nbsp;</div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="form-group">
                                        <label class="form-label">Short Description :</label>
                                        <textarea  name="short_description" id="short_description" title="enter short description!" class="district-input-field form-control" rows="8" placeholder="Short Description"
                                                 >{{old('short_description')}}</textarea>
                                        <div id="msg_2">&nbsp;</div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="clearfix">
                                        <label class="form-label">Description :</label>
                                        <textarea  name="description" id="txtEditor" title="enter description!" class=" form-control" rows="8" cols="20" placeholder="Description"
                                                 >{{old('description')}}</textarea>
                                        <div id="msg_2">&nbsp;</div>


                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12">   
                                    <div class="form-group">
                                        <label class="form-label">Upload Image (600 &times; 450):</label>
                                        <input type="file" name="file_url" id="file_url"  class="district-input-field form-control"  >
                                        
                                    </div>
                                </div>  
                            </div>
                            <div class="row">
                                <div class="col-xs-12">   
                                    <div class="form-group">
                                        <label class="form-label">Upload Header Image Detail Page (1920 &times; 915):</label>
                                        <input type="file" name="header_image" id="header_image"  class="district-input-field form-control"  >
                                        
                                    </div>
                                </div> 
                            </div>            
                            <div class="col-xs-12 mb-3 mt-3">
                                <div class="form-group">
                                   
                                    <div class="form-check form-switch">
                                      <input class="form-check-input" type="checkbox" id="status" name="status" value="yes" {{ old('status') === 'yes' ? 'checked' : '' }}>
                                      <label class="form-check-label" for="status">Active</label>
                                    </div>                                    
                                </div>
                            </div>             
   
                            <div class="row">
                                <div class="Create-district-btn">
                                    <button type="submit" href="javascript:void(0);" id="btn_save" class="btn  btn-success mt-3">
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

@endsection
