@extends('layouts.admin')

@section('content')

    <div class="right-side-section">
        <div class="right-section-content">
            <div class="admin-sec-btn-area">
                <div class="report-title-section">
                    <h4>Manage Home Page</h4>
                </div>
                <div class="district-back-del-btn-area">
                    <div class="distrcit-back-btn">
                        <div class="district-back-del-btn-area">
                            <a href="{{url('admin/')}}" data-toggle="" data-target="#search-db-model"  class="btn">Back</a>
                        </div>
                    </div>
                </div>
            </div>
            

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
                        <form action="{{ route('home-section.update-home-settings') }}" method="POST" enctype="multipart/form-data" class="" id="home-settings">
                            {{method_field('PUT')}}
                            @csrf

                            <div class="row">
                                <div class="col-md-12">   
                                    <div class="form-group">
                                        <label class="form-label">Title : </label>
                                        <input type="text" name="home_page_title" id="home_page_title" class="form-control" value="{{ old('home_page_title', $home_page_title ?? '') }}"  >
                                    </div>
                                </div>
                            </div>

                            <div class="row">                                
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="form-label">Description:</label>
                                          <textarea  name="home_page_description" id="home_page_description" title="enter  description!" class="form-control txtEditor" rows="8" placeholder="description"  >{{old('home_page_description', $home_page_description)}}</textarea>
                                    </div>
                                </div>
                                                               
                            </div>
                            
                            <div class="row">                                
                               
                                <div class="col-md-6">   
                                    <div class="form-group">                                     
                                        
                                        <label>Upload Image</label>
                                        <input type="file" name="home_page_header_image" id="home_page_header_image"  class="form-control">
                                           
                                        
                                    </div>
                                </div>

                                <div class="col-md-6">   
                                    <div class="form-group">                                     
                                        
                                        @if(!empty($home_page_header_image))
                                            <div class="">                       
                                                <div class="form-group">
                                                    <a href="{!! url($home_page_header_image) !!}/" target="_blank" class="available-image-area">
                                                        
                                                        <img src="{!! url($home_page_header_image) !!}" class="header-image" title="Header Image" alt="" width="">                                                    
                                                    </a>                                          
                                                    
                                                </div>
                                                
                                            </div>
                                        @endif
                                        
                                        
                                    </div>
                                </div>
                                
                            </div>  

                            <div class="row bg-light m-3">
                                <h3 class="mt-3">Meta Info</h3>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="form-label">Meta Title :</label>
                                            <input type="text" name="home_page_meta_title" id="home_page_meta_title" title="enter  meta title!" class="district-input-field form-control" placeholder="Meta Title"
                                                   value="{{ old('home_page_meta_title', $home_page_meta_title ?? '') }}"  >
                                            
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="form-label">Meta Description :</label>
                                            <textarea  name="home_page_meta_description" id="home_page_meta_description" title="enter meta description!" class="district-input-field form-control" rows="8" placeholder="Meta Description"
                                                     >{{ old('home_page_meta_description', $home_page_meta_description ?? '') }}</textarea>
                                            
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="form-label">Meta Keywords :</label>
                                            <textarea  name="home_page_meta_keywords" id="home_page_meta_keywords" title="enter meta Keywords!" class="district-input-field form-control" rows="8" placeholder="Meta Keywords"
                                                     >{{ old('home_page_meta_keywords', $home_page_meta_keywords ?? '') }}</textarea>
                                            
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

