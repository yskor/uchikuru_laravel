<div id="富山" class="card mb-3" data-area="富山">
	<h6 class="card-header">富山</h6>
	<div class="card-body">
		<div class="row">
			<div class="input-group">
				<div class="input-group-prepend">
					<label class="input-group-text" for="office-code-to">仕入先</label>
				</div>
				<select class="form-select" id="office-code-to">
					<option value="91">アシスト</option>
				</select>
			</div>
		</div>
		<div id="list" class="mt-3">
			<div class="row">
				{{-- <div class="col">1 件</div> --}}
			</div>
			<div class="modal_view" id="modal_view"></div>
			<table class="table table-striped" id="table">
				<thead>
					<tr class="table-scroll-fixed-top bg-white" style="">
						{{-- <th class="text-center table-w text-nowrap"></th> --}}
						{{-- <th class="text-center table-w text-nowrap">消耗品バーコード</th> --}}
						<th class="text-center text-nowrap" style="width: 300px">消耗品</th>
						<th class="text-center text-nowrap">カテゴリ</th>
						<th class="text-center text-nowrap">入数/個数</th>
						<th class="text-center text-nowrap">仕入数</th>
						<th class="text-center text-nowrap">仕入単価（税込）</th>
						<th class="text-center text-nowrap">仕入日時</th>
						{{-- <th class="text-center table-w text-nowrap">状態</th> --}}
					</tr>
				</thead>
				<tbody id="buy-table">
					@foreach ($consumables_buy_all as $data)
					<tr data-code="{{$data->consumables_code}}">
						{{-- <td class="text-center table-w">
							<button type="button" class="btn btn-primary btn-sm" id="btn-info" data-code="511045"
								data-management-office-code="" data-carehome-office-code="">
								詳細
							</button>
						</td> --}}
						<!-- <%* 消耗品コード *%> -->
						{{-- <td class="text-center table-w">
							<div class="mb-2">{{ $data->consumables_barcode }}</div>
							<div id="qrcode-{{ $data->buy_code }}-{{$data->consumables_barcode }}"
								data-bs-toggle="tooltip" data-bs-placement="top" title="右クリックで保存できます。"></div>
						</td> --}}
						<!-- <%* 消耗品名 *%> -->
						<td class="text-center" style="max-width: 300px">
							<div class="mb-2" style="max-width: 300px">{{ $data->consumables_name }}</div>
							<!-- <%* 画像 *%> -->
							@if(!empty( $data->image_file_extension))
							<div style="max-width: 300px"><img
									src="{{ asset('upload/consumables/'.$data->image_file_extension)}}"
									style="width:100px;height:100px;"></div>
							@endif
						</td>
						<!-- <%* カテゴリ *%> -->
						<td class="text-center">{{ $data->consumables_category_name }}</td>
						<!-- <%* 入数 / 単位 *%> -->
						<td class="text-center">{{ $data->quantity }} {{ $data->quantity_unit }} / {{ $data->number_unit
							}}</td>
						<!-- <%* 仕入数量 *%> -->
						<td class="text-center">{{ $data->buy_quantity }} {{ $data->number_unit }}</td>
						<!-- <%* 仕入単価 *%> -->
						<td class="text-center">{{ $data->buy_price }} 円</td>
						<!-- 仕入日 -->
						<td class="text-center">{{ $data->created_at }}</td>
						<!-- 状態 -->
						<td class="text-center"></td>
					</tr>
					@endforeach
				</tbody>
			</table>

			<script>
				$(function() {

	var table = $( "#富山" ).find( "#table" );

	table.find( "button" ).on( "click", function() {
		var id = $(this).attr( "id" );
		if( id == "btn" ) {
			table.trigger( "click-btn", [ $(this).data( "user-code" ), $(this).data( "medicine-date" ) ] );
		} else if( id == "btn-delete" ) {
			table.trigger( "click-btn-delete", [ $(this).data( "user-code" ), $(this).data( "medicine-date" ) ] );
		}
	});
	
		table.find( "input[type='checkbox']" ).change( function() {
		if( $(this).attr( "id" ) == "check-all" ) {
			table.find( "input[type='checkbox']" ).each( function( index, element ) {
				if( $(element).attr( "id" ) == "check-ship" && $(element).prop( "hidden" ) == false ) {
					$(element).prop( "checked", table.find( "#check-all" ).prop( "checked" ) );
				}
			});
		}
	});
	
	
});
			</script>

		</div>
	</div>
</div>