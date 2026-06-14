@if($properties->count())
    <p>{{ $properties->firstItem() }} to {{ $properties->lastItem() }} out of {{ $properties->total() }} properties</p>

    @foreach($properties as $property)
        <div class="col-md-12 mb-3 mb-4">
            <div class="project-div position-relative row g-0">
                <div class="col-md-4">
                    <a href="#" class="launch-btn">{{ $progress[$property->progress] }}</a>
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
                        <div class="logo-builder">
                            @if($property->logo_url)
                                <img src="{{ asset($property->logo_url) }}" alt="property Image"  >
                            @else
                                 <img src="{{ asset('assets/img/no-image-1080x1080.png') }}" alt="Builder Image">               
                            @endif

                        </div>
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
                            <li><i class="fa fa-user"></i> {{ $property->builder->builder_name ?? 'N/A' }}</li>
                            <li><i class="fa fa-building"></i> {{ $property->offering ?? '' }}</li>
                            <li><i class="fa fa-arrows"></i> {{ $property->offers->min('area') ?? '' }} - {{ $property->offers->max('area') ?? '' }} {{ $property->offers->first()->area_type ?? '' }}</li>
                        </ul>
                        <hr>
                        <div class="row mt-4 align-items-center">
                            <div class="col-md-4">
                                <h6 class="crore-h"><span style="font-size: 13px;">Starting Price</span><br>{{ $property->offers->min('price_from') ?? '' }} {{ $property->offers->first()->price_from_in_format ?? '' }}</h6>
                            </div>
                            
                            <div class="col-md-8 text-md-end">
                                @if(in_array($property->id, $compare))
                                <a href="javascript:;" class="detail-btn btn-grey"  onclick="removeCompare('{{ $property->id }}')">Remove from Compare</a>
                                @else
                                <a href="javascript:;" class="detail-btn btn-red addToCompare" data-id="{{ $property->id }}" data-title="{{ $property->property_title }}">Compare</a>
                                @endif
                                
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
