@extends('layouts.admin')

@section('content')

    <div class="right-side-section">
        <div class="right-section-content">
            <div class="admin-sec-btn-area">
                <div class="report-title-section">
                    <h4>IP Restriction</h4>
                </div>
                <div class="district-back-del-btn-area">
                    <div class="distrcit-back-btn">
                        <div class="district-back-del-btn-area">
                            <button type="button" class="btn btn-danger btn_category_delete" data-toggle="modal" data-target="#DeleteConfirmationModal" data-delete-id="{{$ip_restriction->id}}">
                                Delete
                            </button>
                            <a href="{{url('/admin/modules/ip_restrictions')}}" data-toggle="" data-target="#search-db-model"  class="btn">Back</a>

                        </div>
                    </div>
                </div>
            </div>
            <!--  ===============================  -->
            <!--  ======= ip restriction Update ===========  -->
            <!--  ===============================  -->

            <div class="row">
                <div class="col-xs-12">
                    <div class="district-form-content">
                        <form class="district-fields" method="POST" action="{{url('admin/modules/ip_restrictions', array($ip_restriction->id))}}">
                            {{method_field('PUT')}}
                            {{csrf_field()}}
                            <div class="form-group">
                                <label>IP :</label>
                                <input type="text" name="ip" id="ip" title="enter IP!" class="district-input-field" placeholder="IP"
                                       value="{{old('ip', $ip_restriction->ip)}}" required >
                                <div id="msg_1">&nbsp;</div>
                                 @if ($errors->has('ip'))
                                    <div class="error alert alert-danger">{{ $errors->first('ip') }}</div>
                                @endif
                            </div>
                            <div class="form-group custom-select">
                                <label>Type :</label>
                                <select required class="district-input-field" name="type" id="type">                     
                                    <option value="api" <?php if($ip_restriction->type == "api"){ echo "selected"; }?>>API</option>
                                </select>
                                <div id="msg_2">&nbsp;</div>
                            </div>
                            <div class="form-group custom-select">
                                <label>Mode :</label>
                                <select required class="district-input-field" name="mode" id="mode">                       
                                    <option value="allowed" <?php if($ip_restriction->mode == "allowed"){ echo "selected"; }?>>Allowed</option>
                                    <option value="not_allowed" <?php if($ip_restriction->mode == "not_allowed"){ echo "selected"; }?>>Not Allowed</option>
                                </select>
                                <div id="msg_3">&nbsp;</div>
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

            $(".data-delete-form").attr('action', "{{ url('') }}/admin/modules/ip_restrictions/"+DataDeleteId);
        });
    </script>
@endsection


