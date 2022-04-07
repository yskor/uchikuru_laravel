<!-- Modal -->
<div class="modal fade" id="Edit{{ $data->consumable_code }}" tabindex="-1" aria-labelledby="Edit{{ $data->consumable_code }}" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<form action="{{ route('edit_master') }}" method="POST" enctype="multipart/form-data">
				<div class="modal-header">
					<h5 class="modal-title" id="Edit{{ $data->consumable_code }}">変更</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
						@csrf
						<input type="hidden" name="post" value="edit">
						<div class="form-group" id="consumable-code-form-group">
							<label for="consumable-code">消耗品コード (バーコード) <span class="badge bg-danger">必須</span>	</label>
								<input type="text" class="form-control" name="consumable_code" id="consumable-code" disabled="" value="{{ $data->consumable_code }}">
								<div id="consumable-code-feedback" class="invalid-feedback"></div>
						</div>

						<div class="form-group" id="consumable-name-form-group">
							<label for="consumable-name">消耗品名 <span class="badge bg-danger">必須</span>	</label>
								<input type="text" class="form-control" name="consumable_name" id="consumable-name" value="{{ $data->consumable_name }}">
								<div id="consumable-name-feedback" class="invalid-feedback"></div>
						</div>

						<div class="form-group" id="number-unit-form-group">
							<label for="number-unit">個数単位 <span class="badge bg-danger">必須</span>	</label>
								<input type="text" class="form-control"name="number_unit" id="number-unit" value="{{ $data->number_unit }}">
								<div id="number-unit-feedback" class="invalid-feedback"></div>
						</div>

						<div class="form-group" id="number-unit-price-form-group">
							<label for="number-unit-price">個数単価	</label>
								<input type="number" class="form-control" name="number_unit_price" id="number-unit-price" value="{{ $data->number_unit_price }}">
								<div id="number-unit-price-feedback" class="invalid-feedback"></div>
						</div>

						<div class="form-group" id="quantity-form-group">
							<label for="quantity">入数 <span class="badge bg-danger">必須</span>	</label>
								<input type="number" class="form-control" name="quantity" id="quantity"value="{{ $data->quantity }}">
								<div id="quantity-feedback" class="invalid-feedback"></div>
						</div>

						<div class="form-group" id="quantity-unit-form-group">
							<label for="quantity-unit">入数単位 <span class="badge bg-danger">必須</span>	</label>
								<input type="text" class="form-control" name="quantity_unit" id="quantity-unit" value="{{ $data->quantity_unit }}">
								<div id="quantity-unit-feedback" class="invalid-feedback"></div>
						</div>

						<div class="form-check">
						@if($data->use_quantity == 1)
						<input class="form-check-input" type="checkbox" value="" id="use_quantity" id="use-quantity" checked="true" disabled="">
						@else
						<input class="form-check-input" type="checkbox" value="" id="use_quantity" id="use-quantity" checked="false" disabled="">
						@endif
						<label class="form-check-label" for="use-quantity">この消耗品を使用すると【入数】を減らす。</label>
						</div><div class="form-check">
						<input class="form-check-input" type="checkbox" value="" id="can_use_multiple" id="can-use-multiple" disabled="">
						<label class="form-check-label" for="can-use-multiple">1回のQRコード読み取りで複数の在庫を使用できる。</label>
						</div><div id="consumable-category"><div class="row section">
							<div class="col-md-12">
								<div class="row">
									<div class="col-md-2">
										<label class="col-form-label" for="consumable-category-code">カテゴリ</label>
									</div>
									<div class="col-md-4">
										<select id="consumable_category_code" id="consumable-category-code" class="form-select">
																<option value="" selected=""></option>
																@foreach($consumable_category_all as $data)
																{{-- カテゴリごとに作成 --}}
																<option value="{{ $data->consumable_category_code }}">{{ $data->consumable_category_name }}</option>
																@endforeach
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
								<input type="date" class="form-control" name="last_negotiation_date" id="last-negotiation-date">
								<div id="last-negotiation-date-feedback" class="invalid-feedback"></div>
						</div>

						<div class="form-group" id="image-file-form-group">
							<label for="image-file">画像ファイル	</label>
								<input type="file" class="form-control" name="image_file" id="image-file">
								<div id="image-file-feedback" class="invalid-feedback"></div>
						</div>

						
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" id="btn-close" data-bs-dismiss="modal">閉じる</button>
					<button type="submit" class="btn btn-primary" id="btn-do">変更</button>
					
				</div>
			</form>
		</div>
	</div>
</div>