@extends('layout.base')
@section('title', '施設消費画面')

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

<div class="alert alert-success" role="alert">
    <h4 class="">在庫数を更新しました。</h4>
</div>

<a class="btn btn-primary" href="{{route('consumption')}}">さらにQRコードを読み込む</a>

@endsection

{{-- フッター --}}
@section('footer')
@endsection

{{-- JavaScript --}}
@section('script')
@include('_sample')


@endsection