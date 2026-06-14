@extends('layouts.admin')

@section('content')

    <div class="right-side-section">
        <div class="right-section-content">
            <div class="admin-sec-btn-area">
                <div class="report-title-section">
                    <h4>{{ isset($property) ? 'Edit Property' : 'Add New Property' }}</h4>
                </div>
                <div class="district-back-del-btn-area">
                    <div class="distrcit-back-btn">
                        <div class="district-back-del-btn-area">
                            <a href="{{url('admin/properties')}}"   class="btn btn-warning  mt-3">Back</a>
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
                        <form action="{{ isset($property) ? route('properties.update', $property->id) : route('properties.store') }}" method="POST" enctype="multipart/form-data" class="has-filepond" id="{{ isset($property) ? 'property-form-update' : 'property-form' }}">
                            @csrf
                            @if(isset($property)) @method('PUT') <input type="hidden" name="property_id" value="{{ $property->id }}"> @endif
                            <fieldset class="border border-light-subtle p-3 mb-4 rounded"><legend class="fw-bold ">Purpose & Property Type</legend>
                                
                                <div class="row">                                
                                
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">Purpose<span>*</span></label>
                                           
                                            <div class="d-flex align-items-center">
                                                @foreach($purposes as $key => $purpose)
                                                <div class="form-check form-check-inline">
                                                    <input type="radio"  name="purpose" class="form-check-input" id="purpose-{{ $key }}" value="{{ $key }}" {{ old('purpose', $property->purpose ?? 'sell') === $key ? 'checked' : '' }} required  ><label class="form-check-label" for="purpose-{{ $key }}">{{ ucfirst($purpose) }}</label>
                                                </div>
                                                @endforeach
                                                
                                            </div>                                                
                                           
                                        </div>
                                    </div>
                                    
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="form-label">Property Type<span>*</span></label>
                                            <select name="property_type" id="property_type" class="form-control select2" required>
                                                <option value="">Select Property Type</option>
                                                @foreach($property_types as $type)
                                                    <option value="{{ $type }}" {{ old('type', $property->property_type ?? '') === $type ? 'selected' : '' }}>{{ ucfirst($type) }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="form-label">Categories<span>*</span></label>
                                
                                            <ul class="list-inline property-form-ul">
                                                @foreach($categories as $category)                                           
                                                    <li class="category-{{ $category->property_type }} list-inline-item">
                                                        <input type="radio" class="btn-check" name="category_id" id="cat-{{$category->id}}" autocomplete="off" value="{{ $category->id }}" {{ (isset($property) && $property->category->id == $category->id) ? 'checked' : '' }} >
                                                        <label class="btn btn-light" for="cat-{{$category->id}}">{{$category->name}}</label>
                                                        
                                                    </li>
                                                @endforeach
                                            </ul>
                                            
                                        </div>
                                    </div>
                                </div>

                                
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="form-label">Amenities</label>
                        
                                            <ul class="list-inline property-form-ul">
                                                @foreach($amenities as $amenity)

                                                    <li class="amenity-{{ $amenity->property_type }} list-inline-item">
                                                    <input type="checkbox" class="btn-check" name="amenities[]" id="amenity-{{ $amenity->id }}" autocomplete="off" value="{{ $amenity->id }}" {{ isset($property) && $property->amenities->contains($amenity->id) ? 'checked' : '' }} >
                                                        <label class="btn btn-light" for="amenity-{{$amenity->id}}">{{$amenity->name}}</label>
                                                        
                                                    </li>
                                                    
                                                @endforeach
                                            </ul>
                                            
                                        </div>
                                    </div>
                                </div>
                            </fieldset>
                            <fieldset class="border border-light-subtle p-3 mb-4 rounded"><legend class="fw-bold ">Location & Address</legend>
                                
                                <div class="row my-location-wrapper">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="form-label">City<span>*</span></label>
                                            <select name="city_id" id="city_id" class="form-control select2"  data-placeholder="Select City">
                                                
                                                @foreach($cities as $city)
                                                    @if($city->state_id == 2729)
                                                        <option value="{{ $city->id }}" {{ old('city_id', $property->city_id ?? '31594') == $city->id ? 'selected' : '' }} >{{ ucfirst($city->name)  }}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>                                    

                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="form-label">Area<span>*</span> <span class="text-success text-right"><a href="javascript:;" class="add-main-area" data-bs-toggle="modal" data-bs-target="#areaModal"><i class="fa fa-plus-circle "></i></a></span></label>
                                            <select name="area_id" id="area_id" class="form-control select2"  data-placeholder="Select Area">
                                                <option value="">Select Area</option>
                                                @foreach($areas as $area)
                                                    <option value="{{ $area->id }}" {{ old('area_id', $property->area_id ?? '') == $area->id ? 'selected' : '' }}>{{ ucfirst($area->name)  }}</option>
                                                @endforeach
                                            </select>
                                        </div>                                    

                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">Sub Area<span>*</span> <!-- <span class="text-success text-right"><a href="javascript:;" class="add-sub-area" data-bs-toggle="modal" data-bs-target="#subAreaModal"><i class="fa fa-plus-circle "></i></a></span> --></label>
                                            <input  type="text" name="sub_area"   value="{{ old('sub_area', $property->subArea->name ?? '') }}" id="gmap-location" required class="form-control">
                                            <input  type="hidden" name="sub_area_id"   value="{{ old('sub_area_id', $property->sub_area_id ?? '') }}" >
                                            
                                        </div>                                    

                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="form-label">Formatted Address</label>
                                            <input  type="text" name="location" class="form-control" id="location" value="{{ old('location', $property->location ?? '') }}"  >

                                            <input type="hidden" name="latitude" id="latitude" value="{{ old('latitude', $property->latitude ?? '') }}">
                                            <input type="hidden" name="longitude" id="longitude" value="{{ old('longitude', $property->longitude ?? '') }}">
                                        </div>                                    

                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                        <div id="map" style="height: 300px; width: 100%;" class="m-2"></div>
                                        </div> 
                                    </div>                                  
                                </div>
                        
                            </fieldset>

                            <fieldset class="border border-light-subtle p-3 mb-4 rounded"><legend class="fw-bold ">Price & Area</legend>

                                <div class="row">
                                    <div class="col-md-5">
                                        <div class="form-group">
                                            <label class="form-label">Price (PKR)<span>*</span></label>
                                            <input type="number" name="price" class="form-control" value="{{ old('price', $property->price ?? '') }}" required>
                                        </div>
                                    </div>
                                    <div class="col-md-5">
                                        <div class="form-group">
                                        <label class="form-label">Area Size<span>*</span> </label>
                                        
                                            <input type="number" name="area" class="form-control" value="{{ old('area', $property->area ?? '') }}" required>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label class="form-label">Unit</label>
                                            <select name="area_type" class="form-control">
                                                @foreach($area_types as $area_type)
                                                    <option value="{{ $area_type }}" {{ old('area_type', $property->area_type ?? '') === $area_type ? 'selected' : '' }}>{{ ucfirst($area_type) }}</option>
                                                @endforeach
                                                
                                            </select>
                                        </div>
                                    </div>                                   
                                
                                </div>

                           

                                <div class="row">
                                    <div class="col-md-3  mt-4">
                                        <div class="form-group">
                                        
                                            <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" id="is_installment" name="is_installment" {{ old('is_installment', $property->is_installment ?? '') === 1 ? 'checked' : '' }}>
                                            <label class="form-check-label" for="is_installment"><strong>Is Installment</strong></label>
                                            </div>                                    
                                        </div>
                                    </div>
                                    <div class="col-md-3 is_installment {{ $property->is_installment ?? '' === 1 ? '' : 'display-none' }}">
                                        <div class="form-group">
                                            <label class="form-label">Advance Amount (PKR)<span>*</span></label>
                                            <input type="text" name="installment_advance_amount" class="form-control" value="{{ old('installment_advance_amount', $property->installment_advance_amount ?? '') }}" >  
                                        </div> 
                                    </div>
                                    <div class="col-md-3 is_installment {{ $property->is_installment ?? '' === 1 ? '' : 'display-none' }}">
                                        <div class="form-group">
                                            <label class="form-label">Number of Installments<span>*</span></label>
                                            <input type="number" name="number_of_instalments" class="form-control" value="{{ old('number_of_instalments', $property->number_of_instalments ?? '') }}" >  
                                        </div> 
                                    </div>
                                    <div class="col-md-3 is_installment {{ $property->is_installment ?? '' === 1 ? '' : 'display-none' }}">
                                        <div class="form-group">
                                            <label class="form-label">Monthly Installment (PKR)<span>*</span></label>
                                            <input type="text" name="monthly_installment" class="form-control" value="{{ old('monthly_installment', $property->monthly_installment ?? '') }}" >  
                                        </div> 
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-3  mt-4">
                                        <div class="form-group">
                                        
                                            <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" id="ready_for_possession" name="ready_for_possession" {{ old('ready_for_possession', $property->ready_for_possession ?? '') === 1 ? 'checked' : '' }}>
                                            <label class="form-check-label" for="ready_for_possession"><strong>Ready for Possession</strong></label>
                                            </div>                                    
                                        </div>
                                    </div>
                                </div>
                                

                                 
                                
                            </fieldset>


                            <fieldset class="border border-light-subtle p-3 mb-4 rounded"><legend class="fw-bold ">Property Features</legend>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">Bedrooms</label>           
                                            <select name="bedrooms" class="form-control">
                                                <option value="">Select Bedrooms</option>
                                                @foreach($bedrooms as $bedroom)
                                                    <option value="{{ $bedroom }}" {{ old('bedrooms', $property->bedrooms ?? '') == $bedroom ? 'selected' : '' }}>{{ ($bedroom) }}</option>
                                                @endforeach
                                                
                                            </select>                     
                                            
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">Bathrooms</label>
                                            <select name="bathrooms" class="form-control">
                                                <option value="">Select Bathrooms</option>
                                                @foreach($bathrooms as $bathroom)
                                                    <option value="{{ $bathroom }}" {{ old('bathrooms', $property->bathrooms ?? '') == $bathroom ? 'selected' : '' }}>{{ ($bathroom) }}</option>
                                                @endforeach
                                                
                                            </select>   
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">Floor</label>           
                                            <input type="text" name="floor" class="form-control" value="{{ old('floor', $property->floor ?? '') }}" >                     
                                            
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">Total Floors</label>           
                                            <input type="text" name="total_floors" class="form-control" value="{{ old('total_floors', $property->total_floors ?? '') }}" >                     
                                            
                                        </div>
                                    </div> 
                                </div>

                                <div class="row">                                
                                
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">Furnishing</label>
                                           
                                            <div class="d-flex align-items-center">
                                                @foreach($furnishing as $key => $furnish)
                                                <div class="form-check form-check-inline">
                                                    <input type="radio"  name="furnish" class="form-check-input" id="furnish-{{ $key }}" value="{{ $key }}" {{ old('furnish', $property->furnish ?? 'furnished') == $key ? 'checked' : '' }} required  ><label class="form-check-label" for="furnish-{{ $key }}">{{ ucfirst($furnish) }}</label>
                                                </div>
                                                @endforeach
                                                
                                            </div>                                                
                                           
                                        </div>
                                    </div>
                                    
                                </div>

                                
                            </fieldset>

                            <fieldset class="border border-light-subtle p-3 mb-4 rounded"><legend class="fw-bold ">  Property Detail</legend>
                                
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">Title<span>*</span></label>
                                            <input type="text" name="property_title" class="form-control" value="{{ old('property_title', $property->property_title ?? '') }}" required>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="form-label">Description<span>*</span></label>
                                            <textarea name="description" class="form-control" id="txtEditor" >{{ old('description', $property->description ?? '') }}</textarea>
                                        </div>
                                    </div>
                                </div>
                            </fieldset>

                            <fieldset class="border border-light-subtle p-3 mb-4 rounded"><legend class="fw-bold ">   Images & Videos</legend>

                                <div class="row mt-3">                            
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="form-label">Gallery Images</label>
                                            <input type="file" name="property_gallery[]" multiple class="form-control filepond"  >
                                            <input type="hidden" id="uploaded-files" name="uploaded_files[]" data-max-files="10" />
                                                <input type="hidden" id="deleted-files" name="deleted_files[]" />
                                            <div class="uploaded-images file-pond-preview-wrapper gallery" id="gallery-preview" data-upload-type="gallery" data-allow-reorder="true"   data-preview="gallery-preview" data-collection="property_gallery">
                                                @if(isset($property))
                                                    @foreach($property->getMedia('property_gallery')->sortBy('order_column') as $media)
                                                    <div class="media-item preview-box remove-media" data-media-id="{{ $media->id }}" data-id="{{ $media->id }}">
                                                        <div class="media-thumb">
                                                            <a href="{{ asset($media->getUrl('webp')) }}" target="_blank" data-fancybox="gallery-preview" >
                                                                <img src="{{ asset($media->getUrl('webp')) }}" alt="uploaded" style="">
                                                            </a>
                                                            <label class="form-label featured-image-checkbox-label"><input type="radio" name="featured_image" value="{{ $media->id }}" @checked($property->featured_media_id == $media->id)> Set Featured</label>
                                                            <div class="remove-media">
                                                                <span title="Remove" class="remove-media " >Remove</span>
                                                            </div>
                                                        </div>
                                                        
                                                    </div>
                                                    @endforeach
                                                @endif

                                            
                                                    @if(isset($project))
                                                    @php
                                                    $existingImages = $project->getMedia('property_gallery')->map(function ($media) {
                                                        return [
                                                            'source' => $media->id,
                                                            'options' => [
                                                                'type' => 'local',
                                                                'file' => [
                                                                    'name' => $media->file_name,
                                                                    'size' => $media->size,
                                                                    'type' => $media->mime_type,
                                                                ],
                                                                'metadata' => [
                                                                    'poster' => $media->getUrl() // or getFullUrl()
                                                                ]
                                                            ]
                                                        ];
                                                    });
                                                    @endphp
                                                    @endif
                                                
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="form-label">Video URL</label>
                                            <input type="url" name="video_url" class="form-control" value="{{ old('video_url', $property->video_url ?? '') }}" placeholder="https://youtube.com/" >
                                        </div>
                                    </div>
                                </div>
                        
                            </fieldset>

                            <fieldset class="border border-light-subtle p-3 mb-4 rounded"><legend class="fw-bold ">    Contact Details</legend>
                                <div class="row">  
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="form-label">Name</label>
                                            <input type="text" name="contact_name" class="form-control" value="{{ old('contact_name', $property->contact_name ?? '') }}" >
                                        </div>
                                    </div>                              
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="form-label">Email<span>*</span></label>
                                            <input type="email" name="email" class="form-control" value="{{ old('email', $property->email ?? '') }}" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="form-label">Mobile Number</label>
                                            <input type="text" name="mobile_number" class="form-control" value="{{ old('mobile_number', $property->mobile_number ?? '') }}" >
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="form-label">WhatsApp Number</label>
                                            <input type="text" name="whatsapp_number" class="form-control" value="{{ old('whatsapp_number', $property->whatsapp_number ?? '') }}" >
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="form-label">Landline Number</label>
                                            <input type="text" name="landline_number" class="form-control" value="{{ old('landline_number', $property->landline_number ?? '') }}" >
                                        </div>
                                    </div>                                 
                                                                       
                                </div>
                        
                            </fieldset>

                            <fieldset class="border border-light-subtle p-3 mb-4 rounded"><legend class="fw-bold ">    Listing Type</legend>

                                <div class="d-flex align-items-center">
                                    @foreach($listing_types as $key => $listing_type)
                                    <div class="form-check form-check-inline">
                                        <input type="radio"  name="listing_type" class="form-check-input" id="listing_type-{{ $key }}" value="{{ $key }}" {{ old('furnish', $property->listing_type ?? 'owner') === $key ? 'checked' : '' }} required  ><label class="form-check-label" for="listing_type-{{ $key }}">{{ ucfirst($listing_type) }}</label>
                                    </div>
                                    @endforeach
                                    
                                </div>

                                <div class="row mt-3 builder-info display-none">                                
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">Company Name<span>*</span></label>
                                            <input type="text" name="company_name" class="form-control" value="{{ old('company_name', $property->company_name ?? '') }}" >
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">Project Name</label>
                                            <input type="text" name="project_name" class="form-control" value="{{ old('project_name', $property->project_name ?? '') }}" >
                                        </div>
                                    </div>
                               
                                </div>
                            
                            </fieldset>                            
                            
                            <fieldset class="border border-light-subtle p-3 mb-4 rounded"><legend class="fw-bold "> Publishing</legend>
                                <div class="row mt-3"> 
                                    <div class="col-md-3 mb-3 mt-3">
                                        <div class="form-group">
                                        
                                            <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" id="is_active" name="is_active" checked>
                                            <label class="form-check-label" for="is_active">Status</label>
                                            </div>                                    
                                        </div>
                                    </div>
                                    <div class="col-md-3 mb-3 mt-3">
                                        <div class="form-group">
                                            
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" type="checkbox" id="is_featured" name="is_featured" {{ (isset($project) && $project->is_featured == 1) ? 'checked' : '' }}>
                                                <label class="form-check-label" for="is_featured">Is Featured</label>
                                            </div>                                    
                                        </div>
                                    </div>
                                    <div class="col-md-3 mb-3 mt-3">
                                        <div class="form-group">
                                            
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" type="checkbox" id="is_verified" name="is_verified" {{ (isset($project) && $project->is_verified == 1) ? 'checked' : '' }}>
                                                <label class="form-check-label" for="is_verified">Is Verified</label>
                                            </div>                                    
                                        </div>
                                    </div>
                                </div>
                            </fieldset>

                            <div class="row">

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <input type="hidden" name="featured_media_id" id="featured_media_id" value="{{ isset($project) ? $project->featured_media_id : 0 }}">
                                        <button type="submit" class="btn btn-primary mt-3">{{ isset($property) ? 'Update' : 'Submit' }}</button>
                                        <a href="{{url('admin/properties')}}"   class="btn btn-warning  mt-3">Back</a>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="areaModal" tabindex="-1">
      <div class="modal-dialog">
        <form id="areaForm" method="POST">
          @csrf
          <div class="modal-content">
            
            <div class="modal-header">
              <h5 class="modal-title">Add Area</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
              <div class="ajax-msg-area"></div>
              <div class="form-group">
                <label for="area-name">Area Name</label>
                <input type="text" class="form-control" name="name" id="area-name" >
              </div>
            </div>
            <div class="modal-footer">
              <button type="submit" class="btn btn-success">Save</button>
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
          </div>
        </form>
      </div>
    </div>

    <div class="modal fade" id="subAreaModal" tabindex="-1">
      <div class="modal-dialog">
        <form id="subAreaForm" method="POST">
          @csrf
          <div class="modal-content">
            
            <div class="modal-header">
              <h5 class="modal-title">Add Sub Area</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
              <div class="ajax-msg-sub-area"></div>
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label for="main_area_id">Area</label>
                    <input type="text" class="form-control area-title" name="" id="" disabled="" >
                    <input type="hidden" name="area_id" id="main_area_id" >
                    
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group">
                    <label for="sub-area-name">Sub Area Name</label>
                    <input type="text" class="form-control" name="name" id="sub-area-name" >
                  </div>
                  </div>
              </div>
            </div>
            <div class="modal-footer">
              <button type="submit" class="btn btn-success">Save</button>
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
          </div>
        </form>
      </div>
    </div>
<script>

$(document).on("change", "input#is_installment", function(){

    if($(this).is(":checked")){
        $(".is_installment").removeClass("display-none");
    }else{
        $(".is_installment").addClass("display-none");
    }

});

</script>


<script>

let map;
let marker;
let autocomplete;
let geocoder;

function initMap() {

    // Show map at a default location (e.g., Karachi)
    const defaultLat = {{ old('latitude', $project->latitude ?? '24.8607343') }};
    const defaultLng = {{ old('longitude', $project->longitude ?? '67.0011364') }};
    const defaultLatLng = { lat: defaultLat, lng: defaultLng }; // default: Karachi

    map = new google.maps.Map(document.getElementById('map'), {
        center: defaultLatLng,
        zoom: 12
    });

    marker = new google.maps.Marker({
        map: map,
        position: defaultLatLng
    });

    const sw = new google.maps.LatLng(24.825, 67.000);  // Southwest corner
    const ne = new google.maps.LatLng(24.950, 67.150);  // Northeast corner
    const karachiBounds = new google.maps.LatLngBounds(sw, ne);

    const input = document.getElementById('gmap-location');
    //autocomplete = new google.maps.places.Autocomplete(input);
    // Approximate Karachi sub-area bounds (set to your target area)
            

    autocomplete = new google.maps.places.Autocomplete(input, {
      bounds: karachiBounds,
      componentRestrictions: { country: 'pk' }, // Pakistan only
      strictBounds: true,
      //types: ["geocode"]
    });

    autocomplete.addListener('place_changed', onPlaceChanged);

    geocoder = new google.maps.Geocoder();

    $(document).on('input','#gmap-location',function(){
      const city = $('select#city_id').find('option:selected').text();
        var area = $('select#area_id').find('option:selected').text();
        //var sub_area = $('select#sub_area_id').find('option:selected').text();
        var sub_area = $(this).val();
        //console.log('city:',city,'area:',area,'sub_area:',sub_area);
        if (city || area || sub_area) {
            area = (area) ? ','+area : '';
            sub_area = (sub_area) ? ','+sub_area : '';
            onCityChange(city, area, sub_area);
        }

    });

    $(document).on('change','select#city_id, select#area_id, select#sub_area_id ', function(){
        
        const city = $('select#city_id').find('option:selected').text();
        var area = $('select#area_id').find('option:selected').text();
        //var sub_area = $('select#sub_area_id').find('option:selected').text();
        var sub_area = $('#gmap-location').val();
        //console.log('city:',city,'area:',area,'sub_area:',sub_area);
        if (city || area || sub_area) {
            area = (area) ? ','+area : '';
            sub_area = (sub_area) ? ','+sub_area : '';
            onCityChange(city, area, sub_area);
        }
    });
}

function onPlaceChanged() {
    const place = autocomplete.getPlace();
    if (place.geometry) {
        map.setCenter(place.geometry.location);
        marker.setPosition(place.geometry.location);

        let subArea = "";

        // Loop through address components
        if (place.address_components) {
            for (const comp of place.address_components) {
                if (
                    comp.types.includes("sublocality_level_1") ||
                    comp.types.includes("sublocality_level_2")
                ) {
                    console.log('comp:',comp)
                    subArea = comp.long_name;
                    break;
              }
            }
        }
        
        // Fallback: if no neighborhood found, just take place name
        if (!subArea) {
        subArea = place.name;
        }

        document.getElementById('latitude').value = place.geometry.location.lat();
        document.getElementById('longitude').value = place.geometry.location.lng();
        document.getElementById("location").value = place.formatted_address;
        document.getElementById("gmap-location").value = subArea;
    }
}

// when city is selected from dropdown
function onCityChange(cityName, area = '', sub_area = '') {
    $("#gmap-location").attr('placeholder', 'Enter a Location');

    // Build address properly
    let addressParts = [];

    if (sub_area) addressParts.push(sub_area);
    if (area) addressParts.push(area);
    if (cityName) addressParts.push(cityName);

    addressParts.push('Pakistan'); // VERY IMPORTANT

    var fullAddress = addressParts.join(', ');
    fullAddress =  fullAddress.replace(/^[,\s]+/, '');

    //console.log('Geocoding:', fullAddress);

    geocoder.geocode({ address: fullAddress, region: 'pk' }, function (results, status) {
        if (status === 'OK' && results.length) {

            const location = results[0].geometry.location;

            map.setCenter(location);
            map.setZoom(15);
            marker.setPosition(location);

            // Set bounds for autocomplete
            const circle = new google.maps.Circle({
                center: location,
                radius: 10000 // 10km for Karachi
            });

            autocomplete.setBounds(circle.getBounds());

            $("#gmap-location").attr(
                'placeholder',
                'Search near ' + sub_area + ' ' + area
            );

        } else {
            console.error('Location not found:', status, fullAddress);
        }
    });
}

// Load on window
google.maps.event.addDomListener(window, 'load', initMap);





</script>
@endsection

