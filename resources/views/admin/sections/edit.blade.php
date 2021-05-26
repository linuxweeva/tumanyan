@extends( 'layouts.admin' )

@section( 'content' )
<div class="">
	<h1 class="admin-heading">{{ __( 'Edit section' ) }}</h1>
    @include( 'admin.partials.status-error' )
    <form class="form" method="POST" action="{{ route( 'sections.update' , $section -> id ) }}">
        @csrf
        <input name="_method" type="hidden" value="PUT">
        <input type="hidden" value="{{ $section -> id }}" name="id" required="" />
        <div class="form-group">
            <label>{{ __( 'Title (am)' ) }} <span class="text-danger">*</span></label>
            <input type="text" class="form-control" required="" autofocus="" name="title_am" value="{{ $section -> title_am }}" />
        </div>
        <div class="form-group">
            <label>{{ __( 'Title (ru)' ) }}  <span class="text-danger">*</span></label>
            <input type="text" class="form-control" name="title_ru" required="" value="{{ $section -> title_ru }}" />
        </div>
        <div class="form-group">
            <label>{{ __( 'Title (en)' ) }}  <span class="text-danger">*</span></label>
            <input type="text" class="form-control" name="title_en" required="" value="{{ $section -> title_en }}" />
        </div>
        <div class="form-group">
            <button id="submit" class="btn btn-success btn-block">{{ __( 'Save' ) }}</button>
        </div>
    </form>
</div>
@endsection