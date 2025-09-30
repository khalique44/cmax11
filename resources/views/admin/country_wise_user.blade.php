@extends('layouts.admin')
<meta name="csrf-token" content="{{ csrf_token() }}" />
@section('content')
    <div class="right-side-section">
        <div class="right-section-content">
            <div class="admin-sec-btn-area">
                <div class="report-title-section">
                    <h4>Click to Export Database</h4>
                </div>
                <div class="database-btn" style="float: left; margin-left: 30px;">
                    {{--<a href="{{ route('admin.country_wise_user') }}" class="BE-btn"> Show User Data</a>--}}
                    <a href="" data-toggle="modal" data-target="#search-db-model"  class="BE-btn">Export Database</a>
                    {{--<a href="{{url('admin/users/create')}}" data-toggle="" data-target="#search-db-model"  class="BE-btn">Add User</a>--}}
                </div>
            </div>
			@if($errors->any())
                <div style="padding-top: 50px;">
                    <center style="color: red;">
						<h3>
                        {{$errors->first()}}
						</h3>
                    </center>
                </div>
            @endif
            <div class="database-table-section" style="display: none;">
                <div class="db-table-content table-responsive">
                    <table id="table_main_users" class="display" style="width:185%">
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
                        </tr>
                    </thead>

                    @foreach($user_country_ids as $user_country_id)
                    <tbody>
                        @php
                             $country =  \App\Country::find($user_country_id);
                            $users = \App\User::where('country',$user_country_id)->whereYear('created_at', date('Y'))->get();
                            $c = 1;
                        @endphp
                             <tr>
                                <th>{{$country->name }}</th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                            </tr>

                        @foreach($users as $user)
                            <tr>
                                <td>{{ $user->first_name }}</td>
                                <td>{{ $user->last_name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ implode(' ', array_map('ucfirst', explode('-', $user->type))) }}</td>
                                <td>{{ @$user->registration_type ? implode(' ', array_map('ucfirst', explode('_', $user->registration_type->name))) : '--' }}</td>
                                <td>{{ @$user->usercountry->name }}</td>
                                <td>{{ $user->city }}</td>
                                <td>
                                <?php
                                    $state =  \App\state::find($user->state);
                                ?>
                                    {{ $state->name }}
                                </td>
                                <td>{{ $user->address_1 }}</td>
                                <td>{{ $user->is_admin_user == 1 ? 'Admin' : '--' }}</td>
                                <td>{{ $user->is_verified == 1 ? 'Yes' : 'No' }}</td>
                                {{--<td><img style="width: 50px;max-width: 50px;" src="{{ $user->paid_status == true ? asset('public/assets/images/paid.png') : asset('public/assets/images/pending.png') }}"></td>--}}
                                @if($user->paid_status == true)
                                    <td style="color: green;">Paid</td>
                                @else
                                    <td style="color: red;">Pending</td>
                                @endif
                            </tr>
                        @endforeach

                        </tbody>
                    @endforeach

                    </table>
                </div>
            </div>


        </div>
    </div>
    <div class="Search-bd-alert-model">
        <div class="modal fade" id="search-db-model" tabindex="-1" role="dialog" aria-labelledby="advancePicksAlertLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <div class="title">
                            <h4>EXPORT DATABASE</h4>
                        </div>
                    </div>
                    <div class="modal-body">
                        <div class="modal-inner-content">
                        <div class="db-credentials">
                                <form action="{{url('admin/tasks')}}" method="POST" enctype="multipart/form-data">
                                        @csrf
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
                                                    <button type="submit" href="javascript:void(0);" name="btn_admin_search_database" class="modal-btn find-btn">
                                                        Export
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
    </div>
    <script>

$(".save-data").click(function(event){

    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
    event.preventDefault();

    var name = "munib";


    $.ajax({
      url: "{{route('tasks')}}",
      type:"POST",
      data:{
        name:name,
      },
      success:function(response){
        console.log(response);
        location.reload();
        if(response) {
          $('.success').text(response.success);
          $("#ajaxform")[0].reset();
        }
      },
     });
});

       function exportTasks(_this) {
          let _url = $(_this).data('href');
          window.location.href = _url;
       }
    </script>
    <script>
        $(document).ready(function() {



            $('.display').DataTable( {
                "processing": false,
                "serverSide": false,
                "order": [],
                "dom": 'Blfrtip',
                'pageLength':25,
                columnDefs: [
                    { targets: 'no-sort', orderable: false }
                ],
                "buttons": [
                    {
                        extend: 'csvHtml5',
                        exportOptions: {
                            columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11 ]
                        },
                    },

                ]
            });
        });
    </script>
@endsection
