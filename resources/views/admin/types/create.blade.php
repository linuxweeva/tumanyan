@extends( 'layouts.admin' )

@section( 'content' )
<div class="">
	<h1 class="admin-heading">{{ __( 'Add a type' ) }}</h1>
    @include( 'admin.partials.status-error' )
    <form class="form" method="POST" action="{{ route( 'types.store' ) }}">
        @csrf
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
            <button id="submit" class="btn btn-success btn-block">{{ __( 'Save' ) }}</button>
        </div>
    </form>
</div>
@endsection