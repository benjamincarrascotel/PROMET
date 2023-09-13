@extends('layouts.app')


@push('cards')
    @section('card_title')
        Creación de nuevo Proyecto
        
    @overwrite

    @section('card_content')
        <form id="store" class="container-fluid" action="{!! route('proyecto.store') !!}" method="post" enctype="multipart/form-data">
            @csrf
            @include('proyecto.fields')
            <input type="submit" class="btn btn-primary" form="store" value="Guardar" />
            <a class="btn btn-dark" href="{{route('proyecto.index')}}" >Cancelar</a>
        </form>
    @overwrite

    @include('layouts.card')
@endpush