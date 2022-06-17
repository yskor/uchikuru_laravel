@extends('layout.index_base')
@section('title', '消耗品在庫管理システム')

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
@section('main')
<div class="container">
	@if($login->operation_type_code == 'LABO')
		@include('include.index.index_labo')
	@else
		@include('include.index.index')
	@endif
</div>
@endsection

{{-- フッター --}}
@section('footer')
@endsection

{{-- JavaScript --}}
@section('script')
@include('_sample')
@endsection