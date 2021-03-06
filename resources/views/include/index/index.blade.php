
<div class="row mt-3">
	<div class="col-6 col-md-3 user_menu text-center mb-5">
		<a href="{{route('stock_list')}}">
			<div class="user_menu_icon d-flex align-items-center justify-content-center">
				<svg xmlns="http://www.w3.org/2000/svg" style="font-size: 30px" fill="currentColor"
					class="bi bi-boxes svg-inline--fa fa-building fa-w-14 text-white menu-icon-size fa-fw"
					viewBox="0 0 16 16">
					<path
						d="M7.752.066a.5.5 0 0 1 .496 0l3.75 2.143a.5.5 0 0 1 .252.434v3.995l3.498 2A.5.5 0 0 1 16 9.07v4.286a.5.5 0 0 1-.252.434l-3.75 2.143a.5.5 0 0 1-.496 0l-3.502-2-3.502 2.001a.5.5 0 0 1-.496 0l-3.75-2.143A.5.5 0 0 1 0 13.357V9.071a.5.5 0 0 1 .252-.434L3.75 6.638V2.643a.5.5 0 0 1 .252-.434L7.752.066ZM4.25 7.504 1.508 9.071l2.742 1.567 2.742-1.567L4.25 7.504ZM7.5 9.933l-2.75 1.571v3.134l2.75-1.571V9.933Zm1 3.134 2.75 1.571v-3.134L8.5 9.933v3.134Zm.508-3.996 2.742 1.567 2.742-1.567-2.742-1.567-2.742 1.567Zm2.242-2.433V3.504L8.5 5.076V8.21l2.75-1.572ZM7.5 8.21V5.076L4.75 3.504v3.134L7.5 8.21ZM5.258 2.643 8 4.21l2.742-1.567L8 1.076 5.258 2.643ZM15 9.933l-2.75 1.571v3.134L15 13.067V9.933ZM3.75 14.638v-3.134L1 9.933v3.134l2.75 1.571Z" />
				</svg>
			</div>
			<div class="p-2">
				在庫一覧
			</div>
		</a>
	</div>
	<div class="col-6 col-md-3 user_menu text-center mb-5">
		<a href="{{route('buy_list_category', ['consumables_category_code' => 1])}}">
			<div class="user_menu_icon d-flex align-items-center justify-content-center">
				<svg xmlns="http://www.w3.org/2000/svg" style="font-size: 30px" fill="currentColor"
					class="svg-inline--fa fa-hand-holding text-white menu-icon-size fa-fw" viewBox="0 0 16 16">
					<path
						d="M8.186 1.113a.5.5 0 0 0-.372 0L1.846 3.5l2.404.961L10.404 2l-2.218-.887zm3.564 1.426L5.596 5 8 5.961 14.154 3.5l-2.404-.961zm3.25 1.7-6.5 2.6v7.922l6.5-2.6V4.24zM7.5 14.762V6.838L1 4.239v7.923l6.5 2.6zM7.443.184a1.5 1.5 0 0 1 1.114 0l7.129 2.852A.5.5 0 0 1 16 3.5v8.662a1 1 0 0 1-.629.928l-7.185 2.874a.5.5 0 0 1-.372 0L.63 13.09a1 1 0 0 1-.63-.928V3.5a.5.5 0 0 1 .314-.464L7.443.184z" />
				</svg>
			</div>
			<div class="p-2">
				本部仕入<br>
			</div>
		</a>
	</div>
	<div class="col-6 col-md-3 user_menu text-center mb-5">
		<a href="{{route('ship_list')}}">
			<div class="user_menu_icon d-flex align-items-center justify-content-center">
				<svg class="svg-inline--fa fa-truck fa-w-20 text-white menu-icon-size fa-fw" style="font-size: 30px"
					aria-hidden="true" focusable="false" data-prefix="fas" data-icon="truck" role="img"
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
		<a href="{{route('deliver')}}">
			<div class="user_menu_icon d-flex align-items-center justify-content-center">
				<svg class="svg-inline--fa fa-hand-holding fa-w-20 text-white menu-icon-size fa-fw"
					style="font-size: 30px" aria-hidden="true" focusable="false" data-prefix="fas"
					data-icon="hand-holding" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"
					data-fa-i2svg="">
					<path fill="currentColor"
						d="M565.3 328.1c-11.8-10.7-30.2-10-42.6 0L430.3 402c-11.3 9.1-25.4 14-40 14H272c-8.8 0-16-7.2-16-16s7.2-16 16-16h78.3c15.9 0 30.7-10.9 33.3-26.6 3.3-20-12.1-37.4-31.6-37.4H192c-27 0-53.1 9.3-74.1 26.3L71.4 384H16c-8.8 0-16 7.2-16 16v96c0 8.8 7.2 16 16 16h356.8c14.5 0 28.6-4.9 40-14L564 377c15.2-12.1 16.4-35.3 1.3-48.9z">
					</path>
				</svg>
			</div>
			<div class="p-2">
				施設納品
			</div>
		</a>
	</div>
	<div class="col-6 col-md-3 user_menu text-center mb-5">
		<a href="{{route('deliver_status', ['consumables_category_code' => 1])}}">
			<div class="user_menu_icon d-flex align-items-center justify-content-center text-white menu-icon-size fa-fw">
				<svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-bar-chart-fill" viewBox="0 0 16 16">
					<path d="M1 11a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1v-3zm5-4a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v7a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1V7zm5-5a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1h-2a1 1 0 0 1-1-1V2z"/>
				</svg>
			</div>
			<div class="p-2">
				納品状況
			</div>
		</a>
	</div>
	{{-- <div class="col-6 col-md-3 user_menu text-center mb-5">
		<a href="{{route('consumption')}}">
			<div class="user_menu_icon d-flex align-items-center justify-content-center">
				<svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor"
					class="bi bi-qr-code-scan text-white" viewBox="0 0 16 16">
					<path
						d="M0 .5A.5.5 0 0 1 .5 0h3a.5.5 0 0 1 0 1H1v2.5a.5.5 0 0 1-1 0v-3Zm12 0a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 .5.5v3a.5.5 0 0 1-1 0V1h-2.5a.5.5 0 0 1-.5-.5ZM.5 12a.5.5 0 0 1 .5.5V15h2.5a.5.5 0 0 1 0 1h-3a.5.5 0 0 1-.5-.5v-3a.5.5 0 0 1 .5-.5Zm15 0a.5.5 0 0 1 .5.5v3a.5.5 0 0 1-.5.5h-3a.5.5 0 0 1 0-1H15v-2.5a.5.5 0 0 1 .5-.5ZM4 4h1v1H4V4Z" />
					<path d="M7 2H2v5h5V2ZM3 3h3v3H3V3Zm2 8H4v1h1v-1Z" />
					<path d="M7 9H2v5h5V9Zm-4 1h3v3H3v-3Zm8-6h1v1h-1V4Z" />
					<path
						d="M9 2h5v5H9V2Zm1 1v3h3V3h-3ZM8 8v2h1v1H8v1h2v-2h1v2h1v-1h2v-1h-3V8H8Zm2 2H9V9h1v1Zm4 2h-1v1h-2v1h3v-2Zm-4 2v-1H8v1h2Z" />
					<path d="M12 9h2V8h-2v1Z" />
				</svg>
			</div>
			<div class="p-2">
				施設消費
			</div>
		</a>
	</div> --}}
	<div class="col-6 col-md-3 user_menu text-center mb-5">
		<a href="{{route('master_list_category', ['consumables_category_code' => 1])}}">
			<div class="user_menu_icon d-flex align-items-center justify-content-center">
				<i class="fas fa-database fa-2x text-white"></i>
			</div>
			<div class="p-2">
				マスタ一覧
			</div>
		</a>
	</div>
	<div class="col-6 col-md-3 user_menu text-center mb-5">
		<a href="{{route('facility_qr_list')}}" target="_blank" rel="noopener noreferrer">
			<div class="user_menu_icon d-flex align-items-center justify-content-center">
				<svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-qr-code text-white" viewBox="0 0 16 16">
					<path d="M2 2h2v2H2V2Z"/>
					<path d="M6 0v6H0V0h6ZM5 1H1v4h4V1ZM4 12H2v2h2v-2Z"/>
					<path d="M6 10v6H0v-6h6Zm-5 1v4h4v-4H1Zm11-9h2v2h-2V2Z"/>
					<path d="M10 0v6h6V0h-6Zm5 1v4h-4V1h4ZM8 1V0h1v2H8v2H7V1h1Zm0 5V4h1v2H8ZM6 8V7h1V6h1v2h1V7h5v1h-4v1H7V8H6Zm0 0v1H2V8H1v1H0V7h3v1h3Zm10 1h-1V7h1v2Zm-1 0h-1v2h2v-1h-1V9Zm-4 0h2v1h-1v1h-1V9Zm2 3v-1h-1v1h-1v1H9v1h3v-2h1Zm0 0h3v1h-2v1h-1v-2Zm-4-1v1h1v-2H7v1h2Z"/>
					<path d="M7 12h1v3h4v1H7v-4Zm9 2v2h-3v-1h2v-1h1Z"/>
				</svg>
			</div>
			<div class="p-2">
				施設QR
			</div>
		</a>
	</div>
</div>