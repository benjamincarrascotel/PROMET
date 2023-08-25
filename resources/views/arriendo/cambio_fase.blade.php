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
                    @if($arriendo->estado == "BODEGA" || $arriendo->estado == "EN CAMINO VUELTA")
                    Ingresar datos de <b class="mb-0 font-weight-bold">BODEGA</b>
                    @else
                    Ingresar datos de <b class="mb-0 font-weight-bold">CLIENTE</b>
                    @endif
                </h1>
            @overwrite
                
            @section('card_content')
                <form id="cambio_fase" class="container-fluid" action="{!! route('arriendo.cambio_fase') !!}" method="post" enctype="multipart/form-data">
                    @csrf
                    <input hidden type="integer" id="arriendo_id" name="arriendo_id" value="{{$arriendo->id}}">
                    
                    <div class="mb-3 row">
                        <label class="form-label">Encargado: <span class="tx-danger">*</span></label>
                        <div class="col-sm-10">
                            <input type="text" id="encargado" name="encargado"  class="form-control" required="">
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="firma" class="col-sm-2 col-form-label">Firma:</label>
                        <div class="col-sm-10">
                            <div class="row">
                                <div class="col">
                                    <canvas width=200 height=200></canvas>
                                </div>
                            </div>
                            <input class="form-control" id='firma' name="firma" type="hidden">
                        </div>
                    </div>
        
                    <div class="btn-list flex-end">
                        <button class="btn btn-sm btn-success me-2" type="submit" data-bs-toggle="" data-bs-target="#user-form-modal">Confirmar</button>
                    </div>
                </form>
                
            @overwrite

            <script>
                var canvas = document.querySelector("canvas");
                var img = new Image;
                img.onload = setup;
                img.setAttribute('crossorigin', 'anonymous');

                img.src = '{{asset("/storage/background-white.jpeg")}}'
                //img.src = "http://127.0.0.1/storage/aaaa.jpg"; // SE CAMBIA POR AHORA, PARA MAKINA DEBERIA VENIR DE BD
                //img.src = "http://94.177.238.182/storage/aaaa.jpg"; // SE CAMBIA POR AHORA, PARA MAKINA DEBERIA VENIR DE BD

                function setup() {
                    var canvas = document.querySelector("canvas"),
                        ctx = canvas.getContext("2d"),
                        lastPos, isDown = false;

                    ctx.drawImage(this, 0, 0, canvas.width, canvas.height);  // draw duck        
                    ctx.lineCap = "round";                                   // make lines prettier
                    ctx.lineWidth = 5;
                    ctx.globalCompositeOperation = "multiply";               // KEY MODE HERE
                    
                    canvas.onmousedown = function(e) {
                        isDown = true;
                        lastPos = getPos(e);
                        ctx.strokeStyle = 'red';
                    };
                    window.onmousemove = function(e) {
                        if (!isDown) return;
                        var pos = getPos(e);
                        ctx.beginPath();
                        ctx.moveTo(lastPos.x, lastPos.y);
                        ctx.lineTo(pos.x, pos.y);
                        ctx.stroke();
                        lastPos = pos;
                    };
                    window.onmouseup = function(e) {
                        isDown = false;
                        var canvasURL = canvas.toDataURL();
                        console.log(canvasURL);
                        document.getElementById('firma').value = canvasURL;
                    };
                    function getPos(e) {
                        var rect = canvas.getBoundingClientRect();
                        return {x: e.clientX - rect.left, y: e.clientY - rect.top}
                    }    
                }
            </script>
        
            @include('layouts.card')

        </div>
    </div>

@endsection('content')