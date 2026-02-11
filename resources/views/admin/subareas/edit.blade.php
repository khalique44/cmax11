@extends('layouts.admin')

@section('content')
    <div class="right-side-section">
        <div class="right-section-content">
            <div class="admin-sec-btn-area">
                <div class="report-title-section">
                    <h4>Edit Sub Area</h4>
                </div>
                <div class="district-back-del-btn-area">
                    <div class="distrcit-back-btn">
                        <a href="{{url('admin/subareas/')}}" data-toggle="" data-target="#search-db-model"  class="btn">Back</a>

                    </div>
                </div>
            </div>
            <!--  ===============================  -->
            <!--  ======= Sub Areas Section ===========  -->
            <!--  ===============================  -->
            <div class="container mt-3">
                <div class="row">
                    <div class="ajax-msg"></div>
                    <div class="col-xs-12">
                        <div class="">
                            
                            <form class="" method="POST"  enctype="multipart/form-data" id="feature-form-update" action="{{url('admin/subareas/'.$record->id)}}">
                                 {{csrf_field()}}
                                @method('PUT')
                                
                                <div class="col-xs-12 mb-3 mt-3">
                                    <div class="form-group">
                                        <label>*Main Area :</label>
                                        <select name="area_id" id="area_id" class="form-control select2"  data-placeholder="Select Area">
                                            <option value="">Select Area</option>
                                            @foreach($areas as $area)
                                                <option value="{{ $area->id }}" {{ old('area_id', $record->area_id) === $area->id ? 'selected' : '' }}>{{ ucfirst($area->name)  }}</option>
                                            @endforeach
                                        </select>                                    
                                    </div>
                                </div>
                                    
                                <div class="col-xs-12 mb-3 mt-3">
                                    <div class="form-group">
                                        <label>*Sub Area :</label>
                                        <input type="text" name="name" id="name" title="enter sub area name!" class="district-input-field form-control" placeholder="Sub Area Name" required value="{{old('name',$record->name)}}">                                    
                                    </div>
                                </div>                              

                                <div class="col-xs-12">
                                    <div class="form-group">
                                        
                                        <button type="submit" class="btn btn-success mt-3">Update</button>
                                        <a   class="btn btn-warning mt-3" href="{{url('admin/subareas/')}}" >Back</a>
                                        
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