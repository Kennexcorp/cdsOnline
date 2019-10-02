@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-10 mx-auto push-1 login_section">
            <div class="row">
                <div class="col-lg-8 col-sm-8 mx-auto login2_border login_section_top ">
                    <div class="login_logo login_border_radius1">
                        <h3 class="text-center ">
                            <img src="{{asset('img/nysc/banner1.png')}}" alt="logo" class="img-fluid"><br/>
                            <span class="m-t-15">Community Development Service <br/>{{ __('Reset Password') }}</span>
                        </h3>
                    </div>
                    <div class="m-t-15">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <form method="POST" action="{{ route('password.email') }}" class="form-group">
                            @csrf 
                            <div class="login_content login_border_radius">
                                <div class="form-group">
                                    <label for="email" class="">Please enter your email</label>
                                    <div class="input-group">
                                        <input type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }} b_r_20" id="email" name="email" placeholder="E-mail" value="{{ old('email') }}" required>
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
                                <div class="form-group text-center">
                                    <button type="submit" class="btn btn-primary b_r_20 login_button m-t-10">{{ __('Send Password Reset Link') }}
                                    </button>
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
