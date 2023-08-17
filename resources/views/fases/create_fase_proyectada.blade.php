@extends('layouts.app')

@push('cards')
    @section('card_title')
        Fechas programadas de la Licitación
        
    @overwrite

    @section('card_content')
        <form id="store" class="container-fluid" action="{!! route('fase.store_fase_proyectada') !!}" method="post">
            @csrf
            @include('fases.fase_proyectada_fields')
            <input type="submit" class="btn btn-primary" form="store" value="Guardar" />
            <a class="btn btn-dark" href="{{route('superadmin.index', [0])}}" >Cancelar</a>
        </form>
    @overwrite

    @include('layouts.card')
@endpush