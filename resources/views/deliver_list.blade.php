@extends('layout.mobile_base')
@section('title', '施設納品画面')

{{-- headタグ内 --}}
@section('head')

@endsection

{{-- スタイルシート --}}
@section('style')
<style>
</style>
@endsection

{{-- ヘッダー --}}
@section('header')
@endsection

{{-- メインコンテンツ --}}
@section('mobile_main')

<!-- フラッシュメッセージ -->
@if (session('message'))
<div class="alert alert-success">
	{{ session('message') }}
</div>
@endif

<div id="form" style="">
	@include('include/deliver/deliver_table')
</div>

@endsection

{{-- フッター --}}
@section('footer')
@endsection

{{-- JavaScript --}}
@section('script')
@include('_sample')

<script type="text/javascript">
	$(function() {
	
		var list = $( "#list" );
		var modal = $( "#modal" );
		
		
		// 納品処理が完了
		modal.on( "done", function( event, message ) {
			$(this).modal( "hide" );
		});
		
	});
	
</script>

@endsection