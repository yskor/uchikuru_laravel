<div class="d-flex">
	<a class="btn btn-primary mb-2" href="{{asset('add_master') . '/' . $consumables_category_code}}">
		<i class="fas fa-plus fa-fw"></i>追加
	</a>

	<div class="ms-auto">
		<a class="btn btn-secondary" href="{{asset('qr_list')}}" target="_blank" rel="noopener noreferrer">
			QRコード一覧
			<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
				class="bi bi-box-arrow-in-up-right" viewBox="0 0 16 16">
				<path fill-rule="evenodd"
					d="M6.364 13.5a.5.5 0 0 0 .5.5H13.5a1.5 1.5 0 0 0 1.5-1.5v-10A1.5 1.5 0 0 0 13.5 1h-10A1.5 1.5 0 0 0 2 2.5v6.636a.5.5 0 1 0 1 0V2.5a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 .5.5v10a.5.5 0 0 1-.5.5H6.864a.5.5 0 0 0-.5.5z" />
				<path fill-rule="evenodd"
					d="M11 5.5a.5.5 0 0 0-.5-.5h-5a.5.5 0 0 0 0 1h3.793l-8.147 8.146a.5.5 0 0 0 .708.708L10 6.707V10.5a.5.5 0 0 0 1 0v-5z" />
			</svg>
		</a>
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
					<th class="text-center table-w text-nowrap">持ち出し単位</th>
					<th class="text-center table-w text-nowrap">最終価格交渉日</th>
					<th class="text-center"></th>
				</tr>
			</thead>
			<tbody>
				@foreach($consumables_list as $data)
				<tr class="col" id="{{ $data->consumables_code }}" data-consumables-code="{{ $data->consumables_code }}">
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
						<div><img src="{{ asset('upload/consumables/'. $data->image_file_extension)}}"
								style="width:100px;height:100px;"></div>
					</td>
					<!-- <%* 仕入単価 *%> -->
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
						<a class="btn btn-primary t-btn"
							href="{{asset('update_master'. '/' . $data->consumables_code )}}">変更</a>
						{{-- @include("modal/edit_consumables_master_modal") --}}
					</td>
				</tr>
				@endforeach
			</tbody>
		</table>
	</div>
</div>