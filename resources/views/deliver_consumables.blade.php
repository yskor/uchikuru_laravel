@extends('layout.mobile_base')
@section('title', '施設納品')

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


<div id="form" style="">
	@include('include/deliver/deliver_consumables')
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