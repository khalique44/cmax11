@extends('layouts.admin')

@section('content')
    <div class="right-side-section">
        <div class="right-section-content">
            <div class="admin-sec-btn-area">
                <div class="report-title-section">
                    <h4>All Users</h4>
                </div>
                <div class="database-btn">
                    <a href="{{ route('admin.imported-users') }}" data-toggle="" data-target="#search-db-model"  class="BE-btn">Imported Users</a>
                    <a href="{{ route('admin.import-users') }}" data-toggle="" data-target="#search-db-model"  class="BE-btn">Import Users</a>
                    <a href="" data-toggle="modal" data-target="#search-db-model"  class="BE-btn">Search Database</a>
                    <a href="{{ route('admin.dashboard') }}" class="BE-btn"> Clear</a>
                    <a href="{{url('admin/users/create')}}" data-toggle="" data-target="#search-db-model"  class="BE-btn">Add User</a>
                </div>
            </div>
            <span><b>Search Criteria:</b></span>

            @include('layouts.partials.messages')
            <div class="database-table-section">
                <div class="db-table-content table-responsive">
                    <!-- Main Table Start-->
                    <table id="tbl_main_users" class="display" style="width:185%">
                        <thead>
                        <tr>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Email</th>
                            <th>Type</th>
                            <th>Registration Type</th>
                            <th>Country</th>
                            <th>City</th>
                            <th>State</th>
                            <th>Address</th>
                            <th>Created By</th>
                            <th>Verified</th>
                            <th>Payment Status</th>
                            <th style="width: 327px;">Action</th>
                        </tr>
                        </thead>

                    </table>
                </div>
            </div>
        </div>
    </div>

    <!--  ===============================  -->
    <!--  ======= Main Banner ===========  -->
    <!--  ===============================  -->

    <div class="Search-bd-alert-model">
        <div class="modal fade" id="search-db-model" tabindex="-1" role="dialog" aria-labelledby="advancePicksAlertLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <div class="title">
                            <h4>SEARCH DATABASE</h4>
                        </div>
                    </div>
                    <div class="modal-body">
                        <div class="modal-inner-content">
                            <div class="db-credentials">
                                <form action="">
                                    <div class="form-group">
                                        <label>Country</label>
                                        <div class="districts-menu">
                                            <div class="dropdown">
                                                <select name="sel_country" class="btn btn-secondary dropdown-toggle" id="sel_country" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" placeholder="Select by country"
                                                        onchange="DropDownGetStates(this.value)">
                                                    <div class="dropdown-menu" aria-labelledby="">
                                                        <option value="" selected >Select Country</option>
                                                        <?php
                                                        $country = $countries->where('short_name', 'US')->first();
                                                        //echo '<option value="'.$country->id.'" data-id="'.$country->id.'"'.($sel_country == $country->id ? "selected class=\"active\"" : "").'>'.$country->name.'</option>';
                                                        $country = $countries->where('short_name', 'CA')->first();
                                                        //echo '<option value="'.$country->id.'" data-id="'.$country->id.'"'.($sel_country == $country->id ? "selected class=\"active\"" : "").'>'.$country->name.'</option>';

                                                        foreach($countries as $country){
                                                            //if(!in_array($country->short_name,['CA','NZ']))
                                                                echo '<option value="'.$country->id.'" data-id="'.$country->id.'"'.($sel_country == $country->id ? "selected class=\"active\"" : "").'>'.$country->name.'</option>';
                                                        }
                                                        ?>
                                                    </div>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label>State</label>
                                        <div class="districts-menu">
                                            <div class="dropdown">
                                                <select name="sel_state" class="btn btn-secondary dropdown-toggle" id="sel_state" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" placeholder="Select by district"
                                                        onchange="DropDownGetDistricts(this.value)">
                                                    <div class="dropdown-menu" aria-labelledby="">
                                                        <option value="" selected>State/Province</option>
                                                        <?php
                                                        $states = \DB::table('states')->where('country_id',$sel_country)->get();
                                                        foreach($states as $state){
                                                            echo '<option value="'.$state->id.'" data-id="'.$state->id.'"'.($sel_state == $state->id ? "selected class=\"active\"" : "").'>'.$state->name.'</option>';
                                                        }
                                                        ?>
                                                    </div>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    {{--<div class="form-group">
                                        <label>District</label>
                                        <div class="districts-menu">
                                            <div class="dropdown">
                                                <select name="sel_district" class="btn btn-secondary dropdown-toggle" id="sel_district" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" placeholder="Select by district">
                                                    <option value="0" selected >Select District</option>
                                                    @php
                                                    $districts = \DB::table('districts')->where('state',$sel_state)->get();
                                                    foreach($districts as $district){
                                                        echo '<option value="'.$district->id.'" data-id="'.$district->id.'"'.($sel_district == $district->id ? "selected class=\"active\"" : "").'>'.@$district->district_name.'</option>';
                                                    }
                                                    @endphp
                                                </select>
                                            </div>
                                        </div>
                                    </div>--}}

                                    <div class="form-group">
                                        <label>Category</label>
                                        <div class="districts-menu">
                                            <div class="dropdown">
                                                <select name="sel_category" class="btn btn-secondary dropdown-toggle" id="sel_category" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" placeholder="Select by district">
                                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                        <option value="0" selected >Select Category</option>
                                                        @foreach($categories as $c_data)
                                                            <option value="{{$c_data->id}}" <?php if($sel_category == $c_data->id){ echo "selected"; }?> >{{$c_data->name}}</option>
                                                        @endforeach

                                                    </div>
                                                </select>

                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label>Year(s) Of Registration</label>
                                        <input type="number" class="backend-field" placeholder="Search by year" name="sel_year" id="sel_year" value="{{$sel_year}}">
                                    </div>

                                    <div class="form-group">
                                        <div class="opt-select">
                                            <label>Select</label>
                                            <div class="database-select-option">
                                                <input id="active" type="radio" name="sel_option" value="active"
                                                <?php if($sel_option == 'active' ){ echo "checked"; }?> >
                                                <div class="opt-title">
                                                    <h5>Active</h5>
                                                </div>
                                            </div>
                                            <div class="database-select-option">
                                                <input id="active" type="radio" name="sel_option" value="inactive"
                                                <?php if($sel_option == 'inactive' ){ echo "checked"; }?> >
                                                <div class="opt-title">
                                                    <h5>Inactive</h5>
                                                </div>
                                            </div>
                                            <div class="database-select-option">
                                                <input id="active" type="radio" name="sel_option" value="both"
                                                <?php if($sel_option == 'both' ){ echo "checked"; }?> >
                                                <div class="opt-title">
                                                    <h5>Both</h5>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="modal-btn-area">
                                            <div class="find-btn">
                                                <button type="button" href="javascript:void(0);" id="btn_admin_search_database" name="btn_admin_search_database" class="modal-btn find-btn" data-dismiss="modal">
                                                    Find
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <input type="hidden" id="is_imported_user_view" value="{{ $is_imported_user_view }}">
    <script>

        function deleteUser(Id){
            $(".data-delete-form").attr('action', "{{ url('') }}/admin/users/"+Id);
        }
        function activeUser(Id){
            $(".data-active-form").attr('action', "{{ url('') }}/admin/usersActiveUpdate/"+Id);
        }
        function inactiveUser(Id){
            $(".data-inactive-form").attr('action', "{{ url('') }}/admin/usersInActiveUpdate/"+Id);
        }
        function verifyUser(Id){
            $(".data-verify-form").attr('action', "{{ url('') }}/admin/usersVerifyUpdate/"+Id);
        }
        function sendVerificationEmailUser(Id){
            $(".data-verify-form").attr('action', "{{ url('') }}/admin/usersVerificationMailSend/"+Id);
        }

        $(document).ready(function() {

            $('#tbl_main_users').DataTable({
                processing: true,
                serverSide: true,
                ajax:{
                    url: "{{ route('admin.dashboard.get_users') }}",
                    data: function (d) {
                        d.sel_country = $('#sel_country').val();
                        d.sel_state = $('#sel_state').val();
                        d.sel_category = $('#sel_category').val();
                        d.sel_year = $('input[name=sel_year]').val();
                        d.sel_option = $('input:radio[name=sel_option]:checked').val();
                        d.is_imported_user_view = $('#is_imported_user_view').val();
                    }
                },
                columns: [
                    { data: 'first_name' },
                    { data: 'last_name' },
                    { data: 'email' },
                    { data: 'type' },
                    { data: 'user_registration_type' },
                    { data: 'country_name' },
                    { data: 'city' },
                    { data: 'state_name' },
                    { data: 'address_1' },
                    { data: 'created_by' },
                    { data: 'is_verified' },
                    { data: 'paid_status' },
                    { data: 'action' },
                ],
                pageLength: 50,
                "aLengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]]
            });

            $('#btn_admin_search_database').click(function(){
                $('#tbl_main_users').DataTable().draw(true);
                $('#search-db-model').addClass('hide-search-db');
            });

        });

        $('.alert-success').fadeIn('fast').delay(2000).fadeOut('slow');
        $('.alert-danger').fadeIn('fast').delay(2000).fadeOut('slow');

    </script>
@endsection
