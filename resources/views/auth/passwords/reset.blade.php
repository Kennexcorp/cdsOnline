@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12 mx-auto login_section">
            <div class="row">
                <div class=" col-lg-4 col-md-8 col-sm-12  mx-auto login2_border login_section_top ">
                    <div class="login_logo login_border_radius1">
                        <h3 class="text-center">
                            <img src="{{asset('img/nysc/banner1.png')}}" alt="logo" class="img-fluid"><br />
                            <span class="m-t-15">Community Development Service <br/>{{ __('Reset Password') }}</span>
                        </h3>
                    </div>
                    <div class="m-t-15">
                        <form method="POST" action="{{ route('password.update') }}" id="login_validator">
                            @csrf
                            <input type="hidden" name="token" value="{{ $token }}">
                            <div class="form-group">
                                <label for="email" class="col-form-label ">{{ __('E-Mail Address') }}</label>
                                <div class="input-group">
                                    <input type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" id="email" value="{{ old('email') }}" required autofocus placeholder="E-mail">
                                    <span class="input-group-text bl-0">
                                        <i class="fa fa-envelope "></i>
                                    </span>
                                </div>
                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="password" class="col-form-label ">{{ __('Password') }}</label>
                                <div class="input-group">
                                    <input type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" id="password" name="password" placeholder="Password" required>
                                    <span class="input-group-text bl-0">
                                        <i class="fa fa-key "></i>
                                    </span>
                                </div>
                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="password-confirm" class="col-form-label ">{{ __('Password') }}</label>
                                <div class="input-group">
                                    <input type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" id="password-confirm" name="password_confirmation" placeholder="Confirm Password" required>
                                    <span class="input-group-text bl-0">
                                        <i class="fa fa-key "></i>
                                    </span>
                                </div>
                                
                            </div>
                            
                            <div class="row">
                                <div class="col-12">
                                    <div class="text-center">
                                        <button type="submit" class="btn btn-success btn-block b_r_20 m-t-20">{{ __('Reset Password') }}</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <div class="row">
                            <div class="col-12">
                                <div class="text-center">
                                    <a href="{{route('landing_page')}}" class="btn btn-danger btn-block b_r_20 m-t-20">{{ __('Cancel') }}</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- global js -->
@endsection
