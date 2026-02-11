@extends('layouts.admin')

@section('content')
    <div class="right-side-section">
        <div class="right-section-content">
            <div class="admin-sec-btn-area">
                <div class="report-title-section">
                    <h4>Create Sub Area</h4>
                </div>
                <div class="district-back-del-btn-area">
                    <div class="distrcit-back-btn">
                        <div class="district-back-del-btn-area">
                            <a href="{{url('admin/subareas')}}" data-toggle="" data-target="#search-db-model"  class="btn btn-sm btn-warning">Back</a>
                            
                        </div>
                        
                    </div>
                </div>
            </div>
            <!--  ===============================  -->
            <!--  ======= Sub Areas Section ===========  -->
            <!--  ===============================  -->
            <div class="container mt-3">
                <div class="row">
                    @include('layouts.partials.messages')
                    <div class="ajax-msg"></div>
                    <div class="col-xs-12">
                        <div class="">
                            
                            <form class="has-filepond" method="POST" action="{{url('admin/subareas/')}}" enctype="multipart/form-data" id="subAreaForm">
                                 {{csrf_field()}}
                                
                                <div class="col-xs-12 mb-3 mt-3">
                                    <div class="form-group">
                                        <label>*Main Area :</label>
                                        <select name="area_id" id="area_id" class="form-control select2"  data-placeholder="Select Area">
                                            <option value="">Select Area</option>
                                            @foreach($areas as $area)
                                                <option value="{{ $area->id }}" {{ old('area_id') === $area->id ? 'selected' : '' }}>{{ ucfirst($area->name)  }}</option>
                                            @endforeach
                                        </select>                                    
                                    </div>
                                </div>
                                    
                                <div class="col-xs-12 mb-3 mt-3">
                                    <div class="form-group">
                                        <label>*Sub Area :</label>
                                        <input type="text" name="name" id="name" title="enter sub area name!" class="district-input-field form-control" placeholder="Sub Area Name" required value="{{old('name')}}">                                    
                                    </div>
                                </div>


                                <div class="col-xs-12">
                                    <div class="form-group">
                                       
                                        <button type="submit" class="btn btn-success mt-3">Save</button>
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