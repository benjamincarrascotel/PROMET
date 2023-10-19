@extends('layouts.app')

<style>
    .flex-end {
        display: block;
        margin-left: auto;
        margin-right: 0;
      }
</style>

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
            <input hidden id="botonSubmit" type="submit" class="btn btn-primary" form="store" value="Guardar" />
        </form>
    @overwrite

    @include('layouts.card')
@endpush