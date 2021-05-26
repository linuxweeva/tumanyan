@foreach ( $errors -> all() as $error )
    <div class="alert alert-danger">
        {{ $error }}
    </div>
@endforeach

@if( Session::has( 'status' ) )
    <div class="text-center alert {{ Session::get( 'alert-class' , 'alert-info' ) }}">
    	{{ Session::get('status') }}
    </div>
@endif
