@extends('layout.base')
@section('title', '出荷画面')

{{-- headタグ内 --}}
@section('head')

@endsection

{{-- スタイルシート --}}
@section('style')
<style>
</style>
@endsection

{{-- ヘッダー --}}
@section('header')
@endsection

{{-- メインコンテンツ --}}
@section('main')

<div id="content">
    <div id="content-body">
        <div class="container">
            <div id="qr">
                <div id="message" class="mb-2">カートのQRコードを読み取ってください。</div>
                <div id="loadingMessage" hidden="">⌛ Loading video...</div>
                <canvas id="canvas" style="width:100%;" height="480" width="640"></canvas>
                <div id="output" hidden="">
                    <div id="outputMessage">No QR code detected.</div>
                    <div hidden=""><b>Data:</b> <span id="outputData"></span></div>
                </div>
                <div id="data" hidden=""></div>
                <script>
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

                    // Use facingMode: environment to attemt to get the front camera on phones
                    navigator.mediaDevices.getUserMedia({ video: { facingMode: "environment" } }).then(function(stream) {
                        video.srcObject = stream;
                        video.setAttribute("playsinline", true); // required to tell iOS safari we don't want fullscreen
                        video.play();
                        requestAnimationFrame(tick);
                    });

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

                        qr.off( "read" ).on( "read", function( event ) {
                            uk_qr_analyze( analyze, $(this).find( "#data" ).text() );
                            $(this).html( "" );
                            $(this).prop( "hidden", true );
                        });

                        analyze.off( "ajax-done" ).on( "ajax-done", function( event, result ) {
                            qr.trigger( "qr-done", result );
                        });

                        analyze.off( "ajax-error" ).on( "ajax-error", function( event, result ) {
                            qr.trigger( "qr-error", result );
                        });

                    });
                </script>
            </div>
            <div id="result"></div>

            <script type="text/javascript">
                $(function() {

                    var qr = $( "#qr" );
                    var jump = $( "" );

                    uk_qr_start( qr, "カートのQRコードを読み取ってください。" );

                    qr.on( "qr-done", function( event, result ) {
                        if( result.data.type == "cart" ) {
                            window.location.href = "medicine_carehome_deliver/page/" + result.data.user_code;
                        } else {
                            $(this).trigger( "qr-error", { "error" : "QRコードが違います。" } );
                        }
                    });

                    qr.on( "qr-error", function( event, result ) {
                        var param = {
                            "message" : result.error,
                            "button_text" : "もう一度読み取る",
                            "button_url" : "careqr"
                        };
                        uk_ajax_html( $( "#result" ), "result/error", param );
                    });

                });

            </script>

        </div>
    </div>
</div>

@endsection

{{-- フッター --}}
@section('footer')
@endsection

{{-- JavaScript --}}
@section('script')
@include('_sample')
@endsection