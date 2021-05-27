@extends( 'layouts.app' )

@section( 'content' )
<div class="container">
    @include( 'partials.sub-header-menu' )
    <div class="account-container">
        <h2 class="account-heading">{{ __( 'Personal details' ) }}</h2>
        <form method="POST" action="{{ route( 'account.update' ) }}" class="account-form">
            @csrf
            <div class="form-group row mx-md-3 d-flex">
                <label for="name" class="col-form-label text-md-right text-center label-form">{{ __( 'First name' ) }} <span class="text-danger">*</span></label>
                <div class="col-md">
                    <input type="text" autofocus class="form-control @error( 'name' ) is-invalid @enderror" id="name" name="name" required="" value="{{ $user[ 'name' ] }}" />
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
                    <input type="text" class="form-control @error( 'last_name' ) is-invalid @enderror" id="last_name" name="last_name" required=""  value="{{ $user[ 'last_name' ] }}" />
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
                    <input type="email" class="form-control @error( 'email' ) is-invalid @enderror" id="email" name="email" required=""  value="{{ $user[ 'email' ] }}" />
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
                    <input type="text" class="form-control @error( 'phone' ) is-invalid @enderror" id="phone" name="phone"  value="{{ $user[ 'phone' ] }}" />
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
                    <input type="password" class="form-control @error( 'password' ) is-invalid @enderror" id="password" name="password" required=""  value="{{ $user[ 'password' ] }}" />
                    @error( 'password' )
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
                        {{ __( 'Save' ) }}
                    </button>
                </div>
            </div>
        </form>
    </div>
    @include( 'partials.other-links' )
</div>
@endsection