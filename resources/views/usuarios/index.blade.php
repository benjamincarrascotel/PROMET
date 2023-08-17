@extends('layouts.app')

@push('cards')
    @section('page_title')
        Usuarios
    @overwrite
    @section('card_content')
    <table class="table data-table-global">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Email</th>
                <th>Acción</th>
            </tr>
        </thead>
        <tbody>
        @foreach($usuarios as $usuario)
            <tr>
                <td>{{$usuario->id}}</td>
                <td>{{$usuario->name}}</td>
                <td>{{$usuario->email}}</td>
                @if($usuario->superadmin)
                    <td>
                    </td>
                @else
                    <td>
                        <div class="btn-group" role="group">
                            <a class="btn btn-danger" id="delete" onClick="alert('El usuario ha sido eliminado.')" href="{!! route('usuarios.destroy', [$usuario->id]) !!}"><i class='fa fa-ban'></i>  Eliminar</a>
                            
                        </div>
                    </td>
                @endif
            </tr>
        @endforeach
        </tbody>
    </table>

    <a href='{{route('usuarios.create')}}' class="btn btn-primary">CREAR USUARIO</a>

    @overwrite
    @include('layouts.card_no_title')
@endpush

