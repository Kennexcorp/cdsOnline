@extends('layouts.app')

@section('content')

<div class="container">
        <div class="row">
            <div class="col-12 mx-auto login_section">
                <div class="row">
                    <div class="col-lg-8 col-md col-sm-12 mx-auto login_section login2_border register_section_top">
                        <div class="login_logo login_border_radius1">
                            <h3 class="text-center ">
                                <img src="{{asset('img/nysc/banner1.png')}}" alt="logo" class="img-fluid"><br/>
                                <span class="m-t-15">{{ __('Community Development Service') }} <br> <i class="fa fa-user-plus" aria-hidden="true"></i> Registration </span>
                            </h3>
                            @foreach ($errors->all() as $error)
                                <li class=" alert alert-danger p-1">{{$error}}</li>
                            @endforeach
                            @if(session('message'))
                            <div class="text-center alert alert-success">
                                {{(session('message'))}}
                            </div>
                            @endif
                             
                            @if (session('failure'))
                                <div class="alert alert-danger" role="alert">
                                    {{ session('failure') }}
                                </div>
                            @endif
                        </div>
                        <div class="m-t-15">
                            @if(session('status'))
                            <form class="form-horizontal" method="POST" action="{{ route('register') }}">
                                @csrf
                                <div class="row">

                                        <div class="form-group col">
                                                <label for="first_name" class="col-form-label ">First Name *</label>
                                                <div class="input-group">
                                                    <input type="text" class="form-control b_r_20 {{ $errors->has('first_name') ? ' is-invalid' : '' }}" name="first_name" id="first_name" placeholder="First Name" value="{{ old('first_name') }}" required autofocus>
                                                    <span class="input-group-text bl-0">
                                                        <i class="fa fa-user "></i>
                                                    </span>
                                                </div>
                                                @if ($errors->has('first_name'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('first_name') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                            <div class="form-group col">
                                                <label for="last_name" class="col-form-label ">Last Name *</label>
                                                <div class="input-group">
                                                    <input type="text" class="form-control b_r_20 {{ $errors->has('last_name') ? ' is-invalid' : '' }}" name="last_name" id="last_name" placeholder="Last Name" value="{{ old('last_name') }}" required autofocus>
                                                    <span class="input-group-text bl-0">
                                                        <i class="fa fa-user "></i>
                                                    </span>
                                                </div>
                                                @if ($errors->has('last_name'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('last_name') }}</strong>
                                                    </span>
                                                @endif
                                            </div>

                                </div>
                                <div class="form-group ">
                                    <label for="email" class="col-form-label ">Email Address*</label>
                                    <div class="input-group">
                                        <input type="text" placeholder="Email" name="email" id="email" class="form-control b_r_20{{ $errors->has('email') ? ' is-invalid' : '' }}"  value="{{ session('email') }}" readonly required>
                                        <span class="input-group-text  bl-0">
                                            <i class="fa fa-envelope "></i>
                                        </span>
                                    </div>
                                    @if ($errors->has('email'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>
                    

                                <div class="row">
                                    <div class="col-lg col-sm-12 col-md-12">
                                            <div class="form-group ">
                                                    <label for="phone_number" class="col-form-label ">Phone Number*</label>
                                                    <div class="input-group">
                                                        <input type="text" placeholder="Phone Number" name="phone_number" id="phone_number" class="form-control b_r_20{{ $errors->has('phone_number') ? ' is-invalid' : '' }}"  value="{{ old('phone_number') }}" required>
                                                        <span class="input-group-text  bl-0">
                                                            <i class="fa fa-envelope "></i>
                                                        </span>
                                                    </div>
                                                    @if ($errors->has('phone_number'))
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $errors->first('phone_number') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                    </div>
                                    <div class="col-lg col-sm-12 col-md-12">
                                        <div class="form-group">
                                            <label for="state_code" class="col-form-label ">State Code *</label>
                                            <div class="input-group">
                                                <input type="text" class="form-control b_r_20 {{ $errors->has('state_code') ? ' is-invalid' : '' }}" name="state_code" id="state_code" placeholder="State Code" value="{{ old('state_code') }}" required autofocus>
                                                <span class="input-group-text bl-0">
                                                    <i class="fa fa-user "></i>
                                                </span>
                                            </div>
                                            @if ($errors->has('state_code'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('state_code') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="form-group col-lg col-sm-12 col-md-12">
                                            <label for="state" class="col-form-label ">State*</label>
                                            <div class="input-group">
                                                <select type="text" placeholder="state" name="state" id="state" class="form-control b_r_20{{ $errors->has('state') ? ' is-invalid' : '' }}"  value="{{ old('state') }}" required>
                                                <option value="*">Select State</option>
                                                </select>
                                                <span class="input-group-text  bl-0">
                                                    <i class="fa fa-envelope "></i>
                                                </span>
                                            </div>
                                            @if ($errors->has('state'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('state') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                        <div class="form-group col-lg col-sm-12 col-md-12">
                                            <label for="lga" class="col-form-label ">LGA *</label>
                                            <div class="input-group">
                                                <select type="text" class="form-control b_r_20 {{ $errors->has('lga') ? ' is-invalid' : '' }}" name="lga" id="lga" placeholder="LGA" value="{{ old('lga') }}" required autofocus>
                                                <option value="*">Select LGA</option>
                                                </select>
                                                <span class="input-group-text bl-0">
                                                    <i class="fa fa-user "></i>
                                                </span>
                                            </div>
                                            @if ($errors->has('lga'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('lga') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                </div>

                                <div class="form-group">
                                        <label for="cds_group" class="col-form-label ">CDS Group *</label>
                                        <div class="input-group">
                                            <select type="text" class="form-control  {{ $errors->has('cds_group') ? ' is-invalid' : '' }}" name="cds_group" id="cds_group" placeholder="CDS Group" value="{{ old('cds_group') }}" required autofocus>
                                            <option value="*">Please Select CDS Group</option>
                                            @foreach ($groups as $group)
                                            <option value="{{ $group->id }}">  {{ $group->name }} @if($group->code != ""){{ "(".$group->code.")" }}@endif</option>
                                            @endforeach
                                            </select>
                                            <span class="input-group-text bl-0">
                                                <i class="fa fa-user "></i>
                                            </span>
                                        </div>
                                        @if ($errors->has('cds_group'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('cds_group') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                
                                <div class="form-group">
                                    <label for="password" class="col-form-label ">Password *</label>
                                    <div class="input-group">
                                        <input type="password" placeholder="Password" id="password" name="password" class="form-control b_r_20 {{ $errors->has('password') ? ' is-invalid' : '' }}" required>
                                        <span class="input-group-text  bl-0">
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
                                    <label for="password-confirm" class="col-form-label ">Confirm Password *</label>
                                    <div class="input-group">
                                        <input type="password" placeholder="Confirm Password" name="password_confirmation" id="password-confirm" class="form-control b_r_20" required>
                                        <span class="input-group-text bl-0">
                                            <i class="fa fa-key "></i>
                                        </span>
                                    </div>
                                </div>
                                
                                <div class="form-group row">
                                    <div class="col-6">
                                        <button type="submit" class="btn btn-block btn-success login_button b_r_20">Submit</button>
                                    </div>
                                    <div class="col-6">
                                        <button type="reset" class="btn btn-block btn-danger b_r_20">Reset</button>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 text-center">
                                        <label class="col-form-label ">Already have an account?</label>
                                        <a href="{{ route('login')}}" class="text-primary login_hover"><b>Log In</b></a>
                                    </div>
                                </div>
                            </form>
                            @else
                            <form class="form-horizontal" method="POST" action="{{ route('pay') }}">
                                @csrf
                                <div class="row">
                                        <div class="form-group col">
                                                <label for="email" class="col-form-label ">Email Address*</label>
                                                <div class="input-group">
                                                    <input type="text" placeholder="Enter Email" name="email" id="email" class="form-control b_r_20{{ $errors->has('email') ? ' is-invalid' : '' }}"  value="{{ old('email') }}" required>
                                                    <span class="input-group-text  bl-0">
                                                        <i class="fa fa-envelope "></i>
                                                    </span>
                                                </div>
                                                @if ($errors->has('email'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('email') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                
                                </div>
                                <div class="row">
                                    <div class="form-group col">
                                        <button class="btn btn-success col b_r_20" type="submit">Pay Registration Fee (NGN1000) to Proceed</button>
                                    </div>
                                        
                                </div>
                                <div class="row">
                                    <div class="col-12 text-center">
                                        <label class="col-form-label ">Already have an account?</label>
                                        <a href="{{ route('login')}}" class="text-primary login_hover"><b>Log In</b></a>
                                    </div>
                                </div>
                            </form>
                            @endif
                        </div>
                    </div>
                    {{-- @if($errors->all() != null)
                    <div class="col-lg-4 col-md-4 login_section register_section_top">
                        
                    </div>
                    @endif --}}
                </div>
            </div>
        </div>
    </div>
@endsection