@extends('layout.base')
@section('title', '消耗品仕入れ')

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
@include("include/buy/buy_list_category")


<!-- フラッシュメッセージ -->
{{-- @if (session('error_message'))
<div class="alert alert-success">
	{{ session('message') }}
</div>
@elseif (session('success_message'))
<div class="alert alert-success">
	{{ session('success_message') }}
</div>
@endif --}}

{{-- <form action="{{route('buy_consumables')}}" method="post">
	@csrf
	<input type="number" name="handy_reader_data">
	<input type="submit" class="btn btn-primary" value="送信">
</form>
<h1>{{$consumables_category_code}}ここです</h1> --}}

{{-- 一覧表テーブル --}}
<div id="buy-add"></div>
@include("include/buy/buy_list_table")

@endsection

{{-- フッター --}}
@section('footer')
@endsection

{{-- JavaScript --}}
@section('script')
@include('_sample')
<script>
	var handy_reader_data = "";
	var buy_add = 0;
	var buy_items = {}
	// 無視するキーコード
	const ignore_keyCodes = [ 16, 112, 113, 114, 115, 116, 117, 118, 119, 120, 121, 122, 123 ];

	$(document).on( "keyup", function( event ) {
		console.log(event.keyCode + " : " + event.key);
		
		if( handy_reader_data == "" ) {
			// 1文字目が入力されてから 3 秒間、入力が無かったらリセット
			setTimeout( function() {
				console.log("リセット");
				handy_reader_data = "";
			}, 1000 );
		}
	
		if( event.keyCode == 13 && handy_reader_data != "" ) {
			// Enterキーが押された
			console.log(handy_reader_data);
			if(buy_items[handy_reader_data]) {
				console.log('すでに読み込み済みです')
			} else {
				console.log('false')
				if(buy_add == 1) {
					// モーダルが既にあればモーダルに追加
					$.ajax({
						type: 'POST',
						url: "{{route('buy_consumables')}}", //後述するweb.phpのURLと同じ形にする
						data: {
							'handy_reader_data': handy_reader_data,
							'buy_add': buy_add,
							'consumables_category_code': {{$consumables_category_code}}, 
						},
						dataType: 'json', //json形式で受け取る
		
					}).done((res)=>{
						var consumables_buy_data = res.consumables_buy_data;
						$('#buys').append(res.html); //できあがったテンプレートをビューに追加
						console.log(res)
						console.log('成功しました')
					}).fail((error)=>{
						//ajax通信がエラーのときの処理
						console.log('失敗');
						ajax_fail(error);
					})
				} else if (buy_add == 0) {
					$.ajax({
						type: 'POST',
						url: "{{route('buy_consumables')}}", //後述するweb.phpのURLと同じ形にする
						data: {
							'handy_reader_data': handy_reader_data,
							'buy_add': buy_add,
							'consumables_category_code': {{$consumables_category_code}}, 
						},
						dataType: 'json', //json形式で受け取る
		
					}).done((res)=>{
						var consumables_buy_data = res.consumables_buy_data;
						$('#buy-add').html(res.html); //できあがったテンプレートをビューに追加
						console.log('成功')
						
					}).fail((error)=>{
						//ajax通信がエラーのときの処理
						console.log('失敗')
						ajax_fail(error);
					})
					buy_add = 1;		
				}
				buy_items[handy_reader_data] = handy_reader_data;
			}
			console.log(buy_items);
			handy_reader_data = "";
			

		} else if( event.keyCode != 13 && $.inArray( event.keyCode, ignore_keyCodes ) == -1 ) {
			// Enterキーまたは無視するキー以外が押された
			handy_reader_data += event.key;
		}
	});
	
</script>

@endsection