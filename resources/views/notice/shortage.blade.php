@if($shortage_list->count() > 0)
<div class="accordion" id="accordion-notice-consumables-shortage">
    <div class="card">
        <div class="card-header">
            {{-- <button class="btn btn-link text-danger font-weight-bold" type="button" data-toggle="collapse"
                data-target="#notice-consumables-shortage-list" aria-expanded="true" aria-controls="list">
                在庫が不足している消耗品が{{$shortage_list->count()}}件あります！
            </button> --}}
            <a class="btn btn-link text-danger font-weight-bold" href="{{route('shortage_consumables')}}" target="_blank">
                在庫が不足している消耗品が{{$shortage_list->count()}}件あります！
            </a>
        </div>
    </div>
</div>
@endif