/*
 * Ajax
 */

function uk_ajax_json( element, ajax_url, ajax_data = null, done_notify = true, error_notify = true, fail_notify = true, show_loading = true, file_upload = false ) {
	console.log( "uk_ajax_json : " + ajax_url );
	console.log( ajax_data );
	var aj = new Argo_ajax( "json" );
	aj.done_func = function( result ) {
		if( result.message ) {
			if( done_notify ) {
				uk_notify_success( result.message );
			}
			element.trigger( "ajax-done-message", [ result.message, result, ajax_data ] );
		} else if( result.data ) {
			element.trigger( "ajax-done-data", [ result.data, result, ajax_data ] );
		} else if( result.input_errors ) {
			uk_input_errors( element, result.input_errors );
			element.trigger( "ajax-input-errors", [ result.input_errors, result, ajax_data ] );
		} else if( result.error ) {
			if( error_notify ) {
				uk_notify_danger( result.error );
			}
			element.trigger( "ajax-error", [ result.error, result, ajax_data ] );
		} else {
			if( error_notify ) {
				uk_notify_danger();
			}
			element.trigger( "ajax-error", [ "エラーが発生しました。", result, ajax_data ] );
		}
	};

	aj.fail_func = function() {
		if( fail_notify ) {
			uk_notify_fail();
		}
		element.trigger( "ajax-fail", ajax_data );
	};
	
	aj.file_upload = file_upload;
	aj.show_loading = show_loading;
	
	aj.connect( "POST", ajax_url, ajax_data );
}

function uk_ajax_json_file_upload( element, ajax_url, ajax_data, done_notify = true, error_notify = true, fail_notify = true, show_loading = true ) {
	uk_ajax_json( element, ajax_url, ajax_data, done_notify, error_notify, fail_notify, show_loading, true );
}

function uk_ajax_html( element, ajax_url, ajax_data, fail_notify = true, show_loading = true ) {
	console.log( "uk_ajax_html : " + ajax_url );
	console.log( ajax_data );
	var aj = new Argo_ajax( "html" );
	aj.done_func = function( html ) {
		element.html( html );
		element.trigger( "ajax-done-html", [ html, ajax_data ] );
	};

	aj.fail_func = function() {
		if( fail_notify ) {
			uk_notify_fail();
		}
		element.trigger( "ajax-fail" );
	};
	
	aj.show_loading = show_loading;
	
	aj.connect( "POST", ajax_url, ajax_data );
}

/*
 * 画像ダウンロード
 */

function uk_download_image( element, ajax_url, ajax_data, width = "100%" ) {
	var downloading = element.find( "#downloading" );
	var error = element.find( "#error" );
	var img = element.find( "img" );

	downloading.prop( "hidden", false );

	var aj = new Argo_ajax( "json" );
	aj.done_func = function( result ) {
		if( result.image ) {
			img.attr( "src", result.image );
			img.prop( "hidden", false );
			img.css( "width", width );
		} else if( result.error ) {
			error.text( result.error );
			error.prop( "hidden", false );
		}
		downloading.prop( "hidden", true );
	};

	aj.fail_func = function() {
		error.text( "通信に失敗しました。" );
		downloading.prop( "hidden", true );
	};
	
	aj.show_loading = false;
	aj.connect( "POST", ajax_url, ajax_data );
}

function uk_reset_download_image( element ) {
	var img = element.find( "img" );
	img.prop( "hidden", true );
	img.attr( "src", "" );
	img.css( "width", "" );
	element.find( "#downloading" ).prop( "hidden", true );
	element.find( "#error" ).prop( "hidden", true );
}

/*
 * 入力エラー
 */

function uk_input_errors( element, errors ) {
	errors.forEach( function( error ) {
		console.log( error );
					element.find( "#" + error.feedback_id ).text( error.message );
					element.find( "#" + error.form_id ).addClass( "is-invalid" );
				});
}

function uk_reset_input_errors( element ) {
	element.find( ".form-control" ).removeClass( "is-invalid" );
}

/*
 * QRコード
 */

function uk_qr_start( element, message = "QRコードを読み取ってください。" ) {
	uk_ajax_html( element, "qr", { "id" : element.attr( "id" ), "message" : message }, false );
}

function uk_qr_analyze( element, data ) {

	uk_ajax_json( element, "qr/analyze", { "data" : data } );

}

/*
 * 通知
 */

// 成功
function uk_notify_success( message ) {
	uk_notify( message, "success", "fa fa-thumbs-up" );
}

// エラー
function uk_notify_danger( message = "エラーが発生しました。" ) {
	uk_notify( message, "danger", "fa fa-exclamation-triangle" );
}

// サーバーにアクセスできなかった
function uk_notify_fail( message = "通信に失敗しました。" ) {
	uk_notify_danger( message );
}

// その他
function uk_notify_secondary( message ) {
	uk_notify( message, "secondary" );
}
function uk_notify_success( message ) {
	uk_notify( message, "success" );
}
function uk_notify_warning( message ) {
	uk_notify( message, "warning" );
}
function uk_notify_info( message ) {
	uk_notify( message, "info" );
}
function uk_notify_light( message ) {
	uk_notify( message, "light" );
}
function uk_notify_dark( message ) {
	uk_notify( message, "dark" );
}

function uk_notify( message, type = "info", icon = null ) {
	$.notify({
		// options
		icon: icon,
		message: message
	},{
		// settings
		type: type,
		allow_dismiss: false,
		z_index: 10000
	});
}

