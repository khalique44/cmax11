@extends('layouts.admin')

@section('content')

    <div class="right-side-section">
        <div class="right-section-content">
            <div class="admin-sec-btn-area">
                <div class="report-title-section">
                    <h4>{{ isset($project) ? 'Edit Project' : 'Add New Project' }}</h4>
                </div>
                <div class="district-back-del-btn-area">
                    <div class="distrcit-back-btn">
                        <div class="district-back-del-btn-area">
                            <a href="{{url('admin/projects')}}" data-toggle="" data-target="#search-db-model"  class="btn btn-sm btn-warning">Back</a>
                            @if(isset($project))
                                &nbsp;<a class="btn btn-sm btn-success pull-right" target="_blank" href='{{ url("/project/$project->slug/") }}' >
                                                View
                                            </a>
                            @endif
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
                        <form action="{{ isset($project) ? route('projects.update', $project->id) : route('projects.store') }}" method="POST" enctype="multipart/form-data" class="has-filepond" id="{{ isset($project) ? 'project-form-update' : 'project-form' }}">
                            @csrf
                            @if(isset($project)) @method('PUT') <input type="hidden" name="project_id" value="{{ $project->id }}"> @endif
                            <div class="row">                                
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">Title:<span>*</span></label>
                                        <input type="text" name="project_title" id="project_title" class="form-control" value="{{ old('project_title', $project->project_title ?? '') }}" required>
                                    </div>
                                </div>
                                <div class="col-md-{{ !empty($project->logo_url) ? 4 : 6; }}">                       
                                    <div class="form-group">
                                        <label class="form-label">Upload Logo:<span>*</span></label>
                                        <input type="file" name="project_logo" id="project_logo"  class="form-control"  >
                                       
                                        
                                    </div>
                                    
                                </div>
                                @if(!empty($project->logo_url))
                                    <div class="col-md-2">                       
                                        <div class="form-group">
                                            <a href="{{asset($project->logo_url)}}" target="_blank" class="available-image-area">
                                                
                                                <img src="{{asset($project->logo_url)}}" class="logo" title="Project Logo" alt="Logo" width="50%">                                                    
                                            </a>                                          
                                            
                                        </div>
                                        
                                    </div>
                                @endif
                                
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">Progress<span>*</span></label>
                                        <select name="progress" id="progress" class="form-control select2" required data-placeholder="Select Progress">
                                            <option value="">Select Progress</option>
                                            @foreach($progress as $key => $prog)
                                                <option value="{{ $key }}" {{ old('progress', $project->progress ?? '') == $key ? 'selected' : '' }}>{{ ucfirst($prog) }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                               
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label select2">Builder<span>*</span></label>
                                        <select name="builder_id" id="builder_id" class="form-control select2" required data-placeholder="Select Builder">
                                            <option value="">Select Builder </option>
                                            @foreach($builders as $builder)
                                                <option value="{{ $builder->id }}" {{ old('builder_id', $project->builder_id ?? '') == $builder->id ? 'selected' : '' }}>{{ ucfirst($builder->builder_name) }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                       
                            </div>

                            

                            <div class="row">                                
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="form-label">Description</label>
                                        <textarea name="description" id="txtEditor" class="form-control" >{{ old('description', $project->description ?? '') }}</textarea>
                                    </div>
                                </div>
                                
                                
                            </div>
                            <div class="row my-location-wrapper">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="form-label">City<span>*</span></label>
                                        <select name="city_id" id="city_id" class="form-control select2"  data-placeholder="Select City">
                                            
                                            @foreach($cities as $city)
                                                @if($city->id == 31594)
                                                    <option value="{{ $city->id }}" {{ old('city_id', $project->city_id ?? '') == $city->id ? 'selected' : '' }} >{{ ucfirst($city->name)  }}</option>
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
                                                <option value="{{ $area->id }}" {{ old('area_id', $project->area_id ?? '') == $area->id ? 'selected' : '' }}>{{ ucfirst($area->name)  }}</option>
                                            @endforeach
                                        </select>
                                    </div>                                    

                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">Sub Area<span>*</span> <!-- <span class="text-success text-right"><a href="javascript:;" class="add-sub-area" data-bs-toggle="modal" data-bs-target="#subAreaModal"><i class="fa fa-plus-circle "></i></a></span> --></label>
                                        <input  type="text" name="sub_area"   value="{{ old('sub_area', $project->subArea->name ?? '') }}" id="gmap-location" required class="form-control">
                                        <input  type="hidden" name="sub_area_id"   value="{{ old('sub_area_id', $project->sub_area_id ?? '') }}" >
                                        
                                    </div>                                    

                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="form-label">Formatted Address</label>
                                        <input  type="text" name="location" class="form-control" id="location" value="{{ old('location', $project->location ?? '') }}"  >

                                        <input type="hidden" name="latitude" id="latitude" value="{{ old('latitude', $project->latitude ?? '') }}">
                                        <input type="hidden" name="longitude" id="longitude" value="{{ old('longitude', $project->longitude ?? '') }}">
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
                                        <label class="form-label">Offering<span>*</span></label>
                                        @php

                                            $offers = isset($project) ? explode(',',$project->offering) : "";
                                        
                                        @endphp
                      
                                        <ul class="list-inline property-form-ul">
                                            @foreach($offering as $offer)
                                                
                                                <li class="offer-{{ $offer }} list-inline-item">
                                                <input type="checkbox" class="btn-check offering" name="offering[]" id="offer-{{ $offer }}"  autocomplete="off" value="{{ $offer }}" {{ isset($project) &&  in_array($offer,$offers) ? 'checked' : '' }} >
                                                    <label class="btn btn-light" for="offer-{{$offer}}">{{$offer}}</label>
                                                    
                                                </li>
                                                
                                            @endforeach
                                        </ul>
                                        
                                    </div>
                                </div>

                                
                            </div>    
                            
                            <div class="row">
                                <div class="accordion" id="project-offers">

                                    @foreach($offering as $key => $offer)
                                        <div class="accordion-item offer-item-{{$offer}}  {{ isset($project) &&  in_array($offer,$offers) ? '' : 'display-none' }} " {{ $offer .' '. json_encode($offers) }}>
                                            
                                            <h2 class="accordion-header" id="offer-heading-{{$key}}">
                                              <button class="accordion-button offer-item-btn-{{$offer}}" type="button" data-bs-toggle="collapse" data-bs-target="#offer-{{$key}}"
                                                aria-expanded="{{ isset($project) &&  in_array($offer,$offers) ? 'true' : 'false' }}" aria-controls="offer-{{$key}}">
                                                {{$offer}}
                                              </button>
                                            </h2>
                                            <div id="offer-{{$key}}" class="accordion-collapse collapse {{ isset($project) &&  in_array($offer,$offers) ? 'show' : '' }}" aria-labelledby="offer-heading-{{$key}}"
                                              >
                                                <div class="accordion-body">
                                                    <div class="repeatable-wrapper">
                                                        <div class="repeatable-fields">
                                                            @php $savedOffers = []; @endphp
                                                            @if(!empty($project->offers))
                                                                @foreach($project->offers as $savedOffer)
                                                                    @if($savedOffer->offer == strtolower($offer))
                                                                        @php 
                                                                            $savedOffers[] =  $offer;
                                                                        @endphp
                                                                        <div class="repeatable-group border p-3 mb-3 rounded bg-light">
                                                                            <div class="row">
                                                                                <div class="col-md-4">
                                                                                    <div class="form-group">
                                                                                      <label class="form-label">Title <span>*</span></label>
                                                                                      <input type="text" name="{{$offer}}[title][]" class="form-control" value="{{ $savedOffer->title }}" >
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-md-4">
                                                                                    <div class="form-group">
                                                                                        <label class="form-label">Area <span>*</span></label>
                                                                                        <input type="text" name="{{$offer}}[area][]" class="form-control" value="{{ $savedOffer->area }}">
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-md-4">
                                                                                    <div class="form-group">
                                                                                        <label class="form-label">Area Type</label>
                                                                                        <select name="{{$offer}}[area_type][]" class="form-control">
                                                                                            @foreach($area_types as $area_type)
                                                                                                <option value="{{ $area_type }}" {{ $savedOffer->area_type == $area_type ? 'selected' : '' }}>{{ ucfirst($area_type) }}</option>
                                                                                            @endforeach
                                                                                        </select>
                                                                                    </div>
                                                                                </div>
                                                                            </div>

                                                                            <div class="row mt-2">
                                                                                @if($offer != 'Plots' && $offer != 'Offices' && $offer != 'Shops')
                                                                                    <div class="col-md-3">
                                                                                        <div class="form-group">
                                                                                            <label class="form-label">Bedrooms</label>
                                                                                            <select name="{{$offer}}[bedrooms][]" class="form-control">
                                                                                                <option value="">Select</option>
                                                                                                @foreach($bedrooms as $bedroom)
                                                                                                    <option value="{{ $bedroom }}" {{ $savedOffer->bedrooms == $bedroom ? 'selected' : '' }}>{{ $bedroom }}</option>
                                                                                                @endforeach
                                                                                          </select>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-md-3">
                                                                                        <div class="form-group">
                                                                                            <label class="form-label">Bathrooms</label>
                                                                                            <select name="{{$offer}}[bathrooms][]" class="form-control">
                                                                                            <option value="">Select</option>
                                                                                                @foreach($bathrooms as $bathroom)
                                                                                                    <option value="{{ $bathroom }}" {{ $savedOffer->bathrooms == $bathroom ? 'selected' : '' }}>{{ $bathroom }}</option>
                                                                                                @endforeach
                                                                                            </select>
                                                                                        </div>
                                                                                    </div>
                                                                                @endif
                                                                                <div class="col-md-3">
                                                                                    <div class="form-group">
                                                                                        <label class="form-label">Price <span>*</span></label>
                                                                                        <input type="number" name="{{$offer}}[price_from][]" class="form-control" min="0" step="any" inputmode="decimal" value="{{ $savedOffer->price_from }}">
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-md-3">
                                                                                    <div class="form-group">
                                                                                        <label class="form-label">Amount in</label>
                                                                                        <select name="{{$offer}}[price_type_from][]" id="price_type_from_{{$offer}}" class="form-control" >
                                                                                        
                                                                                            @foreach($price_types as $key => $price_type)
                                                                                                <option value="{{ $price_type }}" {{ old('price_type_from', $savedOffer->price_from_in_format ?? '') == $price_type ? 'selected' : '' }}>{{ ucfirst($price_type) }}</option>
                                                                                            @endforeach
                                                                                        </select>
                                                                                    </div>
                                                                                </div>
                                                                                
                                                                                
                                                                            </div> 

                            <div class="row installment-area">
                                
                                <div class="col-md-3  mt-5">
                                    <div class="form-group">
                                       
                                        <div class="form-check">
                                            <label >
                                                <input class="form-check-input installment-checkbox" value="1" type="checkbox" name="{{$offer}}[is_installment][]" {{  $savedOffer->is_installment == 1 ? 'checked' : '' }}>
                                                <strong>Is Installment</strong>
                                            </label>
                                        </div>                                    
                                    </div>
                                </div>
                                <div class="col-md-3 mt-3 is_installment {{ $savedOffer->is_installment ?? '' == 1 ? '' : 'display-none' }}">
                                    <div class="form-group">
                                        <label class="form-label">Advance Amount<span>*</span></label>
                                        <input type="text" name="{{$offer}}[installment_advance_amount][]" class="form-control" value="{{ $savedOffer->installment_advance_amount ?? '' }}" >  
                                    </div> 
                                </div>
                                <div class="col-md-3 mt-3 is_installment {{ $savedOffer->is_installment ?? '' == 1 ? '' : 'display-none' }}">
                                    <div class="form-group">
                                        <label class="form-label">Number of Installments<span>*</span></label>
                                        <input type="number" name="{{$offer}}[number_of_instalments][]" class="form-control" value="{{   $savedOffer->number_of_instalments ?? '' }}" >  
                                    </div> 
                                </div>
                                <div class="col-md-3 mt-3 is_installment {{ $savedOffer->is_installment ?? '' == 1 ? '' : 'display-none' }}">
                                    <div class="form-group">
                                        <label class="form-label">Monthly Installment<span>*</span></label>
                                        <input type="text" name="{{$offer}}[monthly_installment][]" class="form-control" value="{{ $savedOffer->monthly_installment  ?? '' }}" >  
                                    </div> 
                                </div>
                                    
                            </div> 
                                                                            <div class="text-end mt-2">
                                                                                <button type="button" class="btn btn-danger btn-sm remove-group" data-id="{{ $savedOffer->id }}">Remove</button>
                                                                                <input type="hidden" name="{{$offer}}[offer_id][]" value="{{$savedOffer->id}}">
                                                                            </div>
                                                                        </div>   
                                                                    @endif
                                                                @endforeach         
                                                            @endif
                                                            @if(!in_array($offer,$savedOffers))
                                                                <div class="repeatable-group border p-3 mb-3 rounded bg-light">
                                                                    <div class="row">
                                                                        <div class="col-md-4">
                                                                            <div class="form-group">
                                                                              <label class="form-label">Title <span>*</span></label>
                                                                              <input type="text" name="{{$offer}}[title][]" class="form-control" >
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-4">
                                                                            <div class="form-group">
                                                                                <label class="form-label">Area <span>*</span></label>
                                                                                <input type="text" name="{{$offer}}[area][]" class="form-control" >
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-4">
                                                                            <div class="form-group">
                                                                                <label class="form-label">Area Type</label>
                                                                                <select name="{{$offer}}[area_type][]" class="form-control">
                                                                                    @foreach($area_types as $area_type)
                                                                                        <option value="{{ $area_type }}">{{ ucfirst($area_type) }}</option>
                                                                                    @endforeach
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                    <div class="row mt-2">
                                                                        @if($offer != 'Plots' && $offer != 'Offices' && $offer != 'Shops')
                                                                            <div class="col-md-3">
                                                                                <div class="form-group">
                                                                                    <label class="form-label">Bedrooms</label>
                                                                                    <select name="{{$offer}}[bedrooms][]" class="form-control">
                                                                                        <option value="">Select</option>
                                                                                        @foreach($bedrooms as $bedroom)
                                                                                            <option value="{{ $bedroom }}">{{ $bedroom }}</option>
                                                                                        @endforeach
                                                                                  </select>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-3">
                                                                                <div class="form-group">
                                                                                    <label class="form-label">Bathrooms</label>
                                                                                    <select name="{{$offer}}[bathrooms][]" class="form-control">
                                                                                    <option value="">Select</option>
                                                                                        @foreach($bathrooms as $bathroom)
                                                                                            <option value="{{ $bathroom }}">{{ $bathroom }}</option>
                                                                                        @endforeach
                                                                                    </select>
                                                                                </div>
                                                                            </div>
                                                                        @endif
                                                                        <div class="col-md-3">
                                                                            <div class="form-group">
                                                                                <label class="form-label">Price <span>*</span></label>
                                                                                <input type="number" name="{{$offer}}[price_from][]" class="form-control" min="0" step="any" inputmode="decimal">
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-3">
                                                                            <div class="form-group">
                                                                                <label class="form-label">Amount in</label>
                                                                                <select name="{{$offer}}[price_type_from][]" id="price_type_from_{{$offer}}" class="form-control" >
                                                                                
                                                                                    @foreach($price_types as $key => $price_type)
                                                                                        <option value="{{ $price_type }}" {{ old('price_type_from', $project->price_type_from ?? '') == $price_type ? 'selected' : '' }}>{{ ucfirst($price_type) }}</option>
                                                                                    @endforeach
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                        
                                                                        
                                                                    </div> 

                            <div class="row installment-area">
                                
                                <div class="col-md-3  mt-5">
                                    <div class="form-group">
                                       
                                        <div class="form-check">
                                            <label >
                                                <input class="form-check-input installment-checkbox" value="1" type="checkbox" name="{{$offer}}[is_installment][]" >
                                                <strong>Is Installment</strong>
                                            </label>
                                        </div>                                    
                                    </div>
                                </div>
                                <div class="col-md-3 mt-3 is_installment display-none">
                                    <div class="form-group">
                                        <label class="form-label">Advance Amount<span>*</span></label>
                                        <input type="text" name="{{$offer}}[installment_advance_amount][]" class="form-control" value="" >  
                                    </div> 
                                </div>
                                <div class="col-md-3 mt-3 is_installment display-none">
                                    <div class="form-group">
                                        <label class="form-label">Number of Installments<span>*</span></label>
                                        <input type="number" name="{{$offer}}[number_of_instalments][]" class="form-control" value="" >  
                                    </div> 
                                </div>
                                <div class="col-md-3 mt-3 is_installment display-none">
                                    <div class="form-group">
                                        <label class="form-label">Monthly Installment<span>*</span></label>
                                        <input type="text" name="{{$offer}}[monthly_installment][]" class="form-control" value="" >  
                                    </div> 
                                </div>
                                    
                            </div> 
                                                                    <div class="text-end mt-2">
                                                                        <button type="button" class="btn btn-danger btn-sm remove-group" data-id="">Remove</button>
                                                                    </div>
                                                                </div>
                                                            @endif

                                                        </div>

                                                        
                                                        <div class="mt-2">
                                                            <button type="button" id="add-more" class="btn btn-primary btn-sm add-more"><i class="fa fa-plus"></i> Add More</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach

                                </div>
                            </div> 
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="form-label">Features</label>
                      
                                        <ul class="list-inline property-form-ul">
                                            @foreach($features as $feature)

                                                <li class="feature-{{ $feature->id }} list-inline-item">
                                                <input type="checkbox" class="btn-check" name="features[]" id="feature-{{ $feature->id }}" autocomplete="off" value="{{ $feature->id }}" {{ isset($project) && $project->features->contains($feature->id) ? 'checked' : '' }} >
                                                    <label class="btn btn-light" for="feature-{{$feature->id}}">{!! $feature->icon_image !!} {{$feature->name}}</label>
                                                    
                                                </li>
                                                
                                            @endforeach
                                        </ul>
                                        
                                    </div>
                                </div>
                            </div>       
                            <div class="row">
                                <div class="repeatable-wrapper" id="floorplans-wrapper">
                                    <label><strong>Floor Plans</strong></label>
                                  
                                    <div class="repeatable-fields">

                                        @if(isset($project))
                                            @if($project->floorPlan->count() > 0)
                                                @foreach($project->floorPlan as $floorPlan)

                                                    <div class="repeatable-group border p-3 mb-3 rounded bg-light">
                                                        <div class="row">
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                  <label class="form-label">Title<span>*</span></label>
                                                                  <input type="text" name="floorplans[title][]" class="form-control" placeholder="Enter floor title" value="{{ $floorPlan->title }}" >
                                                              </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                  <label class="form-label">Upload Image<span>*</span></label>
                                                                  <input type="file" name="floorplans[image][]" class="form-control" accept="image/*" >
                                                                  <input type="hidden" name="floorplans[id][]" value="{{$floorPlan->id}}">
                                                              </div>
                                                            </div>
                                                            
                                                            <div class="col-md-4">                       
                                                                <div class="form-group">
                                                                    @if(!empty($floorPlan->media_url))
                                                                        <a href="{{asset($floorPlan->media_url)}}" target="_blank" class="available-image-area">
                                                                            
                                                                            <img src="{{asset($floorPlan->media_url)}}" class="logo" title="Flooer Plan" alt="Flooer Plan Image" width="50%">                                                    
                                                                        </a>                                          
                                                                    @endif
                                                                </div>                                                      
                                                            </div>
                                                            
                                                            <div class="text-end mt-2">
                                                                <button type="button" class="btn btn-danger btn-sm remove-group" data-floorplan-id="{{$floorPlan->id}}">Remove</button>
                                                            </div>

                                                        </div>
                                                    </div>

                                                @endforeach
                                            @else
                                                <div class="repeatable-group border p-3 mb-3 rounded bg-light">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                              <label class="form-label">Title<span>*</span></label>
                                                              <input type="text" name="floorplans[title][]" class="form-control" placeholder="Enter floor title" value="" >
                                                          </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                              <label class="form-label">Upload Image<span>*</span></label>
                                                              <input type="file" name="floorplans[image][]" class="form-control" accept="image/*" >
                                                              <input type="hidden" name="floorplans[id][]" value="">
                                                          </div>
                                                        </div>
                                                        
                                                        <div class="col-md-4">                       
                                                            <div class="form-group">
                                                                
                                                            </div>                                                      
                                                        </div>
                                                        
                                                        <div class="text-end mt-2">
                                                            <button type="button" class="btn btn-danger btn-sm remove-group" data-floorplan-id="">Remove</button>
                                                        </div>

                                                    </div>
                                                </div>
                                            @endif
                                        @else                                   
                                        
                                            <div class="repeatable-group border p-3 mb-3 rounded bg-light">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                          <label class="form-label">Title<span>*</span></label>
                                                          <input type="text" name="floorplans[title][]" class="form-control" placeholder="Enter floor title" value="" >
                                                      </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                          <label class="form-label">Upload Image<span>*</span></label>
                                                          <input type="file" name="floorplans[image][]" class="form-control" accept="image/*" >
                                                          <input type="hidden" name="floorplans[id][]" value="">
                                                      </div>
                                                    </div>
                                                    
                                                    <div class="col-md-4">                       
                                                        <div class="form-group">
                                                            
                                                        </div>                                                      
                                                    </div>
                                                    
                                                    <div class="text-end mt-2">
                                                        <button type="button" class="btn btn-danger btn-sm remove-group" data-floorplan-id="">Remove</button>
                                                    </div>

                                                </div>
                                            </div>
                                        @endif

                                    </div>
                                    
                                    <button type="button" class="btn btn-primary mt-2 btn-sm add-more"><i class="fa fa-plus"></i> Add More</button>
                                </div>
                            </div>
                            <div class="row mt-3">                            
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="form-label">Payment Plan Duration</label>
                                        <select data-placeholder="Select Payment Plan Duration" name="payment_plan_duration[]" id="payment_plan_duration" class="form-control select2" multiple  >
                                            <option value="">Select Payment Plan Duration</option>
                                            @foreach($payment_plan_duration as $key => $ppd)
                                                <option value="{{ $key }}" @selected(isset($project->payment_plan_duration) && in_array($key,$project->payment_plan_duration) )  >{{ ucfirst($ppd) }}</option>
                                            @endforeach
                                        </select>
                                        <div class="">&nbsp;</div>
                                        <label class="form-label">Payment Plan</label>
                                        <input type="file" name="payment_plan[]" multiple class="form-control filepond" id="payment_plan" >
                                        <input type="hidden" id="uploaded-files2" name="uploaded_files2[]" />
                                            <input type="hidden" id="deleted-files2" name="deleted_files2[]" />
                                        <div class="uploaded-images file-pond-preview-wrapper" id="payment-preview" data-upload-type="payment_plan" data-allow-reorder="true" data-max-files="10" data-collection="payment_plan" data-preview="payment-preview">
                                            @if(isset($project))
                                                @foreach($project->getMedia('payment_plan')->sortBy('order_column') as $media)
                                                <div class="media-item preview-box remove-media" data-media-id="{{ $media->id }}" data-id="{{ $media->id }}">
                                                    <div class="media-thumb">
                                                        <a href="{{ asset($media->getUrl('webp')) }}" target="_blank" data-fancybox="payment-preview">
                                                            <img src="{{ asset($media->getUrl()) }}" alt="uploaded" >
                                                        </a>
                                                        <div class="remove-media">
                                                            <span title="Remove" class="remove-media " >Remove</span>
                                                        </div>
                                                    </div>
                                                    
                                                </div>
                                                @endforeach
                                            @endif

                                         
                                                @if(isset($project))
                                                @php
                                                $existingImages2 = $project->getMedia('payment_plan')->map(function ($media) {
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
                            </div>

                            <div class="row mt-3">                            
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="form-label">Progress</label>
                                        <input type="file" name="project_progress[]" multiple class="form-control filepond" id="project_progress" >
                                        <input type="hidden" id="uploaded-files4" name="uploaded_files4[]" />
                                            <input type="hidden" id="deleted-files4" name="deleted_files4[]" />
                                        <div class="uploaded-images file-pond-preview-wrapper" id="project-progress-preview" data-upload-type="project_progress" data-allow-reorder="true" data-max-files="10" data-collection="project_progress" data-preview="project-progress-preview">
                                            @if(isset($project))
                                                @foreach($project->getMedia('project_progress') as $media)
                                                <div class="media-item preview-box remove-media" data-media-id="{{ $media->id }}" data-id="{{ $media->id }}">
                                                    <div class="media-thumb">
                                                        <a href="{{ asset($media->getUrl('webp')) }}" target="_blank" data-fancybox="project-progress-preview">
                                                            <img src="{{ asset($media->getUrl('webp')) }}" alt="uploaded" >
                                                        </a>
                                                        <div class="remove-media">
                                                            <span title="Remove" class="remove-media " >Remove</span>
                                                        </div>
                                                    </div>
                                                    
                                                </div>
                                                @endforeach
                                            @endif

                                         
                                                @if(isset($project))
                                                @php
                                                $existingImages2 = $project->getMedia('project_progress')->map(function ($media) {
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
                            </div>

                            <div class="row mt-3">                            
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="form-label">Gallery Images</label>
                                        <input type="file" name="project_gallery[]" multiple class="form-control filepond"  >
                                        <input type="hidden" id="uploaded-files" name="uploaded_files[]" data-max-files="10" />
                                            <input type="hidden" id="deleted-files" name="deleted_files[]" />
                                        <div class="uploaded-images file-pond-preview-wrapper gallery" id="gallery-preview" data-upload-type="gallery" data-allow-reorder="true"   data-preview="gallery-preview" data-collection="project_gallery">
                                            @if(isset($project))
                                                @foreach($project->getMedia('project_gallery')->sortBy('order_column') as $media)
                                                <div class="media-item preview-box remove-media" data-media-id="{{ $media->id }}" data-id="{{ $media->id }}">
                                                    <div class="media-thumb">
                                                        <a href="{{ asset($media->getUrl('webp')) }}" target="_blank" data-fancybox="gallery-preview" >
                                                            <img src="{{ asset($media->getUrl('webp')) }}" alt="uploaded" style="">
                                                        </a>
                                                        <label class="form-label featured-image-checkbox-label"><input type="radio" name="featured_image" value="{{ $media->id }}" @checked($project->featured_media_id == $media->id)> Set Featured</label>
                                                        <div class="remove-media">
                                                            <span title="Remove" class="remove-media " >Remove</span>
                                                        </div>
                                                    </div>
                                                    
                                                </div>
                                                @endforeach
                                            @endif

                                         
                                                @if(isset($project))
                                                @php
                                                $existingImages = $project->getMedia('project_gallery')->map(function ($media) {
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
                            </div>
                            <div class="row mt-3"> 
                                <div class="col-md-3 mb-3 mt-3">
                                    <div class="form-group">
                                       
                                        <div class="form-check form-switch">
                                          <input class="form-check-input" type="checkbox" id="is_active" name="is_active" {{ (isset($project) && $project->is_active == 0) ? '' : 'checked' }}>
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
                                          <input class="form-check-input" type="checkbox" id="is_popular" name="is_popular" {{ (isset($project) && $project->is_popular == 1) ? 'checked' : '' }}>
                                          <label class="form-check-label" for="is_popular">Is Popular</label>
                                        </div>                                    
                                    </div>
                                </div>
                            </div>

                            <div class="row mt-3 display-none">
                                <label class="form-label"><strong><a href="javascript:;" class="toggle-survey-fields" >Survey Fields</a></strong></label>
                                <div class="survey-fields row {!! !$is_show_survey_fields ? 'display-none' : '' !!} border p-3 m-2 rounded bg-light">
                                     
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="form-label">Rate Per Square</label>
                                            <input type="text" name="rate_per_square" class="form-control" value="{{ old('rate_per_square', $project->rate_per_square ?? '') }}" >  
                                        </div> 
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="form-label">Development Charges</label>
                                            <input type="text" name="development_charges" class="form-control" value="{{ old('development_charges', $project->development_charges ?? '') }}" >  
                                        </div> 
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="form-label">Utility Charges</label>
                                            <input type="text" name="utility_charges" class="form-control" value="{{ old('utility_charges', $project->utility_charges ?? '') }}" >  
                                        </div> 
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="form-label">Distance</label>
                                            <input type="text" name="distance" class="form-control" value="{{ old('distance', $project->distance ?? '') }}" >  
                                        </div> 
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="form-label">Project Floors</label>
                                            <input type="text" name="project_floors" class="form-control" value="{{ old('project_floors', $project->project_floors ?? '') }}" >  
                                        </div> 
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="form-label">Project Start Date</label>
                                            <input type="date" name="project_start_date" class="form-control" value="{{ old('project_start_date', $project->project_start_date ?? '') }}" >  
                                        </div> 
                                    </div>
                                </div>
                                    
                            </div>


                            <div class="row mb-5">

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <input type="hidden" name="deleted-offer[]" id="deleted-offer">
                                        <input type="hidden" name="deleted-floor-plan[]" id="deleted-floor-plan">
                                        <input type="hidden" name="featured_media_id" id="featured_media_id" value="{{ isset($project) ? $project->featured_media_id : 0 }}">
                                        <button type="submit" class="btn btn-success mt-3">{{ isset($project) ? 'Update' : 'Save' }}</button>
                                        <button type="submit" class="btn btn-warning mt-3">Back</button>
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

$(document).on("change", "input.offering", function(){
    var offer = $(this).val();
    if($(this).is(":checked")){
        $(".offer-item-"+offer).removeClass("display-none");
        $(".offer-item-btn-"+offer).trigger("click");
        $('html, body').animate({ scrollTop: $(".offer-item-"+offer).offset().top}, 100);
    }else{
        $(".offer-item-"+offer).addClass("display-none");
    }

});


$(document).ready(function () {
    // Handle Add More for all groups
    $('.repeatable-wrapper').on('click', '.add-more', function () {
        let $wrapper = $(this).closest('.repeatable-wrapper');
        let $group = $wrapper.find('.repeatable-group:first').clone();

        // Clear input/select values
        $group.find('input, select').val('');
        $group.find('button.remove-group').attr('data-id','');
        $group.find('button.remove-group').attr('data-floorplan-id','');
        $group.find('a.available-image-area').remove();

        $wrapper.find('.repeatable-fields').append($group);
    });

    // Handle Remove within groups
    $(document).on('click', '.repeatable-wrapper .remove-group', function () {
        let $fields = $(this).closest('.repeatable-fields');
        if ($fields.find('.repeatable-group').length > 1) {
            if($(this).data("id")  || $(this).data("floorplan-id")){
                Swal.fire({
                    title: 'Are you sure?',
                    text: "The record will be deleted after you save this form.",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $(this).closest('.repeatable-group').remove();
                        var element_id = "deleted-offer";
                        var record_id = $(this).data("id");
                        if($(this).data("floorplan-id")){
                            element_id = "deleted-floor-plan";
                            record_id = $(this).data("floorplan-id");
                        }
                        
                        addDeletedRec(record_id,element_id);
                    }
                });
            }else{

                $(this).closest('.repeatable-group').remove();
            }
          
        }
    });

    
    
});

function addDeletedRec(record_id,element_id) {
    const field = document.getElementById(element_id);
    let val = field.value ? JSON.parse(field.value) : [];
    val.push(record_id);
    field.value = JSON.stringify(val);
}

$(document).on("change", "input.installment-checkbox", function(){

    if($(this).is(":checked")){
        $(this).parents(".installment-area").find(".is_installment").removeClass("display-none");
    }else{
        $(this).parents(".installment-area").find(".is_installment").addClass("display-none");
    }

});

$(document).on("click",".toggle-survey-fields", function(){
    $(".survey-fields").toggleClass("display-none");
});

</script>
@if(!isset($project))
    <script>

    $(document).ready(function () {

        progress = sessionStorage.getItem('progress') || '';
        $('select#progress').val(progress).trigger('change');

        $('select#progress').on('change', function() {
            sessionStorage.setItem('progress', $(this).val());
        });

        builder_id = sessionStorage.getItem('builder_id') || '';
        $('select#builder_id').val(builder_id).trigger('change');

        $('select#builder_id').on('change', function() {
            sessionStorage.setItem('builder_id', $(this).val());
        });

        city_id = sessionStorage.getItem('city_id') || '';
        $('select#city_id').val(city_id).trigger('change');

        $('select#city_id').on('change', function() {
            sessionStorage.setItem('city_id', $(this).val());
        });

        
    });
    // Auto-fill form from sessionStorage
    window.addEventListener('DOMContentLoaded', () => {
        document.getElementById('project_title').value = sessionStorage.getItem('project_title') || '';
        document.getElementById('txtEditor').value = sessionStorage.getItem('description') || '';
        document.getElementById('gmap-location').value = sessionStorage.getItem('gmap-location') || '';
        
    });

    // Save on input
    document.getElementById('project_title').addEventListener('input', e => {
        sessionStorage.setItem('project_title', e.target.value);
    });

    document.getElementById('gmap-location').addEventListener('input', e => {
        console.log(e.target.value);
        sessionStorage.setItem('gmap-location', e.target.value);
    });
        
    </script>


@endif
@endsection

