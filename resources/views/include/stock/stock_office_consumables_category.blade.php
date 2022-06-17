<div class="card mb-3" id="search">
    <h6 class="card-header">カテゴリ</h6>
    <div class="card-body">
        <div class="mb-3">
            @if ($consumables_category_code == 'all')
            <a class="btn btn-success" href="{{ route('office_stock_list') }}" name="category_code_all" id="category_code_all">全て</a>
            @else
            <a class="btn btn-outline-success" href="{{ route('office_stock_list') }}" name="category_code_all" id="category_code_all">全て</a>
            @endif
            @foreach($consumables_category_list as $data)
                @if ($consumables_category_code == $data->consumables_category_code)
                <a class="btn btn-success" href="{{ route('office_stock_list') }}/{{ $data->consumables_category_code }}" name="category_code_{{$data->consumables_category_code}}" id="category_code_{{$data->consumables_category_code}}">{{$data->consumables_category_name}}</a>
                @else
                <a class="btn btn-outline-success" href="{{ route('office_stock_list') }}/{{ $data->consumables_category_code }}" name="category_code_{{$data->consumables_category_code}}" id="category_code_{{$data->consumables_category_code}}">{{$data->consumables_category_name}}</a>
                @endif
            @endforeach
        </div>
    </div>
</div>