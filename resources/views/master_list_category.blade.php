@extends('layout.base')
@section('title', '消耗品マスタ一覧')

{{-- headタグ内 --}}
@section('head')
<script type="text/javascript" src="{{url('js/jquery.qrcode.min.js')}}"></script>
<script>
	$(function() {
	
	@foreach($consumables_list_category as $data)
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
<!-- 追加モーダル -->
@include("modal/add_consumables_master_modal")

<!-- カテゴリセレクタ -->
@include("include/consumables_category")

<!-- Button trigger modal -->
<button type="button" class="btn btn-primary mt-2" data-bs-toggle="modal" data-bs-target="#AddModal">
	<i class="fas fa-plus fa-fw"></i>追加
</button>

<table class="table table-striped" id="table">
	<thead>
		<tr>
			<th class="text-center"></th>
			<th class="text-center">消耗品コード</th>
			<th class="text-center">消耗品名</th>
			<th class="text-center">仕入れ単価</th>
			<th class="text-center">入数 / 単位</th>
			<th class="text-center">使用単位</th>
			<th class="text-center">複数使用可</th>
			<th class="text-center">最終交渉日</th>
		</tr>
	</thead>
	<tbody>
		@foreach($consumables_list_category as $data)
		<tr data-consumables-code="{{ $data->consumables_code }}">
			<!-- <%* ボタン *%> -->
			<!-- Button trigger modal -->
			<td>
				<button type="button" class="btn btn-primary" data-bs-toggle="modal"
					data-bs-target="#Edit{{ $data->consumables_code }}">
					変更
				</button>
				@include("modal/edit_consumables_master_modal")
			</td>
			<!-- <%* 消耗品コード *%> -->
			<td class="text-center">
				<div class="mb-2">{{ $data->consumables_barcode }}</div>
				<div id="qrcode-{{$data->consumables_barcode}}" data-bs-toggle="tooltip" data-bs-placement="top"
					title="右クリックで保存できます。"></div>
			</td>
			<!-- <%* 消耗品名 *%> -->
			<td class="text-center">
				<div class="mb-2">{{ $data->consumables_name }}</div>
				<!-- <%* 画像 *%> -->
				@if(!empty( $data->image_file_extension))
				<div><img src="{{ asset('upload/consumables/'.$data->image_file_extension)}}"
						style="width:100px;height:100px;"></div>
				@endif
			</td>
			<!-- <%* 仕入れ単価 *%> -->
			<td class="text-center">@if(!empty($data->number_unit_price)) {{ $data->number_unit_price }} 円 @else -@endif
			</td>
			<!-- <%* 入数 / 単位 *%> -->
			<td class="text-center">{{ $data->quantity }} {{ $data->quantity_unit }} / {{ $data->number_unit }}</td>
			<!-- <%* 使用単位 *%> -->
			<td class="text-center">@if($data->use_quantity == true) 入数 @else 個数 @endif</td>
			<!-- <%* 複数使用可 *%> -->
			<td class="text-center">@if($data->can_use_multiple == true) 可 @else 不可 @endif</td>
			<!-- <%* 最終交渉日 *%> -->
			<td class="text-center">{{ $data->last_negotiation_date }}</td>
		</tr>
		@endforeach
	</tbody>
</table>

@endsection

{{-- フッター --}}
@section('footer')
@endsection

{{-- JavaScript --}}
@section('script')
@include('_sample')
@endsection
