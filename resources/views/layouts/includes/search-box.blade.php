<section class="my-banner">
     <div class="container">
        <div class="row">
           <div data-aos="fade-in" class="col-lg-12">
              <div class="first-heading mb-5">
                 <h2 class="first-h">Karachi</h2>
                 <h2 class="second-h mb-3 ms-2">Buy, Sell, <span style="color: #dd1c2f; font-family: 'PassengerDisplayExtraBold';">Rent</span> & <span style="color: #dd1c2f; font-family: 'PassengerDisplayExtraBold';">Invest</span></h2>
              </div>
              <!-- <p class="pe-lg-5 me-lg-5 sub-text">We provide a complete service for the sale, purchase or rental pf real estate.</p> -->
           </div>
           <div class="col-lg-6"></div>
        </div>
        <div data-aos="fade-in" class="row d-none d-md-block">
           <div class="col-lg-11">
              <ul class="nav nav-tabs form-tab" id="myTab" role="tablist">
                 <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">New Project</button>
                 </li>
                 <li class="nav-item" role="presentation">
                    <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">Under Construction Project</button>
                 </li>
                 <li class="nav-item" role="presentation">
                    <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact" type="button" role="tab" aria-controls="contact" aria-selected="false">Search Project</button>
                 </li>
              </ul>
              <div class="tab-content" id="myTabContent">
                 <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                    <form class="banner-form" action="{{route('search-results')}}">
                       <div class="row g-2">
                          <div class="col-md-11">
                             <div class="row">
                                <div class="col-md-2">
                                   <label class="form-label">City</label>
                                   <input type="text" class="form-control font-size-12"  id="city_id" name="city_id" placeholder="Search in City" value="Karachi" readonly="" disabled="">
                                   

                                </div>
                                <div class="col-md-4">
                                   <label class="form-label">Area</label>
                                   <input type="text" class="form-control font-size-12" value="" id="search-area" name="search-area" placeholder="Search Area">
                                   <div id="suggestions" style="border:1px solid #ddd; display:none; position:absolute; background:#fff; z-index:999;"></div>

                                </div>
                                <div class="col-md-3">
                                   <label class="form-label">Select Builder</label>
                                   <select class="form-select select2" name="builder_id">1
                                      <option value="" selected >Select</option>
                                      <@foreach($builders as $builder)
                                          <option value="{{ $builder->id }}">{{ ucfirst($builder->builder_name) }}</option>
                                      @endforeach
                                   </select>
                                </div>
                                <div class="col-md-3">
                                  <label class="form-label">Monthly Installment</label>
                                  <select class="form-select select2" name="monthly_installment" id="monthly_installment">
                                    <option value="">Select</option>
                                    <option value="50000:100000" >50,000 ~ 100,000</option>
                                    <option value="100000:150000" >100,000 ~ 150,000</option>
                                    <option value="150000:200000" >150,000 ~ 200,000</option>
                                    <option value="200000:250000" >200,000 ~ 250,000</option>
                                    <option value="250000:300000" >250,000 ~ 300,000</option>
                                    <option value="300000:350000" >300,000 ~ 350,000</option>
                                    <option value="350000:400000" >350,000 ~ 400,000</option>
                                    <option value="400000:450000" >400,000 ~ 450,000</option>
                                    <option value="450000:500000" >450,000 ~ 500,000</option>
                                    <option value="500000:550000" >500,000 ~ 550,000</option>
                                    <option value="550000:600000" >550,000 ~ 600,000</option>
                                    <option value="600000:650000" >600,000 ~ 650,000</option>
                                    <option value="650000:700000" >650,000 ~ 700,000</option>
                                    <option value="700000:750000" >700,000 ~ 750,000</option>
                                    <option value="700000:750000" >750,000 ~ 800,000</option>
                                    <option value="800000:850000" >800,000 ~ 850,000</option>
                                    <option value="850000:900000" >850,000 ~ 900,000</option>
                                    <option value="900000:950000" >900,000 ~ 950,000</option>
                                    <option value="950000:1000000" >950,000 ~ 1,000,000</option>
                            
                                  </select>
                                  
                               </div>
                                
                             </div>
                          </div>
                          <div class="col-md-1 text-end pt-2">
                                <button type="submit" class="btn btn-primary mt-3"><i class="fa fa-search" aria-hidden="true"></i></button>
                          </div>
                          
                          <div class="collapse" id="collapseExample">
                             <div class="card card-body my-cutom-card-body">
                                <div class="row">
                                   <div class="col-md-11">
                                      <div class="row">
                                         <div class="col-md-3">
                                            <label class="form-label">Property Type</label>
                                            <select class="form-select select2" name="property_type" style="width: 100%;">
                                              <option value="" >Select</option>
                                              @foreach($offering as $type)
                                                <option value="{{ $type }}" >{{ ucfirst($type) }}</option>
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
                                                        <option value="">0</option>
                                                        <option value="500000">500,000</option>
                                                        <option value="1000000">1,000,000</option>
                                                        <option value="2000000">2,000,000</option>
                                                        <option value="3500000">3,500,000</option>
                                                        <option value="5000000">5,000,000</option>
                                                        <option value="6500000">6,500,000</option>
                                                        <option value="8000000">8,000,000</option>
                                                        <option value="10000000">10,000,000</option>
                                                        <option value="12500000">12,500,000</option>
                                                        <option value="15000000">15,000,000</option>
                                                        <option value="17500000">17,500,000</option>
                                                        <option value="20000000">20,000,000</option>
                                                        <option value="25000000">25,000,000</option>
                                                        <option value="30000000">30,000,000</option>
                                                        <option value="40000000">40,000,000</option>
                                                        <option value="50000000">50,000,000</option>
                                                        <option value="75000000">75,000,000</option>
                                                        <option value="100000000">100,000,000</option>
                                                        <option value="250000000">250,000,000</option>
                                                        <option value="500000000">500,000,000</option>
                                                        <option value="1000000000">1,000,000,000</option>
                                                      </select>
                                                    </div>
                                                    <div class="col-md-6">
                                                      <label class="form-label">Max</label>
                                                      
                                                      <select class="form-select select2" name="price_to" id="maxPrice" style="width: 100%;">
                                                        <option value="">Any</option>
                                                        <option value="500000">500,000</option>
                                                        <option value="1000000">1,000,000</option>
                                                        <option value="2000000">2,000,000</option>
                                                        <option value="3500000">3,500,000</option>
                                                        <option value="5000000">5,000,000</option>
                                                        <option value="6500000">6,500,000</option>
                                                        <option value="8000000">8,000,000</option>
                                                        <option value="10000000">10,000,000</option>
                                                        <option value="12500000">12,500,000</option>
                                                        <option value="15000000">15,000,000</option>
                                                        <option value="17500000">17,500,000</option>
                                                        <option value="20000000">20,000,000</option>
                                                        <option value="25000000">25,000,000</option>
                                                        <option value="30000000">30,000,000</option>
                                                        <option value="40000000">40,000,000</option>
                                                        <option value="50000000">50,000,000</option>
                                                        <option value="75000000">75,000,000</option>
                                                        <option value="100000000">100,000,000</option>
                                                        <option value="250000000">250,000,000</option>
                                                        <option value="500000000">500,000,000</option>
                                                        <option value="1000000000">1,000,000,000</option>
                                                        <option value="5000000000">5,000,000,000</option>
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
                                                <option value="{{ $bedroom }}" >{{ ($bedroom) }}</option>
                                              @endforeach
                                            </select>
                                         </div>
                                         <div class="col-md-3">
                                            <label class="form-label" >Progress</label>

                                            <select class="form-select select2" name="progress" style="width: 100%;">
                                              <option value="" selected>Select</option>
                                              @foreach($progress as $key => $prog)
                                                <option value="{{ $key }}" >{{ ucfirst($prog) }}</option>
                                              @endforeach
                                            </select>
                                        </div>
                                      </div>
                                   </div>
                                </div>
                             </div>
                          </div>
                          
                       </div>
                    </form>
                    <div class="row">
                       <a class="my-cutom-card-btn" data-bs-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                       + Advanced Search
                       </a>
                    </div>
                 </div>
                 <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                    <form class="banner-form">
                       <div class="row g-2">
                          <div class="col-md-3">
                             <label class="form-label">Area</label>
                             <input type="text" class="form-control" value="Clifton Block 1" readonly>
                          </div>
                          <div class="col-md-3">
                             <label class="form-label">Select Builder</label>
                             <select class="form-select">
                                <option selected>Builder</option>
                             </select>
                          </div>
                          <div class="col-md-3">
                             <label class="form-label">Monthly Instalment</label>
                             <select class="form-select">
                                <option selected>Select</option>
                             </select>
                          </div>
                          <div class="col-md-3">
                             <label class="form-label">Progress</label>
                             <input type="text" class="form-control" value="Progress" readonly>
                          </div>
                          <div class="col-md-3">
                             <label class="form-label">Property Type</label>
                             <select class="form-select">
                                <option selected>Select</option>
                             </select>
                          </div>
                          <div class="col-md-3">
                             <label class="form-label">Price Range</label>
                             <select class="form-select">
                                <option selected>Select</option>
                             </select>
                          </div>
                          <div class="col-md-3">
                             <label class="form-label">Bed</label>
                             <select class="form-select">
                                <option selected>Select</option>
                             </select>
                          </div>
                          <div class="col-md-3">
                             <label class="form-label">Project Completion</label>
                             <select class="form-select">
                                <option selected>Select</option>
                             </select>
                          </div>
                          <div class="collapse" id="collapseExample">
                             <div class="card card-body my-cutom-card-body">
                                <div class="row">
                                   <div class="col-md-3">
                                      <label class="form-label">Project Completion</label>
                                      <select class="form-select">
                                         <option selected>Select</option>
                                      </select>
                                   </div>
                                   <div class="col-md-3">
                                      <label class="form-label">Project Completion</label>
                                      <select class="form-select">
                                         <option selected>Select</option>
                                      </select>
                                   </div>
                                   <div class="col-md-3">
                                      <label class="form-label">Project Completion</label>
                                      <select class="form-select">
                                         <option selected>Select</option>
                                      </select>
                                   </div>
                                </div>
                             </div>
                          </div>
                          <div class="col-md-12 text-end">
                             <button type="submit" class="btn btn-primary mt-3"><i class="fa fa-search" aria-hidden="true"></i></button>
                          </div>
                       </div>
                    </form>
                    <div class="row">
                       <a class="my-cutom-card-btn" data-bs-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                       + Advanced Search
                       </a>
                    </div>
                 </div>
                 <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                    <form class="banner-form">
                       <div class="row g-2">
                          <div class="col-md-3">
                             <label class="form-label">Area</label>
                             <input type="text" class="form-control" value="Clifton Block 1" readonly>
                          </div>
                          <div class="col-md-3">
                             <label class="form-label">Select Builder</label>
                             <select class="form-select">
                                <option selected>Builder</option>
                             </select>
                          </div>
                          <div class="col-md-3">
                             <label class="form-label">Monthly Instalment</label>
                             <select class="form-select">
                                <option selected>Select</option>
                             </select>
                          </div>
                          <div class="col-md-3">
                             <label class="form-label">Progress</label>
                             <input type="text" class="form-control" value="Progress" readonly>
                          </div>
                          <div class="col-md-3">
                             <label class="form-label">Property Type</label>
                             <select class="form-select">
                                <option selected>Select</option>
                             </select>
                          </div>
                          <div class="col-md-3">
                             <label class="form-label">Price Range</label>
                             <select class="form-select">
                                <option selected>Select</option>
                             </select>
                          </div>
                          <div class="col-md-3">
                             <label class="form-label">Bed</label>
                             <select class="form-select">
                                <option selected>Select</option>
                             </select>
                          </div>
                          <div class="col-md-3">
                             <label class="form-label">Project Completion</label>
                             <select class="form-select">
                                <option selected>Select</option>
                             </select>
                          </div>
                          <div class="collapse" id="collapseExample">
                             <div class="card card-body my-cutom-card-body">
                                <div class="row">
                                   <div class="col-md-3">
                                      <label class="form-label">Project Completion</label>
                                      <select class="form-select">
                                         <option selected>Select</option>
                                      </select>
                                   </div>
                                   <div class="col-md-3">
                                      <label class="form-label">Project Completion</label>
                                      <select class="form-select">
                                         <option selected>Select</option>
                                      </select>
                                   </div>
                                   <div class="col-md-3">
                                      <label class="form-label">Project Completion</label>
                                      <select class="form-select">
                                         <option selected>Select</option>
                                      </select>
                                   </div>
                                </div>
                             </div>
                          </div>
                          <div class="col-md-12 text-end">
                             <button type="submit" class="btn btn-primary mt-3"><i class="fa fa-search" aria-hidden="true" title="Search"></i></button>
                          </div>
                       </div>
                    </form>
                    <div class="row">
                       <a class="my-cutom-card-btn" data-bs-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                       + Advanced Search
                       </a>
                    </div>
                 </div>
              </div>
           </div>
           <div class="col-lg-1"></div>
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