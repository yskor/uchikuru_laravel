<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#stockModal_{{$data->consumables_code}}">
	納品する
</button>

<!-- Modal -->
<div class="modal fade" id="stockModal_{{$data->consumables_code}}" tabindex="-1" aria-labelledby="stockModal_{{$data->consumables_code}}Label" aria-hidden="true">
	<div class="modal-dialog">
		<form class="" action="{{route('deliver_consumables')}}" method="post">
			@csrf
			<div id="confirm-{{$data->consumables_code}}" class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="stockModal_{{$data->consumables_code}}Label">納品数の確認</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
					<h5 class="card-title">{{$data->consumables_name}}</h5>
					<div class="d-flex justify-content-center">
						<img class="my-3" id="add_preview" src="{{ asset('upload/consumables/'.$data->image_file_extension)}}"
								style="width:200px;height:200px;">
					</div>
					<div class="w-100">
						{{-- データ受け渡し用 --}}
						<input type="hidden" name="office_code_to" value="{{$office_code}}">
						<input type="hidden" name="ship_code" value="{{$data->consumables_code}}">
						<input type="hidden" name="consumables_code" value="{{$data->consumables_code}}">
						<input type="hidden" name="consumables_category_code" value="{{$consumables_category_code}}">
						{{-- 現施設在庫数の入力 --}}
						<div class="input-group mb-2" style="width:220px;">
							<span class="input-group-text" style="width: 112;">施設在庫数</span>
							@if (isset($data->f_stock_number))
								<input type="number" class="form-control text-center" id="stock-number-{{$data->consumables_code}}" name="stock_number"
							value="{{$data->f_stock_number}}">
							@else
							<input type="" class="form-control text-center" id="stock-number-{{$data->consumables_code}}" name="stock_number" value="0">
							@endif
							<span class="input-group-text" id="stock-number-{{$data->consumables_code}}">
								@if($data->quantity == 1) 個 @else 箱 @endif
							</span>
						</div>
						@if($data->quantity != 1)
						<p>在庫数内訳：{{$data->f_stock_number}}箱（{{$data->f_stock_number * $data->quantity}}個）</p>
						@endif
						<div class="d-flex mb-2 justify-content-end">
							<p class="form-check-label mx-3" for="stock-check-{{$data->consumables_code}}">在庫数の確認<span class="badge bg-danger">必須</span></p>
							<div class="form-check form-switch">
								<input class="form-check-input" type="checkbox" id="stock-check-{{$data->consumables_code}}" style="transform: scale(1.5);">
							</div>
						</div>
						<div class="input-group mb-2"style="width:220px;">
							{{-- <label for="deliver-number">納品数：</label> --}}
							<span class="input-group-text" style="width: 112;">納品数</span>
							<input type="number" class="form-control text-center" id="deliver-number-{{$data->consumables_code}}" name="deliver_number">
							<span class="input-group-text" id="unit">
								@if($data->quantity == 1) 個 @else 箱 @endif
							</span>
						</div>
						@if($data->quantity != 1)
						<div id="deliver-number-{{$data->consumables_code}}-result">
                            <p>納品数内訳：</p>
                        </div>
                        <script>
                            $(function() {
                                //テキストボックスに変更を加えたら発動
                                $('input#deliver-number-{{$data->consumables_code}}').change(function() {
                                    //入力したvalue値を変数に格納
                                    var val = $(this).val();
                                    var quantity = '{{$data->quantity}}';
                                    var html = `<p>納品数内訳：${val}箱（${val * quantity}個）</p>`
                                    console.log(val);
                                    console.log(quantity);
                                    // var quantity = $(this).parent().parent().find("input#deliver-number-{{$data->consumables_code}}").val();
            
                                    //選択したvalue値をp要素に出力
                                    $('#deliver-number-{{$data->consumables_code}}-result').html(html);
                                });
                            });
                        </script>
						@endif
						<div class="d-flex justify-content-end">
							<p class="form-check-label mx-3" for="deliver-check-{{$data->consumables_code}}">納品数の確認<span class="badge bg-danger">必須</span></p>
							<div class="form-check form-switch">
								<input class="form-check-input" type="checkbox" id="deliver-check-{{$data->consumables_code}}" disabled style="transform: scale(1.5);">
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">閉じる</button>
					<button type="submit" class="btn btn-primary" id="btn-deliver-{{$data->consumables_code}}"
						data-id="{{$data->consumables_code}}" disabled>納品</button>
				</div>
				<script>
					$(function() {
						
						var parent = $( "#confirm-{{$data->consumables_code}}" );
						var stock_number = parent.find( "#stock-number-{{$data->consumables_code}}" );
						var miss_stock_number = parent.find( "#miss-stock-number-{{$data->consumables_code}}" );
						var deliver_number = parent.find( "#deliver-number-{{$data->consumables_code}}" );
						var miss_deliver_number = parent.find( "#miss-deliver-number-{{$data->consumables_code}}" );
						var stock_check = parent.find( "#stock-check-{{$data->consumables_code}}" );
						var deliver_check = parent.find( "#deliver-check-{{$data->consumables_code}}" );
						var deliver_do_btn = parent.find( "#btn-deliver-{{$data->consumables_code}}" );
						var confirm = 0
						
						// parent.find( "#stock-btn-yes" ).on( "click", function(){
						// 	stock_check.prop( "value", true );
						// 	stock_number.prop( "disabled", false );
						// 	confirm += 1
						// 	if (confirm == 2) {
						// 		deliver_do_btn.prop("disabled", false)
						// 		confirm = 0
						// 	};
						// });

						stock_check.change(function(){
							console.log('stock_number_chenge')
							console.log(stock_check)
							if ( $(this).is(':checked') )
								deliver_check.prop('disabled',false);
							else
								deliver_check.prop('disabled',true);
						});

						deliver_check.change(function(){
							console.log('dliver_number_chenge')
							console.log(deliver_do_btn)
							if ( $(this).is(':checked') && stock_check.is(':checked') )
								deliver_do_btn.prop("disabled", false);
							else
								deliver_do_btn.prop("disabled", true);
						});
					});
				</script>
			</div>
		</form>
	</div>
</div>