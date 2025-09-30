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
                            <a href="{{url('admin/properties')}}" data-toggle="" data-target="#search-db-model"  class="btn">Back</a>
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
                            <div class="row">                                
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">Title<span>*</span></label>
                                        <input type="text" name="property_title" class="form-control" value="{{ old('property_title', $property->property_title ?? '') }}" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">Purpose<span>*</span></label>
                                        <select name="purpose" id="purpose" class="form-control select2" required>
                                            <option value="">Select Purpose</option>
                                            @foreach($purposes as $key => $purpose)
                                                <option value="{{ $key }}" {{ old('builder_id', $property->purpose ?? '') === $key ? 'selected' : '' }}>{{ ucfirst($purpose) }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="form-label">Description<span>*</span></label>
                                        <textarea name="description" class="form-control" required>{{ old('description', $property->description ?? '') }}</textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="form-label select2">Builder<span>*</span></label>
                                        <select name="builder_id" id="builder_id" class="form-control select2" required>
                                            <option value="">Select Builder</option>
                                            @foreach($builders as $builder)
                                                <option value="{{ $builder->id }}" {{ old('builder_id', $property->builder_id ?? '') === $builder->id ? 'selected' : '' }}>{{ ucfirst($builder->builder_name) }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="form-label">Type<span>*</span></label>
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
                            <div class="row">
                                
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">Price (PKR)<span>*</span></label>
                                        <input type="number" name="price" class="form-control" value="{{ old('price', $property->price ?? '') }}" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">Floor</label>           
                                        <input type="text" name="floor" class="form-control" value="{{ old('floor', $property->floor ?? '') }}" >                     
                                        
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-9">
                                    <div class="form-group">
                                    <label class="form-label">Area<span>*</span> </label>
                                    
                                        <input type="number" name="area" class="form-control" value="{{ old('area', $property->area ?? '') }}" required>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="form-label">Area Type</label>
                                        <select name="area_type" class="form-control">
                                             @foreach($area_types as $area_type)
                                                <option value="{{ $area_type }}" {{ old('area_type', $property->area_type ?? '') === $area_type ? 'selected' : '' }}>{{ ucfirst($area_type) }}</option>
                                            @endforeach
                                            
                                        </select>
                                    </div>
                                </div>                                   
                               
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">Bedrooms</label>           
                                        <select name="bedrooms" class="form-control">
                                            <option value="">Select Bedrooms</option>
                                             @foreach($bedrooms as $bedroom)
                                                <option value="{{ $bedroom }}" {{ old('bedrooms', $property->bedrooms ?? '') === $bedroom ? 'selected' : '' }}>{{ ($bedroom) }}</option>
                                            @endforeach
                                            
                                        </select>                     
                                        
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">Bathrooms</label>
                                        <select name="bathroom" class="form-control">
                                            <option value="">Select Bathrooms</option>
                                             @foreach($bathrooms as $bathroom)
                                                <option value="{{ $bathroom }}" {{ old('bathrooms', $property->bathrooms ?? '') === $bathroom ? 'selected' : '' }}>{{ ($bathroom) }}</option>
                                            @endforeach
                                            
                                        </select>   
                                    </div>
                                </div>
                            </div>  

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="form-label">Utilities</label>
                                        <textarea name="description" class="form-control" >{{ old('utilities', $property->utilities ?? '') }}</textarea>

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
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="form-label">Email<span>*</span></label>
                                        <input type="email" name="email" class="form-control" value="{{ old('email', $property->email ?? '') }}" required>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="form-label">Phone Number</label>
                                        <input type="text" name="phone_number" class="form-control" value="{{ old('phone_number', $property->phone_number ?? '') }}" >
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="form-label select2">Listed By</label>
                                        <select name="listed_by" id="listed_by" class="form-control select2" >
                                            <option value="">Select User</option>
                                            @foreach($users as $user)
                                                <option value="{{ $user->id }}" {{ (isset($property) && $property->listed_by == $user->id) ? 'selected' : '' }}>{{ ucfirst($user->first_name) .' '. ucfirst($user->last_name) }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            
                            

                            <div class="row my-location-wrapper">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">City<span>*</span></label>
                                        <select name="city_id" id="city_id" class="form-control select2" >
                                            <option value="">Select City</option>
                                            @foreach($cities as $city)
                                                <option value="{{ $city->id }}" {{ old('listed_by', $property->city_id ?? '') === $city->id ? 'selected' : '' }}>{{ ucfirst($city->name)  }}</option>
                                            @endforeach
                                        </select>
                                    </div>                                    

                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">Location<span>*</span></label>
                                        <input  type="text" name="location" class="form-control" value="{{ old('location', $property->location ?? '') }}" id="gmap-location" required >

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

                            <div class="row">                            
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="form-label">Gallery Images</label>
                                        <input type="file" name="filepond[]" multiple class="form-control filepond" id="filepond">
                                        <input type="hidden" id="uploaded-files" name="uploaded_files[]" />
                                            <input type="hidden" id="deleted-files" name="deleted_files[]" />
                                        <div class="uploaded-images file-pond-preview-wrapper" id="uploaded-preview" data-upload-type="default" data-allow-reorder="true" data-max-files="10" data-collection="default" data-preview="uploaded-preview">
                                            @if(isset($property))
                                                @foreach($property->getMedia('images') as $media)
                                                <div class="preview-box remove-media" data-media-id="{{ $media->id }}">
                                                    <div>
                                                        <img src="{{ str_replace('storage','storage/app/public',$media->getUrl('thumb')) }}" alt="uploaded">
                                                    </div>
                                                    <div>
                                                        <span title="Remove" class="remove-media " >Remove</span>
                                                    </div>
                                                </div>
                                                @endforeach
                                            @endif

                                         
                                                @if(isset($property))
                                                @php
                                                $existingImages = $property->getMedia('images')->map(function ($media) {
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
                                                                'poster' => $media->getUrl('thumb') // or getFullUrl()
                                                            ]
                                                        ]
                                                    ];
                                                });
                                                @endphp
                                                @endif
                                            
                                        </div>
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


                            <div class="row">

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary mt-3">{{ isset($property) ? 'Update' : 'Submit' }}</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
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
    const defaultLat = {{ old('latitude', $property->latitude ?? '24.8607343') }};
    const defaultLng = {{ old('longitude', $property->longitude ?? '67.0011364') }};
    const defaultLatLng = { lat: defaultLat, lng: defaultLng }; // default: Karachi

    map = new google.maps.Map(document.getElementById('map'), {
        center: defaultLatLng,
        zoom: 12
    });

    marker = new google.maps.Marker({
        map: map,
        position: defaultLatLng
    });

    const input = document.getElementById('gmap-location');
    autocomplete = new google.maps.places.Autocomplete(input);

    autocomplete.addListener('place_changed', onPlaceChanged);

    geocoder = new google.maps.Geocoder();

    $(document).on('change','select#city_id ', function(){
        console.log('city:',$(this).find('option:selected').text());
        const city = $(this).find('option:selected').text();
        if (city) {
            onCityChange(city);
        }
    })
}

function onPlaceChanged() {
    const place = autocomplete.getPlace();
    if (place.geometry) {
        map.setCenter(place.geometry.location);
        marker.setPosition(place.geometry.location);

        document.getElementById('latitude').value = place.geometry.location.lat();
        document.getElementById('longitude').value = place.geometry.location.lng();
    }
}

// when city is selected from dropdown
function onCityChange(cityName) {
    $("#gmap-location").attr('placeholder','Enter a Location');
    geocoder.geocode({ address: cityName }, function (results, status) {
        if (status === 'OK') {
            const location = results[0].geometry.location;
            map.setCenter(location);
            map.setZoom(12);
            marker.setPosition(location);

            // Set bounds for autocomplete
            const circle = new google.maps.Circle({
                center: location,
                radius: 30000 // ~30km
            });
            autocomplete.setBounds(circle.getBounds());
            $("#gmap-location").attr('placeholder','Search from '+cityName);
        } else {
            console.error('City not found: ' + status);
        }
    });
}


// Load on window
google.maps.event.addDomListener(window, 'load', initMap);





</script>
@endsection

