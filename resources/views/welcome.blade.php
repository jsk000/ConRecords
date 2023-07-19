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
        <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

        <!-- Scripts -->
        @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    </head>
    <body style="background-color: #EBEFF6;">
        
        <div class="banner bg-dark text-light rounded-bottom text-center py-2">
            <h5>! The Application ia still under Development and you are seeing the first Prototype !</h5>
        </div>
        <div>
            <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
                <div class="container">
                    <a class="navbar-brand" style="font-size: 3vw;" href="{{ url('/') }}">
                            {{ config('app.name', 'ConRecords') }}
                    </a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <!-- Left Side Of Navbar -->
                        <ul class="navbar-nav me-auto">
                            <li class="nav-item">
                                <a class="nav-link" href="#about">About</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#contact">Contact</a>
                            </li>
                        </ul>

                        <!-- Right Side Of Navbar -->
                        <ul class="navbar-nav ms-auto">
                            <!-- Authentication Links -->
                            @guest
                                @if (Route::has('login'))
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                    </li>
                                @endif

                                @if (Route::has('register'))
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ url('register-company') }}">
                                            {{ __('Register your Company') }}
                                        </a>
                                    </li>
                                @endif
                            @else
                                <li class="nav-item dropdown">
                                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                        {{ Auth::user()->username }}
                                    </a>

                                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item" href="{{ route('home') }}"> Home
                                        </a>
                                        
                                        <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                                        document.getElementById('logout-form').submit();">
                                            {{ __('Logout') }}
                                        </a>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                            @csrf
                                        </form>
                                        
                                    </div>
                                </li>
                            @endguest
                        </ul>
                    </div>
                </div>
            </nav>

            <!-- Header -->
            <header class="py-5 bg-image-full" style="background-image: url('https://images.unsplash.com/photo-1498262257252-c282316270bc?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=387&q=80')">
                <div class="text-center my-5">
                    <h1 class="text-white fw-bolder" style="font-size: 8vw ;">ConRecords</h1>
                    <p class="text-white mb-0 bg-dark bg-opacity-50">The Ultimate Web Application To Keep And Manage Your Construction Records Safely!</p>
                </div>
            </header>

            <!-- Content section-->
            <section class="py-5">
                <div class="container my-5">
                    <div class="row justify-content-center ">
                        <div class="col-lg-6" id="about">
                            <h2>What is ConRecords?</h2>
                            <p class="mb-0"> 
                            We specialize in providing an efficient platform for construction companies
                            to write and manage construction records. With our user-friendly interface, 
                            you can easily create, and organize all your construction documentation in one place.
                            Our intuitive features allow you to keep track of all engineers, projects and records in your company, 
                            saving you valuable time and resources. 
                            </p>
                        </div>
                    </div>
                </div>
            </section>
            
            <!-- Content section-->
            <section class="pb-5 text-center">
                <div class="container my-5 rounded" style="background-color: #C5CAD7;">
                    <h2>3 Easy steps to get started</h2>
                    <div class="row justify-content-center p-5">
                        <div class="col-md-3">
                            <h3 class="text-white fw-bolder bg-dark">Step 1</h3>
                            <p class="mb-0">Register your company and add the employed engineers to crete an account for them</p>
                        </div>
                        <div class="col-md-3">
                            <h3 class="text-white fw-bolder bg-dark">Step 2</h3>
                            <p class="mb-0">Add your Projects and assign engineers (managers) to them</p>
                        </div>
                        <div class="col-md-3">
                            <h3 class="text-white fw-bolder bg-dark">Step 3</h3>
                            <p class="mb-0">start keeping construction records with your engineers and enjoy the management process!</p>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Footer -->
            <header class="py-5 bg-image-full" style="background-image: url('https://images.unsplash.com/photo-1558591710-4b4a1ae0f04d?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=387&q=80')">
                <div class="text-center my-5" id="contact">
                    <h1 class="text-black fs-3 fw-bolder">Contast Us</h1>
                    <p class="text-black-50 mb-0">
                        Jana Kassas <br> Media Informatics <br> Mtrkl. nr: 5458408 <br> <a href="mailto:jana.kassas@uni.student-tuebingen.de"> jana.kassas@uni.student-tuebingen.de</a>
                    </p>
                </div>
            </header>
        </div>
    </body>
</html>
