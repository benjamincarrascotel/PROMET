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
        Traspaso de Proceso
        
    @overwrite

    @section('card_content')
            <form id="store" class="container-fluid" action="{!! route('traspaso.store') !!}" method="post" enctype="multipart/form-data">

            @csrf
            @include('traspaso.fields')
            <input type="submit" class="btn btn-primary mt-4" form="store" value="Guardar" />
            <a class="btn btn-dark mt-4" href="{{route('activo.trazabilidad')}}" >Cancelar</a>
        </form>
    @overwrite

    @include('layouts.card')
@endpush