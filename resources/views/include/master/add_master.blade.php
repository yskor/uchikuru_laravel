<form class="" action="{{route('master_list_category', ['consumables_category_code' => 1])}}" method="post" enctype="multipart/form-data">
	<input type="hidden" name="post" value="add">
	<div class="card">
		<div class="card-header">
			<h5 class="card-title" id="AddModalLabel">消耗品を登録</h5>
		</div>
		<div class="card-body">
			@csrf
			<div class="row mb-2">
				<div class="form-group" id="consumables-code-form-group" style="width: 350px">
					<div id="barcode-group-1">
						<label for="consumables-code">消耗品バーコード（段）<span class="badge bg-danger">必須</span></label>
						<input type="text" class="form-control" name="barcode[B]" id="consumables-code-1" placeholder="段ボールのバーコード" required>
						<div id="" class="invalid-feedback">バーコードを読み込んでください</div>
					</div>
				</div>
				<div class="form-group" id="consumables-code-form-group" style="width: 350px">
					<div id="barcode-group-2">
						<label for="consumables-code">消耗品バーコード（箱）<span class="badge bg-danger">必須</span> </label>
						<input type="text" class="form-control" name="barcode[N]" id="consumables-code-2" placeholder="箱のバーコード" required>
					</div>
					<div id="consumables-code-2-feedback" class="invalid-feedback">バーコードを読み込んでください</div>
				</div>
				<div class="form-group" id="consumables-code-form-group" style="width: 350px">
					<div id="barcode-group-3">
						<label for="consumables-code">消耗品バーコード（個）</label>
						<input type="text" class="form-control" name="barcode[Q]" id="consumables-code-3" placeholder="個のバーコード">
					</div>
					<div id="consumables-code-3-feedback" class="invalid-feedback">バーコードを読み込んでください</div>
				</div>
			</div>

			<div class="d-flex row mb-2">
				<div class="mb-1" id="consumables-name-form-group" style="width: 350px">
					<label for="consumables-name">消耗品名 <span class="badge bg-danger">必須</span> </label>
					<input type="text" class="form-control" name="consumables_name" id="consumables-name"
						placeholder="消耗品名を入力" required>
					<div id="consumables-name-feedback" class="invalid-feedback"></div>
				</div>

				<div class="mb-1" style="width: 350px">
					<label for="number-unit-price">仕入単価（税込） <span class="badge bg-danger">必須</span></label>
					<div class="input-group" id="number-unit-price-form-group">
						<input type="number" class="form-control" name="number_unit_price" id="number-unit-price"
							placeholder="箱の仕入単価（税込）を入力" required>
						<span class="input-group-text">円</span>
						<div id="number-unit-price-feedback" class="invalid-feedback">箱の仕入単価（税込）を入力してください</div>
					</div>
				</div>

			</div>

			<div class="d-flex row mb-2">
				<div class="mb-1" style="width: 350px">
					<label for="">単位数量 <span class="badge bg-danger">必須</span> </label>
					<div class="input-group">
						<input type="number" class="form-control" id="quantity" name="quantity" placeholder="個数を入力"
							aria-label="quantity_unit" required>
						<span class="input-group-text">個</span>
						<input type="number" class="form-control" id="number" name="number" placeholder="箱数を入力"
							aria-label="number_unit" required>
						<span class="input-group-text">箱/段</span>
					</div>
				</div>

				<div class="mb-1" style="width: 350px">
					<label for="">消費数量 <span class="badge bg-danger">必須</span> </label>
					<div class="d-flex">
						<input type="number" class="form-control" id="use-quantity" name="use_quantity"
							placeholder="1回あたりの消費数量を入力" aria-label="quantity_unit" required>
						<span class="btn-group" role="group" aria-label="Basic radio toggle button group">
							<input type="radio" class="btn-check" name="use_unit" id="use-unit-number" value="N"
								autocomplete="off" checked>
							<label class="btn btn-outline-primary" for="use-unit-number">箱</label>
							<input type="radio" class="btn-check" name="use_unit" id="use-unit-quantity" value="Q"
								autocomplete="off">
							<label class="btn btn-outline-primary" for="use-unit-quantity">個</label>
						</span>
					</div>
				</div>
			</div>

			<div class="d-flex row mb-2">
				<div id="consumables-category" style="width: 350px">
					<label class="" for="consumables-category-code">カテゴリ<span class="badge bg-danger">必須</span></label>
					<select name="consumables_category_code" id="consumables-category-code" class="form-select"
						required>
						<option value="" selected=""></option>
						@foreach($consumables_category_all as $category)
						{{-- カテゴリごとに作成 --}}
						<option value="{{ $category->consumables_category_code }}">{{
							$category->consumables_category_name }}</option>
						@endforeach
					</select>
					<div name="consumables-category-code-feedback" id="consumables-category-code-feedback"
						class="invalid-feedback"></div>
				</div>

				<div class="form-group" id="last-negotiation-date-form-group" style="width: 350px">
					<label for="last-negotiation-date">最終価格交渉日 </label>
					<input type="date" class="form-control" name="last_negotiation_date" id="last-negotiation-date"
						value="">
					<div id="last-negotiation-date-feedback" class="invalid-feedback"></div>
				</div>
			</div>

			<div class="d-flex row">
				<div class="form-group" id="image-file-form-group" style="width: 350px">
					<label for="image-file">画像ファイル </label>
					<input type="file" class="form-control" name="image_file" id="add-image-file" accept="image/*">
					<div class="m-2">
						<img id="add_preview" src="{{ asset('upload/consumables/00000000.png')}}"
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
			<input type="submit" class="btn btn-primary mx-3" name="post" value="登録する">
		</div>
	</div>
</form>