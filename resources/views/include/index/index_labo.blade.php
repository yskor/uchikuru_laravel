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
		<a href="{{route('master_list_category', ['consumables_category_code' => 8])}}">
			<div class="user_menu_icon d-flex align-items-center justify-content-center">
				<i class="fas fa-database fa-2x text-white"></i>
			</div>
			<div class="p-2">
				マスタ一覧
			</div>
		</a>
	</div>
</div>