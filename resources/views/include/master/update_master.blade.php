<form class="" action="{{ route('edit_master') }}" method="post" enctype="multipart/form-data">
	<input type="hidden" name="post" value="edit">
	<input type="hidden" name="consumables_code" value="{{$consumables->consumables_code}}">
	<div class="card">
		<div class="card-header">
			<h5 class="card-title" id="AddModalLabel">消耗品情報を更新</h5>
		</div>
		<div class="card-body">
			@csrf
			<div class="row mb-2">
				<div class="form-group" id="consumables-code-form-group" style="width: 350px">
					<div id="barcode-group-1">
						<label for="consumables-code">消耗品バーコード（段）<span class="badge bg-danger">必須</span></label>
						<input type="text" class="form-control" name="barcode[B]" id="consumables-code-1" value="{{$consumables_barcode_list['barcode_B']}}" required>
						<div id="" class="invalid-feedback">バーコードを読み込んでください</div>
					</div>
				</div>
				<div class="form-group" id="consumables-code-form-group" style="width: 350px">
					<div id="barcode-group-2">
						<label for="consumables-code">消耗品バーコード（箱）<span class="badge bg-danger">必須</span> </label>
						<input type="text" class="form-control" name="barcode[N]" id="consumables-code-2" value="{{$consumables_barcode_list['barcode_N']}}" required>
					</div>
					<div id="consumables-code-2-feedback" class="invalid-feedback">バーコードを読み込んでください</div>
				</div>
				<div class="form-group" id="consumables-code-form-group" style="width: 350px">
					<div id="barcode-group-3">
						<label for="consumables-code">消耗品バーコード（個）</label>
						<input type="text" class="form-control" name="barcode[Q]" id="consumables-code-3" value="{{$consumables_barcode_list['barcode_Q']}}">
					</div>
					<div id="consumables-code-3-feedback" class="invalid-feedback">バーコードを読み込んでください</div>
				</div>
			</div>

			<div class="d-flex row mb-2">
				<div class="mb-1" id="consumables-name-form-group" style="width: 350px">
					<label for="consumables-name">消耗品名 <span class="badge bg-danger">必須</span> </label>
					<input type="text" class="form-control" name="consumables_name" id="consumables-name"
						value="{{$consumables->consumables_name}}" required>
					<div id="consumables-name-feedback" class="invalid-feedback"></div>
				</div>

				<div class="mb-1" style="width: 350px">
					<label for="number-unit-price">仕入単価（税込） <span class="badge bg-danger">必須</span></label>
					<div class="input-group" id="number-unit-price-form-group">
						<input type="number" class="form-control" name="number_unit_price" id="number-unit-price"
							value="{{$consumables->number_unit_price}}" required>
						<span class="input-group-text">円</span>
						<div id="number-unit-price-feedback" class="invalid-feedback">箱の仕入単価（税込）を入力してください</div>
					</div>
				</div>

			</div>

			<div class="d-flex row mb-2">
				<div class="mb-1" style="width: 350px">
					<label for="">単位数量 <span class="badge bg-danger">必須</span> </label>
					<div class="input-group">
						<input type="number" class="form-control" id="quantity" name="quantity" value="{{$consumables->quantity}}"
							aria-label="quantity_unit" required>
						<span class="input-group-text">個</span>
						<input type="number" class="form-control" id="number" name="number" value="{{$consumables->number}}"
							aria-label="number_unit" required>
						<span class="input-group-text">箱/段</span>
					</div>
				</div>

				<div class="mb-1" style="width: 350px">
					<label for="">使用数量 <span class="badge bg-danger">必須</span> </label>
					<div class="d-flex">
						<input type="number" class="form-control" id="use-quantity" name="use_quantity"
							value="{{$consumables->use_quantity}}" aria-label="quantity_unit" required>
						<span class="btn-group" role="group" aria-label="Basic radio toggle button group">
							@if($consumables->use_unit_code == 'N')
								<input type="radio" class="btn-check" name="use_unit" id="use-unit-number" value="N"
								autocomplete="off" checked>
								<label class="btn btn-outline-primary" for="use-unit-number">箱</label>
								<input type="radio" class="btn-check" name="use_unit" id="use-unit-quantity" value="Q"
								autocomplete="off">
								<label class="btn btn-outline-primary" for="use-unit-quantity">個</label>
							@else
								<input type="radio" class="btn-check" name="use_unit" id="use-unit-number" value="N"
								autocomplete="off">
								<label class="btn btn-outline-primary" for="use-unit-number">箱</label>
								<input type="radio" class="btn-check" name="use_unit" id="use-unit-quantity" value="Q"
								autocomplete="off" checked>
								<label class="btn btn-outline-primary" for="use-unit-quantity">個</label>
							@endif
						</span>
					</div>
				</div>
			</div>

			<div class="d-flex row mb-2">
				<div id="consumables-category" style="width: 350px">
					<label class="" for="consumables-category-code">カテゴリ<span class="badge bg-danger">必須</span></label>
					<select name="consumables_category_code" id="consumables-category-code" class="form-select"
						required>
						@foreach($consumables_category_all as $category)
						{{-- カテゴリごとに作成 --}}
						@if ($category->consumables_category_code = $consumables->consumables_category_code)
						<option value="{{ $category->consumables_category_code }}" selected>{{
							$category->consumables_category_name }}</option>
						@else
						<option value="{{ $category->consumables_category_code }}">{{
							$category->consumables_category_name }}</option>
						@endif
						@endforeach
					</select>
					<div name="consumables-category-code-feedback" id="consumables-category-code-feedback"
						class="invalid-feedback"></div>
				</div>

				<div class="form-group" id="last-negotiation-date-form-group" style="width: 350px">
					<label for="last-negotiation-date">最終価格交渉日 </label>
					<input type="date" class="form-control" name="last_negotiation_date" id="last-negotiation-date"
						value="{{$consumables->last_negotiation_date}}">
					<div id="last-negotiation-date-feedback" class="invalid-feedback"></div>
				</div>
			</div>

			<div class="d-flex row">
				<div class="form-group" id="image-file-form-group" style="width: 350px">
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
		<div class="card-footer d-flex justify-content-end">
			<button type="submit" class="btn btn-primary">更新する</button>
		</div>
	</div>
</form>