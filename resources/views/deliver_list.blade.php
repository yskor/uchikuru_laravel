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

            <!-- フラッシュメッセージ -->
            @include('include/flash_message')

            <div id="form" style="">
                @include('include/deliver/deliver_table')
            </div>

        </div>
    </main>
    <footer class="fixed-bottom">
        {{-- @include('layout.footer') --}}
        
        @include('include.deliver.footer')
    </footer>
</body>

</html>