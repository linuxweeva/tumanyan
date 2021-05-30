var locale = "am";
$( function() {
    locale = $( '[name="lang"]' ).val() ?? "am";
    handleUploadDropZone();
    handleDataTables();
    handleCkEditor();
});


function handleCkEditor() {
    var el = $( '#wysiwyg' );
    if( ! el || ! el.length ) return; // no need for init
    var config = {};
    $.getScripts( [ "https://cdnjs.cloudflare.com/ajax/libs/tinymce/5.7.1/tinymce.min.js" , "https://cdnjs.cloudflare.com/ajax/libs/tinymce/5.7.1/plugins/lists/plugin.min.js" ], function( data, textStatus, jqxhr ) {
      window.wysiwygEl = tinymce.init({
        selector: '#wysiwyg',
        max_height: 900,
        theme: 'silver',
        min_width: 500,
        min_height: 500,
        plugins: "lists",
        toolbar: [
            'bold italic underline | fontselect fontsizeselect | forecolor backcolor',
            'alignleft aligncenter alignright | outdent indent bullist numlist',
            'undo redo copy paste cut',
        ],
        menubar: "file format table",
        // selection_toolbar: 'bold underline | quicklink h2 h3 blockquote',
        // menu: {
            // file: {title: 'File', items: 'newdocument'},
            // edit: {title: 'Edit', items: 'undo redo | cut copy paste pastetext | selectall'},
            // insert: {title: 'Insert', items: 'link media | template hr'},
            // format: {title: 'Format', items: 'bold italic underline strikethrough superscript subscript | formats | removeformat'},
        // }
      });
    });
    // $.getScripts( [ "https://cdn.ckeditor.com/4.16.1/standard/ckeditor.js" , "https://cdnjs.cloudflare.com/ajax/libs/ckeditor/4.16.1/plugins/font/plugin.min.js" ], function( data, textStatus, jqxhr ) {
    //     // CKEDITOR.editorConfig = function( config ) {
    //     //     config.toolbarGroups = [
    //     //         { name: 'document', groups: [ 'mode', 'document', 'doctools' ] },
    //     //         { name: 'clipboard', groups: [ 'clipboard', 'undo' ] },
    //     //         { name: 'editing', groups: [ 'find', 'selection', 'spellchecker', 'editing' ] },
    //     //         { name: 'forms', groups: [ 'forms' ] },
    //     //         '/',
    //     //         { name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ] },
    //     //         { name: 'paragraph', groups: [ 'list', 'indent', 'blocks', 'align', 'bidi', 'paragraph' ] },
    //     //         { name: 'links', groups: [ 'links' ] },
    //     //         { name: 'insert', groups: [ 'insert' ] },
    //     //         '/',
    //     //         { name: 'styles', groups: [ 'styles' ] },
    //     //         { name: 'colors', groups: [ 'colors' ] },
    //     //         { name: 'tools', groups: [ 'tools' ] },
    //     //         { name: 'others', groups: [ 'others' ] },
    //     //         { name: 'about', groups: [ 'about' ] }
    //     //     ];

    //     //     config.removeButtons = 'Source,Save,Templates,NewPage,ExportPdf,Preview,Print,Cut,Copy,Paste,PasteText,PasteFromWord,Find,Replace,SelectAll,Scayt,Form,Checkbox,Radio,TextField,Textarea,Select,Button,ImageButton,HiddenField,Subscript,Superscript,Strike,CopyFormatting,RemoveFormat,Outdent,Indent,Blockquote,CreateDiv,BidiLtr,BidiRtl,Language,Link,Unlink,Anchor,Image,Flash,Table,HorizontalRule,Smiley,SpecialChar,PageBreak,Iframe,Styles,Format,Maximize,ShowBlocks,About';
    //     // };
    //     CKEDITOR.config.toolbar = [
    //        ['Format','Font','FontSize'],
    //        '/',
    //        ['Bold','Italic','Underline','StrikeThrough','-','Undo','Redo','-','Cut','Copy','Paste','Find','Replace','-','Outdent','Indent','-','Print'],
    //        '/',
    //        ['NumberedList','BulletedList','-','JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock'],
    //        ['-','Flash','TextColor','BGColor']
    //     ] ;

    //     window.ckEditorElement = CKEDITOR.replace( 'content' , config );
    // });
}


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