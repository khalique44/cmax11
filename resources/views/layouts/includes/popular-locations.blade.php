@php
  $home_section_popular_location = GeneralHelper::getOption('home_section_popular_location');
 
  $first_box_location_image = GeneralHelper::getOption('first_box_location_image');        

  $second_box_location_image = GeneralHelper::getOption('second_box_location_image');

  $third_box_location_image = GeneralHelper::getOption('third_box_location_image');

  $fourth_box_location_image = GeneralHelper::getOption('fourth_box_location_image');

  $fifth_box_location_image = GeneralHelper::getOption('fifth_box_location_image');

  $sixth_box_location_image = GeneralHelper::getOption('sixth_box_location_image');

  $first_box_location_image = $first_box_location_image ? 'background-image:url('.asset($first_box_location_image).')' : "";
  $second_box_location_image = $second_box_location_image ? "background-image:url(".asset($second_box_location_image).")" : "";
  $third_box_location_image = $third_box_location_image ? "background-image:url(".asset($third_box_location_image).")" : "";
  $fourth_box_location_image = $fourth_box_location_image ? "background-image:url(".asset($fourth_box_location_image).")" : "";
  $fifth_box_location_image = $fifth_box_location_image ? "background-image:url(".asset($fifth_box_location_image).")" : "";
  $sixth_box_location_image = $sixth_box_location_image ? "background-image:url(".asset($sixth_box_location_image).")" : "";
@endphp
<section class="py-5">
    <div class="container">
    <div class="row text-center pb-3">
        <h5 class="sub-h">Explore</h5>
        <h2 class="main-h">{{ $home_section_popular_location ?? 'Popular Locations' }}</h2>
    </div>
    <div class="row">
        <div data-aos="fade-up" class="col-12 col-md-6 mb-3 mb-md-0">
            <a href="{{route('search-results')}}?search-area={{ !empty($first_box_location) ? $first_box_location : 'Clifton'}}&builder_id=&monthly_installment=&property_type=&price_from=&price_to=&bedrooms=&progress=">
            <div class="loc-div" style="{{  $first_box_location_image  }}">
                <p class="pt-4 ps-4 mb-0 loc-p z-index-9 position-relative">{{ $first_box_location_count ?? '0'}} Projects</p>
                <p class="ps-4 mb-0 loc-h z-index-9 position-relative">{{ !empty($first_box_location) ? $first_box_location : 'Clifton'}}</p>
            </div>
        </a>
        </div>
        <div data-aos="fade-up" class="col-6 col-md-3 mb-3 mb-md-0">
            <a href="{{route('search-results')}}?search-area={{ !empty($second_box_location) ? $second_box_location : 'Boat Basin'}}&builder_id=&monthly_installment=&property_type=&price_from=&price_to=&bedrooms=&progress=">
            <div class="loc-div boat-div" style="{{  $second_box_location_image  }}">
                <p class="pt-4 ps-4 mb-0 loc-p z-index-9 position-relative">{{ $second_box_location_count ?? '0'}} Projects</p>
                <p class="ps-4 mb-0 loc-h z-index-9 position-relative">{{ !empty($second_box_location) ? $second_box_location : 'Boat Basin'}}</p>
            </div>
            </a>
        </div>
        <div data-aos="fade-up" class="col-6 col-md-3 mb-3 mb-md-0">
            <a href="{{route('search-results')}}?search-area={{ !empty($third_box_location) ? $third_box_location : 'Scheme 33'}}&builder_id=&monthly_installment=&property_type=&price_from=&price_to=&bedrooms=&progress=">
            <div class="loc-div scheme-div" style="{{  $third_box_location_image  }}">
                <p class="pt-4 ps-4 mb-0 loc-p z-index-9 position-relative">{{ $third_box_location_count ?? '0'}} Projects</p>
                <p class="ps-4 mb-0 loc-h z-index-9 position-relative">{{ !empty($third_box_location) ? $third_box_location : 'Scheme 33'}}</p>
            </div>
        </a>
        </div>
    </div>
    <div class="row mt-md-4">
        <div data-aos="fade-up" class="col-12 col-md-3 mb-3 mb-md-0">
            <a href="{{route('search-results')}}?search-area={{ !empty($fourth_box_location) ? $fourth_box_location : 'Bahria'}}&builder_id=&monthly_installment=&property_type=&price_from=&price_to=&bedrooms=&progress=">
            <div class="loc-div bahria-div" style="{{  $fourth_box_location_image  }}">
                <p class="pt-4 ps-4 mb-0 loc-p z-index-9 position-relative">{{ $fourth_box_location_count ?? '0'}} Projects</p>
                <p class="ps-4 mb-0 loc-h z-index-9 position-relative">{{ !empty($fourth_box_location) ? $fourth_box_location : 'Bahria'}}</p>
            </div>
        </a>
        </div>
        <div data-aos="fade-up" class="col-6 col-md-3 mb-3 mb-md-0">
            <a href="{{route('search-results')}}?search-area={{ !empty($fifth_box_location) ? $fifth_box_location : 'Defence'}}&builder_id=&monthly_installment=&property_type=&price_from=&price_to=&bedrooms=&progress=">
            <div class="loc-div defence-div" style="{{  $fifth_box_location_image  }}">
                <p class="pt-4 ps-4 mb-0 loc-p z-index-9 position-relative">{{ $fifth_box_location_count ?? '0'}} Projects</p>
                <p class="ps-4 mb-0 loc-h z-index-9 position-relative">{{ !empty($fifth_box_location) ? $fifth_box_location : 'Defence'}}</p>
            </div>
        </a>
        </div>
        <div data-aos="fade-up" class="col-6 col-md-6 mb-3 mb-md-0">
            <a href="{{route('search-results')}}?search-area={{ !empty($sixth_box_location) ? $sixth_box_location : 'Kemari'}}&builder_id=&monthly_installment=&property_type=&price_from=&price_to=&bedrooms=&progress=">
            <div class="loc-div kemari-div" style="{{  $sixth_box_location_image  }}">
                <p class="pt-4 ps-4 mb-0 loc-p z-index-9 position-relative">{{ $sixth_box_location_count ?? '0'}} Projects</p>
                <p class="ps-4 mb-0 loc-h z-index-9 position-relative">{{ !empty($sixth_box_location) ? $sixth_box_location : 'Kemari'}}</p>
            </div>
        </a>
        </div>
    </div>
    </div>
</section>