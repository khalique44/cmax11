@extends('layouts.admin')

@section('content')

    <div class="right-side-section">
        <div class="right-section-content">
            <div class="admin-sec-btn-area">
                <div class="report-title-section">
                    <h4>Home Page Popular Locations</h4>
                </div>
                
            </div>
            <!--  ===============================  -->
            <!--  ======= Home Page Popular Locations ===========  -->
            <!--  ===============================  -->

            <div class="row">
                @include('layouts.partials.messages')
                <div class="col-xs-12">
                    <div class="">
                        <form class="" method="POST" action="{{url('admin/home-page', array('update-popular-locations'))}}" enctype="multipart/form-data">
                            {{method_field('PUT')}}
                            {{csrf_field()}}

                            <div class="row">    
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">Title: </label>
                                        <input type="text" name="popular_location_title" id="popular_location_title" class="form-control" value="{{ old('popular_location_title', $popular_location_title ?? '') }}" >
                                    </div>
                                </div>                            
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">Main Title:<span>*</span></label>
                                        <input type="text" name="home_section_popular_location" id="home_section_popular_location" class="form-control" value="{{ old('home_section_popular_location', $home_section_popular_location ?? '') }}" required>
                                    </div>
                                </div>
                            </div>

                            <div class="row">                                
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">1st Box:<span>*</span></label>
                                         <select name="first_box_location" id="first_box_location" class="form-control select2" required>
                                            <option value="">Select Location</option>
                                            @foreach($areas as $key => $area)
                                                <option value="{{ $area->id }}" {{ old('first_box_location', $first_box_location ?? '') == $area->id ? 'selected' : '' }} 
                                                    >{{ ucfirst($area->name) }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-{{ !empty($first_box_location_image) ? 4 : 6; }}">                       
                                    <div class="form-group">
                                        <label class="form-label">Upload Image:<span>*</span></label>
                                        <input type="file" name="first_box_location_image" id="first_box_location_image"  class="form-control"  >
                                       
                                        
                                    </div>
                                    
                                </div>
                                @if(!empty($first_box_location_image))
                                    <div class="col-md-2">                       
                                        <div class="form-group">
                                            <a href="{{ asset($first_box_location_image) }}" target="_blank" class="available-image-area">
                                                
                                                <img src="{{ asset($first_box_location_image) }}" class="header-image" title="Header Image" alt="" width="50%">                                                    
                                            </a>                                          
                                            
                                        </div>
                                        
                                    </div>
                                @endif                                
                            </div>

                            <div class="row">                                
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">2nd Box:<span>*</span></label>
                                         <select name="second_box_location" id="second_box_location" class="form-control select2" required>
                                            <option value="">Select Location</option>
                                            @foreach($areas as $key => $area)
                                                <option value="{{ $area->id }}" {{ old('second_box_location', $second_box_location ?? '') == ($area->id) ? 'selected' : '' }} >{{ ucfirst($area->name) }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-{{ !empty($second_box_location_image) ? 4 : 6; }}">                       
                                    <div class="form-group">
                                        <label class="form-label">Upload Image:<span>*</span></label>
                                        <input type="file" name="second_box_location_image" id="second_box_location_image"  class="form-control"  >
                                       
                                        
                                    </div>
                                    
                                </div>
                                @if(!empty($second_box_location_image))
                                    <div class="col-md-2">                       
                                        <div class="form-group">
                                            <a href="{{ asset($second_box_location_image) }}" target="_blank" class="available-image-area">
                                                
                                                <img src="{{ asset($second_box_location_image) }}" class="header-image" title="Header Image" alt="" width="50%">                                                    
                                            </a>                                          
                                            
                                        </div>
                                        
                                    </div>
                                @endif                                
                            </div>

                            <div class="row">                                
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">3rd Box:<span>*</span></label>
                                         <select name="third_box_location" id="third_box_location" class="form-control select2" required>
                                            <option value="">Select Location</option>
                                            @foreach($areas as $key => $area)
                                                <option value="{{ $area->id }}" {{ old('third_box_location', $third_box_location ?? '') == $area->id ? 'selected' : '' }}>{{ ucfirst($area->name) }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-{{ !empty($third_box_location_image) ? 4 : 6; }}">                       
                                    <div class="form-group">
                                        <label class="form-label">Upload Image:<span>*</span></label>
                                        <input type="file" name="third_box_location_image" id="third_box_location_image"  class="form-control"  >
                                       
                                        
                                    </div>
                                    
                                </div>
                                @if(!empty($third_box_location_image))
                                    <div class="col-md-2">                       
                                        <div class="form-group">
                                            <a href="{{ asset($third_box_location_image) }}" target="_blank" class="available-image-area">
                                                
                                                <img src="{{ asset($third_box_location_image) }}" class="header-image" title="Header Image" alt="" width="50%">                                                    
                                            </a>                                          
                                            
                                        </div>
                                        
                                    </div>
                                @endif                                
                            </div>

                            <div class="row">                                
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">4th Box:<span>*</span></label>
                                         <select name="fourth_box_location" id="fourth_box_location" class="form-control select2" required>
                                            <option value="">Select Location</option>
                                            @foreach($areas as $key => $area)
                                                <option value="{{ $area->id }}" {{ old('fourth_box_location', $fourth_box_location ?? '') == $area->id ? 'selected' : '' }}>{{ ucfirst($area->name) }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-{{ !empty($fourth_box_location_image) ? 4 : 6; }}">                       
                                    <div class="form-group">
                                        <label class="form-label">Upload Image:<span>*</span></label>
                                        <input type="file" name="fourth_box_location_image" id="fourth_box_location_image"  class="form-control"  >
                                       
                                        
                                    </div>
                                    
                                </div>
                                @if(!empty($fourth_box_location_image))
                                    <div class="col-md-2">                       
                                        <div class="form-group">
                                            <a href="{{ asset($fourth_box_location_image) }}" target="_blank" class="available-image-area">
                                                
                                                <img src="{{ asset($fourth_box_location_image) }}" class="header-image" title="Header Image" alt="" width="50%">                                                    
                                            </a>                                          
                                            
                                        </div>
                                        
                                    </div>
                                @endif                                
                            </div>

                            <div class="row">                                
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">5th Box:<span>*</span></label>
                                         <select name="fifth_box_location" id="fifth_box_location" class="form-control select2" required>
                                            <option value="">Select Location</option>
                                            @foreach($areas as $key => $area)
                                                <option value="{{ $area->id }}" {{ old('fifth_box_location', $fifth_box_location ?? '') == $area->id ? 'selected' : '' }}>{{ ucfirst($area->name) }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-{{ !empty($fifth_box_location_image) ? 4 : 6; }}">                       
                                    <div class="form-group">
                                        <label class="form-label">Upload Image:<span>*</span></label>
                                        <input type="file" name="fifth_box_location_image" id="fifth_box_location_image"  class="form-control"  >
                                       
                                        
                                    </div>
                                    
                                </div>
                                @if(!empty($fifth_box_location_image))
                                    <div class="col-md-2">                       
                                        <div class="form-group">
                                            <a href="{{ asset($fifth_box_location_image) }}" target="_blank" class="available-image-area">
                                                
                                                <img src="{{ asset($fifth_box_location_image) }}" class="header-image" title="Header Image" alt="" width="50%">                                                    
                                            </a>                                          
                                            
                                        </div>
                                        
                                    </div>
                                @endif                                
                            </div>

                            <div class="row">                                
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">6th Box:<span>*</span></label>
                                         <select name="sixth_box_location" id="sixth_box_location" class="form-control select2" required>
                                            <option value="">Select Location</option>
                                            @foreach($areas as $key => $area)
                                                <option value="{{ $area->id }}" {{ old('sixth_box_location', $sixth_box_location ?? '') == $area->id ? 'selected' : '' }}>{{ ucfirst($area->name) }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-{{ !empty($sixth_box_location_image) ? 4 : 6; }}">                       
                                    <div class="form-group">
                                        <label class="form-label">Upload Image:<span>*</span></label>
                                        <input type="file" name="sixth_box_location_image" id="sixth_box_location_image"  class="form-control"  >
                                       
                                        
                                    </div>
                                    
                                </div>
                                @if(!empty($sixth_box_location_image))
                                    <div class="col-md-2">                       
                                        <div class="form-group">
                                            <a href="{{ asset($sixth_box_location_image) }}" target="_blank" class="available-image-area">
                                                
                                                <img src="{{ asset($sixth_box_location_image) }}" class="header-image" title="Header Image" alt="" width="50%">                                                    
                                            </a>                                          
                                            
                                        </div>
                                        
                                    </div>
                                @endif                                
                            </div>


                            <div class="row">

                                <div class="col-md-12">
                                    <div class="form-group">
                                        
                                        <button type="submit" class="btn btn-success mt-3">Update</button>
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


