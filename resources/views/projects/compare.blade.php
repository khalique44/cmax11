@extends('layouts.app')

  
@section('content')


@include('layouts.includes.nav')




<section class="py-5">
    <div class="container">
        <!-- Filter Section -->

        <div class="filter-section">
            <div class="filter-grid">
                <div class="filter-group">
                    <input type="text" class="filter-select font-size-12" value="" id="search-area" name="search-area" placeholder="Search Area">
                                   <div class="suggestions" style="border:1px solid #ddd; display:none; position:absolute; background:#fff; z-index:999;"></div>
                    
                </div>
                <div class="filter-group">
                    
                        <select class="filter-select " name="property_type" id="property_type" title="Select Property Type" >
                            <option value="" >Property Type</option>
                            @foreach($offering as $type)
                                <option value="{{ $type }}" >{{ ucfirst($type) }}</option>
                            @endforeach
                        </select>
                        <span class="dropdown-arrow">▼</span>
                    
                </div>
                
                <div class="filter-group">
                    <select class="filter-select" name="bedrooms" id="bedrooms" title="Select Number of Bedrooms" >
                        <option value="">Number of Bedrooms</option>
                        @foreach($bedrooms as $bedroom)
                            <option value="{{ $bedroom }}" >{{ ($bedroom) }}</option>
                        @endforeach
                    </select>
                    <span class="dropdown-arrow">▼</span>
                </div>
                
                <div class="filter-group">
                    <select class="filter-select " name="builder_id" id="builder_id" title="Select Builder">
                        <option value="" selected >Builder</option>
                        <@foreach($builders as $builder)
                            <option value="{{ $builder->id }}">{{ ucfirst($builder->builder_name) }}</option>
                        @endforeach
                    </select>
                    <span class="dropdown-arrow">▼</span>
                </div>
                
                <div class="filter-group">
                    <select class="filter-select " name="progress" id="progress" title="Select Progress/Status" >
                        <option value="" selected>Progress/Status</option>
                        @foreach($progress as $key => $prog)
                        <option value="{{ $key }}" >{{ ucfirst($prog) }}</option>
                        @endforeach
                    </select>
                    <span class="dropdown-arrow">▼</span>
                </div>
                
                
                
                
            </div>
            <div class="row">
                <div class="col-md-6">
                    <select class="filter-select select2" id="compare-projects" multiple="" data-placeholder="Select Project" title="Select Project" >
                        @if(count($allProjects) > 0)
                            @foreach($allProjects as $project)
                                <option value="{{ $project->id }}" @selected(in_array($project->id,$compare)) {{ in_array($project->id,$compare) ? 'data-added=1' : 'data-added=0' }}>{{ $project->project_title }}</option>
                            @endforeach
                        @endif
                        
                    </select>
                </div>
                <div class="col-md-4">
                    <div class="text-left"><button class="add-to-compare" onclick="addCompareMultiple();">Add to Compare</button></div>
                </div>
            </div>
        </div>

        <div class="load-compare-list">
            @include('projects.partials.compare_list',['projects' => $projects])
        </div>

    </div>
</section>

  @include('layouts.includes.footer')     
       
@endsection