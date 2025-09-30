@extends('layouts.admin')

@section('content')
    <div class="right-side-section">
        <div class="right-section-content">
            <div class="admin-sec-btn-area">
                <div class="report-title-section">
                    <h4>Testimonials</h4>
                </div>
                <div class="district-back-del-btn-area">
                    <div class="distrcit-back-btn">
                        <a href="{{url('admin/home_page/testimonials')}}" data-toggle="" data-target="#search-db-model"  class="btn">Back</a>

                    </div>
                </div>
            </div>
            <!--  ===============================  -->
            <!--  ======= Testimonials ===========  -->
            <!--  ===============================  -->

            <div class="row">
                <div class="col-xs-12">
                    <div class="district-form-content add-new-district-form">
                        <form class="district-fields" method="POST" action="{{url('admin/home_page/testimonials')}}" enctype="multipart/form-data">
                            {{csrf_field()}}
                            <div class="col-xs-12">
                                <div class="form-group">
                                    <label>*Name :</label>
                                    <input type="text" name="client_name" id="client_name" title="enter client name!" class="district-input-field form-control" placeholder="client name" required >
                                    <div id="msg_1">&nbsp;</div>
                                </div>
                            </div>
                            <div class="col-xs-12">   
                                <div class="form-group">
                                    <label>Upload Image (245 &times; 245) :</label>
                                    <input type="file" name="file_url" id="file_url"  class="district-input-field form-control"  >
                                    
                                </div>
                            </div>

                            <div class="col-xs-12">
                                <div class="form-group">
                                    <label>*Designation :</label>
                                    <input type="text" name="designation" id="designation" title="enter designation!" class="district-input-field form-control" placeholder="client designation" required >
                                    <div id="msg_2">&nbsp;</div>
                                </div>
                            </div>

                            <div class="col-xs-12">
                                <div class="form-group">
                                    <label>*Description :</label>
                                    
                                    <textarea  name="description" id="description" title="enter  description!" class="district-input-field form-control" rows="8" placeholder="description" required ></textarea>
                                    
                                </div>
                            </div>

                            
                                                        
                            <div class="col-xs-12">
                                <div class="form-group">
                                    <label>Active :</label>
                                    <div class="district-active-radio-field">
                                        <label class="d-radio">
                                            <input type="radio" name="status" value="yes"class="" id="radio_active_yes" required checked>Yes</input>
                                        </label>
                                        <label class="d-radio">
                                            <input type="radio" name="status" value="no" id="radio_active_no" required >No</input>
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="Create-district-btn">
                                <button type="submit" href="javascript:void(0);" id="btn_save" class="btn enableOnInput3">
                                    Save
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>

@endsection
