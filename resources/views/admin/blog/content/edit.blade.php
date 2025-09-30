@extends('layouts.admin')

@section('content')

    <div class="right-side-section">
        <div class="right-section-content">
            <div class="admin-sec-btn-area">
                <div class="report-title-section">
                    <h4>Blog</h4>
                </div>
                <div class="district-back-del-btn-area">
                    <div class="distrcit-back-btn">
                        <div class="district-back-del-btn-area">
                            
                            <a href="{{url('admin/blog/posts')}}" data-toggle="" data-target="#search-db-model"  class="btn">Back</a>
                        </div>
                    </div>
                </div>
            </div>

            <!--  ===============================  -->
            <!--  ======= Blogg Section Update ===========  -->
            <!--  ===============================  -->

            <div class="row">
                 @include('layouts.partials.messages')
                <div class="col-xs-12">
                    <div class="district-form-content add-new-district-form">
                        <form class="" method="POST" action='{{url("admin/blog/posts/{$record->id}")}}' enctype="multipart/form-data">
                            {{ method_field('PUT') }}
                            {{ csrf_field() }}
                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="form-group">
                                        <label class="form-label">*Title :</label>
                                        <input type="text" name="title" id="title" title="enter title!" class="form-control" placeholder="Title"  value="{{old('title', $record->title)}}" required >
                                        
                                        <div id="msg_1">&nbsp;</div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="form-group">
                                        <label class="form-label">Short Description :</label>
                                        <textarea  name="short_description" id="short_description" title="enter short description!" class="district-input-field form-control" rows="8" placeholder="Short Description"
                                                 value="{{old('short_description', $record->short_description)}}" >{{old('short_description', $record->short_description)}}</textarea>
                                        <div id="msg_2">&nbsp;</div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">    
                                <div class="col-xs-12">
                                    <div class="clearfix">
                                        <label class="form-label">Description :</label>
                                        <textarea  name="description" id="txtEditor" title="enter description!" class=" form-control" rows="8" placeholder="Description"
                                                 >{{old('description', $record->description)}}</textarea>
                                        <div id="msg_2">&nbsp;</div>
                                    </div>
                                </div>
                            </div>
                                
                                

                                
                                
                            <div class="row">
                                <div class="col-xs-12">   
                                    <div class="form-group">
                                        <label class="form-label">Upload Image (600 &times; 450):</label>
                                        <input type="file" name="file_url" id="file_url"  class="form-control"  >

                                        @if(!empty($record->file_url))
                                        <div class="m-2">
                                            <a href="{!! url('public') !!}/{{$record->file_url}}" target="_blank" class="available-image-area">
                                                
                                                <img src="{!! url('public') !!}/{{$record->file_url}}" class="logo" alt="Logo" width="150">
                                                
                                            </a>
                                        </div>
                                        @endif
                                        
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12">   
                                    <div class="form-group">
                                        <label class="form-label">Upload Header Image Detail Page (1920 &times; 915):</label>
                                        <input type="file" name="header_image" id="header_image"  class="form-control"  >

                                        @if(!empty($record->header_image))
                                        <div class="m-2">
                                            <a href="{!! url('public') !!}/{{$record->header_image}}" target="_blank" class="available-image-area">
                                                
                                                <img src="{!! url('public') !!}/{{$record->header_image}}" class="logo" alt="Logo" width="150">
                                                
                                            </a>
                                        </div>
                                        @endif
                                        
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12 mb-3 mt-3">
                                    <div class="form-group">
                                       
                                        <div class="form-check form-switch">
                                          <input class="form-check-input" type="checkbox" id="status" name="status" value="yes"  {{ old('status', $record->status ?? '') === 'yes' ? 'checked' : '' }} >
                                          <label class="form-check-label" for="status">Active</label>
                                        </div>                                    
                                    </div>
                                </div>
                            </div>

                                                                         
                            <div class="row">
                                <div class="Create-district-btn">
                                    <button type="submit" href="javascript:void(0);" id="btn_save" class="btn btn-success mt-3">
                                        Update
                                    </button>

                                </div>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <script>
        $('.btn_delete').on('click',function () {
            var DataDeleteId = $(this).attr('data-delete-id');

            $(".data-delete-form").attr('action', "{{ url('') }}/admin/blog/posts/"+DataDeleteId);
        });
    </script>
@endsection
