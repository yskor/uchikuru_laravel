@extends('layout.base')
@section('title', 'サンプルページ')

{{-- headタグ内 --}}
@section('head')
@endsection

{{-- スタイルシート --}}
@section('style')
<style>
</style>
@endsection

{{-- ヘッダー --}}
@section('header')
@endsection

{{-- メインコンテンツ --}}
@section('main')
<div id="content-body">
	<div class="container">
		<div id="list">
			<table class="table table-striped" id="table">
				<thead></thead>
				<tbody>
					<tr data-consumable-code="4520951011239">
						<td>
							<div class="row">
								<div class="col">
									<p><svg class="svg-inline--fa fa-building fa-w-14 fa-fw" aria-hidden="true"
											focusable="false" data-prefix="fas" data-icon="building" role="img"
											xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" data-fa-i2svg="">
											<path fill="currentColor"
												d="M436 480h-20V24c0-13.255-10.745-24-24-24H56C42.745 0 32 10.745 32 24v456H12c-6.627 0-12 5.373-12 12v20h448v-20c0-6.627-5.373-12-12-12zM128 76c0-6.627 5.373-12 12-12h40c6.627 0 12 5.373 12 12v40c0 6.627-5.373 12-12 12h-40c-6.627 0-12-5.373-12-12V76zm0 96c0-6.627 5.373-12 12-12h40c6.627 0 12 5.373 12 12v40c0 6.627-5.373 12-12 12h-40c-6.627 0-12-5.373-12-12v-40zm52 148h-40c-6.627 0-12-5.373-12-12v-40c0-6.627 5.373-12 12-12h40c6.627 0 12 5.373 12 12v40c0 6.627-5.373 12-12 12zm76 160h-64v-84c0-6.627 5.373-12 12-12h40c6.627 0 12 5.373 12 12v84zm64-172c0 6.627-5.373 12-12 12h-40c-6.627 0-12-5.373-12-12v-40c0-6.627 5.373-12 12-12h40c6.627 0 12 5.373 12 12v40zm0-96c0 6.627-5.373 12-12 12h-40c-6.627 0-12-5.373-12-12v-40c0-6.627 5.373-12 12-12h40c6.627 0 12 5.373 12 12v40zm0-96c0 6.627-5.373 12-12 12h-40c-6.627 0-12-5.373-12-12V76c0-6.627 5.373-12 12-12h40c6.627 0 12 5.373 12 12v40z">
											</path>
										</svg>
										<!-- <i class="fas fa-building fa-fw"></i> Font Awesome fontawesome.com -->アシスト
									</p>
									<p><svg class="svg-inline--fa fa-cube fa-w-16 fa-fw" aria-hidden="true"
											focusable="false" data-prefix="fas" data-icon="cube" role="img"
											xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg="">
											<path fill="currentColor"
												d="M239.1 6.3l-208 78c-18.7 7-31.1 25-31.1 45v225.1c0 18.2 10.3 34.8 26.5 42.9l208 104c13.5 6.8 29.4 6.8 42.9 0l208-104c16.3-8.1 26.5-24.8 26.5-42.9V129.3c0-20-12.4-37.9-31.1-44.9l-208-78C262 2.2 250 2.2 239.1 6.3zM256 68.4l192 72v1.1l-192 78-192-78v-1.1l192-72zm32 356V275.5l160-65v133.9l-160 80z">
											</path>
										</svg>
										<!-- <i class="fas fa-cube fa-fw"></i> Font Awesome fontawesome.com -->エンボス手袋M
									</p>
								</div>
								<div class="col-3">
									<button type="button" class="btn btn-primary" id="btn-deliver"
										data-id="10059">納品</button>
								</div>
							</div>
							<div class="row">
								<div class="col-4">
									<img src="https://uchipo.com/test_uchikuru_hori/images/consumable/4520951011239.jpg"
										width="100px">
								</div>
								<div class="col-8">出庫数：10 箱</div>
							</div>
						</td>
					</tr>
				</tbody>
			</table>

			<script>
				$(function() {

					var table = $( "#table" );

					table.find( "button" ).on( "click", function() {
						if( $(this).attr( "id" ) == "btn-deliver" ) {
						table.trigger( "click-btn-deliver", $(this).data( "id" ) );
						}
					});
				});
			</script>
		</div>

		<div class="modal fade" id="modal" tabindex="-1" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="modal-title">消耗品を納品</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body">
						<div id="qr"></div>

						<div id="form" hidden=""></div>

					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" id="btn-close"
							data-bs-dismiss="modal">閉じる</button>
						<button type="button" class="btn btn-primary" id="btn-do" disabled="">納品</button>

					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection

{{-- フッター --}}
@section('footer')
<div class="container">
	<div class="alert alert-info">【フッター】</div>
</div>
@endsection

{{-- JavaScript --}}
@section('script')
@include('_sample')
@endsection