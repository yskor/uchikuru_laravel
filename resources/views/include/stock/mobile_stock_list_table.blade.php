<div class="row g-2">
	@foreach ($consumables_stock_list as $data)
	<div class="col-6 card p-0 mx-1" style="width:400px;">
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
			<div class="w-100 px-2">
				{{-- 消費数量 --}}
				<table>
					<tr>
						<th>
							<svg class="svg-inline--fa fa-building fa-w-14 fa-fw" aria-hidden="true" focusable="false"
								data-prefix="fas" data-icon="building" role="img" xmlns="http://www.w3.org/2000/svg"
								viewBox="0 0 448 512" data-fa-i2svg="">
								<path fill="currentColor"
									d="M436 480h-20V24c0-13.255-10.745-24-24-24H56C42.745 0 32 10.745 32 24v456H12c-6.627 0-12 5.373-12 12v20h448v-20c0-6.627-5.373-12-12-12zM128 76c0-6.627 5.373-12 12-12h40c6.627 0 12 5.373 12 12v40c0 6.627-5.373 12-12 12h-40c-6.627 0-12-5.373-12-12V76zm0 96c0-6.627 5.373-12 12-12h40c6.627 0 12 5.373 12 12v40c0 6.627-5.373 12-12 12h-40c-6.627 0-12-5.373-12-12v-40zm52 148h-40c-6.627 0-12-5.373-12-12v-40c0-6.627 5.373-12 12-12h40c6.627 0 12 5.373 12 12v40c0 6.627-5.373 12-12 12zm76 160h-64v-84c0-6.627 5.373-12 12-12h40c6.627 0 12 5.373 12 12v84zm64-172c0 6.627-5.373 12-12 12h-40c-6.627 0-12-5.373-12-12v-40c0-6.627 5.373-12 12-12h40c6.627 0 12 5.373 12 12v40zm0-96c0 6.627-5.373 12-12 12h-40c-6.627 0-12-5.373-12-12v-40c0-6.627 5.373-12 12-12h40c6.627 0 12 5.373 12 12v40zm0-96c0 6.627-5.373 12-12 12h-40c-6.627 0-12-5.373-12-12V76c0-6.627 5.373-12 12-12h40c6.627 0 12 5.373 12 12v40z">
								</path>
							</svg>
							本部：
						</th>
						<td>
							@if ($data->stock_number)
							{{ $data->stock_number }}
							@else
							0
							@endif
							箱
							@if($data->use_unit_code == 'Q')
							{{-- 消費単位が個数の時 --}}
							+
							@if ($data->stock_quantity)
							{{ $data->stock_quantity }}
							@else
							0
							@endif
							個
							@endif
						</td>
					</tr>
					<tr>
						<th>
							<svg class="svg-inline--fa fa-home fa-w-18 fa-fw" aria-hidden="true" focusable="false"
								data-prefix="fas" data-icon="home" role="img" xmlns="http://www.w3.org/2000/svg"
								viewBox="0 0 576 512" data-fa-i2svg="">
								<path fill="currentColor"
									d="M280.37 148.26L96 300.11V464a16 16 0 0 0 16 16l112.06-.29a16 16 0 0 0 15.92-16V368a16 16 0 0 1 16-16h64a16 16 0 0 1 16 16v95.64a16 16 0 0 0 16 16.05L464 480a16 16 0 0 0 16-16V300L295.67 148.26a12.19 12.19 0 0 0-15.3 0zM571.6 251.47L488 182.56V44.05a12 12 0 0 0-12-12h-56a12 12 0 0 0-12 12v72.61L318.47 43a48 48 0 0 0-61 0L4.34 251.47a12 12 0 0 0-1.6 16.9l25.5 31A12 12 0 0 0 45.15 301l235.22-193.74a12.19 12.19 0 0 1 15.3 0L530.9 301a12 12 0 0 0 16.9-1.6l25.5-31a12 12 0 0 0-1.7-16.93z">
								</path>
							</svg>
							{{$office_data->facility_name}}：
						</th>
						<td>
							@if ($data->f_stock_number)
							{{ $data->f_stock_number }}
							@else
							0
							@endif
							箱
							@if($data->use_unit_code == 'Q')
							{{-- 消費単位が個数の時 --}}
							+
							@if ($data->f_stock_quantity)
							{{ $data->f_stock_quantity }}
							@else
							0
							@endif
							個
							@endif
						</td>
					</tr>
					<tr>
						<th>消費数量：</th>
						<td>{{ $data->use_quantity }}{{ $data->use_unit }}/回</td>
					</tr>
				</table>
			</div>
		</div>
	</div>

	@endforeach
</div>