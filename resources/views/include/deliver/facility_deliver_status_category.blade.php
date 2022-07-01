<div class="mb-3" id="search-carehome">
    <div class="mb-1" id="category-area">
        <div class="input-group w-100">
            <label class="input-group-text">カテゴリ</label>
        </div>
    </div>
    <div id="categories">
        @foreach($consumables_category_list as $data)
        @if ($consumables_category_code == $data->consumables_category_code)
        <a class="btn btn-success"
            href="{{route('facility_deliver_status', ['consumables_category_code' => $data->consumables_category_code, 'office_code'=>$office_data->office_code])}}"
            name="category_code_{{$data->consumables_category_code}}"
            id="category_code_{{$data->consumables_category_code}}">{{$data->consumables_category_name}}</a>
        @else
        <a class="btn btn-outline-success"
            href="{{ route('facility_deliver_status', ['consumables_category_code' => $data->consumables_category_code, 'office_code'=>$office_data->office_code])}}"
            name="category_code_{{$data->consumables_category_code}}"
            id="category_code_{{$data->consumables_category_code}}">{{$data->consumables_category_name}}</a>
        @endif
        @endforeach
    </div>
</div>
<div class="mb-3" id="search-carehome">
    <div class="mb-1" id="facility-area">
        <div class="input-group w-100">
            <label class="input-group-text">施設地域</label>
            @if($office_data->prefecture_code == 16 or $office_code == 90)
            <input type="radio" class="btn-check" name="search-carehome-facility-area"
                id="search-carehome-facility-area-富山" value="富山" checked>
            <label class="btn btn-outline-primary" for="search-carehome-facility-area-富山" style="width:80px">富山</label>
            <input type="radio" class="btn-check" name="search-carehome-facility-area"
                id="search-carehome-facility-area-石川" value="石川">
            <label class="btn btn-outline-danger" for="search-carehome-facility-area-石川" style="width:80px">石川</label>
            @elseif($office_data->prefecture_code == 17 or $office_code == 90)
            <input type="radio" class="btn-check" name="search-carehome-facility-area"
                id="search-carehome-facility-area-富山" value="富山">
            <label class="btn btn-outline-primary" for="search-carehome-facility-area-富山" style="width:80px">富山</label>
            <input type="radio" class="btn-check" name="search-carehome-facility-area"
                id="search-carehome-facility-area-石川" value="石川" checked>
            <label class="btn btn-outline-danger" for="search-carehome-facility-area-石川" style="width:80px">石川</label>
            @endif
        </div>

    </div>
        <script>
            $( function() {
                var parent = $( "#search-carehome" );
                var toyama = $('#toyama-area')
                var ishikawa = $('#ishikawa-area')
                
                $( "input[name=search-carehome-facility-area]" ).click(function() {
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
    <div id="facilitys">
        <div class="d-flex">
            @if($office_code == 'all')
            <a class="btn btn-secondary" style="width: 80px"
                href="{{route('deliver_status', ['consumables_category_code'=>$consumables_category_code])}}"
                id="search-carehome-facility-code-{{$login->operation_type_code}}">
                全て
            </a>
            @else
            <a class="btn btn-outline-secondary" style="width: 80px"
                href="{{route('deliver_status', ['consumables_category_code'=>$consumables_category_code])}}"
                id="search-carehome-facility-code-{{$login->operation_type_code}}">
                全て
            </a>
            @endif
            @if($office_data->prefecture_code == 16 or $office_code == 90)
            <div class="input-group w-100" id="toyama-area">
            @else
            <div class="input-group w-100" id="toyama-area" style="display: none">
            @endif
                @foreach ($facility_list as $facility)
                    @if ($office_code == $facility->office_code and $facility->prefecture_code == 16)
                    <a class="btn btn-primary" style="width: 80px"
                        href="{{route('facility_deliver_status', ['consumables_category_code'=>$consumables_category_code, 'office_code'=>$facility->office_code])}}"
                        id="search-carehome-facility-code-{{ $facility->facility_name }}">{{ $facility->facility_name }}</a>
                    @elseif ($facility->prefecture_code == 16)
                    <a class="btn btn-outline-primary" style="width: 80px"
                        href="{{route('facility_deliver_status', ['consumables_category_code'=>$consumables_category_code, 'office_code'=>$facility->office_code])}}"
                        id="search-carehome-facility-code-{{ $facility->facility_name }}">{{ $facility->facility_name }}</a>
                    @endif
                @endforeach
            </div>
            @if($office_data->prefecture_code == 17 or $office_code == 90)
            <div class="input-group w-100" id="ishikawa-area">
            @else
            <div class="input-group w-100" id="ishikawa-area" style="display: none">
            @endif
                @foreach ($facility_list as $facility)
                    @if ($office_code == $facility->office_code and $facility->prefecture_code == 17)
                        <a class="btn btn-danger"
                            href="{{route('facility_deliver_status', ['consumables_category_code'=>$consumables_category_code, 'office_code'=>$facility->office_code])}}"
                            id="search-carehome-facility-code-{{ $facility->facility_name }}" style="width: 80px">{{
                            $facility->facility_name }}</a>
                    @elseif ($facility->prefecture_code == 17)
                        <a class="btn btn-outline-danger"
                            href="{{route('facility_deliver_status', ['consumables_category_code'=>$consumables_category_code, 'office_code'=>$facility->office_code])}}"
                            id="search-carehome-facility-code-{{ $facility->facility_name }}" style="width: 80px">{{
                            $facility->facility_name }}</a>
                    @endif
                @endforeach
            </div>
        </div>
    </div>
</div>