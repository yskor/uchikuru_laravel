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
<div class="alert alert-info">
    <h5>出荷状況を確認する消耗品を選択して下さい。</h5>
</div>
@include('include/deliver/deliver_status')


@endsection

{{-- フッター --}}
@section('footer')
@endsection

{{-- JavaScript --}}
@section('script')
@include('_sample')


@endsection