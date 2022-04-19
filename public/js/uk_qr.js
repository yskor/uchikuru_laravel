/*
 * QRコード
 */

function uk_qr_start( element, message = "QRコードを読み取ってください。" ) {
	uk_ajax_html( element, "qr", { "id" : element.attr( "id" ), "message" : message }, false );
}

function uk_qr_analyze( element, data ) {
	uk_ajax_json( element, "qr/analyze", { "data" : data }, false );
}
