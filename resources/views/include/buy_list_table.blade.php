<div id="富山" class="card mb-3" data-area="富山">
	<h6 class="card-header">富山</h6>
	<div class="card-body">
		<div class="row">
			<div class="col-3">
				<div class="input-group">
					<div class="input-group-prepend">
						<label class="input-group-text" for="office-code-to">納品先</label>
					</div>
					<select class="form-select" id="office-code-to">
						<option value="91">アシスト</option>
					</select>
				</div>
			</div>
			<div class="col-9">
				<button type="button" class="btn btn-primary" id="btn-ship" disabled="">
					<svg class="svg-inline--fa fa-truck fa-w-20 fa-fw" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="truck" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512" data-fa-i2svg=""><path fill="currentColor" d="M624 352h-16V243.9c0-12.7-5.1-24.9-14.1-33.9L494 110.1c-9-9-21.2-14.1-33.9-14.1H416V48c0-26.5-21.5-48-48-48H48C21.5 0 0 21.5 0 48v320c0 26.5 21.5 48 48 48h16c0 53 43 96 96 96s96-43 96-96h128c0 53 43 96 96 96s96-43 96-96h48c8.8 0 16-7.2 16-16v-32c0-8.8-7.2-16-16-16zM160 464c-26.5 0-48-21.5-48-48s21.5-48 48-48 48 21.5 48 48-21.5 48-48 48zm320 0c-26.5 0-48-21.5-48-48s21.5-48 48-48 48 21.5 48 48-21.5 48-48 48zm80-208H416V144h44.1l99.9 99.9V256z"></path></svg><!-- <i class="fas fa-truck fa-fw"></i> Font Awesome fontawesome.com -->選択した薬を出荷する
				</button>
			</div>
		</div>
		<div id="list" class="mt-3"><div class="row">
	{{-- <div class="col">1 件</div> --}}
</div>
<div class="modal_view" id="modal_view"></div>
<table class="table table-striped table-bordered" id="table">
	<thead>
		<tr class="table-scroll-fixed-top bg-white" style="">
			<th class="text-center table-w text-nowrap"></th>
			{{-- <th class="text-center table-w text-nowrap">消耗品バーコード</th> --}}
			<th class="text-center text-nowrap" style="width: 300px">消耗品</th>
			<th class="text-center table-w text-nowrap">入数/個数</th>
			<th class="text-center table-w text-nowrap">仕入数</th>
			<th class="text-center table-w text-nowrap">仕入日</th>
			<th class="text-center table-w text-nowrap">状態</th>
		</tr>
	</thead>
	<tbody id="buy-table">
		@foreach ($consumables_buy_all as $data)
			<tr data-code="{{$data->consumables_code}}">
				<td class="text-center table-w">
					<button type="button" class="btn btn-primary btn-sm" id="btn-info" data-code="511045" data-management-office-code="" data-carehome-office-code="">
						詳細
					</button>
				</td>
				<!-- <%* 消耗品コード *%> -->
				{{-- <td class="text-center table-w">
					<div class="mb-2">{{ $data->consumables_barcode }}</div>
					<div id="qrcode-{{ $data->buy_code }}-{{$data->consumables_barcode }}" data-bs-toggle="tooltip" data-bs-placement="top"
						title="右クリックで保存できます。"></div>
				</td> --}}
				<!-- <%* 消耗品名 *%> -->
				<td class="text-center">
					<div class="mb-2">{{ $data->consumables_name }}</div>
					<!-- <%* 画像 *%> -->
					@if(!empty( $data->image_file_extension))
					<div><img src="{{ asset('upload/consumables/'.$data->image_file_extension)}}"
							style="width:100px;height:100px;"></div>
					@endif
				</td>
				<!-- <%* 入数 / 単位 *%> -->
				<td class="text-center table-w">{{ $data->quantity }} {{ $data->quantity_unit }} / {{ $data->number_unit }}</td>
				<!-- <%* 仕入数量 *%> -->
				<td class="text-center table-w">{{ $data->buy_quantity }} {{ $data->number_unit }}</td>
				<!-- 仕入日 -->
				<td class="text-center table-w">{{ $data->created_at }}</td>
				<!-- 状態 -->
				<td class="text-center table-w"></td>
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