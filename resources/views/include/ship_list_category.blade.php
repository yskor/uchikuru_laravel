<div class="card mb-3">
    <div class="card-header">検索</div>
    <div class="card-body">

        <div class="mb-3" id="search-carehome">
            <div class="mb-1" id="facility-area">
                <div class="input-group w-100">
                    <label class="input-group-text">施設地域</label>
                    {{-- <input type="radio" class="btn-check" name="search-carehome-facility-area"
                        id="search-carehome-facility-area-富山" value="富山">
                    <label class="btn btn-outline-primary" for="search-carehome-facility-area-富山"
                        style="width:80px">富山</label>
                    <input type="radio" class="btn-check" name="search-carehome-facility-area"
                        id="search-carehome-facility-area-石川" value="石川">
                    <label class="btn btn-outline-danger" for="search-carehome-facility-area-石川"
                        style="width:80px">石川</label> --}}
                </div>

                <script>
                    $( function() {
                        var parent = $( "#search-carehome" ).find( "#facility-area" );
                        
                        parent.find( "input[name=search-carehome-facility-area]" ).on( "change", function() {
                            parent.trigger( "changed-facility-area", $(this).val() );
                        });
                        
                        parent.find( "input[name=search-carehome-facility-area]:eq(0)" ).prop( "checked", true );
                        parent.trigger( "changed-facility-area", parent.find( "input[name=search-carehome-facility-area]" ).val() );
                    });

                </script>
            </div>
            <div id="facilitys">
                <div class="input-group w-100 mb-1">
                    <label class="btn btn-primary" for="search-carehome-facility-area-富山"
                        style="width:80px">富山</label>
                    @if ($office_code == 'all')
                    {{-- <a class="btn btn-praimary" href="{{route('ship_list')}}" id="search-carehome-facility-code-all">すべて</a> --}}
                    @else
                    {{-- <a class="btn btn-outline-praimary" href="{{route('ship_list')}}" id="search-carehome-facility-code-all">すべて</a> --}}
                    @endif
                    @foreach ($facility_all as $facility)
                        @if ($office_code == $facility->office_code and $facility->prefecture_code == 16)
                        <a class="btn btn-primary" href="{{route('ship_list')}}/{{ $facility->office_code }}" id="search-carehome-facility-code-{{ $facility->facility_name }}">{{ $facility->facility_name }}</a>
                        @elseif ($facility->prefecture_code == 16)
                        <a class="btn btn-outline-primary" href="{{route('ship_list')}}/{{ $facility->office_code }}" id="search-carehome-facility-code-{{ $facility->facility_name }}">{{ $facility->facility_name }}</a>
                        @endif
                    @endforeach
                </div>
                <div class="input-group w-100">
                    <label class="btn btn-danger" for="search-carehome-facility-area-石川"
                        style="width:80px">石川</label>
                    @foreach ($facility_all as $facility)
                        @if ($office_code == $facility->office_code and $facility->prefecture_code == 17)
                        <a class="btn btn-danger" href="{{route('ship_list')}}/{{ $facility->office_code }}" id="search-carehome-facility-code-{{ $facility->facility_name }}">{{ $facility->facility_name }}</a>
                        @elseif ($facility->prefecture_code == 17)
                        <a class="btn btn-outline-danger" href="{{route('ship_list')}}/{{ $facility->office_code }}" id="search-carehome-facility-code-{{ $facility->facility_name }}">{{ $facility->facility_name }}</a>
                        @endif
                    @endforeach
                </div>

                <script>
                    $( function() {
                        
                        var parent = $( "#search-carehome" ).find( "#facilitys" );
                        
                        parent.find( "input[name=search-carehome-facility-code]" ).on( "change", function() {
                            parent.trigger( "changed-facility-code", $(this).val() );
                        });
                        
                        parent.trigger( "search-facilitys-loaded" );
                    });

                </script>
            </div>
        </div>

        <script>
            $( function() {
	
                var parent = $( "#search-carehome" );
                var area = parent.find( "#facility-area" );
                var facilitys = parent.find( "#facilitys" );
                
                uk_ajax_html( area, "medicine_stock/facilityarea", { "parent_id" : parent.attr( "id" ) } );
                
                area.on( "changed-facility-area", function( event, facility_area ) {
                    var param = { 
                            "facility_area" : facility_area,
                            "all_facility" : 1,					"parent_id" : parent.attr( "id" ),
                            };
                    uk_ajax_html( facilitys, "medicine_stock/facilitys", param );
                    parent.trigger( "search-carehome-changed-facility-area", facility_area );
                });
                
                facilitys.on( "search-facilitys-loaded", function() {
                    parent.trigger( "search-carehome-facilitys-loaded" );
                });
                
                facilitys.on( "changed-facility-code", function( event, facility_code ) {
                    parent.data( "facility-code", facility_code );
                    parent.trigger( "search-carehome-changed-facility-code", facility_code );
                });
                
            });

        </script>
        {{-- <div id="search-tabs">
            <div class="nav nav-pills mb-1" id="nav-tab" role="tablist">
                <a class="nav-link text-center active" id="nav-user-tab" data-bs-toggle="tab" href="#nav-user"
                    role="tab" aria-controls="nav-user" aria-selected="true" style="width:150px">消耗品名で検索</a>
            </div>
            <div class="tab-content" id="nav-tabContent">
                <div class="tab-pane fade show active" id="nav-user" role="tabpanel" aria-labelledby="nav-user-tab">
                    <div class="input-group" id="search-keyword">
                        <div class="form-outline" style="width:500px">
                            <input type="search" id="keyword" class="form-control"
                                placeholder="キーワード(消耗品名)">
                        </div>
                        <button type="button" class="btn btn-primary" id="btn-search">
                            <svg class="svg-inline--fa fa-search fa-w-16 fa-fw" aria-hidden="true" focusable="false"
                                data-prefix="fas" data-icon="search" role="img" xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 512 512" data-fa-i2svg="">
                                <path fill="currentColor"
                                    d="M505 442.7L405.3 343c-4.5-4.5-10.6-7-17-7H372c27.6-35.3 44-79.7 44-128C416 93.1 322.9 0 208 0S0 93.1 0 208s93.1 208 208 208c48.3 0 92.7-16.4 128-44v16.3c0 6.4 2.5 12.5 7 17l99.7 99.7c9.4 9.4 24.6 9.4 33.9 0l28.3-28.3c9.4-9.4 9.4-24.6.1-34zM208 336c-70.7 0-128-57.2-128-128 0-70.7 57.2-128 128-128 70.7 0 128 57.2 128 128 0 70.7-57.2 128-128 128z">
                                </path>
                            </svg><!-- <i class="fas fa-search fa-fw"></i> Font Awesome fontawesome.com -->検索
                        </button>
                    </div>
                </div>
            </div>
        </div> --}}
    </div>
</div>