<!DOCTYPE html>

<html class="app-ui">

<head>
    <!-- Meta -->
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Document title -->
    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- Google fonts -->
    {{-- <link rel="stylesheet"
        href="http://fonts.googleapis.com/css?family=Roboto:300,400,400italic,500,900%7CRoboto+Slab:300,400%7CRoboto+Mono:400" /> --}}
    <!-- AppUI CSS stylesheets -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/css/bootstrap-datepicker.css" rel="stylesheet">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/js/bootstrap-datepicker.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" id="css-ionicons" href="{{ asset('css/ionicons.css') }}" />
    <link rel="stylesheet" id="css-bootstrap" href="{{ asset('css/bootstrap.css') }}" />
    <link rel="stylesheet" id="css-app" href="{{ asset('css/app2.css') }}" />
    <!-- End Stylesheets -->
    <style>
        .btn.btn-rounded {
        border-radius: 50px;
    }
    </style>
    @stack('styles')
</head>

<body class="app-ui layout-has-drawer layout-has-fixed-header">
    <div class="app-layout-canvas">
        <div class="app-layout-container">
            <!-- Drawer -->
            <aside class="app-layout-drawer">
                <!-- Drawer scroll area -->
                <div class="app-layout-drawer-scroll">
                    <!-- Drawer logo -->
                    <div id="logo" class="drawer-header">
                        <a href="/home">
                            <img class="img-responsive" src="{{ asset('img/logo/geekgarden.png') }}"
                                title="GeekGarden" alt="GeekGarden" />
                            </a>
                    </div>
                    <!-- Drawer navigation -->
                    <nav class="drawer-main">
                        <ul class="nav nav-drawer">
                            <li class="nav-item {{ Request::is('todos*') ? 'active' : '' }}">
                                <a href=" {{ route('todos.index') }} "><i
                                        class="ion-ios-speedometer-outline"></i>Dashboard</a>
                            </li>
                            @if(Auth::User()->isAdmin())
                            <li class="nav-item {{ Request::is('projects*') ? 'active' : '' }}">
                                <a href=" {{ route('projects.index') }} "><i class="ion-ios-briefcase"></i>Project</a>
                            </li>
                            <li class="nav-item {{ Request::is('programmers*') ? 'active' : '' }}">
                                <a href=" {{ route('programmers.index') }} "><i class="ion-ios-people"></i>Manage
                                    User</a>
                            </li>
                            @endif
                            <li class="nav-item {{ Request::is('mytodo*') ? 'active' : '' }}">
                                <a href="/mytodo/{{auth()->user()->id}}"><i class="ion-ios-contact"></i>My To Do</a>
                            </li>
                            <li class="nav-item {{ Request::is('changePassword*') ? 'active' : '' }}">
                                <a href=" {{ route('user.editPass') }} "><i class="ion-ios-redo"></i>Change Password</a>
                            </li>
                        </ul>
                    </nav>
                    <!-- End drawer navigation -->
                    <div class="drawer-footer">
                        <p class="copyright">AppUI Template &copy;</p>
                        <a href="https://shapebootstrap.net/item/1525731-appui-admin-frontend-template/?ref=rustheme"
                            target="_blank" rel="nofollow">Purchase a license</a>
                    </div>
                </div>
                <!-- End drawer scroll area -->
            </aside>
            <!-- End drawer -->

            <!-- Header -->
            <header class="app-layout-header">
                <nav class="navbar navbar-default">
                    <div class="container-fluid">
                        <div class="navbar-header">
                            <a class="btn btn-sm btn-rounded btn-primary" id="btn-back" href="javascript:window.history.go(-1);">
                                <b>Back</b>
                            </a>
                            <span class="navbar-page-title">
                                {{ Auth::user()->role==1?'Project Manager':'Programmer'}}
                            </span>
                        </div>

                        <div class="collapse navbar-collapse" id="header-navbar-collapse">

                            <ul class="nav navbar-nav navbar-right navbar-toolbar hidden-sm hidden-xs">
                                <li class="dropdown dropdown-profile">
                                    <a href="javascript:void(0)" data-toggle="dropdown">
                                        <span class="m-r-sm">{{ Auth::user()->name }} <span class="caret"></span></span>
                                        <img class="img-avatar img-avatar-48" @if (auth()->user()->photo)
                                        src="{{ asset(auth()->user()->photo) }}"
                                        @else
                                        src="{{ asset('img/avatars/avatar3.jpg') }}"
                                        @endif
                                        alt="User profile"/>
                                    </a>
                                    <ul class="dropdown-menu dropdown-menu-right">
                                        <li>
                                            <a href=" {{ route('profil.edit') }} ">Profile</a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                                {{ __('Logout') }}
                                            </a>

                                            <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                                style="display: none;">
                                                @csrf
                                            </form>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                            <!-- .navbar-right -->
                        </div>
                    </div>
                    <!-- .container-fluid -->
                </nav>
                <!-- .navbar-default -->
            </header>
            <!-- End header -->

            <main class="app-layout-content">
                <!-- Page Content -->
                <div class="container-fluid p-y-md">
                    @yield('content')
                </div>
                <!-- End Page Content -->
            </main>
        </div>
        <!-- .app-layout-container -->
    </div>

    <!-- AppUI Core JS: jQuery, Bootstrap, slimScroll, scrollLock and App.js -->
    <script src="{{ asset('js/core/bootstrap.min.js') }}"></script>
    @stack('script')
</body>

</html>
