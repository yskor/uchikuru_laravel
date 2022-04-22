<html>
<head>
	<title>@yield('title')</title>
	@include('layout.head')
	<script type="text/javascript" src="{{url('js/jquery.qrcode.min.js')}}"></script>
	<script>
		$(function() {
		
		@foreach($consumables_list as $data)
		jQuery( '#qrcode-{{ $data->consumables_barcode }}' ).qrcode( {
			width: 100,
			height: 100,
			text: "{{ $data->consumables_barcode }}",
			});
		@endforeach

	});

	</script>
	@include('layout.style')
	@include('layout.script')
</head>
<body>
	<header>
	</header>
	<main style="padding-bottom:100px;">
		<div class="mx-2">
			@include("include/qr_table")
		</div>
	</main>
	<footer>
	</footer>
</body>
</html>
