@extends('layout.base')
@section('title', '消耗品出荷画面')

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
@include("include/ship/ship_list_category")

{{-- 一覧表テーブル --}}
<div id="ship-add"></div>
<div class="alert alert-dark">出荷する施設を選択して下さい。</div>

@endsection

{{-- フッター --}}
@section('footer')
@endsection

{{-- JavaScript --}}
@section('script')
@include('_sample')


@endsection