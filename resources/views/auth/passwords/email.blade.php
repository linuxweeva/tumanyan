@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="account-container">
            <div class="">
                <div class="account-heading">{{ __('Reset Password') }}</div>

                <div class="">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route( 'password.email' ) }}">
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

                        <div class="form-group row mx-md-3 d-flex justify-content-center">
                            <div class="col-md text-center">
                                <button type="submit" class="btn btn-primary btn-block">
                                    {{ __('Send Password Reset Link') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
