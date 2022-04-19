<img src="https://uchipo.com/test_uchikuru_hori/images/consumable/4520951011239.jpg" width="100px">

<table class="table">
    <tbody>
        <tr>
            <td>施設</td>
            <td>{{$ship_consumables->office_name_from}}</td>
        </tr>
        <tr>
            <td>消耗品</td>
            <td>
                {{$ship_consumables->shipped_number}}
            </td>
        </tr>
        <tr>
            <td>出荷数</td>
            <td>
                {{$ship_consumables->shipped_number}}
            </td>
        </tr>
    </tbody>
</table>

<div id="question">
    <p>上記の出荷数と納品した数は一致しますか？</p>
    <button type="button" class="btn btn-primary" id="btn-yes">はい</button>
    <button type="button" class="btn btn-primary" id="btn-no">いいえ</button>
</div>

<div class="form-group" id="deliver-number-form-group">
    <label for="deliver-number">納品数 <span class="badge bg-danger">必須</span> </label>
    <input type="number" value="{{$ship_consumables->shipped_number}}" disabled>
    <div id="deliver-number-feedback" class="invalid-feedback"></div>
</div>


<script>
    $(function() {
        
        var parent = $( "#form" );
        var deliver_number = parent.find( "#deliver-number" );
        var question = parent.find( "#question" );
        
            parent.find( "#btn-yes" ).on( "click", function(){
            question.prop( "hidden", true );
            parent.trigger( "click-btn-yes" );
        });
    
            parent.find( "#btn-no" ).on( "click", function(){
            question.prop( "hidden", true );
            deliver_number.prop( "disabled", false );
            parent.trigger( "click-btn-no" );
        });
    
    });
</script>