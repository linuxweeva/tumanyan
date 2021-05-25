@extends( 'layouts.admin' )

@section( 'content' )
<div class="container">
	<h1 class="admin-heading">{{ __( 'Books' ) }}</h1>
    <a href="{{ route( 'books.create' ) }}" class="btn btn-primary"><i class="fa fa-plus"></i> {{ __( 'Add' ) }}</a>
    <table id='data-table' class="table table-striped">
    	<thead>
    		<th>ID</th>
    		<th>{{ __( 'First Name' ) }}</th>
    		<th>{{ __( 'Last Name' ) }}</th>
    		<th>{{ __( 'E-mail' ) }}</th>
    		<th>{{ __( 'Phone number' ) }}</th>
    		<th>{{ __( 'Balance' ) }}</th>
    		<th>{{ __( 'Status' ) }}</th>
    	</thead>
    	@foreach( $books as $key => $book )
    		<tr>
    			<td>{{ $book -> id }}</td>
    			<td>{{ $book -> name }}</td>
    			<td>{{ $book -> name }}</td>
    			<td>{{ $book -> email }}</td>
    			<td>{{ $book -> phone }}</td>
    			<td>{{ $book -> balance }}</td>
    			<td>{{ $book -> status }}</td>
    		</tr>
    	@endforeach
    	<tfoot>
    		<th>ID</th>
    		<th>{{ __( 'First Name' ) }}</th>
    		<th>{{ __( 'Last Name' ) }}</th>
    		<th>{{ __( 'E-mail' ) }}</th>
    		<th>{{ __( 'Phone number' ) }}</th>
    		<th>{{ __( 'Balance' ) }}</th>
    		<th>{{ __( 'Status' ) }}</th>
    	</tfoot>
    </table>
</div>
@endsection

@section( 'scripts' )
<script type="text/javascript">
	$( '#data-table tfoot th' ).each( function () {
		var title = $(this).text();
		$(this).html( '<input type="text" placeholder="{{ __( "Search" ) }} '+title+'" />' );
	});
 
    // DataTable
    var table = $( '#data-table' ).DataTable({
    	language: {
    		url: '//cdn.datatables.net/plug-ins/1.10.24/i18n/Armenian.json',
    	},
        initComplete: function () {
            // Apply the search
            this.api().columns().every( function () {
                var that = this;
 
                $( 'input', this.footer() ).on( 'keyup change clear', function () {
                    if ( that.search() !== this.value ) {
                        that
                            .search( this.value )
                            .draw();
                    }
                } );
            } );
        }
    });
</script>
@endsection