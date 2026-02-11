@extends('layouts.admin')

@section('content')
    <div class="right-side-section">
        <div class="right-section-content">
            <div class="admin-sec-btn-area">
                <div class="report-title-section">
                    <h4>Create Area</h4>
                </div>
                <div class="district-back-del-btn-area">
                    <div class="distrcit-back-btn">
                        <div class="district-back-del-btn-area">
                            <a href="{{url('admin/areas')}}" data-toggle="" data-target="#search-db-model"  class="btn btn-sm btn-warning">Back</a>
                            
                        </div>
                        
                    </div>
                </div>
            </div>
            <!--  ===============================  -->
            <!--  ======= Areas Section ===========  -->
            <!--  ===============================  -->
            <div class="container mt-3">
                <div class="row">
                    @include('layouts.partials.messages')
                    <div class="ajax-msg"></div>
                    <div class="col-xs-12">
                        <div class="">
                            
                            <form class="has-filepond" method="POST" action="{{url('admin/areas/')}}" enctype="multipart/form-data" id="area-form">
                                 {{csrf_field()}}
                                
                                    
                                <div class="col-xs-12 mb-3 mt-3">
                                    <div class="form-group">
                                        <label>*Area Name :</label>
                                        <input type="text" name="name" id="name" title="enter area name!" class="district-input-field form-control" placeholder="Area Name" required value="{{old('name')}}">                                    
                                    </div>
                                </div>


                                <div class="col-xs-12">
                                    <div class="form-group">
                                       
                                        <button type="submit" class="btn btn-success mt-3">Save</button>
                                        <a   class="btn btn-warning mt-3" href="{{url('admin/areas/')}}" >Back</a>
                                        
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