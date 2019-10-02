@extends('layouts.app')

@section('content')
 
<div class="container">
        <div class="row">
            <div class="col-12 mx-auto login_section">
                <div class="row">
                    <div class=" col-lg-8 col-md-8 col-sm-12 mx-auto login2_border login_section_top">
                        <div class="login_logo login_border_radius1">
                            <h3 class="text-center">
                                <img src="{{asset('img/nysc/banner1.png')}}" alt="logo" class="img-fluid"><br />
                                <span class="m-t-15">{{ __('Community Development Service') }} <br> <i class="fa fa-sign-in" aria-hidden="true"></i> Login</span>
                            </h3>
                        </div>
                        <div class="m-t-15">
                            @if($errors->count() > 0)
                            <li class="text-danger">These credentials do not match our records.</li>
                            @endif
                            
                            <form method="POST" action="{{ route('login') }}" id="login_validator">
                                @csrf
                                <div class="form-group">
                                    <label for="email" class="col-form-label ">{{ __('State Code/Email') }}</label>
                                    <div class="input-group">
                                        <input type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" id="email" value="{{ old('email') }}" required autofocus placeholder="State Code eg. PL/18C/0984">
                                        <span class="input-group-text bl-0">
                                            <i class="fa fa-envelope "></i>
                                        </span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="password" class="col-form-label ">{{ __('Password') }}</label>
                                    <div class="input-group">
                                        <input type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" id="password" name="password" placeholder="Password" required>
                                        <span class="input-group-text bl-0">
                                            <i class="fa fa-key "></i>
                                        </span>
                                    </div>
                                </div>
                                <div class="row m-t-15">
                                    <div class="col-lg-12">
                                        <label class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input form-control" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                            <span class="custom-control-label"></span>
                                            <a class="">Keep me logged in</a>
                                        </label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6 m-t-10">
                                        <a  href="{{ route('register') }}"  class="forgottxt_clr "><i class="fa fa-external-link"></i> Register Now</a>
                                    </div>
                                    <div class="col-6 p-l-0 m-t-10">
                                        <div class="float-right">
                                            <a href="{{ route('password.request') }}" class="forgottxt_clr ">Forgot password ?</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <div class="text-center">
                                            <button type="submit" class="btn btn-success btn-block b_r_20 m-t-20">{{ __('Login') }}</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection