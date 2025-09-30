@extends('layouts.app')

@section('content')
    <div class="index-background blue-bg">
                {{-- Top Right Language Section --}}
            @include('layouts.partials.language')
        {{-- End Top Right Language Section --}}

        <div id="main_header" class="main-header">
            <div class="container">
                <div class="logo">
                    <a href="{{ url('/') }}" style="background:none; height: auto;"><img src="{!! url('public/assets/images/NPC-WorldWide-logo-RD-WT-BL-R-v6.png') !!}" class="logo" alt="Logo"></a>
                </div>
                <div class="header-text-area">
                    <a href="javascript:void(0);">
                        <h1>National Physique Committee Worldwide.</h1>
                    </a>
                </div>
            </div>
        </div>

        <div class="login-register-section">
            <div class="container">
                <div class="row">
                    <div class="col-sm-6">
                        @if (\Session::has('success'))
                            <div class="alert alert-success">
                                <p>{{ \Session::get('success') }}</p>
                            </div><br/>
                        @endif
                        @if (\Session::has('error'))
                            <div class="alert alert-danger">
                                <p>{{ \Session::get('error') }}</p>
                            </div><br />
                        @endif
                        <div class="login-content">
                            <div class="title">
                                <h2>Login</h2>
                            </div>
                            <form method="POST" action="{{ route('login') }}" aria-label="{{ __('Login') }}">
                                @csrf
                                <div class="form-group">
                                    <input id="email" placeholder="Email" type="email" class="{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>

                                    @if ($errors->has('email'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <input id="password" type="password" placeholder="Password"
                                           class="{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                    @if ($errors->has('password'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="login-btn-area">
                                    <div class="login-btn">
                                        <button class="btn" type="submit">Enter</button>
                                    </div>
                                    <div class="caption">
                                        <a href="{!! route('password.request') !!}">I forgot my password</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="register-content">
                            <div class="title">
                                <h2>New Registration</h2>
                            </div>
                            <div class="register-btn">

                                <!-- <a href="" data-toggle="modal" data-target="#notice-model"  class="btn">Apply</a> -->
                                <a href="{!! url('register') !!}" class="btn" type="submit">Apply</a>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script type="text/javascript">
        $('.alert-success').fadeIn('fast').delay(2000).fadeOut('slow');
        $('.alert-danger').fadeIn('fast').delay(2000).fadeOut('slow');
    </script>
@endsection
