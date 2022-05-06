<div class="container">
	<a href="{{$common_system_top_page_url}}">
		<img src="{{url('images/uchipo.png')}}">
	</a>
	<div>
		<svg class="svg-inline--fa fa-user fa-w-14 fa-fw" aria-hidden="true" focusable="false" data-prefix="fas"
			data-icon="user" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" data-fa-i2svg="">
			<path fill="currentColor"
				d="M224 256c70.7 0 128-57.3 128-128S294.7 0 224 0 96 57.3 96 128s57.3 128 128 128zm89.6 32h-16.7c-22.2 10.2-46.9 16-72.9 16s-50.6-5.8-72.9-16h-16.7C60.2 288 0 348.2 0 422.4V464c0 26.5 21.5 48 48 48h352c26.5 0 48-21.5 48-48v-41.6c0-74.2-60.2-134.4-134.4-134.4z">
			</path>
		</svg>
		{{$login->staff_name}}&nbsp;
		<svg class="svg-inline--fa fa-building fa-w-14 fa-fw" aria-hidden="true" focusable="false" data-prefix="fas"
			data-icon="building" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" data-fa-i2svg="">
			<path fill="currentColor"
				d="M436 480h-20V24c0-13.255-10.745-24-24-24H56C42.745 0 32 10.745 32 24v456H12c-6.627 0-12 5.373-12 12v20h448v-20c0-6.627-5.373-12-12-12zM128 76c0-6.627 5.373-12 12-12h40c6.627 0 12 5.373 12 12v40c0 6.627-5.373 12-12 12h-40c-6.627 0-12-5.373-12-12V76zm0 96c0-6.627 5.373-12 12-12h40c6.627 0 12 5.373 12 12v40c0 6.627-5.373 12-12 12h-40c-6.627 0-12-5.373-12-12v-40zm52 148h-40c-6.627 0-12-5.373-12-12v-40c0-6.627 5.373-12 12-12h40c6.627 0 12 5.373 12 12v40c0 6.627-5.373 12-12 12zm76 160h-64v-84c0-6.627 5.373-12 12-12h40c6.627 0 12 5.373 12 12v84zm64-172c0 6.627-5.373 12-12 12h-40c-6.627 0-12-5.373-12-12v-40c0-6.627 5.373-12 12-12h40c6.627 0 12 5.373 12 12v40zm0-96c0 6.627-5.373 12-12 12h-40c-6.627 0-12-5.373-12-12v-40c0-6.627 5.373-12 12-12h40c6.627 0 12 5.373 12 12v40zm0-96c0 6.627-5.373 12-12 12h-40c-6.627 0-12-5.373-12-12V76c0-6.627 5.373-12 12-12h40c6.627 0 12 5.373 12 12v40z">
			</path>
		</svg>
		{{$login->facility_name}}
	</div>
