@extends( 'layouts.admin' )

@section( 'content' )
<div class="">
    <div class="">
        <h1 class="admin-heading">{{ __( 'Subscriptions' ) }}</h1>
        @include( 'admin.partials.status-error' )
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
    <div class="my-5">
        <form class="form" method="POST" action="{{ route( 'subscriptions.store' ) }}">
            @csrf
            <input type="hidden" name="user_ids" value="1, 2,3,4,5,6" />
            <div class="form-group">
                <textarea name="content" id="content" required="" class="form-control"></textarea>
            </div>
            <div class="form-group">
                <button class="btn btn-primary" id="sendSubscription">
                    <i class="fa fa-plus"></i>
                    {{ __( "Add new subscription message" ) }}
                </button>
            </div>
        </form>
    </div>
    <div class="">
        <h1 class="admin-heading">{{ __( 'Sent Messages' ) }}</h1>
        <table id='data-table-1' class="table table-striped">
            <thead>
                <th>ID</th>
                <th>{{ __( 'Message content' ) }}</th>
                <th>{{ __( 'Created at' ) }}</th>
            </thead>
            @foreach( $messages as $key => $message )
                <tr>
                    <td>{{ $message -> id }}</td>
                    <td>{!! $message -> content !!}</td>
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

@section( 'scripts' )
<script src="https://cdn.ckeditor.com/4.16.1/standard/ckeditor.js"></script>
<script type="text/javascript">
    var input = $( 'form input[name="user_ids"]' );
    var contentArea = $( 'form textarea' );
    $( 'form' ).on( 'submit' , function( e ) {
        if ( ! input.val().length ) {
            e.preventDefault();
            Alert( translate( 'Please choose users' ) );
            return;
        }
        if ( contentArea.val().length < 10 ) {
            e.preventDefault();
            Alert( translate( 'Please input content' ) );
            return;
        }
    });
    $( function() {
        CKEDITOR.replace( 'content', {
        });
    })
</script>
@endsection