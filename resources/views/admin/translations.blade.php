@extends( 'layouts.admin' )

@section( 'content' )
<div class="">
	<h1 class="admin-heading">{{ __( 'Translations' ) }}</h1>
    @include( 'admin.partials.status-error' )
    <form method="POST" action="" class="form">
        @csrf
        <table class="table table-striped table-bordered">
            <thead>
                <th>{{ __( 'Key' ) }}</th>
                <th>{{ __( 'AM' ) }}</th>
                <th>{{ __( 'RU' ) }}</th>
                <th>{{ __( 'EN' ) }}</th>
                <!-- <th>{{ __( 'Created at' ) }}</th> -->
            </thead>
            @foreach( $translations as $key => $trans )
                <tr>
                    <td>{{ $trans -> key }}</td>
                    <td>
                        <input
                        class="form-control" type="text"
                        name="translations[{{$trans->id}}][am]"
                        value="{{ $trans -> am }}" />
                    </td>
                    <td>
                        <input
                        class="form-control" type="text"
                        name="translations[{{$trans->id}}][ru]"
                        value="{{ $trans -> ru }}" />
                    </td>
                    <td>
                        <input
                        class="form-control" type="text"
                        name="translations[{{$trans->id}}][en]"
                        value="{{ $trans -> en }}" />
                    </td>
                    <input class="form-control" value="{{ $trans -> key }}" type="hidden" name="translations[{{$trans->id}}][key]" />
                    <!-- <td>{{ $trans -> created }}</td> -->
                </tr>
            @endforeach
        </table>
        <div class="form-group">
            <button data-addtransrow type="button" class="btn btn-warning text-white w-25 btn-block">
                <i class="fa fa-plus"></i>
                {{ __( "Add row" ) }}
            </button>
        </div>
        <div class="form-group w-100 d-flex my-4">
            {{
                $translations -> links()
            }}
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-success btn-block">{{ __( "Save" ) }}</button>
        </div>
    </form>
</div>
@endsection

@section( 'scripts' )
<script type="text/javascript">
    $( function() {
        $( '[data-addtransrow]' ).click( function() {
            var newId = +new Date();
            var $tr = '\
            <tr>\
                <td>\
                    <input\
                    class="form-control" type="text"\
                    name="translations[' + newId + '][key]"\
                    value="" minlength="3" autofocus="true" />\
                </td>\
                <td>\
                    <input\
                    class="form-control" type="text"\
                    name="translations[' + newId + '][am]"\
                    value="" />\
                </td>\
                <td>\
                    <input\
                    class="form-control" type="text"\
                    name="translations[' + newId + '][ru]"\
                    value="" />\
                </td>\
                <td>\
                    <input\
                    class="form-control" type="text"\
                    name="translations[' + newId + '][en]"\
                    value="" />\
                </td>\
            </tr>\
            ';
            $( 'table tbody' ).append( $tr );
            $( 'table tbody tr:last input:first' ).focus();
        });
    });
</script>
@endsection