</div>
<div class="bg-light mb-3">
	<div class="container h3 mb-0">
		@yield('title')
	</div>
	@if($login->office_code == 91)
	<nav class="navbar navbar-expand navbar-light bg-light p-0 d-none d-sm-block">
		<div class="container-fluid px-0">
			<ul class="navbar-nav w-100 nav-justified">
				{{-- <li class="nav-item border">
					<a class="nav-link" aria-current="page" href="{{route('index')}}">
						<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
							class="bi bi-house-fill" viewBox="0 0 16 16">
							<path fill-rule="evenodd"
								d="m8 3.293 6 6V13.5a1.5 1.5 0 0 1-1.5 1.5h-9A1.5 1.5 0 0 1 2 13.5V9.293l6-6zm5-.793V6l-2-2V2.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5z" />
							<path fill-rule="evenodd"
								d="M7.293 1.5a1 1 0 0 1 1.414 0l6.647 6.646a.5.5 0 0 1-.708.708L8 2.207 1.354 8.854a.5.5 0 1 1-.708-.708L7.293 1.5z" />
						</svg>
						消耗品TOP
					</a>
				</li> --}}
				<li class="nav-item border">
					<a class="nav-link" href="{{route('stock_list')}}">
						<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
							class="bi bi-boxes" viewBox="0 0 16 16">
							<path
								d="M7.752.066a.5.5 0 0 1 .496 0l3.75 2.143a.5.5 0 0 1 .252.434v3.995l3.498 2A.5.5 0 0 1 16 9.07v4.286a.5.5 0 0 1-.252.434l-3.75 2.143a.5.5 0 0 1-.496 0l-3.502-2-3.502 2.001a.5.5 0 0 1-.496 0l-3.75-2.143A.5.5 0 0 1 0 13.357V9.071a.5.5 0 0 1 .252-.434L3.75 6.638V2.643a.5.5 0 0 1 .252-.434L7.752.066ZM4.25 7.504 1.508 9.071l2.742 1.567 2.742-1.567L4.25 7.504ZM7.5 9.933l-2.75 1.571v3.134l2.75-1.571V9.933Zm1 3.134 2.75 1.571v-3.134L8.5 9.933v3.134Zm.508-3.996 2.742 1.567 2.742-1.567-2.742-1.567-2.742 1.567Zm2.242-2.433V3.504L8.5 5.076V8.21l2.75-1.572ZM7.5 8.21V5.076L4.75 3.504v3.134L7.5 8.21ZM5.258 2.643 8 4.21l2.742-1.567L8 1.076 5.258 2.643ZM15 9.933l-2.75 1.571v3.134L15 13.067V9.933ZM3.75 14.638v-3.134L1 9.933v3.134l2.75 1.571Z" />
						</svg>
						在庫一覧
					</a>
				</li>
				<li class="nav-item border">
					<a class="nav-link" href="{{route('buy_list_category', ['consumables_category_code' => 1])}}">
						<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
							class="bi bi-box-seam" viewBox="0 0 16 16">
							<path
								d="M8.186 1.113a.5.5 0 0 0-.372 0L1.846 3.5l2.404.961L10.404 2l-2.218-.887zm3.564 1.426L5.596 5 8 5.961 14.154 3.5l-2.404-.961zm3.25 1.7-6.5 2.6v7.922l6.5-2.6V4.24zM7.5 14.762V6.838L1 4.239v7.923l6.5 2.6zM7.443.184a1.5 1.5 0 0 1 1.114 0l7.129 2.852A.5.5 0 0 1 16 3.5v8.662a1 1 0 0 1-.629.928l-7.185 2.874a.5.5 0 0 1-.372 0L.63 13.09a1 1 0 0 1-.63-.928V3.5a.5.5 0 0 1 .314-.464L7.443.184z" />
						</svg>
						本部仕入れ
					</a>
				</li>
				<li class="nav-item border">
					<a class="nav-link" href="{{route('ship_list')}}">
						<svg class="svg-inline--fa fa-truck fa-w-20 menu-icon-size fa-fw" aria-hidden="true"
							focusable="false" data-prefix="fas" data-icon="truck" role="img"
							xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512" data-fa-i2svg="">
							<path fill="currentColor"
								d="M624 352h-16V243.9c0-12.7-5.1-24.9-14.1-33.9L494 110.1c-9-9-21.2-14.1-33.9-14.1H416V48c0-26.5-21.5-48-48-48H48C21.5 0 0 21.5 0 48v320c0 26.5 21.5 48 48 48h16c0 53 43 96 96 96s96-43 96-96h128c0 53 43 96 96 96s96-43 96-96h48c8.8 0 16-7.2 16-16v-32c0-8.8-7.2-16-16-16zM160 464c-26.5 0-48-21.5-48-48s21.5-48 48-48 48 21.5 48 48-21.5 48-48 48zm320 0c-26.5 0-48-21.5-48-48s21.5-48 48-48 48 21.5 48 48-21.5 48-48 48zm80-208H416V144h44.1l99.9 99.9V256z">
							</path>
						</svg>
						本部出荷
					</a>
				</li>
				<li class="nav-item border">
					<a class="nav-link" href="{{route('deliver')}}">
						<svg class="svg-inline--fa fa-hand-holding fa-w-18 menu-icon-size fa-fw" aria-hidden="true"
							focusable="false" data-prefix="fas" data-icon="hand-holding" role="img"
							xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" data-fa-i2svg="">
							<path fill="currentColor"
								d="M565.3 328.1c-11.8-10.7-30.2-10-42.6 0L430.3 402c-11.3 9.1-25.4 14-40 14H272c-8.8 0-16-7.2-16-16s7.2-16 16-16h78.3c15.9 0 30.7-10.9 33.3-26.6 3.3-20-12.1-37.4-31.6-37.4H192c-27 0-53.1 9.3-74.1 26.3L71.4 384H16c-8.8 0-16 7.2-16 16v96c0 8.8 7.2 16 16 16h356.8c14.5 0 28.6-4.9 40-14L564 377c15.2-12.1 16.4-35.3 1.3-48.9z">
							</path>
						</svg>
						施設納品
					</a>
				</li>
				<li class="nav-item border">
					<a class="nav-link" href="{{route('master_list_category', ['consumables_category_code' => 1])}}">
						<i class="fas fa-database "></i>
						マスタ一覧
					</a>
				</li>
			</ul>
		</div>
	</nav>

	<nav class="navbar navbar-expand navbar-light bg-light p-0 d-block d-sm-none">
		<div class="container-fluid px-0">
			<ul class="navbar-nav w-100 nav-justified">
				{{-- <li class="nav-item border">
					<a class="nav-link" aria-current="page" href="{{route('index')}}" style="font-size: 5px;">
						<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
							class="bi bi-house-fill" viewBox="0 0 16 16">
							<path fill-rule="evenodd"
								d="m8 3.293 6 6V13.5a1.5 1.5 0 0 1-1.5 1.5h-9A1.5 1.5 0 0 1 2 13.5V9.293l6-6zm5-.793V6l-2-2V2.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5z" />
							<path fill-rule="evenodd"
								d="M7.293 1.5a1 1 0 0 1 1.414 0l6.647 6.646a.5.5 0 0 1-.708.708L8 2.207 1.354 8.854a.5.5 0 1 1-.708-.708L7.293 1.5z" />
						</svg>
						<br>消耗品TOP
					</a>
				</li> --}}
				<li class="nav-item border">
					<a class="nav-link" href="{{route('stock_list')}}" style="font-size: 5px;">
						<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
							class="bi bi-boxes" viewBox="0 0 16 16">
							<path
								d="M7.752.066a.5.5 0 0 1 .496 0l3.75 2.143a.5.5 0 0 1 .252.434v3.995l3.498 2A.5.5 0 0 1 16 9.07v4.286a.5.5 0 0 1-.252.434l-3.75 2.143a.5.5 0 0 1-.496 0l-3.502-2-3.502 2.001a.5.5 0 0 1-.496 0l-3.75-2.143A.5.5 0 0 1 0 13.357V9.071a.5.5 0 0 1 .252-.434L3.75 6.638V2.643a.5.5 0 0 1 .252-.434L7.752.066ZM4.25 7.504 1.508 9.071l2.742 1.567 2.742-1.567L4.25 7.504ZM7.5 9.933l-2.75 1.571v3.134l2.75-1.571V9.933Zm1 3.134 2.75 1.571v-3.134L8.5 9.933v3.134Zm.508-3.996 2.742 1.567 2.742-1.567-2.742-1.567-2.742 1.567Zm2.242-2.433V3.504L8.5 5.076V8.21l2.75-1.572ZM7.5 8.21V5.076L4.75 3.504v3.134L7.5 8.21ZM5.258 2.643 8 4.21l2.742-1.567L8 1.076 5.258 2.643ZM15 9.933l-2.75 1.571v3.134L15 13.067V9.933ZM3.75 14.638v-3.134L1 9.933v3.134l2.75 1.571Z" />
						</svg>
						<br>在庫一覧
					</a>
				</li>
				<li class="nav-item border">
					<a class="nav-link" href="{{route('buy_list_category', ['consumables_category_code' => 1])}}"
						style="font-size: 5px;">
						<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
							class="bi bi-box-seam" viewBox="0 0 16 16">
							<path
								d="M8.186 1.113a.5.5 0 0 0-.372 0L1.846 3.5l2.404.961L10.404 2l-2.218-.887zm3.564 1.426L5.596 5 8 5.961 14.154 3.5l-2.404-.961zm3.25 1.7-6.5 2.6v7.922l6.5-2.6V4.24zM7.5 14.762V6.838L1 4.239v7.923l6.5 2.6zM7.443.184a1.5 1.5 0 0 1 1.114 0l7.129 2.852A.5.5 0 0 1 16 3.5v8.662a1 1 0 0 1-.629.928l-7.185 2.874a.5.5 0 0 1-.372 0L.63 13.09a1 1 0 0 1-.63-.928V3.5a.5.5 0 0 1 .314-.464L7.443.184z" />
						</svg>
						<br>本部仕入
					</a>
				</li>
				<li class="nav-item border">
					<a class="nav-link" href="{{route('ship_list')}}" style="font-size: 5px;">
						<svg class="svg-inline--fa fa-truck fa-w-20 menu-icon-size fa-fw" style="font-size: 16px"
							aria-hidden="true" focusable="false" data-prefix="fas" data-icon="truck" role="img"
							xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512" data-fa-i2svg="">
							<path fill="currentColor"
								d="M624 352h-16V243.9c0-12.7-5.1-24.9-14.1-33.9L494 110.1c-9-9-21.2-14.1-33.9-14.1H416V48c0-26.5-21.5-48-48-48H48C21.5 0 0 21.5 0 48v320c0 26.5 21.5 48 48 48h16c0 53 43 96 96 96s96-43 96-96h128c0 53 43 96 96 96s96-43 96-96h48c8.8 0 16-7.2 16-16v-32c0-8.8-7.2-16-16-16zM160 464c-26.5 0-48-21.5-48-48s21.5-48 48-48 48 21.5 48 48-21.5 48-48 48zm320 0c-26.5 0-48-21.5-48-48s21.5-48 48-48 48 21.5 48 48-21.5 48-48 48zm80-208H416V144h44.1l99.9 99.9V256z">
							</path>
						</svg>
						<br>本部出荷
					</a>
				</li>
				<li class="nav-item border">
					<a class="nav-link" href="{{route('deliver')}}" style="font-size: 5px;">
						<svg class="svg-inline--fa fa-truck fa-w-20 menu-icon-size fa-fw" style="font-size: 14px"
							aria-hidden="true" focusable="false" data-prefix="fas" data-icon="hand-holding" role="img"
							xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" data-fa-i2svg="">
							<path fill="currentColor"
								d="M565.3 328.1c-11.8-10.7-30.2-10-42.6 0L430.3 402c-11.3 9.1-25.4 14-40 14H272c-8.8 0-16-7.2-16-16s7.2-16 16-16h78.3c15.9 0 30.7-10.9 33.3-26.6 3.3-20-12.1-37.4-31.6-37.4H192c-27 0-53.1 9.3-74.1 26.3L71.4 384H16c-8.8 0-16 7.2-16 16v96c0 8.8 7.2 16 16 16h356.8c14.5 0 28.6-4.9 40-14L564 377c15.2-12.1 16.4-35.3 1.3-48.9z">
							</path>
						</svg>
						<br>施設納品
					</a>
				</li>
				<li class="nav-item border">
					<a class="nav-link" href="{{route('master_list_category', ['consumables_category_code' => 1])}}"
						style="font-size: 14px">
						<i class="fas fa-database "></i>
						<br><span style="font-size: 5px">マスタ一覧</span>
					</a>
				</li>
			</ul>
		</div>
	</nav>
	@endif
</div>
<div class="container">
	<div id="flash-message" class="alert alert-danger" hidden></div>
</div>