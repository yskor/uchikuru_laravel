@extends('layout.base')
@section('title', '在庫一覧（事業所）')

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
@include("include/stock_office_consumables_category")

<div class="card">
	<h6 class="card-header w-100">在庫一覧（事業所）</h6>
	<!-- 在庫テーブル -->
	@include("include/stock_category_table")
</div>
@endsection

{{-- フッター --}}
@section('footer')
@endsection

{{-- JavaScript --}}
@section('script')
@include('_sample')
@endsection