@extends('layouts.admin')

@section('content')

    <div class="right-side-section">
        <div class="right-section-content">
            <div class="admin-sec-btn-area">
                <div class="report-title-section">
                    <h4>Category</h4>
                </div>
                <div class="district-back-del-btn-area">
                    <div class="distrcit-back-btn">
                        <div class="district-back-del-btn-area">
                            <button type="button" class="btn btn-danger btn_category_delete" data-toggle="modal" data-target="#DeleteConfirmationModal" data-delete-id="{{$category->id}}">
                                Delete
                            </button>
                            <a href="{{url('/admin/modules/categories')}}" data-toggle="" data-target="#search-db-model"  class="btn">Back</a>

                        </div>
                    </div>
                </div>
            </div>
            <!--  ===============================  -->
            <!--  ======= Category Update ===========  -->
            <!--  ===============================  -->

            <div class="row">
                <div class="col-xs-12">
                    <div class="district-form-content">
                        <form class="district-fields" method="POST" action="{{url('admin/modules/categories', array($category->id))}}">
                            {{method_field('PUT')}}
                            {{csrf_field()}}
                            <div class="form-group">
                                <label>Category Name :</label>
                                <input type="text" name="txt_category_name" id="txt_category_name" title="enter category name!" class="district-input-field" placeholder="Category Name"
                                       value="{{$category->name}}" required >
                                <div id="msg_1">&nbsp;</div>
                            </div>
                            <div class="form-group custom-modules-radio-field">
                                <label>Active :</label>
                                <div class="district-active-radio-field">
                                    <div class="d-radio">
                                        <input type="radio" name="radio_active" value="yes"class="" id="radio_active" required <?php if($category->active == "yes"){ echo "checked"; }?> >Yes</input>
                                    </div>
                                    <div class="d-radio">
                                        <input type="radio" name="radio_active" value="no" id="radio_active" required <?php if($category->active == "no"){ echo "checked"; }?> >No</input>
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


