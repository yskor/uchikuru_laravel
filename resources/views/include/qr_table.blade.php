<h6 class="mx-2">QRコード一覧</h6>
<div class="row mx-2">
	@foreach($consumables_list as $data)
	<div class="col-auto pb-2 border">
		<div class="h-100">
			<div class="row mt-2">
				<div class="col" width="100px" height="100px" id="qrcode-{{$data->consumables_barcode }}" data-bs-toggle="tooltip" data-bs-placement="top"
					title="右クリックで保存できます。">
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
	@foreach($consumables_category_all as $category)
	@endforeach
</div>