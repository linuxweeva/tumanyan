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
            <select class="form-control select2" name="author_id" data-autocomplete="{{ route( 'autocomplete.authors' ) }}" required="">
                @foreach( $authors as $author )
                <option value="{{ $author -> id }}">{{ $author -> title }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label>{{ __( 'Section/Subsection' ) }} <span class="text-danger">*</span></label>
            <select class="form-control select2" name="section_id" required="" data-autocomplete="{{ route( 'autocomplete.sections' ) }}">
                @foreach( $sections as $section )
                <option value="{{ $section -> id }}">{{ $section -> title }}</option>
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
            <select class="form-control select2" name="language_id" data-autocomplete="{{ route( 'autocomplete.languages' ) }}" required="">
                @foreach( $languages as $lang )
                <option value="{{ $lang -> id }}">{{ $lang -> title }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label>{{ __( 'Type' ) }} <span class="text-danger">*</span></label>
            <select name="type_id" class="form-control select2" data-autocomplete="{{ route( 'autocomplete.types' ) }}" required="">
                @foreach( $types as $type )
                <option value="{{ $type -> id }}">{{ $type -> title }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group row">
            <label class="col-12">{{ __( 'PDF file' ) }} <span class="text-danger">*</span></label>
            <div class="col">
                <input type="text" data-input="full" required="" class="form-control" name="pdf_url" value="{{ $book -> pdf_url }}" />
            </div>
            <div class="col-2 col-md-1">
                <i class="fa fa-2x fa-upload mx-auto pointer upload" data-type="full"></i>
            </div>
            <div class="" id='dropzoneDiv' style="display: none;"></div>
        </div>
        <div class="form-group row">
            <label class="col-12">{{ __( 'PDF partial' ) }}</label>
            <div class="col">
                <input type="text" data-input="partial" name="pdf_partial_url" class="form-control" value="{{ $book -> pdf_partial_url }}" />
            </div>
            <div class="col-2 col-md-1">
                <i class="fa fa-2x fa-upload mx-auto pointer upload" data-type="partial"></i>
            </div>
            <div class="" id='dropzoneDiv' style="display: none;"></div>
        </div>

        <div class="form-group row">
            <label class="col-12">{{ __( 'Image' ) }}</label>
            <div class="col">
                <input type="text" data-input="image" name="image_url" class="form-control" value="{{ $book -> image_url }}" />
            </div>
            <div class="col-2 col-md-1">
                <i class="fa fa-2x fa-upload mx-auto pointer upload" data-type="image"></i>
            </div>
            <div class="col-12">
                <img src="{{ $book -> image_url }}" class="thumbnail my-2 my-md-3" style="max-height: 80px;" />
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

