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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css"> 

</head>
<body>

<script src="{{ asset('js/app.js') }}"></script>

    <div id="app">

        <!-- Navbar -->
        @include('layouts.navbar')

        <div class="container-fluid"> 
            <div class="row min-vh-100 flex-column flex-md-row"> 

                <!-- Sidebar -->
                <aside class="bg-dark col-12 col-md-3 col-xl-2 p-0">
                    <nav class="navbar navbar-expand-md navbar-dark bd-dark flex-md-column flex-row py-2 sticky-top">
                        <div class="p-3">
                            <a href="#" class="navbar-brand mx-0 font-weight-bold text-nowrap" >{{ Auth::user()->username }}</a>
                            <!-- Admin Tag -->
                            @if (auth()->user()->is_admin)
                                <p class="text-light"> (Admin) </p>
                            @endif
                        </div>
                        <button type="button" class="navbar-toggler border-0 order-1" data-bs-toggle="collapse" data-bs-target="#sidebar" aria-controls="nav" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        
                        <div class="collapse navbar-collapse" id="sidebar">
                            <ul class="navbar-nav flex-column">
                                
                                <li class="nav-item">
                                    <a href="{{ route('projects.index') }}" class="nav-link">
                                        Projects & Records 
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('engineers.index') }}" class="nav-link">
                                        Engineers
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('company.index') }}" class="nav-link">
                                        Company 
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('engineers.show', auth()->user()) }}" class="nav-link">
                                        Profile 
                                    </a>
                                </li>
                                
                            </ul>
                        </div>      
                    </nav>   
                </aside>

                <!-- User content -->
               <main class="col-md-9 col-xl-10 py-4">
                    <div class="container relative">
                        <div class="container mt-4">
                            
                        </div>
                        <div class="card">
                        @include('layouts.errors')
                        @yield('content')
                        </div>
                    </div>
                </main> 
            </div>
        </div> 
        
        
    </div>

</body>
</html>

