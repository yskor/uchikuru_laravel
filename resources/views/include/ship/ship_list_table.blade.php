<div id="list table-responsive">
	
	@if (isset($consumables_ship_list[0]))
	<div>
		<h3>現在出荷予定の消耗品</h3>
	</div>
	{{-- 出荷予定の消耗品がある場合 --}}
		{{-- <table class="table table-striped" id="table" style="position: relative;">
			<thead>
				<tr class="table-scroll-fixed-top bg-white" style="">
					<th class="text-center table-w text-nowrap"></th>
					<th class="text-center table-w text-nowrap">消耗品バーコード</th>
					<th class="text-center table-w text-nowrap">消耗品</th>
					<th class="text-center table-w text-nowrap">入数/個数</th>
					<th class="text-center table-w text-nowrap">出荷数</th>
					<th class="text-center table-w text-nowrap">出荷日</th>
					<th class="text-center table-w text-nowrap">出荷元</th>
				</tr>
			</thead>
			<tbody>
				@foreach ($consumables_ship_list as $data)
				<tr data-code="{{ $data->consumables_code }}">
					<td class="text-center table-w">
						<button type="button" class="btn btn-primary btn-sm" id="btn-info" data-code="{{ $data->consumables_code }}" data-management-office-code="" data-carehome-office-code="">
							詳細
						</button>
					</td>
					<!-- <%* 消耗品コード *%> -->
					<td class="text-center table-w">
						<div class="mb-2">{{ $data->consumables_barcode }}</div>
						<div id="qrcode-{{$data->consumables_barcode }}" data-bs-toggle="tooltip" data-bs-placement="top"
							title="右クリックで保存できます。"></div>
					</td>
					<!-- <%* 消耗品名 *%> -->
					<td class="text-center">
						<div class="mb-2">{{ $data->consumables_name }}</div>
						<!-- <%* 画像 *%> -->
						<div><img src="{{ asset('upload/consumables/'.$data->image_file_extension)}}"
								style="width:100px;height:100px;"></div>
					</td>
					<!-- <%* 入数 / 単位 *%> -->
					<td class="text-center table-w">{{ $data->quantity }} {{ $data->quantity_unit }} / {{ $data->number_unit }}</td>
					<!-- <%* 施設出荷数 *%> -->
					<td class="text-center table-w">
						{{ $data->shipped_number }}
						{{ $data->number_unit }}
					</td>
					<!-- <%* 施設出荷日 *%> -->
					<td class="text-center table-w">
						{{ $data->shipped_at }}
					</td>
					<!-- <%* 施設出荷日 *%> -->
					<td class="text-center table-w">
						{{ $data->office_name_from }}
					</td>
				</tr>
				@endforeach
			</tbody>
		</table> --}}
	<div class="row">
		@foreach ($consumables_ship_list as $data)
		<div class="card m-1 p-0" id="add_ship_{{$data->consumables_code}}" style="width:350px;">
			<div class="card-header d-flex" style="background-color: rgba(0,0,0,.03)">
				<h5 class="w-100" id="ship_consumables_name">{{$data->consumables_name}}</h5>
			</div>
			<div class="card-body d-flex">
				<div class="">
					<img src="{{ asset('upload/consumables/'.$data->image_file_extension)}}" style="width:100px;height:100px;">
				</div>
				<div class="w-100 px-2">
					{{-- 消耗品コード --}}
					<input type="hidden" name="ships[{{$data->consumables_code}}][consumables_code]" value="{{$data->consumables_code}}">
					{{-- 職員コード --}}
					<input type="hidden" name="staff_code" value="{{$login->staff_code}}">
					
					<label for="ship-number-form-group">出荷数：</label>
					<div class="input-group" id="ship-number-form-group">
						<p>{{$data->shipped_number}}{{$data->number_unit}}({{$data->quantity}}{{$data->quantity_unit}}/{{$data->number_unit}})</p>
					</div>
				</div>
			</div>
			
		</div>
		@endforeach
	</div>
	@else
	{{-- 出荷予定の消耗品がない場合 --}}
		<div class="alert alert-dark" role="alert">
			<h4 class="">出荷予定の消耗品はありません</h4>
		</div>
	@endif

<script>


</script>

</div>