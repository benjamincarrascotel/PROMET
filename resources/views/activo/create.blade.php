@extends('layouts.app')

@push('cards')

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @section('card_title')
        Creacion de nuevo Activo
        
    @overwrite

    @section('card_content')
        <form id="store" class="container-fluid" action="{!! route('activo.store') !!}" method="post" enctype="multipart/form-data">
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