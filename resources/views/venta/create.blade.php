@extends('layouts.app')


@push('cards')
    @section('card_title')
        Ingresar Venta del Activo: [ ID : {{$activo->id}} ]     {{$activo->marca." ".$activo->modelo}}
        
    @overwrite

    @section('card_content')
        <form id="store" class="container-fluid" action="{!! route('venta.store') !!}" method="post" enctype="multipart/form-data">
            @csrf
            @include('venta.fields')
            <input type="submit" class="btn btn-primary" form="store" value="Guardar" />
            <a class="btn btn-dark" href="{{route('activo.index')}}" >Cancelar</a>
        </form>
    @overwrite

    @include('layouts.card')
@endpush