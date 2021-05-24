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
    <div class="row justify-content-center">
        bla bla bla
    </div>
@include( 'partials.other-links' )
@include( 'partials.email-subscribe' )
</div>
@endsection

@section( 'scripts' )
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
<script type="text/javascript">
    $( '.owl-carousel' ).owlCarousel({
        loop: true,
        center: true,
        margin: 10,
        nav: true ,
        items: 1
    });
</script>
@endsection