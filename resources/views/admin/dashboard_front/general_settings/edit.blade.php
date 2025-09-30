@extends('layouts.admin')

@section('content')

    <div class="right-side-section">
        <div class="right-section-content">
            <div class="admin-sec-btn-area">
                <div class="report-title-section">
                    <h4>Dashboard Front/What Page Settings</h4>
                </div>
                
            </div>
            <!--  ===============================  -->
            <!--  ======= Kontakta Oss General Settings ===========  -->
            <!--  ===============================  -->

            <div class="row">
                @include('layouts.partials.messages')
                <div class="col-xs-12">
                    <div class="district-form-content">
                        <form class="district-fields" method="POST" action="{{url('admin/dashboard_front/general_settings', array('update'))}}" enctype="multipart/form-data">
                            {{method_field('PUT')}}
                            {{csrf_field()}}

                            <div class="form-group">
                                <label>Title :</label>
                                <input type="text" name="what_title" id="what_title" title="enter title!" class="district-input-field form-control" placeholder="Title"
                                       value="{{old('what_title',$what_title)}}" required >
                                <div id="msg_1">&nbsp;</div>
                            </div>

                            <div class="form-group">
                                <label>Description :</label>
                                <textarea  name="what_description" id="what_description" title="enter description!" class="district-input-field form-control" rows="8" placeholder="Description"
                                         >{{old('what_description',$what_description)}}</textarea>
                                <div id="msg_2">&nbsp;</div>
                            </div>

                            
                            <div class="form-group">
                                <label>Header Image (1920 &times; 915) :</label>
                                <input type="file" name="what_header_image" id="what_header_image"  class="district-input-field form-control"  >
                                @if(!empty($what_header_image))
                                <a href="{!! url('public') !!}/{{$what_header_image}}" target="_blank"><img src="{!! url('public') !!}/{{$what_header_image}}" class="logo" alt="Logo" width="50%"></a>
                                @endif
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


