@if($shortage_list->count() > 0)
<div class="accordion" id="accordion-notice-consumables-shortage">
    <div class="card">
        <div class="card-header">
            <button class="btn btn-link text-danger font-weight-bold" type="button" data-toggle="collapse"
                data-target="#notice-consumables-shortage-list" aria-expanded="true" aria-controls="list">
                在庫が不足している消耗品が{{$shortage_list->count()}}件あります！
            </button>
        </div>
        <div id="notice-consumables-shortage-list" class="collapse" aria-labelledby="notice-consumables-shortage-list" data-parent="#accordion-notice-consumables-shortage">
            <div class="card-body">
                @foreach($shortage_list as $data)
                <div class="mb-3">
                    <a class="btn btn-outline-danger text-left w-100" href="{{route('shortage_consumables', ['office_code' => $data->office_code, 'consumables_category_code' => $data->consumables_category_code, 'consumables_code' => $data->consumables_code])}}" target="_blank">
                        【{{$data->facility_name}}】{{$data->consumables_name}}(在庫数:{{$data->stock_number}}箱+{{$data->stock_quantity}}個)
                    </a>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endif