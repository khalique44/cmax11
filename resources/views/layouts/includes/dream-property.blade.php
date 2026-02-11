@php
  $dream_property_title1 = GeneralHelper::getOption('dream_property_title1');
  $dream_property_title2 = GeneralHelper::getOption('dream_property_title2');
  $section_dream_property = GeneralHelper::getOption('section_dream_property');
@endphp
<section class="dream-sec py-5">
   <div class="container py-5 px-3 px-sm-5">
      <div class="row">
         <div class="col-md-12 text-center">
            <h5 class="sub-h">{{ $dream_property_title1 ?? 'Unlock Your' }}</h5>
            <h2 class="main-h">{{ $dream_property_title2 ?? 'Dream Property' }}</h2>
         </div>
      </div>
      <div class="row mt-4">
         {!! $section_dream_property  !!}
      </div>
   </div>
</section>