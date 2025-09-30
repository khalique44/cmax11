<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>NPC Worldwide</title>
    <!--  ======= Bootstrap CSS  ========  -->
    <link href="{!! url('public/assets/css/bootstrap.min.css') !!}" rel="stylesheet">
    <link href="{!! url('public/assets/css/animate.css') !!}" rel="stylesheet">
    <link href="{!! url('public/assets/css/style.css') !!}" rel="stylesheet">
    <script type='text/javascript' src='http://code.jquery.com/jquery.min.js'></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" rel="stylesheet">

    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
</head>
<body id="registration">
<div class="parallax-window main-banner" data-parallax="scroll" data-image-src="{!! url('public/assets/images/rigestration-background.png') !!}">
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
        <div class="athlete-application-content">
            {{--<div class="title">
                <h3>Congratulations</h3>
            </div>--}}
            <div class="athlete-application-form-sec">
                {{--<div class="step-progress-bar">
                    <div id="firstProgress" class="step active ">
                        <span>1</span>
                    </div>
                    <div id="firstProgressDots" class="lines"></div>
                    <div id="secondProgress" class="step">
                        <span>2</span>
                    </div>
                    <div id="secondProgressDots" class="lines"></div>
                    <div id="thirdProgress" class="step">
                        <span>3</span>
                    </div>
                    <div id="thirdProgressDots" class="lines"></div>
                    <div id="fourthProgress" class="step">
                        <span>4</span>
                    </div>
                </div>--}}
                <p>A confirmation email link has been sent to your email.click that link to activate your account</p>
            </div>
        </div>
    </div>
    <div class="rules-description">
        <br><br>
        <br>
        <p>Registration with NPC does not limit or restrict an NPC athlete's ability to participate in other amateur bodybuilding organizations' events.</p>
        <p>The Administrative Officers shall have the right to suspend, for a definite or indefinite period of time or to expel an athlete member of the corporation when such person by action tends to damage or impair the objectives, programs, or ideals of the corporation.</p>
    </div>
</div>
<!--  ===============================  -->
<!--  ======= Main Banner ===========  -->
<!--  ===============================  -->

<!-- <script type='text/javascript' src='http://code.jquery.com/jquery.min.js'></script>
 -->
{{--validate email address--}}
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.11/jquery-ui.min.js"></script>
<!-- Go to step two -->

<!-- Go to step 3 -->
<script src="{!! url('public/assets/js/jquery.js') !!}"></script>
<script src="{!! url('public/assets/js/bootstrap.min.js') !!}"></script>
<script src="{!! url('public/assets/js/parallax.js') !!}"></script>
<script src="{!! url('public/assets/js/app.js') !!}"></script>
</body>
</html>
