/*
 * 通知
 */

// 成功
function uk_notify_success( message ) {
	uk_notify( message, "success" );
	//uk_notify( message, "success", "fa fa-thumbs-up" );
}

// エラー
function uk_notify_danger( message = "エラーが発生しました。" ) {
	uk_notify( message, "error" );
	//uk_notify( message, "danger", "fa fa-exclamation-triangle" );
}

// サーバーにアクセスできなかった
function uk_notify_fail( message = "通信に失敗しました。" ) {
	uk_notify_danger( message );
}

// その他
function uk_notify_secondary( message ) {
	uk_notify( message );
	//uk_notify( message, "secondary" );
}
function uk_notify_success( message ) {
	uk_notify( message, "success" );
	//uk_notify( message, "success" );
}
function uk_notify_warning( message ) {
	uk_notify( message, "warning" );
	//uk_notify( message, "warning" );
}
function uk_notify_info( message ) {
	uk_notify( message );
	//uk_notify( message, "info" );
}
function uk_notify_light( message ) {
	uk_notify( message );
	//uk_notify( message, "light" );
}
function uk_notify_dark( message ) {
	uk_notify( message );
	//uk_notify( message, "dark" );
}

function uk_notify( message, type = "info", icon = null ) {
	
	toastr.options = {
		"closeButton": true,
		"debug": false,
		"newestOnTop": false,
		"progressBar": false,
		"positionClass": "toast-top-full-width",
		"preventDuplicates": false,
		"onclick": null,
		"showDuration": "300",
		"hideDuration": "1000",
		"timeOut": "5000",
		"extendedTimeOut": "1000",
		"showEasing": "swing",
		"hideEasing": "linear",
		"showMethod": "fadeIn",
		"hideMethod": "fadeOut"
	};
	
	var html = '<div class="h3">' + message + "</div>";
	
	toastr[ type ]( html );
	/*
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
	*/
}
