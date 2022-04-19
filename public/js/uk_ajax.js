/*
 * Ajax
 */

function uk_ajax_json( element, ajax_url, ajax_data = null, done_notify = true, error_notify = true, fail_notify = true, file_upload = false, show_loading = true ) {
	console.log( "uk_ajax_json : " + ajax_url );
	console.log( element.attr( "id" ) );
	console.log( ajax_data );
	var aj = new Argo_ajax( "json" );
	aj.done_func = function( result ) {
		$.LoadingOverlay( "hide" );
		if( result.input_errors ) {
			uk_input_errors( element, result.input_errors );
			element.trigger( "ajax-input-errors", [ result, ajax_data ] );
		} else if( result.error ) {
			if( error_notify ) {
				uk_notify_danger( result.error );
			}
			element.trigger( "ajax-error", [ result, ajax_data ] );
		} else {
			if( result.message && done_notify ) {
				uk_notify_success( result.message );
			}
			element.trigger( "ajax-done", [ result, ajax_data ] );
		}
	};

	aj.fail_func = function() {
		$.LoadingOverlay( "hide" );
		if( fail_notify ) {
			uk_notify_fail();
		}
		element.trigger( "ajax-fail", ajax_data );
	};
	
	aj.file_upload = file_upload;
	//aj.show_loading = show_loading;
	aj.show_loading = false;
	
	if( show_loading == true ) {
		$.LoadingOverlay( "show" );
	}
	
	aj.connect( "POST", ajax_url, ajax_data );
}

function uk_ajax_json_file_upload( element, ajax_url, ajax_data, done_notify = true, error_notify = true, fail_notify = true ) {
	uk_ajax_json( element, ajax_url, ajax_data, done_notify, error_notify, fail_notify, true );
}

function uk_ajax_html( element, ajax_url, ajax_data, fail_notify = true, show_loading = true ) {
	console.log( "uk_ajax_html : " + ajax_url );
	console.log( element.attr( "id" ) );
	console.log( ajax_data );
	var aj = new Argo_ajax( "html" );
	aj.done_func = function( html ) {
		element.html( html );
		element.LoadingOverlay( "hide" );
		element.trigger( "ajax-done", [ html, ajax_data ] );
	};

	aj.fail_func = function() {
		if( fail_notify ) {
			uk_notify_fail();
		}
		element.LoadingOverlay( "hide" );
		element.trigger( "ajax-fail" );
	};
	
	//aj.show_loading = show_loading;
	aj.show_loading = false;
	
	if( show_loading == true ) {
		element.LoadingOverlay( "show" );
	}
	
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
