<!-- Button trigger modal -->
<button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#stockModal_{{$data->consumables_code}}">
    在庫調整
</button>

<!-- Modal -->
<div class="modal fade" id="stockModal_{{$data->consumables_code}}" tabindex="-1" aria-labelledby="stockModal_{{$data->consumables_code}}Label" aria-hidden="true">
    <div class="modal-dialog">
        <form action="{{route('stock_adjustment', ['office_code' => $office_code, 'consumables_category_code' => $consumables_category_code, 'consumables_code' => $data->consumables_code])}}" method="POST">
        @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="stockModal_{{$data->consumables_code}}Label">在庫調整</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h4 class="text-center">{{$data->consumables_name}}</h4>
                    <div class="d-flex justify-content-center py-3">
                        <img src="{{ asset('upload/consumables/'.$data->image_file_extension)}}" style="width:200px;height:200px;">
                    </div>
                    <div class="mx-auto" style="width:250px;">
                        <p class="mb-0" for="head-stock-form-group">在庫数</p>
                        <div class="input-group mb-2" id="head-stock-form-group">
                            {{-- 在庫数を入力する --}}
                            @if($data->stock_number > 0)
                            <input type="number" class="form-control text-end" name="stock_number"
                                id="stock_number" aria-describedby="number-unit" value="{{$data->stock_number}}">
                            @else
                            <input type="number" class="form-control text-end" name="stock_number"
                                id="stock_number" aria-describedby="number-unit" value="0">
                            @endif
                            <span class="input-group-text"
                                id="number_unit">箱</span>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">閉じる</button>
                    <button type="submit" class="btn btn-danger">調整する</button>
                </div>
            </div>
        </form>
    </div>
</div>