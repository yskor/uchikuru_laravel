@extends('layout.base')
@section('title', 'サンプルページ')

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

<!-- カテゴリセレクタ -->
@include("include/consumables_category")
<div class="card">
	<h6 class="card-header w-100">マスタ一覧（各施設）</h6>
	<!-- 在庫テーブル -->
	@include("include/stock_table")
</div>
@endsection

{{-- フッター --}}
@section('footer')
@endsection

{{-- JavaScript --}}
@section('script')
@include('_sample')
@endsection