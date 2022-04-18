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
				$('#consumablesBuyModal').modal('hide');
				$('#consumablesBuyModal').remove()
			}, 2000 );
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
				var add_consumables = '';
				var consumables_buy_data = res.consumables_buy_data;
				$('#modal_view').html(res.html); //できあがったテンプレートをビューに追加
				$('#consumablesBuyModal').modal("show");
				var add_consumables = 
				`
				<tr data-code="${consumables_buy_data.consumables_code}">
					<td class="text-center table-w">
						<button type="button" class="btn btn-primary btn-sm" id="btn-info" data-code="511045" data-management-office-code="" data-carehome-office-code="">
							詳細
						</button>
					</td>
					<!-- <%* 消耗品コード *%> -->
					<td class="text-center table-w">
						<div class="mb-2">${consumables_buy_data.consumables_barcode }</div>
						<div id="qrcode-${consumables_buy_data.buy_code }-${consumables_buy_data.consumables_barcode}" data-bs-toggle="tooltip" data-bs-placement="top"
							title="右クリックで保存できます。"></div>
					</td>
					<!-- <%* 消耗品名 *%> -->
					<td class="text-center table-w">
						<div class="mb-2 text-truncate table-w">${consumables_buy_data.consumables_name}</div>
						<!-- <%* 画像 *%> -->
						<div><img src="{{asset('upload/consumables/${consumables_buy_data.image_file_extension}')}}"
								style="width:100px;height:100px;"></div>
					</td>
					<!-- <%* 入数 / 単位 *%> -->
					<td class="text-center table-w">${consumables_buy_data.quantity } ${consumables_buy_data.quantity_unit } / ${consumables_buy_data.number_unit }</td>
					<!-- 仕入日 -->
					<td class="text-center table-w">${consumables_buy_data.created_at}</td>
					<!-- 状態 -->
					<td class="text-center table-w"></td>
					<td class="text-center table-w">テスト</td>
				</tr>
				`
				$('#buy-table').prepend(add_consumables); //できあがったテンプレートをtbodyの子要素の先頭に追加
				$(function() {
					jQuery( `#qrcode-${consumables_buy_data.buy_code}-${consumables_buy_data.consumables_barcode}` ).qrcode( {
						width: 100,
						height: 100,
						text: `${consumables_buy_data.consumables_barcode}`,
						});
				})
				// setTimeout( function() {
				// 	$('#consumablesBuyModal').remove();
				// }, 3000 );
				console.log('成功しました')
				
			}).fail((error)=>{
				//ajax通信がエラーのときの処理
				console.log('どんまい！');
			})
			handy_reader_data = "";
		} else if( event.keyCode != 13 && $.inArray( event.keyCode, ignore_keyCodes ) == -1 ) {
			// Enterキーまたは無視するキー以外が押された
			handy_reader_data += event.key;
		}
	});
	
</script>

@endsection