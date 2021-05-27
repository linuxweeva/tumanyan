@extends( 'layouts.admin' )

@section( 'content' )
<div class="">
    <div class="">
        <h1 class="admin-heading">{{ __( 'Subscriptions' ) }}</h1>
        <table id='data-table' class="table table-striped">
            <thead>
                <th>ID</th>
                <th>{{ __( 'E-mail' ) }}</th>
                <th>{{ __( 'Created at' ) }}</th>
                <th><i class="fa fa-check-square"></i></th>
            </thead>
            @foreach( $subscriptions as $key => $subscription )
                <tr>
                    <td>{{ $subscription -> id }}</td>
                    <td>{{ $subscription -> email }}</td>
                    <td>{{ $subscription -> created }}</td>
                    <td>
                        Some code to come, checkboxes -_
                    </td>
                </tr>
            @endforeach
            <tfoot>
                <th>ID</th>
                <th>{{ __( 'E-mail' ) }}</th>
                <th>{{ __( 'Created at' ) }}</th>
                <th></th>
            </tfoot>
        </table>
    </div>
    <div class="">
        <h1 class="admin-heading">{{ __( 'Messages' ) }}</h1>
        <table id='data-table-1' class="table table-striped">
            <thead>
                <th>ID</th>
                <th>{{ __( 'Message content' ) }}</th>
                <th>{{ __( 'Created at' ) }}</th>
            </thead>
            @foreach( $messages as $key => $message )
                <tr>
                    <td>{{ $message -> id }}</td>
                    <td>{{ $message -> content }}</td>
                    <td>{{ $message -> created }}</td>
                </tr>
            @endforeach
            <tfoot>
                <th>ID</th>
                <th>{{ __( 'Message content' ) }}</th>
                <th>{{ __( 'Created at' ) }}</th>
            </tfoot>
        </table>
    </div>
</div>
@endsection