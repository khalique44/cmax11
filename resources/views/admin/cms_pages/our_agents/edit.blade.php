@extends('layouts.admin')

@section('content')

    <div class="right-side-section">
        <div class="right-section-content">
            <div class="admin-sec-btn-area">
                <div class="report-title-section">
                    <h4>Manage Our Agents Page</h4>
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
                        <form action="{{ route('cmspages.our_agents') }}" method="POST" enctype="multipart/form-data" class="" id="cmspages">
                            @csrf
                            <input type="hidden" class="pg_name" value="save-our-agents">
                            <div class="row">                                
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">Title:<span>*</span></label>
                                        <input type="text" name="our_agents_title" id="our_agents_title" class="form-control" value="{{ old('our_agents_title', $our_agents_title ?? '') }}" required>
                                    </div>
                                </div>
                                <div class="col-md-{{ !empty($our_agents_header_image) ? 4 : 6; }}">                       
                                    <div class="form-group">
                                        <label class="form-label">Upload Header Image:<span>*</span></label>
                                        <input type="file" name="our_agents_header_image" id="our_agents_header_image"  class="form-control"  >
                                       
                                        
                                    </div>
                                    
                                </div>
                                @if(!empty($our_agents_header_image))
                                    <div class="col-md-2">                       
                                        <div class="form-group">
                                            <a href="{{asset($our_agents_header_image)}}" target="_blank" class="available-image-area">                                               
                                                <img src="{{asset($our_agents_header_image)}}" class="header-image" title="Header Image" alt="" width="50%">                                                    
                                            </a>                                          
                                            
                                        </div>
                                        
                                    </div>
                                @endif
                                
                            </div>    
                            <div class="row">                                
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="form-label">Description: </label>
                                        <textarea  name="our_agents_description" id="txtEditor" title="enter  description!" class="district-input-field form-control" rows="8" placeholder=""
                                                     >{{ old('our_agents_description', $our_agents_description ?? '') }}</textarea>
                                    </div>
                                </div>
                            </div>  
                            <div class="row bg-light m-3">
                                <h3 class="mt-3">Meta Info</h3>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="form-label">Meta Title :</label>
                                            <input type="text" name="our_agents_meta_title" id="our_agents_meta_title" title="enter  meta title!" class="district-input-field form-control" placeholder="Meta Title"
                                                   value="{{ old('our_agents_meta_title', $our_agents_meta_title ?? '') }}"  >
                                            
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="form-label">Meta Description :</label>
                                            <textarea  name="our_agents_meta_description" id="our_agents_meta_description" title="enter meta description!" class="district-input-field form-control" rows="8" placeholder="Meta Description"
                                                     >{{ old('our_agents_meta_description', $our_agents_meta_description ?? '') }}</textarea>
                                            
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="form-label">Meta Keywords :</label>
                                            <textarea  name="our_agents_meta_keywords" id="our_agents_meta_keywords" title="enter meta Keywords!" class="district-input-field form-control" rows="8" placeholder="Meta Keywords"
                                                     >{{ old('our_agents_meta_keywords', $our_agents_meta_keywords ?? '') }}</textarea>
                                            
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

