<html>
<head>
	<title>@yield('title')</title>
	@include('layout.mobile_head')
	@include('layout.style')
	@include('layout.script')
</head>
<body>
	<header>
		@include('layout.mobile_header')
	</header>
	<main style="padding-bottom:100px;">
		@include('layout.mobile_main')
	</main>
	<footer>
		@include('layout.mobile_footer')
	</footer>
</body>
</html>