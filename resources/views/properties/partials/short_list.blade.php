@foreach($properties as $key => $property)
  @php
      $gallery = $property->getMedia('property_gallery');
      $firstImage = ($property->featuredImage) ? $property->featuredImage : $gallery->first();  // Get the first media
      $remainingImages = $gallery->slice(1);  // Skip the first media
  @endphp
  <div data-aos="fade-up" class="col-md-4 {{ ($key <= 1) ? 'mb-3 mb-md-0' : '' }}">
      <div class="project-div position-relative">
          
          <a href="{{ route('property.show', $property->slug) }}">
              @if(!empty($firstImage))
                  <img src="{{  GeneralHelper::getMediaWithPublicDir($firstImage->getUrl('webp')) }}" alt="" width="100%" style="border-radius: 20px 20px 0px 0px;">
              @else
                  <img src="{{ asset('assets/img/no-image_1024x786x.png') }}" alt="No Image" style="border-radius: 20px 20px 0px 0px;" width="100%">
                  
              @endif
              
          </a>
          <div class="p-4">
             <a href="{{ route('property.show', $property->slug) }}">
             <h6>{{ $property->property_title }}</h6>
             </a>
             <p class="loc-txt"><i class="fa fa-map-marker" aria-hidden="true"></i> {{ $property->alt_location ?? '' }}</p>
             <p class="mb-4">
                {{ $property->area_size ?? '' }}
             </p>
             <hr>
             <div class="row mt-4 align-items-center">
                <div class="col-5">
                   <h6 class="crore-h">
                      {{ $property->custom_price['amount'] ?? ''}} {{ $property->custom_price['unit'] ?? '' }}
                       <span style="font-weight: 400; font-size: 13px;">Starting Price</span></h6>
                </div>
               
                
             </div>
          </div>
      </div>
  </div>
@endforeach