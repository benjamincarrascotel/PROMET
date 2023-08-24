@extends('layouts.app-guest') 

@section('content')
    <div style="display: flex; justify-content: center; margin-top: 0;">
        <div id="reader"></div>
        <div id="show" style="display: none;">
            <h4 style="color:crimson;">Redirigiendo a la página...</h4>
            <p style="color: blue;" id="result"></p>
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