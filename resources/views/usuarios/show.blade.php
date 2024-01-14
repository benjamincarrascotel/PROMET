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
        Ver Usuario {{'[ ID : '.$user->id.' ]'}} 
        @if($user->superadmin)
            <span class="badge bg-primary">SUPERADMIN</span>
        @endif
        @if($user->admin)
            <span class="badge bg-primary">ADMIN</span>
        @endif
        @if($user->bodega)
            <span class="badge bg-primary">BODEGA</span>
        @endif
    @overwrite

    @section('card_content')
        <form class="container-fluid" action="{!! route('usuarios.update', $user->id) !!}" method="post">
        @csrf
        @include('usuarios.fields_show')
        <input type="submit" class="btn btn-primary" value="Guardar" />
        <a class="btn btn-dark" href="{{route('usuarios.index')}}">Cancelar</a>
        </form>
    @overwrite

    @include('layouts.card')
@endpush
