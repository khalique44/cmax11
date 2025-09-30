@extends('layouts.admin')

@section('content')
    <div class="right-side-section">
        <div class="right-section-content">
            <div class="admin-sec-btn-area">
                <div class="report-title-section">
                    <h4>About Rosen I Vara</h4>
                </div>
                <div class="district-back-del-btn-area">
                    <div class="distrcit-back-btn">
                        <a href="{{url('admin/home_page/about_section')}}" data-toggle="" data-target="#search-db-model"  class="btn">Back</a>

                    </div>
                </div>
            </div>
            <!--  ===============================  -->
            <!--  ======= About Section ===========  -->
            <!--  ===============================  -->

            <div class="row">
                <div class="col-xs-12">
                    <div class="district-form-content add-new-district-form">
                        <form class="district-fields" method="POST" action="{{url('admin/home_page/about_section')}}" enctype="multipart/form-data">
                            {{csrf_field()}}
                            <div class="col-xs-12">
                                <div class="form-group">
                                    <label>*Title :</label>
                                    <input type="text" name="title" id="title" title="enter title!" class="district-input-field form-control" placeholder="Title" required >
                                    <div id="msg_1">&nbsp;</div>
                                </div>
                            </div>
                            <div class="col-xs-12">   
                                <div class="form-group">
                                    <label>Upload Image (555 × 415):</label>
                                    <input type="file" name="file_url" id="file_url"  class="district-input-field form-control"  >
                                    
                                </div>
                            </div>

                            <div class="col-xs-12">
                                <div class="form-group">
                                    <label>Is Video :</label>
                                    <div class="district-active-radio-field">
                                        <label class="d-radio">
                                            <input type="radio" name="is_video" value="yes"class="" id="is_video_yes" >Yes</input>
                                        </label>
                                        <label class="d-radio">
                                            <input type="radio" name="is_video" value="no" id="is_video_no" required checked >No</input>
                                        </label>
                                    </div>
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
