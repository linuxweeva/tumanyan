<div class="d-flex justify-content-center">
	@isset( $books )
	@forelse( $books as $key => $book )
		<div class="book-home-page-list-container mx-3">
			<a class="book-home-page-list-wrapper h-100 d-block" href="{{ route( 'home.books.show' , $book -> id ) }}">
				<i class="fa fa-star book-home-page-list-star text-warning" class="fa fa-star"></i>
				<img class="book-home-page-list-img" src="{{ $book -> image_url }}" />
				<p class="book-home-page-list-title">{{ $book -> title }}</p>
			</a>
		</div>
	@empty
		<h2 class="text-center">{{ __( 'Nothing found' ) }}</h2>
	@endforelse
	@else
		<h2 class="text-center">{{ __( 'Nothing found' ) }}</h2>
	@endisset
</div>