<!-- Button trigger modal -->
<button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#shipcancelModal{{$data->consumables_code}}">
    取消
</button>

<!-- Modal -->
<div class="modal fade" id="shipcancelModal{{$data->consumables_code}}" tabindex="-1" aria-labelledby="shipcancelModal{{$data->consumables_code}}Label" aria-hidden="true">
    <div class="modal-dialog">
        <form action="{{route('ship_cancel', ['office_code' => $office_code, 'ship_code' => $data->ship_code, 'consumables_code' => $data->consumables_code])}}" method="POST">
        @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="shipcancelModal{{$data->consumables_code}}Label">出荷を取り消しますか？</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="card">
                        <h4 class="card-header text-center">{{$data->consumables_name}}</h4>
                        <div class="d-flex justify-content-center card-body">
                            <img src="{{ asset('upload/consumables/'.$data->image_file_extension)}}" style="width:100px;height:100px;">
                            <div class="px-4 mt-2">
                                <div id="ship_number_result">
                                    @if($data->quantity == 1)
                                    <h5>出荷数：{{$data->shipped_number}}個</h5>
                                    @else
                                    <h5>出荷数：{{$data->shipped_number}}箱（{{$data->shipped_number*$data->quantity}}個）</h5>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">閉じる</button>
                    <button type="submit" class="btn btn-danger">取り消す</button>
                </div>
            </div>
        </form>
    </div>
</div>