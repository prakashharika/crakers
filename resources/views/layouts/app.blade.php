<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <link rel="stylesheet" href="{{ asset('assets/css/style.min.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/lib/apexcharts/apexcharts.css') }}">
        {{-- <link rel="stylesheet" href="{{ asset('assets/lib/quill/quill.core.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/lib/quill/quill.snow.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/lib/quill/quill.bubble.css') }}"> --}}
        {{-- <link rel="stylesheet" href="{{ asset('assets/lib/chart.js/chart.min.js') }}">
        <link rel="stylesheet" href="{{ asset('assets/lib/apexcharts/apexcharts.min.js') }}"> --}}
        <link rel="stylesheet" href="{{ asset('assets/lib/remixicon/fonts/remixicon.css') }}">
        <!-- Scripts -->
        <script src="{{ asset('assets/lib/apexcharts/apexcharts.min.js') }}"></script>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
        <script src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
        {{-- <script src="{{ asset('assets/lib/quill/quill.min.js') }}"></script> --}}
        <link rel="icon" href="{{ asset('assets/images/logo-f.png') }}" type="image/x-icon">
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
            @include('layouts.sidebar')
            @include('layouts.navigation')
            <main>
                {{ $slot }}
            </main>
        </div>
    </body>
    <script src="{{ asset('assets/lib/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('assets/lib/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/js/script.js') }}"></script>
    {{-- <script src="{{ asset('assets/js/apexchart.js') }}"></script> --}}
    {{-- <script src="{{ asset('assets/js/db.product.js') }}"></script> --}}
    <script src="{{ asset('assets/lib/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/lib/table') }}"></script>
    <script>
    //     $("#propertyTable").Grid({
    //   className: {
    //     table: 'table table-bordered mb-0'
    //   },
    //   pagination: true,
    //   search: true,
    //   sort: true
    // }); 
    
    // var quill2 = new Quill('#about_property', {
            // modules: {
            //     toolbar: [
            //     ['bold', 'italic'],
            //     ['link', 'blockquote', 'code-block', 'image'],
            //     [{ list: 'ordered' }, { list: 'bullet' }]
            //     ]
            // },
            // placeholder: 'Compose an epic...',
            // theme: 'snow'
            // });

    </script>
</html>
