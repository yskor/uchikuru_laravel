<html>

<head>
    <title>施設納品</title>
    <meta name="viewport" content="width=device-width">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="{{url('css/mobile/bootstrap.css')}}" rel="stylesheet">
    <link href="{{url('css/add.css')}}" rel="stylesheet">
    <script type="text/javascript" src="{{url('js/bootstrap.min.js')}}"></script>
    <script type="text/javascript" src="{{url('js/jquery-3.6.0.min.js')}}"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script type="text/javascript" src="{{url('js/loadingoverlay.min.js')}}"></script>
    <!-- <script type="text/javascript" src="{{url('js/jquery.qrcode.min.js')}}"></script> -->
    <script type="text/javascript" src="{{url('js/jsQR.js')}}"></script>
    <script type="text/javascript" src="{{url('js/uchipo.js')}}"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap-dark-5@1.1.2/dist/css/bootstrap-night.min.css" rel="stylesheet"> -->
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    @include('layout.style')
    @include('layout.script')
</head>

<body>
    <header>
        <div class="container">
            <div class="mt-2">
                <svg class="svg-inline--fa fa-user fa-w-14 fa-fw" aria-hidden="true" focusable="false" data-prefix="fas"
                    data-icon="user" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"
                    data-fa-i2svg="">
                    <path fill="currentColor"
                        d="M224 256c70.7 0 128-57.3 128-128S294.7 0 224 0 96 57.3 96 128s57.3 128 128 128zm89.6 32h-16.7c-22.2 10.2-46.9 16-72.9 16s-50.6-5.8-72.9-16h-16.7C60.2 288 0 348.2 0 422.4V464c0 26.5 21.5 48 48 48h352c26.5 0 48-21.5 48-48v-41.6c0-74.2-60.2-134.4-134.4-134.4z">
                    </path>
                </svg>
                {{$login->staff_name}}&nbsp;
                <svg class="svg-inline--fa fa-building fa-w-14 fa-fw" aria-hidden="true" focusable="false"
                    data-prefix="fas" data-icon="building" role="img" xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 448 512" data-fa-i2svg="">
                    <path fill="currentColor"
                        d="M436 480h-20V24c0-13.255-10.745-24-24-24H56C42.745 0 32 10.745 32 24v456H12c-6.627 0-12 5.373-12 12v20h448v-20c0-6.627-5.373-12-12-12zM128 76c0-6.627 5.373-12 12-12h40c6.627 0 12 5.373 12 12v40c0 6.627-5.373 12-12 12h-40c-6.627 0-12-5.373-12-12V76zm0 96c0-6.627 5.373-12 12-12h40c6.627 0 12 5.373 12 12v40c0 6.627-5.373 12-12 12h-40c-6.627 0-12-5.373-12-12v-40zm52 148h-40c-6.627 0-12-5.373-12-12v-40c0-6.627 5.373-12 12-12h40c6.627 0 12 5.373 12 12v40c0 6.627-5.373 12-12 12zm76 160h-64v-84c0-6.627 5.373-12 12-12h40c6.627 0 12 5.373 12 12v84zm64-172c0 6.627-5.373 12-12 12h-40c-6.627 0-12-5.373-12-12v-40c0-6.627 5.373-12 12-12h40c6.627 0 12 5.373 12 12v40zm0-96c0 6.627-5.373 12-12 12h-40c-6.627 0-12-5.373-12-12v-40c0-6.627 5.373-12 12-12h40c6.627 0 12 5.373 12 12v40zm0-96c0 6.627-5.373 12-12 12h-40c-6.627 0-12-5.373-12-12V76c0-6.627 5.373-12 12-12h40c6.627 0 12 5.373 12 12v40z">
                    </path>
                </svg>
                {{$login->facility_name}}
            </div>
        </div>
        <div class="bg-dark mb-3">
            <div class="container h3 mb-0">
                施設納品
            </div>
        </div>
        <div class="container">
            <div id="flash-message" class="alert alert-danger" hidden></div>
        </div>
    </header>
    <main style="padding-bottom:100px;">
        <div class="container">
            <div id="qr">
                <div id="message" class="mb-2">施設のQRコードを読み取ってください。</div>
                <div id="loadingMessage">⌛ Loading video...</div>
                <canvas id="canvas" style="width:100%;" height="480" width="640"></canvas>
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
                                    url: "{{route('deliver_table')}}", //後述するweb.phpのURLと同じ形にする
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
                                    ajax_fail(error)
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
            </div>

            <div id="form" style="">
                {{-- QRコードを読み込んだらHTML追加 --}}
            </div>

        </div>
    </main>
    <footer class="fixed-bottom">
        {{-- @include('layout.footer') --}}
        @include('include.deliver.footer')
    </footer>
</body>

</html>