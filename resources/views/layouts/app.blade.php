
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">    
    <meta name="description" content="@yield('meta_description', 'cmax.pk')">
    <meta name="keywords" content="@yield('meta_keywords', 'cmax.pk, real estate')">
    <meta name="author" content="cmax.pk">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="{{ asset('assets/img/favicon.png') }}">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="home_url" content="{{ url('') }}">

    <title>
        @hasSection('meta_title') 
            @yield('meta_title') | CMAX 
        @else 
            CMAX.pk - Real Estate
        @endif
    </title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Slick Slider -->
    <!-- Slick Slider CSS -->
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css"/>
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.min.css"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.css" />
    <link rel="stylesheet" href="{{ asset('assets/css/sweetalert2.min.css') }}"> 
    <link rel="stylesheet" href="{{ asset('assets/css/intlTelInput.css') }}" />
    <!-- jQuery (Required for Slick Slider) -->
    <script src="{{ asset('assets/js/jquery-3.6.0.min.js') }}"></script>
    
    <script src="https://cdn.jsdelivr.net/npm/nouislider@15.7.0/dist/nouislider.min.js"></script>
    <!-- Slick Slider JS -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script>
    <!-- SweetAlert2 JS -->
    <script src="{{ asset('assets/js/sweetalert2@11.js') }}"></script>
    <!-- AOS Animation -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link href="{{ asset('select2/select2.min.css') }}" rel="stylesheet" />
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
   <script src="{{ asset('select2/select2.js') }}"></script>
  


@php 
$head_scripts = GeneralHelper::getOption('head_scripts');  
@endphp     
{!! $head_scripts ?? '' !!}
    

</head>

<body>
    <div id="loader" class="lds-dual-ring hidden overlay"></div>
       
    @yield('content')
        
    
    @yield('app-script')
</body>
</html>

