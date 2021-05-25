$( function() {
    handleUploadDropZone();
});



function handleUploadDropZone () {
    Dropzone.autoDiscover = false;
    var uploadType;
    var uploadBtn;
    $( function() {
        window.drop = new Dropzone( "div#dropzoneDiv" ,
        {
            url: window.uploadPath,
            timeout: 50000000,
            maxFilesize: 1224,
            acceptedFiles: "application/pdf",
            autoProcessQueue: true
        });
        $( '.upload_pdf' ).on( 'click' , function( e ) {
            var type = $( this ).data( 'type' );
            uploadType = type;
            uploadBtn = $( this );
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
            uploadBtn.toggleClass( 'fa-upload fa-spinner fa-spin' );
            formData.append( "bookId" , $( '[name="id"]' ).val() );
            formData.append( "type" , uploadType );
            $( '#submit' ).attr( 'disabled' , true );
        });

        drop.on( 'complete' , function( resp ) {
            console.log(resp);
            $( '#submit' ).attr( 'disabled' , false );
            if ( undefined !== resp.xhr && undefined !== resp.xhr.response ) {
                var response = resp.xhr.response;
                // if ( response == )
                var json = JSON.parse( response );
                if ( undefined !== json.status && json.status === 'success' ) {
                    uploadBtn.toggleClass( 'fa-check fa-spinner fa-spin' );
                    var data = json.response;
                    var absolute_url = data[ 'absolute_url' ];
                    $( '[data-input="' + uploadType + '"]' ).val( absolute_url );
                    // console.log(data);
                } else {
                    uploadBtn.toggleClass( 'fa-times fa-spinner fa-spin' );
                    // if ( undefined !== json.fileName ) {
                    //     errorFileNamesListFull.push( json.fileName + " </br>" );
                    //     errorFileNamesList.push( json.fileName.substring( 0 , 25 ) + "... </br>" );
                    // }
                    // setDzFileCount( --fileCount );
                }
            } else {
                alert( "Fatal error, please contact us" );
            }
        });

    });
}