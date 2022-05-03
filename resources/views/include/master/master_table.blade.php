<div class="d-flex">
	<a class="btn btn-primary mb-2" href="{{asset('add_master')}}">
		<i class="fas fa-plus fa-fw"></i>追加
	</a>

	<div class="ms-auto">
		<a class="btn btn-secondary" href="{{asset('qr_list')}}" target="_blank" rel="noopener noreferrer">QRコード一覧</a>
	</div>
</div>

<div class="card">
	<h6 class="card-header w-100">マスタ一覧</h6>
	<div class="table-responsive">
		<table class="table table-striped card-body" id="table">
			<thead>
				<tr>
					<th class="text-center table-w text-nowrap">消耗品バーコード</th>
					<th class="text-center text-nowrap" style="width:200px;">消耗品名</th>
					<th class="text-center table-w text-nowrap">仕入単価（税込）</th>
					<th class="text-center table-w text-nowrap">消費単位</th>
					<th class="text-center table-w text-nowrap">最終価格交渉日</th>
					<th class="text-center"></th>
				</tr>
			</thead>
			<tbody>
				@foreach($consumables_list as $data)
				<tr class="col" data-consumables-code="{{ $data->consumables_code }}">
					<!-- <%* 消耗品コード *%> -->
					<td class="text-center table-w">
						<div class="mb-2">{{ $data->consumables_barcode }}</div>
						<div id="qrcode-{{$data->consumables_barcode }}" data-bs-toggle="tooltip"
							data-bs-placement="top" title="右クリックで保存できます。"></div>
					</td>
					<!-- <%* 消耗品名 *%> -->
					<td class="text-center">
						<div class="mb-2">{{ $data->consumables_name }}</div>
						<!-- <%* 画像 *%> -->
						<div><img
								src="{{ asset('upload/consumables/'. $data->image_file_extension)}}"
								style="width:100px;height:100px;"></div>
					</td>
					<!-- <%* 仕入れ単価 *%> -->
					<td class="text-center table-w">@if(!empty($data->number_unit_price)) {{ $data->number_unit_price }}
						円 @else -@endif
					</td>
					<!-- <%* 消費数量 *%> -->
					<td class="text-center table-w">{{ $data->use_quantity }} {{ $data->use_unit }}</td>
					<!-- <%* 最終価格交渉日 *%> -->

					<td class="text-center table-w">
						@if(!empty( $data->last_negotiation_date ))
						{{ $data->last_negotiation_date }}
						@else
						-
						@endif
					</td>
					<td style="40px">
						<a class="btn btn-primary t-btn" href="{{asset('update_master'. '/' . $data->consumables_code )}}">変更</a>
						{{-- @include("modal/edit_consumables_master_modal") --}}
					</td>
				</tr>
				@endforeach
			</tbody>
		</table>
	</div>
</div>