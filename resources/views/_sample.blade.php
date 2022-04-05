<script>

function clicked_btn_office(office_code) {
	$('#office').text('取得しています...');
	$.ajax({
		type: 'post',
		url: "{{url('sample/office')}}",
		data: {
			'office_code' : office_code,
		}
	})
	.done((res)=>{
		console.log(res);
		$('#office').text(res.office.facility_name);
	})
	.fail((error)=>{
		console.log(error);
	})
}

function clicked_btn_office_html(office_code) {
	$('#office-html').html('取得しています...');
	$.ajax({
		type: 'post',
		url: "{{url('sample/office_html')}}",
		data: {
			'office_code' : office_code,
		}
	})
	.done((res)=>{
		console.log(res);
		$('#office-html').html(res.html);
	})
	.fail((error)=>{
		console.log(error);
	})
}

</script>