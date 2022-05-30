@extends('layout.base')
@section('title', '在庫不足消耗品一覧')

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

@include('include/flash_message')

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