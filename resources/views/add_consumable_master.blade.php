@extends('layout.base')
@section('title', 'サンプルページ')

{{-- headタグ内 --}}
@section('head')
<script type="text/javascript" src="https://uchipo.com/test_uchikuru_hori/js/jquery.qrcode.min.js"></script>

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

<div class="">
	<form method="POST" action="">
		@csrf
		<div class="form-group" id="consumable-code-form-group">
			<label for="consumable-code">消耗品コード (バーコード) <span class="badge bg-danger">必須</span>	</label>
				<input type="text" class="form-control" id="consumable-code" disabled="">
				<div id="consumable-code-feedback" class="invalid-feedback"></div>
		</div>

		<div class="form-group" id="consumable-name-form-group">
			<label for="consumable-name">消耗品名 <span class="badge bg-danger">必須</span>	</label>
				<input type="text" class="form-control" id="consumable-name">
				<div id="consumable-name-feedback" class="invalid-feedback"></div>
		</div>

		<div class="form-group" id="number-unit-form-group">
			<label for="number-unit">個数単位 <span class="badge bg-danger">必須</span>	</label>
				<input type="text" class="form-control" id="number-unit">
				<div id="number-unit-feedback" class="invalid-feedback"></div>
		</div>

		<div class="form-group" id="number-unit-price-form-group">
			<label for="number-unit-price">個数単価	</label>
				<input type="number" class="form-control" id="number-unit-price">
				<div id="number-unit-price-feedback" class="invalid-feedback"></div>
		</div>

		<div class="form-group" id="quantity-form-group">
			<label for="quantity">入数 <span class="badge bg-danger">必須</span>	</label>
				<input type="number" class="form-control" id="quantity">
				<div id="quantity-feedback" class="invalid-feedback"></div>
		</div>

		<div class="form-group" id="quantity-unit-form-group">
			<label for="quantity-unit">入数単位 <span class="badge bg-danger">必須</span>	</label>
				<input type="text" class="form-control" id="quantity-unit">
				<div id="quantity-unit-feedback" class="invalid-feedback"></div>
		</div>

		<div class="form-check">
		<input class="form-check-input" type="checkbox" value="" id="use-quantity" checked="" disabled="">
		<label class="form-check-label" for="use-quantity">この消耗品を使用すると【入数】を減らす。</label>
		</div><div class="form-check">
		<input class="form-check-input" type="checkbox" value="" id="can-use-multiple" disabled="">
		<label class="form-check-label" for="can-use-multiple">1回のQRコード読み取りで複数の在庫を使用できる。</label>
		</div><div id="consumable-category"><div class="row section">
			<div class="col-md-12">
				<div class="row">
					<div class="col-md-2">
						<label class="col-form-label" for="consumable-category-code">カテゴリ</label>
					</div>
					<div class="col-md-4">
						<select id="consumable-category-code" class="form-select">
												<option value="" selected=""></option>
												<option value="SGGD">衛生用品</option>
												<option value="SGOC">衛生用品（口腔）</option>
												<option value="SGKT">衛生用品（厨房）</option>
												<option value="SGCL">衛生用品（清掃）</option>
												<option value="SGSO">衛生用品（洗剤）</option>
												<option value="CARE">介護用品</option>
												<option value="OFSP">事務用品</option>
												<option value="FOOD">食品</option>
												<option value="LBCS">LABO消耗品</option>
												<option value="LBSS">LABO調味料</option>
												<option value="OTHR">その他</option>
												<option value="TEST">テスト</option>
											</select>
						<div id="consumable-category-code-feedback" class="invalid-feedback"></div>
					</div>
				</div>
			</div>
		</div>

		<script>

		$(function() {
			$( "#consumable-category-code" ).on( "change" ,function() {
				$(this).trigger( "changed", $(this).val() );
			});
		});

		</script></div>	<div class="form-group" id="last-negotiation-date-form-group">
			<label for="last-negotiation-date">最終交渉日	</label>
				<input type="date" class="form-control" id="last-negotiation-date">
				<div id="last-negotiation-date-feedback" class="invalid-feedback"></div>
		</div>

		<div class="form-group" id="image-file-form-group">
			<label for="image-file">画像ファイル	</label>
				<input type="file" class="form-control" id="image-file">
				<div id="image-file-feedback" class="invalid-feedback"></div>
		</div>

	</form>

</div>

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
