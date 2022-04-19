<div class="container">
	<div id="富山" class="card mb-3" data-area="富山">
		<h6 class="card-header">富山</h6>
		<div class="card-body">
			<div id="list">
				<div class="alert alert-secondary">配送中の薬はありません。</div>
			</div>
		</div>
	</div>
	<div id="石川" class="card mb-3" data-area="石川">
		<h6 class="card-header">石川</h6>
		<div class="card-body">
			<div id="list">
				<div class="alert alert-secondary">配送中の薬はありません。</div>
			</div>
		</div>
	</div>
</div>
<div id="list table-responsive">
	<div class="modal_view" id="modal_view">
		<!-- Button trigger modal -->
		{{-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#consumablesBuyModal">
		</button> --}}

		<!-- Modal -->
		<div class="modal fade" id="consumablesShipModal" tabindex="-1" aria-labelledby="exampleModalLabel"
			aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<form action="{{route('ship_list')}}" method="POST" enctype="multipart/form-data">
						@csrf
						<div class="modal-header">
							<h5 class="modal-title" id="modal-title">出荷する消耗品</h5>
							<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

						</div>
						<div class="modal-body">
							<div class="input-group mb-2" id="ship-office-form-group">
								<label class="input-group-text" for="office_code_to">出荷先</label>
								<select class="form-control" name="office_code_to" id="office_code_to" required>
									<option value="" selected=""></option>
									@foreach ($facility_all as $facility)
									<option value="{{$facility->office_code}}">{{$facility->facility_name}}
									</option>
									@endforeach
								</select>
							</div>
							<table class="table table-striped" id="ships_table">
								<tbody id="ships">
								</tbody>
							</table>
						</div>

						{{-- <div class="form-group" id="buy-number-form-group">
							<label for="buy-number">仕入れ数 <span class="badge bg-danger">必須</span> </label>
							<input type="number" class="form-control"
								id="buy-number"><span>{{$consumables_ship_data->number_unit}}<span>
						</div> --}}

						<div class="modal-footer">
							<button type="button" class="btn btn-secondary" id="btn-close"
								data-bs-dismiss="modal">閉じる</button>
							<button type="submit" class="btn btn-primary" id="btn-do">出荷を予定する</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>

	@if (!empty($consumables_ship_list))
	{{-- 出荷予定の消耗品がある場合 --}}
	<table class="table table-striped" id="table" style="position: relative;">
		<thead>
			<tr class="table-scroll-fixed-top bg-white" style="">
				<th class="text-center table-w text-nowrap"></th>
				{{-- <th class="text-center table-w text-nowrap">消耗品バーコード</th> --}}
				<th class="text-center table-w text-nowrap">写真</th>
				<th class="text-center table-w text-nowrap">入数/個数</th>
				<th class="text-center table-w text-nowrap">出荷数</th>
			</tr>
		</thead>
		<tbody>
			@foreach ($consumables_ship_list as $data)
			<tr data-code="{{ $data->consumables_code }}">
				<td class="text-center table-w">
					<button type="button" class="btn btn-primary btn-sm" id="btn-info"
						data-code="{{ $data->consumables_code }}" data-management-office-code=""
						data-carehome-office-code="">
						詳細
					</button>
				</td>
				<!-- <%* 消耗品コード *%> -->
				{{-- <td class="text-center table-w">
					<div class="mb-2">{{ $data->consumables_barcode }}</div>
					<div id="qrcode-{{$data->consumables_barcode }}" data-bs-toggle="tooltip" data-bs-placement="top"
						title="右クリックで保存できます。"></div>
				</td> --}}
				<!-- <%* 消耗品名 *%> -->
				<td class="text-center table-w">
					<div class="mb-2 table-w">{{ $data->consumables_name }}</div>
					<!-- <%* 画像 *%> -->
					@if(!empty( $data->image_file_extension))
					<div><img src="{{ asset('upload/consumables/'.$data->image_file_extension)}}"
							style="width:100px;height:100px;"></div>
					@endif
				</td>
				<!-- <%* 入数 / 単位 *%> -->
				<td class="text-center table-w">{{ $data->quantity }} {{ $data->quantity_unit }} / {{ $data->number_unit
					}}</td>
				<!-- <%* 施設出荷数 *%> -->
				<td class="text-center table-w">
					@if ($data->ship_quantity)
					{{ $data->ship_quantity }}
					@else
					0
					@endif
					{{ $data->number_unit }}
				</td>
			</tr>
			@endforeach
		</tbody>
	</table>
	@else
	{{-- 出荷予定の消耗品がない場合 --}}
	<div class="alert alert-dark" role="alert">
		<h2 class="">現在出荷予定の消耗品はありません</h2>
	</div>
	@endif

	<script>


	</script>

</div>