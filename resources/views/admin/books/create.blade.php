@extends( 'layouts.admin' )

@section( 'content' )
<div class="container">
	<h1 class="admin-heading">{{ __( 'Add a book' ) }}</h1>
    <form class="form" method="POST" action="{{ route( 'books.store' ) }}">
        @csrf
        <input type="hidden" value="{{ $generatedId }}" name="id" required="" />
        <div class="form-group">
            <label>{{ __( 'Title (am)' ) }} <span class="text-danger">*</span></label>
            <input type="text" class="form-control" required="" autofocus="" name="title_am" value="{{ old( 'title_am' ) }}" />
        </div>
        <div class="form-group">
            <label>{{ __( 'Title (ru)' ) }}</label>
            <input type="text" class="form-control" name="title_ru" value="{{ old( 'title_ru' ) }}" />
        </div>
        <div class="form-group">
            <label>{{ __( 'Title (en)' ) }}</label>
            <input type="text" class="form-control" name="title_en" value="{{ old( 'title_en' ) }}" />
        </div>
        <div class="form-group">
            <label>{{ __( 'Author' ) }} <span class="text-danger">*</span></label>
            <select class="form-control" name="author_id" required="">
                @foreach( $authors as $author )
                <option value="{{ $author -> id }}">{{ $author -> title_am }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label>{{ __( 'Section/Subsection' ) }} <span class="text-danger">*</span></label>
            <select class="form-control" name="section_id" required="">
                @foreach( $sections as $section )
                <option value="{{ $section -> id }}">{{ $section -> title_am }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label>{{ __( 'Publish info (am)' ) }} <span class="text-danger">*</span></label>
            <input type="text" class="form-control" required="" autofocus="" name="publish_info_am" value="{{ old( 'publish_info_am' ) }}" />
        </div>
        <div class="form-group">
            <label>{{ __( 'Publish info (ru)' ) }}</label>
            <input type="text" class="form-control" name="publish_info_ru" value="{{ old( 'publish_info__ru' ) }}" />
        </div>
        <div class="form-group">
            <label>{{ __( 'Publish info (en)' ) }}</label>
            <input type="text" class="form-control" name="publish_info_en" value="{{ old( 'publish_info_en' ) }}" />
        </div>
        <div class="form-group">
            <label>{{ __( 'Language' ) }} <span class="text-danger">*</span></label>
            <select class="form-control" name="language_id" required="">
                @foreach( $languages as $lang )
                <option value="{{ $lang -> id }}">{{ $lang -> title_am }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label>{{ __( 'Type' ) }} <span class="text-danger">*</span></label>
            <select name="type_id" class="form-control" required="">
                @foreach( $types as $type )
                <option value="{{ $type -> id }}">{{ $type -> title_am }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label>{{ __( 'PDF file' ) }}</label>
            <input type="text" class="form-control" id="upload_pdf" name="pdf_url" value="{{ old( 'pdf_url' ) }}" />
            <div class="" id='dropzoneDiv' style="display: none;"></div>
        </div>

        <div class="form-group">
            <label>{{ __( 'Price' ) }}</label>
            <input type="text" class="form-control" name="price" value="{{ old( 'price' ) }}" />
        </div>
        <div class="form-group">
            <button class="btn btn-success btn-block">{{ __( 'Save' ) }}</button>
        </div>
    </form>
</div>
@endsection



@section( 'scripts' )
    <link rel="stylesheet" type="text/css" href="/assets/js/dropzone/dropzone.min.css">
    <link rel="stylesheet" type="text/css" href="/assets/js/dropzone/basic.min.css">
    <script type="text/javascript" src="/assets/js/dropzone/dropzone.min.js"></script>
    <script type="text/javascript">
        Dropzone.autoDiscover = false;
        $( function() {
            window.drop = new Dropzone( "div#dropzoneDiv" ,
            {
                url: "{{ route( 'admin.uploadPdf' ) }}",
                timeout: 50000000,
                maxFilesize: 1224,
                autoProcessQueue: true
            });
            $( '#upload_pdf' ).on( 'click' , function( e ) {
                $( this ).attr( 'disabled' , true );
                e.preventDefault();
                openDz();
            });
            function openDz () {
                drop.hiddenFileInput.click();
            }
            drop.on( 'processing' , function() {
                this.options.autoProcessQueue = true;
            });
            drop.on( 'sending' , function(file, xhr, formData){
                formData.append( "bookId" , $( '[name="id"]' ).val() );
                $( '#submitUpload' ).attr( 'disabled' , true );
            });

            drop.on( 'complete' , function( resp ) {
                console.log(resp);
                $( '#upload_pdf' ).attr( 'disabled' , false );
                if ( undefined !== resp.xhr && undefined !== resp.xhr.response ) {
                    var response = resp.xhr.response;
                    // if ( response == )
                    var json = JSON.parse( response );
                    if ( undefined !== json.status && json.status === 'success' ) {
                        var data = json.response;
                        var absolute_url = data[ 'absolute_url' ];
                        $( '#upload_pdf' ).val( absolute_url );
                        // console.log(data);
                    } else {
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
    </script>
@endsection

