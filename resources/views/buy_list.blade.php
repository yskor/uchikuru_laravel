@extends('layout.base')
@section('title', 'サンプルページ')

{{-- headタグ内 --}}
@section('head')
<script type="text/javascript" src="{{url('js/jquery.qrcode.min.js')}}"></script>
<script>
	$(function() {
	
	@foreach($consumables_buy_all as $data)
	jQuery( '#qrcode-{{ $data->consumables_barcode }}' ).qrcode( {
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
				console.log("リセット");
				handy_reader_data = "";
			}, 3000 );
		}
	
		if( event.keyCode == 13 && handy_reader_data != "" ) {
			// Enterキーが押された
			console.log(handy_reader_data);
			$.ajax({
				type: 'GET',
				// url: route('buy_consumables') + '/' + handy_reader_data, //後述するweb.phpのURLと同じ形にする
				url: 'http://localhost/uchikuru_laravel/buy_list/' + handy_reader_data, //後述するweb.phpのURLと同じ形にする
				data: {
					// 'handy_reader_data': handy_reader_data, //ここはサーバーに贈りたい情報。今回は検索ファームのバリューを送りたい。
				},
				dataType: 'json', //json形式で受け取る

			}).done(function (data) {}).done(function (data) { //ajaxが成功したときの処理
			// }).then((data) => { //ajaxが成功したときの処理
				let html = '';
				console.log('成功しました')
				console.log(data)
				// $.each(data, function (index, value) { //dataの中身からvalueを取り出す
				// //ここの記述はリファクタ可能
				// // modalにデータを入力
				// 	let barcode = value.consumables_barcode; //消耗品バーコード
				// 	let name = value.consumables_name; //消耗品名
				// 	let quantity = value.quantity; //入数
				// 	let quantity_unit = value.quantity_unit; //入数単位
				// 	let number = value.number; //個数
				// 	let number_unit = value.number_unit; //個数単位
				// 	// let image = value.image_file_extension; //画像
				// // 消耗品のビューテンプレートを作成
				// 	html = `
				// 			<div id="data" style="">
				// 				<table class="table">
				// 					<tbody>
				// 						<tr>
				// 							<th>消耗品コード</th>
				// 							<td>${barcode}</td>
				// 						</tr>
				// 						<tr>
				// 							<th>消耗品</th>
				// 							<td>${name}</td>
				// 						</tr>
				// 						<tr>
				// 							<th>入数/個数</th>
				// 							<td>${quantity}${quantity_unit}/${number}${number_unit}</td>
				// 						</tr>
				// 					</tbody>
				// 				</table>

								
				// 			</div>

				// 			<div class="form-group" id="buy-number-form-group">
				// 				<label for="buy-number">仕入れ数 <span class="badge bg-danger">必須</span> </label>
				// 				<input type="number" class="form-control" id="buy-number"><span>${number_unit}<span>
				// 			</div>
				// 			`
				// })
				// $('.modal-body div').append(html); //できあがったテンプレートをビューに追加
				// 検索結果がなかったときの処理
				if (data.length === 0) {
					html = `<p class="text-center">消耗品が見つかりません</p>`
					$('.modal-body div').append(html);
				}

			}).fail(function () {
				//ajax通信がエラーのときの処理
				console.log('どんまい！');
			})
			//以下は後述
			$('#consumablesBuyModal').removeClass('fade');
			$('#consumablesBuyModal').addClass('show');
			handy_reader_data = "";
		} else if( event.keyCode != 13 && $.inArray( event.keyCode, ignore_keyCodes ) == -1 ) {
			// Enterキーまたは無視するキー以外が押された
			handy_reader_data += event.key;
		}
	});
	
</script>
@endsection