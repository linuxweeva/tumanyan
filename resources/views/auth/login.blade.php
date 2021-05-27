@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="account-container">
            <div class="">
                <h2 class="account-heading">{{ __( 'Login' ) }}</h2>

                <div class="">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group row mx-md-3 d-flex">
                            <label for="email" class="col-form-label text-md-right text-center label-form">{{ __( 'E-Mail Address' ) }} <span class="text-danger">*</span></label>
                            <div class="col-md">
                                <input type="email" autofocus class="form-control @error('email') is-invalid @enderror" id="email" name="email" required="" value="{{ old( 'email' ) }}" />
                                @error( 'email' )
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row mx-md-3 d-flex">
                            <label for="password" class="col-form-label text-md-right text-center label-form">{{ __( 'Password' ) }} <span class="text-danger">*</span></label>
                            <div class="col-md">
                                <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" required="" value="{{ old( 'password' ) }}" />
                                    @error( 'password' )
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                            </div>
                        </div>
                        <div class="form-group row mx-md-3 d-flex justify-content-center">
                            <div class="form-check text-center">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                <label class="form-check-label" for="remember">
                                    {{ __('Remember Me') }}
                                </label>
                            </div>
                        </div>

                        <div class="form-group row mx-md-3 d-flex justify-content-center">
                            <div class="col-md text-center">
                                <button type="submit" class="btn btn-primary btn-block">
                                    {{ __('Login') }}
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row mx-md-3 d-flex justify-content-center">
                            <div class="col-md text-center">
                                <a href="{{ route( 'register' ) }}" type="submit" class="btn btn-primary btn-block">
                                    {{ __('Create new account') }}
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
