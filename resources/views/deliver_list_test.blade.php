@extends('layout.base')
@section('title', '施設納品画面')

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

{{-- 納品一覧表テーブル --}}
{{-- @include('include/deliver_list_table') --}}
{{-- @include('modal/qrreader') --}}

@if (isset($deliver_consumables_list[0]))
	@foreach ($deliver_consumables_list as $data)
	<div class="card mb-3" style="max-width: 540px;">
		<div class="row g-0">
			<div class="col-4">
				<img src="{{ asset('upload/consumables/'.$data->image_file_extension)}}">
			</div>
			<div class="col-8">
				<div class="card-body">
					<p class="card-title">{{ $data->consumables_name }}</p>
					<p class="card-text">{{ $data->shipped_number }}
						{{ $data->number_unit }}</p>
					<button type="button" class="btn btn-primary" id="btn-deliver" data-id="{{ $data->ship_code }}">納品</button>
				</div>
			</div>
		</div>
	</div>
	@endforeach

@else
{{-- 出荷予定の消耗品がない場合 --}}
	<div class="alert alert-dark" role="alert">
		<h4 class="">現在未納となっている消耗品はありません</h4>
	</div>
@endif

<div id="form" style="">
	{{-- QRコードを読み込んだらHTML追加 --}}
</div>

<form action="{{route('deliver_table')}}" method="post">
	@csrf
	<input type="text" name="qrcode" id="">
	<button type="submit">送信</button>
</form>

@endsection

{{-- フッター --}}
@section('footer')
@endsection

{{-- JavaScript --}}
@section('script')
@include('_sample')

<script type="text/javascript">
	$(function() {
	
		var list = $( "#list" );
		var modal = $( "#modal" );
		
		// 一覧の「納品」ボタンがクリックされた
		// list.on( "click-btn-deliver", function( event, id ) {
		// 	modal.data( "id" , id );
		// 	modal.modal( "show" );
		// 	console.log('ここからajax')
		// 	$.ajax({
		// 		type: 'POST',
		// 		url: "{{route('qrreader')}}", //後述するweb.phpのURLと同じ形にする
		// 		data: {
		// 				//ここはサーバーに贈りたい情報。今回は検索ファームのバリューを送りたい。
		// 		},
		// 		dataType: 'json', //json形式で受け取る

		// 	}).done((res)=>{
		// 		$('#qr').html(res.html); //できあがったテンプレートをビューに追加
		// 		// $('#consumablesShipModal').modal("show");
		// 		console.log(res)
		// 		console.log('成功しました')
				
		// 	}).fail((error)=>{
		// 		//ajax通信がエラーのときの処理
		// 		console.log('どんまい！');
		// 	})
		// 	console.log('ajax通ってる')
		// });
		
		// 納品処理が完了
		modal.on( "done", function( event, message ) {
			$(this).modal( "hide" );
		});
		
		// modal.on( "hidden.bs.modal", function() {
		// 	reload();
		// });
	
	});
	
</script>

@endsection