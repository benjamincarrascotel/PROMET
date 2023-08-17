@extends('layouts.app-guest') 

@section('content')
    <div class="page" style="max-width:90%; margin-right:2%; padding: 1em;">
        <div class="page-content">
            @section('card_title')
                <h1 class="card-title" style="width: 100%">
                    Formulario Creación - Modificación Acreedores
                </h1>
                <img src="{{asset('assets/images/brand/logoCEMIN.png')}}" class="header-brand-img desktop-lgo" style="margin-left:60%; width:50%; " alt="CEMIN logo">

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
