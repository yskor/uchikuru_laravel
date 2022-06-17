<h6 class="mx-2">QRコード一覧</h6>
<script type="text/javascript" src="{{url('js/jquery.qrcode.min.js')}}"></script>
<script>
		$(function() {
		
		@foreach($consumables_list as $data)
		jQuery( '#qrcode-{{ $data->consumables_barcode }}-all' ).qrcode( {
			width: 100,
			height: 100,
			text: "{{ $data->consumables_barcode }}",
			});
		@endforeach
		
		@foreach($consumables_list as $data)
		jQuery( '#qrcode-{{ $data->consumables_barcode }}' ).qrcode( {
			width: 100,
			height: 100,
			text: "{{ $data->consumables_barcode }}",
			});
		@endforeach
	});

</script>

<ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
	<li class="nav-item" role="presentation">
		<button class="nav-link active" id="pills-all-tab" data-bs-toggle="pill" data-bs-target="#pills-all"
			type="button" role="tab" aria-controls="pills-all" aria-selected="true">
			全て
		</button>
	</li>
	@foreach($consumables_category_list as $data)
		@if($data->consumables_category_code == 1)
		<li class="nav-item" role="presentation">
			<button class="nav-link" id="pills-{{$data->consumables_category_name}}-tab" data-bs-toggle="pill" data-bs-target="#pills-{{$data->consumables_category_name}}"
				type="button" role="tab" aria-controls="pills-{{$data->consumables_category_name}}" aria-selected="true">
				{{$data->consumables_category_name}}
			</button>
		</li>
		@else
		<li class="nav-item" role="presentation">
			<button class="nav-link" id="pills-{{$data->consumables_category_name}}-tab" data-bs-toggle="pill" data-bs-target="#pills-{{$data->consumables_category_name}}"
				type="button" role="tab" aria-controls="pills-{{$data->consumables_category_name}}" aria-selected="false">
				{{ $data->consumables_category_name }}
			</button>
		</li>
		@endif
	@endforeach
</ul>
<div class="tab-content" id="pills-tabContent">
	{{-- 全て --}}
	<div class="tab-pane fade show active" id="pills-all" role="tabpanel" aria-labelledby="pills-all-tab">
		@foreach($qr_list as $key => $value)
		<h6 class="p-2 mt-2 mb-0 bg-light">{{$key}}</h6>
		<div class="row mx-2">
			@foreach($value as $data)
			<div class="col-auto pb-2 border">
				<div class="h-100">
					<div class="row mt-2">
						<div class="col" width="100px" height="100px" id="qrcode-{{$data->consumables_barcode }}-all"
							data-bs-toggle="tooltip" data-bs-placement="top" title="右クリックで保存できます。">
						</div>
						<!-- <%* 画像 *%> -->
						<div class="col"><img src="{{ asset('upload/consumables/'.$data->image_file_extension)}}"
								style="width:100px;height:100px;"></div>
					</div>
					<!-- <%* 消耗品名 *%> -->
					<div class="mt-1 fw-bold text-center" style="width: 224px">{{ $data->consumables_name }}</div>
				</div>
			</div>
			@endforeach
		</div>
		@endforeach
	</div>

	{{-- カテゴリごと --}}
	@foreach($qr_list as $consumables_name => $datas)
		@if($consumables_name == '衛生用品')
		<div class="tab-pane fade" id="pills-{{$consumables_name}}" role="tabpanel" aria-labelledby="pills-{{$consumables_name}}-tab">
			<div class="row mx-2">
				@foreach($datas as $data)
				<div class="col-auto pb-2 border">
					<div class="h-100">
						<div class="row mt-2">
							<div class="col" width="100px" height="100px" id="qrcode-{{$data->consumables_barcode }}"
								data-bs-toggle="tooltip" data-bs-placement="top" title="右クリックで保存できます。">
							</div>
							<!-- <%* 画像 *%> -->
							<div class="col"><img src="{{ asset('upload/consumables/'.$data->image_file_extension)}}"
									style="width:100px;height:100px;"></div>
						</div>
						<!-- <%* 消耗品名 *%> -->
						<div class="mt-1 fw-bold text-center" style="width: 224px">{{ $data->consumables_name }}</div>
					</div>
				</div>
				@endforeach
			</div>
		</div>
		@else
		<div class="tab-pane fade" id="pills-{{$consumables_name}}" role="tabpanel" aria-labelledby="pills-{{$consumables_name}}-tab">
			<div class="row mx-2">
				@foreach($datas as $data)
				<div class="col-auto pb-2 border">
					<div class="h-100">
						<div class="row mt-2">
							<div class="col" width="100px" height="100px" id="qrcode-{{$data->consumables_barcode }}"
								data-bs-toggle="tooltip" data-bs-placement="top" title="右クリックで保存できます。">
							</div>
							<!-- <%* 画像 *%> -->
							<div class="col"><img src="{{ asset('upload/consumables/'.$data->image_file_extension)}}"
									style="width:100px;height:100px;"></div>
						</div>
						<!-- <%* 消耗品名 *%> -->
						<div class="mt-1 fw-bold text-center" style="width: 224px">{{ $data->consumables_name }}</div>
					</div>
				</div>
				@endforeach
			</div>
		</div>
		@endif
	@endforeach

</div>