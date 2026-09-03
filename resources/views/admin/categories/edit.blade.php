@extends('layouts.admin')

@section('content')
    <div class="right-side-section">
        <div class="right-section-content">
            <div class="admin-sec-btn-area">
                <div class="report-title-section">
                    <h4>Edit Category</h4>
                </div>
                <div class="district-back-del-btn-area">
                    <div class="distrcit-back-btn">
                        <a href="{{url('admin/categories/')}}" data-toggle="" data-target="#search-db-model"  class="btn btn-warning mb-3">Back</a>

                    </div>
                </div>
            </div>
            <!--  ===============================  -->
            <!--  ======= Category Section ===========  -->
            <!--  ===============================  -->
            <div class="container mt-3">
                <div class="row">
                    <div class="ajax-msg"></div>
                    <div class="col-xs-12">
                        <div class="">
                            
                            <form class="" method="POST"  enctype="multipart/form-data" id="amenity-form-update" action="{{url('admin/categories/'.$record->id)}}">
                                 {{csrf_field()}}
                                @method('PUT')
                                
                                <div class="row">    
                                    <div class="col-md-6 mb-3 mt-3">
                                        <div class="form-group">
                                            <label class="form-label">Category Name <span>*</span></label>
                                            <input type="text" name="name" id="name" title="enter category name!" class="district-input-field form-control" placeholder="Category Name" required value="{{old('name',$record->name)}}">                                    
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
                                        <a   class="btn btn-warning mt-3" href="{{url('admin/categories/')}}" >Back</a>
                                        
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