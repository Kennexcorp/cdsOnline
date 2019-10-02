<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="UTF-8">
    <title>
        @section('title')
        | {{ config('app.name', 'TMS') }}
        @show
    </title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="{{asset('img/logo.png')}}"/>
    <link href="{{asset('img/logo.png')}}" rel="icon">
    <link href="{{asset('img/logo.png')}}" rel="apple-touch-icon">
    <!-- global styles-->
    <link type="text/css" rel="stylesheet" href="{{asset('css/components.css')}}"/>
    <link type="text/css" rel="stylesheet" href="{{asset('css/custom.css')}}"/>
    <link type="text/css" rel="stylesheet" href="#" id="skin_change"/>

    <link rel="stylesheet" type="text/css" href="{{asset('vendors/ionicons/css/ionicons.min.css')}}" />
    <!-- end of global styles-->
    @yield('header_styles')
</head>

<body class="fixedMenu_left fixedNav_position">
<div class="preloader" style=" position: fixed;
  width: 100%;
  height: 100%;
  top: 0;
  left: 0;
  z-index: 100000;
  backface-visibility: hidden;
  background: #ffffff;">
    <div class="preloader_img" style="width: 200px;
  height: 200px;
  position: absolute;
  left: 48%;
  top: 48%;
  background-position: center;
z-index: 999999">
        <img src="{{asset('img/loader.gif')}}" style=" width: 40px;" alt="loading...">
    </div>
