@extends('layout.mobile_base')
@section('title', '消耗品を使用する')

{{-- headタグ内 --}}
@section('head')

@endsection

{{-- スタイルシート --}}
@section('style')
<style>
</style>
@endsection

{{-- ヘッダー --}}
@section('mobile_header')
@endsection

{{-- メインコンテンツ --}}
@section('mobile_main')

@include('include/consumption/consumption_done')


@endsection

{{-- フッター --}}
@section('footer')
@endsection

{{-- JavaScript --}}
@section('script')
@include('_sample')


@endsection