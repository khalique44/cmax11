<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>NPC Worldwide</title>

    <!--  ======= Bootstrap CSS  ========  -->
    <link href="{!! asset('public/assets/css/bootstrap.min.css') !!}" rel="stylesheet">
    <link href="{!! asset('public/assets/css/animate.css') !!}" rel="stylesheet">
    <link href="{!! asset('public/assets/css/style.css') !!}" rel="stylesheet">
    <link rel="shortcut icon" href="{!! url('public/assets/images/logo-npc.png') !!}" />

</head>

<body id="registration" style="background: #0054a5;min-height: 100vh;">
<div class="inner-page-banner blue-bg"  style="min-height: 100vh;">
    <div id="main_header" class="main-header inner-page-header">
        <div class="container">
            <div class="logo">
                <a href="{{ url('/') }}" style="background:none; height: auto;"><img src="{!! url('public/assets/images/logo-white.png') !!}" class="logo" alt="Logo"></a>
            </div>
            <div class="header-text-area">
                <a href="javascript:void(0);">
                    <h1>National Physique Committee Worldwide.
                    </h1>
                </a>
            </div>
        </div>
    </div>
    <div class="athlete-application">
        @if (session('message'))
            <div class="alert alert-success" role="alert">
                <strong>{{ session('message') }}</strong>
            </div>
        @endif
        <div class="athlete-application-content">
            <div class="email-verification-content">
                <p>THIS DOES NOT CONFIRM PAYMENT OR COMPLETED MEMBERSHIP. YOU MUST VERIFY YOUR EMAIL, LOGIN TO THE SITE AND THEN COMPLETE YOUR PAYMENT.</p>
                <br>
                <p>Please confirm your email <strong>"<i>{!! $user->email !!}</i>"</strong>.<br>If you did not receive an email yet, please click here to resend it.<a href="{!! url('resend-verification-mail/'.$user->remember_token) !!}" style="font-size: 20px;font-weight: 400;color: cadetblue;text-transform: none;"> Resend Email</a></p>
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
