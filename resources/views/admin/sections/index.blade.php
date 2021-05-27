@extends( 'layouts.admin' )

@section( 'content' )
<div class="">
	<h1 class="admin-heading">{{ __( 'Book sections/subsections' ) }}</h1>
    @include( 'admin.partials.status-error' )
    <a href="{{ route( 'sections.create' ) }}" class="btn btn-primary"><i class="fa fa-plus"></i> {{ __( 'Add' ) }}</a>
    <table id='data-table' class="table table-striped">
    	<thead>
    		<th>ID</th>
    		<th>{{ __( 'Title (am)' ) }}</th>
    		<th>{{ __( 'Title (ru)' ) }}</th>
    		<th>{{ __( 'Title (en)' ) }}</th>
    		<th>{{ __( 'Created at' ) }}</th>
    		<th><i class="fa fa-wrench"></i></th>
    	</thead>
    	@foreach( $sections as $key => $language )
    		<tr>
    			<td>{{ $language -> id }}</td>
    			<td>{{ $language -> title_am }}</td>
    			<td>{{ $language -> title_ru }}</td>
    			<td>{{ $language -> title_en }}</td>
    			<td>{{ $language -> created }}</td>
    			<td>
                    <a href="{{ route( 'sections.edit' , $language -> id ) }}" class="btn btn-sm btn-warning">
                        <i class="fa fa-edit"></i>
                    </a>
                    <a onclick="return confirm( '{{ __( "Are you sure?" ) }}' )" href="{{ route( 'sections.delete' , $language -> id ) }}" class="btn btn-sm btn-danger">
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