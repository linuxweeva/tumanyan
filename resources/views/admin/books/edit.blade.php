@extends( 'layouts.admin' )

@section( 'content' )
<div class="">
	<h1 class="admin-heading">{{ __( 'Edit book' ) }}</h1>
    @include( 'admin.partials.status-error' )
    <form class="form" method="POST" action="{{ route( 'books.update' , $book -> id ) }}">
        @csrf
        <input name="_method" type="hidden" value="PUT">
        <input type="hidden" value="{{ $book -> id }}" name="id" required="" />
        <div class="form-group">
            <label>{{ __( 'Title (am)' ) }} <span class="text-danger">*</span></label>
            <input type="text" class="form-control" required="" autofocus="" name="title_am" value="{{ $book -> title_am }}" />
        </div>
        <div class="form-group">
            <label>{{ __( 'Title (ru)' ) }}</label>
            <input type="text" class="form-control" name="title_ru" value="{{ $book -> title_ru }}" />
        </div>
        <div class="form-group">
            <label>{{ __( 'Title (en)' ) }}</label>
            <input type="text" class="form-control" name="title_en" value="{{ $book -> title_en }}" />
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
            <input type="text" class="form-control" required="" autofocus="" name="publish_info_am" value="{{ $book -> publish_info_am }}" />
        </div>
        <div class="form-group">
            <label>{{ __( 'Publish info (ru)' ) }}</label>
            <input type="text" class="form-control" name="publish_info_ru" value="{{ $book -> publish_info_ru }}" />
        </div>
        <div class="form-group">
            <label>{{ __( 'Publish info (en)' ) }}</label>
            <input type="text" class="form-control" name="publish_info_en" value="{{ $book -> publish_info_en }}" />
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
        <div class="form-group row">
            <label class="col-12">{{ __( 'PDF file' ) }} <span class="text-danger">*</span></label>
            <div class="col">
                <input type="text" data-input="pdf" required="" class="form-control" name="pdf_url" value="{{ $book -> pdf_url }}" />
            </div>
            <div class="col-2 col-md-1">
                <i class="fa fa-2x fa-upload mx-auto pointer upload_pdf" data-type="pdf"></i>
            </div>
            <div class="" id='dropzoneDiv' style="display: none;"></div>
        </div>
        <div class="form-group row">
            <label class="col-12">{{ __( 'PDF partial' ) }}</label>
            <div class="col">
                <input type="text" data-input="pdf_partial" name="pdf_partial_url" class="form-control" value="{{ $book -> pdf_partial_url }}" />
            </div>
            <div class="col-2 col-md-1">
                <i class="fa fa-2x fa-upload mx-auto pointer upload_pdf" data-type="pdf_partial"></i>
            </div>
            <div class="" id='dropzoneDiv' style="display: none;"></div>
        </div>

        <div class="form-group">
            <label>{{ __( 'Price' ) }}</label>
            <input type="text" class="form-control" name="price" value="{{ $book -> price }}" />
        </div>
        <div class="form-group">
            <button id="submit" class="btn btn-success btn-block">{{ __( 'Save' ) }}</button>
        </div>
    </form>
</div>
<script type="text/javascript">
    window.uploadPath = "{{ route( 'admin.uploadPdf' ) }}"
</script>
@endsection



@section( 'scripts_before' )
    <link rel="stylesheet" type="text/css" href="/assets/js/dropzone/dropzone.min.css">
    <link rel="stylesheet" type="text/css" href="/assets/js/dropzone/basic.min.css">
    <script type="text/javascript" src="/assets/js/dropzone/dropzone.min.js"></script>
@endsection

