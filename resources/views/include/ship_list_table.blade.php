<div id="list table-responsive">
	<div class="modal_view" id="modal_view"></div>
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
						<button type="button" class="btn btn-primary btn-sm" id="btn-info" data-code="{{ $data->consumables_code }}" data-management-office-code="" data-carehome-office-code="">
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
					<td class="text-center table-w">{{ $data->quantity }} {{ $data->quantity_unit }} / {{ $data->number_unit }}</td>
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