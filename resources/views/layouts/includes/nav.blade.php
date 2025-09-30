@php
  $contact_phone_number = GeneralHelper::getOption('contact_phone_number');
  $contact_email_address = GeneralHelper::getOption('contact_email_address');        
  $contact_address = GeneralHelper::getOption('contact_address');
  $copy_right_text = GeneralHelper::getOption('copy_right_text');
@endphp
<div class="header-top">
   <div class="container">
      <div class="row">
         <div class="col-md-6 text-center text-md-start">
            <span class="pe-3"><a href="tel:{{$contact_phone_number}}"><i class="fa fa-phone" aria-hidden="true"></i> {{$contact_phone_number}}</a></span>
            <span><a href="mailto:{{$contact_email_address}}"><i class="fa fa-envelope" aria-hidden="true"></i> {{$contact_email_address}}</a></span>
         </div>
         <div class="col-md-6 text-center text-md-end">
            <span class="pe-3"><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></span>
            <span class="pe-3"><a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a></span>
            <span class="pe-3"><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></span>
            <span class="pe-3"><a href="#"><i class="fa fa-youtube" aria-hidden="true"></i></a></span>
         </div>
      </div>
   </div>
</div>
<nav class="navbar navbar-expand-lg navbar-light">
   <div class="container">
      <a class="navbar-brand" href="/">
      <img src="{{ asset('assets/img/logo.png') }}" alt="Cmax Logo">
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse justify-content-end" id="navbarNavDropdown">
         <ul class="navbar-nav my-menu">
            <li class="nav-item">
               <a class="nav-link" aria-current="page" href="{{ route('search-results'); }}">Projects</a>
            </li>
            <li class="nav-item">
               <a class="nav-link" href="{{ route('survey'); }}">Survey</a>
            </li>
            <li class="nav-item">
               <a class="nav-link" href="{{ route('aboutus.show'); }}">About Us</a>
            </li>
            <li class="nav-item">
               <a class="nav-link" href="{{ route('career.show'); }}">Careers</a>
            </li>
            <li class="nav-item">
               <a class="nav-link" href="{{ route('blog.list'); }}">Blogs</a>
            </li>
            <li class="nav-item">
               <a class="nav-link" href="{{ route('projects.compare'); }}">Compare</a>
            </li>
            <li class="nav-item">
               <a class="nav-link" href="#">Properties for Sale</a>
            </li>
            <li class="nav-item">
               <a class="nav-link menu-btn" href="{{ route('contactus.show'); }}">Contact Us</a>
            </li>
         </ul>
      </div>
   </div>
</nav>   