</div>
<div id="wrap">
    <div id="top" class="fixed">
        <!-- .navbar -->
        <nav class="navbar navbar-static-top">
            <div class="container-fluid m-0">
                <a class="navbar-brand" href="{{ route('home')}}">
                    <h4 class="text-success"><img src="{{asset('img/nysc/banner1.png')}}" class="img-fluid" alt="logo"></h4>
                </a>
                <div class="menu mr-sm-auto">
                    <span class="toggle-left" id="menu-toggle">
                        <i class="fa fa-bars"></i>
                    </span>
                </div>
                <div class="topnav dropdown-menu-right">
            
                    <div class="btn-group">
                        <div class="user-settings no-bg">
                                <span class="badge badge-{{ auth()->user()->status->style}} p-1"> {{ auth()->user()->status->name}} </span>
                            <button type="button" class="btn btn-default no-bg micheal_btn" data-toggle="dropdown">
                                <img src="{{asset('img/img_holder/small/small_1.jpg')}}" class="admin_img2 img-thumbnail rounded-circle avatar-img"
                                     alt="avatar">
                                     
                                      <strong class="text-success">{{ auth()->user()->name}}</strong>
                                     
                                {{-- <span class="fa fa-sort-down white_bg"></span> --}}
                            </button>
                            {{-- <div class="dropdown-menu admire_admin">
                                @role('Admin')
                                <a class="dropdown-item title" href="#">
                                    {{ config('app.name', 'TMS') }} Admin</a>
                                @endrole
                                @role('Member|Official')
                                <a class="dropdown-item" href="{{ route('profile.show', auth()->user()->profile->user_id) }}">
                                    <i class="fa fa-user">  Profile</i>
                                </a>
                                @endrole
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                                  document.getElementById('logout-form').submit();">
                                                  <i class="fa fa-sign-out"></i>
                                     {{ __('Logout') }}
                                 </a>

                                 <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                     @csrf
                                 </form>
                            </div> --}}
                        </div>
                    </div>

                </div>
            </div>
            <!-- /.container-fluid -->
        </nav>
        <!-- /.navbar -->
        <!-- /.head -->
    </div>
    <!-- /#top -->
    <div class="wrapper fixedNav_top">
        <div id="left" class="fixed">
            <div class="menu_scroll left_scrolled">
                <div class="left_media">
                    <div class="media user-media">
                        <div class="user-media-toggleHover">
                            <span class="fa fa-user"></span>
                        </div>
                        <div class="user-wrapper">
                            <a class="user-link" href="#">
                                <img class="media-object img-thumbnail user-img rounded-circle admin_img3" alt="User Picture"
                                     src="{{asset('img/img_holder/small/small_1.jpg')}}">
                                <p class="user-info menu_hide"> Welcome {{ auth()->user()->name }}</p>
                            </a>
                        </div>
                    </div>
                    <hr/>
                </div>
                <ul id="menu">
                    <li {!! (Route::is('home')? 'class="active"':"") !!}>
                    <a href="{{ route('home')}}">
                        <i class="fa fa-home"></i>
                        <span class="link-title menu_hide">&nbsp;&nbsp;Dashboard</span>
                    </a>
                    </li>
                    @role('Supervisor|Official')
                    <li  class="dropdown_menu {!! (Route::is('attendance.*') ? 'active' : '') !!}">
                        <a href="{{ route('attendance.index') }}">
                            <i class="fa fa-book"></i>
                            <span class="link-title menu_hide">&nbsp;Attendance </span>
                        </a>
                    </li>
                    @endrole
                    @role(['Supervisor|Admin'])
                    <li  class="dropdown_menu {!! (Route::is('members.*') ? 'active' : '') !!}">
                        <a href="{{ route('members.index') }}">
                            <i class="fa fa-users"></i>
                            <span class="link-title menu_hide">&nbsp;Corp Members </span>
                        </a>
                    </li>
                    <li  class="dropdown_menu {!! (Route::is('groups.*') ? 'active' : '') !!}">
                        <a href="{{ route('groups.index') }}">
                            <i class="fa fa-users"></i>
                            <span class="link-title menu_hide">&nbsp;CDS Groups </span>
                        </a>
                    </li>
                    @endrole
                    @role('Admin')
                    <li  class="dropdown_menu {!! (Route::is('supervisors.*') ? 'active' : '') !!}">
                        <a href="{{ route('supervisors.index') }}">
                            <i class="fa fa-users"></i>
                            <span class="link-title menu_hide">&nbsp;Supervisors </span>
                        </a>
                    </li>
                    <li  class="dropdown_menu {!! (Route::is('payment.*') ? 'active' : '') !!}">
                            <a href="{{ route('payment.index') }}">
                                <i class="fa fa-money"></i>
                                <span class="link-title menu_hide">&nbsp;Payments </span>
                            </a>
                        </li>
                    <li  class="dropdown_menu {!! (Route::is('setup.*') ? 'active' : '') !!}">
                        <a href="{{ route('setup.fees') }}">
                            <i class="fa fa-gears"></i>
                            <span class="link-title menu_hide">&nbsp;System Setup </span>
                        </a>
                    </li>
                    @endrole
                    <li class="dropdown_menu">

                            <a class="dropdown-item" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                                          document.getElementById('logout-form').submit();">
                                          <i class="fa fa-sign-out"></i>
                             <span class="ink-title menu_hide">
                                    {{('Logout') }}
                            </span> 
                         </a>

                         <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                             @csrf
                         </form>

                    </li>
                    
                </ul>
                <!-- /#menu -->
            </div>
        </div>
        <!-- /#left -->

        <div id="content" class="bg-container">
            <!-- Content -->
            @yield('content')
            <!-- Content end -->
        </div>
        <div class="text-center  w-auto fixed-bottom text-dark ">Designed and developed by <strong class="text-success">Oguikpu, Ekene Sylvester (Batch C 2018)</strong> State Code: <strong class="text-success">PL/18C/0984 </strong> Contact: <strong class="text-success">08169311714</strong>
        </div>
    </div>
    <!-- /#content -->
    @include('layouts/right_sidebar/fixed_menu_header')

</div>
<!-- /#wrap -->
<!-- global scripts-->
<script type="text/javascript" src="{{asset('js/components.js')}}"></script>
<script type="text/javascript" src="{{asset('js/custom.js')}}"></script>
<!-- end of global scripts-->
<!-- page level js -->
@yield('footer_scripts')
<!-- end page level js -->
</body>
</html>
