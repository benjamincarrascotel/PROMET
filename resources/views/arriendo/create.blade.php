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