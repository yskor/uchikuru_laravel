@if (isset($deliver_consumables_list[0]))
		<div class="row gy-2">
		@foreach ($deliver_consumables_list as $data)
			<div class="card px-0 mx-2" style="max-width: 450px;">
				<div class="card-header">
					{{ $data->consumables_name }}
				</div>
				<div class="card-body p-0">
					<div class="d-flex">
						<div class="" width="100px">
							<img src="{{ asset('upload/consumables/'.$data->image_file_extension)}}">
						</div>
						<form action="{{route('deliver_list')}}" method="post">
							@csrf
							<div class="p-1" id="confirm-{{$data->ship_code}}">
								{{-- <p class="card-text">現施設在庫数：{{ $data->stock_number }}{{
									$data->number_unit }}</p> --}}
								<input type="hidden" name="office_code" value="{{$office_code}}">
								<input type="hidden" name="ship_code" value="{{$data->ship_code}}">
								<input type="hidden" name="consumables_code" value="{{$data->consumables_code}}">
								<div class="form-group" id="deliver-number-form-group">
									<label for="stock-number">現施設在庫数<span class="badge bg-danger">必須</span>：</label>
									{{-- 現施設在庫数の入力 --}}
									@if (isset($data->stock_number))
										{{-- 違う場合 --}}
										<input type="number" id="miss-stock-number-{{$data->ship_code}}" name="stock_number" value="{{$data->stock_number}}" disabled="" style="width:50px;">
										{{-- 正しい場合 --}}
										<input type="hidden" id="stock-number-{{$data->ship_code}}" name="stock_number" value="{{$data->stock_number}}" disabled="" style="width:50px;">
										<span class="" id="">{{$data->number_unit}}</span>
									@else
										{{-- 違う場合 --}}
										<input type="number" id="miss-stock-number-{{$data->ship_code}}" name="stock_number" value="0" disabled="" style="width:50px;">
										{{-- 正しい場合 --}}
										<input type="hidden" id="stock-number-{{$data->ship_code}}" name="stock_number" value="0" disabled="" style="width:50px;">
										<span class="" id="">{{$data->number_unit}}</span>
									@endif
								</div>
								<div id="stock-question-{{$data->ship_code}}" class="mb-2">
									<p class="mb-0">上記の現施設在庫数は一致しますか？</p>
									<button type="button" class="btn btn-primary btn-sm" id="stock-btn-yes">はい</button>
									<button type="button" class="btn btn-danger btn-sm" id="stock-btn-no">いいえ</button>
								</div>
								{{-- <p class="card-text">納品数：{{ $data->shipped_number }}{{ $data->number_unit }}</p> --}}
								<label for="deliver-number">納品数<span class="badge bg-danger">必須</span>：</label>
								{{-- 納品数の入力 --}}
								{{-- 違った場合 --}}
								<input type="number" id="miss-deliver-number-{{$data->ship_code}}" name="deliver_number" value="{{$data->shipped_number}}" disabled="" style="width:50px;">
								{{-- 正しい場合 --}}
								<input type="hidden" id="deliver-number-{{$data->ship_code}}" name="deliver_number" value="{{$data->shipped_number}}" disabled="" style="width:50px;">
								<span class="" id="">{{$data->number_unit}}</span>
								<div id="deliver-question-{{$data->ship_code}}" class="mb-2">
									<p class="mb-0">上記の納品数は一致しますか？</p>
									<button type="button" class="btn btn-primary btn-sm" id="deliver-btn-yes">はい</button>
									<button type="button" class="btn btn-danger btn-sm" id="deliver-btn-no">いいえ</button>
								</div>
								<div class="ml-auto">
									<button type="submit" class="btn btn-primary" id="btn-deliver-{{$data->ship_code}}" data-id="{{ $data->ship_code }}" disabled>納品</button>
								</div>
								{{-- <div>{{$office_code}}</div>
								<div>{{$data->ship_code}}</div>
								<div>{{$data->consumables_code}}</div>
								<div>{{$data->shipped_number}}</div>
								<div>{{$data->stock_number}}</div> --}}
								<script>
									$(function() {
										
										var parent = $( "#confirm-{{$data->ship_code}}" );
										var stock_number = parent.find( "#stock-number-{{$data->ship_code}}" );
										var miss_stock_number = parent.find( "#miss-stock-number-{{$data->ship_code}}" );
										var deliver_number = parent.find( "#deliver-number-{{$data->ship_code}}" );
										var miss_deliver_number = parent.find( "#miss-deliver-number-{{$data->ship_code}}" );
										var stock_question = parent.find( "#stock-question-{{$data->ship_code}}" );
										var deliver_question = parent.find( "#deliver-question-{{$data->ship_code}}" );
										var deliver_do_btn = parent.find( "#btn-deliver-{{$data->ship_code}}" );
										var confirm = 0
										
										parent.find( "#stock-btn-yes" ).on( "click", function(){
											stock_question.prop( "hidden", true );
											stock_number.prop( "disabled", false );
											confirm += 1
											if (confirm == 2) {
												deliver_do_btn.prop("disabled", false)
												confirm = 0
											};
										});
									
										parent.find( "#stock-btn-no" ).on( "click", function(){
											miss_stock_number.prop( "disabled", false );
											stock_question.prop( "hidden", true );
											confirm += 1
											if (confirm == 2) {
												deliver_do_btn.prop("disabled", false)
												confirm = 0
											};
										});
		
										parent.find( "#deliver-btn-yes" ).on( "click", function(){
											deliver_number.prop( "disabled", false );
											deliver_question.prop( "hidden", true );
											parent.trigger( "click-btn-yes" );
											confirm += 1
											if (confirm == 2) {
												deliver_do_btn.prop("disabled", false)
												confirm = 0
											};
										});
									
										parent.find( "#deliver-btn-no" ).on( "click", function(){
											miss_deliver_number.prop( "disabled", false );
											deliver_question.prop( "hidden", true );
											parent.trigger( "click-btn-no" );
											confirm += 1
											if (confirm == 2) {
												deliver_do_btn.prop("disabled", false)
												confirm = 0
											};
										});

										
									});
								</script>
							</div>
						</form>
					</div>
				</div>
			</div>
	
		@endforeach
		</div>
@else
{{-- 出荷予定の消耗品がない場合 --}}
	<div class="alert alert-dark" role="alert">
		<h4 class="">現在未納となっている消耗品はありません</h4>
	</div>
@endif

