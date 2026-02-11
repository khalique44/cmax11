@extends('layouts.admin')

@section('content')

    <div class="right-side-section">
        <div class="right-section-content">
            <div class="admin-sec-btn-area">
                <div class="report-title-section">
                    <h4>Home Page Section Our Latest Blog</h4>
                </div>
                
            </div>
            <!--  ===============================  -->
            <!--  ======= Home Page Our Latest Blog ===========  -->
            <!--  ===============================  -->

            <div class="row">
                @include('layouts.partials.messages')
                <div class="col-xs-12">
                    <div class="">
                        <form class="" method="POST" action="{{url('admin/home-page', array('update-latest-blogs'))}}" enctype="multipart/form-data">
                            {{method_field('PUT')}}
                            {{csrf_field()}}

                            <div class="row">                                
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="form-label">Title : </label>
                                        <input type="text" name="latest_blog_title" id="latest_blog_title" class="form-control" value="{{ old('latest_blog_title', $latest_blog_title ?? '') }}"  >
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


