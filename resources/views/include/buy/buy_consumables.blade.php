<div class="card m-1 p-0" id="add_buy_{{$consumables_buy_data->consumables_barcode}}" style="width:350px;">
    <div class="card-header d-flex" style="background-color: rgba(0,0,0,.03)">
        <h5 class="w-100" id="buy_consumables_name">{{$consumables_buy_data->consumables_name}}</h5>
        <button type="button" class="btn-close" id="btn_remove_{{$consumables_buy_data->consumables_barcode}}"></button>
        <script>
            $( function() {
                var parent = $( "#buys" );
                var buy = parent.find( "#add_buy_{{$consumables_buy_data->consumables_barcode}}" );
                
                $( "#btn_remove_{{$consumables_buy_data->consumables_barcode}}" ).on( "click", function() {
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
            <input type="hidden" name="buys[{{$consumables_buy_data->consumables_barcode}}][consumables_code]"
                value="{{$consumables_buy_data->consumables_code}}">
            <input type="hidden" name="buys[{{$consumables_buy_data->consumables_barcode}}][consumables_barcode]"
                value="{{$consumables_buy_data->consumables_barcode}}">
            {{-- 職員コード --}}
            {{-- <input type="hidden" name="staff_code" value="{{$login->staff_code}}"> --}}

            {{-- <p class="" id="consumables_unit"><span><label
                        for="consumables_unit">個数:</label></span>{{$consumables_buy_data->number}}箱/段
            </p> --}}
            <label for="buy-number-form-group">仕入数 <span class="badge bg-danger">必須</span> </label>
            @if($consumables_buy_data->unit_code == 'B')
                {{-- unit-codeがBの時は単位を段 --}}
                <p class="text-danger mb-0">※段数を入力して下さい。</p>
            @elseif($consumables_buy_data->unit_code == 'N')
                {{-- unit-codeがNの時は単位を箱 --}}
                @if($consumables_buy_data->quantity == 1)
                {{-- 個数が１の場合は個数表示 --}}
                <p class="text-danger mb-0">※個数を入力して下さい。</p>
                @else
                <p class="text-danger mb-0">※箱数を入力して下さい。</p>
                @endif
            @elseif($consumables_buy_data->unit_code == 'Q')
                {{-- unit-codeがQの時は単位を個 --}}
                <p class="text-danger mb-0">※個数を入力して下さい。</p>
            @endif
            <div class="input-group" id="buy-quatity-form-group" style="width:100px;">
                {{-- 仕入数を入力する --}}
                <input type="buy_quantity" class="form-control"
                    name="buys[{{$consumables_buy_data->consumables_barcode}}][buy_quantity]"
                    id="buy_quantity_{{$consumables_buy_data->consumables_barcode}}" aria-describedby="buy_quantity_unit" required>
                @if($consumables_buy_data->unit_code == 'B')
                    {{-- unit-codeがBの時は単位を段 --}}
                    <span class="input-group-text" id="buy_unit">段</span>
                    <input type="hidden" name="buys[{{$consumables_buy_data->consumables_barcode}}][buy_unit_code]" value="B">
                @elseif($consumables_buy_data->unit_code == 'N')
                    {{-- unit-codeがNの時は単位を箱 --}}
                    <span class="input-group-text" id="buy_unit">@if($consumables_buy_data->quantity == 1) 個 @else 箱 @endif</span>
                    <input type="hidden" name="buys[{{$consumables_buy_data->consumables_barcode}}][buy_unit_code]" value="N">
                @elseif($consumables_buy_data->unit_code == 'Q')
                    {{-- unit-codeがQの時は単位を個 --}}
                    <span class="input-group-text" id="buy_unit">個</span>
                    <input type="hidden" name="buys[{{$consumables_buy_data->consumables_barcode}}][buy_unit_code]" value="Q">
                @endif
            </div>
            {{-- @if($consumables_buy_data->quantity != 1 && $consumables_buy_data->unit_code != 'Q') --}}
            {{-- 個数が1この場合は非表示 --}}
            <div>
                <p>仕入数内訳：<span id="buy_quantity_{{$consumables_buy_data->consumables_barcode}}_result"></span></p>
            </div>
            <script>
                var input = $('input#buy_quantity_{{$consumables_buy_data->consumables_barcode}}')
                var result = $('#buy_quantity_{{$consumables_buy_data->consumables_barcode}}_result')
                
                $(function() {
                    //テキストボックスに変更を加えたら発動
                    $('input#buy_quantity_{{$consumables_buy_data->consumables_barcode}}').change(function() {
                        //入力したvalue値を変数に格納
                        var unit_code = '{{$consumables_buy_data->unit_code}}'
                        var val = $(this).val();
                        console.log(quantity);
                        console.log(number);
                        console.log(val);
                        console.log(unit_code);
                        var quantity = Number({{$consumables_buy_data->quantity}})
                        var number = Number({{$consumables_buy_data->number}})
                        if(unit_code == 'Q') {
                            var text = `${val * quantity}個`
                        } else if(unit_code == 'B') {
                            var text = `${val*number}箱（${val * number * quantity}個`
                        } else if (quantity == 1) {
                            var text = `${val * quantity}個`
                        } else if (unit_code == 'N') {
                            var text = `${val}箱（${val * quantity}個）`
                        }

                        //選択したvalue値をp要素に出力
                        $('#buy_quantity_{{$consumables_buy_data->consumables_barcode}}_result').text(text);
                    });
                });
            </script>
            {{-- @endif --}}
        </div>
    </div>

</div>