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
                        <a href="{{url('/admin/modules/ip_restrictions')}}" data-toggle="" data-target="#search-db-model"  class="btn">Back</a>
                    </div>
                </div>
            </div>

            <!--  ===============================  -->
            <!--  ======= IP Restriction ===========  -->
            <!--  ===============================  -->

            <div class="row">
                <div class="col-xs-12">
                    <div class="district-form-content">
                        <form class="district-fields" method="POST" action="{{url('admin/modules/ip_restrictions')}}">
                            {{csrf_field()}}
                            <div class="form-group">
                                <label>IP :</label>
                                <input type="text" name="ip" id="ip" title="enter IP!" class="district-input-field" placeholder="IP" required value="{{ old('ip') }}">
                                <div id="msg_1">&nbsp;</div>
                                 @if ($errors->has('ip'))
                                    <div class="error alert alert-danger">{{ $errors->first('ip') }}</div>
                                @endif
                            </div>
                            <div class="form-group custom-select">
                                <label>Type :</label>
                                <select required class="district-input-field" name="type" id="type">                     
                                    <option value="api">API</option>
                                </select>
                                <div id="msg_2">&nbsp;</div>
                            </div>

                            <div class="form-group custom-select">
                                <label>Mode :</label>
                                <select required class="district-input-field" name="mode" id="mode">                       
                                    <option value="allowed">Allowed</option>
                                    <option value="not_allowed">Not Allowed</option>
                                </select>
                                <div id="msg_3">&nbsp;</div>
                            </div>

                            <div class="Create-district-btn" align="center">
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

