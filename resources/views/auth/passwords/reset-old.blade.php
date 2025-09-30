@extends('layouts.athlete')

@section('content')
    <div class="inner-page-banner blue-bg">
        <div id="main_header" class="main-header inner-page-header athlete-page-header">
            <div class="container">
                <div class="logo">
                    <a href="{{ url('/') }}"><img src="{!! url('public/assets/images/logo-white.png') !!}" class="logo" alt="Logo"></a>
                </div>
                <div class="header-text-area">
                    <a href="{{ url('/') }}">
                        <h1>National Physique Committee Worldwide.
                        </h1>
                    </a>
                </div>
            </div>
        </div>
        <div class="athlete-application">
            <div class="athlete-application-content">
                <div class="title">
                    <h3>Reset Password</h3>
                </div>
                <div class="athlete-application-form-sec">
                    <div class="row">
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
                        <div class="col-sm-12">
                            <div class="login-content" style="margin-left: 175px;">

                                <form method="POST" action="{{ route('password.update') }}" aria-label="{{ __('Reset Password') }}">
                                    @csrf
                                    <input type="hidden" name="token" value="{{ $token }}">

                                    <div class="form-group">
                                    </div>
                                    {{--<div class="form-group">
                                        <lable class="form-label-stripped pull-left">Email</lable>
                                        <input id="email" type="email" class="{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" placeholder="E-Mail Address" required>
                                        @if ($errors->has('email'))
                                            <span class="invalid-feedback" role="alert"><strong style="color:red;">{{ $errors->first('email') }}</strong></span>
                                        @endif
                                    </div>--}}
                                    @php
                                        $user_email = decrypt($email);
                                    @endphp
                                    <input type="hidden" name="email" value="{{ $user_email }}">
                                    @if ($errors->has('email'))
                                        <span class="invalid-feedback" role="alert"><strong style="color:red;">{{ $errors->first('email') }}</strong></span>
                                    @endif
                                    <div class="form-group">
                                        <lable class="form-label-stripped pull-left" style="font-weight: bold;">Password</lable>
                                        <input id="password" title="Enter your password" type="password" class="{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required autofocus>

                                        @if ($errors->has('password'))
                                            <span class="invalid-feedback" role="alert">
                                        <strong style="color:red;">{{ $errors->first('password') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <lable class="form-label-stripped pull-left" style="font-weight: bold;">Confirm Password</lable>
                                        <input id="password-confirm" title="Enter password again" type="password" class="{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password_confirmation" required autofocus>
                                    </div>

                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary" style="border: none !important;font-size: 16px;padding: 10px;">{{ __('Reset Password') }}</button>
                                    </div>
                                    <div class="rules-and-regulation-links">
                                        <a href="http://npcnewsonline.com/rules/" target="_blank"> RULES AND REGULATIONS</a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="rules-description">
            <p>Registration with NPC does not limit or restrict an NPC athlete's ability to participate in other amateur bodybuilding organizations' events.</p>
            <p>The Administrative Officers shall have the right to suspend, for a definite or indefinite period of time or to expel an athlete member of the corporation when such person by action tends to damage or impair the objectives, programs, or ideals of the corporation.</p>
        </div>
    </div>
@endsection
