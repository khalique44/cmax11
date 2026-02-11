@extends('layouts.admin')

@section('content')

    <div class="right-side-section">
        <div class="right-section-content">
            <div class="admin-sec-btn-area">
                <div class="report-title-section">
                    <h4>Home Page Popular Projects</h4>
                </div>
                
            </div>
            <!--  ===============================  -->
            <!--  ======= Home Page Popular Projects ===========  -->
            <!--  ===============================  -->

            <div class="row">
                @include('layouts.partials.messages')
                <div class="col-xs-12">
                    <div class="">
                        <form class="" method="POST" action="{{url('admin/home-page', array('update-popular-projects'))}}" enctype="multipart/form-data">
                            {{method_field('PUT')}}
                            {{csrf_field()}}

                            <div class="row">                                
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">Title 1: </label>
                                        <input type="text" name="popular_projects_title1" id="popular_projects_title1" class="form-control" value="{{ old('popular_projects_title1', $popular_projects_title1 ?? '') }}"  >
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">Title 2:<span>*</span></label>
                                        <input type="text" name="popular_projects_title2" id="popular_projects_title2" class="form-control" value="{{ old('popular_projects_title2', $popular_projects_title2 ?? '') }}" required>
                                    </div>
                                </div>
                            </div>

                            


                            <div class="row">

                                <div class="col-md-12">
                                    <div class="form-group">
                                        
                                        <button type="submit" class="btn btn-success mt-3">Update</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
    
@endsection


