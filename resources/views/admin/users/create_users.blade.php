@extends('layouts.admin')

@section('content')

    <div class="right-side-section">
        <div class="right-section-content">
            <div class="admin-sec-btn-area">
                <div class="report-title-section">
                    <h4>{{__('Create New User')}}</h4>
                </div>
                <div class="district-back-del-btn-area">
                    <div class="distrcit-back-btn">
                        <div class="district-back-del-btn-area">
                            <a href="{{url('admin/users')}}" data-toggle="" data-target="#search-db-model"  class="btn">Back</a>
                        </div>
                    </div>
                </div>
            </div>
            <!--  ===============================  -->
            <!--  ==== User Update        =======  -->
            <!--  ===============================  -->

            @if ($errors->any())
                <div class="alert alert-danger">
                    Please remove the following errors.
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
                        <form class="district-fields" method="POST" action='{{ url("/admin/store/users")}}'>
                            {{method_field('POST')}}
                            {{csrf_field()}}

                            <div class="form-group custom-select">
                                <label>Type:</label>
                                <select class="{{ $errors->has('type') ? ' is-invalid' : '' }} district-input-field form-control usertype"  onchange="TypeOnChange(this.value)" name="type" required>
                                    <option value="">-- Select Type --</option>
                                    <option value="admin" >Admin</option>
                                    <option value="member" >Member</option>
                                    <option value="vendor" >Vendor</option>
                                </select>
                                @if ($errors->has('type'))
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('type') }}</strong>
                                        </span>
                                @endif
                                <div id="msg__50">&nbsp;</div>
                            </div>

                            <div class="form-group hidden select_apartment_area custom-select">
                                <label>Select Apartment:</label>
                                <select class="{{ $errors->has('type') ? ' is-invalid' : '' }} district-input-field form-control select_apartment"   name="apartment_id" >
                                    <option value="">-- Select Apartment --</option>
                                    @if (!empty($apartments) )
                                    @foreach($apartments as $key => $apartment)
                                    <option value="{{ $apartment->id }}" >{{ $apartment->apartment_id }}</option>
                                    @endforeach
                                    @endif                                    

                                </select>
                                @if ($errors->has('apartment_id'))
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('apartment_id') }}</strong>
                                        </span>
                                @endif
                                
                            </div>

                            <div class="form-group">
                                <label>First Name :</label>
                                <input type="text" name="first_name" id="first_name" title="enter first name!" class="{{ $errors->has('first_name') ? ' is-invalid' : '' }} district-input-field form-control" placeholder="First Name"
                                       value="{{ old('first_name') }}" required>
                                @if ($errors->has('first_name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('first_name') }}</strong>
                                    </span>
                                @endif
                                <div id="msg_1">&nbsp;</div>
                            </div>
                            <div class="form-group">
                                <label>Last Name :</label>
                                <input type="text" name="last_name" id="last_name" title="enter last name!" class="{{ $errors->has('last_name') ? ' is-invalid' : '' }} district-input-field form-control" placeholder="Last Name"
                                       value="{{ old('last_name') }}" required>
                                @if ($errors->has('last_name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('last_name') }}</strong>
                                    </span>
                                @endif
                                <div id="msg_2">&nbsp;</div>
                            </div>
                            <div class="form-group hidden">
                                <label>Username :</label>
                                <input type="text" id="username" title="Username!" name="username" class="district-input-field form-control" placeholder="Username" value="{{ old('username') }}" >
                                <div id="msg_3">&nbsp;</div>
                            </div>
                            <div class="form-group">
                                <label>Email :</label>
                                <input type="email" id="email" title="Email!" name="email" class="district-input-field form-control" placeholder="Email" value="{{ old('email') }}" required>
                                <div id="msg_2">&nbsp;</div>
                            </div>
                            <div class="form-group">
                                <label>Phone :</label>
                                <input type="text" name="phone" id="phone_number" title="enter phone number!" class="{{ $errors->has('phone') ? ' is-invalid' : '' }} district-input-field form-control" placeholder="Phone Number"
                                       value="{{ old('phone') }}" required>
                                @if ($errors->has('phone'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('phone') }}</strong>
                                    </span>
                                @endif
                                <div id="msg_9">&nbsp;</div>
                            </div>
                            <div class="form-group">
                                <label>Mobile Number :</label>
                                <input type="text" name="mobile_number" id="mobile_number" title="enter Mobile Number!" class="{{ $errors->has('mobile_number') ? ' is-invalid' : '' }} district-input-field form-control" placeholder="Mobile Number"
                                       value="{{ old('mobile_number') }}" required>
                                @if ($errors->has('mobile_number'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('mobile_number') }}</strong>
                                    </span>
                                @endif
                                <div id="msg_4">&nbsp;</div>
                            </div>
                            <div class="form-group">
                                <label>Whatsapp Number :</label>
                                <input type="text" name="whatsapp_number" id="whatsapp_number" title="enter Whatsapp Number!" class="{{ $errors->has('whatsapp_number') ? ' is-invalid' : '' }} district-input-field form-control" placeholder="Whatsapp Number"
                                       value="{{ old('whatsapp_number') }}">
                                @if ($errors->has('whatsapp_number'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('whatsapp_number') }}</strong>
                                    </span>
                                @endif
                                <div id="msg_5">&nbsp;</div>
                            </div>
                            <div class="form-group">
                                <label>Password :</label>
                                <input type="password" name="password" id="password" title="enter password !" class="{{ $errors->has('password') ? ' is-invalid' : '' }} district-input-field form-control" placeholder="password" required>
                                <div id="msg_6">&nbsp;</div>
                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label>Confirm Password :</label>
                                <input type="password" name="password_confirmation" id="password_confirmation" title="enter password !" class="{{ $errors->has('password_confirmation') ? ' is-invalid' : '' }} district-input-field form-control" placeholder="password" required>
                                @if ($errors->has('password_confirmation'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                                @endif
                                <div id="msg_6">&nbsp;</div>
                            </div>
                            
                            <div class="form-group">
                                <label for="gender">Gender :</label>
                                <select name="gender" id="gender" title="Select Gender!" class="{{ $errors->has('gender') ? ' is-invalid' : '' }} district-input-field form-control" required>
                                    <option value="male">Male</option>
                                    <option value="female">Female</option>
                                </select>
                                @if ($errors->has('gender'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('gender') }}</strong>
                                    </span>
                                @endif
                                <div id="msg_5">&nbsp;</div>
                            </div>
                            
                            
                           
                            <div class="Create-district-btn">
                                <button type="submit" href="javascript:void(0);" id="btn_save" class="btn enableOnInput3">
                                    Create
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>

        $(document).on("change", "select.select_apartment", function(e){

            var apartment_id = $('select.select_apartment option:selected').text();

            if($("select.usertype").val() == 'member'){
                //console.log('apartment_id:',apartment_id)
                $("#username").val(apartment_id);

            }else{

                $("#username").val(''); 
            }
            

        });
        

        function TypeOnChange(type) {
            //alert(type);
            if(type == "member"){
                $('.select_apartment_area').removeClass("hidden");
                
            }else{
                $('.select_apartment_area').addClass("hidden");
               
            }
        }

        function DropDownGetStatesPlusYears(countryID)
        {
            //alert(countryID);
            if(countryID)
            {
                $.ajax({
                    type:"GET",
                    url:"{{url('getstatelist')}}?countryid="+countryID,
                    success:function(res)
                    {
                        //alert(res);
                        if(res)
                        {
                            $("#sel_state").empty();
                            $("#sel_state").append('<option value="" selected>State/Province</option>');
                            $.each(res,function(key,value){
                                $("#sel_state").append('<option value="'+key+'">'+value+'</option> selected');
                            });

                            $.ajax({
                                type:"GET",
                                url:"{{url('getyearslist')}}?countryid="+countryID,
                                success:function(res1)
                                {
                                    //console.log(res1);
                                    if(res1)
                                    {
                                        if($("#registration_year").length>0){
                                            $("#registration_year").empty();
                                            $("#registration_year").append('<option value="" selected>Select Year</option>');
                                            $.each(res1,function(key,value){
                                                $("#registration_year").append('<option value="'+value+'">'+value+'</option> selected');
                                            });
                                        }
                                    }else{
                                        $("#registration_year").empty();
                                    }
                                }
                            });
                        }
                        else
                        {
                            $("#sel_state").empty();
                        }
                    }
                });
            }
            else
            {
                $("#state").empty();
                $("#sel_state").empty();
                $("#sel_state").append('<option value="" selected>State/Province</option>');
                $("#sel_district").empty();
                $("#sel_district").append('<option value="" selected>Select District</option>');
            }
        }

    </script>
@endsection

