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

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.3/font/bootstrap-icons.css">
    <link href='https://api.mapbox.com/mapbox-gl-js/v2.6.0/mapbox-gl.css' rel='stylesheet' />
   @stack('link')
<script src='https://api.mapbox.com/mapbox-gl-js/v2.6.0/mapbox-gl.js'></script>

    
</head>
<body>



  <div class="container-fluid  " >
    <div class="row flex-nowrap">
        <div class="col-auto col-md-3 col-xl-2 px-sm-2 px-0 bg-dark"   >
          <div style=" position: fixed; height: 100%;" >

          </div>
            <div class="d-flex w-100     border-dark flex-column align-items-center align-items-sm-start px-3 pt-2 text-white min-vh-100" >
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDarkDropdown" aria-controls="navbarNavDarkDropdown" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
               
                <ul class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start" id="menu">
                    <li class="nav-item">
                        <a href="/" class="nav-link align-middle px-0">
                            <i class="fs-4 bi-house"></i> <span class="ms-1 d-none d-sm-inline">Site</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('Seller.home')}}" class="nav-link align-middle px-0">
                            <i class="fs-4 bi-house"></i> <span class="ms-1 d-none d-sm-inline">Home</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('Seller.profile')}}" class="nav-link align-middle px-0">
                            <i class="fs-4 bi-house"></i> <span class="ms-1 d-none d-sm-inline">Profile</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{route('Seller.home')}}" data-bs-toggle="collapse" class="nav-link px-0 align-middle">
                            <i class="bi bi-tags-fill"></i> <span class="ms-1 d-none d-sm-inline">Restaurant</span> </a>
                        <ul class="collapse show nav flex-column ms-1" id="submenu1" data-bs-parent="#menu">
                            <li class="w-100">
                                <a href="{{route('Seller.Restaurant.create')}}" class="nav-link px-0"> <span class="d-none d-sm-inline">Add</span>  </a>
                            </li>
                            <li>
                                <a href="{{route('Seller.Restaurant.index')}}" class="nav-link px-0"> <span class="d-none d-sm-inline">My Restaurant</span>  </a>
                            </li>
                        </ul>
                    </li>
                    
                   
                    
                    <li>
                        <a href="" class="nav-link px-0 align-middle">
                            <i class="fs-4 bi-people"></i> <span class="ms-1 d-none d-sm-inline">Sales Report</span> </a>
                    </li>
                    <li>
                        <a href="#" class="nav-link px-0 align-middle">
                            <i class="fs-4 bi-people"></i> <span class="ms-1 d-none d-sm-inline">Customers</span> </a>
                    </li>
                </ul>
                <hr>
                <div class="dropdown pb-4">
                    <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="https://github.com/mdo.png" alt="hugenerd" width="30" height="30" class="rounded-circle">
                        <span class="d-none d-sm-inline mx-1">loser</span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-dark text-small shadow">
                        <li><a class="dropdown-item" href="#">New project...</a></li>
                        <li><a class="dropdown-item" href="#">Settings</a></li>
                        <li><a class="dropdown-item" href="#">Profile</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button class="btn text-white" type="submit">logout</button>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col py-3 ">
            {{-- Content area... --}}
            <div>
                @yield('content')
            </div>
            
        </div>
    </div>
</div>



{{-- <main class="py-4">
    @yield('content')
</main> --}}


     @stack('script') 
</body>
</html>
