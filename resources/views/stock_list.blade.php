@extends('layout.base')
@section('title', 'サンプルページ')

{{-- headタグ内 --}}
@section('head')
<script type="text/javascript" src="{{url('js/jquery.qrcode.min.js')}}"></script>
<script>
$(function() {
	
	@foreach($stock_list as $data)
	jQuery( '#qrcode-{{ $data->consumable_code }}' ).qrcode( {
		width: 100,
		height: 100,
		text: "{{ $data->consumable_code }}",
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
<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#AddModal">
	<i class="fas fa-plus fa-fw"></i>追加
</button>
<!-- 追加モーダル -->
@include("modal/add_consumable_master_modal")

<!-- カテゴリセレクタ -->
@include("include/consumable_category")

<table class="table table-striped" id="table">
	<thead></thead>
	<tbody>
	@foreach($stock_list as $data)
		<tr data-consumable-code="{{ $data->consumable_code }}">
			<td>
				<div class="row">
					<div class="col">
						<i class="fas fa-cube fa-fw"></i>{{ $data->consumable_code }} : {{ $data->consumable_name }}
					</div>
					<div class="col-3">
						<button type="button" class="btn btn-primary" id="btn" data-consumable-code="{{ $data->consumable_code }}">出荷</button>
					</div>
				</div>
				<div class="row">
					<div class="col-4">
						@if(!empty( $data->consumable_image_filename ))
						<img src="https://uchipo.com/test_uchikuru_hori/images/consumable/{{ $data->consumable_image_filename }}" width="100px">
						@endif
					</div>
					<div class="col-8">
						<p>在庫：@if(!empty( $data->stock_number )) {{ $data->stock_number }} {{ $data->number_unit }} と {{ $data->stock_quantity }} {{ $data->quantity_unit }} @else なし @endif</p>
						<!--  在庫プログレスバー を追加する -->
										
					</div>
				</div>
			</td>
		</tr>
	@endforeach
	</tbody>
</table>

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

