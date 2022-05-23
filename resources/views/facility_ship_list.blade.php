@extends('layout.base')
@section('title', '消耗品出荷')

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
@include("include/ship/ship_list_facility_category")

<!-- フラッシュメッセージ -->
@if (session('message'))
<div class="alert alert-success">
    {{ session('message') }}
</div>
@endif

{{-- 一覧表テーブル --}}
<div id="ship-add"></div>
@include("include/ship/ship_list_table")

@endsection

{{-- フッター --}}
@section('footer')
@endsection

{{-- JavaScript --}}
@section('script')
@include('_sample')

{{-- バーコード読み取り --}}
<script>
	var handy_reader_data = "";
	var ship_add = 0;
	var ship_items = {}
	// 無視するキーコード
	const ignore_keyCodes = [ 16, 112, 113, 114, 115, 116, 117, 118, 119, 120, 121, 122, 123 ];

	$(document).on( "keyup", function( event ) {
		console.log(event.keyCode + " : " + event.key);
		
		if( handy_reader_data == "" ) {
			// 1文字目が入力されてから 3 秒間、入力が無かったらリセット
			setTimeout( function() {
				console.log("リセット");
				handy_reader_data = "";
			}, 3000 );
		}
		// console.log({{$office_code}})
		if( event.keyCode == 13 && handy_reader_data != "" ) {
			// Enterキーが押された
			console.log(handy_reader_data);
			$('#flash-message').prop('hidden', true);

			if(ship_items[handy_reader_data]) {
				console.log('すでに読み込み済みです')
			} else {
				if(ship_add == 1) {
					// モーダルが既にあればモーダルに追加
					$.ajax({
						type: 'POST',
						url: "{{route('ship_consumables')}}", //後述するweb.phpのURLと同じ形にする
						data: {
							'handy_reader_data': handy_reader_data,
							'office_code': {{$office_code}},
							'ship_add': ship_add, //ここはサーバーに贈りたい情報。今回は検索ファームのバリューを送りたい。
						},
						dataType: 'json', //json形式で受け取る
		
					}).done((res)=>{
						$('#consumablesShipModal').modal("show");
						var consumables_ship_data = res.consumables_ship_data;
						$('#ships').append(res.html); //できあがったテンプレートをビューに追加
						console.log(res)
						console.log('成功しました')
					}).fail((error)=>{
						//ajax通信がエラーのときの処理
						console.log('失敗');
						ajax_fail(error);
	
					})
					handy_reader_data = "";
					ship_items[handy_reader_data] = handy_reader_data;
				} else if (ship_add == 0) {
					$.ajax({
						type: 'POST',
						url: "{{route('ship_consumables')}}", //後述するweb.phpのURLと同じ形にする
						data: {
							'handy_reader_data': handy_reader_data,
							'office_code': {{$office_code}},
							'ship_add': ship_add, //ここはサーバーに贈りたい情報。今回は検索ファームのバリューを送りたい。
						},
						dataType: 'json', //json形式で受け取る
		
					}).done((res)=>{
						var consumables_ship_data = res.consumables_ship_data;
						$('#ship-add').html(res.html); //できあがったテンプレートをビューに追加
						// $('#consumablesShipModal').modal("show");
						console.log(res)
						console.log('成功しました')
						ship_add = 1;
					}).fail((error)=>{
						//ajax通信がエラーのときの処理
						console.log('失敗');
						ajax_fail(error);
					})
					ship_items[handy_reader_data] = handy_reader_data;
				}
			}
			console.log(ship_items);
			handy_reader_data = "";

		} else if( event.keyCode != 13 && $.inArray( event.keyCode, ignore_keyCodes ) == -1 ) {
			// Enterキーまたは無視するキー以外が押された
			handy_reader_data += event.key;
		}
	});
	
</script>


@endsection