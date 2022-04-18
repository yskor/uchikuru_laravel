@extends('layout.base')
@section('title', '消耗品在庫管理システム')

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
<div class="container">
	<div class="row mt-3">
		<div class="col-6 col-md-3 user_menu text-center mb-5">
			<a href="{{ route('master_list') }}">
				<div class="user_menu_icon d-flex align-items-center justify-content-center">
					<i class="fas fa-database text-white"></i>
				</div>
				<div class="p-2">
					マスタ一覧
				</div>
			</a>
		</div>
		<div class="col-6 col-md-3 user_menu text-center mb-5">
			<a href="{{route('stock_list')}}">
				<div class="user_menu_icon d-flex align-items-center justify-content-center">
					<svg class="svg-inline--fa fa-building fa-w-14 text-white menu-icon-size fa-fw" aria-hidden="true"
						focusable="false" data-prefix="fas" data-icon="building" role="img"
						xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" data-fa-i2svg="">
						<path fill="currentColor"
							d="M436 480h-20V24c0-13.255-10.745-24-24-24H56C42.745 0 32 10.745 32 24v456H12c-6.627 0-12 5.373-12 12v20h448v-20c0-6.627-5.373-12-12-12zM128 76c0-6.627 5.373-12 12-12h40c6.627 0 12 5.373 12 12v40c0 6.627-5.373 12-12 12h-40c-6.627 0-12-5.373-12-12V76zm0 96c0-6.627 5.373-12 12-12h40c6.627 0 12 5.373 12 12v40c0 6.627-5.373 12-12 12h-40c-6.627 0-12-5.373-12-12v-40zm52 148h-40c-6.627 0-12-5.373-12-12v-40c0-6.627 5.373-12 12-12h40c6.627 0 12 5.373 12 12v40c0 6.627-5.373 12-12 12zm76 160h-64v-84c0-6.627 5.373-12 12-12h40c6.627 0 12 5.373 12 12v84zm64-172c0 6.627-5.373 12-12 12h-40c-6.627 0-12-5.373-12-12v-40c0-6.627 5.373-12 12-12h40c6.627 0 12 5.373 12 12v40zm0-96c0 6.627-5.373 12-12 12h-40c-6.627 0-12-5.373-12-12v-40c0-6.627 5.373-12 12-12h40c6.627 0 12 5.373 12 12v40zm0-96c0 6.627-5.373 12-12 12h-40c-6.627 0-12-5.373-12-12V76c0-6.627 5.373-12 12-12h40c6.627 0 12 5.373 12 12v40z">
						</path>
					</svg>
					<!-- <i class="fas text-white menu-icon-size fa-fw fa-building"></i> Font Awesome fontawesome.com -->
				</div>
				<div class="p-2">
					本部在庫
				</div>
			</a>
		</div>
		<div class="col-6 col-md-3 user_menu text-center mb-5">
			<a href="{{route('buy_list')}}">
				<div class="user_menu_icon d-flex align-items-center justify-content-center">
					<svg class="svg-inline--fa fa-truck fa-w-20 text-white menu-icon-size fa-fw" aria-hidden="true"
						focusable="false" data-prefix="fas" data-icon="truck" role="img"
						xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512" data-fa-i2svg="">
						<path fill="currentColor"
							d="M624 352h-16V243.9c0-12.7-5.1-24.9-14.1-33.9L494 110.1c-9-9-21.2-14.1-33.9-14.1H416V48c0-26.5-21.5-48-48-48H48C21.5 0 0 21.5 0 48v320c0 26.5 21.5 48 48 48h16c0 53 43 96 96 96s96-43 96-96h128c0 53 43 96 96 96s96-43 96-96h48c8.8 0 16-7.2 16-16v-32c0-8.8-7.2-16-16-16zM160 464c-26.5 0-48-21.5-48-48s21.5-48 48-48 48 21.5 48 48-21.5 48-48 48zm320 0c-26.5 0-48-21.5-48-48s21.5-48 48-48 48 21.5 48 48-21.5 48-48 48zm80-208H416V144h44.1l99.9 99.9V256z">
						</path>
					</svg>
					<!-- <i class="fas text-white menu-icon-size fa-fw fa-truck"></i> Font Awesome fontawesome.com -->
				</div>
				<div class="p-2">
					本部仕入れ<br>
				</div>
			</a>
		</div>
		<div class="col-6 col-md-3 user_menu text-center mb-5">
			<a href="{{route('ship_list')}}">
				<div class="user_menu_icon d-flex align-items-center justify-content-center">
					<svg class="svg-inline--fa fa-truck fa-w-20 text-white menu-icon-size fa-fw" aria-hidden="true"
						focusable="false" data-prefix="fas" data-icon="truck" role="img"
						xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512" data-fa-i2svg="">
						<path fill="currentColor"
							d="M624 352h-16V243.9c0-12.7-5.1-24.9-14.1-33.9L494 110.1c-9-9-21.2-14.1-33.9-14.1H416V48c0-26.5-21.5-48-48-48H48C21.5 0 0 21.5 0 48v320c0 26.5 21.5 48 48 48h16c0 53 43 96 96 96s96-43 96-96h128c0 53 43 96 96 96s96-43 96-96h48c8.8 0 16-7.2 16-16v-32c0-8.8-7.2-16-16-16zM160 464c-26.5 0-48-21.5-48-48s21.5-48 48-48 48 21.5 48 48-21.5 48-48 48zm320 0c-26.5 0-48-21.5-48-48s21.5-48 48-48 48 21.5 48 48-21.5 48-48 48zm80-208H416V144h44.1l99.9 99.9V256z">
						</path>
					</svg>
					<!-- <i class="fas text-white menu-icon-size fa-fw fa-truck"></i> Font Awesome fontawesome.com -->
				</div>
				<div class="p-2">
					本部出荷
				</div>
			</a>
		</div>
		<div class="col-6 col-md-3 user_menu text-center mb-5">
			<a href="{{route('deliver_list')}}">
				<div class="user_menu_icon d-flex align-items-center justify-content-center">
					<svg class="svg-inline--fa fa-truck fa-w-20 text-white menu-icon-size fa-fw" aria-hidden="true"
						focusable="false" data-prefix="fas" data-icon="truck" role="img"
						xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512" data-fa-i2svg="">
						<path fill="currentColor"
							d="M624 352h-16V243.9c0-12.7-5.1-24.9-14.1-33.9L494 110.1c-9-9-21.2-14.1-33.9-14.1H416V48c0-26.5-21.5-48-48-48H48C21.5 0 0 21.5 0 48v320c0 26.5 21.5 48 48 48h16c0 53 43 96 96 96s96-43 96-96h128c0 53 43 96 96 96s96-43 96-96h48c8.8 0 16-7.2 16-16v-32c0-8.8-7.2-16-16-16zM160 464c-26.5 0-48-21.5-48-48s21.5-48 48-48 48 21.5 48 48-21.5 48-48 48zm320 0c-26.5 0-48-21.5-48-48s21.5-48 48-48 48 21.5 48 48-21.5 48-48 48zm80-208H416V144h44.1l99.9 99.9V256z">
						</path>
					</svg>
					<!-- <i class="fas text-white menu-icon-size fa-fw fa-truck"></i> Font Awesome fontawesome.com -->
				</div>
				<div class="p-2">
					施設納品
				</div>
			</a>
		</div>
		<div class="col-6 col-md-3 user_menu text-center mb-5">
			<a href="https://uchipo.com/test_uchikuru_hori/consumables_returned">
				<div class="user_menu_icon d-flex align-items-center justify-content-center">
					<svg class="svg-inline--fa fa-reply fa-w-16 text-white menu-icon-size fa-fw" aria-hidden="true"
						focusable="false" data-prefix="fas" data-icon="reply" role="img"
						xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg="">
						<path fill="currentColor"
							d="M8.309 189.836L184.313 37.851C199.719 24.546 224 35.347 224 56.015v80.053c160.629 1.839 288 34.032 288 186.258 0 61.441-39.581 122.309-83.333 154.132-13.653 9.931-33.111-2.533-28.077-18.631 45.344-145.012-21.507-183.51-176.59-185.742V360c0 20.7-24.3 31.453-39.687 18.164l-176.004-152c-11.071-9.562-11.086-26.753 0-36.328z">
						</path>
					</svg>
					<!-- <i class="fas text-white menu-icon-size fa-fw fa-reply"></i> Font Awesome fontawesome.com -->
				</div>
				<div class="p-2">
					返品承認
				</div>
			</a>
		</div>
	</div>
</div>
@endsection

{{-- フッター --}}
@section('footer')
@endsection

{{-- JavaScript --}}
@section('script')
@include('_sample')
@endsection