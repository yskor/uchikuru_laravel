<script type="text/javascript" src="{{url('js/jquery.qrcode.min.js')}}"></script>
<script>
$(function() {
	
	@foreach($stock_list as $data)
	jQuery( '#qrcode-{{ $data->consumable_code }}' ).qrcode( {
		width: 100,
		height: 100,
		text: "{{ $data->consumable_code }}",
		});
	@endforeach

});

</script>