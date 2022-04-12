<!-- Button trigger modal -->
<button type="button" class="btn btn-primary mb-2" data-bs-toggle="modal" data-bs-target="#AddModal">
	<i class="fas fa-plus fa-fw"></i>追加
</button>

<div class="card">
	<h6 class="card-header w-100">マスタ一覧</h6>
	<div class="table-responsive">
		<table class="table table-striped table-bordered card-body" id="table">
			<thead>
				<tr>
					<th class="text-center table-w text-nowrap">消耗品コード</th>
					<th class="text-center table-w text-nowrap">消耗品名</th>
					<th class="text-center table-w text-nowrap">仕入れ単価</th>
					<th class="text-center table-w text-nowrap">入数 / 単位</th>
					<th class="text-center table-w text-nowrap">使用単位</th>
					<th class="text-center table-w text-nowrap">複数使用</th>
					<th class="text-center table-w text-nowrap">最終交渉日</th>
					<th class="text-center"></th>
				</tr>
			</thead>
			<tbody>
				@foreach($consumables_list as $data)
				<tr class="col" data-consumables-code="{{ $data->consumables_code }}">
					<!-- <%* 消耗品コード *%> -->
					<td class="text-center table-w">
						<div class="mb-2">{{ $data->consumables_barcode }}</div>
						<div id="qrcode-{{$data->consumables_barcode }}" data-bs-toggle="tooltip" data-bs-placement="top"
							title="右クリックで保存できます。"></div>
					</td>
					<!-- <%* 消耗品名 *%> -->
					<td class="text-center table-w">
						<div class="mb-2 text-truncate table-w">{{ $data->consumables_name }}</div>
						<!-- <%* 画像 *%> -->
						@if(!empty( $data->image_file_extension))
						<div><img src="{{ asset('upload/consumables/'.$data->image_file_extension)}}"
								style="width:100px;height:100px;"></div>
						@endif
					</td>
					<!-- <%* 仕入れ単価 *%> -->
					<td class="text-center table-w">@if(!empty($data->number_unit_price)) {{ $data->number_unit_price }} 円 @else -@endif
					</td>
					<!-- <%* 入数 / 単位 *%> -->
					<td class="text-center table-w">{{ $data->quantity }} {{ $data->quantity_unit }} / {{ $data->number_unit }}</td>
					<!-- <%* 使用単位 *%> -->
					<td class="text-center table-w">@if($data->use_quantity == true) 入数 @else 個数 @endif</td>
					<!-- <%* 複数使用可 *%> -->
					<td class="text-center table-w">@if($data->can_use_multiple == true) 可 @else 不可 @endif</td>
					<!-- <%* 最終交渉日 *%> -->
                    
					<td class="text-center table-w">
                        @if(!empty( $data->last_negotiation_date )) 
                        {{ $data->last_negotiation_date }}
                        @else
                        -
                        @endif
                    </td>
					{{-- <td class="">
						<ul>
							<li>
								仕入単価：@if(!empty($data->number_unit_price)) {{ $data->number_unit_price }} 円 @else -@endif
							</li>
							<li>
								入数/単位：{{ $data->quantity }} {{ $data->quantity_unit }} / {{ $data->number_unit }}
							</li>
							<li>
								使用単位：@if($data->use_quantity == true) 入数 @else 個数 @endif
							</li>
							<li>
								複数使用：@if($data->can_use_multiple == true) 可 @else 不可 @endif
							</li>
							<li>
								最終交渉日：{{ $data->last_negotiation_date }}
							</li>
						</ul>
					</td> --}}
					<!-- <%* ボタン *%> -->
					<!-- Button trigger modal -->
					<td  style="40px">
						<button type="button" class="btn btn-primary t-btn" data-bs-toggle="modal"
							data-bs-target="#Edit{{ $data->consumables_code }}" style="40px">
							変更
						</button>
						@include("modal/edit_consumables_master_modal")
					</td>
				</tr>
				@endforeach
			</tbody>
		</table>
	</div>
</div>