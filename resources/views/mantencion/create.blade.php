@extends('layouts.app')


@push('cards')
    @section('card_title')
        Mantención del Activo: [ ID : {{$activo->id}} ]     {{$activo->marca." ".$activo->modelo}}
        
    @overwrite

    @section('card_content')
        <form id="store" class="container-fluid" action="{!! route('mantencion.store') !!}" method="post" enctype="multipart/form-data">
            @csrf
            @include('mantencion.fields')
            <input type="submit" class="btn btn-primary" form="store" value="Guardar" />
            <a class="btn btn-dark" href="{{route('activo.index')}}" >Cancelar</a>
        </form>
    @overwrite

    @include('layouts.card')
@endpush