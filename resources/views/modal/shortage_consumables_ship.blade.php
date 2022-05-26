<!-- Button trigger modal -->
<button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#shipModal_{{$data->consumables_code}}">
    出荷処理
</button>

<!-- Modal -->
<div class="modal fade" id="shipModal_{{$data->consumables_code}}" tabindex="-1" aria-labelledby="shipModal_{{$data->consumables_code}}Label" aria-hidden="true">
    <div class="modal-dialog">
        <form action="{{route('ship_shortage_consumables', ['office_code' => $data->office_code, 'consumables_code' => $data->consumables_code])}}" method="POST">
        @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="stockModal_{{$data->consumables_code}}Label">出荷処理</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h4 class="text-center">{{$data->consumables_name}}</h4>
                    <div class="d-flex justify-content-center py-3">
                        <img src="{{ asset('upload/consumables/'.$data->image_file_extension)}}" style="width:200px;height:200px;">
                    </div>
                    <div class="mx-auto" style="width:250px;">
                        <div>施設在庫数：{{$data->stock_number}}箱</div>
                        <div>在庫定数　：{{$data->stock_constant_quantity}}箱</div>
                        <p class="mb-0" for="head-stock-form-group">出荷数</p>
                        <div class="input-group mb-2" id="head-stock-form-group">
                            {{-- 定数に対して不足する数出荷 --}}
                            <input type="number" class="form-control text-end" name="ship_quantity"
                                id="ship_quantity" aria-describedby="number-unit" value="{{ $data->shortage_quantity}}">
                            <span class="input-group-text"
                                id="number_unit">箱</span>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">閉じる</button>
                    <button type="submit" class="btn btn-primary">出荷する</button>
                </div>
            </div>
        </form>
    </div>
</div>