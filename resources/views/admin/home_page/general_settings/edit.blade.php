@extends('layouts.admin')

@section('content')

    <div class="right-side-section">
        <div class="right-section-content">
            <div class="admin-sec-btn-area">
                <div class="report-title-section">
                    <h4>Home Page General Settings</h4>
                </div>
                
            </div>
            <!--  ===============================  -->
            <!--  ======= Home Page Settings Update ===========  -->
            <!--  ===============================  -->

            <div class="row">
                @include('layouts.partials.messages')
                <div class="col-xs-12">
                    <div class="district-form-content">
                        <form class="district-fields" method="POST" action="{{url('admin/home_page/home_settings', array($home_settings->id))}}" enctype="multipart/form-data">
                            {{method_field('PUT')}}
                            {{csrf_field()}}
                            <div class="form-group">
                                <label>Title :</label>
                                <input type="text" name="title" id="title" title="enter title!" class="district-input-field form-control" placeholder="Title"
                                       value="{{$home_settings->title}}" required >
                                <div id="msg_1">&nbsp;</div>
                            </div>

                            <div class="form-group">
                                <label>Description :</label>
                                <textarea  name="description" id="description" title="enter description!" class="district-input-field form-control" rows="8" placeholder="Description"
                                         >{{$home_settings->description}}</textarea>
                                <div id="msg_2">&nbsp;</div>
                            </div>

                            <div class="form-group">
                                <label>Header Image (1920 &times; 915) :</label>
                                <input type="file" name="header_image" id="header_image"  class="district-input-field form-control"  >
                                @if(!empty($home_settings->header_image))
                                <a href="{!! url('public') !!}/{{$home_settings->header_image}}" target="_blank"><img src="{!! url('public') !!}/{{$home_settings->header_image}}" class="logo" alt="Logo" width="50%"></a>
                                @endif
                            </div>

                            <div class="form-group">
                                <label>About Us Title :</label>
                                <input type="text" name="about_us_title" id="about_us_title" title="enter about us title!" class="district-input-field form-control" placeholder="About Us Title"
                                       value="{{$home_settings->about_us_title}}" required >
                                <div id="msg_3">&nbsp;</div>
                            </div>


                            <div class="form-group">
                                <label>About Us Description :</label>
                                
                                <textarea  name="about_us_description" id="about_us_description" title="enter about us description!" class="district-input-field form-control" rows="8" placeholder="About us description"
                                         >{{$home_settings->about_us_description}}</textarea>
                                
                            </div>

                            


                            <div class="form-group">
                                <label>Testimonial Title :</label>
                                <input type="text" name="testimonial_title" id="testimonial_title" title="enter Testimonial Title!" class="district-input-field form-control" placeholder="Testimonial Title"
                                       value="{{$home_settings->testimonial_title}}" required >
                                <div id="msg_4">&nbsp;</div>
                            </div>

                            <div class="form-group">
                                <label>Team Member Title :</label>
                                <input type="text" name="team_member_title" id="team_member_title" title="enter Team Member Titl!" class="district-input-field form-control" placeholder="Team Member Title"
                                       value="{{$home_settings->team_member_title}}" required >
                                <div id="msg_5">&nbsp;</div>
                            </div>

                            <div class="form-group">
                                <label>Team Member Description :</label>
                                <textarea  name="team_member_description" id="team_member_description" title="enter team member description!" class="district-input-field form-control" rows="8" placeholder="Team Member Description"
                                         >{{$home_settings->team_member_description}}</textarea>
                               
                            </div>

                            <div class="form-group">
                                <label>Contact Us Title :</label>
                                <input type="text" name="contact_us_title" id="contact_us_title" title="enter Contact Us Title!" class="district-input-field form-control" placeholder="Contact Us Title"
                                       value="{{$home_settings->contact_us_title}}" required >
                                <div id="msg_6">&nbsp;</div>
                            </div>

                            <div class="form-group">
                                <label>Contact Us Title 2 :</label>
                                <input type="text" name="contact_us_slogan" id="contact_us_slogan" title="enter Contact Us Title 2 !" class="district-input-field form-control" placeholder="Contact Us Title 2"
                                       value="{{$home_settings->contact_us_slogan}}"  >
                                <div id="msg_7">&nbsp;</div>
                            </div>


                            <div class="form-group">
                                <label>Meta Title :</label>
                                <input type="text" name="meta_title" id="meta_title" title="enter  meta title!" class="district-input-field form-control" placeholder="Meta Title"
                                       value="{{$home_settings->meta_title}}"  >
                                <div id="msg_8">&nbsp;</div>
                            </div>

                            <div class="form-group">
                                <label>Meta Description :</label>
                                <textarea  name="meta_description" id="meta_description" title="enter meta description!" class="district-input-field form-control" rows="8" placeholder="Meta Description"
                                         >{{$home_settings->meta_description}}</textarea>
                                <div id="msg_9">&nbsp;</div>
                            </div>

                            <div class="form-group">
                                <label>Meta Keywords :</label>
                                <textarea  name="meta_keywords" id="meta_keywords" title="enter meta Keywords!" class="district-input-field form-control" rows="8" placeholder="Meta Keywords"
                                         >{{$home_settings->meta_keywords}}</textarea>
                                <div id="msg_9">&nbsp;</div>
                            </div>
                            
                            

                            <div class="Create-district-btn">
                                <button type="submit" href="javascript:void(0);" id="btn_save" class="btn enableOnInput3">
                                    Update
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <script>
        $('.btn_category_delete').on('click',function () {
            var DataDeleteId = $(this).attr('data-delete-id');

            $(".data-delete-form").attr('action', "{{ url('') }}/admin/modules/categories/"+DataDeleteId);
        });
    </script>
@endsection


