<!-- フラッシュメッセージ -->
@if (session('message'))
<div class="card w-100 mb-3">
    <div class="card-header">
        <h5 class="w-100" id="ship_consumables_name">{{$consumables_stock->consumables_name}}を{{$consumption_quantity}}{{$consumption_use_unit}}消費しました</h5>
    </div>
    <div class="card-body d-flex">
        <div class="">
            <img src="{{ asset('upload/consumables/'.$consumables_stock->image_file_extension)}}" style="width:100px;height:100px;">
        </div>
        <div class="w-100 px-2">
            {{-- @if($consumption_unit_code) --}}
            {{-- @if($consumables->use_unit_code == 'N') --}}
            {{$consumables->use_unit_code}}
            <p>現在の在庫数は{{$consumables_stock_number}}箱と{{$consumables_stock_quantity}}個です</p>
            {{-- @elseif($consumption_unit_code == "N")
            <p>現在の在庫数は{{$consumables_stock_number}}箱です。</p> --}}
            {{-- @endif --}}
        </div>
    </div>
    
</div>
<div>
    <a class="btn btn-primary" href="{{route('consumption')}}">続けてQRコードを読み込む</a>
</div>
@endif