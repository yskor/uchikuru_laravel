
<table class="table">
    <tbody>
        <tr>
            <th>消耗品</th>
            <td>
                {{$ship_consumables->consumables_name}}
            </td>
        </tr>
        <tr>
            <img src="{{asset('upload/consumables/'.$ship_consumables->image_file_extension)}}" width="100px">
        </tr>
        <tr>
            <th>出荷元</th>
            <td>{{$ship_consumables->office_name_from}}</td>
        </tr>
        <tr>
            <th>納品先</th>
            <td>{{$ship_consumables->office_name_to}}</td>
        </tr>
        <tr>
            <th>出荷数</th>
            <td>
                {{$ship_consumables->shipped_number}}
            </td>
        </tr>
    </tbody>
</table>

<div id="question" class="mb-2">
    <p>上記の出荷数と納品した数は一致しますか？</p>
    <button type="button" class="btn btn-primary" id="btn-yes">はい</button>
    <button type="button" class="btn btn-primary" id="btn-no">いいえ</button>
</div>

<div class="form-group" id="deliver-number-form-group">
    <label for="deliver-number">納品数 <span class="badge bg-danger">必須</span> </label>
    {{-- 納品数が違ったときにPOSTで受けとるinput --}}
    <input type="number" id="miss-deliver-number" name="deliver_number" value="{{$ship_consumables->shipped_number}}" disabled>
    {{-- 納品数が正しいときにPOSTで受けとるinput --}}
    <input type="hidden" id="deliver-number" name="deliver_number" value="{{$ship_consumables->shipped_number}}" disabled>
    <input type="hidden" name="ship_code" value="{{$ship_consumables->ship_code}}">
    <input type="hidden" name="consumables_code" value="{{$ship_consumables->consumables_code}}">
    {{-- <div id="deliver-number-feedback" class="invalid-feedback"></div> --}}
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