@extends('layouts.app-guest') 

@section('content')
    <div class="page" style="max-width:90%; margin-right:2%; padding: 1em;">
        <div class="page-content">
            @section('card_title')
                <h1 class="card-title" style="width: 100%">
                    Proveedor Creado Exitosamente
                </h1>
                <img src="{{asset('assets/images/brand/logoCEMIN.png')}}" class="header-brand-img desktop-lgo" style="margin-left:60%; width:50%; " alt="CEMIN logo">

            @overwrite
                
            @section('card_content')
                <!-- Row -->
                <div class="row">
                    <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
                    <h2>Es de nuestro agrado informarle que el proveedor "{{$nombre}}" ha sido registrado exitosamente en nuestro sistema.</h2>
                    </div>
                </div>
                
                <a class="btn btn-secondary" href="/proveedor/create" >Ir nuevamente al formulario</a>
                <!--
                <a class="btn btn-primary" href="/login" >Ir a "Iniciar Sesión"</a>
                -->

            @overwrite
        
            @include('layouts.card')

        </div>
    </div>

@endsection('content')
