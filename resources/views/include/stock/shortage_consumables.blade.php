@if($shortage_list)
<div class="row g-2">
	@foreach($shortage_list as $data)
	<div class="col-6 card p-0 mx-1" style="width:400px;">
		<div class="card-header">
			{{-- 消耗品名 --}}
			<h5 class="w-100" id="ship_consumables_name">
				【{{$data->facility_name}}】{{$data->consumables_name}}</h5>
		</div>
		<div class="card-body d-flex">
			<div class="">
				{{-- 画像 --}}
				<img src="{{ asset('upload/consumables/'.$data->image_file_extension)}}"
					style="width:100px;height:100px;">
			</div>
			<div class="w-100" style="margin-left: 15px">
				{{-- 消費数量 --}}
					<div class="mb-3 fs-5">
						<div class="">
							現在庫数：
							{{ $data->stock_number }}
							箱
							@if($data->use_unit_code == 'Q' and $data->stock_quantity > 0)
								{{-- 消費単位が個数かつ1以上の時 --}}
								+
								{{ $data->stock_quantity }}
								個
							@endif
						</div>
						<div class="">
							不足数　：
							{{ $data->shortage_quantity }}
							箱
						</div>
					</div>
					<div class="d-flex justify-content-end">
						@include("modal/shortage_consumables_ship")
					</div>
			</div>
		</div>
	</div>
	@endforeach
</div>
@else
<div class="alert alert-dark" role="alert">出荷中の消耗品はありません</div>
@endif