@if($properties->count())
    <p>{{ $properties->firstItem() }} to {{ $properties->lastItem() }} out of {{ $properties->total() }} properties</p>

    @foreach($properties as $property)
        <div class="col-md-12 mb-3 mb-4">
            <div class="project-div position-relative row g-0">
                <div class="col-md-4">
                    
                    <a href="{{ route('property.show', $property->slug) }}" class="card-img">
                        @php
                                                  
                            $gallery = $property->getMedia('property_gallery');
                            $firstImage = ($property->featuredImage) ? $property->featuredImage : $gallery->first();  // Get the first media
                             
                        @endphp
                        @if(!empty($firstImage))
                            <img src="{{  $firstImage->getUrl('webp') ?? '' }}" alt="" width="100%">
                        @else
                            <img src="{{ asset('assets/img/no-image-1080x1080.png') }}" alt="" width="100%">
                        @endif
                    </a>
                </div>
                <div class="col-md-8">
                    <div class="p-4">
                        <a href="{{ route('property.show', $property->slug) }}"><h6>{{ $property->property_title }}</h6></a>
                        
                        <p class="loc-txt"><i class="fa fa-map-marker"></i> {{ $property->alt_location ?? '' }}</p>
                        <p class="mb-3 listing-short-desc">
                            @php

                                $limit = config('constants.property_text_limit'); // Limit characters
                                $description = $property->description;
                            @endphp    
                            {!! \Illuminate\Support\Str::limit(strip_tags($description), $limit) !!}
                            {!! \Illuminate\Support\Str::limit(strip_tags($property->description), 100) !!}...
                            @if(strlen($description) > $limit)
                                <a href="{{ route('property.show', $property->slug) }}" class="">Show more</a>
                            @endif
                        </p>
                        <ul class="amenities">
                            @if($property->listing_type == 'builder')
                            <li><i class="fa fa-user"></i> 
                            
                            {{ $property->company_name .'-'. $property->project_name }}</li>

                            @endif
                            <li><i class="fa fa-building"></i> {{ $property->property_type ?? '' }}</li>
                            <li><i class="fa fa-arrows"></i> {{ $property->area_size ?? '' }}  </li>
                        </ul>
                        <hr>
                        <div class="row mt-4 align-items-center">
                            <div class="col-md-4">
                                <h6 class="crore-h"><span style="font-size: 13px;">Starting Price</span><br>{{ $property->custom_price['amount'] ?? ''}} {{ $property->custom_price['unit'] ?? '' }} </h6>
                            </div>
                            
                            <div class="col-md-8 text-md-end">
                               
                                
                                <a href="{{ route('property.show', $property->slug) }}" class="detail-btn">More Details</a>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    @endforeach

    {!! $properties->links('vendor.pagination.custom') !!}
@else
    <p>No properties found.</p>
@endif
