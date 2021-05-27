@extends( 'layouts.admin' )

@section( 'content' )
<div class="">
	<h1 class="admin-heading">{{ __( 'Add a language' ) }}</h1>
    <form class="form" method="POST" action="{{ route( 'languages.update' , $language -> id ) }}">
        @csrf
        <input name="_method" type="hidden" value="PUT">
        <input type="hidden" value="{{ $language -> id }}" name="id" required="" />
        <div class="form-group">
            <label>{{ __( 'Title (am)' ) }} <span class="text-danger">*</span></label>
            <input type="text" class="form-control" required="" autofocus="" name="title_am" value="{{ $language -> title_am }}" />
        </div>
        <div class="form-group">
            <label>{{ __( 'Title (ru)' ) }}  <span class="text-danger">*</span></label>
            <input type="text" class="form-control" name="title_ru" required="" value="{{ $language -> title_ru }}" />
        </div>
        <div class="form-group">
            <label>{{ __( 'Title (en)' ) }}  <span class="text-danger">*</span></label>
            <input type="text" class="form-control" name="title_en" required="" value="{{ $language -> title_en }}" />
        </div>
        <div class="form-group">
            <button id="submit" class="btn btn-success btn-block">{{ __( 'Save' ) }}</button>
        </div>
    </form>
</div>
@endsection