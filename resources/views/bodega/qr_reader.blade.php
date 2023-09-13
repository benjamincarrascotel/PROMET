@extends('layouts.app')

<style>
    .flex-end {
        display: block;
        margin-left: auto;
        margin-right: 0;
      }

    .blurred-img {
        opacity: 0.5;    
    }
    /* Add rounded corners to the table container */
    .table-responsive {
        border-radius: 10px; /* Adjust the radius as needed */
        overflow: hidden; /* Hide the overflowing content */
    }

    /* Style the table with borders and rounded corners */
    .table-bordered {
        border-radius: 10px; /* Adjust the radius as needed */
    }

    a.disabled {
        pointer-events: none;
        cursor: default;
    }
    
</style>

@section('content')

    @section('title')
        &nbsp;
        <h3>
            Gestión de Transporte
        </h3>
        &nbsp;
    @endsection

    @push('cards')
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
    @endpush

    

@endsection

@section('scripts')

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

    <script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
    <link href="https://nightly.datatables.net/css/jquery.dataTables.css" rel="stylesheet" type="text/css" />
    <script src="https://nightly.datatables.net/js/jquery.dataTables.js"></script>

@endsection
