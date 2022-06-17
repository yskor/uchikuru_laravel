@extends('layout.base')
@section('title', '消耗品マスタ一覧')

{{-- headタグ内 --}}
@section('head')
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
@section('main')

<!-- カテゴリセレクタ -->
@include("include/master/master_consumables_category")

<!-- フラッシュメッセージ -->
@if (session('delete_message'))
<div class="alert alert-danger">
	{{ session('delete_message') }}
</div>
@endif
<!-- フラッシュメッセージ -->
@if (session('add_message'))
<div class="alert alert-success">
	{{ session('add_message') }}
</div>
@endif

<!-- テーブル -->
@include("include/master/master_table")

@endsection

{{-- フッター --}}
@section('footer')
@endsection

{{-- JavaScript --}}
@section('script')
@include('_sample')
@endsection
