<div class="mb-3">

    <div class="mb-3" id="search-carehome">
        <div class="mb-1" id="category-area">
            <div class="input-group w-100">
                <label class="input-group-text">カテゴリ</label>
            </div>

        </div>
        <div id="categories">
            <div class="w-100">
                @foreach($consumables_category_all as $data)
                @if ($consumables_category_code == $data->consumables_category_code)
                <a class="btn btn-success"
                    href="{{ route('buy_list_category', ['consumables_category_code' => $data->consumables_category_code])}}"
                    name="category_code_{{$data->consumables_category_code}}"
                    id="category_code_{{$data->consumables_category_code}}">{{$data->consumables_category_name}}</a>
                @elseif($data->consumables_category_code == 8 or $data->consumables_category_code == 9 or
                $data->consumables_category_code == 10)
                {{-- LABOのカテゴリは非表示 --}}
                @else
                <a class="btn btn-outline-success"
                    href="{{ route('buy_list_category', ['consumables_category_code' => $data->consumables_category_code])}}"
                    name="category_code_{{$data->consumables_category_code}}"
                    id="category_code_{{$data->consumables_category_code}}">{{$data->consumables_category_name}}</a>
                @endif
                @endforeach
            </div>

        </div>
    </div>

</div>