@extends('layouts.admin')

@section('content')



    <div class="right-side-section">
        <div class="right-section-content">
            <div class="admin-sec-btn-area">
                <div class="report-title-section">
                    <h4>Membership Year Color</h4>
                </div>
                <div class="district-back-del-btn-area">
                    <div class="distrcit-back-btn">
                        <div class="district-back-del-btn-area">
                            <button type="button" class="btn btn-danger btn_membership_year_color_delete" data-toggle="modal" data-target="#DeleteConfirmationModal" data-delete-id="{{$membership_year_color->id}}">
                                Delete
                            </button>

                            <a href="{{url('admin/modules/membership_year_color')}}" data-toggle="" data-target="#search-db-model"  class="btn">Back</a></br></br>

                        </div>
                    </div>
                </div>
            </div>
            <!--  ===============================  -->
            <!--  ======= Membership-Year-Color Update ===========  -->
            <!--  ===============================  -->

            <div class="row">
                <div class="col-xs-12">
                    <div class="district-form-content">
                        <form class="district-fields" method="POST" action='{{url("admin/modules/membership_year_color/{$membership_year_color->id}")}}'>
                            {{method_field('PUT')}}
                            {{csrf_field()}}
                            <div class="form-group">
                                <label>Year :</label>
                                <input type="text" name="txt_year" id="txt_year" title="Enter year!" class="district-input-field" placeholder="Year" required
                                value="{{$membership_year_color->year}}">
                                <div id="msg_1">&nbsp;</div>
                            </div>
                            <div class="form-group">
                                <label>Color :</label>
                                <input style="width:410px; height: 37px;" type="text" name="txt_color" id="txt_color" title="Click here to choose color!" class="district-input-field" placeholder="Color" required
                                value="{{$membership_year_color->color}}">
                                <div id="msg_2">&nbsp;</div>
                            </div>

                            <div class="form-group custom-modules-radio-field">
                                <label>Active :</label>
                                <div class="district-active-radio-field">
                                    <div class="d-radio">
                                        <input type="radio" name="radio_active" value="yes"class="" id="radio_active" required
                                        <?php if($membership_year_color->active == "yes"){ echo "checked"; } ?> >Yes</input>
                                    </div>
                                    <div class="d-radio">
                                        <input type="radio" name="radio_active" value="no" id="radio_active" required
                                        <?php if($membership_year_color->active == "no"){ echo "checked"; } ?> >No</input>
                                    </div>
                                </div>
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
        $('#txt_color').minicolors();

        $('.btn_membership_year_color_delete').on('click',function () {
            var DataDeleteId = $(this).attr('data-delete-id');

            $(".data-delete-form").attr('action', "{{ url('') }}/admin/modules/membership_year_color/"+DataDeleteId);
        });
    </script>

    @endsection
