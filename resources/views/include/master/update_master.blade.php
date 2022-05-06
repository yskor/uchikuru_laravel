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
		<div class="card-body">
			@csrf
			<div class="row mb-2">
				<div class="form-group" id="consumables-code-form-group" style="width: 325px">
					<div id="barcode-group-1">
						<label for="consumables-code">消耗品バーコード（段）<span class="badge bg-danger">必須</span></label>
						<input type="number" class="form-control" name="barcode[B]" id="consumables-code-1" value="{{$consumables_barcode_list['barcode_B']}}" placeholder="段ボールのバーコードを入力してください" required>
						<div id="" class="invalid-feedback">バーコードを読み込んでください</div>
					</div>
				</div>
				<div class="form-group" id="consumables-code-form-group" style="width: 325px">
					<div id="barcode-group-2">
						<label for="consumables-code">消耗品バーコード（箱）<span class="badge bg-danger">必須</span> </label>
						<input type="number" class="form-control" name="barcode[N]" id="consumables-code-2" value="{{$consumables_barcode_list['barcode_N']}}" placeholder="箱のバーコードを入力してください" required>
					</div>
					<div id="consumables-code-2-feedback" class="invalid-feedback">バーコードを読み込んでください</div>
				</div>
				<div class="form-group" id="consumables-code-form-group" style="width: 325px">
					<div id="barcode-group-3">
						<label for="consumables-code">消耗品バーコード（個）</label>
						<input type="number" class="form-control" name="barcode[Q]" id="consumables-code-3" value="{{$consumables_barcode_list['barcode_Q']}}" placeholder="個のバーコードを入力してください">
					</div>
					<div id="consumables-code-3-feedback" class="invalid-feedback">バーコードを読み込んでください</div>
				</div>
			</div>

			<div class="d-flex row mb-2">
				<div class="mb-1" id="consumables-name-form-group" style="width: 325px">
					<label for="consumables-name">消耗品名 <span class="badge bg-danger">必須</span> </label>
					<input type="text" class="form-control" name="consumables_name" id="consumables-name"
						value="{{$consumables->consumables_name}}" required>
					<div id="consumables-name-feedback" class="invalid-feedback"></div>
				</div>

				<div class="mb-1" style="width: 200px">
					<label for="number-unit-price">仕入単価（税込） <span class="badge bg-danger">必須</span></label>
					<div class="input-group" id="number-unit-price-form-group">
						<input type="number" class="form-control text-end" name="number_unit_price" id="number-unit-price"
							value="{{$consumables->number_unit_price}}" placeholder="箱の仕入単価（税込）を入力してください" required>
						<span class="input-group-text">円</span>
						<div id="number-unit-price-feedback" class="invalid-feedback">箱の仕入単価（税込）を入力してください</div>
					</div>
				</div>
			</div>

			<div class="d-flex row mb-2">
				<div class="mb-1" style="width: 325px">
					<label for="">単位数量 <span class="badge bg-danger">必須</span> </label>
					<div class="input-group">
						<input type="number" class="form-control text-end" id="quantity" name="quantity" value="{{$consumables->quantity}}"
							aria-label="quantity_unit" placeholder="個数を入力" required>
						<span class="input-group-text">個</span>
						<input type="number" class="form-control text-end" id="number" name="number" value="{{$consumables->number}}"
							aria-label="number_unit" placeholder="箱数を入力" required>
						<span class="input-group-text">箱/段</span>
					</div>
				</div>

				<div class="mb-1" style="width: 200px">
					<label for="">消費数量 <span class="badge bg-danger">必須</span> </label>
					<div class="d-flex">
						<input type="number" class="form-control text-end" id="use-quantity" name="use_quantity"
							value="{{$consumables->use_quantity}}" aria-label="quantity_unit"　placeholder="1回あたりの消費数量を入力してください" required>
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

			<div class="d-flex row mb-2">
				<div id="consumables-category" style="width: 325px">
					<label class="" for="consumables-category-code">カテゴリ<span class="badge bg-danger">必須</span></label>
					<select name="consumables_category_code" id="consumables-category-code" class="form-select"
						required>
						@foreach($consumables_category_all as $category)
						{{-- カテゴリごとに作成 --}}
						@if ($category->consumables_category_code == $consumables->consumables_category_code)
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

				<div class="form-group" id="last-negotiation-date-form-group" style="width: 325px">
					<label for="last-negotiation-date">最終価格交渉日 </label>
					<input type="date" class="form-control" name="last_negotiation_date" id="last-negotiation-date"
						value="{{$consumables->last_negotiation_date}}">
					<div id="last-negotiation-date-feedback" class="invalid-feedback"></div>
				</div>
			</div>

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
		<div class="card-footer d-flex justify-content-end">
			<input type="submit" class="btn btn-primary mx-3" name="post" value="更新する">
			@include('modal/master_delete')
		</div>
	</div>
</form>