<div id="list table-responsive">
	<table class="table table-striped" id="table" style="position: relative;">
		<thead>
			<tr class="table-scroll-fixed-top bg-white" style="">
				{{-- <th class="text-center table-w text-nowrap"></th> --}}
				{{-- <th class="text-center table-w text-nowrap">消耗品バーコード</th> --}}
				<th class="text-center text-nowrap" style="width: 300px">消耗品</th>
				<th class="text-center text-nowrap">カテゴリ</th>
				<th class="text-center text-nowrap">入数/単位</th>
				<th class="text-center text-nowrap"><svg class="svg-inline--fa fa-building fa-w-14 fa-fw" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="building" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" data-fa-i2svg=""><path fill="currentColor" d="M436 480h-20V24c0-13.255-10.745-24-24-24H56C42.745 0 32 10.745 32 24v456H12c-6.627 0-12 5.373-12 12v20h448v-20c0-6.627-5.373-12-12-12zM128 76c0-6.627 5.373-12 12-12h40c6.627 0 12 5.373 12 12v40c0 6.627-5.373 12-12 12h-40c-6.627 0-12-5.373-12-12V76zm0 96c0-6.627 5.373-12 12-12h40c6.627 0 12 5.373 12 12v40c0 6.627-5.373 12-12 12h-40c-6.627 0-12-5.373-12-12v-40zm52 148h-40c-6.627 0-12-5.373-12-12v-40c0-6.627 5.373-12 12-12h40c6.627 0 12 5.373 12 12v40c0 6.627-5.373 12-12 12zm76 160h-64v-84c0-6.627 5.373-12 12-12h40c6.627 0 12 5.373 12 12v84zm64-172c0 6.627-5.373 12-12 12h-40c-6.627 0-12-5.373-12-12v-40c0-6.627 5.373-12 12-12h40c6.627 0 12 5.373 12 12v40zm0-96c0 6.627-5.373 12-12 12h-40c-6.627 0-12-5.373-12-12v-40c0-6.627 5.373-12 12-12h40c6.627 0 12 5.373 12 12v40zm0-96c0 6.627-5.373 12-12 12h-40c-6.627 0-12-5.373-12-12V76c0-6.627 5.373-12 12-12h40c6.627 0 12 5.373 12 12v40z"></path></svg><!-- <i class="fas fa-building fa-fw"></i> Font Awesome fontawesome.com -->本部</th>
				<th class="text-center text-nowrap"><svg class="svg-inline--fa fa-home fa-w-18 fa-fw" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="home" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" data-fa-i2svg=""><path fill="currentColor" d="M280.37 148.26L96 300.11V464a16 16 0 0 0 16 16l112.06-.29a16 16 0 0 0 15.92-16V368a16 16 0 0 1 16-16h64a16 16 0 0 1 16 16v95.64a16 16 0 0 0 16 16.05L464 480a16 16 0 0 0 16-16V300L295.67 148.26a12.19 12.19 0 0 0-15.3 0zM571.6 251.47L488 182.56V44.05a12 12 0 0 0-12-12h-56a12 12 0 0 0-12 12v72.61L318.47 43a48 48 0 0 0-61 0L4.34 251.47a12 12 0 0 0-1.6 16.9l25.5 31A12 12 0 0 0 45.15 301l235.22-193.74a12.19 12.19 0 0 1 15.3 0L530.9 301a12 12 0 0 0 16.9-1.6l25.5-31a12 12 0 0 0-1.7-16.93z"></path></svg><!-- <i class="fas fa-home fa-fw"></i> Font Awesome fontawesome.com -->施設</th>
			</tr>
		</thead>
		<tbody>
			@foreach ($consumables_stock_list as $data)
				{{-- @if ($data->consumables_category_code == 1) --}}
					<tr data-code="{{ $data->consumables_code }}">
						{{-- <td class="text-center table-w">
							<button type="button" class="btn btn-primary btn-sm" id="btn-info" data-code="{{ $data->consumables_code }}" data-management-office-code="" data-carehome-office-code="">
								詳細
							</button>
						</td> --}}
						<!-- <%* 消耗品コード *%> -->
						{{-- <td class="text-center table-w">
							<div class="mb-2">{{ $data->consumables_barcode }}</div>
							<div id="qrcode-{{$data->consumables_barcode }}" data-bs-toggle="tooltip" data-bs-placement="top"
								title="右クリックで保存できます。"></div>
						</td> --}}
						<!-- <%* 消耗品名 *%> -->
						<td class="text-center" style="max-width: 300px">
							<div class="mb-2" style="max-width: 300px">{{ $data->consumables_name }}</div>
							<!-- <%* 画像 *%> -->
							@if(!empty( $data->image_file_extension))
							<div style="max-width: 300px"><img src="{{ asset('upload/consumables/'.$data->image_file_extension)}}"
									style="width:100px;height:100px;"></div>
							@endif
						</td>
						<!-- <%* 入数 / 単位 *%> -->
						<td class="text-center">{{ $data->consumables_category_name }}</td>
						<!-- <%* 入数 / 単位 *%> -->
						<td class="text-center">{{ $data->quantity }} {{ $data->quantity_unit }} / {{ $data->number_unit }}</td>
						<!-- <%* 本部在庫 *%> -->
						<td class="text-center">
							{{-- @if ($data->stock_quantity)
							{{ $data->stock_quantity }}
							@else
							0
							@endif
							{{ $data->quantity_unit }}<br> --}}
							@if ($data->stock_number)
							{{ $data->stock_number }}
							@else
							0
							@endif
							{{ $data->number_unit }}
						</td>
						<!-- <%* 施設在庫 *%> -->
						<td class="text-center">
							{{-- @if ($data->f_stock_quantity)
							{{ $data->f_stock_quantity }}
							@else
							0
							@endif
							{{ $data->quantity_unit }}<br> --}}
							@if ($data->f_stock_number)
							{{ $data->f_stock_number }}
							@else
							0
							@endif
							{{ $data->number_unit }}
						</td>
					</tr>
				{{-- @endif --}}
			@endforeach
		</tbody>
	</table>

<script>

$(function() {

// 	var parent = $( "#list" );
	
// 	parent.find( "button" ).on( "click", function() {
// 		if( $(this).attr( "id" ) == "btn-info" ) {
// 			var code = $(this).data( "code" );
			
// 			/*
// 			parent.find( "tbody" ).find( "tr" ).removeClass( "bg-info text-white" );
// 			//parent.find( "tbody" ).find( "tr" ).find( "button" ).removeClass( "btn-outline-primary" );
// 			//parent.find( "tbody" ).find( "tr" ).find( "button" ).addClass( "btn-primary" );
			
// 			parent.find( "tbody" ).find( "tr" ).each( function( index, element ) {
// 				if( $(element).data( "code" ) == code ) {
// 					$(element).addClass( "bg-info text-white" );
// 					//$(element).find( "button" ).removeClass( "btn-primary " );
// 					//$(element).find( "button" ).addClass( "btn-outline-primary" );
// 					return false;
// 				}
// 			});
// 			*/
			
// 			parent.trigger( "click-btn-info", [ $(this).data( "code" ), $(this).data( "management-office-code" ), $(this).data( "carehome-office-code" ) ] );
// 		}
// 	});
	
// });

</script>

</div>