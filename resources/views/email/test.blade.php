<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>NPC | Reset Password Link</title>

    <!--  ======= Bootstrap CSS  ========  -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" rel="stylesheet">
    <link href="{!! asset('public/assets/css/bootstrap.min.css') !!}" rel="stylesheet">
    <link href="{!! asset('public/assets/css/animate.css') !!}" rel="stylesheet">
    <link href="{!! asset('public/assets/css/style.css') !!}" rel="stylesheet">
    <style>
        .athlete-application {
            display: flex;
            height: 50vh;
            flex-direction: column;
            justify-content: center;
        }
    </style>
</head>
<body id="registration">
<div class="inner-page-banner" style="background: url('{!! asset('public/assets/images/rigestration-background.png') !!}'); height: 100vh;">
    <div id="main_header" class="main-header inner-page-header">
        <div class="container">
            <div class="logo">
                <a href="{!! url('/') !!}"><img src="{!! asset('public/assets/images/logo-white.png') !!}" class="logo" alt="Logo"></a>
            </div>
            <div class="header-text-area">
                <a href="{!! url('/') !!}">
                    <h1>National Physique Committee
                        of the U.S.A., Inc.
                    </h1>
                </a>
            </div>
        </div>
    </div>
    <div class="athlete-application">
        <div class="athlete-application-content">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-xs-offset-2 col-xs-6">
                        @if (session('message'))
                            <div class="alert alert-success" role="alert">
                                <strong>{{ session('message') }}</strong>
                            </div>
                        @endif
                        @if (session('error'))
                            <div class="alert alert-danger" role="alert">
                                <strong>{{ session('error') }}</strong>
                            </div>
                        @endif

                        <div class="card">
                            <h1 class="card-header">{{ __('Reset Password') }}</h1>
                            <div class="card-body" style="padding-top: 30px;">
                                <form method="POST" action="{{ route('password.email') }}" aria-label="{{ __('Reset Password') }}">
                                    @csrf
                                    <div class="form-group">
                                        <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" placeholder="E-Mail Address" required>
                                        @if ($errors->has('email'))
                                            <span class="invalid-feedback" role="alert"><strong>{{ $errors->first('email') }}</strong></span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary" style="border: none !important;font-size: 16px;padding: 10px;">{{ __('Send Password Reset Link') }}</button>
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
</body>
</html>




<!DOCTYPE html>
<html>
<meta charset="utf-8">
<title>NPC Verify Email</title>
<head>
</head>

<body>
<h2>Dear {!! $request->email !!}!</h2>

<P>Please click on the below link to reset password for your account.</P>

<a href='{{ route("password.reset",$token) }}'>Reset Password</a>
</body>

</html>



{{----}}

<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>NPC | Reset Password</title>

    <!--  ======= Bootstrap CSS  ========  -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" rel="stylesheet">
    <link href="{!! asset('public/assets/css/bootstrap.min.css') !!}" rel="stylesheet">
    <link href="{!! asset('public/assets/css/animate.css') !!}" rel="stylesheet">
    <link href="{!! asset('public/assets/css/style.css') !!}" rel="stylesheet">
    <style>
        .athlete-application {
            display: flex;
            height: 50vh;
            flex-direction: column;
            justify-content: center;
        }
    </style>
</head>
<body id="registration">
<div class="inner-page-banner" style="background: url('{!! asset('public/assets/images/rigestration-background.png') !!}'); height: 100vh;">
    <div id="main_header" class="main-header inner-page-header">
        <div class="container">
            <div class="logo">
                <a href="{!! url('/') !!}"><img src="{!! asset('public/assets/images/logo.png') !!}" class="logo" alt="Logo"></a>
            </div>
            <div class="header-text-area">
                <a href="{!! url('/') !!}">
                    <h1>National Physique Committee
                        of the U.S.A., Inc.
                    </h1>
                </a>
            </div>
        </div>
    </div>
    <div class="athlete-application">
        <div class="athlete-application-content">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-xs-offset-2 col-xs-6">
                        <div class="card">
                            <h1 class="card-header">{{ __('Reset Password') }}</h1>
                            <div class="card-body" style="padding-top: 30px;">
                                <form method="POST" action="{{ route('password.update') }}" aria-label="{{ __('Reset Password') }}">
                                    @csrf
                                    <input type="hidden" name="token" value="{!! $token !!}">
                                    <div class="form-group">
                                        <lable class="form-label-stripped pull-left">Email</lable>
                                        <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ $email ?? old('email') }}" placeholder="E-mail Address" required autofocus>
                                        @if ($errors->has('email'))
                                            <span class="invalid-feedback" role="alert"><strong>{{ $errors->first('email') }}</strong></span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <lable class="form-label-stripped pull-left">Password</lable>
                                        <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password"  placeholder="Password" required>
                                        @if ($errors->has('password'))
                                            <span class="invalid-feedback" role="alert"><strong>{{ $errors->first('password') }}</strong></span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <lable class="form-label-stripped pull-left">Confirm Password</lable>
                                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="Confirm Password" required>
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary" style="border: none!important;font-size: 16px;padding: 10px">{{ __('Reset Password') }}</button>
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
</body>
</html>


