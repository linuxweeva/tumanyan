
@extends( 'layouts.app' )

@section( 'content' )
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.6.347/pdf_viewer.min.css">
<div class="container">
@include( 'partials.sub-header-menu' )
<iframe style="width:100%;height: 1000px;outline: none;border: none;" src="https://tumanyan.atata.icu/pdf/9/pdf_partial_58.pdf#mode/2up"></iframe>
<canvas id="the-canvas"></canvas>
@include( 'partials.filter' )
@include( 'partials.other-links' )
</div>
@endsection

@section( 'scripts' )
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.6.347/pdf.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.6.347/pdf.worker.min.js"></script>
<script type="text/javascript">
	var url = "https://tumanyan.atata.icu/pdf/9/pdf_partial_58.pdf";
	// var url = "{{ $book -> pdf_available }}";
	var loadingTask = pdfjsLib.getDocument(url);
	loadingTask.promise.then(function(pdf) {
	  console.log('PDF loaded');
	  
	  // Fetch the first page
	  var pageNumber = 1;
	  pdf.getPage(pageNumber).then(function(page) {
	    console.log('Page loaded');
	    
	    var scale = 1.5;
	    var viewport = page.getViewport({scale: scale});

	    // Prepare canvas using PDF page dimensions
	    var canvas = document.getElementById('the-canvas');
	    var context = canvas.getContext('2d');
	    canvas.height = viewport.height;
	    canvas.width = viewport.width;

	    // Render PDF page into canvas context
	    var renderContext = {
	      canvasContext: context,
	      viewport: viewport
	    };
	    var renderTask = page.render(renderContext);
	    renderTask.promise.then(function () {
	      console.log('Page rendered');
	    });
	  });
	}, function (reason) {
	  // PDF loading error
	  console.error(reason);
	});
</script>
@endsection