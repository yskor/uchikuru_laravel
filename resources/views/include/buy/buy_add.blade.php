{{-- <form id="add-form" action="{{route('buy_list',['consumables_category_code' => $consumables_category_code])}}"
	method="POST" enctype="multipart/form-data"> --}}
	<form id="add-form" action="{{route('buy_list'). "/". $consumables_category_code}}" method="POST"
		enctype="multipart/form-data">
		@csrf
		<div class="card mb-3">
			<div class="card-header">
				<h5 class="card-title" id="card-title">読み取った消耗品</h5>
			</div>
			<div class="card-body">
				<div class="input-group mb-2" id="buy-office-form-group">
					<label class="input-group-text" for="office_code_to">仕入先</label>
					<select class="form-select" id="office_code_to" name="office_code_to">
						@foreach($buy_facility_all as $data)
							@if($data->office_code == 91)
							<option value="{{$data->office_code}}" selected>{{$data->facility_name}}</option>
							@else
							<option value="{{$data->office_code}}">{{$data->facility_name}}</option>
							@endif
						@endforeach
					</select>
				</div>
				<div class="row" id="buys">
					@include("include/buy/buy_consumables", ['consumables_buy_data' => $consumables_buy_data])
				</div>
			</div>

			<div class="card-footer">
				<button type="button" class="btn btn-danger" id="btn-cancel" data-bs-dismiss="modal">取り消す</button>
				<button type="submit" class="btn btn-primary" id="btn-do">仕入れる</button>
			</div>
		</div>
	</form>
	<script>
		$( function() {
		var parent = $( "#add-form" );
		var cancel = parent.find( "#btn-cancel" );
		
		cancel.on( "click", function() {
			parent.remove();
			location.reload(); // リロード
		});
		
	});
	</script>