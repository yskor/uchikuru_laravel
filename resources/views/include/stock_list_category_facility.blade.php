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
                        <a class="btn btn-primary" href="{{route('stock_list')}}/{{ $facility->office_code }}/{{ $consumables_category_code }}" id="search-carehome-facility-code-{{ $facility->facility_name }}">{{ $facility->facility_name }}</a>
                        @elseif ($facility->prefecture_code == 16)
                        <a class="btn btn-outline-primary" href="{{route('stock_list')}}/{{ $facility->office_code }}/{{ $consumables_category_code }}" id="search-carehome-facility-code-{{ $facility->facility_name }}">{{ $facility->facility_name }}</a>
                        @endif
                    @endforeach
                </div>
                <div class="input-group w-100">
                    <label class="btn btn-danger" for="search-carehome-facility-area-石川"
                        style="width:80px">石川</label>
                    @foreach ($facility_all as $facility)
                        @if ($office_code == $facility->office_code and $facility->prefecture_code == 17)
                        <a class="btn btn-danger" href="{{route('stock_list')}}/{{ $facility->office_code }}/{{ $consumables_category_code }}" id="search-carehome-facility-code-{{ $facility->facility_name }}">{{ $facility->facility_name }}</a>
                        @elseif ($facility->prefecture_code == 17)
                        <a class="btn btn-outline-danger" href="{{route('stock_list')}}/{{ $facility->office_code }}/{{ $consumables_category_code }}" id="search-carehome-facility-code-{{ $facility->facility_name }}">{{ $facility->facility_name }}</a>
                        @endif
                    @endforeach
                </div>
                <script>
                    $( function() {
                        
                        var parent = $( "#search-carehome" ).find( "#facilitys" );
                        
                        parent.find( "a" ).on( "click", function() {
                            // parent.trigger( "changed-facility-code", $(this).val() );
                            // parent.trigger( "changed-facility-code", $(this).val() );
                            // $('#category-area').show();
                        });
                        
                        parent.trigger( "search-facilitys-loaded" );
                    });

                </script>
            </div>
        </div>
        @if ($office_code != 'all')
        <div class="mb-3" id="category-area">
            <div class="input-group w-100 mb-1">
                <label class="input-group-text">カテゴリ</label>
            </div>
            <div class="" id="categories">
                {{-- @if ($consumables_category_code == 'all')
                <a class="btn btn-success" href="{{ route('stock_list') }}/{{ $office_code }}" name="category_code_all" id="category_code_all">全て</a>
                @else
                <a class="btn btn-outline-success" href="{{ route('stock_list') }}/{{ $office_code }}" name="category_code_all" id="category_code_all">全て</a>
                @endif --}}
                @foreach($consumables_category_all as $data)
                    @if ($consumables_category_code == $data->consumables_category_code)
                    <a class="btn btn-success" href="{{ route('stock_list') }}/{{ $office_code }}/{{ $data->consumables_category_code }}" name="category_code_{{$data->consumables_category_code}}" id="category_code_{{$data->consumables_category_code}}">{{$data->consumables_category_name}}</a>
                    @else
                    <a class="btn btn-outline-success" href="{{ route('stock_list') }}/{{ $office_code }}/{{ $data->consumables_category_code }}" name="category_code_{{$data->consumables_category_code}}" id="category_code_{{$data->consumables_category_code}}">{{$data->consumables_category_name}}</a>
                    @endif
                @endforeach
            </div>
        </div>
        @endif
    </div>

</div>