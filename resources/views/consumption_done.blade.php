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
    <h4 class="">現在出荷予定の消耗品はありません</h4>
</div>

<a href="{{route('consumption')}}">さらにQRコードを読み込む</a>

@endsection

{{-- フッター --}}
@section('footer')
@endsection

{{-- JavaScript --}}
@section('script')
@include('_sample')


@endsection