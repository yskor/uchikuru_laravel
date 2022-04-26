@extends('layout.base')
@section('title', '消耗品仕入画面')

{{-- headタグ内 --}}
@section('head')
<script type="text/javascript" src="{{url('js/jquery.qrcode.min.js')}}"></script>
<script>
	$(function() {
	
	@foreach($consumables_buy_all as $data)
	jQuery( '#qrcode-{{ $data->buy_code }}-{{ $data->consumables_barcode }}' ).qrcode( {
		width: 100,
		height: 100,
		text: "{{ $data->consumables_barcode }}",
		});
	@endforeach

});

</script>

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
@include("include/buy_list_category")


{{-- 一覧表テーブル --}}
<div id="buy-add"></div>
@include("include/buy_list_table")

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
	
		if( event.keyCode == 13 && handy_reader_data != "" ) {
			// Enterキーが押された
			console.log(handy_reader_data);
			
			if(buy_add == 1) {
				// モーダルが既にあればモーダルに追加
				$.ajax({
					type: 'POST',
					url: "{{route('buy_consumables')}}", //後述するweb.phpのURLと同じ形にする
					data: {
						'handy_reader_data': handy_reader_data,
						'buy_add': buy_add, //ここはサーバーに贈りたい情報。今回は検索ファームのバリューを送りたい。
					},
					dataType: 'json', //json形式で受け取る
	
				}).done((res)=>{
					var consumables_buy_data = res.consumables_buy_data;
					$('#buys').append(res.html); //できあがったテンプレートをビューに追加
					console.log(res)
					console.log('成功しました')
				}).fail((error)=>{
					//ajax通信がエラーのときの処理
					console.log('どんまい！');
					ajax_fail(error);
				})
				handy_reader_data = "";
			} else if (buy_add == 0) {
				$.ajax({
					type: 'POST',
					url: "{{route('buy_consumables')}}", //後述するweb.phpのURLと同じ形にする
					data: {
						'handy_reader_data': handy_reader_data,
						'buy_add': buy_add, //ここはサーバーに贈りたい情報。今回は検索ファームのバリューを送りたい。
					},
					dataType: 'json', //json形式で受け取る
	
				}).done((res)=>{
					var consumables_buy_data = res.consumables_buy_data;
					$('#buy-add').html(res.html); //できあがったテンプレートをビューに追加
					console.log(res)
					console.log('成功しました')
					
				}).fail((error)=>{
					//ajax通信がエラーのときの処理
					console.log('どんまい！');
					ajax_fail(error);
				})
				handy_reader_data = "";
				buy_add = 1;
			}
			

		} else if( event.keyCode != 13 && $.inArray( event.keyCode, ignore_keyCodes ) == -1 ) {
			// Enterキーまたは無視するキー以外が押された
			handy_reader_data += event.key;
		}
	});
	
</script>

@endsection