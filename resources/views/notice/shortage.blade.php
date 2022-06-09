@if($stock_shortage_all->count() > 0)
<div class="accordion" id="accordion-notice-consumables-shortage">
    <div class="card">
        <div class="card-header">
            <a class="btn btn-link text-danger font-weight-bold" href="{{route('shortage_consumables')}}" target="_blank">
                在庫が少なくなっている消耗品が{{$stock_shortage_all->count()}}件あります！
            </a>
        </div>
    </div>
</div>
@endif