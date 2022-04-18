<!-- Button trigger modal -->
{{-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#consumablesBuyModal">
</button> --}}

<!-- Modal -->
<div class="modal fade" id="consumablesShipModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="modal-title">出荷する消耗品</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    
                </div>
                <div class="modal-body">
                        <div class="input-group mb-2" id="ship-office-form-group">
                            <label class="input-group-text" for="ship_office">出荷先</label>
                            <select class="form-control" name="ship_office" id="ship_office" required>
                                <option value="" selected=""></option>
                                @foreach ($facility_all as $facility)
                                <option value="{{$facility->office_code}}">{{$facility->facility_name}}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        <table class="table table-striped">
                            <tbody id="ships">
                                <div class="card" id="add_ship_{{$consumables_ship_data->consumables_name}}">
                                    <div class="card-header d-flex">
                                        <h5 class="w-100" id="ship_consumables_name">{{$consumables_ship_data->consumables_name}}</h5>
                                        <button type="button" class="btn-close" id="btn_remove"></button>
                                    </div>
                                    <tr>
                                        <td>
                                            
                                            <div><img
                                                    src="{{ asset('upload/consumables/'.$consumables_ship_data->image_file_extension)}}"
                                                    style="width:100px;height:100px;"></div>
                                        </td>
                                        <td>
                                            <table class="table">
                                                <tbody>
                                                    <tr>
                                                        <th>入数/個数</th>
                                                        <td>{{$consumables_ship_data->quantity}}{{$consumables_ship_data->quantity_unit}}/{{$consumables_ship_data->number_unit}}
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th>出荷数 <span class="badge bg-danger">必須</span> </th>
                                                        <td>
                                                            <div class="input-group" id="ship-quantity-form-group">
                                                                <input type="number" class="form-control" name="ship_quantity"
                                                                    id="ship_quantity" aria-describedby="number-unit" required>
                                                                <span class="input-group-text"
                                                                    id="number_unit">{{$consumables_ship_data->number_unit}}</span>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th>出荷予定日 <span class="badge bg-danger">必須</span> </th>
                                                        <td>
                                                            <div class="form-group" id="ship-office-form-group">
                                                                <input class="form-control" type="date" name="ship_date" id="ship_date">
                                                            </div>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </td>
                                    </tr>
                                    <script>
                                        $( function() {
                                            uk_notify_success( "定期薬(夕食後)が追加されました。" );
                                            
                                            var parent = $( "#ships" );
                                            var tr = parent.find( "#add_ship_{{$consumables_ship_data->consumables_code}}" );
                                            
                                            tr.find( "#btn-remove" ).on( "click", function() {
                                                $(this).remove();
                                            });
                                            
                                            tr.on( "ajax-done", function( event, result, param ) {
                                                $(this).remove();
                                                parent.trigger( "removed", param.row_number );
                                                if( result.reload_message ) {
                                                    uk_notify_info( result.reload_message );
                                                    setTimeout( function() {
                                                        location.reload();
                                                    }, 3000 );
                                                }
                                            });
                                        });
                                    </script>
                                </div>
                            </tbody>
                        </table>
                    </div>

                    {{-- <div class="form-group" id="buy-number-form-group">
                        <label for="buy-number">仕入れ数 <span class="badge bg-danger">必須</span> </label>
                        <input type="number" class="form-control"
                            id="buy-number"><span>{{$consumables_ship_data->number_unit}}<span>
                    </div> --}}

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" id="btn-close" data-bs-dismiss="modal">閉じる</button>
                        <button type="submit" class="btn btn-primary" id="btn-do">出荷を予定する</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
