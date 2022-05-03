<div class="card m-1 p-0" id="add_buy_{{$consumables_buy_data->consumables_code}}" style="width:350px;">
    <div class="card-header d-flex" style="background-color: rgba(0,0,0,.03)">
        <h5 class="w-100" id="buy_consumables_name">{{$consumables_buy_data->consumables_name}}</h5>
        <button type="button" class="btn-close" id="btn_remove_{{$consumables_buy_data->consumables_code}}"></button>
        <script>
            $( function() {
                var parent = $( "#buys" );
                var buy = parent.find( "#add_buy_{{$consumables_buy_data->consumables_code}}" );
                
                $( "#btn_remove_{{$consumables_buy_data->consumables_code}}" ).on( "click", function() {
                    buy.remove();
                });
                
            });
        </script>
    </div>
    <div class="card-body d-flex">
        <div class="">
            <img src="{{ asset('upload/consumables/'.$consumables_buy_data->image_file_extension)}}"
                style="width:100px;height:100px;">
        </div>
        <div class="w-100 px-2">
            {{-- 消耗品コード --}}
            <input type="hidden" name="buys[{{$consumables_buy_data->consumables_code}}][consumables_code]"
                value="{{$consumables_buy_data->consumables_code}}">
            {{-- 職員コード --}}
            <input type="hidden" name="staff_code" value="{{$login->staff_code}}">

            {{-- <p class="" id="consumables_unit"><span><label
                        for="consumables_unit">個数:</label></span>{{$consumables_buy_data->number}}箱/段
            </p> --}}
            <label for="buy-number-form-group">仕入数 <span class="badge bg-danger">必須</span> </label>
            <div class="input-group" id="buy-number-form-group" style="width:100px;">
                {{-- 仕入数を入力する --}}
                <input type="number" class="form-control"
                    name="buys[{{$consumables_buy_data->consumables_code}}][buy_number]"
                    id="buy_number_{{$consumables_buy_data->consumables_code}}" aria-describedby="number-unit" required>
                <span class="input-group-text" id="number_unit">段</span>
            </div>
            <label for="buy-number-form-group">仕入単価（税込） <span class="badge bg-danger">必須</span> </label>
            <div class="input-group" id="buy-number-form-group" style="width:200px;">
                {{-- 仕入数を入力する --}}
                <input type="number" class="form-control"
                    name="buys[{{$consumables_buy_data->consumables_code}}][buy_price]"
                    id="buy_number_{{$consumables_buy_data->consumables_code}}" aria-describedby="number-unit" required>
                <span class="input-group-text" id="number_unit">円</span>
            </div>
        </div>
    </div>

</div>