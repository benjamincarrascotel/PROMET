@extends('layouts.app')

@section('content')

    @section('title')
    &nbsp;
    <h3>
        Gestión de Proveedores
    </h3>
    &nbsp;
    @endsection

    @push('cards')
        @section('card_title')
            Todos los proveedores
        @overwrite
        
        @section('card_content')
        <div class="table-responsive">
            <table class='table data-table-global datatable' id='datatable'>
                <thead>
                    <tr>
                        <th>RUT</th>
                        <th>Nombre</th>
                        <th>Región</th>
                        <th>Email</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($proveedores as $proveedor)
                    <tr>
                        <td>{{$proveedor->rut.'-'.$proveedor->rut_dv}}</td>
                        <td>{{$proveedor->nombre}}</td>
                        <td>{{$proveedor->region_com}}</td>
                        <td>{{$proveedor->email_com}}</td>

                        <td>
                            <div class="btn-group" role="group">
                                <a class="btn btn-primary" href="{{route('proveedor.show', [$proveedor->id])}}" title="Mostrar Proveedor"><i class='mt-1 fa fa-info'></i></a>
                            </div>
                        </td>
                    </tr>
                    @endforeach
        
                </tbody>
            </table>
        </div>
        @overwrite
        @include('layouts.card')
    @endpush

@endsection
