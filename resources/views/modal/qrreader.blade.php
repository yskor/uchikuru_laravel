<div class="modal fade" id="modal" tabindex="-1" aria-labelledby="exampleModalLongTitle"
    style="padding-left: 0px;" aria-modal="true" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-title">消耗品を納品</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{route('edit_deliver')}}" method="post">
                @csrf
                <div class="modal-body">
                    <div id="qr">
                        
                    </div>
    
                    <div id="form" style="">
                        {{-- QRコードを読み込んだらHTML追加 --}}
                    </div>
    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" id="btn-close" data-bs-dismiss="modal">閉じる</button>
                    <button type="submit" class="btn btn-primary" id="btn-do" disabled="">納品</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>

    $(function() {
        
        var modal = $( "#modal" );
        var qr = modal.find( "#qr" );
        var form = modal.find( "#form" );
        var btn_do = modal.find( "#btn-do" );
        
        var btn_yes = modal.find( "#btn-yes" );
        var btn_no = modal.find( "#btn-no" );
        var btn_deliver = modal.find( "#btn-deliver" );
        var yes_no = modal.find( "#yes-no" );
        var form_delivered_number = modal.find( "#form-delivered-number" );
        
        var qrcheck = $( "<div></div>" );
        
        modal.on( "shown.bs.modal", function() {
            uk_qr_start( qr );	// QRコード読み取り起動
            // uk_ajax_html( form, "<%$ajax_url%>/get", { "parent_id" : form.attr( "id" ), "consumable_movement_id" : modal.data( "id" ) } );
            
        });
    
        // QRコード読み取り完了
        qr.on( "qr-done", function( event, result ) {
            uk_ajax_json( qrcheck, "<%$ajax_url%>/qrcheck", result );
        });
    
        qrcheck.on( "ajax-done", function( event, result ) {
            form.prop( "hidden", false );
            form.find( "#deliver-number" ).val( result.data.shipped_number );
            form.find( "#deliver-number" ).prop( "disabled", true );
        });
    
        form.on( "click-btn-yes", function() {
            btn_do.prop( "disabled", false );
        });
    
        form.on( "click-btn-no", function() {
            btn_do.prop( "disabled", false );
        });
        
        btn_do.on( "click", function() {
            uk_ajax_json( $(this), "<%$ajax_url%>/do", { "deliver_number" : form.find( "#deliver-number" ).val() } );
        });
        
        btn_do.on( "ajax-done", function( event, result ) {
            modal.trigger( "done", result.message );
        });
        
        modal.on( "hide.bs.modal", function() {
            qr.prop( "hidden", false );
            form.prop( "hidden", true );
            yes_no.prop( "hidden", false );
            form_delivered_number.prop( "hidden", true );
        });
    });
</script>
