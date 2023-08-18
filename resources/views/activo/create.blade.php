@extends('layouts.app')

@push('cards')
    @section('card_title')
        Creacion de nuevo Activo
        
    @overwrite

    @section('card_content')
        <form id="store" class="container-fluid" action="{!! route('activo.store') !!}" method="post">
            @csrf
            @include('activo.fields')
            <div class="btn-list flex-end">
                <input hidden id="botonSubmit" type="submit" class="btn btn-primary" form="store" value="Guardar" />
                <!-- TODO pendiente de implementar
                <a class="btn btn-dark mt-4" href="{{route('activo.index')}}" >Cancelar</a>
                -->
            </div>
        </form>
    @overwrite

    @include('layouts.card')
@endpush