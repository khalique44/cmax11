@extends('layouts.admin')

@section('content')

    <div class="right-side-section">
        <div class="right-section-content">
            <div class="admin-sec-btn-area">
                <div class="report-title-section">
                    <h4>Manage About Us Page</h4>
                </div>
                <div class="district-back-del-btn-area">
                    <div class="distrcit-back-btn">
                        <div class="district-back-del-btn-area">
                            <a href="{{url('admin/')}}" data-toggle="" data-target="#search-db-model"  class="btn">Back</a>
                        </div>
                    </div>
                </div>
            </div>
            <!--  ===============================  -->
            <!--  ==== User Update        =======  -->
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
                        <form action="{{ route('cmspages.aboutus') }}" method="POST" enctype="multipart/form-data" class="" id="cmspages">
                            @csrf
                            <input type="hidden" class="pg_name" value="save-about-us">
                            <div class="row">                                
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">Title:<span>*</span></label>
                                        <input type="text" name="aboutus_title" id="aboutus_title" class="form-control" value="{{ old('aboutus_title', $aboutus_title ?? '') }}" required>
                                    </div>
                                </div>
                                <div class="col-md-{{ !empty($aboutus_header_image) ? 4 : 6; }}">                       
                                    <div class="form-group">
                                        <label class="form-label">Upload Header Image:<span>*</span></label>
                                        <input type="file" name="aboutus_header_image" id="aboutus_header_image"  class="form-control"  >
                                       
                                        
                                    </div>
                                    
                                </div>
                                @if(!empty($aboutus_header_image))
                                    <div class="col-md-2">                       
                                        <div class="form-group">
                                            <a href="{!! url('public') !!}/{{$aboutus_header_image}}" target="_blank" class="available-image-area">
                                                
                                                <img src="{!! url('public') !!}/{{$aboutus_header_image}}" class="header-image" title="Header Image" alt="" width="50%">                                                    
                                            </a>                                          
                                            
                                        </div>
                                        
                                    </div>
                                @endif
                                
                            </div>
        
                            <div class="row bg-light m-3">  
                                <h3 class="mt-3">Section 1</h3>      
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">Title 1:<span>*</span></label>
                                        <input type="text" name="aboutus_section1_title1" id="aboutus_section1_title1" class="form-control" value="{{ old('aboutus_section1_title1', $aboutus_section1_title1 ?? '') }}" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">Title 2:<span>*</span></label>
                                        <input type="text" name="aboutus_section1_title2" id="aboutus_section1_title2" class="form-control" value="{{ old('aboutus_section1_title2', $aboutus_section1_title2 ?? '') }}" required>
                                    </div>
                                </div>                       
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="form-label">Description</label>
                                        <textarea name="aboutus_section1_description1" id="aboutus_section1_description1" rows="6" class="form-control" >{{ old('aboutus_section1_description1', $aboutus_section1_description1 ?? '') }}</textarea>
                                    </div>
                                </div>                                
                                
                            </div>
                            <div class="row">&nbsp;</div>
                            <div class="row bg-light m-3">  
                                <h3 class="mt-3">Section 2</h3>      
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">Title 1:<span>*</span></label>
                                        <input type="text" name="aboutus_section2_title1" id="aboutus_section2_title1" class="form-control" value="{{ old('aboutus_section2_title1', $aboutus_section2_title1 ?? '') }}" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">Title 2:<span>*</span></label>
                                        <input type="text" name="aboutus_section2_title2" id="aboutus_section2_title2" class="form-control" value="{{ old('aboutus_section2_title2', $aboutus_section2_title2 ?? '') }}" required>
                                    </div>
                                </div>                       
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="form-label">Description</label>
                                        <textarea name="aboutus_section2_description1" id="aboutus_section2_description1" rows="6" class="form-control" >{{ old('aboutus_section2_description1', $aboutus_section2_description1 ?? '') }}</textarea>
                                    </div>
                                </div>                                
                                
                            </div>

                            <div class="row">&nbsp;</div>
                            <div class="row bg-light m-3">  
                                <h3 class="mt-3">Section 3</h3>      
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">Title 1:<span>*</span></label>
                                        <input type="text" name="aboutus_section3_title1" id="aboutus_section3_title1" class="form-control" value="{{ old('aboutus_section3_title1', $aboutus_section3_title1 ?? '') }}" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">Title 2:<span>*</span></label>
                                        <input type="text" name="aboutus_section3_title2" id="aboutus_section3_title2" class="form-control" value="{{ old('aboutus_section3_title2', $aboutus_section3_title2 ?? '') }}" required>
                                    </div>
                                </div>                       
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">Description 1</label>
                                        <textarea name="aboutus_section3_description1" id="aboutus_section3_description1" rows="6" class="form-control" >{{ old('aboutus_section3_description1', $aboutus_section3_description1 ?? '') }}</textarea>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">Description 2</label>
                                        <textarea name="aboutus_section3_description2" id="aboutus_section3_description2" rows="6" class="form-control" >{{ old('aboutus_section3_description2', $aboutus_section3_description2 ?? '') }}</textarea>
                                    </div>
                                </div>

                                <div class="col-md-{{ !empty($aboutus_section3_image1) ? 4 : 6; }}">                       
                                    <div class="form-group">
                                        <label class="form-label">Image 1</label>
                                        <input type="file" name="aboutus_section3_image1" id="aboutus_section3_image1"  class="form-control"  >
                                       
                                        
                                    </div>
                                    
                                </div>
                                @if(!empty($aboutus_section3_image2))
                                    <div class="col-md-2">                       
                                        <div class="form-group">
                                            <a href="{!! url('public') !!}/{{$aboutus_section3_image1}}" target="_blank" class="available-image-area">
                                                
                                                <img src="{!! url('public') !!}/{{$aboutus_section3_image1}}" class="image" title="Image 1" alt="" width="50%">                                                    
                                            </a>                                          
                                            
                                        </div>
                                        
                                    </div>
                                @endif

                                <div class="col-md-{{ !empty($aboutus_section3_image2) ? 4 : 6; }}">                       
                                    <div class="form-group">
                                        <label class="form-label">Image 2</label>
                                        <input type="file" name="aboutus_section3_image2" id="aboutus_section3_image2"  class="form-control"  >
                                       
                                        
                                    </div>
                                    
                                </div>
                                @if(!empty($aboutus_section3_image2))
                                    <div class="col-md-2">                       
                                        <div class="form-group">
                                            <a href="{!! url('public') !!}/{{$aboutus_section3_image2}}" target="_blank" class="available-image-area">
                                                
                                                <img src="{!! url('public') !!}/{{$aboutus_section3_image2}}" class="image" title="Image 2" alt="" width="50%">                                                    
                                            </a>                                          
                                            
                                        </div>
                                        
                                    </div>
                                @endif

                                
                            </div>
                            <div class="row">&nbsp;</div>
                            <div class="row bg-light m-3">
                                <h3 class="mt-3">Meta Info</h3>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="form-label">Meta Title :</label>
                                            <input type="text" name="aboutus_meta_title" id="aboutus_meta_title" title="enter  meta title!" class="district-input-field form-control" placeholder="Meta Title"
                                                   value="{{ old('aboutus_meta_title', $aboutus_meta_title ?? '') }}"  >
                                            
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="form-label">Meta Description :</label>
                                            <textarea  name="aboutus_meta_description" id="aboutus_meta_description" title="enter meta description!" class="district-input-field form-control" rows="8" placeholder="Meta Description"
                                                     >{{ old('aboutus_meta_description', $aboutus_meta_description ?? '') }}</textarea>
                                            
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="form-label">Meta Keywords :</label>
                                            <textarea  name="aboutus_meta_keywords" id="aboutus_meta_keywords" title="enter meta Keywords!" class="district-input-field form-control" rows="8" placeholder="Meta Keywords"
                                                     >{{ old('aboutus_meta_keywords', $aboutus_meta_keywords ?? '') }}</textarea>
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row m-3">

                                <div class="col-md-12">
                                    <div class="form-group">
                                       
                                        <button type="submit" class="btn btn-success mt-3">Save</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

