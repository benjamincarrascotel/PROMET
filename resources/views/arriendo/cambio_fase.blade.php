@extends('layouts.app-guest') 

@section('content')
    <div class="page" style="max-width:90%; margin-right:2%; padding: 1em;">
        <div class="page-content">
            @section('card_title')
                <h1 class="card-title" style="width: 100%">
                    @if($arriendo->estado == "BODEGA" || $arriendo->estado == "EN CAMINO VUELTA")
                    Ingresar datos de <b class="mb-0 font-weight-bold">BODEGA</b>
                    @else
                    Ingresar datos de <b class="mb-0 font-weight-bold">CLIENTE</b>
                    @endif
                </h1>
                <img src="{{asset('assets/images/brand/LogoMOS.png')}}" class="header-brand-img desktop-lgo" style="margin-left:60%; width:30%; " alt="CEMIN logo">

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
                        <label class="form-label">Firma: <span class="tx-danger">*</span></label>
                        <div class="col-sm-10">
                            <input type="text" id="firma" name="firma"  class="form-control" required="">
                        </div>
                    </div>
        
                    <div class="btn-list flex-end">
                        <button class="btn btn-sm btn-success me-2" type="submit" data-bs-toggle="" data-bs-target="#user-form-modal">Confirmar</button>
                    </div>
                </form>
                
            @overwrite
        
            @include('layouts.card')

        </div>
    </div>

@endsection('content')