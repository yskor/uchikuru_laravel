@if (isset($deliver_consumables_list[0]))
	<div class="row g-2">
	@foreach ($deliver_consumables_list as $data)
		<div class="col-6 card p-0 mx-1" style="width:170px">
			<img src="{{ asset('upload/consumables/'.$data->image_file_extension)}}" class="card-img-top" alt="" style="width:168px;height:168px;">
			<div class="card-body">
			<h5 class="card-title">{{ $data->consumables_name }}</h5>
			@include('include/deliver/deliver_consumables')
			</div>
		</div>

	@endforeach
	</div>

@else
{{-- 出荷予定の消耗品がない場合 --}}
	<div class="alert alert-dark" role="alert">
		<h4 class="">現在未納となっている消耗品はありません</h4>
	</div>
@endif

