@extends('layouts.admin')

@section('content')

    <div class="right-side-section">
        <div class="right-section-content">
            <div class="admin-sec-btn-area">
                <div class="report-title-section">
                    <h4>Home Page Dream Property</h4>
                </div>
                
            </div>
            <!--  ===============================  -->
            <!--  ======= Home Page Dream Property ===========  -->
            <!--  ===============================  -->

            <div class="row">
                @include('layouts.partials.messages')
                <div class="col-xs-12">
                    <div class="">
                        <form class="" method="POST" action="{{url('admin/home-page', array('update-dream-property'))}}" enctype="multipart/form-data">
                            {{method_field('PUT')}}
                            {{csrf_field()}}

                            <div class="row">                                
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="form-label">Main Title:<span>*</span></label>
                                        <input type="text" name="home_section_dream_property" id="home_section_dream_property" class="form-control" value="{{ old('home_section_dream_property', $home_section_dream_property ?? '') }}" required>
                                    </div>
                                </div>
                            </div>

                            <div class="row">                                
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="form-label">Section:<span>*</span></label>
                                          <textarea  name="section_dream_property" id="section_dream_property" title="enter  description!" class="form-control txtEditor" rows="8" placeholder="description"  >{{old('section_dream_property', $section_dream_property)}}</textarea>
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


