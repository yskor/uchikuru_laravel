<!-- フラッシュメッセージ -->
@if (session('error_message'))
<div class="alert alert-danger">
	{{ session('error_message') }}
</div>
@elseif (session('success_message'))
<div class="alert alert-success">
	{{ session('success_message') }}
</div>
@endif