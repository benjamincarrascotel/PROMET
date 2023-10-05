@extends('layouts.app')

<style>
    .flex-end {
        display: block;
        margin-left: auto;
        margin-right: 0;
      }

    .blurred-img {
        opacity: 0.5;    
    }
    /* Add rounded corners to the table container */
    .table-responsive {
        border-radius: 10px; /* Adjust the radius as needed */
        overflow: hidden; /* Hide the overflowing content */
    }

    /* Style the table with borders and rounded corners */
    .table-bordered {
        border-radius: 10px; /* Adjust the radius as needed */
    }

    a.disabled {
        pointer-events: none;
        cursor: default;
    }

    .checkbox-container {
        display: flex; /* Utilizamos flexbox para alinear los elementos en línea */
        align-items: center; /* Centramos verticalmente los elementos */
    }

    .material-switch {
        margin-right: 10px; /* Espacio entre el checkbox y el texto */
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

    <div class="row">
        <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Filtros de búsqueda</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-6 col-md-12">
                            <form class="form-horizontal">
                                <div class="form-group row">
                                    <label class="col-md-3 form-label mt-2">Estado del activo: </label>
                                    <div class="col-md-9">
                                        <select class="form-control" id="estado" name="estado" placeholder="Buscar por estado del activo.">
                                            <option value="{{null}}">Todos los activos</option>
                                            <option value="DISPONIBLE">DISPONIBLE</option>
                                            <option value="EN PROCESO DE ARRIENDO">EN PROCESO DE ARRIENDO</option>
                                            <option value="EN PROCESO DE MANTENCION">EN PROCESO DE MANTENCION</option>
                                            <option value="EN PROCESO DE VENTA">EN PROCESO DE VENTA</option>
                                            <option value="VENDIDO">VENDIDO</option>
                                            <option value="INOPERATIVO">INOPERATIVO</option>
                                        </select>
                                    </div>
                                </div>
                                
                                <!--
                                <div class="form-group row">
                                    <label class="col-md-3 form-label">Subido</label>
                                    
                                    <div class="col-md-9">
                                        <div class="dropdown">
                                            <select class="form-control " id="subido" name="tipo_elemento" >
                                                    <option value="{{null}}">Todos los documentos</option>
                                                    <option value="subido">Subido</option>
                                                    <option value="pendiente">Pendiente</option>
                                                    <option value="no aplica">No aplica</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                -->
                                
                                
                            </form>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>

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
                <div class="e-panel card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class='table table-bordered data-table-global datatable'>
                                <thead>
                                    <tr>
                                        <th class="border-bottom-0 ">Estado</th>
                                        <th class="border-bottom-0 ">ID</th>
                                        <th class="border-bottom-0 ">Elemento</th>
                                        <th class="border-bottom-0 ">Clasificación</th>
                                        <th class="border-bottom-0 ">Código Interno</th>
                                        <th class="border-bottom-0 " >Número De Serie</th>
                                        <th class="border-bottom-0 ">Acciones</th>
                                        <th class="border-bottom-0 ">Código QR</th>
                                        <th class="border-bottom-0 ">Arrendar</th>
                                        <th class="border-bottom-0 ">Mantención</th>
                                        <th class="border-bottom-0 ">Venta</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($activos as $activo)
                                        <tr>
                                            <!-- ESTADOS -->
                                            @if(! $activo->inoperativo)
                                                @switch($activo->estado)
                                                    @case("DISPONIBLE")
                                                        <td class="text-nowrap align-middle"><span>DISPONIBLE</span></td>
                                                        @break
                                                    @case("PARA RETIRO")
                                                        <td class="text-nowrap align-middle"><span>EN PROCESO DE ARRIENDO</span></td>
                                                        @break
                                                    @case("EN RUTA IDA")
                                                        <td class="text-nowrap align-middle"><span>EN PROCESO DE ARRIENDO</span></td>
                                                        @break
                                                    @case("ARRENDADO")
                                                        <td class="text-nowrap align-middle"><span>EN PROCESO DE ARRIENDO</span></td>
                                                        @break
                                                    @case("EN RUTA VUELTA")
                                                        <td class="text-nowrap align-middle"><span>EN PROCESO DE ARRIENDO</span></td>
                                                        @break
                                                    @case("RECIBIDO")
                                                        <td class="text-nowrap align-middle"><span>EN PROCESO DE ARRIENDO</span></td>
                                                        @break
                                                    @case("EN MANTENCION")
                                                        <td class="text-nowrap align-middle"><span>EN PROCESO DE MANTENCION</span></td>
                                                        @break
                                                    @case("VENDIDO")
                                                        <td class="text-nowrap align-middle"><span>EN PROCESO DE VENTA</span></td>
                                                        @break
                                                    @case("NO DISPONIBLE")
                                                        <td class="text-nowrap align-middle"><span>VENDIDO</span></td>
                                                        @break
                                                    @default
                                                        @break
                                                        
                                                @endswitch
                                            @else
                                                <td class="text-nowrap align-middle"><span>INOPERATIVO</span></td>
                                            @endif
                                            <td class="text-nowrap align-middle"><span>{{$activo->id}}</span></td>
                                            <td class="align-middle">
                                                <div class="d-flex">
                                                    @if($activo->foto)
                                                        @if($activo->estado != "DISPONIBLE" || $activo->inoperativo)
                                                            <span class="avatar brround avatar-xxl d-block blurred-img" style="background-image: url({{Storage::url('activos/'.$activo->id."/".$activo->foto)}})"></span>
                                                        @else
                                                            <span class="avatar brround avatar-xxl d-block" style="background-image: url({{Storage::url('activos/'.$activo->id."/".$activo->foto)}})"></span>
                                                        @endif
                                                    @else
                                                        @if($activo->estado != "DISPONIBLE" || $activo->inoperativo)
                                                            <span class="avatar brround avatar-xxl d-block blurred-img" style="background-image: url({{asset('assets/images/brand/favicon1.png')}})"></span>
                                                        @else
                                                            <span class="avatar brround avatar-xxl d-block" style="background-image: url({{asset('assets/images/brand/favicon1.png')}})"></span>
                                                        @endif
                                                    @endif
                                                    <div class="ms-3 mt-5">
                                                        <h6 class="mb-0 font-weight-bold mt-2">{{$activo->marca." - ".$activo->modelo." - ".$activo->año}}</h6>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="text-nowrap align-middle"><span>{{$activo->clasificacion}}</span></td>
                                            <td class="text-nowrap align-middle"><span>{{$activo->codigo_interno}}</span></td>
                                            <td class="text-nowrap align-middle"><span>{{$activo->numero_serie}}</span></td>
                                            <td class="align-middle text-center">
                                                <a class="btn btn-sm btn-primary" type="button" href="{{route('activo.show', [$activo->id])}}">Ver</a>
                                                <button class="btn btn-sm btn-danger" type="button"><i class="fe fe-trash-2"></i></button>
                                            </td>
                                            <td class="align-middle text-center">
                                                <a data-toggle="tooltip" data-placement="top" title="DESCARGAR" download href="{{ Storage::url('activos/'.$activo->id."/QR_CODE.svg") }}">
                                                    <button class="btn btn-sm btn-warning" type="button" data-bs-toggle="" data-bs-target="#user-form-modal">
                                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" aria-labelledby="qrIconTitle" stroke="#000" stroke-linecap="square" color="#000"><path d="M10 3v7H3V3z"/><path d="M7 6H6v1h1zm3 8v7H3v-7z"/><path d="M6 17h1v1H6zm8 3h1v1h-1zm3-3h1v1h-1zm-3-3h1v1h-1zm6 3h1v1h-1zm0-3h1v1h-1zm0 6h1v1h-1zm1-17v7h-7V3z"/><path d="M17 6h1v1h-1z"/></svg>                                                                   
                                                </a>
                                            </td>

                                            <!-- CASO: DISPONIBLE -->
                                            @if($activo->estado == "DISPONIBLE")
                                                <!-- CASO: OPERATIVO -->
                                                @if(! $activo->inoperativo)

                                                    <td class="align-middle text-center">
                                                        <a data-toggle="tooltip" data-placement="top" title="ARRENDAR" href="{{url('/arriendo/create/'.$activo->id)}}">
                                                            <button class="btn btn-sm btn-success" type="button">
                                                            <svg width="24" height="24" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 372.372 372.372" style="enable-background:new 0 0 372.372 372.372" xml:space="preserve"><path d="M368.712 219.925c-5.042-8.951-14.563-14.511-24.848-14.511-4.858 0-9.682 1.27-13.948 3.672l-83.024 46.756a4.502 4.502 0 0 0-2.163 2.85c-1.448 5.911-4.857 14.164-12.865 19.911-8.864 6.361-20.855 7.686-35.466 3.939a4.652 4.652 0 0 1-.252-.071L148.252 267.6a5.505 5.505 0 0 1-3.621-6.882 5.476 5.476 0 0 1 5.251-3.872c.55 0 1.101.084 1.634.249l47.645 14.794c.076.023.154.045.232.065 11.236 2.836 20.011 2.047 26.056-2.288 7.637-5.48 8.982-15.113 9.141-16.528a2.02 2.02 0 0 0 .014-.136l.005-.039.003-.044.002-.029c.909-11.878-6.756-22.846-18.24-26.089l-.211-.064c-.35-.114-35.596-11.626-58.053-18.034-2.495-.711-9.37-2.366-19.313-2.366-13.906 0-34.651 3.295-54.549 19.025L1.67 292.159a4.5 4.5 0 0 0-.758 6.215l44.712 59.06a4.508 4.508 0 0 0 3.588 1.784c.987 0 1.954-.325 2.745-.935l57.592-44.345c1.294-.995 3.029-1.37 4.619-.995l93.02 21.982c6.898 1.63 14.353.578 20.523-2.9l130.16-73.304c13.684-7.709 18.547-25.111 10.841-38.796zm-51.731-206.77h-170c-5.522 0-10 4.477-10 10v45.504c0 5.523 4.478 10 10 10h3.735v96.623c0 5.523 4.477 10 10 10h142.526c5.523 0 10-4.477 10-10V78.658h3.738c5.522 0 10-4.477 10-10V23.155c.001-5.523-4.477-10-9.999-10zm-63.965 89.262h-42.072c-4.411 0-8-3.589-8-8s3.589-8 8-8h42.072c4.411 0 8 3.589 8 8s-3.589 8-8 8zm53.965-43.759h-150V33.155h150v25.503z"/></svg>                                                
                                                        </a>
                                                    </td>

                                                    <td class="align-middle text-center">
                                                        <a href="{{ route('mantencion.create', [$activo->id]) }}">
                                                            <button id="iniciar_mantencion" class="btn btn-sm btn-success" type="button" data-toggle="tooltip" data-placement="top" title="INICIAR MANTENCIÓN">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 512 512" xml:space="preserve"><path d="m360.102 240.012 10.156-10.266s15.609-13.406 33.406-7.328c30.984 10.578 66.781-.875 91.609-25.734 7.063-7.063 15.641-21.234 15.641-21.234a5.596 5.596 0 0 0 .922-4.672l-1.922-7.906a5.671 5.671 0 0 0-2.625-3.531 5.566 5.566 0 0 0-4.344-.547l-60.984 16.969a5.648 5.648 0 0 1-6.063-2.109l-28.015-38.594a5.564 5.564 0 0 1-1.016-4.063l5.641-41a5.595 5.595 0 0 1 4.063-4.656l64.406-17.922c2.906-.813 4.672-3.813 3.953-6.766l-2.547-10.359a5.61 5.61 0 0 0-2.563-3.5s-5.047-3.344-8.719-5.234c-36.578-18.891-82.64-13.031-113.312 17.656-22.656 22.656-31.531 53.688-27.375 83.156 3.203 22.656 1.703 34.703-8.078 45.047-.891.922-3.703 3.734-8.047 8l45.813 44.593zm-148.719 55.406A183455.446 183455.446 0 0 1 68.461 433.715a13.135 13.135 0 0 0-4.047 9.313 13.092 13.092 0 0 0 3.813 9.375l31.938 31.938a13.071 13.071 0 0 0 9.391 3.813 13.018 13.018 0 0 0 9.281-4.031L258.165 343.17l-46.782-47.752zM501.43 451.371a13.008 13.008 0 0 0 3.813-9.375c-.031-3.516-1.5-6.859-4.031-9.297L227.415 166.246l-43.953 43.969L450.805 483.09c2.438 2.547 5.781 4 9.297 4.047s6.891-1.344 9.391-3.828l31.937-31.938zM254.196 32.621c-32.969-12.859-86.281-14.719-117.156 16.141a472188.334 472188.334 0 0 0-59.875 59.891c-12.672 12.656-.906 25.219-10.266 34.563-9.359 9.359-24.313 0-32.734 8.422L3.29 182.527c-4.391 4.375-4.391 11.5 0 15.891l43.016 43.016c4.391 4.391 11.516 4.391 15.906 0l30.875-30.875c8.438-8.422-.938-23.375 8.438-32.719 12.609-12.625 26.375-10.484 34.328-2.547l15.891 15.891 17.219 4.531 43.953-43.953-5.063-16.688c-14.016-14.031-16.016-30.266-7.234-39.047 13.594-13.594 36.047-33.234 57.078-41.656 13.405-5.359 9.358-18.703-3.501-21.75zm-59.625 70.859c-.063.047 5.859-7.281 5.969-7.375l-5.969 7.375z" style="fill:#000"/></svg>                                                                    
                                                        </a>
                                                    </td>

                                                    <td class="align-middle text-center">
                                                        <a href="{{ route('venta.create', [$activo->id]) }}">
                                                            <button id="iniciar_venta" class="btn btn-sm btn-success" type="button" data-toggle="tooltip" data-placement="top" title="VENDER">
                                                            <svg width="24" height="24" viewBox="0 0 30 30" xmlns="http://www.w3.org/2000/svg"><path d="M5.5 5c-.655 0-.66 1.01 0 1h22c.286 0 .5.214.5.5v13c0 .66 1 .66 1 0v-13c0-.822-.678-1.5-1.5-1.5h-22zm-2 2c-.654 0-.654 1 0 1h22c.286 0 .5.214.5.5v13c0 .665 1.01.66 1 0v-13c0-.822-.678-1.5-1.5-1.5h-22zm-2 2C.678 9 0 9.678 0 10.5v12c0 .822.678 1.5 1.5 1.5h22c.822 0 1.5-.678 1.5-1.5v-12c0-.822-.678-1.5-1.5-1.5h-22zm0 1h22c.286 0 .5.214.5.5v12c0 .286-.214.5-.5.5h-22a.488.488 0 0 1-.5-.5v-12c0-.286.214-.5.5-.5zm1 1a.5.5 0 0 0-.5.5v2c0 .672 1 .656 1 0V12h1.5c.672 0 .656-1 0-1h-2zm10 0C9.468 11 7 13.468 7 16.5S9.468 22 12.5 22s5.5-2.468 5.5-5.5-2.468-5.5-5.5-5.5zm8 0c-.656 0-.672 1 0 1H22v1.5c0 .656 1 .672 1 0v-2a.5.5 0 0 0-.5-.5h-2zm-8 1c2.49 0 4.5 2.01 4.5 4.5S14.99 21 12.5 21 8 18.99 8 16.5s2.01-4.5 4.5-4.5zm0 1c-.277 0-.5.223-.5.5v.594c-.578.21-1 .76-1 1.406 0 .82.68 1.5 1.5 1.5.28 0 .5.212.5.5 0 .288-.22.5-.5.5h-1c-.338-.005-.5.248-.5.5s.162.505.5.5h.5v.5a.499.499 0 1 0 1 0v-.594c.578-.21 1-.76 1-1.406 0-.82-.68-1.5-1.5-1.5a.49.49 0 0 1-.5-.5c0-.288.22-.5.5-.5h1c.338.005.5-.248.5-.5s-.162-.505-.5-.5H13v-.5c0-.277-.223-.5-.5-.5zm-10 6.002c-.25-.002-.5.162-.5.498v2a.5.5 0 0 0 .5.5h2c.656 0 .672-1 0-1H3v-1.5c0-.328-.25-.496-.5-.498zm20 0c-.25.002-.5.17-.5.498V21h-1.5c-.672 0-.656 1 0 1h2a.5.5 0 0 0 .5-.5v-2c0-.336-.25-.5-.5-.498z"/></svg>                                                        
                                                            <!--
                                                            <h6 class="mb-0 font-weight-bold mt-2">Iniciar</h6>
                                                            -->
                                                        </a>
                                                    </td>
                                                <!-- CASO: INOPERATIVO -->
                                                @else
                                                    <td class="align-middle text-center">
                                                        <a class="disabled" data-toggle="tooltip" data-placement="top" title="ARRENDAR" href="{{url('/arriendo/create/'.$activo->id)}}">
                                                            <button disabled class="btn btn-sm btn-success" type="button">
                                                            <svg width="24" height="24" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 372.372 372.372" style="enable-background:new 0 0 372.372 372.372" xml:space="preserve"><path d="M368.712 219.925c-5.042-8.951-14.563-14.511-24.848-14.511-4.858 0-9.682 1.27-13.948 3.672l-83.024 46.756a4.502 4.502 0 0 0-2.163 2.85c-1.448 5.911-4.857 14.164-12.865 19.911-8.864 6.361-20.855 7.686-35.466 3.939a4.652 4.652 0 0 1-.252-.071L148.252 267.6a5.505 5.505 0 0 1-3.621-6.882 5.476 5.476 0 0 1 5.251-3.872c.55 0 1.101.084 1.634.249l47.645 14.794c.076.023.154.045.232.065 11.236 2.836 20.011 2.047 26.056-2.288 7.637-5.48 8.982-15.113 9.141-16.528a2.02 2.02 0 0 0 .014-.136l.005-.039.003-.044.002-.029c.909-11.878-6.756-22.846-18.24-26.089l-.211-.064c-.35-.114-35.596-11.626-58.053-18.034-2.495-.711-9.37-2.366-19.313-2.366-13.906 0-34.651 3.295-54.549 19.025L1.67 292.159a4.5 4.5 0 0 0-.758 6.215l44.712 59.06a4.508 4.508 0 0 0 3.588 1.784c.987 0 1.954-.325 2.745-.935l57.592-44.345c1.294-.995 3.029-1.37 4.619-.995l93.02 21.982c6.898 1.63 14.353.578 20.523-2.9l130.16-73.304c13.684-7.709 18.547-25.111 10.841-38.796zm-51.731-206.77h-170c-5.522 0-10 4.477-10 10v45.504c0 5.523 4.478 10 10 10h3.735v96.623c0 5.523 4.477 10 10 10h142.526c5.523 0 10-4.477 10-10V78.658h3.738c5.522 0 10-4.477 10-10V23.155c.001-5.523-4.477-10-9.999-10zm-63.965 89.262h-42.072c-4.411 0-8-3.589-8-8s3.589-8 8-8h42.072c4.411 0 8 3.589 8 8s-3.589 8-8 8zm53.965-43.759h-150V33.155h150v25.503z"/></svg>                                                
                                                        </a>
                                                    </td>

                                                    <td class="align-middle text-center">
                                                        <a href="#">
                                                            <button disabled class="btn btn-sm btn-success" type="button" data-toggle="tooltip" data-placement="top" title="INICIAR MANTENCIÓN">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 512 512" xml:space="preserve"><path d="m360.102 240.012 10.156-10.266s15.609-13.406 33.406-7.328c30.984 10.578 66.781-.875 91.609-25.734 7.063-7.063 15.641-21.234 15.641-21.234a5.596 5.596 0 0 0 .922-4.672l-1.922-7.906a5.671 5.671 0 0 0-2.625-3.531 5.566 5.566 0 0 0-4.344-.547l-60.984 16.969a5.648 5.648 0 0 1-6.063-2.109l-28.015-38.594a5.564 5.564 0 0 1-1.016-4.063l5.641-41a5.595 5.595 0 0 1 4.063-4.656l64.406-17.922c2.906-.813 4.672-3.813 3.953-6.766l-2.547-10.359a5.61 5.61 0 0 0-2.563-3.5s-5.047-3.344-8.719-5.234c-36.578-18.891-82.64-13.031-113.312 17.656-22.656 22.656-31.531 53.688-27.375 83.156 3.203 22.656 1.703 34.703-8.078 45.047-.891.922-3.703 3.734-8.047 8l45.813 44.593zm-148.719 55.406A183455.446 183455.446 0 0 1 68.461 433.715a13.135 13.135 0 0 0-4.047 9.313 13.092 13.092 0 0 0 3.813 9.375l31.938 31.938a13.071 13.071 0 0 0 9.391 3.813 13.018 13.018 0 0 0 9.281-4.031L258.165 343.17l-46.782-47.752zM501.43 451.371a13.008 13.008 0 0 0 3.813-9.375c-.031-3.516-1.5-6.859-4.031-9.297L227.415 166.246l-43.953 43.969L450.805 483.09c2.438 2.547 5.781 4 9.297 4.047s6.891-1.344 9.391-3.828l31.937-31.938zM254.196 32.621c-32.969-12.859-86.281-14.719-117.156 16.141a472188.334 472188.334 0 0 0-59.875 59.891c-12.672 12.656-.906 25.219-10.266 34.563-9.359 9.359-24.313 0-32.734 8.422L3.29 182.527c-4.391 4.375-4.391 11.5 0 15.891l43.016 43.016c4.391 4.391 11.516 4.391 15.906 0l30.875-30.875c8.438-8.422-.938-23.375 8.438-32.719 12.609-12.625 26.375-10.484 34.328-2.547l15.891 15.891 17.219 4.531 43.953-43.953-5.063-16.688c-14.016-14.031-16.016-30.266-7.234-39.047 13.594-13.594 36.047-33.234 57.078-41.656 13.405-5.359 9.358-18.703-3.501-21.75zm-59.625 70.859c-.063.047 5.859-7.281 5.969-7.375l-5.969 7.375z" style="fill:#000"/></svg>                                                                    
                                                        </a>
                                                    </td>

                                                    <td class="align-middle text-center">
                                                        <button disabled id="iniciar_venta" data-activo-id="{{ $activo->id }}" class="btn btn-sm btn-success" data-toggle="tooltip" data-placement="top" title="VENDER" type="button">
                                                        <svg width="24" height="24" viewBox="0 0 30 30" xmlns="http://www.w3.org/2000/svg"><path d="M5.5 5c-.655 0-.66 1.01 0 1h22c.286 0 .5.214.5.5v13c0 .66 1 .66 1 0v-13c0-.822-.678-1.5-1.5-1.5h-22zm-2 2c-.654 0-.654 1 0 1h22c.286 0 .5.214.5.5v13c0 .665 1.01.66 1 0v-13c0-.822-.678-1.5-1.5-1.5h-22zm-2 2C.678 9 0 9.678 0 10.5v12c0 .822.678 1.5 1.5 1.5h22c.822 0 1.5-.678 1.5-1.5v-12c0-.822-.678-1.5-1.5-1.5h-22zm0 1h22c.286 0 .5.214.5.5v12c0 .286-.214.5-.5.5h-22a.488.488 0 0 1-.5-.5v-12c0-.286.214-.5.5-.5zm1 1a.5.5 0 0 0-.5.5v2c0 .672 1 .656 1 0V12h1.5c.672 0 .656-1 0-1h-2zm10 0C9.468 11 7 13.468 7 16.5S9.468 22 12.5 22s5.5-2.468 5.5-5.5-2.468-5.5-5.5-5.5zm8 0c-.656 0-.672 1 0 1H22v1.5c0 .656 1 .672 1 0v-2a.5.5 0 0 0-.5-.5h-2zm-8 1c2.49 0 4.5 2.01 4.5 4.5S14.99 21 12.5 21 8 18.99 8 16.5s2.01-4.5 4.5-4.5zm0 1c-.277 0-.5.223-.5.5v.594c-.578.21-1 .76-1 1.406 0 .82.68 1.5 1.5 1.5.28 0 .5.212.5.5 0 .288-.22.5-.5.5h-1c-.338-.005-.5.248-.5.5s.162.505.5.5h.5v.5a.499.499 0 1 0 1 0v-.594c.578-.21 1-.76 1-1.406 0-.82-.68-1.5-1.5-1.5a.49.49 0 0 1-.5-.5c0-.288.22-.5.5-.5h1c.338.005.5-.248.5-.5s-.162-.505-.5-.5H13v-.5c0-.277-.223-.5-.5-.5zm-10 6.002c-.25-.002-.5.162-.5.498v2a.5.5 0 0 0 .5.5h2c.656 0 .672-1 0-1H3v-1.5c0-.328-.25-.496-.5-.498zm20 0c-.25.002-.5.17-.5.498V21h-1.5c-.672 0-.656 1 0 1h2a.5.5 0 0 0 .5-.5v-2c0-.336-.25-.5-.5-.498z"/></svg>                                                        
                                                    </td>
                                                @endif

                                            <!-- CASO: EN MANTENCIÓN -->
                                            @elseif($activo->estado == "EN MANTENCION")

                                                <td class="align-middle text-center">
                                                    <a class="disabled" data-toggle="tooltip" data-placement="top" title="ARRENDAR" href="{{url('/arriendo/create/'.$activo->id)}}">
                                                        <button disabled class="btn btn-sm btn-success" type="button">
                                                        <svg width="24" height="24" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 372.372 372.372" style="enable-background:new 0 0 372.372 372.372" xml:space="preserve"><path d="M368.712 219.925c-5.042-8.951-14.563-14.511-24.848-14.511-4.858 0-9.682 1.27-13.948 3.672l-83.024 46.756a4.502 4.502 0 0 0-2.163 2.85c-1.448 5.911-4.857 14.164-12.865 19.911-8.864 6.361-20.855 7.686-35.466 3.939a4.652 4.652 0 0 1-.252-.071L148.252 267.6a5.505 5.505 0 0 1-3.621-6.882 5.476 5.476 0 0 1 5.251-3.872c.55 0 1.101.084 1.634.249l47.645 14.794c.076.023.154.045.232.065 11.236 2.836 20.011 2.047 26.056-2.288 7.637-5.48 8.982-15.113 9.141-16.528a2.02 2.02 0 0 0 .014-.136l.005-.039.003-.044.002-.029c.909-11.878-6.756-22.846-18.24-26.089l-.211-.064c-.35-.114-35.596-11.626-58.053-18.034-2.495-.711-9.37-2.366-19.313-2.366-13.906 0-34.651 3.295-54.549 19.025L1.67 292.159a4.5 4.5 0 0 0-.758 6.215l44.712 59.06a4.508 4.508 0 0 0 3.588 1.784c.987 0 1.954-.325 2.745-.935l57.592-44.345c1.294-.995 3.029-1.37 4.619-.995l93.02 21.982c6.898 1.63 14.353.578 20.523-2.9l130.16-73.304c13.684-7.709 18.547-25.111 10.841-38.796zm-51.731-206.77h-170c-5.522 0-10 4.477-10 10v45.504c0 5.523 4.478 10 10 10h3.735v96.623c0 5.523 4.477 10 10 10h142.526c5.523 0 10-4.477 10-10V78.658h3.738c5.522 0 10-4.477 10-10V23.155c.001-5.523-4.477-10-9.999-10zm-63.965 89.262h-42.072c-4.411 0-8-3.589-8-8s3.589-8 8-8h42.072c4.411 0 8 3.589 8 8s-3.589 8-8 8zm53.965-43.759h-150V33.155h150v25.503z"/></svg>                                                
                                                    </a>
                                                </td>

                                                <td class="align-middle text-center">
                                                    <button id="terminar_mantencion" data-activo-id="{{ $activo->id }}" class="btn btn-sm btn-danger terminar-mantencion-btn" data-toggle="tooltip" data-placement="top" title="TERMINAR MANTENCIÓN" type="button">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 512 512" xml:space="preserve"><path d="m360.102 240.012 10.156-10.266s15.609-13.406 33.406-7.328c30.984 10.578 66.781-.875 91.609-25.734 7.063-7.063 15.641-21.234 15.641-21.234a5.596 5.596 0 0 0 .922-4.672l-1.922-7.906a5.671 5.671 0 0 0-2.625-3.531 5.566 5.566 0 0 0-4.344-.547l-60.984 16.969a5.648 5.648 0 0 1-6.063-2.109l-28.015-38.594a5.564 5.564 0 0 1-1.016-4.063l5.641-41a5.595 5.595 0 0 1 4.063-4.656l64.406-17.922c2.906-.813 4.672-3.813 3.953-6.766l-2.547-10.359a5.61 5.61 0 0 0-2.563-3.5s-5.047-3.344-8.719-5.234c-36.578-18.891-82.64-13.031-113.312 17.656-22.656 22.656-31.531 53.688-27.375 83.156 3.203 22.656 1.703 34.703-8.078 45.047-.891.922-3.703 3.734-8.047 8l45.813 44.593zm-148.719 55.406A183455.446 183455.446 0 0 1 68.461 433.715a13.135 13.135 0 0 0-4.047 9.313 13.092 13.092 0 0 0 3.813 9.375l31.938 31.938a13.071 13.071 0 0 0 9.391 3.813 13.018 13.018 0 0 0 9.281-4.031L258.165 343.17l-46.782-47.752zM501.43 451.371a13.008 13.008 0 0 0 3.813-9.375c-.031-3.516-1.5-6.859-4.031-9.297L227.415 166.246l-43.953 43.969L450.805 483.09c2.438 2.547 5.781 4 9.297 4.047s6.891-1.344 9.391-3.828l31.937-31.938zM254.196 32.621c-32.969-12.859-86.281-14.719-117.156 16.141a472188.334 472188.334 0 0 0-59.875 59.891c-12.672 12.656-.906 25.219-10.266 34.563-9.359 9.359-24.313 0-32.734 8.422L3.29 182.527c-4.391 4.375-4.391 11.5 0 15.891l43.016 43.016c4.391 4.391 11.516 4.391 15.906 0l30.875-30.875c8.438-8.422-.938-23.375 8.438-32.719 12.609-12.625 26.375-10.484 34.328-2.547l15.891 15.891 17.219 4.531 43.953-43.953-5.063-16.688c-14.016-14.031-16.016-30.266-7.234-39.047 13.594-13.594 36.047-33.234 57.078-41.656 13.405-5.359 9.358-18.703-3.501-21.75zm-59.625 70.859c-.063.047 5.859-7.281 5.969-7.375l-5.969 7.375z" style="fill:#000"/></svg>                                                                    
                                                </td>

                                                <td class="align-middle text-center">
                                                    <button disabled id="iniciar_venta" data-activo-id="{{ $activo->id }}" class="btn btn-sm btn-success" data-toggle="tooltip" data-placement="top" title="VENDER" type="button">
                                                    <svg width="24" height="24" viewBox="0 0 30 30" xmlns="http://www.w3.org/2000/svg"><path d="M5.5 5c-.655 0-.66 1.01 0 1h22c.286 0 .5.214.5.5v13c0 .66 1 .66 1 0v-13c0-.822-.678-1.5-1.5-1.5h-22zm-2 2c-.654 0-.654 1 0 1h22c.286 0 .5.214.5.5v13c0 .665 1.01.66 1 0v-13c0-.822-.678-1.5-1.5-1.5h-22zm-2 2C.678 9 0 9.678 0 10.5v12c0 .822.678 1.5 1.5 1.5h22c.822 0 1.5-.678 1.5-1.5v-12c0-.822-.678-1.5-1.5-1.5h-22zm0 1h22c.286 0 .5.214.5.5v12c0 .286-.214.5-.5.5h-22a.488.488 0 0 1-.5-.5v-12c0-.286.214-.5.5-.5zm1 1a.5.5 0 0 0-.5.5v2c0 .672 1 .656 1 0V12h1.5c.672 0 .656-1 0-1h-2zm10 0C9.468 11 7 13.468 7 16.5S9.468 22 12.5 22s5.5-2.468 5.5-5.5-2.468-5.5-5.5-5.5zm8 0c-.656 0-.672 1 0 1H22v1.5c0 .656 1 .672 1 0v-2a.5.5 0 0 0-.5-.5h-2zm-8 1c2.49 0 4.5 2.01 4.5 4.5S14.99 21 12.5 21 8 18.99 8 16.5s2.01-4.5 4.5-4.5zm0 1c-.277 0-.5.223-.5.5v.594c-.578.21-1 .76-1 1.406 0 .82.68 1.5 1.5 1.5.28 0 .5.212.5.5 0 .288-.22.5-.5.5h-1c-.338-.005-.5.248-.5.5s.162.505.5.5h.5v.5a.499.499 0 1 0 1 0v-.594c.578-.21 1-.76 1-1.406 0-.82-.68-1.5-1.5-1.5a.49.49 0 0 1-.5-.5c0-.288.22-.5.5-.5h1c.338.005.5-.248.5-.5s-.162-.505-.5-.5H13v-.5c0-.277-.223-.5-.5-.5zm-10 6.002c-.25-.002-.5.162-.5.498v2a.5.5 0 0 0 .5.5h2c.656 0 .672-1 0-1H3v-1.5c0-.328-.25-.496-.5-.498zm20 0c-.25.002-.5.17-.5.498V21h-1.5c-.672 0-.656 1 0 1h2a.5.5 0 0 0 .5-.5v-2c0-.336-.25-.5-.5-.498z"/></svg>                                                        
                                                </td>
                                            
                                            <!-- CASO: EN OTRO ESTADO (ALGUNA ETAPA DE ARRIENDO O VENDIDO) -->
                                            @else

                                                <td class="align-middle text-center">
                                                    <a class="disabled" data-toggle="tooltip" data-placement="top" title="ARRENDAR" href="{{url('/arriendo/create/'.$activo->id)}}">
                                                        <button disabled class="btn btn-sm btn-success" type="button">
                                                        <svg width="24" height="24" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 372.372 372.372" style="enable-background:new 0 0 372.372 372.372" xml:space="preserve"><path d="M368.712 219.925c-5.042-8.951-14.563-14.511-24.848-14.511-4.858 0-9.682 1.27-13.948 3.672l-83.024 46.756a4.502 4.502 0 0 0-2.163 2.85c-1.448 5.911-4.857 14.164-12.865 19.911-8.864 6.361-20.855 7.686-35.466 3.939a4.652 4.652 0 0 1-.252-.071L148.252 267.6a5.505 5.505 0 0 1-3.621-6.882 5.476 5.476 0 0 1 5.251-3.872c.55 0 1.101.084 1.634.249l47.645 14.794c.076.023.154.045.232.065 11.236 2.836 20.011 2.047 26.056-2.288 7.637-5.48 8.982-15.113 9.141-16.528a2.02 2.02 0 0 0 .014-.136l.005-.039.003-.044.002-.029c.909-11.878-6.756-22.846-18.24-26.089l-.211-.064c-.35-.114-35.596-11.626-58.053-18.034-2.495-.711-9.37-2.366-19.313-2.366-13.906 0-34.651 3.295-54.549 19.025L1.67 292.159a4.5 4.5 0 0 0-.758 6.215l44.712 59.06a4.508 4.508 0 0 0 3.588 1.784c.987 0 1.954-.325 2.745-.935l57.592-44.345c1.294-.995 3.029-1.37 4.619-.995l93.02 21.982c6.898 1.63 14.353.578 20.523-2.9l130.16-73.304c13.684-7.709 18.547-25.111 10.841-38.796zm-51.731-206.77h-170c-5.522 0-10 4.477-10 10v45.504c0 5.523 4.478 10 10 10h3.735v96.623c0 5.523 4.477 10 10 10h142.526c5.523 0 10-4.477 10-10V78.658h3.738c5.522 0 10-4.477 10-10V23.155c.001-5.523-4.477-10-9.999-10zm-63.965 89.262h-42.072c-4.411 0-8-3.589-8-8s3.589-8 8-8h42.072c4.411 0 8 3.589 8 8s-3.589 8-8 8zm53.965-43.759h-150V33.155h150v25.503z"/></svg>                                                
                                                    </a>
                                                </td>

                                                <!-- CASO: BODEGA DE VUELTA -->
                                                @if($activo->estado == "RECIBIDO" || $activo->estado == "NO DISPONIBLE")
                                                    <td class="align-middle text-center">
                                                        <a href="{{ route('mantencion.create', [$activo->id]) }}">
                                                            <button id="iniciar_mantencion" class="btn btn-sm btn-success" type="button" data-toggle="tooltip" data-placement="top" title="INICIAR MANTENCIÓN">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 512 512" xml:space="preserve"><path d="m360.102 240.012 10.156-10.266s15.609-13.406 33.406-7.328c30.984 10.578 66.781-.875 91.609-25.734 7.063-7.063 15.641-21.234 15.641-21.234a5.596 5.596 0 0 0 .922-4.672l-1.922-7.906a5.671 5.671 0 0 0-2.625-3.531 5.566 5.566 0 0 0-4.344-.547l-60.984 16.969a5.648 5.648 0 0 1-6.063-2.109l-28.015-38.594a5.564 5.564 0 0 1-1.016-4.063l5.641-41a5.595 5.595 0 0 1 4.063-4.656l64.406-17.922c2.906-.813 4.672-3.813 3.953-6.766l-2.547-10.359a5.61 5.61 0 0 0-2.563-3.5s-5.047-3.344-8.719-5.234c-36.578-18.891-82.64-13.031-113.312 17.656-22.656 22.656-31.531 53.688-27.375 83.156 3.203 22.656 1.703 34.703-8.078 45.047-.891.922-3.703 3.734-8.047 8l45.813 44.593zm-148.719 55.406A183455.446 183455.446 0 0 1 68.461 433.715a13.135 13.135 0 0 0-4.047 9.313 13.092 13.092 0 0 0 3.813 9.375l31.938 31.938a13.071 13.071 0 0 0 9.391 3.813 13.018 13.018 0 0 0 9.281-4.031L258.165 343.17l-46.782-47.752zM501.43 451.371a13.008 13.008 0 0 0 3.813-9.375c-.031-3.516-1.5-6.859-4.031-9.297L227.415 166.246l-43.953 43.969L450.805 483.09c2.438 2.547 5.781 4 9.297 4.047s6.891-1.344 9.391-3.828l31.937-31.938zM254.196 32.621c-32.969-12.859-86.281-14.719-117.156 16.141a472188.334 472188.334 0 0 0-59.875 59.891c-12.672 12.656-.906 25.219-10.266 34.563-9.359 9.359-24.313 0-32.734 8.422L3.29 182.527c-4.391 4.375-4.391 11.5 0 15.891l43.016 43.016c4.391 4.391 11.516 4.391 15.906 0l30.875-30.875c8.438-8.422-.938-23.375 8.438-32.719 12.609-12.625 26.375-10.484 34.328-2.547l15.891 15.891 17.219 4.531 43.953-43.953-5.063-16.688c-14.016-14.031-16.016-30.266-7.234-39.047 13.594-13.594 36.047-33.234 57.078-41.656 13.405-5.359 9.358-18.703-3.501-21.75zm-59.625 70.859c-.063.047 5.859-7.281 5.969-7.375l-5.969 7.375z" style="fill:#000"/></svg>                                                                    
                                                        </a>
                                                    </td>
                                                @else
                                                    <td class="align-middle text-center">
                                                        <a href="#">
                                                            <button disabled class="btn btn-sm btn-success" type="button" data-toggle="tooltip" data-placement="top" title="INICIAR MANTENCIÓN">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 512 512" xml:space="preserve"><path d="m360.102 240.012 10.156-10.266s15.609-13.406 33.406-7.328c30.984 10.578 66.781-.875 91.609-25.734 7.063-7.063 15.641-21.234 15.641-21.234a5.596 5.596 0 0 0 .922-4.672l-1.922-7.906a5.671 5.671 0 0 0-2.625-3.531 5.566 5.566 0 0 0-4.344-.547l-60.984 16.969a5.648 5.648 0 0 1-6.063-2.109l-28.015-38.594a5.564 5.564 0 0 1-1.016-4.063l5.641-41a5.595 5.595 0 0 1 4.063-4.656l64.406-17.922c2.906-.813 4.672-3.813 3.953-6.766l-2.547-10.359a5.61 5.61 0 0 0-2.563-3.5s-5.047-3.344-8.719-5.234c-36.578-18.891-82.64-13.031-113.312 17.656-22.656 22.656-31.531 53.688-27.375 83.156 3.203 22.656 1.703 34.703-8.078 45.047-.891.922-3.703 3.734-8.047 8l45.813 44.593zm-148.719 55.406A183455.446 183455.446 0 0 1 68.461 433.715a13.135 13.135 0 0 0-4.047 9.313 13.092 13.092 0 0 0 3.813 9.375l31.938 31.938a13.071 13.071 0 0 0 9.391 3.813 13.018 13.018 0 0 0 9.281-4.031L258.165 343.17l-46.782-47.752zM501.43 451.371a13.008 13.008 0 0 0 3.813-9.375c-.031-3.516-1.5-6.859-4.031-9.297L227.415 166.246l-43.953 43.969L450.805 483.09c2.438 2.547 5.781 4 9.297 4.047s6.891-1.344 9.391-3.828l31.937-31.938zM254.196 32.621c-32.969-12.859-86.281-14.719-117.156 16.141a472188.334 472188.334 0 0 0-59.875 59.891c-12.672 12.656-.906 25.219-10.266 34.563-9.359 9.359-24.313 0-32.734 8.422L3.29 182.527c-4.391 4.375-4.391 11.5 0 15.891l43.016 43.016c4.391 4.391 11.516 4.391 15.906 0l30.875-30.875c8.438-8.422-.938-23.375 8.438-32.719 12.609-12.625 26.375-10.484 34.328-2.547l15.891 15.891 17.219 4.531 43.953-43.953-5.063-16.688c-14.016-14.031-16.016-30.266-7.234-39.047 13.594-13.594 36.047-33.234 57.078-41.656 13.405-5.359 9.358-18.703-3.501-21.75zm-59.625 70.859c-.063.047 5.859-7.281 5.969-7.375l-5.969 7.375z" style="fill:#000"/></svg>                                                                    
                                                        </a>
                                                    </td>
                                                @endif

                                                @if($activo->estado == "VENDIDO")
                                                    <td class="align-middle text-center">
                                                        <button id="terminar_venta" data-activo-id="{{ $activo->id }}" class="btn btn-sm btn-danger terminar-venta-btn" data-toggle="tooltip" data-placement="top" title="TERMINAR VENTA" type="button">
                                                        <svg width="24" height="24" viewBox="0 0 30 30" xmlns="http://www.w3.org/2000/svg"><path d="M5.5 5c-.655 0-.66 1.01 0 1h22c.286 0 .5.214.5.5v13c0 .66 1 .66 1 0v-13c0-.822-.678-1.5-1.5-1.5h-22zm-2 2c-.654 0-.654 1 0 1h22c.286 0 .5.214.5.5v13c0 .665 1.01.66 1 0v-13c0-.822-.678-1.5-1.5-1.5h-22zm-2 2C.678 9 0 9.678 0 10.5v12c0 .822.678 1.5 1.5 1.5h22c.822 0 1.5-.678 1.5-1.5v-12c0-.822-.678-1.5-1.5-1.5h-22zm0 1h22c.286 0 .5.214.5.5v12c0 .286-.214.5-.5.5h-22a.488.488 0 0 1-.5-.5v-12c0-.286.214-.5.5-.5zm1 1a.5.5 0 0 0-.5.5v2c0 .672 1 .656 1 0V12h1.5c.672 0 .656-1 0-1h-2zm10 0C9.468 11 7 13.468 7 16.5S9.468 22 12.5 22s5.5-2.468 5.5-5.5-2.468-5.5-5.5-5.5zm8 0c-.656 0-.672 1 0 1H22v1.5c0 .656 1 .672 1 0v-2a.5.5 0 0 0-.5-.5h-2zm-8 1c2.49 0 4.5 2.01 4.5 4.5S14.99 21 12.5 21 8 18.99 8 16.5s2.01-4.5 4.5-4.5zm0 1c-.277 0-.5.223-.5.5v.594c-.578.21-1 .76-1 1.406 0 .82.68 1.5 1.5 1.5.28 0 .5.212.5.5 0 .288-.22.5-.5.5h-1c-.338-.005-.5.248-.5.5s.162.505.5.5h.5v.5a.499.499 0 1 0 1 0v-.594c.578-.21 1-.76 1-1.406 0-.82-.68-1.5-1.5-1.5a.49.49 0 0 1-.5-.5c0-.288.22-.5.5-.5h1c.338.005.5-.248.5-.5s-.162-.505-.5-.5H13v-.5c0-.277-.223-.5-.5-.5zm-10 6.002c-.25-.002-.5.162-.5.498v2a.5.5 0 0 0 .5.5h2c.656 0 .672-1 0-1H3v-1.5c0-.328-.25-.496-.5-.498zm20 0c-.25.002-.5.17-.5.498V21h-1.5c-.672 0-.656 1 0 1h2a.5.5 0 0 0 .5-.5v-2c0-.336-.25-.5-.5-.498z"/></svg>                                                        
                                                    </td>
                                                    
                                                @else
                                                    <td class="align-middle text-center">
                                                        <button disabled id="iniciar_venta" data-activo-id="{{ $activo->id }}" class="btn btn-sm btn-success" data-toggle="tooltip" data-placement="top" title="VENDER" type="button">
                                                        <svg width="24" height="24" viewBox="0 0 30 30" xmlns="http://www.w3.org/2000/svg"><path d="M5.5 5c-.655 0-.66 1.01 0 1h22c.286 0 .5.214.5.5v13c0 .66 1 .66 1 0v-13c0-.822-.678-1.5-1.5-1.5h-22zm-2 2c-.654 0-.654 1 0 1h22c.286 0 .5.214.5.5v13c0 .665 1.01.66 1 0v-13c0-.822-.678-1.5-1.5-1.5h-22zm-2 2C.678 9 0 9.678 0 10.5v12c0 .822.678 1.5 1.5 1.5h22c.822 0 1.5-.678 1.5-1.5v-12c0-.822-.678-1.5-1.5-1.5h-22zm0 1h22c.286 0 .5.214.5.5v12c0 .286-.214.5-.5.5h-22a.488.488 0 0 1-.5-.5v-12c0-.286.214-.5.5-.5zm1 1a.5.5 0 0 0-.5.5v2c0 .672 1 .656 1 0V12h1.5c.672 0 .656-1 0-1h-2zm10 0C9.468 11 7 13.468 7 16.5S9.468 22 12.5 22s5.5-2.468 5.5-5.5-2.468-5.5-5.5-5.5zm8 0c-.656 0-.672 1 0 1H22v1.5c0 .656 1 .672 1 0v-2a.5.5 0 0 0-.5-.5h-2zm-8 1c2.49 0 4.5 2.01 4.5 4.5S14.99 21 12.5 21 8 18.99 8 16.5s2.01-4.5 4.5-4.5zm0 1c-.277 0-.5.223-.5.5v.594c-.578.21-1 .76-1 1.406 0 .82.68 1.5 1.5 1.5.28 0 .5.212.5.5 0 .288-.22.5-.5.5h-1c-.338-.005-.5.248-.5.5s.162.505.5.5h.5v.5a.499.499 0 1 0 1 0v-.594c.578-.21 1-.76 1-1.406 0-.82-.68-1.5-1.5-1.5a.49.49 0 0 1-.5-.5c0-.288.22-.5.5-.5h1c.338.005.5-.248.5-.5s-.162-.505-.5-.5H13v-.5c0-.277-.223-.5-.5-.5zm-10 6.002c-.25-.002-.5.162-.5.498v2a.5.5 0 0 0 .5.5h2c.656 0 .672-1 0-1H3v-1.5c0-.328-.25-.496-.5-.498zm20 0c-.25.002-.5.17-.5.498V21h-1.5c-.672 0-.656 1 0 1h2a.5.5 0 0 0 .5-.5v-2c0-.336-.25-.5-.5-.498z"/></svg>                                                        
                                                    </td>
                                                    
                                                @endif
                                            @endif
                                        </tr>
                                    @endforeach                                                            
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- End Row -->
            </div>
        </div>


        @if(count($activos))
            <!-- Agrega este código al final de tu vista Blade para crear el modal -->
            <div class="modal fade" id="terminarMantencionModal" tabindex="-1" aria-labelledby="terminarMantencionModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form action="{{ route('mantencion.finish') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input hidden name="activo_id" id="activo_id" type="text">
                            <div class="modal-header">
                                <h5 class="modal-title" id="terminarMantencionModalLabel">Terminar Mantención</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="">
                                    <label for="documento" class="form-label">Documento</label>
                                    <input type="file" class="dropify" id="documento" name="documento">
                                </div>
                                <div class="checkbox-container">
                                    <div class="material-switch">
                                        <input class="estado-checkbox" name="estado-checkbox" type="checkbox" id="estado-checkbox"/>
                                        <label for="estado-checkbox" class="label-danger"></label>
                                    </div>
                                    <h5>ACTIVO INOPERATIVO</h5>
                                </div>
                                
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">Terminar Mantención</button>
                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Agrega este código al final de tu vista Blade para crear el modal -->
            <div class="modal fade" id="terminarVentaModal" tabindex="-1" aria-labelledby="terminarVentaModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form action="{{ route('venta.finish') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input hidden name="activo_id_venta" id="activo_id_venta" type="text">
                            <div class="modal-header">
                                <h5 class="modal-title" id="terminarVentaModalLabel">Terminar Venta</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label for="documento" class="form-label">Documento</label>
                                    <input type="file" class="dropify" id="documento" name="documento">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">Terminar Venta</button>
                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        @endif

        <!-- Debo colocar el script dentro de la "section" para que logre acceder al input "foto" -->
        <script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
        <link href="https://nightly.datatables.net/css/jquery.dataTables.css" rel="stylesheet" type="text/css" />
        <script src="https://nightly.datatables.net/js/jquery.dataTables.js"></script>

        <script type="text/javascript">
            $(document).ready(function () {
                //Inicializamos DROPIFY
                $('.dropify').dropify();
                // Captura el evento de clic en los botones "Terminar Mantención"
                $('.terminar-mantencion-btn').on('click', function () {
                    var activoId = $(this).data('activo-id'); // Obtiene el valor de data-activo-id
                    $('#activo_id').val(activoId); // Establece el valor en el campo activo_id del formulario
                    $('#terminarMantencionModal').modal('show'); // Muestra el modal
                });

                $('.terminar-venta-btn').on('click', function () {
                    var activoId = $(this).data('activo-id'); // Obtiene el valor de data-activo-id
                    $('#activo_id_venta').val(activoId); // Establece el valor en el campo activo_id del formulario
                    $('#terminarVentaModal').modal('show'); // Muestra el modal
                });

                //FILTROS
                var table = $('.datatable').DataTable({
                    orderCellsTop: true,
                    fixedHeader: true,
                    columnDefs: [
                        {
                            targets: [0], // El índice de la columna que quieres ocultar (cambia esto al índice de tu columna)
                            visible: false, // Establece esta columna como no visible
                            searchable: true // Opcional: permite buscar en esta columna
                        }
                    ]
                    
                });

                $('#estado').on( 'keyup change', function () {
                    if ( table.column(0).search() !== this.value ) {
                        table
                            .column(0)
                            .search( this.value )
                            .draw();
                    }
                });
                
            });

            var uploadField = document.getElementById("documento");
            uploadField.onchange = function() {
                if(this.files[0].size > 2097152){
                    alert("Ingresa un archivo de máximo 2 [Mb]");
                    this.value = "";
                };
            };

        </script>

        <script src="{{ asset('dropify/js/dropify.js' )}}"></script>

        <!-- INTERNAL File Uploads css-->
        <link href="{{asset('assets/plugins/fileupload/css/fileupload.css')}}" rel="stylesheet" type="text/css" />


        @overwrite
        @include('layouts.card')
    @endpush

@endsection
