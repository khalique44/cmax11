@extends('layouts.athlete')

@section('content')
    <div class="inner-page-banner blue-bg" style="padding-bottom:320px;">
        <div id="main_header" class="main-header inner-page-header athlete-page-header">
            <div class="container">
                <div class="logo">

                </div>
                <div class="header-text-area">
                </div>
            </div>
        </div>
        <div class="athlete-application" style="margin-top: 200px;">
            <div class="athlete-application-content">
                <div class="title">
                    <h3></h3>
                    <h3></h3>
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
                        <div class="col-sm-6">
                            <div class="login-content" style="margin-left: 175px;">

                                <form method="POST" action="{{ route('pre-login') }}">
                                    @csrf
                                    <div class="form-group">
                                        <lable class="form-label-stripped pull-left" style="font-weight: bold;">Password</lable>
                                        <input id="password" type="password" placeholder="Password"
                                               class="{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                        @if ($errors->has('password'))
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary" value="submit" style="border: none !important;font-size: 16px;padding: 10px;">{{ __('Enter') }}</button>
                                    </div>
                                    <div class="rules-and-regulation-links">

                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="rules-description">
            <p></p>
            <p></p>
            <p></p>
        </div>
    </div>
@endsection
