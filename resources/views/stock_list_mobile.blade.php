@extends('layout.mobile_base')
@section('title', '在庫一覧')

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
@include('include/stock/mobile_stock_list_category')
@include('include/stock/mobile_stock_list_table')

@endsection

{{-- フッター --}}
@section('mobile_footer')
@endsection

{{-- JavaScript --}}
@section('script')
@include('_sample')
@endsection