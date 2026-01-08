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
                    {{ $project->alt_location }}
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
                                <td><strong>Title:</strong></td>
                                @foreach($project->offers as $index => $savedOffer)
                                        
                                        <td>{{ $savedOffer->title ?? '' }}</td>
                                        
                                    
                                @endforeach
                            </tr>
                            <tr class="dimensions-row">
                                <td><strong>Bedrooms:</strong></td>
                                @foreach($project->offers as $index => $savedOffer)
                                        
                                        
                                        <td>{!! $savedOffer->bedrooms > 0 ? $savedOffer->bedrooms : 'N/A' !!}</td>
                                        
                                    
                                @endforeach
                            </tr>

                            <tr class="dimensions-row">
                                <td><strong>Unit Price:</strong></td>
                                @foreach($project->offers as $index => $savedOffer)
                                        
                                        
                                        <td>{{ GeneralHelper::cleanDecimal($savedOffer->price_from) }}
                                                                    {{ $savedOffer->price_from_in_format }}</td>
                                        
                                    
                                @endforeach
                            </tr>

                            <tr class="dimensions-row">
                                <td><strong>Installment Plan:</strong></td>
                                @foreach($project->offers as $index => $savedOffer)
                                        

                                        <td> {!! $savedOffer->is_installment > 0 ? '<span class="badge bg-success">'. $savedOffer->number_of_instalments .' Instalmments</span> ' : '<span class="badge bg-danger">No</span>' !!}</td>
                                        
                                    
                                @endforeach
                            </tr>
                            <tr class="dimensions-row">
                                <td><strong>Monthly Installment:</strong></td>
                                @foreach($project->offers as $index => $savedOffer)
                                        

                                        <td> {!! $savedOffer->is_installment > 0 ? '<span class="badge bg-success">'. $savedOffer->monthly_installment .' PKR</span> ' : '<span class="badge bg-danger">No</span>' !!}</td>
                                        
                                    
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
                <div class="row-value features">
                    <div class="row">
                        @if(!$project->features->isEmpty())
                            @foreach($project->features as $feature)
                                <div class="col-md-6 feature-compare feature-img-compare ">{!! $feature->icon_image ?? '' !!}<span class=""> {{ $feature->name ?? '' }}</span></div>
                            @endforeach
                        @else
                            <span>N/A</span>
                        @endif
                    </div>
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
    <div class="text-center text-muted"><h5>Please add minimum 2 projects to Compare!</h5></div>
@else
    <div class="text-center text-muted"><h5>No projects selected for comparison.</h5></div>
@endif