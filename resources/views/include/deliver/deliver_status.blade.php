<div class="row">
	@foreach ($consumables_all as $data)
	<div class="card m-1 p-0" id="add_ship_{{$data->consumables_code}}" style="width:350px;">
		<div class="card-header d-flex" style="background-color: rgba(0,0,0,.03)">
			<h5 class="w-100" id="ship_consumables_name">{{$data->consumables_name}}</h5>
		</div>
		<div class="card-body d-flex">
			<div class="">
				<img src="{{ asset('upload/consumables/'.$data->image_file_extension)}}" style="width:100px;height:100px;">
			</div>
			<div class="w-100 px-2 d-flex align-items-end justify-content-end">
				<a class="btn btn-primary stretched-link" href="{{route('week_deliver_status', ['consumables_category_code' => $data->consumables_category_code,'consumables_code' => $data->consumables_code])}}">
					<svg class="svg-inline--fa fa-truck fa-w-20 text-white menu-icon-size fa-fw" style="font-size: 16px"
						aria-hidden="true" focusable="false" data-prefix="fas" data-icon="truck" role="img"
						xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512" data-fa-i2svg="">
						<path fill="currentColor"
							d="M624 352h-16V243.9c0-12.7-5.1-24.9-14.1-33.9L494 110.1c-9-9-21.2-14.1-33.9-14.1H416V48c0-26.5-21.5-48-48-48H48C21.5 0 0 21.5 0 48v320c0 26.5 21.5 48 48 48h16c0 53 43 96 96 96s96-43 96-96h128c0 53 43 96 96 96s96-43 96-96h48c8.8 0 16-7.2 16-16v-32c0-8.8-7.2-16-16-16zM160 464c-26.5 0-48-21.5-48-48s21.5-48 48-48 48 21.5 48 48-21.5 48-48 48zm320 0c-26.5 0-48-21.5-48-48s21.5-48 48-48 48 21.5 48 48-21.5 48-48 48zm80-208H416V144h44.1l99.9 99.9V256z">
						</path>
					</svg>
					出荷状況
				</a>
			</div>
		</div>
	</div>
	@endforeach
</div>