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


{{-- 一覧表テーブル --}}
@include("include/stock/shortage_consumables")

@endsection

{{-- フッター --}}
@section('footer')
@endsection

{{-- JavaScript --}}
@section('script')
@include('_sample')
@endsection