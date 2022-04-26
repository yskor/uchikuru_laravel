<form action="{{route('facility_ship_list', ['office_code' => $office_code]) }}" method="POST" enctype="multipart/form-data">
	@csrf
	<div class="card mb-3">
		<div class="card-header">
			<h5 class="card-title" id="card-title">出荷する消耗品</h5>
		</div>

		<div class="card-body">
			<div class="input-group mb-2" id="ship-office-form-group" style="width:250;">
				<label class="input-group-text" for="office_code_to">出荷先</label>
				<select class="form-control" name="office_code_to" id="office_code_to" required>
					{{-- office_codeがallの場合は空欄を初期値とする --}}
					@if ($office_code == 'all') 
					<option value="" selected=""></option>
					@endif
					@foreach ($facility_all as $facility)
						{{-- office_codeが一致する場合は初期値とする --}}
						@if ($office_code == $facility->office_code) 
						<option value="{{$facility->office_code}}" selected="">{{$facility->facility_name}}
						</option>
						@else
						<option value="{{$facility->office_code}}">{{$facility->facility_name}}
						</option>
						@endif
					@endforeach
				</select>
			</div>
			<div class="row" id="ships">
				@include("include/ship_consumables", ['consumables_ship_data' => $consumables_ship_data])
			</div>
		</div>

		{{-- <div class="form-group" id="buy-number-form-group">
			<label for="buy-number">仕入れ数 <span class="badge bg-danger">必須</span> </label>
			<input type="number" class="form-control"
				id="buy-number"><span>{{$consumables_ship_data->number_unit}}<span>
		</div> --}}

		<div class="card-footer">
			<button type="button" class="btn btn-secondary" id="btn-close" data-bs-dismiss="modal">閉じる</button>
			<button type="submit" class="btn btn-primary" id="btn-do">出荷する</button>
		</div>
	</div>
</form>