<div class="card m-1 p-0" id="add_ship_{{$consumables_ship_data->consumables_code}}" style="width:350px;">
    <div class="card-header d-flex" style="background-color: rgba(0,0,0,.03)">
        <h5 class="w-100" id="ship_consumables_name">{{$consumables_ship_data->consumables_name}}</h5>
        <button type="button" class="btn-close" id="btn_remove_{{$consumables_ship_data->consumables_code}}"></button>
        <script>
            $( function() {
                var parent = $( "#ships" );
                var ship = parent.find( "#add_ship_{{$consumables_ship_data->consumables_code}}" );
                
                $( "#btn_remove_{{$consumables_ship_data->consumables_code}}" ).on( "click", function() {
                    ship.remove();
                });
                
            });
        </script>
    </div>
    <div class="card-body d-flex">
        <div class="">
            <img src="{{ asset('upload/consumables/'.$consumables_ship_data->image_file_extension)}}" style="width:100px;height:100px;">
        </div>
        <div class="w-100 px-2">
            {{-- 消耗品コード --}}
            <input type="hidden" name="ships[{{$consumables_ship_data->consumables_code}}][consumables_code]" value="{{$consumables_ship_data->consumables_code}}">
            {{-- 職員コード --}}
            <input type="hidden" name="staff_code" value="{{$login->staff_code}}">
            
            <label for="ship-number-form-group">出荷数 <span class="badge bg-danger">必須</span> </label>
            <div class="input-group" id="ship-number-form-group" style="width:100px;">
                {{-- 出荷数を入力する --}}
                <input type="number" class="form-control" name="ships[{{$consumables_ship_data->consumables_code}}][ship_number]"
                    id="ship_number_{{$consumables_ship_data->consumables_code}}" aria-describedby="number-unit" required>
                <span class="input-group-text"
                    id="number_unit">箱</span>
            </div>
        </div>
    </div>
    
</div>
