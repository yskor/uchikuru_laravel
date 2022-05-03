<div class="mb-3 d-flex justify-content-center" id="category-area">
    <div class="input-group mb-1" style="width: 250px">
        <label class="input-group-text" for="category-selsect">カテゴリ</label>
        <select class="form-select" id="category-selsect" aria-label="Category select" onChange="location.href=value;">
            @foreach($consumables_category_all as $data)
                @if($consumables_category_code == $data->consumables_category_code)
                <option selected value="{{$data->consumables_category_code}}">{{$data->consumables_category_name}}</option>
                @else
                <option value="{{$data->consumables_category_code}}">{{$data->consumables_category_name}}</option>
                @endif
            @endforeach
        </select>
    </div>
</div>