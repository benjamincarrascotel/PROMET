@extends('layouts.app')

@push('cards')
    @section('card_title')
        Ingresar Arriendo
        
    @overwrite

    @section('card_content')
        <form id="store" class="container-fluid" action="{!! route('arriendo.store') !!}" method="post" enctype="multipart/form-data">
            @csrf
            @include('arriendo.fields')
            <input hidden id="botonSubmit" type="submit" class="btn btn-primary" form="store" value="Guardar" />
        </form>
    @overwrite

    @include('layouts.card')
@endpush