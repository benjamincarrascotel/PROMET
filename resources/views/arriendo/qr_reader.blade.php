@extends('layouts.app-guest') 

@section('content')
    <div class="page" style="max-width:90%; margin-right:2%; padding: 1em;">
        <div class="page-content">
            <!-- LOGO -->
            <div class="container">
                <div class="row">
                    <div class="col mx-auto">
                        <div class="row justify-content-center">
                            <div class="col-sm-12 col-xs-12 ">
                                <div class="text-center mb-5 mt-0">
                                    <img src="{{asset('assets/images/brand/LogoMOS.png')}}" alt="MOS logo">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- LOGO -->


            @section('card_title')
                <h1 class="card-title" style="width: 100%">
                    Lectór de Código QR
                </h1>
            @overwrite
                
            @section('card_content')

                                
                <div style="display: flex; justify-content: center; margin-top: 0;">
                    <div id="reader"></div>
                    <div id="show" style="display: none;">
                        <h4 style="color:crimson;">Redirigiendo a la página...</h4>
                        <p style="color: blue;" id="result"></p>
                    </div>
                </div>

                        
            @overwrite
        
            @include('layouts.card')

        </div>
    </div>

    <script src="{{asset('assets/js/qrReader.js')}}"></script>
    <script>
        const html5Qrcode = new Html5Qrcode('reader');
        const qrCodeSuccessCallback = (decodedText, decodedResult)=>{
            if(decodedText){
                document.getElementById('show').style.display = 'block';
                //document.getElementById('result').textContent = decodedText;
                html5Qrcode.stop();
                window.location.href = decodedText; // Change this URL
            }
        }
        const config = {fps:20, qrbox:{width:250, height:250}}
        html5Qrcode.start({facingMode:"environment"}, config,qrCodeSuccessCallback );
    </script>

@endsection('content')