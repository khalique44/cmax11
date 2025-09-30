<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>NPC Worldwide</title>
 <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1" user-scalable="no">
    <link href="{!! url('public/assets/css/bootstrap.min.css') !!}" rel="stylesheet">
    <link href="{!! url('public/assets/css/animate.css')!!}" rel="stylesheet">
    <link href="{!! url('public/assets/css/style.css') !!}" rel="stylesheet">
</head>

<body id="registration">
<div class="inner-page-banner blue-bg">
    <div id="main_header" class="main-header inner-page-header membership-page">
        <div class="container">
            <div class="logo">
                <a href="{{ url('/') }}" style="background:none; height: auto;"><img src="{!! url('public/assets/images/NPC-WorldWide-logo-RD-WT-BL-R-v6.png') !!}" class="logo" alt="Logo"></a>
            </div>
            <div class="header-text-area">
                <a href="{{ url('/') }}">
                    <h1>National Physique Committee Worldwide.</h1>
                </a>
            </div>
        </div>
    </div>
    <div class="registration-select">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="registration-select-section-whole-content">
                        <div class="title">
                            <h2>New Application</h2>
                        </div>
                        <div class="registration-select-section">
                            <div class="select-section-content">
                                <div class="caption">
                                    <h2>What type are you?</h2>
                                </div>
                                @if (session('message'))
                                    <div class="alert alert-danger" role="alert">
                                        <strong>{{ session('message') }}</strong>
                                    </div>
                                @endif
                                <div class="reg-select-card-section">
                                    <div id="sect-1" class="checkbox-btn-option">
                                        <input id="reg-1" type="radio" name="reg-select" value="reg-select">
                                        <div for="reg-1" class="reg-card-content">
                                            <div class="card-image">
                                                <img src="{!! url('public/assets/images/IFBB.png') !!}">
                                            </div>
                                            <div class="card-title">
                                                <h5>IFBB</h5>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="sect-2" class="checkbox-btn-option">
                                        <input id="reg-2" type="radio" name="reg-select" value="reg-select">
                                        <div for="reg-2" class="reg-card-content">
                                            <div class="card-image">
                                                <img src="{!! url('public/assets/images/logo-npc.png') !!}">
                                            </div>
                                            <div class="card-title">
                                                <h5>NPC</h5>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="select-section-btn">
                                    <a id="btn_click" class="btn"> Next ></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!--  ===============================  -->
<!--  ======= Main Banner ===========  -->
<!--  ===============================  -->
<script src="{!! url('public/assets/js/jquery.js') !!}"></script>
<script src="{!! url('public/assets/js/bootstrap.min.js') !!}"></script>
<script src="{!! url('public/assets/js/parallax.js') !!}"></script>
<script src="{!! url('public/assets/js/app.js') !!}"></script>
<script >
    var one = document.getElementById("reg-1");
    var two = document.getElementById("reg-2");

    one.onclick = function(){
        var link = document.getElementById("btn_click");
        link.setAttribute("href", "pro-athlete");
        return true;
    };
    two.onclick = function(){
        var link = document.getElementById("btn_click");
        link.setAttribute("href", "register-type");
        return true;
    };
</script>
</body>
</html>
