<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'ConRecords') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts
    <script src="https://kit.fontawesome.com/fe50865e79.js" crossorigin="anonymous"></script> -->
    
    <!-- StyleSheet -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css"> -->

</head>
<body>

<script src="{{ asset('js/app.js') }}"></script>

    <div id="app">
        
        <!-- Navbar -->
        @include('layouts.navbar')

        <!-- guest content -->
        <main class="py-4">
            @include('layouts.errors')
            @yield('content')
        </main> 

        
    </div>

</body>
</html>

