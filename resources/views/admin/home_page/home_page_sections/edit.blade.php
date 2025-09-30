@extends('layouts.admin')

@section('content')

    <div class="right-side-section">
        <div class="right-section-content">
            <div class="admin-sec-btn-area">
                <div class="report-title-section">
                    <h4>Home Page Section Project Types</h4>
                </div>
                
            </div>
            <!--  ===============================  -->
            <!--  ======= Home Page Contact Update ===========  -->
            <!--  ===============================  -->

            <div class="row">
                @include('layouts.partials.messages')
                <div class="col-xs-12">
                    <div class="">
                        <form class="" method="POST" action="{{url('admin/home-page', array('update'))}}" enctype="multipart/form-data">
                            {{method_field('PUT')}}
                            {{csrf_field()}}

                            <div class="row">                                
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="form-label">Main Title:<span>*</span></label>
                                        <input type="text" name="home_section_project_type" id="home_section_project_type" class="form-control" value="{{ old('home_section_project_type', $home_section_project_type ?? '') }}" required>
                                    </div>
                                </div>
                            </div>

                            <div class="row">                                
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">1st Box:<span>*</span></label>
                                         <select name="first_box_offer" id="first_box_offer" class="form-control" required>
                                            <option value="">Select Category</option>
                                            @foreach($offering as $key => $offer)
                                                <option value="{{ $offer }}" {{ old('first_box_offer', $first_box_offer ?? '') === $offer ? 'selected' : '' }}>{{ ucfirst($offer) }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-{{ !empty($first_box_offer_image) ? 4 : 6; }}">                       
                                    <div class="form-group">
                                        <label class="form-label">Upload Image:<span>*</span></label>
                                        <input type="file" name="first_box_offer_image" id="first_box_offer_image"  class="form-control"  >
                                       
                                        
                                    </div>
                                    
                                </div>
                                @if(!empty($first_box_offer_image))
                                    <div class="col-md-2">                       
                                        <div class="form-group">
                                            <a href="{!! url('public') !!}/{{$first_box_offer_image}}" target="_blank" class="available-image-area">
                                                
                                                <img src="{!! url('public') !!}/{{$first_box_offer_image}}" class="header-image" title="Header Image" alt="" width="50%">                                                    
                                            </a>                                          
                                            
                                        </div>
                                        
                                    </div>
                                @endif                                
                            </div>

                            <div class="row">                                
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">2nd Box:<span>*</span></label>
                                         <select name="second_box_offer" id="second_box_offer" class="form-control " required>
                                            <option value="">Select Category</option>
                                            @foreach($offering as $key => $offer)
                                                <option value="{{ ucfirst($offer) }}" {{ old('second_box_offer', $second_box_offer ?? '') == ucfirst($offer) ? 'selected' : '' }} {{ $offer .'  '. $second_box_offer }}>{{ ucfirst($offer) }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-{{ !empty($second_box_offer_image) ? 4 : 6; }}">                       
                                    <div class="form-group">
                                        <label class="form-label">Upload Image:<span>*</span></label>
                                        <input type="file" name="second_box_offer_image" id="second_box_offer_image"  class="form-control"  >
                                       
                                        
                                    </div>
                                    
                                </div>
                                @if(!empty($second_box_offer_image))
                                    <div class="col-md-2">                       
                                        <div class="form-group">
                                            <a href="{!! url('public') !!}/{{$second_box_offer_image}}" target="_blank" class="available-image-area">
                                                
                                                <img src="{!! url('public') !!}/{{$second_box_offer_image}}" class="header-image" title="Header Image" alt="" width="50%">                                                    
                                            </a>                                          
                                            
                                        </div>
                                        
                                    </div>
                                @endif                                
                            </div>

                            <div class="row">                                
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">3rd Box:<span>*</span></label>
                                         <select name="third_box_offer" id="third_box_offer" class="form-control " required>
                                            <option value="">Select Category</option>
                                            @foreach($offering as $key => $offer)
                                                <option value="{{ $offer }}" {{ old('third_box_offer', $third_box_offer ?? '') === $offer ? 'selected' : '' }}>{{ ucfirst($offer) }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-{{ !empty($third_box_offer_image) ? 4 : 6; }}">                       
                                    <div class="form-group">
                                        <label class="form-label">Upload Image:<span>*</span></label>
                                        <input type="file" name="third_box_offer_image" id="third_box_offer_image"  class="form-control"  >
                                       
                                        
                                    </div>
                                    
                                </div>
                                @if(!empty($third_box_offer_image))
                                    <div class="col-md-2">                       
                                        <div class="form-group">
                                            <a href="{!! url('public') !!}/{{$third_box_offer_image}}" target="_blank" class="available-image-area">
                                                
                                                <img src="{!! url('public') !!}/{{$third_box_offer_image}}" class="header-image" title="Header Image" alt="" width="50%">                                                    
                                            </a>                                          
                                            
                                        </div>
                                        
                                    </div>
                                @endif                                
                            </div>

                            <div class="row">                                
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">4th Box:<span>*</span></label>
                                         <select name="fourth_box_offer" id="fourth_box_offer" class="form-control " required>
                                            <option value="">Select Category</option>
                                            @foreach($offering as $key => $offer)
                                                <option value="{{ $offer }}" {{ old('fourth_box_offer', $fourth_box_offer ?? '') === $offer ? 'selected' : '' }}>{{ ucfirst($offer) }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-{{ !empty($fourth_box_offer_image) ? 4 : 6; }}">                       
                                    <div class="form-group">
                                        <label class="form-label">Upload Image:<span>*</span></label>
                                        <input type="file" name="fourth_box_offer_image" id="fourth_box_offer_image"  class="form-control"  >
                                       
                                        
                                    </div>
                                    
                                </div>
                                @if(!empty($fourth_box_offer_image))
                                    <div class="col-md-2">                       
                                        <div class="form-group">
                                            <a href="{!! url('public') !!}/{{$fourth_box_offer_image}}" target="_blank" class="available-image-area">
                                                
                                                <img src="{!! url('public') !!}/{{$fourth_box_offer_image}}" class="header-image" title="Header Image" alt="" width="50%">                                                    
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


