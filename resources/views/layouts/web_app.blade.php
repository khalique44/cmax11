<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>NPC Worldwide</title>


    <script src="{!! url('public/assets/js/jquery.js') !!}"></script>
    <script src="{!! url('public/assets/js/bootstrap.min.js') !!}"></script>
    <script src="{!! url('public/assets/js/parallax.js') !!}"></script>
    <script src="{!! url('public/assets/js/app.js') !!}"></script>
    <script src="{!! url('public/assets/js/moment.min.js') !!}"></script>
    <script src="{!! url('public/assets/js/bootstrap-datepicker.min.js') !!}"></script>
    <script src="{!! url('public/assets/js/jQuery.formError.js') !!}"></script>

    <!--  ======= Bootstrap CSS  ========  -->
    <link href="{!! url('public/assets/css/bootstrap.min.css') !!}" rel="stylesheet">
    <link href="{!! url('public/assets/css/animate.css')!!}" rel="stylesheet">
    <link href="{!! url('public/assets/css/style.css') !!}" rel="stylesheet">
    <link href="//cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css">
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/css/bootstrap-datepicker.css" rel="stylesheet">
    <link href="{!! url('public/multi-select/css/multi-select.css')!!}" rel="stylesheet" />
 <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1" user-scalable="no">
    <script src="http://code.jquery.com/jquery-1.9.1.js"></script>
    <script src="http://code.jquery.com/ui/1.11.0/jquery-ui.js"></script>
    <link rel="shortcut icon" href="{!! url('public/assets/images/logo-npc.png') !!}" />

    @yield('css')
</head>
<body id="user-backend">
<header>
    <div id="backend-header" class="backend-header">
        <div class="container">
            <div class="logo">
                <div class="logo-image">
                    <a href="{{ url('/') }}"><img src="{!! url('public/assets/images/logo-white.png') !!}" class="logo" alt="Logo"></a>
                </div>
                <div class="header-title">
                    <a href="{!! url('/') !!}">National Physique Committee Worldwide.</a>
                </div>
            </div>
            <div class="backend-header-content-area">
                <div class="name-title">
                    <h3>Welcome {{ Auth::user()->first_name }}</h3>
                </div>
                <div class="header-login-btn-area">
                    <a class="btn" href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                        {{ __('Logout') }}
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">@csrf</form>
                </div>
            </div>
        </div>
    </div>
</header>
<div class="header-bottom">
    <div class="container">
        <div class="header-bottom-content">
            <div class="membership-date">
                <h4>Athlete - Member Since 2016</h4>
            </div>
            <div class="membership-card-print-area">
                <div class="rules-caption">
                    <a href="http://npcnewsonline.com/rules/" target="_blank" class="btn">RULES & REGULATIONS</a>
                </div>
                @if(auth()->user()->subscriptions()->count() > 0 || auth()->user()->is_admin_user == 1)
                    <div class="print-btn">
                        <a href='{{ route("membership") }}' class="btn">PRINT MEMBERSHIP</a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
{{--
<a href="{{route('contests.all-contests')}}" data-toggle="" data-target="#search-db-model"  style="margin-left: 570px;" class="btn-sm btn-primary">All Contests</a>
<a href="{{route('contests.my-contests')}}" data-toggle="" data-target="#search-db-model"  style="margin-left: 0px;" class="btn-sm btn-primary">My Contests</a>
--}}

{{-- Confirmation Alert Box Model for confirm to delete--}}

<div class="modal fade" id="DeleteConfirmationModal" tabindex="-1" role="dialog" aria-labelledby="DeleteConfirmationModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="DeleteConfirmationModalLabel">Confirmation</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p> Are you sure you want to Remove this? </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn-sm btn-success" data-dismiss="modal">Close</button>
                {{--<a type="hidden" id="approve-users-approve-div" class='btn-sm btn-danger' href=''>Approve</a>
                <a type="hidden" id="approve-users-delete-div" class='btn-sm btn-danger' href=''>Decline</a>--}}

                <form style="display: inline-block;" type="hidden" class="data-delete-form" method="POST" action="">
                    {{ method_field('DELETE' )}}
                    {{ csrf_field()}}
                    <div class="action-buttons">
                        <button type="submit" class="btn-danger">Delete</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
{{-- Confirmation Alert Box Model for confirm to approve--}}

<div class="modal fade" id="ApproveConfirmationModal" tabindex="-1" role="dialog" aria-labelledby="ApproveConfirmationModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ApproveConfirmationModalLabel">Confirmation</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p> Are you sure you want to Approve this? </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn-sm btn-danger" data-dismiss="modal">Close</button>
                <a id="data-approve-form" class='btn-sm btn-success' href=''>Approve</a>
            </div>
        </div>
    </div>
</div>
{{-- Confirmation Alert Box Model for confirm to decline--}}

<div class="modal fade" id="DeclineConfirmationModal" tabindex="-1" role="dialog" aria-labelledby="DeclineConfirmationModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="DeclineConfirmationModalLabel">Confirmation</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p> Are you sure you want to Decline this? </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn-sm btn-success" data-dismiss="modal">Close</button>
                <a id="data-decline-form" class='btn-sm btn-danger' href=''>Decline</a>
            </div>
        </div>
    </div>
</div>

{{-- Confirmation Alert Box Model for confirm to start contests--}}

<div class="modal fade" id="StartContestConfirmationModal" tabindex="-1" role="dialog" aria-labelledby="StartContestConfirmationModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="StartContestConfirmationModalLabel">Confirmation</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p> Are you sure you want to Start this? </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn-sm btn-danger" data-dismiss="modal">Close</button>
                <a id="data-contest-start-form" class='btn-sm btn-success' href=''>Start</a>
            </div>
        </div>
    </div>
</div>

{{-- Confirmation Alert Box Model for confirm to complete contests--}}

<div class="modal fade" id="CompleteContestConfirmationModal" tabindex="-1" role="dialog" aria-labelledby="CompleteContestConfirmationModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="CompleteContestConfirmationModalLabel">Confirmation</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p> Are you sure you want to Complete this? </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn-sm btn-danger" data-dismiss="modal">Close</button>
                <a id="data-contest-complete-form" class='btn-sm btn-success' href=''>Complete</a>
            </div>
        </div>
    </div>
</div>

@yield('content')


<!--  ===============================  -->
<!--  ======= Main Banner ===========  -->
<!--  ===============================  -->
<script src="{!! url('public/assets/js/jquery.js') !!}"></script>
<script src="{!! url('public/assets/js/bootstrap.min.js') !!}"></script>
<script src="{!! url('public/assets/js/parallax.js') !!}"></script>
<script src="{!! url('public/assets/js/app.js') !!}"></script>
<script type="text/javascript" src="http://code.jquery.com/jquery-1.7.1.min.js"></script>
<script src="//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js" type="text/javascript" charset="utf8" ></script>
<script src="{!! url('public/assets/js/bootstrap-datepicker.min.js') !!}"></script>

<script type="text/javascript">
    /*
    $(document).ready(function(){

    $("#pass_1").keypress(function(){
                $('#Pass1ErrorMsg').hide();
                document.getElementById('pass_1').style.borderBottomColor='green';
            });

});*/

    $(function () {
        var today = new Date();
        $('#card_expiry_date').datepicker({

            todayHighlight:true,
            minDate: today
        });
    });

</script>

</body>
</html>
