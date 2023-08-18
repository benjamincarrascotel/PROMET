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

                <!-- Row -->
                <div class="row flex-lg-nowrap">
                    <div class="col-12">
                        <div class="row flex-lg-nowrap">
                            <div class="col-12 mb-3">
                                <div class="e-panel card">
                                    <div class="card-body">
                                        <div class="e-table">
                                            <div class="table-responsive table-lg mt-3">
                                                <table class="table table-bordered border-top text-nowrap">
                                                    <thead>
                                                        <tr>
                                                            <th class="align-top border-bottom-0 wd-5">ID</th>
                                                            <th class="border-bottom-0 w-20">Elemento</th>
                                                            <th class="border-bottom-0 w-20">Clasificación</th>
                                                            <th class="border-bottom-0 w-20">Código Interno</th>
                                                            <th class="border-bottom-0 w-20" >Número De Serie</th>
                                                            <th class="border-bottom-0 w-20">Horas De Uso Promedio</th>
                                                            <th class="border-bottom-0 w-20">Acciones</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($activos as $activo)
                                                            <tr>
                                                                <td class="text-nowrap align-middle"><span>{{$activo->id}}</span></td>
                                                                <td class="align-middle">
                                                                    <div class="d-flex">
                                                                        <span class="avatar brround avatar-xxl d-block" style="background-image: url({{Storage::url('activos/'.$activo->id."/".$activo->foto)}})"></span>
                                                                        <div class="ms-3 mt-5">
                                                                            <h6 class="mb-0 font-weight-bold mt-2">{{$activo->marca." - ".$activo->modelo." - ".$activo->año}}</h6>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                                <td class="text-nowrap align-middle"><span>{{$activo->clasificacion}}</span></td>
                                                                <td class="text-nowrap align-middle"><span>{{$activo->codigo_interno}}</span></td>
                                                                <td class="text-nowrap align-middle"><span>{{$activo->numero_serie}}</span></td>
                                                                <td class="text-nowrap align-middle"><span>{{$activo->horas_uso_promedio." [horas]"}}</span></td>
                                                                <td class="align-middle">
                                                                        <button class="btn btn-sm btn-primary" type="button" data-bs-toggle="" data-bs-target="#user-form-modal">Ver</button>
                                                                        <button class="btn btn-sm btn-danger" type="button"><i class="fe fe-trash-2"></i></button>
                                                                </td>
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
                    </div>
                </div>
                <!-- End Row -->
            </div>
        </div>



        @overwrite
        @include('layouts.card')
    @endpush

    <script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
    <link href="https://nightly.datatables.net/css/jquery.dataTables.css" rel="stylesheet" type="text/css" />
    <script src="https://nightly.datatables.net/js/jquery.dataTables.js"></script>

@endsection
