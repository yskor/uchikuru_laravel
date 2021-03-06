<div id="message" class="mb-2">QRコードを読み取ってください。</div>
<div id="loadingMessage">⌛ Loading video...</div>
<canvas id="canvas" style="width:100%;" height="480" width="640"></canvas>
<div id="output">
    <div id="outputMessage">No QR code detected.</div>
    <div><b>Data:</b> <span id="outputData"></span></div>
</div>
<div id="data"></div>
<script>
    $(function() {

            var video = document.createElement("video");
            var canvasElement = document.getElementById("canvas");
            var canvas = canvasElement.getContext("2d");
            var loadingMessage = document.getElementById("loadingMessage");
            //var outputContainer = document.getElementById("output");
            //var outputMessage = document.getElementById("outputMessage");
            //var outputData = document.getElementById("outputData");
            
            var parent = document.getElementById( "qr" );
        
            function drawLine(begin, end, color) {
                canvas.beginPath();
                canvas.moveTo(begin.x, begin.y);
                canvas.lineTo(end.x, end.y);
                canvas.lineWidth = 4;
                canvas.strokeStyle = color;
                canvas.stroke();
            }
        
            // Webカメラを起動する
            navigator.mediaDevices.getUserMedia({ video: { facingMode: "environment" } }).then(function(stream) {
                video.srcObject = stream;
                video.setAttribute("playsinline", true); // required to tell iOS safari we don't want fullscreen
                video.play();
                requestAnimationFrame(tick);
            });
                
            // "drawImage"関数を実行し、Webカメラからのデータをキャンバスに描画します。
            function tick() {
                loadingMessage.innerText = "⌛ Loading video..."
                if (video.readyState === video.HAVE_ENOUGH_DATA) {
                loadingMessage.hidden = true;
                canvasElement.hidden = false;
                //outputContainer.hidden = false;
        
                canvasElement.height = video.videoHeight;
                canvasElement.width = video.videoWidth;
                canvas.drawImage(video, 0, 0, canvasElement.width, canvasElement.height);
                var imageData = canvas.getImageData(0, 0, canvasElement.width, canvasElement.height);
                var code = jsQR(imageData.data, imageData.width, imageData.height, {
                    inversionAttempts: "dontInvert",
                });
                if (code) {
                    drawLine(code.location.topLeftCorner, code.location.topRightCorner, "#FF3B58");
                    drawLine(code.location.topRightCorner, code.location.bottomRightCorner, "#FF3B58");
                    drawLine(code.location.bottomRightCorner, code.location.bottomLeftCorner, "#FF3B58");
                    drawLine(code.location.bottomLeftCorner, code.location.topLeftCorner, "#FF3B58");
                    //outputMessage.hidden = true;
                    //outputData.parentElement.hidden = false;
                    //outputData.innerText = code.data;
                    
                    var data = document.getElementById( "data" )
                    if( data != null && data.innerText == "" ) {
                        data.innerText = code.data;
                        var event = new Event( "read" );
                        parent.dispatchEvent( event );
                    }
                } else {
                    //outputMessage.hidden = false;
                    //outputData.parentElement.hidden = true;
                }
                }
                requestAnimationFrame(tick);

            }
            
            
            $(function(){
                    
                var qr = $( "#qr" );
                var analyze = $( "<div></div>" );
                
                // QRコード読み取った
                qr.off( "read" ).on( "read", function( event ) {
                    var qrcode = $(this).find( "#data" ).text();
                    console.log(qrcode)
                    $.ajax({
                        type: 'POST',
                        url: "{{route('deliver_consumables')}}", //後述するweb.phpのURLと同じ形にする
                        data: {
                            'qrcode': qrcode,    //ここはサーバーに贈りたい情報。今回は検索ファームのバリューを送りたい。
                        },
                        dataType: 'json', //json形式で受け取る

                    }).done((res)=>{
                        console.log('ajax通ってる')
                        $('#qr').empty(); //#qrの子要素を削除
                        // var consumalbes = res.consumables_code
                        $('#form').append(res.html); //できあがったテンプレートをビューに追加

                        console.log(res)
                        console.log('成功しました')
                        
                    }).fail((error)=>{
                        //ajax通信がエラーのときの処理
                        console.log('失敗');
                    })
                    $(this).html( "" );
                    $(this).prop( "hidden", true );
                });
                
                // 解析できた
                analyze.off( "ajax-done" ).on( "ajax-done", function( event, result ) {
                    qr.trigger( "qr-done", result );
                });

                // 解析エラー
                analyze.off( "ajax-error" ).on( "ajax-error", function( event, result ) {
                    qr.trigger( "qr-error", result );
                });
                
            });
        });
</script>