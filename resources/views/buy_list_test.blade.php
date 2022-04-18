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
@include("include/buy_list_table")


<form action="{{route('buy_consumables_test')}}" method="post">
	@csrf
	<input type="text" name="consumables_barcode" id="">
	<button type="submit">送信</button>
</form>

@endsection

{{-- フッター --}}
@section('footer')
@endsection

{{-- JavaScript --}}
@section('script')
@include('_sample')
<script>

	var handy_reader_data = "";
	
	// 無視するキーコード
	const ignore_keyCodes = [ 16, 112, 113, 114, 115, 116, 117, 118, 119, 120, 121, 122, 123 ];

	$(document).on( "keyup", function( event ) {
		console.log(event.keyCode + " : " + event.key);
		
		if( handy_reader_data == "" ) {
			// 1文字目が入力されてから 3 秒間、入力が無かったらリセット
			setTimeout( function() {
				// $('#modal_view').remove()
				// $('#consumablesBuyModal').modal('hide');
				console.log("リセット");
				handy_reader_data = "";
			}, 3000 );
		}
	
		if( event.keyCode == 13 && handy_reader_data != "" ) {
			// Enterキーが押された
			console.log(handy_reader_data);
			$.ajax({
				type: 'POST',
				url: "{{route('buy_consumables')}}", //後述するweb.phpのURLと同じ形にする
				data: {
					'handy_reader_data': handy_reader_data, //ここはサーバーに贈りたい情報。今回は検索ファームのバリューを送りたい。
				},
				dataType: 'json', //json形式で受け取る

			}).done((res)=>{
				// let html = '';
				console.log('成功しました')
				// console.log(res)
				$('#modal_view').html(res.html); //できあがったテンプレートをビューに追加
				$('#consumablesBuyModal').modal("show");
				
			}).fail((error)=>{
				//ajax通信がエラーのときの処理
				console.log('どんまい！');
			})
			// setTimeout( function() {
			// 	$('#consumablesBuyModal').remove();
			// }, 3000 );
			handy_reader_data = "";
		} else if( event.keyCode != 13 && $.inArray( event.keyCode, ignore_keyCodes ) == -1 ) {
			// Enterキーまたは無視するキー以外が押された
			handy_reader_data += event.key;
		}
	});
	
</script>

@endsection