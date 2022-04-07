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

<!-- カテゴリセレクタ -->
@include("include/consumable_category")

<table class="table table-striped" id="table">
	<thead>
		@foreach($office_list as $data)
		<tr>
			<th class="table-scroll-fixed-top bg-white" style="width:150px;"></th>
			<th class="table-scroll-fixed-top bg-white" style="width:150px;"><svg
					class="svg-inline--fa fa-building fa-w-14 fa-fw" aria-hidden="true" focusable="false"
					data-prefix="fas" data-icon="building" role="img" xmlns="http://www.w3.org/2000/svg"
					viewBox="0 0 448 512" data-fa-i2svg="">
					<path fill="currentColor"
						d="M436 480h-20V24c0-13.255-10.745-24-24-24H56C42.745 0 32 10.745 32 24v456H12c-6.627 0-12 5.373-12 12v20h448v-20c0-6.627-5.373-12-12-12zM128 76c0-6.627 5.373-12 12-12h40c6.627 0 12 5.373 12 12v40c0 6.627-5.373 12-12 12h-40c-6.627 0-12-5.373-12-12V76zm0 96c0-6.627 5.373-12 12-12h40c6.627 0 12 5.373 12 12v40c0 6.627-5.373 12-12 12h-40c-6.627 0-12-5.373-12-12v-40zm52 148h-40c-6.627 0-12-5.373-12-12v-40c0-6.627 5.373-12 12-12h40c6.627 0 12 5.373 12 12v40c0 6.627-5.373 12-12 12zm76 160h-64v-84c0-6.627 5.373-12 12-12h40c6.627 0 12 5.373 12 12v84zm64-172c0 6.627-5.373 12-12 12h-40c-6.627 0-12-5.373-12-12v-40c0-6.627 5.373-12 12-12h40c6.627 0 12 5.373 12 12v40zm0-96c0 6.627-5.373 12-12 12h-40c-6.627 0-12-5.373-12-12v-40c0-6.627 5.373-12 12-12h40c6.627 0 12 5.373 12 12v40zm0-96c0 6.627-5.373 12-12 12h-40c-6.627 0-12-5.373-12-12V76c0-6.627 5.373-12 12-12h40c6.627 0 12 5.373 12 12v40z">
					</path>
				</svg><!-- <i class="fas fa-building fa-fw"></i> Font Awesome fontawesome.com -->ほのか</th>
		</tr>
	</thead>
	<tbody>
		@foreach($office_stock_list as $data)
		<tr data-consumable-code="{{$data->consumable_code}}">
			<th class="table-scroll-fixed-left bg-white" style="width:150px;height:100px;">
				<div><svg class="svg-inline--fa fa-cube fa-w-16 fa-fw" aria-hidden="true" focusable="false"
						data-prefix="fas" data-icon="cube" role="img" xmlns="http://www.w3.org/2000/svg"
						viewBox="0 0 512 512" data-fa-i2svg="">
						<path fill="currentColor"
							d="M239.1 6.3l-208 78c-18.7 7-31.1 25-31.1 45v225.1c0 18.2 10.3 34.8 26.5 42.9l208 104c13.5 6.8 29.4 6.8 42.9 0l208-104c16.3-8.1 26.5-24.8 26.5-42.9V129.3c0-20-12.4-37.9-31.1-44.9l-208-78C262 2.2 250 2.2 239.1 6.3zM256 68.4l192 72v1.1l-192 78-192-78v-1.1l192-72zm32 356V275.5l160-65v133.9l-160 80z">
						</path>
					</svg><!-- <i class="fas fa-cube fa-fw"></i> Font Awesome fontawesome.com -->エンボス手袋M</div>
				<img src="https://uchipo.com/test_uchikuru_hori/images/consumable/{{$data->consumable_image_filename}}" width="100px">
			</th>
			<td data-office-code="1" data-consumable-code="{{$data->consumable_code}}" style="width:150px;height:100px;">
				<div id="loading" class="w-100 h-100 d-flex align-items-center justify-content-center d-none">
					<div id="spinner">
						<div class="spinner-border spinner-border-sm text-secondary" role="status">
							<span class="visually-hidden"></span>
						</div>

					</div>
				</div>
				<div id="stock" class="w-auto">
					<div class="row">
						<div class="col">
							{{$data->stock_number}} {{$data->number_unit}}<br>
							{{$data->stock_quantity}}{{$data->quantity_unit}}
						</div>
						<div class="col">

							<a id="item-history" data-office-code="1" data-consumable-code="{{$data->consumable_code}}"><svg
									class="svg-inline--fa fa-history fa-w-16 text-secondary fa-fw" aria-hidden="true"
									focusable="false" data-prefix="fas" data-icon="history" role="img"
									xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg="">
									<path fill="currentColor"
										d="M504 255.531c.253 136.64-111.18 248.372-247.82 248.468-59.015.042-113.223-20.53-155.822-54.911-11.077-8.94-11.905-25.541-1.839-35.607l11.267-11.267c8.609-8.609 22.353-9.551 31.891-1.984C173.062 425.135 212.781 440 256 440c101.705 0 184-82.311 184-184 0-101.705-82.311-184-184-184-48.814 0-93.149 18.969-126.068 49.932l50.754 50.754c10.08 10.08 2.941 27.314-11.313 27.314H24c-8.837 0-16-7.163-16-16V38.627c0-14.254 17.234-21.393 27.314-11.314l49.372 49.372C129.209 34.136 189.552 8 256 8c136.81 0 247.747 110.78 248 247.531zm-180.912 78.784l9.823-12.63c8.138-10.463 6.253-25.542-4.21-33.679L288 256.349V152c0-13.255-10.745-24-24-24h-16c-13.255 0-24 10.745-24 24v135.651l65.409 50.874c10.463 8.137 25.541 6.253 33.679-4.21z">
									</path>
								</svg>
								<!-- <i class="fas fa-history text-secondary fa-fw"></i> Font Awesome fontawesome.com --></a>
						</div>
					</div>
					<div class="progress mt-3">
						<div class="progress-bar bg-success" role="progressbar" style="width:%" aria-valuenow="5"
							aria-valuemin="0" aria-valuemax=""></div>
					</div>

				</div>
				<div id="no-stock" class="w-100 h-100 d-flex align-items-center justify-content-center"></div>
			</td>
		</tr>
		@endforeach
	</tbody>
</table>
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