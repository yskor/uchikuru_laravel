@extends('layout.base')
@section('title', '消耗品納品状況')

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
@include("include/deliver/deliver_status_category")

{{-- 一覧表テーブル --}}
@include('include/deliver/month_deliver_status_table')

@endsection

{{-- フッター --}}
@section('footer')
@endsection

{{-- JavaScript --}}
@section('script')
@include('_sample')


@endsection