{{----}}
{{----}}
{{----}}

<div class="row">
    <div class="col-xs-12">
        <div class="district-form-content">
            @if(session('message'))
                <div class="alert alert-danger">
                    <strong>{!! session('message') !!}</strong>
                </div>
            @endif
            <form class="district-fields" method="POST" action="{{url('admin/modules/registration_fee')}}">
                {{ csrf_field() }}
                <div class="form-group">
                    <label>Name :</label>
                    <input type="text" name="txt_registration_fee_name" value="{!! old('txt_registration_fee_name') !!}" class="district-input-field" required >
                </div>

                <div class="form-group">
                    <label>Year :</label>
                    <select name="txt_registration_year" id="txt_registration_year" class="district-input-field" required>
                        <option value="">select registration year</option>
                        @for($i = (int)date('Y'); $i < (int)date('Y') + 6; $i++)
                            <option value="{!! $i !!}" {!! old('txt_registration_year') == $i ? 'selected' : '' !!}>{!! $i !!}</option>
                        @endfor
                    </select>
                </div>

                <div class="form-group">
                    <label>Fee :</label>
                    <input type="number" min="1" name="txt_registration_fee" value="{!! old('txt_registration_fee') !!}" class="number_arrow district-input-field" required >
                </div>

                <div class="form-group custom-modules-radio-field">
                    <label>Is Athlete? :</label>
                    <div class="district-active-radio-field">
                        <div class="d-radio">
                            <input type="radio" name="is_athlete_radio" value="yes" id="is_athlete_radio" {!! old('is_athlete_radio') == 'yes' ? 'checked' : '' !!}>Yes</input>
                        </div>
                        <div class="d-radio">
                            <input type="radio" name="is_athlete_radio" value="no" id="is_athlete_radio" checked {!! old('is_athlete_radio') == 'no' ? 'checked' : '' !!} >No</input>
                        </div>
                    </div>
                </div>

                <div class="form-group custom-modules-radio-field">
                    <label>Is Non-Athlete? :</label>
                    <div class="district-active-radio-field">
                        <div class="d-radio">
                            <input type="radio" name="is_non_athlete_radio" value="yes" id="is_non_athlete_radio"  {!! old('is_non_athlete_radio') == 'yes' ? 'checked' : '' !!}>Yes</input>
                        </div>
                        <div class="d-radio">
                            <input type="radio" name="is_non_athlete_radio" value="no" id="is_non_athlete_radio"  checked {!! old('is_non_athlete_radio') == 'no' ? 'checked' : '' !!} >No</input>
                        </div>
                    </div>
                </div>

                <div class="form-group custom-modules-radio-field">
                    <label>Is Pro-Athlete? :</label>
                    <div class="district-active-radio-field">
                        <div class="d-radio">
                            <input type="radio" name="is_pro_athlete_radio" value="yes" id="is_pro_athlete_radio" {!! old('is_pro_athlete_radio') == 'yes' ? 'checked' : '' !!}>Yes</input>
                        </div>
                        <div class="d-radio">
                            <input type="radio" name="is_pro_athlete_radio" value="no" id="is_pro_athlete_radio"  checked {!! old('is_pro_athlete_radio') == 'no' ? 'checked' : '' !!}>No</input>
                        </div>
                    </div>
                </div>

                <div class="form-group custom-modules-radio-field">
                    <label>Active? :</label>
                    <div class="district-active-radio-field">
                        <div class="d-radio">
                            <input type="radio" name="radio_active" value="yes"class="" id="radio_active" checked required>Yes</input>
                        </div>
                        <div class="d-radio">
                            <input type="radio" name="radio_active" value="no" id="radio_active" required>No</input>
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

