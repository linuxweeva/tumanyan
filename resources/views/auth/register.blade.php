@extends('layouts.app')

@section('content')
<div class="">

    <div class="account-container">
        <h2 class="account-heading">{{ __( 'Create new account' ) }}</h2>
        <form method="POST" action="{{ route('register') }}" class="account-form">
            @csrf
            <div class="form-group row mx-md-3 d-flex">
                <label for="name" class="col-form-label text-md-right text-center label-form">{{ __( 'First name' ) }} <span class="text-danger">*</span></label>
                <div class="col-md">
                    <input type="text" autofocus class="form-control @error( 'name' ) is-invalid @enderror" id="name" name="name" required="" value="{{ old( 'name' ) }}" />
                    @error( 'name' )
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            <div class="form-group row mx-md-3 d-flex">
                <label for="last_name" class="col-form-label text-md-right text-center label-form">{{ __( 'Last name' ) }} <span class="text-danger">*</span></label>
                <div class="col-md">
                    <input type="text" class="form-control @error( 'last_name' ) is-invalid @enderror" id="last_name" name="last_name" required=""  value="{{ old( 'last_name' ) }}" />
                    @error( 'last_name' )
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            <div class="form-group row mx-md-3 d-flex">
                <label for="email" class="col-form-label text-md-right text-center label-form">{{ __( 'E-mail' ) }} <span class="text-danger">*</span></label>
                <div class="col-md">
                    <input type="email" class="form-control @error( 'email' ) is-invalid @enderror" id="email" name="email" required=""  value="{{ old( 'email' ) }}" />
                    @error( 'email' )
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            <div class="form-group row mx-md-3 d-flex">
                <label for="phone" class="col-form-label text-md-right text-center label-form">{{ __( 'Phone number' ) }}</label>
                <div class="col-md">
                    <input type="text" class="form-control @error( 'phone' ) is-invalid @enderror" id="phone" name="phone"  value="{{ old( 'phone' ) }}" />
                    @error( 'phone' )
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            <div class="form-group row mx-md-3 d-flex">
                <label for="password" class="col-form-label text-md-right text-center label-form">{{ __( 'Password' )  }} <span class="text-danger">*</span></label>
                <div class="col-md">
                    <input type="password" class="form-control @error( 'password' ) is-invalid @enderror" id="password" name="password" required=""  value="{{ old( 'password' ) }}" />
                    @error( 'password' )
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            <div class="form-group row mx-md-3 d-flex">
                <label for="password_confirmation" class="col-form-label text-md-right text-center label-form">{{ __( 'Confirm password' )  }} <span class="text-danger">*</span></label>
                <div class="col-md">
                    <input type="password" class="form-control @error( 'password_confirmation' ) is-invalid @enderror" id="password_confirmation" name="password_confirmation" required=""  value="{{ old( 'password_confirmation' ) }}" />
                    @error( 'password_confirmation' )
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            <div class="form-group row mx-md-3 d-flex justify-content-center">
                <div class="col-md text-center">
                    <label class="">{{ __( 'Fields marked with * are required' )  }}</label>
                    <button type="submit" class="btn btn-primary btn-block">
                        {{ __( 'Create' ) }}
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
