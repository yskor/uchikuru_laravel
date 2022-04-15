<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#consumablesBuyModal" hidden>
</button>

<!-- Modal -->
<div class="modal fade" id="consumablesBuyModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('edit_master') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="modal-title">仕入れ</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <div id="data" style="">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <th>消耗品コード</th>
                                    <td>{{$consumables_buy_data->consumables_barcode}}</td>
                                </tr>
                                <tr>
                                    <th>消耗品</th>
                                    <td>{{$consumables_buy_data->consumables_name}}</td>
                                </tr>
                                <tr>
                                    <th>入数/個数</th>
                                    <td>{{$consumables_buy_data->quantity}}{{$consumables_buy_data->quantity_unit}}/{{$consumables_buy_data->number}}{{$consumables_buy_data->number_unit}}</td>
                                </tr>
                            </tbody>
                        </table>


                    </div>

                    <div class="form-group" id="buy-number-form-group">
                        <label for="buy-number">仕入れ数 <span class="badge bg-danger">必須</span> </label>
                        <input type="number" class="form-control" id="buy-number"><span>${number_unit}<span>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" id="btn-close" data-bs-dismiss="modal">閉じる</button>
                    <button type="button" class="btn btn-primary" id="btn-do"><svg
                            class="svg-inline--fa fa-plus fa-w-14 fa-fw" aria-hidden="true" focusable="false"
                            data-prefix="fas" data-icon="plus" role="img" xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 448 512" data-fa-i2svg="">
                            <path fill="currentColor"
                                d="M416 208H272V64c0-17.67-14.33-32-32-32h-32c-17.67 0-32 14.33-32 32v144H32c-17.67 0-32 14.33-32 32v32c0 17.67 14.33 32 32 32h144v144c0 17.67 14.33 32 32 32h32c17.67 0 32-14.33 32-32V304h144c17.67 0 32-14.33 32-32v-32c0-17.67-14.33-32-32-32z">
                            </path>
                        </svg><!-- <i class="fas fa-plus fa-fw"></i> Font Awesome fontawesome.com -->仕入れ</button>

                </div>
            </form>
        </div>
    </div>
</div>