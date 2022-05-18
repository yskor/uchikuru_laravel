<div class="d-flex mb-2">
	<h5 class="me-auto mb-0 d-flex align-items-end">{{ $consumables->consumables_name }}の納品状況（今週から過去8週間）</h5>
	<div class="dropdown">
		<button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
			過去8週間のデータ
		</button>
		<ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="dropdownMenuButton">
			<li><a class="dropdown-item active" href="{{route('week_deliver_status', ['consumables_category_code' => $consumables_category_code,'consumables_code' => $consumables_code])}}">過去8週間のデータ</a></li>
			<li><a class="dropdown-item" href="{{route('month_deliver_status', ['consumables_category_code' => $consumables_category_code,'consumables_code' => $consumables_code])}}">過去1年間のデータ</a></li>
		</ul>
	</div>
</div>
<div class="table-responsive">
	<table class="table table-striped table-bordered" id="table">
		<thead>
			<tr>
				<th class="text-center text-nowrap">施設名</th>
				@for ($i = 8; $i > 0; $i--)
					<th class="text-center">{{ \Carbon\Carbon::today()->startOfWeek()->subDay(1)->subWeeks($i-1)->format("n/j") }}～{{ \Carbon\Carbon::today()->endOfWeek()->subDay(1)->subWeeks($i-1)->format("n/j") }}</th>
				@endfor
				<th class="text-center text-nowrap">合計</th>
			</tr>
		</thead>
		<tbody>
			@foreach($deliver_status as $facility => $week_status)
			<tr class="col">
				<!-- <%* 消耗品コード *%> -->
				<td class="text-center">
					<div class="">{{ $facility }}</div>
				</td>
				@foreach($week_status as $value)
				<td class="text-center">
					@if ($value != 0)
					<div class="">{{$value}}箱</div>
					@else
					<div class="">―</div>
					@endif
				</td>
				@endforeach
			</tr>
			@endforeach
		</tbody>
		<thead>
			<tr>
				<th class="text-center text-nowrap">施設名</th>
				@for ($i = 8; $i > 0; $i--)
					<th class="text-center">{{ \Carbon\Carbon::today()->startOfWeek()->subDay(1)->subWeeks($i-1)->format("n/j") }}～{{ \Carbon\Carbon::today()->endOfWeek()->subDay(1)->subWeeks($i-1)->format("n/j") }}</th>
				@endfor
				<th class="text-center text-nowrap">合計</th>
			</tr>
		</thead>
	</table>
</div>