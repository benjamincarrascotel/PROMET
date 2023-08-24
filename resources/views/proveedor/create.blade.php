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
                    Formulario Creación - Modificación Acreedores
                </h1>
            @overwrite
                
            @section('card_content')
                <form id="store" class="container-fluid" action="{!! route('proveedor.store') !!}" method="post">
                    @csrf
                    @include('proveedor.fields')
                    <input type="submit" class="btn btn-primary" form="store" value="Guardar" />
                    <a class="btn btn-dark" href="/login" >Cancelar</a>
                </form>
            @overwrite
        
            @include('layouts.card')

        </div>
    </div>

@endsection('content')
