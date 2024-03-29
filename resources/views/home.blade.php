@extends( 'layouts.app' )

@section( 'content' )
<div class="container">
@include( 'partials.sub-header-menu' )
@include( 'partials.carousel' )
<div class="text-container flex-column text-center align-items-center d-flex justify-content-center">
    <h2>Some text</h2>
    <p>Some text</p>
</div>
@include( 'partials.filter' )
@include( 'books.home-list' )
@include( 'partials.other-links' )
@include( 'partials.email-subscribe' )
</div>
@endsection