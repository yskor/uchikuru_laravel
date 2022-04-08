<!-- Modal -->
<div class="modal fade" id="Edit{{ $data->consumables_code }}" tabindex="-1"
	aria-labelledby="Edit{{ $data->consumables_code }}" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<form action="{{ route('edit_master') }}" method="POST" enctype="multipart/form-data">
				@csrf
				<div class="modal-header">
					<h5 class="modal-title" id="Edit{{ $data->consumables_code }}">変更</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
					<input type="hidden" name="consumables_code" value="{{ $data->consumables_code }}">
					<div class="form-group" id="consumables-code-form-group">
						<label for="consumables-code">消耗品コード (バーコード) <span class="badge bg-danger">必須</span> </label>
						<input type="text" class="form-control" name="consumables_barcode" id="consumables-barcode"
							disabled="" value="{{ $data->consumables_barcode }}">
						<div id="consumables-code-feedback" class="invalid-feedback"></div>
					</div>

					<div class="form-group" id="consumables-name-form-group">
						<label for="consumables-name">消耗品名 <span class="badge bg-danger">必須</span> </label>
						<input type="text" class="form-control" name="consumables_name" id="consumables-name"
							value="{{ $data->consumables_name }}">
						<div id="consumables-name-feedback" class="invalid-feedback"></div>
					</div>

					<div class="form-group" id="number-unit-form-group">
						<label for="number-unit">個数単位 <span class="badge bg-danger">必須</span> </label>
						<input type="text" class="form-control" name="number_unit" id="number-unit"
							value="{{ $data->number_unit }}">
						<div id="number-unit-feedback" class="invalid-feedback"></div>
					</div>

					<div class="form-group" id="number-unit-price-form-group">
						<label for="number-unit-price">個数単価 </label>
						<input type="number" class="form-control" name="number_unit_price" id="number-unit-price"
							value="{{ $data->number_unit_price }}">
						<div id="number-unit-price-feedback" class="invalid-feedback"></div>
					</div>

					<div class="form-group" id="quantity-form-group">
						<label for="quantity">入数 <span class="badge bg-danger">必須</span> </label>
						<input type="number" class="form-control" name="quantity" id="quantity"
							value="{{ $data->quantity }}">
						<div id="quantity-feedback" class="invalid-feedback"></div>
					</div>

					<div class="form-group" id="quantity-unit-form-group">
						<label for="quantity-unit">入数単位 <span class="badge bg-danger">必須</span> </label>
						<input type="text" class="form-control" name="quantity_unit" id="quantity-unit"
							value="{{ $data->quantity_unit }}">
						<div id="quantity-unit-feedback" class="invalid-feedback"></div>
					</div>

					<div class="form-check">
						@if($data->use_quantity == 1)
						<input class="form-check-input" type="checkbox" value="{{ $data->use_quantity }}" name="use_quantity" id="use-quantity"
						checked="true">
						@else
						<input class="form-check-input" type="checkbox" value="{{ $data->use_quantity }}" name="use_quantity" id="use-quantity"
							checked="false">
							@endif
						<label class="form-check-label" for="use-quantity">この消耗品を使用すると【入数】を減らす。</label>
					</div>
					<script type="text/javascript">
						$(function(){
						  $('input#use-quantity').click(function() {
								if ($(this).prop("checked") == true) {
									$(this).val(1);
								} else {
									$(this).val(0);
								}
							});
						});
					</script>
					<div class="form-check">
						@if($data->can_use_multiple == 1)
						<input class="form-check-input" type="checkbox" checked="true" value="{{ $data->can_use_multiple }}" name="can_use_multiple" id="can-use-multiple">
						@else
						<input class="form-check-input" type="checkbox" value="{{ $data->can_use_multiple }}" name="can_use_multiple" id="can-use-multiple">
						@endif
						<label class="form-check-label" for="can-use-multiple">1回のQRコード読み取りで複数の在庫を使用できる。</label>
					</div>
					<script type="text/javascript">
						$(function(){
							$('input#can-use-multiple').change(function() {
								if ($(this).prop("checked") == true) {
									$(this).val(1);
								} else {
									$(this).val(0);
								}
							});
						});
					</script>
					<div id="consumables-category">
						<div class="row section">
							<div class="col-md-12">
								<div class="row">
									<div class="col-md-2">
										<label class="col-form-label" for="consumables-category-code">カテゴリ</label>
									</div>
									<div class="col-md-4">
										<select id="consumables_category_code" id="consumables-category-code"
											class="form-select">
											@foreach($consumables_category_all as $data)
											{{-- カテゴリごとに作成 --}}
											@if ( $data->consumables_category_code == $consumables_category_code )
											<option value="{{ $data->consumables_category_code }}" selected="">{{ $data->consumables_category_name }}</option>
											@else
											<option value="{{ $data->consumables_category_code }}">{{ $data->consumables_category_name }}</option>
											@endif
											@endforeach
										</select>
										<div id="consumables-category-code-feedback" class="invalid-feedback"></div>
									</div>
								</div>
							</div>
						</div>

						<script>
							$(function() {
							$( "#consumables-category-code" ).on( "change" ,function() {
								$(this).trigger( "changed", $(this).val() );
							});
						});

						</script>
					</div>
					<div class="form-group" id="last-negotiation-date-form-group">
						<label for="last-negotiation-date">最終交渉日 </label>
						<input type="date" class="form-control" name="last_negotiation_date" id="last-negotiation-date" value="">
						<div id="last-negotiation-date-feedback" class="invalid-feedback"></div>
					</div>

					<div class="form-group" id="image-file-form-group">
						<label for="image-file">画像ファイル </label>
						<input type="file" class="form-control" name="image_file" id="image-file" accept="image/*">
						<!-- <%* 画像 *%> -->
						@if(!empty( $data->image_file_extension))
						<div><img id="preview" src="{{ asset('storage/'.$data->image_file_extension)}}" style="width:100px;height:100px;"></div>
						@else
						<div><img id="preview"></div>
						@endif
						<div id="image-file-feedback" class="invalid-feedback"></div>
						
					</div>
					<script>
						$('#image-file').on('change', function (e) {
							var reader = new FileReader();
							reader.onload = function (e) {
								$("#preview").attr('src', e.target.result);
							}
							reader.readAsDataURL(e.target.files[0]);
						});
					</script>

				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" id="btn-close" data-bs-dismiss="modal">閉じる</button>
					<button type="submit" name="post" class="btn btn-danger" value="delete">削除</button>
					<button type="submit" name="post" class="btn btn-primary" value="edit">変更</button>

				</div>
			</form>
		</div>
	</div>
</div>