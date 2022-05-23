<div id="list table-responsive">
	
	@if (isset($consumables_ship_list[0]))
	<div>
		<h3>現在出荷中の消耗品</h3>
	</div>
	{{-- 出荷予定の消耗品がある場合 --}}
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
					
					<div class="input-group" id="ship-number-form-group">
						<h5><span>出荷数：</span>{{$data->shipped_number}}箱（{{$data->shipped_number*$data->quantity}}個）</h5>
					</div>
					<div class="d-flex justify-content-end align-items-end">
						@include("modal/ship_cancel")
					</div>
				</div>
			</div>
			
		</div>
		@endforeach
	</div>
	@else
	{{-- 出荷予定の消耗品がない場合 --}}
		<div class="alert alert-dark" role="alert">出荷中の消耗品はありません</div>
	@endif

<script>


</script>

</div>