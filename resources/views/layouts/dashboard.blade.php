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
        <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:300,400,400italic,500,900%7CRoboto+Slab:300,400%7CRoboto+Mono:400" />
        <!-- AppUI CSS stylesheets -->
        <link rel="stylesheet" id="css-ionicons" href="{{ asset('css/ionicons.css') }}" />
        <link rel="stylesheet" id="css-bootstrap" href="{{ asset('css/bootstrap.css') }}" />
        <link rel="stylesheet" id="css-app" href="{{ asset('css/app2.css') }}" />
        <!-- End Stylesheets -->
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
                            <a href="index.html"><img class="img-responsive" src="{{ asset('img/logo/logo-backend.png') }}" title="AppUI" alt="AppUI" /></a>
                        </div>
                        <!-- Drawer navigation -->
                        <nav class="drawer-main">
                            <ul class="nav nav-drawer">
                                @if(Auth::User()->isAdmin())
                                <li class="nav-item active">
                                    <a href="/pm"><i class="ion-ios-speedometer-outline"></i>Dashboard</a>
                                </li>
                                <li class="nav-item">
                                    <a href="/project"><i class="ion-ios-briefcase"></i>Project</a>
                                </li>
                                <li class="nav-item">
                                    <a href="/manage"><i class="ion-ios-people"></i>Manage User</a>
                                </li>
                                @else
                                <li class="nav-item active">
                                    <a href="/pro"><i class="ion-ios-speedometer-outline"></i>Dashboard</a>
                                </li>
                                @endif
                                <li class="nav-item">
                                    <a href="/mytodo"><i class="ion-ios-contact"></i>My To Do</a>
                                </li>
                                <li class="nav-item">
                                    <a href="/changePassword"><i class="ion-ios-redo"></i>Change Password</a>
                                </li>
                            </ul>
                        </nav>
                        <!-- End drawer navigation -->
                        <div class="drawer-footer">
                            <p class="copyright">AppUI Template &copy;</p>
                            <a href="https://shapebootstrap.net/item/1525731-appui-admin-frontend-template/?ref=rustheme" target="_blank" rel="nofollow">Purchase a license</a>
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
                                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#header-navbar-collapse" aria-expanded="false">
                					<span class="sr-only">Toggle navigation</span>
                					<span class="icon-bar"></span>
                					<span class="icon-bar"></span>
                					<span class="icon-bar"></span>
                				</button>
                                <button class="pull-left hidden-lg hidden-md navbar-toggle" type="button" data-toggle="layout" data-action="sidebar_toggle">
                					<span class="sr-only">Toggle drawer</span>
                					<span class="icon-bar"></span>
                					<span class="icon-bar"></span>
                					<span class="icon-bar"></span>
                				</button>
                                <span class="navbar-page-title">
                					{{ Auth::user()->role==1?'Project Manager':'Programmer'}}
                				</span>
                            </div>

                            <div class="collapse navbar-collapse" id="header-navbar-collapse">

                                <ul class="nav navbar-nav navbar-right navbar-toolbar hidden-sm hidden-xs">
                                    <li class="dropdown dropdown-profile">
                                        <a href="javascript:void(0)" data-toggle="dropdown">
                                            <span class="m-r-sm">{{ Auth::user()->name }} <span class="caret"></span></span>
                                            <img class="img-avatar img-avatar-48"
                                            @if (auth()->user()->photo)
                                            src="{{ asset(auth()->user()->photo) }}"
                                            @else
                                            src="{{ asset('img/avatars/avatar3.jpg') }}"
                                            @endif
                                            alt="User profile"/>
                                        </a>
                                        <ul class="dropdown-menu dropdown-menu-right">
                                            <li>
                                                <a href="{{ route('profile') }}">Profile</a>
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
        <script src="{{ asset('js/core/jquery.min.js') }}"></script>
        <script src="{{ asset('js/core/bootstrap.min.js') }}"></script>
        @stack('script')
    </body>
</html>
