<script type="text/javascript" src="{{url('js/jquery.qrcode.min.js')}}"></script>
<script>
	$(function() {
	
	@foreach($stock_list as $data)
	jQuery( '#qrcode-{{ $data->consumables_code }}' ).qrcode( {
		width: 100,
		height: 100,
		text: "{{ $data->consumables_code }}",
		});
	@endforeach

});

</script>