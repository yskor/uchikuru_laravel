<!-- Modal -->
<div class="modal fade" id="AddModal" tabindex="-1" aria-labelledby="AddModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<form action="{{ route('edit_master') }}" method="post" enctype="multipart/form-data">
			<input type="hidden" name="post" value="add">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="AddModalLabel">消耗品を追加</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
					@csrf
					<div class="form-group" id="consumables-code-form-group">
						<label for="consumables-code">消耗品コード (バーコード) <span class="badge bg-danger">必須</span> </label>
						<input type="text" class="form-control" name="consumables_code" id="consumables-code" required>
						<div id="consumables-code-feedback" class="invalid-feedback"></div>
					</div>

					<div class="form-group" id="consumables-name-form-group">
						<label for="consumables-name">消耗品名 <span class="badge bg-danger">必須</span> </label>
						<input type="text" class="form-control" name="consumables_name" id="consumables-name" required>
						<div id="consumables-name-feedback" class="invalid-feedback"></div>
					</div>

					<div class="form-group" id="number-unit-form-group">
						<label for="number-unit">個数単位 <span class="badge bg-danger">必須</span> </label>
						<input type="text" class="form-control" name="number_unit" id="number-unit" required>
						<div id="number-unit-feedback" class="invalid-feedback"></div>
					</div>

					<div class="form-group" id="number-unit-price-form-group">
						<label for="number-unit-price">個数単価 </label>
						<input type="number" class="form-control" name="number_unit_price" id="number-unit-price"
							required>
						<div id="number-unit-price-feedback" class="invalid-feedback"></div>
					</div>

					<div class="form-group" id="quantity-form-group">
						<label for="quantity">入数 <span class="badge bg-danger">必須</span> </label>
						<input type="number" class="form-control" name="quantity" id="quantity" required>
						<div id="quantity-feedback" class="invalid-feedback"></div>
					</div>

					<div class="form-group" id="quantity-unit-form-group">
						<label for="quantity-unit">入数単位 <span class="badge bg-danger">必須</span> </label>
						<input type="text" class="form-control" name="quantity_unit" id="quantity-unit" required>
						<div id="quantity-unit-feedback" class="invalid-feedback"></div>
					</div>

					<div class="form-check">
						<input class="form-check-input" type="checkbox" name="use_quantity" id="use-quantity"
							checked="ture" value="1">
						<label class="form-check-label" for="use-quantity">この消耗品を使用すると【入数】を減らす。</label>
					</div>
					<script type="text/javascript">
						$(function(){
						  $('#use-quantity').click(function() {
							if ($(this).prop("checked") == true) {
								$(this).val(1);
							} else {
								$(this).val(0);
							}
						  });
						});
					</script>
					<div class="form-check">
						<input class="form-check-input" type="checkbox" name="can_use_multiple" id="can-use-multiple"
							value="0">
						<label class="form-check-label" for="can-use-multiple">1回のQRコード読み取りで複数の在庫を使用できる。</label>
						<script type="text/javascript">
							$(function(){
						  $('#can-use-multiple').click(function() {
							if ($(this).prop("checked") == true) {
								$(this).val(1);
							} else {
								$(this).val(0);
							}
						  });
						});
						</script>
					</div>
					<div id="consumables-category">
						<div class="row section">
							<div class="col-md-12">
								<div class="row">
									<div class="col-md-2">
										<label class="col-form-label" for="consumables-category-code">カテゴリ</label>
									</div>
									<div class="col-md-4">
										<select name="consumables_category_code" id="consumables-category-code"
											class="form-select" required>
											<option value="" selected=""></option>
											@foreach($consumables_category_all as $category)
											{{-- カテゴリごとに作成 --}}
											<option value="{{ $category->consumables_category_code }}">{{
												$category->consumables_category_name }}</option>
											@endforeach
										</select>
										<div name="consumables-category-code-feedback"
											id="consumables-category-code-feedback" class="invalid-feedback"></div>
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
						<!-- <%* 画像 *%> -->
						<div class="m-2"><img id="add_preview" src="{{ asset('upload/consumables/00000000.png')}}"
							style="width:100px;height:100px;"></div>
						<input type="file" class="form-control" name="image_file" id="add-image-file" accept="image/*">
						<script>
							$('#add-image-file').on('change', function (e) {
								var reader = new FileReader();
								reader.onload = function (e) {
									$("#add_preview").attr('src', e.target.result);
								}
								reader.readAsDataURL(e.target.files[0]);
							});
						</script>
					</div>


				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">閉じる</button>
					<button type="submit" class="btn btn-primary">追加</button>
				</div>
			</div>
		</form>
	</div>
</div>