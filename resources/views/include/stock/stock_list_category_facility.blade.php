<?php
if($office_code == 90 or $office_code == 91) {
    $outline = '';
} else {
    $outline = 'outline-';
}
?>
<div class="mb-3" id="search-carehome">
    <div class="mb-1" id="facility-area">
        <div class="input-group w-100">
            <label class="input-group-text">施設地域</label>
            @if($office_data->prefecture_code == 16 or $office_code == 91)
            {{-- 富山の施設を選択しているとき --}}
            <input type="radio" class="btn-check" name="search-carehome-facility-area"
                id="search-carehome-facility-area-富山" value="富山" checked>
            <label class="btn btn-outline-primary" for="search-carehome-facility-area-富山" style="width:80px">富山</label>
            <input type="radio" class="btn-check" name="search-carehome-facility-area"
                id="search-carehome-facility-area-石川" value="石川">
            <label class="btn btn-outline-danger" for="search-carehome-facility-area-石川" style="width:80px">石川</label>
            @elseif($office_data->prefecture_code == 17 and $office_code != 91)
            {{-- 石川の施設を選択しているとき --}}
            <input type="radio" class="btn-check" name="search-carehome-facility-area"
                id="search-carehome-facility-area-富山" value="富山">
            <label class="btn btn-outline-primary" for="search-carehome-facility-area-富山" style="width:80px">富山</label>
            <input type="radio" class="btn-check" name="search-carehome-facility-area"
                id="search-carehome-facility-area-石川" value="石川" checked>
            <label class="btn btn-outline-danger" for="search-carehome-facility-area-石川" style="width:80px">石川</label>
            @endif
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
        <div class="d-flex mb-2">
            @if($login->operation_type_code == 'LABO')
            <a class="btn btn-{{$outline}}secondary" style="width: 80px" href="{{route('facility_category_stock_list', ['office_code'=>90, 'consumables_category_code'=>$consumables_category_code])}}" id="search-carehome-facility-code-LABO">LABO</a>
            @else
            <a class="btn btn-{{$outline}}secondary" style="width: 80px" href="{{route('facility_category_stock_list', ['office_code'=>91, 'consumables_category_code'=>$consumables_category_code])}}" id="search-carehome-facility-code-本部">本部</a>
            @endif
            {{-- 富山の施設を選択した場合 --}}
            @if($office_data->prefecture_code == 16 or $office_code == 91)
            <div class="input-group w-100" id="toyama-area">
            @else
            <div class="input-group w-100" id="toyama-area" style="display: none">
            @endif
                @foreach ($facility_all as $facility)
                @if ($office_code == $facility->office_code and $facility->prefecture_code == 16)
                <a class="btn btn-primary"
                    href="{{route('stock_list')}}/{{ $facility->office_code }}/{{ $consumables_category_code }}"
                    href="{{route('facility_category_stock_list', ['office_code' => $facility->office_code, 'consumables_category_code'=>$consumables_category_code]) }}"
                    id="search-carehome-facility-code-{{ $facility->facility_name }}" style="width: 80px">{{
                    $facility->facility_name }}</a>
                @elseif ($facility->prefecture_code == 16)
                <a class="btn btn-outline-primary"
                    href="{{route('stock_list')}}/{{ $facility->office_code }}/{{ $consumables_category_code }}"
                    href="{{route('facility_category_stock_list', ['office_code' => $facility->office_code, 'consumables_category_code'=>$consumables_category_code]) }}"
                    id="search-carehome-facility-code-{{ $facility->facility_name }}" style="width: 80px">{{
                    $facility->facility_name }}</a>
                @endif
                @endforeach
            </div>

            {{-- 石川の施設を選択した場合 --}}
            @if($office_data->prefecture_code == 17 and $office_code != 91)
            <div class="input-group w-100" id="ishikawa-area">
            @else
            <div class="input-group w-100" id="ishikawa-area" style="display: none">
            @endif
                @foreach ($facility_all as $facility)
                @if ($office_code == $facility->office_code and $facility->prefecture_code == 17)
                <a class="btn btn-danger"
                    href="{{route('stock_list')}}/{{ $facility->office_code }}/{{ $consumables_category_code }}"
                    id="search-carehome-facility-code-{{ $facility->facility_name }}" style="width: 80px">{{
                    $facility->facility_name }}</a>
                @elseif ($facility->prefecture_code == 17 and $facility->office_code == 50)
                @elseif ($facility->prefecture_code == 17 and $facility->office_code == 51)
                @elseif ($facility->prefecture_code == 17)
                <a class="btn btn-outline-danger"
                    href="{{route('stock_list')}}/{{ $facility->office_code }}/{{ $consumables_category_code }}"
                    id="search-carehome-facility-code-{{ $facility->facility_name }}" style="width: 80px">{{
                    $facility->facility_name }}</a>
                @endif
                @endforeach
            </div>
        </div>
        <div class="mb-3" id="category-area">
            <div class="input-group w-100 mb-1">
                <label class="input-group-text">カテゴリ</label>
            </div>
            <div class="" id="categories">
                @foreach($consumables_category_list as $data)
                @if ($consumables_category_code == $data->consumables_category_code)
                <a class="btn btn-success"
                    href="{{ route('stock_list') }}/{{ $office_code }}/{{ $data->consumables_category_code }}"
                    name="category_code_{{$data->consumables_category_code}}"
                    id="category_code_{{$data->consumables_category_code}}">{{$data->consumables_category_name}}</a>
                @else
                <a class="btn btn-outline-success"
                    href="{{ route('stock_list') }}/{{ $office_code }}/{{ $data->consumables_category_code }}"
                    name="category_code_{{$data->consumables_category_code}}"
                    id="category_code_{{$data->consumables_category_code}}">{{$data->consumables_category_name}}</a>
                @endif
                @endforeach
            </div>
        </div>
        <div class="mt-2">
            <div class="input-group">
                <form class="d-flex" action="{{ route('facility_category_stock_list_search', ['office_code' => $office_code, 'consumables_category_code' => $consumables_category_code])}}" method="get">
                    @csrf
                    <div class="form-outline" style="">
                        <input type="search" id="keyword" name="keyword" class="form-control" placeholder="キーワード(消耗品の名前)" value="{{$search_name}}">
                    </div>
                    <button type="submit" class="btn btn-primary" id="btn-search">
                        <svg class="svg-inline--fa fa-search fa-w-16 fa-fw" aria-hidden="true" focusable="false"
                            data-prefix="fas" data-icon="search" role="img" xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 512 512" data-fa-i2svg="">
                            <path fill="currentColor"
                                d="M505 442.7L405.3 343c-4.5-4.5-10.6-7-17-7H372c27.6-35.3 44-79.7 44-128C416 93.1 322.9 0 208 0S0 93.1 0 208s93.1 208 208 208c48.3 0 92.7-16.4 128-44v16.3c0 6.4 2.5 12.5 7 17l99.7 99.7c9.4 9.4 24.6 9.4 33.9 0l28.3-28.3c9.4-9.4 9.4-24.6.1-34zM208 336c-70.7 0-128-57.2-128-128 0-70.7 57.2-128 128-128 70.7 0 128 57.2 128 128 0 70.7-57.2 128-128 128z">
                            </path>
                        </svg>検索
                    </button>
                </form>
            </div>
        </div>
    </div>