{{----}}


<form class="district-fields" method="POST" action='{{ url("admin/modules/registration_fee/{$Registration_fee->id}") }}'>
    {{ method_field('PUT') }} {{ csrf_field() }}
    <div class="form-group">
        <label>Name :</label>
        <input type="text" name="txt_registration_fee_name" class="district-input-field" value= "{{ old('txt_registration_fee_name') ? old('txt_registration_fee_name') :$Registration_fee->name}}" required >
    </div>
    <div class="form-group">
        <label>Year :</label>
        <select name="txt_registration_year" id="txt_registration_year" class="district-input-field" required>
            <option value="">select registration year</option>
            @for($i = (int)date('Y'); $i < (int)date('Y') + 6; $i++)
                <option value="{!! $i !!}" {!! old('txt_registration_year') == $i ? 'selected' : ($Registration_fee->year == $i) ? 'selected' : '' !!}>{!! $i !!}</option>
            @endfor
        </select>
    </div>
    <div class="form-group">
        <label>Fee :</label>
        <input type="number" min="1" name="txt_registration_fee" class="number_arrow district-input-field" value= "{{ old('txt_registration_fee') ? old('txt_registration_fee') : $Registration_fee->fee }}" required >
    </div>

    <div class="form-group custom-modules-radio-field">
        <label>Is Athlete? :</label>
        <div class="district-active-radio-field">
            <div class="d-radio">
                <input type="radio" name="is_athlete_radio" value="yes" class="" id="is_athlete_radio"
                <?php
                    if(old('is_athlete_radio') == "yes"){
                        echo "checked";
                    }
                    elseif($Registration_fee->is_athlete_active == "yes"){
                        echo "checked";
                    }
                    ?>
                >Yes</input>
            </div>
            <div class="d-radio">
                <input type="radio" name="is_athlete_radio" value="no" id="is_athlete_radio"
                <?php
                    if(old('is_athlete_radio') == "no"){
                        echo "checked";
                    }
                    elseif($Registration_fee->is_athlete_active == "no"){
                        echo "checked";
                    }
                    ?>
                >No</input>
            </div>
        </div>
    </div>

    <div class="form-group custom-modules-radio-field">
        <label>Is Non-Athlete? :</label>
        <div class="district-active-radio-field">
            <div class="d-radio">
                <input type="radio" name="is_non_athlete_radio" value="yes" class="" id="is_non_athlete_radio"
                <?php if($Registration_fee->is_non_athlete_active == "yes"){ echo "checked"; }?> >Yes</input>
            </div>
            <div class="d-radio">
                <input type="radio" name="is_non_athlete_radio" value="no" id="is_non_athlete_radio"
                <?php if($Registration_fee->is_non_athlete_active == "no"){ echo "checked"; }?>>No</input>
            </div>
        </div>
    </div>

    <div class="form-group custom-modules-radio-field">
        <label>Is Pro-Athlete? :</label>
        <div class="district-active-radio-field">
            <div class="d-radio">
                <input type="radio" name="is_pro_athlete_radio" value="yes" class="" id="is_pro_athlete_radio"
                <?php if($Registration_fee->is_pro_athlete_active == "yes"){ echo "checked"; }?> >Yes</input>
            </div>
            <div class="d-radio">
                <input type="radio" name="is_pro_athlete_radio" value="no" id="is_pro_athlete_radio"
                <?php if($Registration_fee->is_pro_athlete_active== "no"){ echo "checked"; }?> >No</input>
            </div>
        </div>
    </div>

    <div class="form-group custom-modules-radio-field" >
        <label>Active? :</label>
        <div class="district-active-radio-field">
            <div class="d-radio">
                <input type="radio" name="radio_active" value="yes" class="" id="radio_active" required
                <?php if($Registration_fee->active == "yes"){ echo "checked"; }?> >Yes</input>
            </div>
            <div class="d-radio">
                <input type="radio" name="radio_active" value="no" id="radio_active" required
                <?php if($Registration_fee->active == "no"){ echo "checked"; }?>  >No</input>
            </div>
        </div>
    </div>

    <div class="Create-district-btn">
        <button type="submit" href="javascript:void(0);" id="btn_save" class="btn enableOnInput3"> Update</button>
    </div>
</form>
