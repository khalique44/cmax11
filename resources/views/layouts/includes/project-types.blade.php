@php
  $first_box_offer = GeneralHelper::getOption('first_box_offer');
  $first_box_offer_image = GeneralHelper::getOption('first_box_offer_image');        
  $second_box_offer = GeneralHelper::getOption('second_box_offer');
  $second_box_offer_image = GeneralHelper::getOption('second_box_offer_image');
  $third_box_offer = GeneralHelper::getOption('third_box_offer');
  $third_box_offer_image = GeneralHelper::getOption('third_box_offer_image');
  $fourth_box_offer = GeneralHelper::getOption('fourth_box_offer');
  $fourth_box_offer_image = GeneralHelper::getOption('fourth_box_offer_image');

  $first_box_offer_image = $first_box_offer_image ? 'background-image:url('.asset($first_box_offer_image).')' : "";
  $second_box_offer_image = $second_box_offer_image ? "background-image:url(".asset($second_box_offer_image).")" : "";
  $third_box_offer_image = $third_box_offer_image ? "background-image:url(".asset($third_box_offer_image).")" : "";
  $fourth_box_offer_image = $fourth_box_offer_image ? "background-image:url(".asset($fourth_box_offer_image).")" : "";
@endphp

<section class="py-5">
   <div class="container">
      <div class="row text-center pb-3">
         <h5 class="sub-h">Project Types</h5>
         <h2 class="main-h">Explore Project Types</h2>
      </div>
      <div class="row">
         <div data-aos="fade-up" class="col-6 col-md-6 col-lg-3 mb-3 mb-md-0">
            <a href="{{route('search-results')}}?search-area=&builder_id=&monthly_installment=&property_type={{ !empty($first_box_offer) ? $first_box_offer : 'Apartment'}}&price_from=&price_to=&bedrooms=&progress=">
            <div class="property-div text-center" style="{{  $first_box_offer_image  }}">
               <p class="pt-4 mb-0 ap-h">{{ !empty($first_box_offer) ? $first_box_offer : 'Apartment'}}</p>
               <p class="mb-0 ap-p">{{ $first_box_offer_count ?? '0'}} Properties</p>
            </div>
            </a>
         </div>
         <div data-aos="fade-up" class="col-6 col-md-6 col-lg-3 mb-3 mb-md-0">
            <a href="{{route('search-results')}}?search-area=&builder_id=&monthly_installment=&property_type={{ !empty($second_box_offer) ? $second_box_offer : 'Villas'}}&price_from=&price_to=&bedrooms=&progress=">
            <div class="property-div text-center villas-div" style="{{  $second_box_offer_image  }}">
               <p class="pt-4 mb-0 ap-h">{{ !empty($second_box_offer) ? $second_box_offer : 'Villas'}}</p>
               <p class="mb-0 ap-p">{{ $second_box_offer_count ?? '0'}} Properties</p>
            </div>
         </a>
         </div>
         <div data-aos="fade-up" class="col-6 col-md-6 col-lg-3 mb-3 mb-md-0 mt-md-4 mt-lg-0">
            <a href="{{route('search-results')}}?search-area=&builder_id=&monthly_installment=&property_type={{ !empty($third_box_offer) ? $third_box_offer : 'Offices'}}&price_from=&price_to=&bedrooms=&progress=">
            <div class="property-div text-center offices-div" style="{{  $third_box_offer_image  }}">
               <p class="pt-4 mb-0 ap-h">{{ !empty($third_box_offer) ? $third_box_offer : 'Offices'}}</p>
               <p class="mb-0 ap-p">{{ $third_box_offer_count ?? '0'}} Properties</p>
            </div>
         </a>
         </div>
         <div data-aos="fade-up" class="col-6 col-md-6 col-lg-3 mt-md-4 mt-lg-0">
            <a href="{{route('search-results')}}?search-area=&builder_id=&monthly_installment=&property_type={{ !empty($fourth_box_offer) ? $fourth_box_offer : 'Shops'}}&price_from=&price_to=&bedrooms=&progress=">
            <div class="property-div text-center shops-div" style="{{  $fourth_box_offer_image  }}">
               <p class="pt-4 mb-0 ap-h">{{ !empty($fourth_box_offer) ? $fourth_box_offer : 'Shops'}}</p>
               <p class="mb-0 ap-p">{{ $fourth_box_offer_count ?? '0'}} Properties</p>
            </div>
         </a>
         </div>
      </div>
   </div>
</section>