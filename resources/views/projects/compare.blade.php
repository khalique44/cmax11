@extends('layouts.app')

  
@section('content')


@include('layouts.includes.nav')




<section class="py-5">
    <div class="container">
        <!-- Filter Section -->
        <div class="filter-section">
            <div class="filter-grid">

                <div class="filter-group">
                    <select class="filter-select select2 compare-select-box" multiple="" data-placeholder="Select Project">
                        @if(count($allProjects) > 0)
                            @foreach($allProjects as $project)
                                <option value="{{ $project->id }}" {{ in_array($project->id,$compare) ? 'selected' : '' }}>{{ $project->project_title }}</option>
                            @endforeach
                        @endif
                        
                    </select>
                    <span class="dropdown-arrow">▼</span>
                </div>

            </div>
            <div class="text-center"><button class="add-to-compare" onclick="addCompareMultiple();">Add to Compare</button></div>
        </div>

        @if(count($projects) > 1)
        <!-- Comparison Container -->
            <div class="comparison-container cols-{{ count($projects) }}">
                <div class="property-headers">
                    <div class="empty-header"></div>

                    {{-- Loop over each project --}}
                    @foreach($projects as $project)
                        @php
                            $gallery = $project->getMedia('project_gallery');
                            $firstImage = ($project->featuredImage) ? $project->featuredImage : $gallery->first();  // Get the first media
                        @endphp
                        <div class="property-header">
                            <h2 class="property-title">
                                {{ strtoupper($project->project_title) }}
                            </h2>
                            @if(!empty($firstImage))
                                <img src="{{  GeneralHelper::getMediaWithPublicDir($firstImage->getUrl('webp'))  }}"
                                 alt="{{ $project->project_title }}"
                                 class="property-image">
                            @else
                                <img src="{{ asset('assets/img/no-image-1080x1080.png') }}"
                                 alt="{{ $project->project_title }}"
                                 class="property-image">
                            @endif
                        </div>
                    @endforeach
                </div>

                <!-- Location Row -->
                <div class="comparison-row">
                    <div class="row-label">Location</div>
                    @foreach($projects as $project)
                        <div class="row-value">
                            <span class="location-icon">📍</span>
                            {{ $project->location }}
                        </div>
                    @endforeach
                </div>

                <!-- Builder Row -->
                <div class="comparison-row">
                    <div class="row-label">Builder</div>
                    @foreach($projects as $project)
                        <div class="row-value">{{ $project->builder->builder_name ?? ''}}</div>
                    @endforeach
                </div>

                <!-- Status Row -->
                <div class="comparison-row">
                    <div class="row-label">Progress</div>
                    @foreach($projects as $project)
                        <div class="row-value {{ $project->progress == 'ready' ? 'status-ready' : 'status-construction' }}">
                            {{ config('constants.progress.'.$project->progress) }}
                        </div>
                    @endforeach
                </div>

                <!-- Project Unit Row -->
                <div class="comparison-row">
                    <div class="row-label">Project Unit</div>
                    @foreach($projects as $project)
                        <div class="row-value">
                            <span class="unit-type">
                                 <table class="dimensions-table">
                                <thead class="dimensions-header">
                                    <tr>
                                        <th></th>
                                        @if(!empty($project->offers))
                                            @foreach($project->offers as $key => $savedOffer)
                                                
                                                <th>{{ucwords(rtrim($savedOffer->offer,'s')) ?? ''}}</th>
                                            
                                            @endforeach
                                        @endif
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="dimensions-row">
                                        <td></td>
                                        @foreach($project->offers as $index => $savedOffer)
                                                
                                                <td>{{ $savedOffer->title ?? '' }}</td>
                                                
                                            
                                        @endforeach
                                    </tr>
                                    <tr class="dimensions-row">
                                        <td><i class="fa fa-bed" title="Number of Bedrooms"></i></td>
                                        @foreach($project->offers as $index => $savedOffer)
                                                
                                                
                                                <td>{!! $savedOffer->bedrooms > 0 ? $savedOffer->bedrooms : 'N/A' !!}</td>
                                                
                                            
                                        @endforeach
                                    </tr>

                                    <tr class="dimensions-row">
                                        <td><i class="fa fa-calendar" title="Installment"></i></td>
                                        @foreach($project->offers as $index => $savedOffer)
                                                

                                                <td> {!! $savedOffer->is_installment > 0 ? '<span class="badge bg-success">Yes</span> ' : '<span class="badge bg-danger">No</span>' !!}</td>
                                                
                                            
                                        @endforeach
                                    </tr>
                                </tbody>
                            </table>
                                
                            </span>
                        </div>
                    @endforeach
                </div>               


                <!-- Amenities -->
                <div class="comparison-row">
                    <div class="row-label">Features</div>
                    @foreach($projects as $project)
                        <div class="row-value">
                            @if(!$project->features->isEmpty())
                                @foreach($project->features as $feature)
                                    <span class="badge bg-dark">{{ $feature->name }}</span>
                                @endforeach
                            @else
                                <span>N/A</span>
                            @endif
                        </div>
                    @endforeach
                </div>

                <div class="comparison-row">
                    <div class="row-label"></div>
                    @foreach($projects as $project)
                        <div class="row-value ">
                            <a href="javascript:;" class="detail-btn btn-grey text-center"  onclick="removeCompare('{{ $project->id }}')" title="Remove from Compare">Remove</a>
                        </div>
                    @endforeach
                </div>
            </div>
        @elseif(count($projects) == 1)
            <div class="text-center"><h5>Please add minimum 2 projects to Compare!</h5></div>
        @else
            <div class="text-center"><h5>No projects selected for comparison.</h5></div>
        @endif

    </div>
</section>

  @include('layouts.includes.footer')     
       
@endsection