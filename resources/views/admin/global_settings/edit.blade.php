@extends('layouts.admin')

@section('content')

    <div class="right-side-section">
        <div class="right-section-content">
            <div class="admin-sec-btn-area">
                <div class="report-title-section">
                    <h4>Global Settings</h4>
                </div>
                
            </div>
            <!--  ===============================  -->
            <!--  ======= Global Settings ===========  -->
            <!--  ===============================  -->

            <div class="row">
                @include('layouts.partials.messages')
                <div class="col-xs-12">
                    <div class="district-form-content">
                        <form class="" method="POST" action="{{url('admin/global-settings', array('update'))}}" enctype="multipart/form-data">
                            {{method_field('PUT')}}
                            {{csrf_field()}}
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Header Logo (316 &times; 85) :</label>
                                        <input type="file" name="header_logo" id="header_logo"  class="district-input-field form-control"  >
                                        @if(!empty($header_logo))
                                        <a href="{{asset($header_logo)}}" target="_blank"><img src="{{asset($header_logo)}}" class="logo" alt="Logo" width="50%"></a>
                                        @endif
                                        <div id="msg_1">&nbsp;</div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Footer Logo (316 &times; 85) :</label>
                                        <input type="file" name="footer_logo" id="footer_logo"  class="district-input-field form-control"  >
                                        @if(!empty($footer_logo))
                                        <a href="{{asset($footer_logo)}}" target="_blank"><img src="{{asset($footer_logo)}}" class="logo" alt="Logo" width="50%"></a>
                                        @endif
                                        <div id="msg_1">&nbsp;</div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Footer Text Under Logo :</label>
                                        <input type="text" name="footer_text_under_logo" id="footer_text_under_logo" title="enter Footer Text Under Logo!" class="district-input-field form-control" placeholder="Footer Text Under Logo"
                                            value="{{old('footer_text_under_logo',$footer_text_under_logo)}}" required >
                                        <div id="msg_1">&nbsp;</div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Footer Center Column Heading :</label>
                                        <input type="text" name="footer_center_column_heading" id="footer_center_column_heading" title="enter Footer Center Column Heading!" class="district-input-field form-control" placeholder="Footer Center Column Heading"
                                            value="{{old('footer_center_column_heading',$footer_center_column_heading)}}" required >
                                        <div id="msg_1">&nbsp;</div>
                                    </div>
                                </div>                          
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Footer Last Column Heading :</label>
                                        <input type="text" name="footer_last_column_heading" id="footer_last_column_heading" title="enter Footer Last Column Heading!" class="district-input-field form-control" placeholder="Footer Last Column Heading"
                                            value="{{old('footer_last_column_heading',$footer_last_column_heading)}}" required >
                                        <div id="msg_1">&nbsp;</div>
                                    </div>
                                </div>
                            </div>


                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label><i class="fa fa-facebook"></i> Facebook Url :</label>
                                        <input type="text" name="facebook_url" id="facebook_url" title="enter Facebook Url!" class="district-input-field form-control" placeholder="Facebook Url"
                                            value="{{old('facebook_url',$facebook_url ?? '')}}"  >
                                        <div id="msg_1">&nbsp;</div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label><i class="fa fa-instagram"></i> instagram Url :</label>
                                        <input type="text" name="instagram_url" id="instagram_url" title="enter Instagram Url!" class="district-input-field form-control" placeholder="Instagram Url"
                                            value="{{old('instagram_url',$instagram_url ?? '')}}"  >
                                        <div id="msg_1">&nbsp;</div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label><i class="fa fa-twitter"></i> Twitter (X) Url :</label>
                                        <input type="text" name="twitter_url" id="twitter_url" title="enter Twitter (X) Url!" class="district-input-field form-control" placeholder="Twitter (X) Url"
                                            value="{{old('twitter_url',$twitter_url ?? '')}}"  >
                                        <div id="msg_1">&nbsp;</div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label><i class="fa fa-youtube"></i> Youtube Url :</label>
                                        <input type="text" name="youtube_url" id="youtube_url" title="enter Youtube Url!" class="district-input-field form-control" placeholder="Youtube Url"
                                            value="{{old('youtube_url',$youtube_url ?? '')}}"  >
                                        <div id="msg_1">&nbsp;</div>
                                    </div>
                                </div>
                            </div>

                            


                            

                            
                            
                        <div class="row">
                            <div class="form-group">
                                <label>Copy Right Text :</label>
                                <input type="text" name="copy_right_text" id="copy_right_text" title="enter Copy Right Text!" class="district-input-field form-control" placeholder="Copy Right Text"
                                       value="{{old('copy_right_text',$copy_right_text)}}" required >
                                <div id="msg_1">&nbsp;</div>
                            </div>
                        </div>
                            <div class="row">
                                <div class="form-group">
                                    <label>Date Format :</label>
                                    <select  name="global_date_format" id="global_date_format" class="district-input-field form-control" placeholder="Ex: "
                                            required >
                                            <option value="d-M-Y" {!! old('global_date_format',$global_date_format) == 'd-M-Y' ? 'selected' : '' !!}>d-M-Y (13-Dec-2023)</option>
                                            <option value="d M Y" {!! old('global_date_format',$global_date_format) == 'd M Y' ? 'selected' : '' !!}>d M Y (13 Dec 2023)</option>
                                            <option value="M-d-Y" {!! old('global_date_format',$global_date_format) == 'M-d-Y' ? 'selected' : '' !!}>M-d-Y (Dec-13-2023)</option>
                                            <option value="Y-M-d" {!! old('global_date_format',$global_date_format) == 'Y-M-d' ? 'selected' : '' !!}>Y-M-d (2023-Dec-13)</option>
                                            <option value="D, M d, Y" {!! old('global_date_format',$global_date_format) == 'D, M d, Y' ? 'selected' : '' !!}>D, M d, Y (Wed, Dec 13, 2023)</option>
                                        </select>
                                    <div id="msg_1">&nbsp;</div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group">
                                    <label class="form-label">Head Scripts:</label>
                                    <textarea name="head_scripts" id="head_scripts" class="form-control" >{{old('head_scripts',$head_scripts)}}</textarea>
                                </div>
                            </div>

                            <div class="row mt-5">
                                <div class="Create-district-btn">
                                    <button type="submit" href="javascript:void(0);" id="btn_save" class="btn  btn-success">
                                        Save
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
    
@endsection


