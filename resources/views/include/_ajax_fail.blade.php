<script>

{{-- Ajax失敗のエラー処理 --}}
function ajax_fail(error, element_id = 'flash-message') {

	var message = "";

	if(error.status == 404) {
		message = error.statusText;
	} else if(error.status == 422) {
		var msgs = [];
		$.each(error.responseJSON.errors, function(index, err) {
			msgs.push(err);
		});
		message = msgs.join("<br>");
	} else if(error.responseJSON.message != null) {
		message = error.responseJSON.message;
	} else {
		message = "通信に失敗しました。";
	}

	if(message != "") {
		$('#'+element_id).html(message);
		$('#'+element_id).prop('hidden', false);
	}
}

</script>