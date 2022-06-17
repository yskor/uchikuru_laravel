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
            href="{{route('master_list_category', ['consumables_category_code' => $data->consumables_category_code])}}"
            name="category_code_{{$data->consumables_category_code}}"
            id="category_code_{{$data->consumables_category_code}}">{{$data->consumables_category_name}}</a>
        @else
        <a class="btn btn-outline-success"
            href="{{ route('master_list_category', ['consumables_category_code' => $data->consumables_category_code])}}"
            name="category_code_{{$data->consumables_category_code}}"
            id="category_code_{{$data->consumables_category_code}}">{{$data->consumables_category_name}}</a>
        @endif
        @endforeach
    </div>
    <div class="mt-2">
        <div class="input-group">
            <form class="d-flex" action="{{ route('master_list_search', ['consumables_category_code' => $consumables_category_code])}}" method="get">
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