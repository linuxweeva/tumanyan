@extends( 'layouts.admin' )

@section( 'content' )
<div class="">
	<h1 class="admin-heading">{{ __( 'Users' ) }}</h1>
    @include( 'admin.partials.status-error' )
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
    	@foreach( $users as $key => $user )
    		<tr>
    			<td>{{ $user -> id }}</td>
    			<td>{{ $user -> name }}</td>
    			<td>{{ $user -> name }}</td>
    			<td>{{ $user -> email }}</td>
    			<td>{{ $user -> phone }}</td>
    			<td>{{ $user -> balance }}</td>
    			<td>{{ $user -> status }}</td>
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