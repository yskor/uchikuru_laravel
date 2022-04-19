
<div class="table-responsive">
	<table class="table table-striped" id="table" style="table-layout: fixed;">
		<thead>
			{{-- 事業所を並べる --}}
			<tr>
				<th class="table-scroll-fixed-top bg-white" style="width: 150px"></th>
				@foreach($facility_all as $facility)
				<th class="table-scroll-fixed-top bg-white table-w">
					{{ $facility->facility_name }}
				</th>
				@endforeach
			</tr>
		</thead>
		<tbody>
			{{-- 消耗品を一番左の列に並べる --}}
			@foreach ($category_consumables_all as $consumables)
			<tr data-consumables-code="{{$consumables->consumables_code}}">
				<th class="table-scroll-fixed-left bg-white" style="width:150px;height:100px;">
					<div><svg class="svg-inline--fa fa-cube fa-w-16 fa-fw" aria-hidden="true" focusable="false"
						data-prefix="fas" data-icon="cube" role="img" xmlns="http://www.w3.org/2000/svg"
						viewBox="0 0 512 512" data-fa-i2svg="">
						<path fill="currentColor"
						d="M239.1 6.3l-208 78c-18.7 7-31.1 25-31.1 45v225.1c0 18.2 10.3 34.8 26.5 42.9l208 104c13.5 6.8 29.4 6.8 42.9 0l208-104c16.3-8.1 26.5-24.8 26.5-42.9V129.3c0-20-12.4-37.9-31.1-44.9l-208-78C262 2.2 250 2.2 239.1 6.3zM256 68.4l192 72v1.1l-192 78-192-78v-1.1l192-72zm32 356V275.5l160-65v133.9l-160 80z">
					</path>
					</svg><!-- <i class="fas fa-cube fa-fw"></i> Font Awesome fontawesome.com -->{{$consumables->consumables_name}}</div>
					<img src="{{asset('upload/consumables/'.$consumables->image_file_extension)}}"
					width="100px">
				</th>
				{{-- 事業所を取り出す --}}
				@foreach($facility_all as $facility)
					{{-- 事業所ごとの在庫リストを取り出す --}}
					@foreach ($consumables_stock_all as $data)
					{{-- 在庫リストがある場合 --}}
							{{-- 消耗品コードと事業所名が一致する場合は表示 --}}
							@if ($consumables->consumables_code == $data->consumables_code and $facility->facility_name == $data->facility_name)
							<td data-office-code="{{$facility->office_code}}" data-consumables-code="{{$consumables->consumables_code}}"
								style="width:150px;height:100px;">
								<div id="stock" class="">
									<div class="row">
										<div class="col text-nowrap">
											{{optional($data)->stock_number}} {{optional($data)->number_unit}}<br>
												{{optional($data)->stock_quantity}}{{optional($data)->quantity_unit}}
										</div>
										<div class="col">
											<a class="dropdown-item" id="modal-buy" data-office-code="{{$facility->office_code}}" data-consumable-code="{{$consumables->consumables_code}}" data-bs-toggle="modal" data-bs-target="#modal-buy-{{$facility->office_code}}-{{$consumables->consumables_code}}">
											<svg class="svg-inline--fa fa-plus fa-w-14 fa-fw" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="plus" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" data-fa-i2svg="">
												<path fill="currentColor" d="M416 208H272V64c0-17.67-14.33-32-32-32h-32c-17.67 0-32 14.33-32 32v144H32c-17.67 0-32 14.33-32 32v32c0 17.67 14.33 32 32 32h144v144c0 17.67 14.33 32 32 32h32c17.67 0 32-14.33 32-32V304h144c17.67 0 32-14.33 32-32v-32c0-17.67-14.33-32-32-32z"></path>
											</svg><!-- <i class="fas fa-plus fa-fw"></i> Font Awesome fontawesome.com --> 
											仕入れ
											</a>
											@include('modal/stock_buy')
										</div>
									</div>
								<div class="progress mt-3">
									<div class="progress-bar bg-success" role="progressbar" style="width:%" aria-valuenow="39" aria-valuemin="0" aria-valuemax=""></div>
								</div>
								
								<div id="no-stock" class="w-100 h-100 d-flex align-items-center justify-content-center"></div>
							</td>
							{{-- 事業所名だけが一致する場合は表示 --}}
							@elseif (($consumables->consumables_code != $data->consumables_code and $facility->facility_name == $data->facility_name))
							@else
							<td data-office-code="{{$facility->office_code}}" data-consumables-code="{{$consumables->consumables_code}}"
								style="width:150px;height:100px;">
								<div id="stock" class="w-auto"><div class="row">
									<div class="col text-nowrap">
										在庫なし
									</div>
									<div class="col p-1">
											<a class="dropdown-item" id="modal-buy" data-office-code="{{$facility->office_code}}" data-consumable-code="{{$consumables->consumables_code}}" data-bs-toggle="modal" data-bs-target="#modal-buy-{{$facility->office_code}}-{{$consumables->consumables_code}}">
											<svg class="svg-inline--fa fa-plus fa-w-14 fa-fw" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="plus" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" data-fa-i2svg="">
												<path fill="currentColor" d="M416 208H272V64c0-17.67-14.33-32-32-32h-32c-17.67 0-32 14.33-32 32v144H32c-17.67 0-32 14.33-32 32v32c0 17.67 14.33 32 32 32h144v144c0 17.67 14.33 32 32 32h32c17.67 0 32-14.33 32-32V304h144c17.67 0 32-14.33 32-32v-32c0-17.67-14.33-32-32-32z"></path>
											</svg><!-- <i class="fas fa-plus fa-fw"></i> Font Awesome fontawesome.com --> 
											仕入れ
											</a>
											@include('modal/stock_buy')
										</div>
									</div>
								</div>
								<div class="progress mt-3">
									<div class="progress-bar bg-success" role="progressbar" style="width:%" aria-valuenow="39" aria-valuemin="0" aria-valuemax=""></div>
								</div>
								
								<div id="no-stock" class="w-100 h-100 d-flex align-items-center justify-content-center"></div>
							</td>
							@endif
					@endforeach
				@endforeach
			</tr>
			@endforeach
		</tbody>
	</table>
</div>
