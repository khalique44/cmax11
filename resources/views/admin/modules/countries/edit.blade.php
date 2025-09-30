@extends('layouts.admin')

@section('content')

    <div class="right-side-section">
        <div class="right-section-content">
            <div class="admin-sec-btn-area">
                <div class="report-title-section">
                    <h4>Country</h4>
                </div>
                <div class="district-back-del-btn-area">
                    <div class="distrcit-back-btn">
                        <div class="district-back-del-btn-area">
                            {{--<button type="button" class="btn btn-danger btn_category_delete" data-toggle="modal" data-target="#DeleteConfirmationModal" data-delete-id="{{$country->id}}">
                                Delete
                            </button>--}}
                            <a href="{{url('/admin/modules/countries')}}" data-toggle="" data-target="#search-db-model"  class="btn">Back</a>

                        </div>
                    </div>
                </div>
            </div>
            <!--  ===============================  -->
            <!--  ======= Country Update ===========  -->
            <!--  ===============================  -->

            <div class="row">
                <div class="col-xs-12">
                    <div class="district-form-content">
                        <form class="district-fields" method="POST" action="{{url('admin/modules/countries', array($country->id))}}">
                            {{method_field('PUT')}}
                            {{csrf_field()}}
                            <div class="form-group">
                                <label>Country Name :</label>
                                <input type="text" name="name" id="name" class="district-input-field" placeholder="Country Name"
                                       value="{{ $country->name }}" disabled >
                                <div id="msg_1">&nbsp;</div>
                            </div>
                            <div class="form-group custom-modules-radio-field">
                                <label>Active :</label>
                                <div class="district-active-radio-field">
                                    <div class="d-radio">
                                        <input type="radio" name="country_status" value="1" id="radio_active" required <?php if($country->active == "1"){ echo "checked"; }?> />Yes
                                    </div>
                                    <div class="d-radio">
                                        <input type="radio" name="country_status" value="0" id="radio_active" required <?php if($country->active == "0"){ echo "checked"; }?> />No
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
        $('.btn_category_delete').on('click',function () {
            var DataDeleteId = $(this).attr('data-delete-id');

            $(".data-delete-form").attr('action', "{{ url('') }}/admin/modules/categories/"+DataDeleteId);
        });
    </script>
@endsection


