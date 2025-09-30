@extends('layouts.app')

  
@section('content')


  @include('layouts.includes.nav')
  @include('projects.partials.listing_search_box')
  
  <section class="py-5">
    <div class="container">
      <div class="row">
        <!-- @include('projects.partials.listing_left_sidebar') -->
          <div class="col-md-12">
            <div class="text-left pb-3">
              <div class="breadcrumbs">
               <ol class="breadcrumbs">
                 <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                 <li class="breadcrumb-item active">Projects List</li>
               </ol>
             </div>
             <h2 class="main-h">Projects List</h2>
             <!-- <p>1 to 8 out of 25 projects</p> -->
            </div>
            <div class="row property-listing" id="project-list">
              
             @include('projects.partials.project_list')

            </div>

          
        </div>
      </div>
  </section>


      
      
      
      
  <section class="cta-sec position-relative z-index-9">
     <div class="container py-5 px-3 px-sm-5">
        <h5 data-aos="fade-down" class="sub-h text-center" style="color: #fff;">Lets Get Started</h5>
        <h2 data-aos="fade-down" class="main-h text-center" style="color: #fff;">Property Inquiry Form</h2>
        <div data-aos="fade-up" class="row mt-4">
           <div class="col-md-2"></div>
           <div class="col-md-8">
              <form action="#" method="POST" class="cta-form">
                 <div class="row g-3">
                    <div class="col-md-6">
                       <input type="text" name="name" class="form-control" placeholder="Name" required>
                    </div>
                    <div class="col-md-6">
                       <input type="email" name="email" class="form-control" placeholder="Email" required>
                    </div>
                    <div class="col-md-6">
                       <input type="tel" name="phone" class="form-control" placeholder="+92 -" required>
                    </div>
                    <div class="col-md-6">
                       <input type="text" name="property" class="form-control" placeholder="Property Type">
                    </div>
                    <div class="col-md-6">
                       <input type="text" name="budget" class="form-control" placeholder="Budget Range">
                    </div>
                    <div class="col-md-6">
                       <input type="text" name="location" class="form-control" placeholder="Location Preferences">
                    </div>
                    <div class="col-12">
                       <textarea name="message" class="form-control" rows="4" placeholder="Message"></textarea>
                    </div>
                    <div class="col-12 text-center">
                       <button type="submit" class="btn btn-custom px-4 py-2">SUBMIT NOW</button>
                    </div>
                 </div>
              </form>
           </div>
           <div class="col-md-2"></div>
        </div>
     </div>
  </section>
  
  @include('layouts.includes.footer')     
       
 @endsection