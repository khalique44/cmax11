@extends('layouts.admin')

@section('content')

    <div class="right-side-section">
        <div class="right-section-content">
            <div class="admin-sec-btn-area">
                <div class="report-title-section">
                    <h4>Import Users</h4>
                </div>
                <div class="district-back-del-btn-area">
                    <div class="distrcit-back-btn">
                        <div class="district-back-del-btn-area">
                            <a href="{{url('admin/')}}" data-toggle="" data-target="#search-db-model"  class="btn">Back</a>
                        </div>
                    </div>
                </div>
            </div>
            <!--  ===============================  -->
            <!--  ==== User Import        =======  -->
            <!--  ===============================  -->
            @include("layouts.partials.messages")
            <div class="row">
                <div class="col-xs-12">
                    <div class="district-form-content">
                        <form class="district-fields" method="POST" action='{{ route("admin.import-users")}}' enctype="multipart/form-data">
                            {{method_field('POST')}}
                            {{csrf_field()}}
                            <div class="form-group">
                                <label>Select .csv file :</label>
                                <input type="file" name="file" id="file" class="district-input-field" required>
                            </div>
                            <div class="Create-district-btn" style="text-align: end;">
                                <button type="submit" href="javascript:void(0);" id="btn_save" class="btn enableOnInput3">
                                    Import
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function () {

            $('.fade').css('opacity',1);
        });
    </script>
@endsection

