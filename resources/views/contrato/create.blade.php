@extends('layouts.app')


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