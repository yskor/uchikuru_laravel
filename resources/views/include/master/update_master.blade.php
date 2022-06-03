<a class="btn btn-secondary mb-3" href="{{route('master_list_category', ['consumables_category_code' => $consumables->consumables_category_code])}}">
	<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left" viewBox="0 0 16 16">
		<path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z"/>
	</svg>
	一覧に戻る
</a>

<!-- フラッシュメッセージ -->
@if (session('update_message'))
<div class="alert alert-success">
	{{ session('update_message') }}
</div>
@endif

<form class="" action="{{route('master_list_category', ['consumables_category_code' => $consumables->consumables_category_code])}}" method="post" enctype="multipart/form-data">
	{{-- <input type="hidden" name="post" value="edit"> --}}
	<input type="hidden" name="consumables_code" value="{{$consumables->consumables_code}}">
	<input type="hidden" name="consumables_category_code" value="{{$consumables->consumables_category_code}}">
	<div class="card">
		<div class="card-header">
			<h5 class="card-title" id="AddModalLabel">消耗品情報を更新</h5>
		</div>
		<div class="card-body row">
			@csrf
			<div class="col-7">
				<div class="row mb-2">
					<div class="form-group row">
						<div class="mb-1" id="consumables-name-form-group" style="width: 350px">
							<label for="consumables-name">消耗品名 <span class="badge bg-danger">必須</span> </label>
							<input type="text" class="form-control" name="consumables_name" id="consumables-name"
							value="{{$consumables->consumables_name}}" required>
							<div id="consumables-name-feedback" class="invalid-feedback"></div>
						</div>
						<div id="consumables-category" style="width: 250px">
							<label class="" for="consumables-category-code">カテゴリ<span class="badge bg-danger">必須</span></label>
							<select name="consumables_category_code" id="consumables-category-code" class="form-select"
								required>
								@foreach($consumables_category_all as $data)
								{{-- カテゴリごとに作成 --}}
									@if($data->consumables_category_code == 8 or $data->consumables_category_code == 9 or
										$data->consumables_category_code == 10 or $data->consumables_category_code == 12)
									{{-- LABO関係は非表示 --}}
									@else
										@if ($data->consumables_category_code == $consumables->consumables_category_code)
										<option value="{{ $data->consumables_category_code }}" selected>{{
											$data->consumables_category_name }}</option>
										@else
										<option value="{{ $data->consumables_category_code }}">{{
											$data->consumables_category_name }}</option>
										@endif
									@endif
								@endforeach
							</select>
							<div name="consumables-category-code-feedback" id="consumables-category-code-feedback"
								class="invalid-feedback"></div>
						</div>
					</div>
				</div>
	
				<div class="row mb-2">
					<div class="form-group row mb-2" id="consumables-code-form-group">
						<div id="barcode-group-1" style="width: 350px">
							<label for="consumables-code">段ボールのバーコード</label>
							<input type="number" class="form-control" name="barcode[B]" id="consumables-code-1" value="{{$consumables_barcode_list['barcode_B']}}" placeholder="">
							<div id="" class="invalid-feedback">バーコードを読み込んでください</div>
						</div>
						<div class="" style="width: 180px">
							<label for="">単位数量</label>
							<div class="input-group">
								<input type="number" class="form-control text-end" id="number" name="number" value="1"
									aria-label="number_unit" disabled>
								<span class="input-group-text">段</span>
							</div>
						</div>
					</div>
					<div class="form-group row mb-2" id="consumables-code-form-group">
						<div id="barcode-group-2" style="width: 350px">
							<label for="consumables-code">箱のバーコード</label>
							<input type="number" class="form-control" name="barcode[N]" id="consumables-code-2" value="{{$consumables_barcode_list['barcode_N']}}" placeholder="">
							<div id="consumables-code-2-feedback" class="invalid-feedback">バーコードを読み込んでください</div>
						</div>
						<div class="" style="width: 180px">
							<label for="">
								単位数量
								<a tabindex="0" class="text-danger w-100" role="button" data-bs-toggle="popover" data-bs-trigger="focus" data-bs-content="段ボールに入っている箱数を入力して下さい">
									<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-info-circle" viewBox="0 0 16 16">
										<path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
										<path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"/>
									</svg>
								</a>
							</label>
							<div class="input-group">
								<input type="number" class="form-control text-end" id="number" name="number" value="{{$consumables->number}}"
								aria-label="number_unit" placeholder="箱数を入力　　">
								<span class="input-group-text">箱</span>
							</div>
						</div>
					</div>
					<div class="form-group row mb-2" id="consumables-code-form-group">
						<div id="barcode-group-3" style="width: 350px">
							<label for="consumables-code">個のバーコード<span class="badge bg-danger">必須</span> </label>
							<input type="number" class="form-control" name="barcode[Q]" id="consumables-code-3" value="{{$consumables_barcode_list['barcode_Q']}}" placeholder="" required>
							<div id="consumables-code-3-feedback" class="invalid-feedback">バーコードを読み込んでください</div>
						</div>
						<div class="" style="width: 180px">
							<label for="">単位数量 <span class="badge bg-danger">必須</span> 
								<a tabindex="0" class="text-danger w-100" role="button" data-bs-toggle="popover" data-bs-trigger="focus" data-bs-content="1箱に入っている個数を入力して下さい">
									<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-info-circle" viewBox="0 0 16 16">
										<path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
										<path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"/>
									</svg>
								</a>
							</label>
							<span>
							</span>
							<div class="input-group">
								<input type="number" class="form-control text-end" id="quantity" name="quantity" value="{{$consumables->quantity}}"
								aria-label="quantity_unit" placeholder="" required>
								<span class="input-group-text">個</span>
							</div>
						</div>
					</div>
				</div>
	
				<div class="d-flex row mb-2">
					<div class="mb-1" style="width: 240px">
						<label for="number-unit-price">1箱の仕入単価（税込） <span class="badge bg-danger">必須</span></label>
						<div class="input-group" id="number-unit-price-form-group">
							<input type="number" class="form-control text-end" name="number_unit_price" id="number-unit-price"
								value="{{$consumables->number_unit_price}}" placeholder="" required>
							<span class="input-group-text">円</span>
						</div>
						<div id="number-unit-price-feedback" class="invalid-feedback">箱の仕入単価を入力してください</div>
					</div>
					<div class="form-group" id="last-negotiation-date-form-group" style="width: 250px">
						<label for="last-negotiation-date">最終価格交渉日 </label>
						<input type="date" class="form-control" name="last_negotiation_date" id="last-negotiation-date"
							value="">
						<div id="last-negotiation-date-feedback" class="invalid-feedback"></div>
					</div>
				</div>
	
				<div class="d-flex row mb-2">
					<div class="" style="width: 180px">
						<label for="">在庫定数 <span class="badge bg-danger">必須</span> 
							<a tabindex="0" class="text-danger w-100" role="button" data-bs-toggle="popover" data-bs-trigger="focus" data-bs-content="在庫として常に確保しておく数量を入力して下さい。">
								<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-info-circle" viewBox="0 0 16 16">
									<path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
									<path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"/>
								</svg>
							</a>
						</label>
						<div class="d-flex">
							{{-- @if($consumables->stock_constant_quantity_code == 'Q') --}}
							<input type="number" class="form-control text-end" id="stock_constant_quantity" name="stock_constant_quantity"
								placeholder="" aria-label="" value="{{$consumables->stock_constant_quantity}}" required>
							<span class="btn-group" role="group" aria-label="Basic radio toggle button group">
								<input type="radio" class="btn-check" name="stock_constant_quantity_code" id="stock_constant_quantity_code_number" value="N"
									autocomplete="off" checked>
								<label class="btn btn-primary" for="stock_constant_quantity_code_number">箱</label>
								{{-- <input type="radio" class="btn-check" name="stock_constant_quantity_code" id="stock_constant_quantity_code_quantity" value="Q"
								autocomplete="off" checked>
								<label class="btn btn-outline-primary" for="stock_constant_quantity_code_quantity">個</label> --}}
							</span>
							{{-- @else
							<input type="number" class="form-control text-end" id="stock_constant_quantity" name="stock_constant_quantity"
								placeholder="" aria-label="" value="{{$consumables->stock_constant_quantity}}">
							<span class="btn-group" role="group" aria-label="Basic radio toggle button group">
								<input type="radio" class="btn-check" name="stock_constant_quantity_code" id="stock_constant_quantity_code_number" value="N"
									autocomplete="off" checked>
								<label class="btn btn-outline-primary" for="stock_constant_quantity_code_number">箱</label>
								<input type="radio" class="btn-check" name="stock_constant_quantity_code" id="stock_constant_quantity_code_quantity" value="Q"
								autocomplete="off">
								<label class="btn btn-outline-primary" for="stock_constant_quantity_code_quantity">個</label>
							</span>
							@endif --}}
						</div>
					</div>
					<div class="" style="width: 180px">
						<label for="">在庫補充点 <span class="badge bg-danger">必須</span>  
							<a tabindex="0" class="text-danger w-100" role="button" data-bs-toggle="popover" data-bs-trigger="focus" data-bs-content="在庫補充通知を行う基準となる在庫数を入力して下さい">
								<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-info-circle" viewBox="0 0 16 16">
									<path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
									<path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"/>
								</svg>
							</a>
						</label>
						<div class="d-flex">
							{{-- @if($consumables->stock_constant_quantity_code == 'Q') --}}
							<input type="number" class="form-control text-end" id="stock_replenishment_point" name="stock_replenishment_point"
								placeholder="" aria-label="" value="{{$consumables->stock_replenishment_point}}" required>
							<span class="btn-group" role="group" aria-label="Basic radio toggle button group">
								<input type="radio" class="btn-check" name="stock_replenishment_point_code" id="stock_replenishment_point_code_number" value="N"
									autocomplete="off" checked>
								<label class="btn btn-primary" for="stock_replenishment_point_code_number">箱</label>
								{{-- <input type="radio" class="btn-check" name="stock_replenishment_point_code" id="stock_replenishment_point_code_quantity" value="Q"
								autocomplete="off" checked>
								<label class="btn btn-outline-primary" for="stock_replenishment_point_code_quantity">個</label> --}}
							</span>
							{{-- @else
							<input type="number" class="form-control text-end" id="stock_replenishment_point" name="stock_replenishment_point"
								placeholder="" aria-label="" value="{{$consumables->stock_replenishment_point}}">
							<span class="btn-group" role="group" aria-label="Basic radio toggle button group">
								<input type="radio" class="btn-check" name="stock_replenishment_point_code" id="stock_replenishment_point_code_number" value="N"
									autocomplete="off" checked>
								<label class="btn btn-primary" for="stock_replenishment_point_code_number">箱</label>
								<input type="radio" class="btn-check" name="stock_replenishment_point_code" id="stock_replenishment_point_code_quantity" value="Q"
								autocomplete="off">
								<label class="btn btn-outline-primary" for="stock_replenishment_point_code_quantity">個</label>
							</span>
							@endif --}}
							<script>
								// 在庫定数と在庫補充点の単位を連動させる処理
								$("input[name='stock_constant_quantity_code']").change(function () {
									var val = $(this).val();
									if (val == 'N') {
										$('#stock_replenishment_point_code_number').prop("checked", true);
									} else if (val == 'Q') {
										$('#stock_replenishment_point_code_quantity').prop("checked", true);
									}
								});
								$("input[name='stock_replenishment_point_code']").change(function () {
									var val = $(this).val();
									if (val == 'N') {
										$('#stock_constant_quantity_code_number').prop("checked", true);
									} else if (val == 'Q') {
										$('#stock_constant_quantity_code_quantity').prop("checked", true);
									}
								});
							</script>
						</div>
					</div>
					<div class="mb-1" style="width: 180px">
						<label for="">持ち出し数量 <span class="badge bg-danger">必須</span> 
							<a tabindex="0" class="text-danger w-100" role="button" data-bs-toggle="popover" data-bs-trigger="focus" data-bs-content="施設職員がＱＲコードを読み取った際に持ち出す数量を入力して下さい">
								<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-info-circle" viewBox="0 0 16 16">
									<path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
									<path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"/>
								</svg>
							</a>
						</label>
						<div class="d-flex">
							<input type="number" class="form-control text-end" id="use-quantity" name="use_quantity"
								value="{{$consumables->use_quantity}}" aria-label="quantity_unit" placeholder="" required>
							<span class="btn-group" role="group" aria-label="Basic radio toggle button group">
								@if($consumables->use_unit_code == 'Q')
									<input type="radio" class="btn-check" name="use_unit" id="use-unit-number" value="N"
									autocomplete="off">
									<label class="btn btn-outline-primary" for="use-unit-number">箱</label>
									<input type="radio" class="btn-check" name="use_unit" id="use-unit-quantity" value="Q"
									autocomplete="off" checked>
									<label class="btn btn-outline-primary" for="use-unit-quantity">個</label>
								@else
									<input type="radio" class="btn-check" name="use_unit" id="use-unit-number" value="N"
									autocomplete="off" checked>
									<label class="btn btn-outline-primary" for="use-unit-number">箱</label>
									<input type="radio" class="btn-check" name="use_unit" id="use-unit-quantity" value="Q"
									autocomplete="off">
									<label class="btn btn-outline-primary" for="use-unit-quantity">個</label>
								@endif
							</span>
						</div>
					</div>
				</div>
			</div>

			<div class="col-5">
				<div class="d-flex row">
					<div class="form-group" id="image-file-form-group" style="width: 325px">
						<label for="image-file">画像ファイル </label>
						<input type="file" class="form-control" name="image_file" id="add-image-file" accept="image/*">
						<div class="m-2">
							<img id="add_preview" src="{{ asset('upload/consumables/'. $consumables->image_file_extension)}}"
								style="width:100px;height:100px;">
						</div>
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
			</div>

		</div>
		<div class="card-footer d-flex justify-content-end">
			<input type="submit" class="btn btn-primary mx-3" name="post" value="更新する">
			@include('modal/master_delete')
		</div>
	</div>
</form>