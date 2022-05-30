@extends('layout.base')
@section('title', '消耗品在庫一覧')

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
@include("include/stock/stock_list_category_facility")

<!-- フラッシュメッセージ -->
@include('include/flash_message')

{{-- 一覧表テーブル --}}
@include("include/stock/stock_list_table")

@endsection

{{-- フッター --}}
@section('footer')
@endsection

{{-- JavaScript --}}
@section('script')
@include('_sample')
@endsection