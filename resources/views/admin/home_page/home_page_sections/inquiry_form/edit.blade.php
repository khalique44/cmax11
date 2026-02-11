@extends('layouts.admin')

@section('content')

    <div class="right-side-section">
        <div class="right-section-content">
            <div class="admin-sec-btn-area">
                <div class="report-title-section">
                    <h4>Home Page Inquiry Form</h4>
                </div>
                
            </div>
            <!--  ===============================  -->
            <!--  ======= Home Page Inquiry Form ===========  -->
            <!--  ===============================  -->

            <div class="row">
                @include('layouts.partials.messages')
                <div class="col-xs-12">
                    <div class="">
                        <form class="" method="POST" action="{{url('admin/home-page', array('update-inquiry-form'))}}" enctype="multipart/form-data">
                            {{method_field('PUT')}}
                            {{csrf_field()}}

                            <div class="row">                                
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">Title 1: </label>
                                        <input type="text" name="inquiry_form_title1" id="inquiry_form_title1" class="form-control" value="{{ old('inquiry_form_title1', $inquiry_form_title1 ?? '') }}"  >
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">Title 2:<span>*</span></label>
                                        <input type="text" name="inquiry_form_title2" id="inquiry_form_title2" class="form-control" value="{{ old('inquiry_form_title2', $inquiry_form_title2 ?? '') }}" required>
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


