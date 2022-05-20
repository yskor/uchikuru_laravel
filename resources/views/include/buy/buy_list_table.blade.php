<h5>仕入履歴</h5>
<div class="input-group" style="width: 400px;">
	<div class="input-group-prepend">
		<label class="input-group-text" for="office-code-to">仕入先</label>
	</div>
	<select class="form-select" id="office-code-to" name="office_code_to">
		@foreach($buy_facility_all as $data)
			@if($data->office_code == 91)
			<option value="{{$data->office_code}}" selected>{{$data->facility_name}}</option>
			@else
			<option value="{{$data->office_code}}">{{$data->facility_name}}</option>
			@endif
		@endforeach
	</select>
</div>
<div id="list" class="mt-3">
	<div class="row g-2">
		@foreach ($consumables_buy_all as $data)
		<div class="col-6 card p-0 mx-1" style="width:400px;">
			<div class="card-header">
				{{-- 消耗品名 --}}
				<h5 class="w-100" id="ship_consumables_name">
					{{$data->consumables_name}}</h5>
			</div>
			<div class="card-body d-flex">
				<div class="">
					{{-- 画像 --}}
					<img src="{{ asset('upload/consumables/'.$data->image_file_extension)}}"
						style="width:100px;height:100px;">
				</div>
				<div class="w-100 px-2">
					{{-- 消費数量 --}}
					<table>
						<tr>
							<th>仕入数：</th>
							<td>{{ $data->buy_quantity }} {{$data->buy_unit}}</td>
						</tr>
						<tr>
							<th>仕入単価：</th>
							<td>{{ $data->buy_price }}<span style="font-size: small">円（税込）</span><td>
						</tr>
						<tr>
							<th>仕入日時：</th>
							<td>{{ Carbon\Carbon::parse($data->created_at)->format('Y年m月d日 H:i') }}</td>
						</tr>
					</table>
				</div>
			</div>
		</div>
	
		@endforeach
	</div>
</div>