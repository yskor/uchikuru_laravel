@extends('layout.base')
@section('title', 'サンプルページ')

{{-- headタグ内 --}}
@section('head')
<script type="text/javascript" src="{{url('js/jquery.qrcode.min.js')}}"></script>
<script>
$(function() {
	
	@foreach($consumable_list as $data)
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
<div class="container">
	<div class="alert alert-info">
		【ヘッダー】
		{{$login->staff_name}} でログインしています。
	</div>
</div>
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
		@foreach($consumable_list as $data)
		<tr data-consumable-code="{{ $data->consumable_code }}">
			<!-- <%* ボタン *%> -->
			<!-- Button trigger modal -->
			<td>
				<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#EditModal">
					変更
				</button>
				@include("modal/edit_consumable_master_modal")
			</td>
			<!-- <%* 消耗品コード *%> -->
			<td class="text-center">
				<div class="mb-2">{{ $data->consumable_code }}</div>
				<div id="qrcode-{{$data->consumable_code}}" data-bs-toggle="tooltip" data-bs-placement="top" title="右クリックで保存できます。"></div>
			</td>
			<!-- <%* 消耗品名 *%> -->
			<td class="text-center">
				<div class="mb-2">{{ $data->consumable_name }}</div>
				<!-- <%* 画像 *%> -->
				@if(!empty( $data->image_filename))
				<div><img src="https://uchipo.com/test_uchikuru_hori/images/consumable/{{ $data->image_filename }}" style="width:100px;height:100px;"></div>
				@endif
			</td>
			<!-- <%* 仕入れ単価 *%> -->
			<td class="text-center">@if(!empty($data->number_unit_price)) {{ $data->number_unit_price }} 円 @else -@endif</td>
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
<div class="container">
	<div class="alert alert-info">【フッター】</div>
</div>
@endsection

{{-- JavaScript --}}
@section('script')
@include('_sample')
@endsection

<script>

$(function() {
	
	var list = $( "#list" );
	
	var modal_add  = $( "#modal_add" );
	var modal_edit = $( "#modal_edit" );
	var category = $( "#category" );
	
	// <%* 消耗品カテゴリ セレクトボックスを作成 *%>
	var param = { 
			"label" : "カテゴリ",
			"selected" : "CARE",
			"select_id" : "category-code",
			"prepend" : true,
			};
	uk_ajax_html( category, "selectbox/consumablecategory", param );

	// <%* 消耗品カテゴリ セレクトボックスを作成した *%>
	category.on( "ajax-done", function( event, result, param ) {
		reload( param.selected );
	});
	
	// <%* 消耗品カテゴリを変更した *%>
	category.on( "changed", function( event, consumable_category_code ) {
		reload( consumable_category_code );
	});
	
	// <%* 一覧を更新 *%>
	function reload( consumable_category_code ) {
		list.html( "" );
		uk_ajax_html( list, "<%$ajax_url%>/list", { "consumable_category_code" : consumable_category_code } );
	}
	
	// <%* 「追加」ボタンがクリックされた *%>
	$( "#btn-add" ).on( "click", function() {
		modal_add.modal( "show" );
	});

	// <%* 一覧のボタンがクリックされた *%>
	list.on( "click-btn", function( event, consumable_code ){
		modal_edit.data( "consumable_code", consumable_code );
		modal_edit.modal( "show" );
	});
	
	// <%* 追加完了 *%>
	modal_add.on( "done", function( event, message ) {
		$(this).data( "done", true );
		$(this).modal( "hide" );
	});
	
	// <%* 変更完了 *%>
	modal_edit.on( "done", function( event, message ) {
		$(this).data( "done", true );
		$(this).modal( "hide" );
	});
	
	// <%* モーダルが閉じた *%>
	modal_add.on( "hidden.bs.modal", function( event ) {
		if( $(this).data( "done" ) ) {
			reload( $(this).find( "#consumable-category-code" ).val() );			
		}
	});
	modal_edit.on( "hidden.bs.modal", function( event ) {
		if( $(this).data( "done" ) ) {
			reload( $(this).find( "#consumable-category-code" ).val() );			
		}
	});

});

</script>
