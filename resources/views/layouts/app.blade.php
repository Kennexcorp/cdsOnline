<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1"> 

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'TMS') }}</title>

    <!-- Scripts -->
    <link rel="shortcut icon" href="{{asset('img/logo.png')}}"/>
    <!--Global styles -->
    <link type="text/css" rel="stylesheet" href="{{asset('css/components.css')}}" />
    <link type="text/css" rel="stylesheet" href="{{asset('css/custom.css')}}" />
    <!--End of Global styles -->
    <!--Plugin styles-->
    <link type="text/css" rel="stylesheet" href="{{asset('vendors/bootstrapvalidator/css/bootstrapValidator.min.css')}}"/>
    <!--End of Plugin styles-->
    <link type="text/css" rel="stylesheet" href="{{asset('css/pages/login3.css')}}"/>
</head>
<body class="login_backimg">
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
              <img src="{{asset('img/loader.gif')}}"  style=" width: 40px;" alt="loading...">
          </div>
      </div>
    <div id="app">
        

        <main class="py-4">
            @yield('content')
        </main>
    </div>
    <footer class="text-center bg-white w-auto fixed-bottom">Designed and Developed by <strong class="text-success">Oguikpu, Ekene Sylvester (Batch C 2018) </strong> State Code: <strong class="text-success">PL/18C/0984 </strong> Contact: <strong class="text-success">08169311714</strong></footer>

    <script type="text/javascript" src="{{asset('js/jquery.min.js')}}"></script>
<script type="text/javascript" src="{{asset('js/popper.js')}}"></script>
<script type="text/javascript" src="{{asset('js/bootstrap.min.js')}}"></script>
<!-- end of global js-->
<!--Plugin js-->
<script type="text/javascript" src="{{asset('vendors/bootstrapvalidator/js/bootstrapValidator.min.js')}}"></script>
<script type="text/javascript" src="{{asset('vendors/jquery.backstretch/js/jquery.backstretch.js')}}"></script>
<!--End of plugin js-->
<script type="text/javascript" src="{{asset('js/pages/login3.js')}}"></script>
<script type="text/javascript" src="{{asset('js/main.js')}}"></script>
</body>
</html>
