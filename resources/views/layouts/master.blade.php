<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Link untuk menambah icon -->
    <link rel="icon" href="https://cdn3.iconfinder.com/data/icons/ecommerce-shopping-4/64/x-33-512.png">
    
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Larahub73</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <!-- Custom fonts for this template-->
    <link href="{{asset('/sbadmin2/vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{asset('/sbadmin2/css/sb-admin-2.min.css')}}" rel="stylesheet">
    @stack('script-head')

</head>

<body id="page-top">

    <div id="app">
        <!-- Page Wrapper -->
        <div id="wrapper">

            <!-- Sidebar -->
            <ul class="navbar-nav bg-gradient-dark sidebar sidebar-dark accordion" id="accordionSidebar">

                <!-- Sidebar - Brand -->
                <a class="sidebar-brand d-flex align-items-center justify-content-center" href="#">
                  <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-laugh-wink"></i>
                  </div>
                  <div class="sidebar-brand-text mx-3">Larahub <sup>73</sup></div>
                </a>
          
                <!-- Divider -->
                <hr class="sidebar-divider my-0">
          
                <!-- Nav Item - Dashboard -->
                {{-- <li class="nav-item">
                  <a class="nav-link" href="/login">
                   
                    <span>Login</span></a>
                </li> --}}
          
                <!-- Divider -->
                <hr class="sidebar-divider">
          
                <!-- Heading -->
                <!-- <div class="sidebar-heading">
                  Interface
                </div> -->
          
                <!-- Nav Item - Pages Collapse Menu -->
                <!-- <li class="nav-item">
                  <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-fw fa-cog"></i>
                    <span>Components</span>
                  </a>
                  <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                      <h6 class="collapse-header">Custom Components:</h6>
                      <a class="collapse-item" href="buttons.html">Buttons</a>
                      <a class="collapse-item" href="cards.html">Cards</a>
                    </div>
                  </div>
                </li> -->
          
                <!-- Nav Item - Utilities Collapse Menu -->
                <!-- <li class="nav-item">
                  <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities">
                    <i class="fas fa-fw fa-wrench"></i>
                    <span>Utilities</span>
                  </a>
                  <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                      <h6 class="collapse-header">Custom Utilities:</h6>
                      <a class="collapse-item" href="utilities-color.html">Colors</a>
                      <a class="collapse-item" href="utilities-border.html">Borders</a>
                      <a class="collapse-item" href="utilities-animation.html">Animations</a>
                      <a class="collapse-item" href="utilities-other.html">Other</a>
                    </div>
                  </div>
                </li> -->
          
                <!-- Divider -->
                <!-- <hr class="sidebar-divider"> -->
          
                <!-- Heading -->
                <!-- <div class="sidebar-heading">
                  MENU
                </div> -->
          
                <!-- Nav Item - Pages Collapse Menu -->
                <li class="nav-item active">
                  <a class="nav-link" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="true" aria-controls="collapsePages">
                    <i class="fas fa-fw fa-table"></i>
                    <span>Menu</span>
                  </a>
                  <div id="collapsePages" class="collapse show" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                      <!-- <h6 class="collapse-header">Login Screens:</h6>
                      <a class="collapse-item" href="login.html">Login</a>
                      <a class="collapse-item" href="register.html">Register</a>
                      <a class="collapse-item" href="forgot-password.html">Forgot Password</a>
                      <div class="collapse-divider"></div>
                      <h6 class="collapse-header">Other Pages:</h6> -->
                      
                      <a class="collapse-item" href="/questions/index">Index</a>
                      <a class="collapse-item" href="/create/question">Create</a>
                    </div>
                  </div>
                </li>
          
                <!-- Nav Item - Charts -->
                <!-- <li class="nav-item">
                  <a class="nav-link" href="charts.html">
                    <i class="fas fa-fw fa-chart-area"></i>
                    <span>Charts</span></a>
                </li> -->
          
                <!-- Nav Item - Pages Collapse Menu -->
                <li class="nav-item">
                  <a class="nav-link" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="true" aria-controls="collapsePages">
                    <i class="fas fa-fw fa-wrench"></i>
                    <span>Teams</span>
                  </a>
                  <div id="collapsePages" class="collapse show" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                      <!-- <h6 class="collapse-header">Login Screens:</h6>
                      <a class="collapse-item" href="login.html">Login</a>
                      <a class="collapse-item" href="register.html">Register</a>
                      <a class="collapse-item" href="forgot-password.html">Forgot Password</a>
                      <div class="collapse-divider"></div>
                      <h6 class="collapse-header">Other Pages:</h6> -->
                      <a class="collapse-item" href="#">Arkan</a>
                      <a class="collapse-item" href="#">Arifandy</a>
                      <a class="collapse-item" href="#">Jatayu</a>
                    </div>
                  </div>
                </li>
          
                <!-- Divider -->
                <!-- <hr class="sidebar-divider d-none d-md-block"> -->
          
                <!-- Sidebar Toggler (Sidebar) -->
                <!-- <div class="text-center d-none d-md-inline">
                  <button class="rounded-circle border-0" id="sidebarToggle"></button>
                </div> -->
          
            </ul>
            <!-- End of Sidebar -->

            <!-- Content Wrapper -->
            <div id="content-wrapper" class="d-flex flex-column">

                <!-- Main Content -->
                <div id="content">

                    <!-- Navbar-->
                    <nav class="navbar navbar-expand-md navbar-light bg-gradient-dark shadow-sm">
                        <div class="container">
                            {{-- <a class="navbar-brand" href="{{ url('/') }}">
                                {{ config('app.name', 'Laravel') }}
                            </a>
                            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                                <span class="navbar-toggler-icon"></span>
                            </button> --}}
            
                            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                                <!-- Left Side Of Navbar -->
                                <ul class="navbar-nav mr-auto">
                                  <li class="nav-item">
                                    @if (Auth::user())
                                      <button type="button" class="btn btn-primary">
                                        Poin Reputasi <span class="badge badge-light">{{Auth::user()->point->point}}</span>
                                      </button>
                                    @endif
                                  </li>
                                </ul>
            
                                <!-- Right Side Of Navbar -->
                                <ul class="navbar-nav ml-auto ">
                                    <!-- Authentication Links -->
                                    @guest
                                        <li class="nav-item">
                                            <a class="nav-link text-white" href="{{ route('login') }}">{{ __('Login') }}</a>
                                        </li>
                                        @if (Route::has('register'))
                                            <li class="nav-item">
                                                <a class="nav-link text-white" href="{{ route('register') }}">{{ __('Register') }}</a>
                                            </li>
                                        @endif
                                    @else
                                        <li class="nav-item dropdown">
                                            <a id="navbarDropdown" style="display: inline-block" class="nav-link text-white" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                                {{ Auth::user()->name }} <span class="caret"></span>
                                            </a>
            
    
                                                <a class="nav-link text-white" style="display: inline-block" href="{{ route('logout') }}"
                                                   onclick="event.preventDefault();
                                                                 document.getElementById('logout-form').submit();">
                                                    {{ __('Logout') }}
                                                </a>
            
                                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                                    @csrf
                                                </form>
                                            
                                        </li>
                                    @endguest
                                </ul>
                            </div>
                        </div>
                    </nav>
                    <!-- END of navbar-->

                    <!-- Begin Page Content -->
                    <div class="container-fluid">

                        <main class="py-4">
                            @yield('content')
                        </main>
            
                    </div>
                    <!-- /.container-fluid -->

                </div>
                <!-- End of Main Content -->

                <!-- Footer -->
                <footer class="sticky-footer bg-white">
                    <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Larahub73 2021</span>
                    </div>
                    </div>
                </footer>
                <!-- End of Footer -->

            </div>
            <!-- End of Content Wrapper -->
            
            <!-- Scroll to Top Button-->
            <a class="scroll-to-top rounded" href="#page-top">
                <i class="fas fa-angle-up"></i>
            </a>

        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="{{asset('/sbadmin2/vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('/sbadmin2/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{asset('/sbadmin2/vendor/jquery-easing/jquery.easing.min.js')}}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{asset('/sbadmin2/js/sb-admin-2.min.js')}}"></script>
    @stack('script-body')
  </body>
</html>