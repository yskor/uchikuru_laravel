<h6 class="mx-2">施設QRコード一覧</h6>
<div class="row mx-2">
	@foreach($facility_list as $data)
	<div class="col-auto pb-2 border">
		<div class="h-100">
			<div class="row mt-2">
				<div class="col" width="100px" height="100px" id="qrcode-{{$data->qr_code }}" data-bs-toggle="tooltip" data-bs-placement="top"
					title="右クリックで保存できます。">
				</div>
				</div>
				<!-- <%* 施設名 *%> -->
				<div class="mt-1 fw-bold text-center">{{ $data->facility_name }}</div>
		</div>
	</div>
	@endforeach
</div>