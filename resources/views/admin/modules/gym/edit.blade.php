@extends('layouts.admin')

@section('content')

    <div class="right-side-section">
        <div class="right-section-content">
            <div class="admin-sec-btn-area">
                <div class="report-title-section">
                    <h4>Gym</h4>
                </div>
                <div class="district-back-del-btn-area">
                    <div class="distrcit-back-btn">
                        <div class="district-back-del-btn-area">
                            <button type="button" class="btn btn-danger btn_gym_delete" data-toggle="modal" data-target="#DeleteConfirmationModal" data-delete-id="{{$gym->id}}">
                                Delete
                            </button>
                            <a href="{{url('admin/modules/gym')}}" data-toggle="" data-target="#search-db-model"  class="btn">Back</a>
                        </div>
                    </div>
                </div>
            </div>

            <!--  ===============================  -->
            <!--  ======= Gym Update ===========  -->
            <!--  ===============================  -->

            <div class="row">
                <div class="col-xs-12">
                    <div class="district-form-content add-new-district-form">
                        <form class="district-fields" method="POST" action='{{url("admin/modules/gym/{$gym->id}")}}'>
                            {{ method_field('PUT') }}
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label>*Gym Name :</label>
                                <input type="text" name="txt_gym_name" id="txt_gym_name" title="enter gym name!" class="district-input-field" placeholder="Gym Name" required
                                value="{{$gym->gym_name}}">
                                <div id="msg_1">&nbsp;</div>
                            </div>
                            <div class="form-group">
                                <label>Contact First Name :</label>
                                <input type="text" name="txt_contact_first_name" id="txt_contact_first_name" title="enter first name!" class="district-input-field" placeholder="First Name"
                                       value="{{$gym->contact_first_name}}">
                                <div id="msg_2">&nbsp;</div>
                            </div>
                            <div class="form-group">
                                <label>Contact Last Name :</label>
                                <input type="text" name="txt_contact_last_name" id="txt_contact_last_name" title="enter last name!" class="district-input-field" placeholder="Last Name"
                                       value="{{$gym->contact_last_name}}">
                                <div id="msg_3">&nbsp;</div>
                            </div>
                            <div class="form-group">
                                <label>Phone :</label>
                                <input type="text" name="txt_phone" id="txt_phone" title="enter phone number!" class="district-input-field" placeholder="Phone Number"
                                       value="{{$gym->phone}}">
                                <div id="msg_6">&nbsp;</div>
                            </div>
                            <div class="form-group">
                                <label>Website :</label>
                                <input type="text" name="txt_website" id="txt_website" title="enter website name!" class="district-input-field" placeholder="Website"
                                       value="{{$gym->website}}">
                                <div id="msg_6">&nbsp;</div>
                            </div>
                            <div class="form-group">
                                <label>Address 1 :</label>
                                <input type="text" name="txt_address_1" id="txt_address_1" title="enter address 1!" class="district-input-field" placeholder="Address 1"
                                       value="{{$gym->address_1}}">
                                <div id="msg_4">&nbsp;</div>
                            </div>
                            <div class="form-group">
                                <label>Address 2 :</label>
                                <input type="text" name="txt_address_2" id="txt_address_2" title="enter address 2!" class="district-input-field" placeholder="Address 2"
                                       value="{{$gym->address_2}}">
                                <div id="msg_5">&nbsp;</div>
                            </div>
                            <div class="form-group">
                                <label>City :</label>
                                <input type="text" name="txt_city_name" id="txt_city_name" title="enter city name!" class="district-input-field" placeholder="City"
                                       value="{{$gym->city}}">
                                <div id="msg_6">&nbsp;</div>
                            </div>
                            <div class="form-group custom-select">
                                <label>Country :</label>
                                <select required class="district-input-field" name="sel_country" id="sel_country" onchange="DropDownGetStates(this.value)">
                                    <option value="">-- Select --</option>
                                    <?php
                                    $country = $countries->where('short_name', 'US')->first();
                                    //echo '<option value="'.$country->id.'" data-id="'.$country->id.'"'.($gym->country == $country->id ? "selected class=\"active\"" : "").'>'.$country->name.'</option>';
                                    $country = $countries->where('short_name', 'CA')->first();
                                    //echo '<option value="'.$country->id.'" data-id="'.$country->id.'"'.($gym->country == $country->id ? "selected class=\"active\"" : "").'>'.$country->name.'</option>';

                                    foreach($countries as $country){
                                        if(!in_array($country->short_name,['CA','NZ']))
                                            echo '<option value="'.$country->id.'" data-id="'.$country->id.'"'.($gym->country == $country->id ? "selected class=\"active\"" : "").'>'.$country->name.'</option>';
                                    }
                                    ?>
                                </select>
                                <div id="msg_7">&nbsp;</div>

                            </div>
                            <div class="form-group custom-select">
                                <label>State :</label>
                                <select required class="district-input-field" name="sel_state" id="sel_state">
                                    <option value="">-- Select --</option>
                                    <?php
                                    $states = \DB::table('states')->where('country_id',$gym->country)->get();
                                    foreach($states as $state){
                                        echo '<option value="'.$state->id.'" data-id="'.$state->id.'"'.($gym->state == $state->id ? "selected class=\"active\"" : "").'>'.$state->name.'</option>';
                                    }
                                    ?>
                                </select>
                                <div id="msg_8">&nbsp;</div>
                            </div>
                            <div class="form-group">
                                <label>Zip :</label>
                                <input type="text" name="txt_zip_code" id="txt_zip_code" title="enter zip_code!" class="district-input-field" placeholder="Zip Code"
                                       value="{{$gym->zip}}">
                                <div id="msg_9">&nbsp;</div>
                            </div>
                            <div class="form-group">
                                <label>Active :</label>
                                <div class="district-active-radio-field">
                                    <div class="d-radio">
                                        <input type="radio" name="radio_active" value="yes"class="" id="radio_active" required
                                        <?php if($gym->active == "yes"){ echo "checked"; } ?> >Yes</input>
                                    </div>
                                    <div class="d-radio">
                                        <input type="radio" name="radio_active" value="no" id="radio_active" required
                                        <?php if($gym->active == "no"){ echo "checked"; } ?>>No</input>
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
        $('.btn_gym_delete').on('click',function () {
            var DataDeleteId = $(this).attr('data-delete-id');

            $(".data-delete-form").attr('action', "{{ url('') }}/admin/modules/gym/"+DataDeleteId);
        });
    </script>
@endsection
