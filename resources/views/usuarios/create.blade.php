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
        Creacion de nuevo Usuario
    @overwrite

    @section('card_content')
        <form class="container-fluid" action="{!! route('usuarios.store') !!}" method="post">
        @csrf
        @include('usuarios.fields')
        <input type="submit" class="btn btn-primary" value="Guardar" />
        <a class="btn btn-dark" href="{{route('usuarios.index')}}">Cancelar</a>
        </form>
    @overwrite

    @include('layouts.card')
@endpush
