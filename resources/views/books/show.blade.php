
@extends( 'layouts.app' )

@section( 'content' )
<link rel="stylesheet" type="text/css" href="/assets/js/BookReader/BookReader.css">
<div id="BookReader" style="height: 500px;width: 80vw;margin: auto;">
</div>
@endsection
@section( 'scripts' )
<script type="text/javascript" src="/assets/js/BookReader/BookReader.js"></script>
  <script>
  	function instantiateBookReader(selector, extraOptions) {
  var data = JSON.parse( '{!! json_encode( $book -> fullPages ) !!}' );
  var dataPartial = JSON.parse( '{!! json_encode( $book -> partialPages ) !!}' );
  selector = selector || '#BookReader';
  extraOptions = extraOptions || {};
  var options = {
    data: data,

    // Book title and the URL used for the book title link
    bookTitle: 'BookReader Demo',
    bookUrl: '/pdf/2279029329800/full_88.pdf',
    bookUrlText: 'Back to Demos',
    bookUrlTitle: 'This is the book URL title',

    // thumbnail is optional, but it is used in the info dialog
    thumbnail: '{{ $book -> firstPages[ "full" ] }}',
    // Metadata is optional, but it is used in the info dialog
    metadata: [
      {label: 'Title', value: 'Open Library BookReader Presentation'},
      {label: 'Author', value: 'Internet Archive'},
      {label: 'Demo Info', value: 'This demo shows how one could use BookReader with their own content.'},
    ],

    // Override the path used to find UI images
    imagesBaseURL: '../BookReader/images/',

    ui: 'full', // embed, full (responsive)

    el: selector,
  };
  $.extend(options, extraOptions);
  var br = new BookReader(options);
  br.init();
}
  instantiateBookReader('#BookReader');
  </script>
@endsection