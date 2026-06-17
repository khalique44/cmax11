@extends('layouts.admin')

@section('content')
    <div class="right-side-section">
        <div class="right-section-content">
            <div class="admin-sec-btn-area">
                <div class="report-title-section">
                    <h4>Welcome Admin</h4>
                </div>
                
            </div>
           
            @include('layouts.partials.messages')

            
            <div class="row">
                <div class="container-fluid py-4">
                    <h2 class="mb-4">Project Analytics Overview</h2>

                    <div class="row g-3 mb-5">
                        <div class="col-md-3">
                            <div class="card border-0 shadow-sm text-center p-3">
                                <div class="text-muted small fw-bold text-uppercase">Total Project Views</div>
                                <div class="h3 mb-0">{{ \Illuminate\Support\Number::abbreviate($totalViews ?? 0) }}</div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card border-0 shadow-sm text-center p-3">
                                <div class="text-muted small fw-bold text-uppercase">Total Clicks</div>
                                <div class="h3 mb-0">{{ \Illuminate\Support\Number::abbreviate($totalLeadClicks ?? 0) }}</div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card border-0 shadow-sm text-center p-3">
                                <div class="text-muted small fw-bold text-uppercase">Popular</div>
                                <div class="h3 mb-0 text-primary">{{ \Illuminate\Support\Number::abbreviate($popularProjects ?? 0) }}</div>
                            </div>
                        </div>        
                        
                        <div class="col-md-3">
                            <div class="card border-0 shadow-sm text-center p-3">
                                <div class="text-muted small fw-bold text-uppercase">Featured</div>
                                <div class="h3 mb-0 text-success">{{ \Illuminate\Support\Number::abbreviate($featuredProjects ?? 0) }}</div>
                            </div>
                        </div>
                    </div>

                    <div class="row g-3">
                        <div class="col-lg-7">
                            <div class="card border-0 shadow-sm p-4">
                                <h5 class="mb-3">Project Progress Status</h5>
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <span class="badge bg-info text-white px-3 py-2">Pre-Launch: {{ $preLaunch ?? 0 }}</span>
                                    </div>
                                    <div>
                                        <span class="badge bg-danger text-white px-3 py-2">Under Construction: {{ $underConstruction ?? 0 }}</span>
                                    </div>
                                    <div>
                                        <span class="badge bg-success-subtle text-success px-3 py-2">Ready: {{ $readyToMove ?? 0 }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-5">
                            <div class="card border-0 shadow-sm p-4 text-white bg-dark">
                                <h5 class="mb-3">Projects Activity</h5>
                                <div class="row">
                                    <div class="col-6 border-end border-secondary">
                                        <div class="small opacity-75">Active</div>
                                        <div class="h4 mb-0 text-success">{{ $activeListings ?? 0 }}</div>
                                    </div>
                                    <div class="col-6 ps-4">
                                        <div class="small opacity-75">Inactive</div>
                                        <div class="h4 mb-0 text-secondary">{{ $inactiveListings ?? 0 }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>      
            
            
            <div class="row">
                <div class="container-fluid py-4">
                    <h2 class="mb-4">Property Analytics Overview</h2>

                    <div class="row g-3 mb-5">
                        <div class="col-md-3">
                            <div class="card border-0 shadow-sm text-center p-3">
                                <div class="text-muted small fw-bold text-uppercase">Total Property Views</div>
                                <div class="h3 mb-0">{{ \Illuminate\Support\Number::abbreviate($totalPropertyViews ?? 0) }}</div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card border-0 shadow-sm text-center p-3">
                                <div class="text-muted small fw-bold text-uppercase">Total Clicks</div>
                                <div class="h3 mb-0">{{ \Illuminate\Support\Number::abbreviate($totalPropertyLeadClicks ?? 0) }}</div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card border-0 shadow-sm text-center p-3">
                                <div class="text-muted small fw-bold text-uppercase">For Sell</div>
                                <div class="h3 mb-0 text-primary">{{ \Illuminate\Support\Number::abbreviate($totalPropertySell ?? 0) }}</div>
                            </div>
                        </div>        
                        
                        <div class="col-md-3">
                            <div class="card border-0 shadow-sm text-center p-3">
                                <div class="text-muted small fw-bold text-uppercase">For Rent</div>
                                <div class="h3 mb-0 text-success">{{ \Illuminate\Support\Number::abbreviate($totalPropertyRent ?? 0) }}</div>
                            </div>
                        </div>
                    </div>

                    <div class="row g-3">
                        <div class="col-lg-7">
                            <div class="card border-0 shadow-sm p-4">
                                <h5 class="mb-3">Property Type Status</h5>
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <span class="badge bg-primary text-white px-3 py-2">Home: {{ $totalPropertyHome ?? 0 }}</span>
                                    </div>
                                    <div>
                                        <span class="badge bg-secondary text-white px-3 py-2">Plot : {{ $totalPropertyPlot ?? 0 }}</span>
                                    </div>
                                    <div>
                                        <span class="badge bg-success text-white px-3 py-2">Commercial: {{ $totalPropertyCommercial ?? 0 }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-5">
                            <div class="card border-0 shadow-sm p-4 text-white bg-danger">
                                <h5 class="mb-3">Property Activity</h5>
                                <div class="row">
                                    <div class="col-6 border-end border-secondary">
                                        <div class="small opacity-75">Active</div>
                                        <div class="h4 mb-0 text-light">{{ $activeProperty ?? 0 }}</div>
                                    </div>
                                    <div class="col-6 ps-4">
                                        <div class="small opacity-75">Inactive</div>
                                        <div class="h4 mb-0 text-light">{{ $inactiveProperty ?? 0 }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    

@endsection
