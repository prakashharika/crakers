<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'CPR Pyro Park') }}</title>
      
    <!-- font -->
    <link rel="stylesheet" href={{ asset('front-end/fonts/fonts.css')}} />
    <link rel="stylesheet" href={{ asset('front-end/icon/icomoon/style.css')}} />
    <!-- css -->
    <link rel="stylesheet" href={{ asset('front-end//sibforms.com/forms/end-form/build/sib-styles.css')}} />
    <link rel="stylesheet" href={{ asset('front-end/css/bootstrap.min.css')}} />
    <link rel="stylesheet" href={{ asset('front-end/css/swiper-bundle.min.css')}} />
    <link rel="stylesheet" href={{ asset('front-end/css/animate.css')}} />
    <link rel="stylesheet" type="text/css" href={{ asset('front-end/css/styles.css')}} />

    <!-- Favicon and Touch Icons  -->
    <link rel="shortcut icon" href={{ asset('front-end/images/logo/favicon.svg')}} />
    <link rel="apple-touch-icon-precomposed" href={{ asset('front-end/images/logo/favicon.svg')}} />

    </head>
    <body>
      
    <!-- Scroll Top -->
    <button id="goTop">
        <span class="border-progress"></span>
        <span class="icon icon-caret-up"></span>
    </button>

    <!-- preload -->
    {{-- <div class="preload preload-container" id="preload">
        <div class="preload-logo">
            <div class="spinner"></div>
        </div>
    </div> --}}
    <!-- /preload -->
        @include('layouts.header')
        
        @yield('content')

        @include('layouts.footer')
    </body>
</html>
