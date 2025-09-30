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
                        <div class="district-back-del-btn-area">
                            <div class="district-fields">
                                <button type="button" class="btn btn-danger btn_district_delete" data-toggle="modal" data-target="#DeleteConfirmationModal" data-delete-id="{{$district->id}}">
                                    Delete
                                </button>
                            </div>
                            <a href="{{url('admin/modules/districts')}}" data-toggle="" data-target="#search-db-model"  class="btn">Back</a>
                        </div>
                    </div>
                </div>
            </div>
            <!--  ===============================  -->
            <!--  ==== Districts Update   =======  -->
            <!--  ===============================  -->

            <div class="row">
                <div class="col-xs-12">
                    <div class="district-form-content add-new-district-form">
                        <form class="district-fields" method="POST" action="{{url('/admin/modules/districts', array($district->id))}}">
                            {{method_field('PUT')}}
                            {{csrf_field()}}
                            <div class="form-group">
                                <label>District Name :</label>
                                <input type="text" name="district_name" id="txt_district_name" title="enter district name!" class="district-input-field" placeholder="District Name" required
                                       value="{{ old('district_name') ? old('district_name') : $district->district_name}}">
                                <div id="msg_1">&nbsp;</div>
                            </div>
                            <div class="form-group">
                                <label>District Number :</label>
                                <input type="number" min="1" name="district_number" id="txt_district_number" title="enter district number!" class="number_arrow district-input-field" placeholder="District Name" required
                                       value="{{ old('district_number') ? old('district_number') : $district->district_number}}">
                                <div id="msg_2">&nbsp;</div>
                            </div>
                            <div class="form-group">
                                <label>Chairman Name :</label>
                                <input type="text" name="chairman_name" id="txt_chairman_name" title="enter Chairman name!" class="district-input-field" placeholder="Chairman Name" required
                                       value="{{ old('chairman_name') ? old('chairman_name') : $district->chairman_name}}">
                                <div id="msg_3">&nbsp;</div>
                            </div>
                            <div class="form-group custom-select">
                                <label>Country :</label>
                                <select required class="district-input-field" name="country" id="sel_country" onchange="DropDownGetStates(this.value)">
                                    <option value="">-- Select --</option>
                                    <?php
                                    $country = $countries->where('short_name', 'US')->first();
                                    //echo '<option value="'.$country->id.'" data-id="'.$country->id.'"'.($district->country == $country->id ? "selected class=\"active\"" : "").'>'.$country->name.'</option>';
                                    $country = $countries->where('short_name', 'CA')->first();
                                    //echo '<option value="'.$country->id.'" data-id="'.$country->id.'"'.($district->country == $country->id ? "selected class=\"active\"" : "").'>'.$country->name.'</option>';

                                    foreach($countries as $country){
                                        //if(!in_array($country->short_name,['CA','NZ']))
                                            echo '<option value="'.$country->id.'" data-id="'.$country->id.'"'.($district->country == $country->id ? "selected class=\"active\"" : "").'>'.$country->name.'</option>';
                                    }
                                    ?>
                                </select>
                                <div id="msg_7">&nbsp;</div>
                            </div>
                            <div class="form-group">
                                <label>Zip Code From :</label>
                                <input type="number" min="1" name="zip_code_from" id="txt_zip_code_from" title="enter zip_code!" class="number_arrow district-input-field" placeholder="Zip Code From" required
                                       value="{{ old('zip_code_from') ? old('zip_code_from') : $district->zip_code_from }}">
                                <div id="msg_12">&nbsp;</div>
                            </div>
                            <div class="form-group">
                                <label>Zip Code To :</label>
                                <input type="number" min="1" name="zip_code_to" id="txt_zip_code_to" title="enter zip_code!" class="number_arrow district-input-field" placeholder="Zip Code To" required
                                       value="{{ old('zip_code_to') ? old('zip_code_to') : $district->zip_code_to }}">
                                <div id="msg_13">&nbsp;</div>
                            </div>
                            <div class="form-group">
                                <label>Active :</label>
                                <div class="district-active-radio-field">
                                    <div class="d-radio">
                                        <input type="radio" name="active" value="yes"class="" id="radio_active" required checked
                                        <?php if($district->active == "yes"){ echo "checked"; }?> >Yes</input>
                                    </div>
                                    <div class="d-radio">
                                        <input type="radio" name="active" value="no" id="radio_active" required
                                        <?php if($district->active == "no"){ echo "checked"; }?> >No</input>
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
        $('.btn_district_delete').on('click',function () {
            var DataDeleteId = $(this).attr('data-delete-id');

            $(".data-delete-form").attr('action', "{{ url('') }}/admin/modules/districts/"+DataDeleteId);
        });
    </script>

@endsection

