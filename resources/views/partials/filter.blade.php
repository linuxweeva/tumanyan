<div>
	<h3>{{ __( 'Search' ) }}</h3>
	<form class="row d-flex justify-content-between" method="GET" action="">
		<div class="form-group col-6 col-md">
			<label>{{ __( 'Book' ) }}</label>
			<select class="form-control select2" data-autocomplete="{{ route( 'autocomplete.books' ) }}" name="book_id">
				@if ( app( 'request' ) -> input( 'book_id' ) )
					<option selected="" value="{{ Book::whereId( app( 'request' ) -> input( 'book_id' ) ) -> id }}">{{ Book::whereId( app( 'request' ) -> input( 'book_id' ) ) -> title }}</option>
				@else
					<option disabled="true" selected="">{{ __( 'Select a book' ) }}</option>
				@endif
			</select>
		</div>
		<div class="form-group col-6 col-md">
			<label>{{ __( 'Author' ) }}</label>
			<select class="form-control select2" data-autocomplete="{{ route( 'autocomplete.authors' ) }}" name="author_id">
				<option disabled="true" selected="">{{ __( 'Select author' ) }}</option>
			</select>
		</div>
		<div class="form-group col-6 col-md">
			<label>{{ __( 'Section' ) }}</label>
			<select class="form-control select2" data-autocomplete="{{ route( 'autocomplete.sections' ) }}" name="section_id">
				<option disabled="true" selected="">{{ __( 'Select a section' ) }}</option>
			</select>
		</div>
		<div class="form-group col-6 col-md">
			<label>{{ __( 'Publish info' ) }}</label>
			<input type="text" name="publish_info" placeholder="{{ __( 'Input publish info' ) }}" class="form-control" />
		</div>
		<div class="form-group col-6 col-md">
			<label>{{ __( 'Language' ) }}</label>
			<select class="form-control select2" data-autocomplete="{{ route( 'autocomplete.languages' ) }}" name="language_id">
				<option disabled="true" selected="">{{ __( 'Select a language' ) }}</option>
			</select>
		</div>
		@auth
			<div class="form-group col-6 col-md">
				<input type="hidden" name="favorite" value="false" />
				<label>{{ __( 'Personal library' ) }}</label>
				<i class="pointer fa-2x fa fa-star text-secondary"></i>
			</div>
		@endauth
		<div class="form-group col-12">
			<button class="btn btn-primary">Submit</button>
		</div>
	</form>
</div>