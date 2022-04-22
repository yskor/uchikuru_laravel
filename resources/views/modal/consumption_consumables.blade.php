<div style="max-width: 425px">
    <form action="{{ route('consumption_done') }}" method="POST">
        @csrf
        <table class="table">
            <tbody>
                <tr>
                    <th>消耗品</th>
                    <td>
                        {{$consumables_stock->consumables_name}}
                    </td>
                </tr>
                <tr>
                    <img src="{{asset('upload/consumables/'.$consumables_stock->image_file_extension)}}" width="100px">
                </tr>
                <tr>
                    <th>施設在庫数</th>
                    <td>{{$consumables_stock->stock_number}}{{$consumables_stock->number_unit}}と{{$consumables_stock->stock_quantity}}{{$consumables_stock->quantity_unit}}</td>
                </tr>
                <tr>
                
                    <th><label for="consumables-quantity">消費数 <span class="badge bg-danger">必須</span> </label></th>
                    <td>
                        @if ($consumables->can_use_multiple)
                        {{-- can_use_multipleが可の時 --}}
                        <input type="number" class="form-control" id="consumption-quantity" name="consumption_quantity" value="" placeholder="使用数量を入力して下さい">
                        @else
                        {{-- can_use_multipleが不可の時 --}}
                        <input type="number" class="form-control" id="consumption-quantity" name="consumption_quantity" value="{{$consumables->quantity}}" disabled>
                        @endif
                        <input type="hidden" name="consumables_code" value="{{$consumables->consumables_code}}">
                        <input type="hidden" name="total_stock_quantity" value="{{$total_stock_quantity}}">
                    </td>
            </tr>
            </tbody>
        </table>
                
        <button class="btn btn-primary" type="submit">使用する</button>
            
    </form>
</div>

<script>
    $(function() {
        
        var parent = $( "#form" );
        var deliver_number = parent.find( "#deliver-number" );
        var miss_deliver_number = parent.find( "#miss-deliver-number" );
        var question = parent.find( "#question" );
        
        parent.find( "#btn-yes" ).on( "click", function(){
            question.prop( "hidden", true );
            deliver_number.prop( "disabled", false );
            parent.trigger( "click-btn-yes" );
            parent.prop( "disabled", false );
        });
    
        parent.find( "#btn-no" ).on( "click", function(){
            question.prop( "hidden", true );
            miss_deliver_number.prop( "disabled", false );
            parent.trigger( "click-btn-no" );
            parent.prop( "disabled", false );
        });
    
    });
</script>