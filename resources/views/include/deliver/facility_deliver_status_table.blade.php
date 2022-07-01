<div class="d-flex mb-2">
	<h5 class="me-auto mb-0 d-flex align-items-end">{{ $office_data->facility_name }}の納品状況</h5>
	<div class="dropdown">
		<ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
			<li class="nav-item" role="presentation">
				<div class="nav-link active"
				id="8week-tab"
				data-bs-toggle="pill"
				data-bs-target="#tab-8week"
				type="button"
				role="tab"
				aria-controls="tab-8week"
				aria-selected="true">
					過去8週間のデータ
				</div>
			</li>
			<li class="nav-item" role="presentation">
				<button class="nav-link"
				id="1year-tab"
				data-bs-toggle="pill"
				data-bs-target="#tab-1year"
				type="button"
				role="tab"
				aria-controls="tab-1year"
				aria-selected="false">
					過去1年間のデータ
				</button>
			</li>
		</ul>
	</div>
</div>
<div class="tab-content" id="pills-tabContent">
	@foreach ($deliver_status as $period => $status_datas)
	@if($period == '8week')
	<div    class="tab-pane fade show active"
    id="tab-{{$period}}"
    role="tabpanel"
    aria-labelledby="{{$period}}-tab">
	@else
	<div     class="tab-pane fade"
    id="tab-{{$period}}"
    role="tabpanel"
    aria-labelledby="{{$period}}-tab">
	@endif
		<div class="table-responsive">
			<table class="table table-striped table-bordered" id="table">
				<thead>
					<tr>
						<th class="text-center text-nowrap">消耗品名</th>
						@if($period == '8week')
							@for ($i = 8; $i > 0; $i--)
								<th class="text-center">{{ \Carbon\Carbon::today()->startOfWeek()->subDay(1)->subWeeks($i-1)->format("n/j") }}～{{ \Carbon\Carbon::today()->endOfWeek()->subDay(1)->subWeeks($i-1)->format("n/j") }}</th>
							@endfor
						@elseif($period == '1year')
							@for ($i = 12; $i > 0; $i--)
							<th class="text-center">{{date('n月', strtotime('-'. ($i-1). 'month', time()))}}</th>
							@endfor
						@endif
						<th class="text-center text-nowrap">合計</th>
					</tr>
				</thead>
				<tbody>
					@foreach($status_datas as $consumables_name => $deliver_datas)
					<tr class="col">
						<!-- <%* 消耗品コード *%> -->
						<td class="text-start">
							<div class="">{{ $consumables_name }}</div>
						</td>
						@foreach($deliver_datas as $quantity)
						<td class="text-center">
							@if ($quantity != 0)
							<div class="">{{$quantity}}箱</div>
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
						<th class="text-center text-nowrap">消耗品名</th>
						@if($period == '8week')
							@for ($i = 8; $i > 0; $i--)
								<th class="text-center">{{ \Carbon\Carbon::today()->startOfWeek()->subDay(1)->subWeeks($i-1)->format("n/j") }}～{{ \Carbon\Carbon::today()->endOfWeek()->subDay(1)->subWeeks($i-1)->format("n/j") }}</th>
							@endfor
						@elseif($period == '1year')
							@for ($i = 12; $i > 0; $i--)
							<th class="text-center">{{date('n月', strtotime('-'. ($i-1). 'month', time()))}}</th>
							@endfor
						@endif
						<th class="text-center text-nowrap">合計</th>
					</tr>
				</thead>
			</table>
		</div>
	</div>
	@endforeach
</div>