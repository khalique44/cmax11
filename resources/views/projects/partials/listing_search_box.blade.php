<section class="inner-banner">
   <div class="container">
      <div data-aos="fade-in" class="row d-none d-md-block">
          <form class="banner-form">
              <div class="row g-2">
                 <div class="col-md-12">
                    <div class="row">
                      <div class="col-md-2">
                           <label class="form-label">City</label>
                           <input type="text" class="form-control font-size-12"  id="city_id" name="city_id" placeholder="Search in City" value="Karachi" readonly="" disabled="">
                           

                      </div>
                       <div class="col-md-4">
                          <label class="form-label">Area</label>
                          <input type="text" class="form-control" id="search-area" name="search-area" placeholder="Search Area" value="{{ $searchedData && isset($searchedData['search-area']) ? $searchedData['search-area'] : '' }}" >
                          <div id="suggestions" style="border:1px solid #ddd; display:none; position:absolute; background:#fff; z-index:999;"></div>
                       </div>
                       <div class="col-md-3">

                          <label class="form-label">Select Builder</label>
                          <select class="form-select select2" name="builder_id">1
                            <option value="" selected >Select</option>
                            <@foreach($builders as $builder)
                              <option value="{{ $builder->id }}" {{ $searchedData && isset($searchedData['builder_id']) ==  $builder->id ? 'selected' : '' }}>{{ ucfirst($builder->builder_name) }}</option>
                            @endforeach
                           </select>
                       </div>
                       <div class="col-md-3">
                          <label class="form-label">Monthly Installment</label>
                            <select class="form-select select2" name="monthly_installment" id="monthly_installment">
                              <option value="">Select</option>
                              <option value="50000:100000" {{ $searchedData && $searchedData['monthly_installment'] ==  '50000:100000' ? 'selected' : '' }}>50,000 ~ 100,000</option>
                              <option value="100000:150000" {{ $searchedData && $searchedData['monthly_installment'] ==  '100000:150000' ? 'selected' : '' }}>100,000 ~ 150,000</option>
                              <option value="150000:200000" {{ $searchedData && $searchedData['monthly_installment'] ==  '150000:200000' ? 'selected' : '' }}>150,000 ~ 200,000</option>
                              <option value="200000:250000" {{ $searchedData && $searchedData['monthly_installment'] ==  '200000:250000' ? 'selected' : '' }}>200,000 ~ 250,000</option>
                              <option value="250000:300000" {{ $searchedData && $searchedData['monthly_installment'] ==  '250000:300000' ? 'selected' : '' }}>250,000 ~ 300,000</option>
                              <option value="300000:350000" {{ $searchedData && $searchedData['monthly_installment'] ==  '300000:350000' ? 'selected' : '' }}>300,000 ~ 350,000</option>
                              <option value="350000:400000" {{ $searchedData && $searchedData['monthly_installment'] ==  '350000:400000' ? 'selected' : '' }}>350,000 ~ 400,000</option>
                              <option value="400000:450000" {{ $searchedData && $searchedData['monthly_installment'] ==  '400000:450000' ? 'selected' : '' }}>400,000 ~ 450,000</option>
                              <option value="450000:500000" {{ $searchedData && $searchedData['monthly_installment'] ==  '450000:500000' ? 'selected' : '' }}>450,000 ~ 500,000</option>
                              <option value="500000:550000" {{ $searchedData && $searchedData['monthly_installment'] ==  '500000:550000' ? 'selected' : '' }}>500,000 ~ 550,000</option>
                              <option value="550000:600000" {{ $searchedData && $searchedData['monthly_installment'] ==  '550000:600000' ? 'selected' : '' }}>550,000 ~ 600,000</option>
                              <option value="600000:650000" {{ $searchedData && $searchedData['monthly_installment'] ==  '600000:650000' ? 'selected' : '' }}>600,000 ~ 650,000</option>
                              <option value="650000:700000" {{ $searchedData && $searchedData['monthly_installment'] ==  '650000:700000' ? 'selected' : '' }}>650,000 ~ 700,000</option>
                              <option value="700000:750000" {{ $searchedData && $searchedData['monthly_installment'] ==  '700000:750000' ? 'selected' : '' }}>700,000 ~ 750,000</option>
                              <option value="700000:750000" {{ $searchedData && $searchedData['monthly_installment'] ==  '700000:750000' ? 'selected' : '' }}>750,000 ~ 800,000</option>
                              <option value="800000:850000" {{ $searchedData && $searchedData['monthly_installment'] ==  '800000:850000' ? 'selected' : '' }}>800,000 ~ 850,000</option>
                              <option value="850000:900000" {{ $searchedData && $searchedData['monthly_installment'] ==  '850000:900000' ? 'selected' : '' }}>850,000 ~ 900,000</option>
                              <option value="900000:950000" {{ $searchedData && $searchedData['monthly_installment'] ==  '900000:950000' ? 'selected' : '' }}>900,000 ~ 950,000</option>
                              <option value="950000:1000000" {{ $searchedData && $searchedData['monthly_installment'] ==  '950000:1000000' ? 'selected' : '' }}>950,000 ~ 1,000,000</option>
                              
                            </select>
                          
                       </div>
                       
                       <div class="col-md-3">
                          <label class="form-label">Property Type</label>
                          <select class="form-select select2" name="property_type" style="width: 100%;">
                            <option value="" >Select</option>
                            @foreach($offering as $type)
                              <option value="{{ $type }}" {{ $searchedData && $searchedData['property_type'] ==  $type ? 'selected' : '' }}>{{ ucfirst($type) }}</option>
                              @endforeach
                          </select>
                       </div>
                       <div class="col-md-3">
                          <label class="form-label">Price Range</label>
                          <div class="dropdown-price-range">
                            <div class="dropdown-price-range-toggle">Select Price Range</div>
                            <div class="dropdown-price-range-menu">
                                
                                <div class="row" >
                                  <span id="priceError" class="text-danger"></span>
                                  <div class="col-md-6">
                                    <label class="form-label">Min</label>
                                    
                                    <select class="form-select select2" name="price_from" id="minPrice" style="width: 100%;">
                                      <option value="" {{ $searchedData && $searchedData['price_from'] ==  '' ? 'selected' : '' }}>0</option>
                                      <option value="500000" {{ $searchedData && $searchedData['price_from'] ==  '500000' ? 'selected' : '' }}>500,000</option>
                                      <option value="1000000"  {{ $searchedData && $searchedData['price_from'] ==  '1000000' ? 'selected' : '' }}>1,000,000</option>
                                      <option value="2000000"  {{ $searchedData && $searchedData['price_from'] ==  '2000000' ? 'selected' : '' }}>2,000,000</option>
                                      <option value="3500000"  {{ $searchedData && $searchedData['price_from'] ==  '3500000' ? 'selected' : '' }}>3,500,000</option>
                                      <option value="5000000"  {{ $searchedData && $searchedData['price_from'] ==  '5000000' ? 'selected' : '' }}>5,000,000</option>
                                      <option value="6500000"  {{ $searchedData && $searchedData['price_from'] ==  '6500000' ? 'selected' : '' }}>6,500,000</option>
                                      <option value="8000000"  {{ $searchedData && $searchedData['price_from'] ==  '8000000' ? 'selected' : '' }}>8,000,000</option>
                                      <option value="10000000"  {{ $searchedData && $searchedData['price_from'] ==  '10000000' ? 'selected' : '' }}>10,000,000</option>
                                      <option value="12500000"  {{ $searchedData && $searchedData['price_from'] ==  '12500000' ? 'selected' : '' }}>12,500,000</option>
                                      <option value="15000000"  {{ $searchedData && $searchedData['price_from'] ==  '15000000' ? 'selected' : '' }}>15,000,000</option>
                                      <option value="17500000"  {{ $searchedData && $searchedData['price_from'] ==  '17500000' ? 'selected' : '' }}>17,500,000</option>
                                      <option value="20000000"  {{ $searchedData && $searchedData['price_from'] ==  '20000000' ? 'selected' : '' }}>20,000,000</option>
                                      <option value="25000000"  {{ $searchedData && $searchedData['price_from'] ==  '25000000' ? 'selected' : '' }}>25,000,000</option>
                                      <option value="30000000"  {{ $searchedData && $searchedData['price_from'] ==  '30000000' ? 'selected' : '' }}>30,000,000</option>
                                      <option value="40000000"  {{ $searchedData && $searchedData['price_from'] ==  '40000000' ? 'selected' : '' }}>40,000,000</option>
                                      <option value="50000000"  {{ $searchedData && $searchedData['price_from'] ==  '50000000' ? 'selected' : '' }}>50,000,000</option>
                                      <option value="75000000"  {{ $searchedData && $searchedData['price_from'] ==  '75000000' ? 'selected' : '' }}>75,000,000</option>
                                      <option value="100000000"  {{ $searchedData && $searchedData['price_from'] ==  '100000000' ? 'selected' : '' }}>100,000,000</option>
                                      <option value="250000000"  {{ $searchedData && $searchedData['price_from'] ==  '250000000' ? 'selected' : '' }}>250,000,000</option>
                                      <option value="500000000"  {{ $searchedData && $searchedData['price_from'] ==  '500000000' ? 'selected' : '' }}>500,000,000</option>
                                      <option value="1000000000"  {{ $searchedData && $searchedData['price_from'] ==  '1000000000' ? 'selected' : '' }}>1,000,000,000</option>
                                    </select>
                                  </div>
                                  <div class="col-md-6">
                                    <label class="form-label">Max</label>
                                    
                                    <select class="form-select select2" name="price_to" id="maxPrice" style="width: 100%;">
                                      <option value="" {{ $searchedData && $searchedData['price_from'] ==  '' ? 'selected' : '' }}>Any</option>
                                      <option value="500000" {{ $searchedData && $searchedData['price_to'] ==  '500000' ? 'selected' : '' }}>500,000</option>
                                      <option value="1000000" {{ $searchedData && $searchedData['price_to'] ==  '1000000' ? 'selected' : '' }}>1,000,000</option>
                                      <option value="2000000" {{ $searchedData && $searchedData['price_to'] ==  '2000000' ? 'selected' : '' }}>2,000,000</option>
                                      <option value="3500000" {{ $searchedData && $searchedData['price_to'] ==  '3500000' ? 'selected' : '' }}>3,500,000</option>
                                      <option value="5000000" {{ $searchedData && $searchedData['price_to'] ==  '5000000' ? 'selected' : '' }}>5,000,000</option>
                                      <option value="6500000" {{ $searchedData && $searchedData['price_to'] ==  '6500000' ? 'selected' : '' }}>6,500,000</option>
                                      <option value="8000000" {{ $searchedData && $searchedData['price_to'] ==  '8000000' ? 'selected' : '' }}>8,000,000</option>
                                      <option value="10000000" {{ $searchedData && $searchedData['price_to'] ==  '10000000' ? 'selected' : '' }}>10,000,000</option>
                                      <option value="12500000" {{ $searchedData && $searchedData['price_to'] ==  '12500000' ? 'selected' : '' }}>12,500,000</option>
                                      <option value="15000000" {{ $searchedData && $searchedData['price_to'] ==  '15000000' ? 'selected' : '' }}>15,000,000</option>
                                      <option value="17500000" {{ $searchedData && $searchedData['price_to'] ==  '17500000' ? 'selected' : '' }}>17,500,000</option>
                                      <option value="20000000" {{ $searchedData && $searchedData['price_to'] ==  '20000000' ? 'selected' : '' }}>20,000,000</option>
                                      <option value="25000000" {{ $searchedData && $searchedData['price_to'] ==  '25000000' ? 'selected' : '' }}>25,000,000</option>
                                      <option value="30000000" {{ $searchedData && $searchedData['price_to'] ==  '30000000' ? 'selected' : '' }}>30,000,000</option>
                                      <option value="40000000" {{ $searchedData && $searchedData['price_to'] ==  '40000000' ? 'selected' : '' }}>40,000,000</option>
                                      <option value="50000000" {{ $searchedData && $searchedData['price_to'] ==  '50000000' ? 'selected' : '' }}>50,000,000</option>
                                      <option value="75000000" {{ $searchedData && $searchedData['price_to'] ==  '75000000' ? 'selected' : '' }}>75,000,000</option>
                                      <option value="100000000" {{ $searchedData && $searchedData['price_to'] ==  '100000000' ? 'selected' : '' }}>100,000,000</option>
                                      <option value="250000000" {{ $searchedData && $searchedData['price_to'] ==  '250000000' ? 'selected' : '' }}>250,000,000</option>
                                      <option value="500000000" {{ $searchedData && $searchedData['price_to'] ==  '500000000' ? 'selected' : '' }}>500,000,000</option>
                                      <option value="1000000000" {{ $searchedData && $searchedData['price_to'] ==  '1000000000' ? 'selected' : '' }}>1,000,000,000</option>
                                      <option value="5000000000" {{ $searchedData && $searchedData['price_to'] ==  '5000000000' ? 'selected' : '' }}>5,000,000,000</option>
                                    </select>
                                  </div>
                                </div>
                            </div>
                          </div>
                       </div>
                       <div class="col-md-3">
                          <label class="form-label">Bed</label>
                          <select class="form-select select2" name="bedrooms" style="width: 100%;">
                            <option value="">Select</option>
                            @foreach($bedrooms as $bedroom)
                              <option value="{{ $bedroom }}" {{ $searchedData && $searchedData['price_to'] ==  $bedroom ? 'selected' : '' }} >{{ ($bedroom) }}</option>
                            @endforeach
                          </select>
                       </div>
                       <div class="col-md-3">
                          <label class="form-label">Progress</label>
                          <select class="form-select select2" name="progress">
                            <option value="" selected>Select</option>
                            @foreach($progress as $key => $prog)
                              <option value="{{ $key }}" {{ $searchedData && $searchedData['progress'] ==  $key ? 'selected' : '' }}>{{ ucfirst($prog) }}</option>
                            @endforeach
                          </select>
                       </div>
                       <div class="col-md-12 text-center">
                         <button type="submit" class="btn btn-primary mt-3 w-25" title="Search"><i class="fa fa-search" aria-hidden="true"></i></button>
                       </div>
                    </div>
                 </div>
              </div>
           </form>
      </div>

      <div class="d-block d-md-none">
         <ul class="banner-buttons">
            <li><a href="#" data-bs-toggle="offcanvas" data-bs-target="#leftPopup" aria-controls="leftPopup">New</a></li>
            <li><a href="#" data-bs-toggle="offcanvas" data-bs-target="#leftPopup" aria-controls="leftPopup">Construction</a></li>
            <li><a href="#" data-bs-toggle="offcanvas" data-bs-target="#leftPopup" aria-controls="leftPopup">Search</a></li>
         </ul>
      </div>

      <div class="offcanvas offcanvas-end" tabindex="-1" id="leftPopup" aria-labelledby="leftPopupLabel">
         <div class="offcanvas-header">
            <h5>Filters</h5>
           <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
         </div>
         <div class="offcanvas-body">
            <div class="row">
               <div class="col-md-3 mt-3">
                  <label class="form-label">Progress</label>
                  <select class="form-select">
                     <option selected>Under construction </option>
                     <option selected>New Launch </option>
                     <option selected>Ready or Near to posession</option>
                  </select>
               </div>
               <div class="col-md-3">
                  <label class="form-label">City</label>
                  <input type="text" class="form-control" value="Karachi" readonly>
               </div>
               <div class="col-md-3 mt-3">
                  <label class="form-label">Location</label>
                  <select class="form-select">
                     <option selected>Select</option>
                  </select>
               </div>
               <div class="col-md-3 mt-3">
                  <label class="form-label">Property type </label>
                  <select class="form-select">
                     <option selected>Homes</option>
                     <option selected>Plots</option>
                     <option selected>Commercial </option>
                     <option selected>House </option>
                     <option selected>Residential plot </option>
                     <option selected>Office </option>
                     <option selected>Flat </option>
                     <option selected>Commercial plot </option>
                     <option selected>Warehouse</option>
                     <option selected>Building </option>
                     <option selected>Shop </option>
                  </select>
               </div>
               <div class="col-md-3 mt-3">
                  <label class="form-label">Bedrooms</label>
                  <select class="form-select">
                     <option selected>Select</option>
                     <option selected>1</option>
                     <option selected>3</option>
                  </select>
               </div>
               <div class="col-md-3 mt-3">
                  <label class="form-label">Bathrooms</label>
                  <select class="form-select">
                     <option selected>Select</option>
                     <option selected>Plot</option>
                     <option selected>appartment</option>
                  </select>
               </div>
               
            </div>

            <button class="find-btn w-100 mt-5">Find</button>
         </div>
       </div>
   </div>
</section>