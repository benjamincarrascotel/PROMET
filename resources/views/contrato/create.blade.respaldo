@extends('layouts.app')

@push('cards')
    @section('card_title')
        Carga Masiva de Contratos
    @overwrite
    @section('card_content')
        <form id="excel" action="{{ route('contrato.excel') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="file">Selecciona un archivo Excel:</label>
                <div style="margin-top: 5px;"> 
                    <div style="float: left;width: 90%;">
                        <input type="file" name="file" class="form-control" >
                    </div>
                    <div class="" style="float:right;">
                        <button type="submit" class="btn btn-primary" form="excel" >Subir archivo</button>
                    </div>
                </div>
            </div>
        </form>
    @overwrite
    @include('layouts.card')
@endpush


@push('cards')
    @section('card_title')
        Creacion de nuevo Contrato
        
    @overwrite

    @section('card_content')
        <form id="store" class="container-fluid" action="{!! route('contrato.store') !!}" method="post">
            @csrf
            @include('contrato.fields')
            <input type="submit" class="btn btn-primary" form="store" value="Guardar" />
            <a class="btn btn-dark" href="{{route('superadmin.index', [0])}}" >Cancelar</a>
        </form>
    @overwrite

    @include('layouts.card')
@endpush