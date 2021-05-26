@extends( 'layouts.admin' )

@section( 'content' )
<div class="">
	<h1 class="admin-heading">{{ __( 'Books' ) }}</h1>
    @include( 'admin.partials.status-error' )
    <a href="{{ route( 'books.create' ) }}" class="btn btn-primary"><i class="fa fa-plus"></i> {{ __( 'Add' ) }}</a>
    <table id='data-table' class="table table-striped">
    	<thead>
    		<th>ID</th>
    		<th>{{ __( 'Title (am)' ) }}</th>
    		<th>{{ __( 'Title (ru)' ) }}</th>
    		<th>{{ __( 'Title (en)' ) }}</th>
    		<th>{{ __( 'Author' ) }}</th>
    		<th>{{ __( 'Section/Subsection' ) }}</th>
            <th>{{ __( 'Publish info (am)' ) }}</th>
            <th>{{ __( 'Publish info (ru)' ) }}</th>
            <th>{{ __( 'Publish info (en)' ) }}</th>
            <th>{{ __( 'Language' ) }}</th>
            <th>{{ __( 'Type' ) }}</th>
            <th>{{ __( 'Price' ) }}</th>
    		<th><i class="fa fa-wrench"></i></th>
    	</thead>
    	@foreach( $books as $key => $book )
    		<tr>
    			<td>{{ $book -> id }}</td>
    			<td>{{ $book -> title_am }}</td>
    			<td>{{ $book -> title_ru }}</td>
    			<td>{{ $book -> title_en }}</td>
    			<td>{{ $book -> author -> title }}</td>
    			<td>{{ $book -> section -> title }}</td>
                <td>{{ $book -> publish_info_am }}</td>
                <td>{{ $book -> publish_info_ru }}</td>
                <td>{{ $book -> publish_info_en }}</td>
                <td>{{ $book -> language -> title }}</td>
                <td>{{ $book -> type -> title }}</td>
                <td>{{ $book -> price }}</td>
    			<td>
                    <a href="{{ route( 'books.edit' , $book -> id ) }}" class="btn btn-sm btn-warning">
                        <i class="fa fa-edit"></i>
                    </a>
                    <a onclick="return confirm( '{{ __( "Are you sure?" ) }}' )" href="{{ route( 'books.delete' , $book -> id ) }}" class="btn btn-sm btn-danger">
                        <i class="fa fa-trash"></i>
                    </a>
                </td>
    		</tr>
    	@endforeach
        <tfoot>
            <th>ID</th>
            <th>{{ __( 'Title (am)' ) }}</th>
            <th>{{ __( 'Title (ru)' ) }}</th>
            <th>{{ __( 'Title (en)' ) }}</th>
            <th>{{ __( 'Author' ) }}</th>
            <th>{{ __( 'Section/Subsection' ) }}</th>
            <th>{{ __( 'Publish info (am)' ) }}</th>
            <th>{{ __( 'Publish info (ru)' ) }}</th>
            <th>{{ __( 'Publish info (en)' ) }}</th>
            <th>{{ __( 'Language' ) }}</th>
            <th>{{ __( 'Type' ) }}</th>
            <th>{{ __( 'Price' ) }}</th>
            <th><i class="fa fa-wrench"></i></th>
        </tfoot>
    </table>
</div>
@endsection