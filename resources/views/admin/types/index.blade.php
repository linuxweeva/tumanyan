@extends( 'layouts.admin' )

@section( 'content' )
<div class="">
	<h1 class="admin-heading">{{ __( 'Types' ) }}</h1>
    @include( 'admin.partials.status-error' )
    <a href="{{ route( 'types.create' ) }}" class="btn btn-primary"><i class="fa fa-plus"></i> {{ __( 'Add' ) }}</a>
    <table id='data-table' class="table table-striped">
    	<thead>
    		<th>ID</th>
    		<th>{{ __( 'Title (am)' ) }}</th>
    		<th>{{ __( 'Title (ru)' ) }}</th>
    		<th>{{ __( 'Title (en)' ) }}</th>
    		<th>{{ __( 'Created at' ) }}</th>
    		<th><i class="fa fa-wrench"></i></th>
    	</thead>
    	@foreach( $types as $key => $type )
    		<tr>
    			<td>{{ $type -> id }}</td>
    			<td>{{ $type -> title_am }}</td>
    			<td>{{ $type -> title_ru }}</td>
    			<td>{{ $type -> title_en }}</td>
    			<td>{{ $type -> created }}</td>
    			<td>
                    <a href="{{ route( 'types.edit' , $type -> id ) }}" class="btn btn-sm btn-warning">
                        <i class="fa fa-edit"></i>
                    </a>
                    <a onclick="return confirm( '{{ __( "Are you sure?" ) }}' )" href="{{ route( 'types.delete' , $type -> id ) }}" class="btn btn-sm btn-danger">
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
    		<th>{{ __( 'Created at' ) }}</th>
    		<th></th>
        </tfoot>
    </table>
</div>
@endsection