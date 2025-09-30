@extends('layouts.admin')

@section('content')

    <div class="right-side-section">
        <div class="right-section-content">
            <div class="admin-sec-btn-area">
                <div class="report-title-section">
                    <h4>Blogg General Settings</h4>
                </div>
                
            </div>
            <!--  ===============================  -->
            <!--  ======= För Boende General Settings ===========  -->
            <!--  ===============================  -->

            <div class="row">
                @include('layouts.partials.messages')
                <div class="col-xs-12">
                    <div class="district-form-content">
                        <form class="district-fields" method="POST" action="{{url('admin/blog/general_settings', array('update'))}}" enctype="multipart/form-data">
                            {{method_field('PUT')}}
                            {{csrf_field()}}

                            <div class="form-group">
                                <label>Title :</label>
                                <input type="text" name="blog_title" id="blog_title" title="enter title!" class="district-input-field form-control" placeholder="Title"
                                       value="{{old('blog_title',$blog_title)}}" required >
                                <div id="msg_1">&nbsp;</div>
                            </div>

                            <div class="form-group">
                                <label>Description :</label>
                                <textarea  name="blog_description" id="blog_description" title="enter description!" class="district-input-field form-control" rows="8" placeholder="Description"
                                         >{{old('blog_description',$blog_description)}}</textarea>
                                <div id="msg_2">&nbsp;</div>
                            </div>

                            <div class="form-group">
                                <label>Header Image (1920 &times; 915) :</label>
                                <input type="file" name="file_url" id="file_url"  class="district-input-field form-control"  >
                                @if(!empty($blog_header_image))
                                <a href="{!! url('public') !!}/{{$blog_header_image}}" target="_blank"><img src="{!! url('public') !!}/{{$blog_header_image}}" class="logo" alt="Logo" width="50%"></a>
                                @endif
                            </div>

                            <div class="form-group">
                                <label>Meta Title :</label>
                                <input type="text" name="blog_meta_title" id="blog_meta_title" title="enter  meta title!" class="district-input-field form-control" placeholder="Meta Title"
                                       value="{{old('blog_meta_title',$blog_meta_title)}}"  >
                                <div id="msg_8">&nbsp;</div>
                            </div>

                            <div class="form-group">
                                <label>Meta Description :</label>
                                <textarea  name="blog_meta_description" id="blog_meta_description" title="enter meta description!" class="district-input-field form-control" rows="8" placeholder="Meta Description"
                                         >{{old('blog_meta_description',$blog_meta_description)}}</textarea>
                                <div id="msg_9">&nbsp;</div>
                            </div>

                            <div class="form-group">
                                <label>Meta Keywords :</label>
                                <textarea  name="blog_meta_keywords" id="blog_meta_keywords" title="enter meta Keywords!" class="district-input-field form-control" rows="8" placeholder="Meta Keywords"
                                         >{{old('blog_meta_keywords',$blog_meta_keywords)}}</textarea>
                                <div id="msg_9">&nbsp;</div>
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


