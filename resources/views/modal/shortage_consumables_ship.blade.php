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
                    <div class="card">
                        <h4 class="card-header">【{{$data->facility_name}}】{{$data->consumables_name}}</h4>
                        <div class="card-body d-flex py-2">
                            <img src="{{ asset('upload/consumables/'.$data->image_file_extension)}}" style="width:100px;height:100px;">
                            <div class="mx-auto fs-5" style="width:250px;">
                                <div class="mb-1">在庫定数　：{{$data->stock_constant_quantity}}
                                    @if($data->quantity == 1) 個 @else 箱 @endif
                                </div>
                                <div class="mb-1">施設在庫数：{{$data->stock_number}}
                                    @if($data->quantity == 1) 個 @else 箱 @endif
                                </div>
                                @if($data->total_shipped_number)
								<div class="">
									出荷済数　：
									{{ $data->total_shipped_number}}
									@if($data->quantity == 1)個 @else 箱@endif
								</div>
								@endif
                                <div class="input-group mt-2 fs-5" id="head-stock-form-group">
                                    {{-- 定数に対して不足する数出荷 --}}
                                    <span class="input-group-text"
                                        id="number_unit">出荷数：</span>
                                    <input type="number" class="form-control text-end" name="ship_quantity"
                                        id="ship_quantity" aria-describedby="number-unit" value="{{ $data->shortage_quantity}}">
                                    <span class="input-group-text"
                                        id="number_unit">
                                        @if($data->quantity == 1) 個 @else 箱 @endif
                                    </span>
                                </div>
                                @if($data->quantity != 1)
                                <p class="fs-6 text-end">内訳：{{ $data->shortage_quantity}}箱（{{ $data->shortage_quantity * $data->quantity}}個）</p>
                                @endif
                            </div>
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