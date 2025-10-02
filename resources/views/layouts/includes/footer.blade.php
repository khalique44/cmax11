@php
  $contact_phone_number = GeneralHelper::getOption('contact_phone_number');
  $contact_email_address = GeneralHelper::getOption('contact_email_address');        
  $contact_address = GeneralHelper::getOption('contact_address');
  $copy_right_text = GeneralHelper::getOption('copy_right_text');
@endphp

  <section class="footer-sec">
    <div class="container">
        <div class="row">
           <div class="col-md-3">
              <a href="/"><img src="{{ asset('assets/img/footer-logo.png') }}" alt="" width="auto"></a>
              <p class="mt-3 foot-st">Get a Local Expert's Opinion on your Home's Value in Today's Market, for Free</p>
           </div>
           <div class="col-md-3 ps-md-5">
              <h4 class="footer-h">Company</h4>
              <ul class="footer-list">
                 <li class="mb-2"><a href="{{route('ouragents.show')}}">Our Agents</a></li>
                 <li class="mb-2"><a href="{{route('faqs.show')}}">FAQS</a></li>
                 <li class="mb-2"><a href="{{route('aboutus.show')}}">About Us</a></li>
                 <li class="mb-2"><a href="{{route('contactus.show')}}">Contact Us</a></li>
              </ul>
           </div>
           <div class="col-md-3">
              <h4 class="footer-h">Contact</h4>
              <ul class="footer-list">
                 <li class="mb-2"><a href="tel:{{$contact_phone_number}}">{{$contact_phone_number}}</a></li>
                 <li class="mb-2"><a href="mailto:{{$contact_email_address}}">{{$contact_email_address}}</a></li>
                 <li class="mb-2"><a href="#">{{$contact_address}}</a></li>
              </ul>
           </div>
           <div class="col-md-3">
              <h4 class="footer-h">Get The Latest Information</h4>
              <form class="sub-form" id="subscriptionForm">
                  @csrf
                  <input type="email" id="email" name="email" placeholder="Email Address" required>
                  <button type="submit"><i class="fa fa-paper-plane" aria-hidden="true"></i></button>
              </form>

              <div id="subscribe-message" style="margin-top:10px;"></div>

           </div>
        </div>
    </div>
  </section>
  <section class="py-3 footer-bottom">
     <div class="container">
        <div class="row align-item-center pt-3">
           <div class="col-md-6 text-center text-md-start">
              <span class="foot-st">{{ $copy_right_text }}</span>
           </div>
           <div class="col-md-6 text-center text-md-end">
              <a href="{{route('terms_and_conditions.show')}}">Terms & Conditions</a>
              <a href="{{route('privacy_policy.show')}}" class="ms-5">Privacy Policy</a>
           </div>
        </div>
     </div>
  </section>
  <!-- Bootstrap JS -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/js/lightbox.min.js"></script>
  <script src="{{ asset('bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('assets/js/main.js') }}?v={{ time() }}"></script>




