window.locale = "am";


function loadCss( link ) {
	var rand = parseInt( Math.random() * 1000 );
	$( "head" ).append( "<link id='id_" + rand + "' href='" + link + "' type='text/css' rel='stylesheet' />" );
}

$.getScripts = function( arr , cb ) {
	$.getScript( arr[ 0 ] , function( data, textStatus, jqxhr ) {
		try {
			$.getScript( arr[ 1 ] , function( data, textStatus, jqxhr ) {
				cb( data, textStatus, jqxhr );
			});
		} finally {
			cb( data, textStatus, jqxhr );
		}
	});
}


$( function() {
	window.locale = $( '[name="lang"]' ).val() ?? "am";
    configAjax();
	handleToastr();
	handleSelect2();
});



function handleSelect2() {
	var el = $( '.select2' );
	if ( ! el || ! el.length ) return;
	loadCss( 'https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css' );
	loadCss( 'https://cdn.jsdelivr.net/npm/@ttskch/select2-bootstrap4-theme@x.x.x/dist/select2-bootstrap4.min.css' );
	var localeScript = window.locale === 'en' ? '' : '/assets/js/select2/' + window.locale + '.js';
	$.getScripts([
		'https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js',
		localeScript ,
	] , function( data, textStatus, jqxhr ) {
		// autoFocus bugfix -_-
		$( document ).on( 'select2:open' , function() {
			setTimeout(function() {
				document.querySelector( '.select2-search__field' ).focus();
			});
		});
		// autoFocus bugfix -_-
		$( '.select2' ).each(function() {
			var config = {
				theme: 'bootstrap4',
				language: window.locale
			};
			if ( $( this ).data( 'autocomplete' ) ) {
				config.ajax = {
					url: $( this ).data( 'autocomplete' ),
					delay: 250,
					dataType: 'json',
					data: function ( params ) {
						var query = {
							search: params.term,
							q: params.q,
							locale: window.locale
						}
						return query;
					},
					processResults: function ( data ) {
						console.log(data)
						console.log(data.items)
						if ( undefined === data.items ) return { results: {} }
						return {
							results: data.items
						};
					}
				};
			}
			// console.log(config)
			$( this ).select2( config );
		});
	});
}

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