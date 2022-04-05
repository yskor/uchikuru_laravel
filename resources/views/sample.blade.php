@extends('layout.base')
@section('title', 'サンプルページ')

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
<div class="container">
	<div class="alert alert-info">
		【ヘッダー】
		{{$login->staff_name}} でログインしています。
	</div>
</div>
@endsection

{{-- メインコンテンツ --}}
@section('main')
<div class="alert alert-success">メインコンテンツ</div>

<button type="button" class="btn btn-primary mb-3" onclick="clicked_btn_office({{$login->office_code}})">Ajaxテスト</button>
<div class="alert alert-success" id="office">【Ajaxテスト】</div>

<button type="button" class="btn btn-primary mb-3" onclick="clicked_btn_office_html({{$login->office_code}})">HTML返却テスト</button>
<div class="mb-3" id="office-html"></div>
@endsection

{{-- フッター --}}
@section('footer')
<div class="container">
	<div class="alert alert-info">【フッター】</div>
</div>
@endsection

{{-- JavaScript --}}
@section('script')
@include('_sample')
@endsection
