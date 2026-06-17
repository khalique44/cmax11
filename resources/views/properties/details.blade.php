@extends('layouts.app')
@section('meta_title',  $property->property_title )

  
@section('content')


  @include('layouts.includes.nav')
      
  <section class="gallery-area pt-5 pb-md-5">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-6">
                <div class="breadcrumbs">
                    <ol class="breadcrumbs">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item active">Property List</li>
                    </ol>
               </div>
               <div class="position-relative">
                    <a href="#" class="launch-btn red-bg position-static">
                       

                        {{ $furnishing[$property->furnish] ?? '' }}
                                
                    </a>
                    <a href="#" class="launch-btn position-static">{{ $property->purpose ?? '' }}</a>
                    <a href="#" class="launch-btn green-bg  position-static">{{ $property->category->name ?? '' }}</a>
               </div>
               <h1 class="mt-4 mt-md-2 mainhead-inner">{{ $property->property_title }}</h1>
               <p class="loc-txt"><i class="fa fa-map-marker" aria-hidden="true"></i> {{ $property->alt_location ?? '' }} <a href="#location" title="See on the Map"><i class="fa fa-eye"></i></a></p>


            </div>
            <div class="col-md-6 text-md-end">
                <h2 class="Starting-price mb-4"><span>Price</span>

                   {{ $property->custom_price['amount'] ?? ''}} {{ $property->custom_price['unit'] ?? '' }}
                    
                </h2>
                <div class="d-md-flex justify-content-end details-btnss">
                    
                    <div class="call-btn mb-2">
                        <a href="tel:{{ $property->mobile_number ?? '#' }}">
                            <img src="{{ asset('assets/img/phone-icon.svg') }}" alt="">
                            Call</a>
                    </div>
                    <div class="whatsapp-btn mb-3">
                        <a href="tel:{{ $property->whatsapp_number ?? '#' }}">
                            <img src="{{ asset('assets/img/whatsapp-icon.svg') }}" alt="">
                            Whatsapp</a>
                    </div>
                </div>
                
            </div>
        </div>

        <div class="row galleria mt-3">
          @php
            $paymentPlans = $property->getMedia('payment_plan')->sortBy('order_column');                        
            $propertyProgress = $property->getMedia('property_progress')->sortBy('order_column');                        
            $gallery = $property->getMedia('property_gallery')->sortBy('order_column');
            $firstImage = ($property->featuredImage) ? $property->featuredImage : $gallery->first();  // Get the first media
            $remainingImages = $gallery->slice(1);  // Skip the first media
          @endphp

            <div class="col-md-6">
                @if(!empty($firstImage))
                    <div class="gallery-main">
                        <a href="{{  GeneralHelper::getMediaWithPublicDir($firstImage->getUrl('webp')) }}" data-fancybox="gallery-group">
                            <img src="{{  GeneralHelper::getMediaWithPublicDir($firstImage->getUrl('webp')) }}" alt="" class="w-100 main-img-detail-pg">
                        </a>
                    </div>
                @endif
            </div>
            <div class="col-md-6">
                <div class="row">
                    @if(!empty($remainingImages))
                      @foreach($remainingImages as $key => $media)
                        <div class="col-6" {!! ($key > 4) ? "style='display:none;'" : "" !!}>
                          <div class="gallery-box">
                              <a href="{{   GeneralHelper::getMediaWithPublicDir($media->getUrl('webp')) }}" data-fancybox="gallery-group"><img src="{{   GeneralHelper::getMediaWithPublicDir($media->getUrl('webp')) }}" alt="" class=""></a>
                              @if($key == 4)
                                <a href="#" class="btn-showgal"><img src="{{ asset('assets/img/gallery-iconwhite.png') }}" alt=""> Show all photos</a>
                              @endif
                          </div>
                        </div>
                      @endforeach
                    @endif
                    
                </div>
            </div>
        </div>
    </div>
  </section>

  <section class="py-5">
     <div class="container">
        <div class="row">
            
            <div class="col-md-9">
                <div class="page-navigation">
                    <nav id="navbar-example2" class="navbar navbar-light bg-light">
                        <ul class="nav nav-pills">
                          <li class="nav-item">
                            <a class="nav-link" href="#overview">Overview</a>
                          </li>

                          <li class="nav-item dropdown">
                            <a class="nav-link" href="#details">Details</a>
                          </li>
                          
                          @if( $property->amenities->count() > 0 )
                              <li class="nav-item dropdown">
                                <a class="nav-link" href="#amenities">Amenities</a>
                              </li>
                          @endif  
                          
                          @if( $property->video_url )
                              <li class="nav-item dropdown">
                                <a class="nav-link" href="#video">Video</a>
                              </li>
                          @endif
                          

                          <li class="nav-item dropdown">
                            <a class="nav-link" href="#location">Location</a>
                          </li>
                         
                          

                          

                          
                        </ul>
                      </nav>
                </div>

                <div data-spy="scroll" data-target="#navbar-example2" data-offset="0" class="scrollspy-example" tabindex="0">
                    <div class="sec-gal mt-5 description-container" id="overview">
                        <h3 class="mb-3">Property Overview</h3>
                        @php

                            $limit = config('constants.property_text_limit'); // Limit characters
                            $description = $property->description;
                        @endphp
                        <div class="">
                            <div class="short-description">
                                {!! \Illuminate\Support\Str::limit(strip_tags($description), $limit) !!}
                            
                            </div>
                            <div class="full-description" style="display: none;">
                                {!! $description !!}
                            </div>

                            @if(strlen($description) > $limit)
                                <a href="javascript:void(0);" class="toggle-description text-primary">Show more</a>
                            @endif
                        </div>
                    </div>
                    
                    <div class="sec-gal mt-4" id="details">
                        <h3 class="mb-3">Property Details</h3>
                        <ul class="listwith">
                            <li><span>Purpose</span> {{ $purpose[$property->purpose] ?? '' }}</li>
                            <li><span>Property Type</span> {{ ucfirst($property->property_type) ?? '' }}</li>
                            <li><span>Location</span> {{ $property->alt_location ?? '' }}</li>
                            <li><span>Area Size</span> {{ $property->area_size ?? '' }}</li>
                            <li><span>Listing Type</span> {{ $listing_types[$property->listing_type] ?? '' }}</li>
                            @if($property->listing_type == 'builder')
                             <li><span>Company</span> {{ $property->company_name ?? '' }}</li>
                             <li><span>Project</span> {{ $property->project_name ?? '' }}</li>
                            @endif
                            @if($property->bedrooms)
                                <li><span>Bedrooms</span> {{ $property->bedrooms ?? '' }}</li>
                            @endif
                            @if($property->bathrooms)
                                <li><span>Bathrooms</span> {{ $property->bathrooms ?? '' }}</li>
                            @endif

                            @if($property->floor)
                                <li><span>Floor</span> {{ $property->floor ?? '' }} 
                                    @if($property->total_floors)
                                        (Total   {{ $property->total_floors ?? '' }} floors)
                                    @endif
                                </li>
                            @endif

                            @if($property->is_installment)

                                <li>
                                    <span>Total Installments</span> 
                                    {{ $property->number_of_instalments ?? 'N/A' }} 
                                    <span>Advance Amount</span> 
                                    {{ $property->installment_advance ?? 'N/A' }} 
                                   
                                   <span>Monthly Installment</span> 
                                   {{ $property->monthly_installment_amount ?? 'N/A' }}
                                </li>
                               
                            @endif

                            @if($property->ready_for_possession)
                                <li><span>Ready for possession</span> Yes</li>
                            @endif
                            @if($property->furnish)
                            <li><span>Furnishing</span> {{ $furnishing[$property->furnish] ?? '' }}</li>
                            
                            @endif
                            
                           
                        </ul>
                    </div>
                    
                     @if($property->amenities->count() > 0)
                        <div class="sec-gal mt-4" id="amenities">
                            <h3 class="mb-3">Amenities</h3>
                            <ul class="checked_list">
                                @foreach($property->amenities as $key => $amenity)
                                    <li>
                                        {!! $amenity->icon_image ?? '' !!}
                                        {{ $amenity->name ?? ''}}
                                    </li>
                                @endforeach
                                
                            </ul>
                        </div>
                    @endif
                    @if( $property->video_url )
                        <div class="sec-gal mt-4" id="video">
                            <h3 class="mb-3">Property Video</h3>
                            <div class="inside-map pt-4">
                            
                                <iframe 
                                    src="{{ $property->video_url }}" 
                                    width="560" 
                                    height="315" 
                                    frameborder="0" 
                                    allowfullscreen>
                                </iframe>
                                
                            </div>
                        </div>
                    @endif
                    <div class="sec-gal mt-4" id="location">
                        <h3 class="mb-3">Property Location</h3>
                        <div class="inside-map pt-4">
                            @php 
                                $latitude = $property->latitude;
                                $longitude = $property->longitude;
                            @endphp
                            <iframe 
                                width="100%" 
                                height="300" 
                                frameborder="0" 
                                style="border:0"
                                src="https://www.google.com/maps?q={{ $latitude }},{{ $longitude }}&hl=es;z=14&output=embed"
                                allowfullscreen
                                loading="lazy"
                                referrerpolicy="no-referrer-when-downgrade">
                            </iframe>
                            
                        </div>
                    </div>   

                            
                    @if($property->listing_type == 'builder')
                        <div class="sec-gal mt-4" id="devloped_by">
                            <h3 class="mb-3">Developed By</h3>
                                <div class="row">
                                   
                                    <div class="col-md-8">
                                        <p><h5>Company: {{ $property->company_name }}</h5>  </p>
                                        <p><h5>Project: {{ $property->project_name }}</h5> </p>
                                        
                                    </div>
                                </div>
                        </div>
                    @endif

                    <!-- <div class="sec-gal mt-4" id="attachments">
                        <h3 class="mb-3">Attachments</h3>
                        
                        <div class="down-btn pt-3">
                            <a href="#" class="btn btn-red">
                                <svg xmlns="http://www.w3.org/2000/svg') }}" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" width="25" height="25" x="0" y="0" viewBox="0 0 32 32" style="enable-background:new 0 0 512 512" xml:space="preserve" class=""><g><path d="M28 24v-4a1 1 0 0 0-2 0v4a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1v-4a1 1 0 0 0-2 0v4a3 3 0 0 0 3 3h18a3 3 0 0 0 3-3zm-6.38-5.22-5 4a1 1 0 0 1-1.24 0l-5-4a1 1 0 0 1 1.24-1.56l3.38 2.7V6a1 1 0 0 1 2 0v13.92l3.38-2.7a1 1 0 1 1 1.24 1.56z" data-name="Download" fill="#ffffff" opacity="1" data-original="#000000" class=""></path></g></svg>
                                Download Attachment</a>
                        </div>

                    </div> -->

                    

                </div>

            </div>



            <div class="col-md-3">
                <div class="calculator_budget">
                    <div class="text-center pb-3">
                        <h2 class="main-h mb-4">Get In Touch</h2>

                        <form class="calc-form" id="property-inquiry">
                            @csrf
                            <div class="form-group mt-3">
                                <input type="text" name="name" placeholder="Name" class="form-control">
                            </div>
                            <div class="form-group mt-3">
                                <input type="email" name="email" placeholder="Email" class="form-control">
                            </div>
                            <div class="form-group mt-3">
                                <input type="text" name="phone" placeholder="Contact Number" class="form-control">
                            </div>
                            <div class="form-group mt-3">
                                <input type="text" name="address" placeholder="Provide your address" class="form-control">
                            </div>
                            
                            
                            <div class="form-group mt-3">
                                <textarea name="message" id="" placeholder="Message" class="form-textarea"></textarea>
                            </div>
                            
                            <div class="form-group mt-3">
                                <input type="hidden" name="property_title" value="{{ $property->property_title ?? '' }}" >
                                <input type="hidden" name="property_url" value="{{ route('property.show', $property->slug) }}" >
                                <input type="hidden" name="property_id" value="{{ $property->id ?? '' }}" >
                                <button type="submit" class="btn btn-red w-100">Submit</button>
                            </div>
                            <div class="property-inquiry-ajax-message"></div>
                        </form>

                     </div>
                </div>
            </div>
            
        </div>
        
     </div>
  </section>
<!-- @if($related_properties->count() > 0)
    <section class="py-5">
        <div class="container">
           <div class="row text-center pb-3">
              <h5 class="sub-h">See More</h5>
              <h2 class="main-h">Related Properties</h2>
           </div>
           <div class="row">
            
            @include('properties.partials.short_list',['properties' => $related_properties])
              
           </div>
          
        </div>
    </section>
@endif -->

  @include('layouts.includes.footer')     
       
@endsection