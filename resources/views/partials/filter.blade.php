<div>
	<h3>{{ __( 'Search' ) }}</h3>
	<form class="row d-flex justify-content-between" method="GET" action="">
		<div class="form-group col-6 col-md">
			<label>{{ __( 'Book' ) }}</label>
			<select class="form-control select2" data-autocomplete="{{ route( 'autocomplete.books' ) }}" name="book_id">
				@if ( isset( $filters[ 'book_id' ] ) )
					<option selected="" value="{{ $filters[ 'book_id' ] -> id }}">{{ $filters[ 'book_id' ] -> title }}</option>
				@else
					<option disabled="true" selected="">{{ __( 'Select a book' ) }}</option>
				@endif
			</select>
		</div>
		<div class="form-group col-6 col-md">
			<label>{{ __( 'Author' ) }}</label>
			<select class="form-control select2" data-autocomplete="{{ route( 'autocomplete.authors' ) }}" name="author_id">
				@if ( isset( $filters[ 'author_id' ] ) )
					<option selected="" value="{{ $filters[ 'author_id' ] -> id }}">{{ $filters[ 'author_id' ] -> title }}</option>
				@else
					<option disabled="true" selected="">{{ __( 'Select author' ) }}</option>
				@endif
			</select>
		</div>
		<div class="form-group col-6 col-md">
			<label>{{ __( 'Section' ) }}</label>
			<select class="form-control select2" data-autocomplete="{{ route( 'autocomplete.sections' ) }}" name="section_id">
				@if ( isset( $filters[ 'section_id' ] ) )
					<option selected="" value="{{ $filters[ 'section_id' ] -> id }}">{{ $filters[ 'section_id' ] -> title }}</option>
				@else
					<option disabled="true" selected="">{{ __( 'Select a section' ) }}</option>
				@endif
			</select>
		</div>
		<div class="form-group col-6 col-md">
			<label>{{ __( 'Publish info' ) }}</label>
			<input type="text" name="publish_info" placeholder="{{ __( 'Input publish info' ) }}" class="form-control"
				value="{{
					app( 'request' ) -> input( 'publish_info' ) ? app( 'request' ) -> input( 'publish_info' ) : ''
				}}"
			 />
		</div>
		<div class="form-group col-6 col-md">
			<label>{{ __( 'Language' ) }}</label>
			<select class="form-control select2" data-autocomplete="{{ route( 'autocomplete.languages' ) }}" name="language_id">
				@if ( isset( $filters[ 'language_id' ] ) )
					<option selected="" value="{{ $filters[ 'language_id' ] -> id }}">{{ $filters[ 'language_id' ] -> title }}</option>
				@else
					<option disabled="true" selected="">{{ __( 'Select a language' ) }}</option>
				@endif
			</select>
		</div>
		@auth
			<div class="form-group col-6 col-md">
				<input type="hidden" name="favorite" value="{{ app( 'request' ) -> input( 'favorite' ) === 'true' ? 'true' : 'false' }}" />
				<label>{{ __( 'Personal library' ) }}</label>
				<i class="pointer fa-2x fa fa-star {{ app( 'request' ) -> input( 'favorite' ) === 'true' ? 'text-warning' : 'text-secondary' }}"></i>
			</div>
		@endauth
		<div class="form-group col-12">
			<button class="btn btn-primary">Submit</button>
		</div>
	</form>
</div>