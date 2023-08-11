<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
</head>
<body class="app-bg" style="padding-top: 5rem; background-color: #F5FFFA;">
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-opacity-50 shadow-sm app-nav fixed-top">
            <div class="container">
                <a class="navbar-brand fw-bold text-white ms-5" href="{{ route('welcome') }}">
                    <i class="fa-solid fa-book-open-reader nav-icon"></i>  <span class="app-name">Graduation Essay</span>
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link py-0 mt-1 text-white fw-bold" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link py-0 mt-1 text-white fw-bold" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <!-- home -->
                            <li class="nav-item">
                                <a href="{{ route('home') }}" class="nav-link">
                                    <i class="fa-solid fa-house icon-sm bg-white border rounded text-primary text-opacity-50 p-1"></i>
                                </a>
                            </li>
                            <!-- post book -->
                            <li class="nav-item">
                                <a href="{{ route('post.create') }}" class="nav-link">
                                    <!-- <i class="fa-solid fa-book icon-sm bg-white border rounded text-primary text-opacity-50 p-1"></i>-->
                                    <i class="fa-solid fa-pen icon-sm bg-white border rounded text-primary text-opacity-50 p-1"></i>
                                </a>
                            </li>
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    @if(Auth::user()->avatar)
                                        <img src="https://graduationessay.s3-ap-northeast-1.amazonaws.com/{{ Auth::user()->avatar }}" alt="" class="rounded-circle avatar-sm mt-1">
                                    @else
                                        <i class="fa-solid fa-circle-user icon-sm bg-white border rounded text-primary text-opacity-50 p-1"></i>
                                    @endif
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <!-- admin -->
                                    @can('admin')
                                        <a href="{{ route('admin.users') }}" class="dropdown-item">
                                            <i class="fa-solid fa-user-gear"></i> Admin
                                        </a>

                                        <hr class="dropdown-divider">
                                    @endcan

                                    <!-- profile -->
                                    <a href="{{ route('profile.show', Auth::user()->id) }}" class="dropdown-item">
                                        <i class="fa-solid fa-circle-user"></i> My page
                                    </a>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        <i class="fa-solid fa-right-from-bracket"></i> {{ __('Logout') }}
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

        <main>
            <div class="row justify-content-center">
                @if(request()->is('admin/*'))
                    <div class="col-3">
                        <div class="list-group">
                            <a href="{{ route('admin.users') }}" class="list-group-item {{ request()->is('admin/users*') ? 'active' : '' }}">
                                <i class="fa-solid fa-users"></i> Users 
                            </a>
                            <a href="{{ route('admin.posts') }}" class="list-group-item {{ request()->is('admin/posts*') ? 'active' : '' }}">
                                <i class="fa-solid fa-newspaper"></i> Posts 
                            </a>
                            <a href="{{ route('admin.categories') }}" class="list-group-item {{ request()->is('admin/categories*') ? 'active' : '' }}">
                                <i class="fa-solid fa-tags"></i> Categories
                            </a>
                        </div>
                    </div>
                @endif
                <div class="col-9">
                    @yield('content')
                </div>
            </div>
        </main>
    </div>
</body>
</html>
