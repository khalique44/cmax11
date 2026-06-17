@extends('layouts.admin')

@section('content')
    <div class="right-side-section">
        <div class="right-section-content">
            <div class="admin-sec-btn-area">
                <div class="report-title-section">
                    <h4>Edit Amenity</h4>
                </div>
                <div class="district-back-del-btn-area">
                    <div class="distrcit-back-btn">
                        <a href="{{url('admin/amenities/')}}" data-toggle="" data-target="#search-db-model"  class="btn btn-warning mb-3">Back</a>

                    </div>
                </div>
            </div>
            <!--  ===============================  -->
            <!--  ======= Amenitys Section ===========  -->
            <!--  ===============================  -->
            <div class="container mt-3">
                <div class="row">
                    <div class="ajax-msg"></div>
                    <div class="col-xs-12">
                        <div class="">
                            
                            <form class="" method="POST"  enctype="multipart/form-data" id="amenity-form-update" action="{{url('admin/amenities/'.$record->id)}}">
                                 {{csrf_field()}}
                                @method('PUT')
                                
                                <div class="row">    
                                    <div class="col-md-6 mb-3 mt-3">
                                        <div class="form-group">
                                            <label class="form-label">Amenity Name <span>*</span></label>
                                            <input type="text" name="name" id="name" title="enter amenity name!" class="district-input-field form-control" placeholder="Amenity Name" required value="{{old('name',$record->name)}}">                                    
                                        </div>
                                    </div>
                                        
                                    <div class="col-md-6 mb-3 mt-3">
                                        <div class="form-group">
                                            <label class="form-label">Property Type<span>*</span></label>
                                            <select name="property_type" id="property_type" class="form-control select2" required>
                                                <option value="">Select Property Type</option>
                                                @foreach($property_types as $type)
                                                    <option value="{{ $type }}" {{ old('property_type', $record->property_type ?? '') === $type ? 'selected' : '' }}>{{ ucfirst($type) }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                

                            <div class="row">
                                <div class="col-md-6 mb-3 mt-3">
                                    <div class="form-group">
                                        <label class="form-label">Icon  <i class="fa {{old('icon',$record->icon)}}"></i></label>
                                        <input type="text" name="icon" id="icon" title="enter amenity icon!" class="district-input-field form-control" placeholder="Amenity icon"  value="{{old('icon',$record->icon)}}">                                    
                                    </div>
                                </div>                 
                               
                                
                                <div class="col-md-6 mb-3 mt-3">   
                                    <div class="form-group">
                                        <!-- File Upload -->
                                        <div class="pond-container">
                                            <label class="form-label">Upload Image</label>
                                            <input type="file" name="file_url" id="file_url" class="form-control">
                                           
                                        </div>

                                        @if(!empty($record->file_url))
                                            <div class="">                       
                                                <div class="form-group">
                                                    <a href="{!! url('') !!}/{{$record->file_url}}" target="_blank" class="available-image-area">
                                                        
                                                        <img src="{!! url('') !!}/{{$record->file_url}}" class="header-image" title="Header Image" alt="" width="100">                                                    
                                                    </a>                                          
                                                    
                                                </div>
                                                
                                            </div>
                                        @endif
                                    </div>


                                </div>  
                            </div>

                                                          

                                <div class="col-xs-12 mb-3 mt-3">
                                    <div class="form-group">
                                       
                                        <div class="form-check form-switch">
                                          <input class="form-check-input" type="checkbox" id="is_active" name="is_active" {{ $record->is_active == 1 ? 'checked' : '' }}>
                                          <label class="form-check-label" for="is_active">Status</label>
                                        </div>                                    
                                    </div>
                                </div>   

                                <div class="col-xs-12">
                                    <div class="form-group">
                                        
                                        <button type="submit" class="btn btn-success mt-3">Update</button>
                                        <a   class="btn btn-warning mt-3" href="{{url('admin/amenities/')}}" >Back</a>
                                        
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>


@endsection
@section('scripts')



@endsection