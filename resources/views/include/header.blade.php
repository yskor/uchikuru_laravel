<div class="container">
	<a href="{{$common_system_top_page_url}}">
		<img src="{{url('images/uchipo.png')}}">
	</a>
</div>
<div class="bg-light h3">
	<div class="container">
		@yield('title')
	</div>
</div>
<div class="container">
	<div id="flash-message" class="alert alert-danger" hidden></div>
</div>
<div class="container">
	<div class="alert alert-info">
		【ログインユーザー：{{$login->staff_name}}】
	</div>
</div>