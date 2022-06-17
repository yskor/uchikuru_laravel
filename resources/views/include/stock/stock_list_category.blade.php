<div class="mb-3" id="search-carehome">
    <div class="mb-1" id="facility-area">
        <div class="input-group w-100">
            <label class="input-group-text">施設地域</label>
            <input type="radio" class="btn-check" name="search-carehome-facility-area"
                id="search-carehome-facility-area-富山" value="富山" checked>
            <label class="btn btn-outline-primary" for="search-carehome-facility-area-富山"
                style="width:80px">富山</label>
            <input type="radio" class="btn-check" name="search-carehome-facility-area"
                id="search-carehome-facility-area-石川" value="石川">
            <label class="btn btn-outline-danger" for="search-carehome-facility-area-石川"
                style="width:80px">石川</label>
        </div>

        <script>
            $( function() {
                var parent = $( "#search-carehome" ).find( "#facility-area" );
                var toyama = $('#toyama-area')
                var ishikawa = $('#ishikawa-area')
                
                parent.find( "input[name=search-carehome-facility-area]" ).click(function() {
                    if ($('input[name=search-carehome-facility-area]:eq(0)').prop('checked')) {
                        $('input[name=search-carehome-facility-area]:eq(0)').prop('checked', true);
                        console.log('富山を選択')
                        toyama.show();
                        ishikawa.hide();
                    } else {
                        $('input[name=search-carehome-facility-area]:eq(1)').prop('checked', true);
                        console.log('石川を選択')
                        ishikawa.show();
                        toyama.hide();
                    }
                });
            });

        </script>
    </div>
    <div id="facilitys">
        <div class="d-flex">
            <a class="btn btn-outline-secondary" style="width: 80px" href="{{route('facility_category_stock_list', ['office_code'=>$office_code, 'consumables_category_code'=>$consumables_category_code])}}" id="search-carehome-facility-code-{{$login->operation_type_code}}">
                @if($login->operation_type_code == 'LABO')LABO @else 本部 @endif
            </a>
            <div class="input-group w-100" id="toyama-area">
                @if($login->operation_type_code == 'LABO')
                    @foreach ($facility_all as $facility)
                        @if ($office_code == $facility->office_code and $facility->prefecture_code == 16)
                        <a class="btn btn-primary" style="width: 80px" href="{{route('facility_category_stock_list', ['office_code'=>$facility->office_code, 'consumables_category_code'=>$consumables_category_code])}}" id="search-carehome-facility-code-{{ $facility->facility_name }}">{{ $facility->facility_name }}</a>
                        @elseif ($facility->prefecture_code == 16)
                        <a class="btn btn-outline-primary" style="width: 80px" href="{{route('facility_category_stock_list', ['office_code'=>$facility->office_code, 'consumables_category_code'=>$consumables_category_code])}}" id="search-carehome-facility-code-{{ $facility->facility_name }}">{{ $facility->facility_name }}</a>
                        @endif
                    @endforeach
                @else
                    @foreach ($facility_all as $facility)
                        @if ($office_code == $facility->office_code and $facility->prefecture_code == 16)
                        <a class="btn btn-primary" style="width: 80px" href="{{route('facility_category_stock_list', ['office_code'=>$facility->office_code, 'consumables_category_code'=>$consumables_category_code])}}" id="search-carehome-facility-code-{{ $facility->facility_name }}">{{ $facility->facility_name }}</a>
                        @elseif ($facility->prefecture_code == 16)
                        <a class="btn btn-outline-primary" style="width: 80px" href="{{route('facility_category_stock_list', ['office_code'=>$facility->office_code, 'consumables_category_code'=>$consumables_category_code])}}" id="search-carehome-facility-code-{{ $facility->facility_name }}">{{ $facility->facility_name }}</a>
                        @endif
                    @endforeach
                @endif
            </div>
            <div class="input-group w-100" id="ishikawa-area" style="display: none">
                @if($login->operation_type_code == 'LABO')
                    @foreach ($facility_all as $facility)
                        @if ($office_code == $facility->office_code and $facility->prefecture_code == 17)
                        <a class="btn btn-danger" href="{{route('facility_category_stock_list', ['office_code'=>$facility->office_code, 'consumables_category_code'=>$consumables_category_code])}}" id="search-carehome-facility-code-{{ $facility->facility_name }}" style="width: 80px">{{ $facility->facility_name }}</a>
                        @elseif ($facility->prefecture_code == 17 and $facility->office_code == 50)
                        @elseif ($facility->prefecture_code == 17 and $facility->office_code == 51)
                        @elseif ($facility->prefecture_code == 17)
                        <a class="btn btn-outline-danger" href="{{route('facility_category_stock_list', ['office_code'=>$facility->office_code, 'consumables_category_code'=>$consumables_category_code])}}" id="search-carehome-facility-code-{{ $facility->facility_name }}" style="width: 80px">{{ $facility->facility_name }}</a>
                        @endif
                    @endforeach
                @else
                    @foreach ($facility_all as $facility)
                        @if ($office_code == $facility->office_code and $facility->prefecture_code == 17)
                        <a class="btn btn-danger" href="{{route('facility_category_stock_list', ['office_code'=>$facility->office_code, 'consumables_category_code'=>$consumables_category_code])}}" id="search-carehome-facility-code-{{ $facility->facility_name }}" style="width: 80px">{{ $facility->facility_name }}</a>
                        @elseif ($facility->prefecture_code == 17 and $facility->office_code == 50)
                        @elseif ($facility->prefecture_code == 17 and $facility->office_code == 51)
                        @elseif ($facility->prefecture_code == 17)
                        <a class="btn btn-outline-danger" href="{{route('facility_category_stock_list', ['office_code'=>$facility->office_code, 'consumables_category_code'=>$consumables_category_code])}}" id="search-carehome-facility-code-{{ $facility->facility_name }}" style="width: 80px">{{ $facility->facility_name }}</a>
                        @endif
                    @endforeach
                @endif
            </div>
        </div>
    </div>
</div>