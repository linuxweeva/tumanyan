var locale = "am";
$( function() {
    locale = $( '[name="lang"]' ).val() ?? "am";
    handleUploadDropZone();
    handleDataTables();
});


function handleDataTables() {
    var table = $( '#data-table' );
    if( ! table || ! table.length ) return; // no need for init
    initTable( table );
    var table_1 = $( '#data-table-1' );
    if( ! table_1 || ! table_1.length ) return;
    initTable( table_1 );
}

function initTable( el ) {

    el.find( 'tfoot th' ).each( function () {
        var title = $(this).text();
        if ( title.length < 2 ) return;
        $(this).html( '<input type="text" class="form-control" placeholder="' + translate( 'Search' ) + ' ' + title + '" />' );
    });
 
    // DataTable
    var table = el.DataTable({
        language: {
            url: '/assets/js/dataTable/' + locale + '.json',
        },
        order: [[ 0 , "desc" ]],
        initComplete: function () {
            // Apply the search
            this.api().columns().every( function () {
                var that = this;
 
                $( 'input', this.footer() ).on( 'keyup change clear', function () {
                    if ( that.search() !== this.value ) {
                        that
                            .search( this.value )
                            .draw();
                    }
                } );
            } );
        }
    });
}


function handleUploadDropZone () {
    var dropContainer = $( 'div#dropzoneDiv' );
    if( ! dropContainer || ! dropContainer.length ) return; // no need for init
    Dropzone.autoDiscover = false;
    var uploadType;
    var processing;
    var uploadBtn;
    window.drop = new Dropzone( "div#dropzoneDiv" ,
    {
        url: window.uploadPath,
        timeout: 50000000,
        maxFilesize: 1224,
        acceptedFiles: "application/pdf",
        autoProcessQueue: true
    });
    $( '.upload' ).on( 'click' , function( e ) {
        if ( processing === true ) {
            e.preventDefault();
            return;
        }
        var type = $( this ).data( 'type' );
        uploadType = type;
        uploadBtn = $( this );
        $( '.dz-hidden-input' ).attr( 'accept' , 'application/pdf' );
    	window.drop.options.acceptedFiles = 'application/pdf';
        if ( type === 'image' ) {
       		$( '.dz-hidden-input' ).attr( 'accept' , 'image/*' );
        	window.drop.options.acceptedFiles = 'image/*';
        }
        e.preventDefault();
        openDz();
    });
    function openDz () {
        drop.hiddenFileInput.click();
    }
    drop.on( 'processing' , function() {
        this.options.autoProcessQueue = true;
    });
    drop.on( 'sending' , function(file, xhr, formData) {
        processing = true;
        uploadBtn.removeClass( 'fa-check fa-times fa-upload' );
        uploadBtn.toggleClass( 'fa-spinner fa-spin' );
        formData.append( "bookId" , $( '[name="id"]' ).val() );
        formData.append( "type" , uploadType );
        $( '#submit' ).attr( 'disabled' , true );
    });

    drop.on( 'complete' , function( resp ) {
        console.log(resp);
        $( '#submit' ).attr( 'disabled' , false );
        processing = false;
        if ( undefined !== resp.xhr && undefined !== resp.xhr.response ) {
            var response = resp.xhr.response;
            // if ( response == )
            var json = JSON.parse( response );
            if ( undefined !== json.status && json.status === 'success' ) {
                uploadBtn.toggleClass( 'fa-check fa-spinner fa-spin' );
                var data = json.response;
                var absolute_url = data[ 'absolute_url' ];
                var $imgEl = $( 'img.thumbnail' );
                console.log(uploadType,$imgEl)
                if ( uploadType === 'image' && $imgEl && $imgEl.length ) {
                	$imgEl.attr( 'src' , absolute_url );
                }
                $( '[data-input="' + uploadType + '"]' ).val( absolute_url );
                // console.log(data);
                Alert( json.message , 'success' );
            } else {
                uploadBtn.toggleClass( 'fa-times fa-spinner fa-spin' );
            	if ( undefined !== json.message ) {
                	Alert( json.message );
            	} else {
            		Alert( 'Error' );
            	}
            }
        } else {
            alert( "Fatal error, please contact us" );
        }
    });
}