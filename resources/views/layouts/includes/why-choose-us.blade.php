@php
  $why_choose_us_title1 = GeneralHelper::getOption('why_choose_us_title1');
  $why_choose_us_title2 = GeneralHelper::getOption('why_choose_us_title2');
  $why_choose_us_description = GeneralHelper::getOption('why_choose_us_description');
@endphp
<section>
     <div class="container pb-5" style="border-bottom: 1px solid #DCDCEB;">
        <div class="row align-items-center">
           <div data-aos="fade-right" class="col-md-4">
              <h5 class="sub-h">{{$why_choose_us_title1}}</h5>
              <h2 class="main-h">{{$why_choose_us_title2}}</h2>
           </div>
           <div data-aos="fade-left" class="col-md-8">
              <div class="row">
                 {!! $why_choose_us_description !!}
              </div>
           </div>
        </div>
     </div>
  </section>