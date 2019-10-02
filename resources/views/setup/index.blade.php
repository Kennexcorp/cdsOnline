@extends(('layouts/fixed_menu_header'))
{{-- Page title --}}
@section('title')
    {{ $links['title'] }}
    @parent
@stop

{{-- Page content --}}
@section('content')
    <!-- Content Header (Page header) -->
    <header class="head">
        <div class="main-bar">
            <div class="row no-gutters">
                <div class="col-lg-6">
                    <h4 class="nav_top_align skin_txt">
                        <i class="fa fa-file-o"></i>
                        {{ $links['title'] }}
                    </h4>
                </div>
                <div class="col-lg-6">
                    <ol class="breadcrumb float-right nav_breadcrumb_top_align">
                        <li class="breadcrumb-item">
                            <a href="index1">
                                <i class="fa ti-file" data-pack="default" data-tags=""></i>
                                Dashboard
                            </a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="#">{{ $links['title'] }}</a>
                        </li>
                        <li class="breadcrumb-item active">{{ $links['sub_title'] }}</li>
                    </ol>
                </div>
            </div>
        </div>
    </header>
    <div class="outer">
        <div class="inner bg-white lter bg-container">
            <div class="row">
                <div class="col-lg-4 col-md-12 col-sm-12">
                    <div class="card">
                        <div class="card-header text-center">
                            <i class="ion-settings"></i>
                        </div>
                        <div class="card-body m-t-15">
                            <ul id="menu" >
                               
                                <li class="dropdown_menu {!! (Route::is('setup.regForm') ? 'active':'') !!}">
                                <div class="m-t-15">
                                    <a href="{{ route('setup.regForm')}}">
                                        <i class="ion-home"></i>
                                        <span class="">&nbsp;&nbsp;Fees</span>
                                    </a>
                                </div>
                                </li>

                                <li class="dropdown_menu {!! (Route::is('setup.gateway') ? 'active':'') !!}">
                                <div class="m-t-15">
                                    <a href="{{ route('setup.gateway')}}">
                                        <i class="ion-card"></i>
                                        <span class="">&nbsp;&nbsp;Payment gateway</span>
                                    </a>
                                </div>
                                </li>
                                
                            </ul>
                        </div>
                    </div>
                    
                </div>
                <div class="col-lg-8 col-md-12 col-sm-12">
                    @yield('setup_content')
                </div>
            </div>
        </div>
        <!-- /.inner -->
    </div>
    <!-- /.outer -->
    <!-- /.content -->
@stop

