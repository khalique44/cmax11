<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>NPC</title>

    <!--  ======= Bootstrap CSS  ========  -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" rel="stylesheet">
    <link href="{!! asset('public/assets/css/bootstrap.min.css') !!}" rel="stylesheet">
    <link href="{!! asset('public/assets/css/animate.css') !!}" rel="stylesheet">
    <link href="{!! asset('public/assets/css/style.css') !!}" rel="stylesheet">
</head>

<body id="registration">
<div class="inner-page-banner blue-bg">
    <div id="main_header" class="main-header inner-page-header">
        <div class="container">
            <div class="logo">
                <a href="{{ url('/') }}" style="background:none; height: auto;"><img src="{!! url('public/assets/images/logo-white.png') !!}" class="logo" alt="Logo"></a>
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
            <div class="email-verification-content">
                <h1 style="font-size: 72px;">Verify Email</h1>
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
                <p>Thanks for Joining National Physique Committee. Verification email sent to <strong>"<i>{!! $user->email !!}</i>"</strong> you just need to confirm that.
                    <a href="{!! route('resend_account_verify_email') !!}" style="font-size: 20px;font-weight: 400;color: cadetblue;text-transform: none;">Resend Email</a> if didn't get.
                </p>
            </div>
        </div>
    </div>
</div>

<script src="{!! asset('public/assets/js/jquery.js') !!}"></script>
<script src="{!! asset('public/assets/js/bootstrap.min.js') !!}"></script>
<script src="{!! asset('public/assets/js/parallax.js') !!}"></script>
<script src="{!! asset('public/assets/js/app.js') !!}"></script>
</body>
</html>
