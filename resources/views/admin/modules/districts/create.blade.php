@extends('layouts.admin')

@section('content')

    <div class="right-side-section">
        <div class="right-section-content">

            <div class="admin-sec-btn-area">
                <div class="report-title-section">
                    <h4>District</h4>
                </div>
                <div class="district-back-del-btn-area">
                    <div class="distrcit-back-btn">
                        <a href="{{url('admin/modules/districts')}}" data-toggle="" data-target="#search-db-model"  class="btn"> Back</a>
                    </div>
                </div>
            </div>

            <!--  ===============================  -->
            <!--  ======= Districts Register ===========  -->
            <!--  ===============================  -->

                <div class="row">
                    <div class="col-xs-12">
                        <div class="district-form-content add-new-district-form">
                                <form class="district-fields" method="POST" action="{{url('admin/modules/districts')}}">
                                {{csrf_field()}}
                                <div class="form-group">
                                    <label>District Name :</label>
                                    <input type="text" name="district_name" id="txt_district_name" title="enter district name!" class="district-input-field" placeholder="District Name" required
                                    value="{{ old('district_name') }}">
                                    <div id="msg_1">&nbsp;</div>
                                </div>
                                <div class="form-group">
                                    <label>District Number :</label>
                                    <input type="number" min="1" name="district_number" id="txt_district_number" title="enter district number!" class="number_arrow district-input-field" placeholder="District Name" required
                                           value="{{ old('district_number') }}">
                                    <div id="msg_2">&nbsp;</div>
                                </div>
                                <div class="form-group">
                                    <label>Chairman Name :</label>
                                    <input type="text" name="chairman_name" id="txt_chairman_name" title="enter Chairman name!" class="district-input-field" placeholder="Chairman Name" required
                                           value="{{ old('chairman_name') }}">
                                    <div id="msg_3">&nbsp;</div>
                                </div>
                                {{--<div class="form-group">
                                    <label>Address 1 :</label>
                                    <input type="text" name="txt_address_1" id="txt_address_1" title="enter address 1!" class="district-input-field" placeholder="Address 1" >
                                    <div id="msg_4">&nbsp;</div>
                                </div>
                                <div class="form-group">
                                    <label>Address 2 :</label>
                                    <input type="text" name="txt_address_2" id="txt_address_2" title="enter address 2!" class="district-input-field" placeholder="Address 2" >
                                    <div id="msg_5">&nbsp;</div>
                                </div>
                                <div class="form-group">
                                    <label>City :</label>
                                    <input type="text" name="txt_city_name" id="txt_city_name" title="enter city name!" class="district-input-field" placeholder="City" >
                                    <div id="msg_6">&nbsp;</div>
                                </div>--}}
                                <div class="form-group custom-select">
                                    <label>Country :</label>
                                    <select required class="district-input-field" name="country" id="sel_country" onchange="DropDownGetStates(this.value)">
                                        <option value="">-- Select --</option>
                                        <?php
                                        $country = $countries->where('short_name', 'US')->first();
                                        //echo '<option value="'.$country->id.'" data-id="'.$country->id.'">'.$country->name.'</option>';
                                        $country = $countries->where('short_name', 'CA')->first();
                                        //echo '<option value="'.$country->id.'" data-id="'.$country->id.'">'.$country->name.'</option>';

                                        foreach($countries as $country){
                                            //if(!in_array($country->short_name,['CA','NZ']))
                                                echo '<option value="'.$country->id.'" data-id="'.$country->id.'">'.$country->name.'</option>';
                                        }
                                        ?>
                                    </select>
                                    <div id="msg_7">&nbsp;</div>

                                </div>
                                <div class="form-group">
                                    <label>Zip Code From :</label>
                                    <input type="number" min="1" name="zip_code_from" id="txt_zip_code_from" title="enter zip_code!" class="number_arrow district-input-field" placeholder="Zip Code From" required
                                    value="{{ old('zip_code_from') }}">
                                    <div id="msg_12">&nbsp;</div>
                                </div>
                                <div class="form-group">
                                    <label>Zip Code To :</label>
                                    <input type="number" min="1" name="zip_code_to" id="txt_zip_code_to" title="enter zip_code!" class="number_arrow district-input-field" placeholder="Zip Code To" required
                                    value="{{ old('zip_code_to') }}">
                                    <div id="msg_13">&nbsp;</div>
                                </div>

                                {{--<div class="form-group custom-select">
                                    <label>State :</label>
                                    <select required class="district-input-field" name="sel_state" id="sel_state">
                                        <option value="">-- Select --</option>
                                    </select>
                                    <div id="msg_8">&nbsp;</div>
                                </div>
                                <div class="form-group">
                                    <label>Zip :</label>
                                    <input type="text" name="txt_zip_code" id="txt_zip_code" title="enter zip_code!" class="district-input-field" placeholder="Zip Code" >
                                    <div id="msg_9">&nbsp;</div>
                                </div>
                                <div class="form-group">
                                    <label>Phone :</label>
                                    <input type="text" name="txt_phone_number" id="txt_phone_number" title="enter phone number!" class="district-input-field" placeholder="Phone Number" >
                                    <div id="msg_9">&nbsp;</div>
                                </div>
                                <div class="form-group">
                                    <label>Email :</label>
                                    <input type="text" name="txt_email" id="txt_email" title="enter your email!" class="district-input-field" placeholder="Email" >
                                    <div id="msg_11">&nbsp;</div>
                                </div>
                                <div class="form-group">
                                    <label>Zip Code From :</label>
                                    <input type="text" name="txt_zip_code_from" id="txt_zip_code_from" title="enter zip_code!" class="district-input-field" placeholder="Zip Code From" required >
                                    <div id="msg_12">&nbsp;</div>
                                </div>
                                <div class="form-group">
                                    <label>Zip Code To :</label>
                                    <input type="text" name="txt_zip_code_to" id="txt_zip_code_to" title="enter zip_code!" class="district-input-field" placeholder="Zip Code To" required >
                                    <div id="msg_13">&nbsp;</div>
                                </div>--}}
                                <div class="form-group">
                                    <label>Active :</label>
                                    <div class="district-active-radio-field">
                                        <div class="d-radio">
                                            <input type="radio" name="active" value="yes"class="" id="radio_active" required checked>Yes</input>
                                        </div>
                                        <div class="d-radio">
                                            <input type="radio" name="active" value="no" id="radio_active" required >No</input>
                                        </div>
                                    </div>
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
