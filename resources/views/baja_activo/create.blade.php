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
        Dar de baja el Activo: [ ID : {{$activo->id}} ]     {{$activo->marca." - ".$activo->modelo}}
        
    @overwrite

    @section('card_content')
        <form id="store" class="container-fluid" action="{!! route('activo.baja_activo_store') !!}" method="post" enctype="multipart/form-data">
            @csrf
            @include('baja_activo.fields')
            <input type="submit" class="btn btn-primary" form="store" value="Guardar" />
            <a class="btn btn-dark" href="{{route('activo.index')}}" >Cancelar</a>
        </form>
    @overwrite

    @include('layouts.card')
@endpush