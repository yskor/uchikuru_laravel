<div class="row g-2">
	<div class="col-6 card p-0 mx-1" style="width:400px;">
		<div class="card-header">
			{{-- 消耗品名 --}}
			<h5 class="w-100" id="ship_consumables_name">
				{{$shortage_consumables->consumables_name}}</h5>
		</div>
		<div class="card-body d-flex">
			<div class="">
				{{-- 画像 --}}
				<img src="{{ asset('upload/consumables/'.$shortage_consumables->image_file_extension)}}"
					style="width:100px;height:100px;">
			</div>
			<div class="w-100" style="margin-left: 15px">
				{{-- 消費数量 --}}
					<div class="mb-3">
						<div class="fs-4">
							@if ($shortage_consumables->f_stock_number)
							{{ $shortage_consumables->f_stock_number }}
							@else
							0
							@endif
							箱
							@if($shortage_consumables->use_unit_code == 'Q' and $shortage_consumables->f_stock_quantity > 0)
								{{-- 消費単位が個数かつ1以上の時 --}}
								+
								{{ $shortage_consumables->f_stock_quantity }}
								個
							@endif
						</div>
					</div>
					<div>
						<div class="fs-6">
							本 部:
							@if ($shortage_consumables->stock_number)
							{{ $shortage_consumables->stock_number }}
							@else
							0
							@endif
							箱
						</div>
					</div>
			</div>
		</div>
	</div>
</div>