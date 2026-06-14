@extends('layouts.app')

  
@section('content')


  @include('layouts.includes.nav')
  @include('properties.partials.listing_search_box')
  
  <section class="py-5">
    <div class="container">
      <div class="row">
        <!-- @include('properties.partials.listing_left_sidebar') -->
          <div class="col-md-12">
            <div class="text-left pb-3">
              <div class="breadcrumbs">
               <ol class="breadcrumbs">
                 <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                 <li class="breadcrumb-item active">Properties List</li>
               </ol>
             </div>
             <h2 class="main-h">Properties List</h2>
             <!-- <p>1 to 8 out of 25 Properties</p> -->
            </div>
            <div class="row project-listing" id="project-list">
              
             @include('properties.partials.property_list')

            </div>

          
        </div>
      </div>
  </section>
    
      
  @include('layouts.includes.inquiry-form')
  
  @include('layouts.includes.footer')     
       
 @endsection