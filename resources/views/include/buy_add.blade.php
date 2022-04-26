<form action="{{route('buy_list')}}" method="POST" enctype="multipart/form-data">
	@csrf
<div class="card mb-3">
		<div class="card-header">
			<h5 class="card-title" id="card-title">仕入れた消耗品</h5>
		</div>
		<div class="card-body">
			<div class="input-group mb-2" id="buy-office-form-group">
				<label class="input-group-text" for="office_code_to">仕入先</label>
				<select class="form-control" name="office_code_to" id="office_code_to" required>
					{{--今はアシスト固定 --}}
					<option value="アシスト" selected="">アシスト</option>
				</select>
			</div>
			<div class="row" id="buys">
				@include("include/buy_consumables", ['consumables_buy_data' => $consumables_buy_data])
			</div>
		</div>

		{{-- <div class="form-group" id="buy-number-form-group">
			<label for="buy-number">仕入れ数 <span class="badge bg-danger">必須</span> </label>
			<input type="number" class="form-control"
				id="buy-number"><span>{{$consumables_buy_data->number_unit}}<span>
		</div> --}}

		<div class="card-footer">
			<button type="button" class="btn btn-secondary" id="btn-close" data-bs-dismiss="modal">閉じる</button>
			<button type="submit" class="btn btn-primary" id="btn-do">仕入れる</button>
		</div>
	</div>
</form>