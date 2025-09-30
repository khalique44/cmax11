@extends('layouts.admin')

@section('content')

    <div class="right-side-section">
        <div class="right-section-content">
            <div class="admin-sec-btn-area">
                <div class="report-title-section">
                    <h4>Registration Fees</h4>
                </div>
                <div class="database-btn">
                    {{--<a href="{{ url('admin/modules/registration_fees/add_year') }}" data-toggle="" data-target="#search-db-model"  class="BE-btn">Add Year</a>--}}
                    {{--<a href="{{ url('admin/modules/registration_fee/create') }}" class="BE-btn">New Fee</a>--}}
                </div>
            </div>
            {{--<div class="row">
                <div class="col-xs-12 search-filter">
                    <div class="district-form-content" style="float: left;">
                        <form class="district-fields" method="GET" action='{{ url("admin/modules/registration_fee")}}'>
                            <div class="form-group custom-select">
                                <label for="category">Registration Year :</label>
                                <select class="{{ $errors->has('registration_year') ? ' is-invalid' : '' }} district-input-field" name="registration_year" id="registration_year" required>
                                    <option value="">-- Select Year --</option>
                                    @foreach($registration_years as $registration_year)
                                        <option value="{{ $registration_year->year }}" {{ ($search_year != '' && $search_year == $registration_year->year ? 'selected' : '') }}>{{ $registration_year->year }}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('registration_year'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('registration_year') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="Create-district-btn" style="float: left; padding: 0px 235px 0px 0px;">
                                <button type="submit" href="javascript:void(0);" id="btn_save" class="btn enableOnInput3">Search</button>
                                <div class="database-btn" style="float: left; padding-top: 5px;">
                                    <a href="{{ url('admin/modules/registration_fee') }}" class="BE-btn"> Clear</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>--}}
            <div class="database-table-section">
                <div class="db-table-content table-responsive">
                    <!-- Main Table Start-->
                    <table id="table_main_registration_fee" class="display" style="width:100%">
                        <thead>
                        <tr>
                            <th>Country</th>
                            <th>Athlete Fee</th>
                            <th>Non-Athlete Fee</th>
                            <th>Pro-Athlete Fee</th>
                            {{--<th>Active?</th>--}}
                        </tr>
                        </thead>
                        <tbody>

                        @foreach($registration_fee as $registration_data)
                            <tr style="cursor: pointer;" data-id="{{ $registration_data->id }}" class="registration_fee-row">

                                    <td>{{@$registration_data->country->name}}</td>
                                    <td>{{$registration_data->athlete_fee}}</td>
                                    <td>{{$registration_data->non_athlete_fee}}</td>
                                    <td>{{$registration_data->pro_athlete_fee}}</td>
                                    {{--<td>{{$registration_data->active}}</td>--}}
                            </tr>
                        @endforeach



                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

<script>
    $(document).ready(function() {
        $('#table_main_registration_fee').DataTable({
            "order": [],
            "pageLength": 100
        });
    });
</script>
@endsection

