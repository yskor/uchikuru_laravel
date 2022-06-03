@if($login->office_code == 91)
<div class="alert alert-danger">
	<h5>権限エラー:</h5>アシスト職員は消耗品を持ち出しできません
</div>
@else
@if (session('error_message'))
<div class="alert alert-danger">
	{{ session('error_message') }}
</div>
@else
<div class="card">
	<form class="" action="{{route('consumption_done')}}" method="post">
		@csrf
		<div id="confirm" class="card-content bg-dark">
			<div class="card-header">
				<h5 class="card-title" id="">持ち出す数量の確認</h5>
			</div>
			<div class="card-body">
				<h5 class="card-title">{{$consumables->consumables_name}}</h5>
				<div class="d-flex">
					<div>
						<img class="mb-2" id="add_preview"
							src="{{ asset('upload/consumables/'.$consumables->image_file_extension)}}"
							style="width:100px;height:100px;">
					</div>
					<div class="w-100 px-3">
						{{-- データ受け渡し用 --}}
						<input type="hidden" name="consumables_code" value="{{$consumables->consumables_code}}">
						{{-- 現施設在庫数の入力 --}}
						<div class="input-group mb-1" style="width:200px;">
							<span class="input-group-text" style="width: 100;">数量</span>
							<input type="number" class="form-control text-center" id="consumption-number"
								name="consumption_number" value="{{$consumables->use_quantity}}" disabled>
							<span class="input-group-text" id="consumption-number">{{$consumables->use_unit}}</span>
						</div>
						{{-- <div class="form-check form-switch">
							<input class="form-check-input" type="checkbox" id="consumption-check">
							<label class="form-check-label" for="consumption-check">使用数量の確認<span
									class="badge bg-danger">必須</span></label>
						</div> --}}
					</div>
				</div>
			</div>
			<div class="card-footer d-flex justify-content-end">
				{{-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">閉じる</button> --}}
				<button type="submit" class="btn btn-primary" id="btn-consumption">持ち出す</button>
			</div>
			{{-- <script>
				$(function() {
						
						var parent = $( "#confirm" );
						var consumption_number = parent.find( "#consumption-number" );
						var consumption_check = parent.find( "#consumption-check" );
						var consumption_do_btn = parent.find( "#btn-consumption" );
						
						consumption_check.change(function(){
							if ( $(this).is(':checked') )
								consumption_do_btn.prop("disabled", false);
							else
								consumption_do_btn.prop("disabled", true);
						});

					});
			</script> --}}
		</div>
	</form>
</div>
@endif
@endif