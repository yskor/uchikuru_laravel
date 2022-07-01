@if($shortage_list)
<div class="row g-2">
	@foreach($facility_list as $facility)
		@foreach($shortage_list as $office_code => $datas)
			@if($facility->office_code == $office_code)
			<h4>{{$facility->facility_name}}</h4>
				@foreach($datas as $data)
				{{-- 出荷済み数と在庫数の合計が不足定数を上回る場合は非表示 --}}
				<div class="card p-0 mx-1" style="width:360px;">
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
						<div class="w-100" style="margin-left: 15px">
							{{-- 消費数量 --}}
								<div class="mb-3 fs-6">
									<div class="">
										現在庫数：
										{{ $data->stock_number }}
										@if($data->quantity == 1)個 @else 箱 @endif
										@if($data->use_unit_code == 'Q' and $data->stock_quantity > 0)
											{{-- 消費単位が個数かつ1以上の時 --}}
											+{{ $data->stock_quantity }}個
										@endif
									</div>
									@if($data->total_shipped_number)
									<div class="">
										出荷済数：
										{{ $data->total_shipped_number}}
										@if($data->quantity == 1)個 @else 箱@endif
									</div>
									@endif
									<div class="">
										補充数　：
										{{ $data->shortage_quantity}}
										@if($data->quantity == 1)個 @else 箱@endif
									</div>
								</div>
								<div class="d-flex justify-content-end">
									@if($login->office_code == 90)
									@include("modal/shortage_labo_deliver_consumables")
									@else
									@include("modal/shortage_consumables_ship")
									@endif
								</div>
						</div>
					</div>
				</div>
				@endforeach
			@endif
		@endforeach
	@endforeach
</div>
@else
<div class="alert alert-dark" role="alert">在庫不足の消耗品はありません</div>
@endif