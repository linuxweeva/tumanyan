window.locale = "am";
$( function() {
    configAjax();
	window.locale = $( '[name="lang"]' ).val() ?? "am";
	handleToastr();
});


function configAjax() { // https://laravel.com/docs/master/csrf
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $( 'meta[name="csrf-token"]' ).attr( 'content' )
        }
    });

}

window.translate = function( string ) {
    var translations = { // can be from backend
        "Search": {
            am: 'Փնտրել',
            ru: 'Поиск',
            en: 'Search',
        },
        "email.thanks": {
        	am: "Shnorhakal enq",
        	ru: "Spasiba",
        	en: "Thanks",
        },
        "There was an error": {
        	am: "Xndir",
        	ru: "Problemka",
        	en: "There was an error",
        }
    }
    if ( undefined !== translations[ string ] && undefined !== translations[ string ][ window.locale ] ) {
    	return translations[ string ][ window.locale ];
    }
    return string;
}

function handleToastr() {
	window.Alert = function ( title , type = 'danger' , desc = '' ) {
		switch ( type ) {
			case 'danger':
				toastr.error( desc , title );
				break;
			case 'success':
				toastr.success( desc , title );
				break;
			case 'warning':
				toastr.warning( desc , title );
				break;
			default:
				toastr.error( desc , title );
				break;
		}
	}
}