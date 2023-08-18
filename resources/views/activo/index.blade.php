@extends('layouts.app')

<style>
    .flex-end {
        display: block;
        margin-left: auto;
        margin-right: 0;
      }
</style>

@section('content')

    @section('title')
    &nbsp;
    <h3>
        Catálogo
    </h3>
    &nbsp;
    @endsection

    @push('cards')
        @section('card_title')
            Información
        @overwrite
        
        @section('card_content')

        <div class="row">
            <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Todos los Activos</h4>    
                        <div class="btn-list flex-end">
                            <a class="btn btn-success btn-svgs btn-svg-white" href="{{url('/activo/create')}}">
                                <svg class="svg-icon" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24">
                                    <path d="M0 0h24v24H0V0z" fill="none"></path>
                                    <path d="M13 4H6v16h12V9h-5V4zm3 14H8v-2h8v2zm0-6v2H8v-2h8z" opacity=".3"></path>
                                    <path d="M8 16h8v2H8zm0-4h8v2H8zm6-10H6c-1.1 0-2 .9-2 2v16c0 1.1.89 2 1.99 2H18c1.1 0 2-.9 2-2V8l-6-6zm4 18H6V4h7v5h5v11z"></path>
                                </svg>                                
                                <span class="btn-svg-text mt-1">Crear Activo</span>
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="table-responsive">
                                <table class='table text-nowrap datatable'>
                                    
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Marca</th>
                                            <th>Modelo</th>
                                            <th>Año</th>
                                            <th>Clasificación</th>
                                            <th>Código Interno</th>
                                            <th>Número de Serie</th>
                                            <th>Horas de Uso Promedio</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($activos as $activo)
                                        <tr>
                                            <td>{{$activo->id}}</td>
                                            <td>{{$activo->marca}}</td>
                                            <td>{{$activo->modelo}}</td>
                                            <td>{{$activo->año}}</td>
                                            <td>{{$activo->clasificacion}}</td>
                                            <td>{{$activo->codigo_interno}}</td>
                                            <td>{{$activo->numero_serie}}</td>
                                            <td>{{$activo->horas_uso_promedio}}</td>
                                        </tr>
                                    @endforeach
                        
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>



        @overwrite
        @include('layouts.card')
    @endpush

    <script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
    <link href="https://nightly.datatables.net/css/jquery.dataTables.css" rel="stylesheet" type="text/css" />
    <script src="https://nightly.datatables.net/js/jquery.dataTables.js"></script>

@endsection
