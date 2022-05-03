<html>
<head>
	<title>@yield('title')</title>
	@include('layout.head')
	@include('layout.style')
	@include('layout.script')
</head>
<body class="">
	<header>
		@include('layout.header')
	</header>
	<main style="padding-bottom:100px;">
		@include('layout.main')
	</main>
	<footer>
		@include('layout.footer')
	</footer>
</body>
</html>