@extends('layouts.app')

@push('cards')
    @section('card_title')
        Ingresar Arriendo
        
    @overwrite

    @section('card_content')
        <form id="store" class="container-fluid" action="{!! route('arriendo.store') !!}" method="post" enctype="multipart/form-data">
            @csrf
            @include('arriendo.fields')
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