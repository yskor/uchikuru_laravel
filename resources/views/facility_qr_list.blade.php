<html>
<head>
	<title>@yield('title')</title>
	@include('layout.head')
	<script type="text/javascript" src="{{url('js/jquery.qrcode.min.js')}}"></script>
	<script>
		$(function() {
		
		@foreach($facility_list as $data)
		jQuery( '#qrcode-{{ $data->qr_code }}' ).qrcode( {
			width: 100,
			height: 100,
			text: "{{ $data->qr_code }}",
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
			@include("include/facility_qr_table")
		</div>
	</main>
	<footer>
	</footer>
</body>
</html>
