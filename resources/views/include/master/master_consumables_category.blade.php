<div class="mb-3" id="search-carehome">
    <div class="mb-1" id="category-area">
        <div class="input-group w-100">
            <label class="input-group-text">カテゴリ</label>
        </div>

    </div>
    <div id="categories">
            @foreach($consumables_category_all as $data)
                @if ($consumables_category_code == $data->consumables_category_code)
                <a class="btn btn-success" href="{{route('master_list_category', ['consumables_category_code' => $data->consumables_category_code])}}" name="category_code_{{$data->consumables_category_code}}" id="category_code_{{$data->consumables_category_code}}">{{$data->consumables_category_name}}</a>
                @else
                <a class="btn btn-outline-success" href="{{ route('master_list_category', ['consumables_category_code' => $data->consumables_category_code])}}" name="category_code_{{$data->consumables_category_code}}" id="category_code_{{$data->consumables_category_code}}">{{$data->consumables_category_name}}</a>
                @endif
            @endforeach
    </div>
</div>