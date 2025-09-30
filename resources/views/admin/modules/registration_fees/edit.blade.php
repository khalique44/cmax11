@extends('layouts.admin')

@section('content')

    <div class="right-side-section">
        <div class="right-section-content">
            <div class="admin-sec-btn-area">
                <div class="report-title-section">
                    <h4>Registration Fee</h4>
                </div>
                <div class="district-back-del-btn-area">
                    <div class="distrcit-back-btn">
                        <div class="district-back-del-btn-area">
                            {{--<button type="button" class="btn btn-danger btn_registration_fee_delete" data-toggle="modal" data-target="#DeleteConfirmationModal" data-delete-id="{{$Registration_fee->id}}">
                                Delete
                            </button>--}}
                            <a href="{{url('admin/modules/registration_fee')}}" data-toggle="" data-target="#search-db-model"  class="btn">Back</a>
                        </div>
                    </div>
                </div>
            </div>
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            @include("layouts.partials.messages")
            <div class="row">
                <div class="col-xs-12">
                    <div class="district-form-content add-new-district-form">
                        <form class="district-fields" method="POST" action='{{ url("admin/modules/registration_fee/{$Registration_fee->id}") }}'>
                                {{csrf_field()}}
                                {{ method_field('PUT') }}
                                <div class="form-group custom-select">
                                    <label>Country :</label>
                                    <select disabled class="district-input-field" name="country_id" id="country_id">
                                        <option value="">-- Select --</option>
                                        <?php
                                        $country = $countries->where('short_name', 'US')->first();
                                        //echo '<option value="'.$country->id.'" data-id="'.$country->id.'"'.($Registration_fee->country_id == $country->id ? "selected class=\"active\"" : "").'>'.$country->name.'</option>';
                                        $country = $countries->where('short_name', 'CA')->first();
                                        //echo '<option value="'.$country->id.'" data-id="'.$country->id.'"'.($Registration_fee->country_id == $country->id ? "selected class=\"active\"" : "").'>'.$country->name.'</option>';

                                        foreach($countries as $country){
                                            //if(!in_array($country->short_name,['CA','NZ']))
                                                echo '<option value="'.$country->id.'" data-id="'.$country->id.'"'.($Registration_fee->country_id == $country->id ? "selected class=\"active\"" : "").'>'.$country->name.'</option>';
                                        }
                                        ?>
                                    </select>
                                    <div id="msg__7">&nbsp;</div>
                                </div>
                                {{--<div class="form-group">
                                    <label>Name :</label>
                                    <input type="text" name="name" value="{{ old('name') ? old('name') : $Registration_fee->name }}" class="district-input-field">
                                    <div id="msg_1">&nbsp;</div>
                                </div>--}}
                                {{--<div class="form-group custom-select">
                                    <label>Year :</label>
                                    <select name="year" id="year" class="district-input-field" required>
                                        <option value="">select registration year</option>
                                        @for($i = (int)date('Y'); $i < (int)date('Y') + 6; $i++)
                                            <option value="{!! $i !!}" {!! old('year') == $i ? 'selected' : ($Registration_fee->year == $i) ? 'selected' : '' !!}>{!! $i !!}</option>
                                        @endfor
                                    </select>
                                    <div id="msg_2">&nbsp;</div>
                                </div>--}}
                                <div class="form-group">
                                    <label>Athlete Fee :</label>
                                    <input type="number" step=any name="athlete_fee" title="enter athlete fee!" class="number_arrow district-input-field" placeholder="Athlete Fee" required
                                           value="{{ old('athlete_fee') ? old('athlete_fee') : $Registration_fee->athlete_fee }}">
                                    <div id="msg_12">&nbsp;</div>
                                </div>
                                <div class="form-group">
                                    <label>Non-Athlete Fee :</label>
                                    <input type="number" step=any name="non_athlete_fee" title="enter non-athlete fee!" class="number_arrow district-input-field" placeholder="Non-Athlete Fee" required
                                           value="{{ old('non_athlete_fee') ? old('non_athlete_fee') : $Registration_fee->non_athlete_fee }}">
                                    <div id="msg_13">&nbsp;</div>
                                </div>
                                <div class="form-group">
                                    <label>Pro-Athlete Fee :</label>
                                    <input type="number" step=any name="pro_athlete_fee" title="enter pro-athlete fee!" class="number_arrow district-input-field" placeholder="Pro-Athlete Fee" required
                                           value="{{ old('pro_athlete_fee') ? old('pro_athlete_fee') : $Registration_fee->pro_athlete_fee }}">
                                    <div id="msg_14">&nbsp;</div>
                                </div>
                                {{--<div class="form-group">
                                    <label>Active :</label>
                                    <div class="district-active-radio-field">
                                        <div class="d-radio">
                                            <input type="radio" name="active" value="yes" {{ (old('active') && old('active') == "yes") ? "checked" : $Registration_fee->active == "yes" ? "checked" : "" }}>Yes</input>
                                        </div>
                                        <div class="d-radio">
                                            <input type="radio" name="active" value="no" {{ (old('active') && old('active') == "no") ? "checked" : $Registration_fee->active == "no" ? "checked" : "" }} >No</input>
                                        </div>
                                    </div>
                                </div>--}}

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
    <script>
        $('.btn_registration_fee_delete').on('click',function () {
            var DataDeleteId = $(this).attr('data-delete-id');

            $(".data-delete-form").attr('action', "{{ url('') }}/admin/modules/registration_fee/"+DataDeleteId);
        });
    </script>
@endsection
