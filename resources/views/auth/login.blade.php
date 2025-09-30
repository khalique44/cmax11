@extends('layouts.app')

@section('content')

@section('app-css')


    <style>
        /* these styles will animate bootstrap alerts. */
        .fade {
            opacity: 1;
        }
        @keyframes slide {
            100% { top: 30px; }
        }
        @media screen and (max-width: 668px) {
            .alert{ /* center the alert on small screens */
                left: 10px;
                right: 10px;
            }
        }
        .inlineimage {
            max-width: 470px;
            margin-right: 8px;
            margin-left: 10px
        }

        .images {
            display: inline-block;
            max-width: 98%;
            height: auto;
            width: 22%;
            margin: 1%;
            left: 20px;
            text-align: center
        }
    </style>
@endsection

@section('content')

<header class="header-main header-inner" <?php echo !empty($header_image) ? 'style="background: url('.$header_image.'); min-height: 63vh"' : ""; ?> >

    <div class="container">

        

      @include('layouts.includes.nav')



      <div class="slid-header pt-md-5 pb-md-4 mx-auto">

        <div class="row">

          <div class="col-lg-12 col-md-12 col-sm-12 text-center">

             <h1 class="display-4 mt-2 mt-md-5 mt-lg-5">@if(!empty($data['title'])) {!!html_entity_decode($data['title'])!!} @endif</h1>

             <p class="lead-c text-center w-100">@if(!empty($data['description'])) {!!html_entity_decode($data['description'])!!} @endif</p>

          </div>

          

        </div>

       

      </div>



    </div>

</header>


<div class="content">

    <section class="about pt-md-5 pb-md-5">

      <div class="container">

      <div class="row pt-md-1 justify-content-center">

        <div class="col-md-6">

          <div class="login-box">

            <form class="loginform p-5" method="POST" action="{{ route('login') }}" aria-label="{{ __('Login') }}">
                @csrf
              <div class="form-group">

                <label>LÄGENHET:</label>

                <input id="username" placeholder="{{ __('Username/Email') }}" type="username" class="{{ $errors->has('username') ? ' is-invalid' : '' }} form-control" name="username" value="{{ old('username') }}" required autofocus>
                @if ($errors->has('username'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('username') }}</strong>
                    </span>
                @endif

              </div>

              <div class="form-group">

                <label>LÖSENORD:</label>

                <a href="#" class="forgetp hidden">Forget Password ?</a>

                <input   id="password" type="password" placeholder="{{ __('language.Password') }}"
                                           class="{{ $errors->has('password') ? ' is-invalid' : '' }} form-control" name="password" required>
                @if ($errors->has('password'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                @endif
              </div>

              <div class="form-group checkform">

                <label><input type="checkbox" name="remember" value="1"> Kom ihåg mig på denna enhet</label>

              </div>

              <button type="submit" class="btn btn-success2">LOGGA IN</button>
              

            </form>

          </div>

        </div>



      </div>

      </div>

    </section><!---about sec--->

</div>

    

@endsection
@section('app-script')

    <script type="text/javascript">
        // $('.alert-success').fadeIn('fast').delay(2000).fadeOut('slow');
        // $('.alert-danger').fadeIn('fast').delay(2000).fadeOut('slow');

        //close the alert after 3 seconds.
        $(document).ready(function(){
            setTimeout(function() {
                $(".alert").alert('close');
            }, 3000);

        });

    </script>

@include('layouts.includes.footer') 
@endsection
 