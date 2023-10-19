@extends('layouts.app')

<style>
    .flex-end {
        display: block;
        margin-left: auto;
        margin-right: 0;
      }

    table, th, td {
        border: 1px solid black;
        border-collapse: collapse;
    }
    table{
        width: 100%;
    }
    .table-bordered {
        border-radius: 10px; /* Adjust the radius as needed */
    }
    /* Add rounded corners to the table container */
    .table-responsive {
        border-radius: 10px; /* Adjust the radius as needed */
        overflow: hidden; /* Hide the overflowing content */
    }

    /* Estilo para la celda de la imagen */
    .image-cell {
        max-width: 100%; /* Establece el ancho máximo de la celda */
        overflow: hidden; /* Evita que el contenido se desborde */
    }

    .button-container {
        display: flex;
        flex-direction: column; /* Coloca los botones en columnas */
    }

    .button-container .btn {
        flex: 1; /* Distribuye el espacio de manera uniforme entre los botones */
        width: 100%; /* Asegura que todos los botones tengan el mismo ancho */
        margin-bottom: 5px; /* Espacio entre los botones */
    }

</style>

@section('content')

    @section('title')
    &nbsp;
    <h3>
        Trazabilidad
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
                                    <label class="col-md-3 form-label mt-2">Estado del arriendo/venta: </label>
                                    <div class="col-md-9">
                                        <select class="form-control" id="estado" name="estado" placeholder="Buscar por estado del arriendo.">
                                            <option value="{{null}}">Todos los arriendos y ventas</option>
                                            <option value="BODEGA">BODEGA</option>
                                            <option value="EN CAMINO IDA">EN CAMINO IDA</option>
                                            <option value="EN CLIENTE">EN CLIENTE</option>
                                            <option value="EN CAMINO VUELTA">EN CAMINO VUELTA</option>
                                            <option value="BODEGA DE VUELTA">BODEGA DE VUELTA</option>
                                            <option value="TERMINADO">TERMINADO</option>
                                        </select>
                                    </div>
                                </div>
                                
                                <div class="form-group row">
                                    <label class="col-md-3 form-label mt-2">Proyecto:</label>
                                    
                                    <div class="col-md-9">
                                        <div class="dropdown">
                                            <select class="form-control " id="proyecto" name="proyecto" >
                                                <option value="{{null}}">Todos los proyectos</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                
                                
                            </form>
                        </div>

                        <div class="col-lg-6 col-md-12">
                            <form class="form-horizontal">
                                <div class="form-group row">
                                    <label class="col-md-3 form-label mt-2">Empresa: </label>
                                    
                                    <div class="col-md-9">
                                        <div class="dropdown">
                                            <select class="form-control " id="empresa" name="empresa" placeholder="Buscar por empresa.">
                                                <option value="{{null}}">Todas las empresas</option>
                                                @foreach ($empresas as $value)
                                                    <option value="{{ $value->id }}" {{ $value->id == $selectedID ? 'selected' : '' }}>
                                                        {{ $value->nombre." - ".$value->rut}}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>

                        
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('cards')
        @section('card_title')
            Arriendo de Activos
        @overwrite
        
        @section('card_content')

        <div class="row">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Procesos de Arriendo</h4>    
                    <div class="btn-list flex-end">
                        <!--
                        <a class="btn btn-success btn-svgs btn-svg-white" href="{{url('/arriendo/create',[0])}}">
                            <svg class="svg-icon" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24">
                                <path d="M0 0h24v24H0V0z" fill="none"></path>
                                <path d="M13 4H6v16h12V9h-5V4zm3 14H8v-2h8v2zm0-6v2H8v-2h8z" opacity=".3"></path>
                                <path d="M8 16h8v2H8zm0-4h8v2H8zm6-10H6c-1.1 0-2 .9-2 2v16c0 1.1.89 2 1.99 2H18c1.1 0 2-.9 2-2V8l-6-6zm4 18H6V4h7v5h5v11z"></path>
                            </svg>                                
                            <span class="btn-svg-text mt-1">Ingresar Arriendo</span>
                        </a>
                        -->
                    </div>
                </div>

                <!-- Row -->
                <div class="row flex-lg-nowrap">
                    <div class="col-12">
                        <div class="row flex-lg-nowrap">
                            <div class="col-12 mb-3">
                                <div class="e-panel card">
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class='table table-bordered data-table-global datatable'>
                                                <thead>
                                                    <tr>
                                                        <th class="border-bottom-0">Estado</th>
                                                        <th class="border-bottom-0">Proyecto ID</th>
                                                        <th class="border-bottom-0">Empresa ID</th>
                                                        <th class="border-bottom-0">Activo</th>
                                                        <th class="border-bottom-0">Código Interno</th>
                                                        <th class="border-bottom-0">Estado Arriendo</th>
                                                        <th class="border-bottom-0">Fecha Inicio</th>
                                                        <th class="border-bottom-0">Fecha Término</th>
                                                        <th class="border-bottom-0">Acciones</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @if($arriendos)
                                                        @foreach ($arriendos as $arriendo)
                                                            <tr>
                                                                <td class="align-middle">{{$arriendo->estado}}</td>
                                                                <td class="align-middle">{{$arriendo->proyecto_id}}</td>
                                                                <td class="align-middle">{{$arriendo->proyecto->empresa->id}}</td>
                                                                <td class="align-middle">
                                                                    <div class="d-flex align-items-center"> <!-- Adjusted here -->
                                                                        @if($arriendo->activo->foto)
                                                                            <span class="avatar brround avatar-xxl d-block" style="background-image: url({{Storage::url('activos/'.$arriendo->activo->id."/".$arriendo->activo->foto)}})"></span>
                                                                        @else
                                                                            <span class="avatar brround avatar-xxl d-block" style="background-image: url({{asset('assets/images/brand/favicon1.png')}})"></span>
                                                                        @endif                                                                        
                                                                        <div class="ms-3"> <!-- Adjusted here -->
                                                                            <h6 class="mb-0 font-weight-bold">{{$arriendo->activo->marca." - ".$arriendo->activo->modelo." - ".$arriendo->activo->año}}</h6>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                                <td class="align-middle"><span>{{$arriendo->activo->codigo_interno}}</span></td>
                                                                <td class="align-middle image-cell">
                                                                    <!-- State 1 -->
                                                                    @if($arriendo->estado == "BODEGA")
                                                                    <img src="{{ asset('assets/images/arriendo/state1.svg') }}" alt="State 1">
                                                                    @elseif($arriendo->estado == "EN CAMINO IDA")
                                                                    <!-- State 2 -->
                                                                    <img src="{{ asset('assets/images/arriendo/state2.svg') }}" alt="State 2">
                                                                    @elseif($arriendo->estado == "EN CLIENTE")
                                                                    <!-- State 3 -->
                                                                    <img src="{{ asset('assets/images/arriendo/state3.svg') }}" alt="State 3">
                                                                    @elseif($arriendo->estado == "EN CAMINO VUELTA")
                                                                    <!-- State 4 -->
                                                                    <img src="{{ asset('assets/images/arriendo/state4.svg') }}" alt="State 4">
                                                                    @elseif($arriendo->estado == "BODEGA DE VUELTA")
                                                                    <!-- State 5 -->
                                                                    <img src="{{ asset('assets/images/arriendo/state5.svg') }}" alt="State 5">
                                                                    @else
                                                                    <h6 class="mb-0 font-weight-bold">TERMINADO</h6>
                                                                    @endif

                                                                </td>
                                                                <td class="align-middle">
                                                                    <div class="wrapper">
                                                                        <p class="mt-2 text-muted ">{{Carbon\Carbon::parse($arriendo->fecha_termino)->format('d-m-Y')}}</p>
                                                                    </div>
                                                                </td>
                                                                <td class="align-middle">
                                                                    <div class="wrapper">
                                                                        <p class="mt-2 text-muted ">{{Carbon\Carbon::parse($arriendo->fecha_termino)->format('d-m-Y')}}</p>
                                                                    </div>
                                                                </td>
                                                                <td class="align-middle">
                                                                    <div class="d-flex flex-column align-items-center"> <!-- Columnas separadas -->
                                                                        <form method="POST" action="{{ route('transporte.cambio_fase') }}">
                                                                            @csrf
                                                                            <input hidden type="integer" id="activo_id" name="activo_id" value="{{$arriendo->activo->id}}">

                                                                            <div class="button-container">
                                                                                <a class="btn btn-sm btn-primary mb-1" type="button" href="{{route('arriendo.show', [$arriendo->id])}}">Ver</a>
                                                                                @if($arriendo->estado == "EN CLIENTE" && $arriendo->activo->estado == "ARRENDADO")
                                                                                    <button class="btn btn-sm btn-success flex-fill mb-1" type="submit"><i class="fe fe-check-square"></i> Disponibilizar para retiro </button>
                                                                                    <a class="btn btn-sm btn-primary flex-fill mb-1" type="button" href="{{route('traspaso.create', [$arriendo->id])}}"><i class="fe fe-truck"></i> Traspasar</a>
                                                                                @elseif($arriendo->estado == "BODEGA DE VUELTA" && $arriendo->activo->estado != "EN MANTENCION")
                                                                                    <button class="btn btn-sm btn-success flex-fill mb-1" type="submit" data-bs-toggle="" data-bs-target="#user-form-modal">Confirmación FINAL</button>
                                                                                @endif
                                                                                <button class="btn btn-sm btn-danger flex-fill" type="button"><i class="fe fe-trash-2"></i></button>
                                                                            </div>
                                                                        </form>
                                                                    </div>
                                                                </td>
                                                                
                                                            </tr>
                                                        @endforeach
                                                    @endif
                                                </tbody>
                                            </table>
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





    @push('cards')
        @section('card_title')
            Venta de Activos
        @overwrite
        
        @section('card_content')

        <div class="row">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Procesos de Venta</h4>    
                    <div class="btn-list flex-end">
                        <!--
                        <a class="btn btn-success btn-svgs btn-svg-white" href="{{url('/arriendo/create',[0])}}">
                            <svg class="svg-icon" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24">
                                <path d="M0 0h24v24H0V0z" fill="none"></path>
                                <path d="M13 4H6v16h12V9h-5V4zm3 14H8v-2h8v2zm0-6v2H8v-2h8z" opacity=".3"></path>
                                <path d="M8 16h8v2H8zm0-4h8v2H8zm6-10H6c-1.1 0-2 .9-2 2v16c0 1.1.89 2 1.99 2H18c1.1 0 2-.9 2-2V8l-6-6zm4 18H6V4h7v5h5v11z"></path>
                            </svg>                                
                            <span class="btn-svg-text mt-1">Ingresar Arriendo</span>
                        </a>
                        -->
                    </div>
                </div>

                <!-- Row -->
                <div class="row flex-lg-nowrap">
                    <div class="col-12">
                        <div class="row flex-lg-nowrap">
                            <div class="col-12 mb-3">
                                <div class="e-panel card">
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class='table table-bordered data-table-global datatable_venta'>
                                                <thead>
                                                    <tr>
                                                        <th class="border-bottom-0">Estado</th>
                                                        <th class="border-bottom-0">Proyecto ID</th>
                                                        <th class="border-bottom-0">Empresa ID</th>
                                                        <th class="border-bottom-0">Activo</th>
                                                        <th class="border-bottom-0">Código Interno</th>
                                                        <th class="border-bottom-0">Estado Venta</th>
                                                        <th class="border-bottom-0">Fecha Inicio</th>
                                                        <th class="border-bottom-0">Fecha Término</th>
                                                        <th class="border-bottom-0">Acciones</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @if($ventas)
                                                        @foreach ($ventas as $venta)
                                                            <tr>
                                                                <td class="align-middle">{{$venta->estado}}</td>
                                                                <td class="align-middle">{{$venta->proyecto_id}}</td>
                                                                <td class="align-middle">{{$venta->proyecto->empresa->id}}</td>
                                                                <td class="align-middle">
                                                                    <div class="d-flex align-items-center"> <!-- Adjusted here -->
                                                                        @if($venta->activo->foto)
                                                                            <span class="avatar brround avatar-xxl d-block" style="background-image: url({{Storage::url('activos/'.$venta->activo->id."/".$venta->activo->foto)}})"></span>
                                                                        @else
                                                                            <span class="avatar brround avatar-xxl d-block" style="background-image: url({{asset('assets/images/brand/favicon1.png')}})"></span>
                                                                        @endif                                                                        
                                                                        <div class="ms-3"> <!-- Adjusted here -->
                                                                            <h6 class="mb-0 font-weight-bold">{{$venta->activo->marca." - ".$venta->activo->modelo." - ".$venta->activo->año}}</h6>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                                <td class="align-middle"><span>{{$venta->activo->codigo_interno}}</span></td>
                                                                @if($venta->estado == "TERMINADO")
                                                                    <td class="align-middle">
                                                                        <h6 class="mb-0 font-weight-bold">TERMINADO</h6>
                                                                    </td>
                                                                @else
                                                                    <td class="align-middle image-cell">
                                                                        <!-- State 1 -->
                                                                        @if($venta->estado == "BODEGA")
                                                                        <img src="{{ asset('assets/images/arriendo/state1.svg') }}" alt="State 1">
                                                                        @elseif($venta->estado == "EN CAMINO IDA")
                                                                        <!-- State 2 -->
                                                                        <img src="{{ asset('assets/images/arriendo/state2.svg') }}" alt="State 2">
                                                                        @elseif($venta->estado == "EN CLIENTE")
                                                                        <!-- State 3 -->
                                                                        <img src="{{ asset('assets/images/arriendo/state3.svg') }}" alt="State 3">
                                                                        @elseif($venta->estado == "EN CAMINO VUELTA")
                                                                        <!-- State 4 -->
                                                                        <img src="{{ asset('assets/images/arriendo/state4.svg') }}" alt="State 4">
                                                                        @elseif($venta->estado == "BODEGA DE VUELTA")
                                                                        <!-- State 5 -->
                                                                        <img src="{{ asset('assets/images/arriendo/state5.svg') }}" alt="State 5">
                                                                        @endif

                                                                    </td>
                                                                    @endif
                                                                <td class="align-middle">
                                                                    <div class="wrapper">
                                                                        <p class="mt-2 text-muted ">{{Carbon\Carbon::parse($venta->fecha_termino)->format('d-m-Y')}}</p>
                                                                    </div>
                                                                </td>
                                                                <td class="align-middle">
                                                                    <div class="wrapper">
                                                                        <p class="mt-2 text-muted ">{{Carbon\Carbon::parse($venta->fecha_termino)->format('d-m-Y')}}</p>
                                                                    </div>
                                                                </td>
                                                                <td class="align-middle">
                                                                    <div class="d-flex flex-column align-items-center"> <!-- Columnas separadas -->
                                                                        <form method="POST" action="{{ route('transporte.cambio_fase') }}">
                                                                            @csrf
                                                                            <input hidden type="integer" id="activo_id" name="activo_id" value="{{$venta->activo->id}}">

                                                                            <div class="button-container">
                                                                                <a class="btn btn-sm btn-primary mb-1" type="button" href="{{route('venta.show', [$venta->id])}}">Ver</a>
                                                                                @if($venta->estado == "EN CLIENTE" && $venta->activo->estado == "ARRENDADO")
                                                                                    <button class="btn btn-sm btn-success flex-fill mb-1" type="submit"><i class="fe fe-check-square"></i> Disponibilizar para retiro </button>
                                                                                    <!--
                                                                                    <a class="btn btn-sm btn-primary flex-fill mb-1" type="button" href="{{route('traspaso.create', [$venta->id])}}"><i class="fe fe-truck"></i> Traspasar</a>
                                                                                    -->
                                                                                @elseif($venta->estado == "BODEGA DE VUELTA" && $venta->activo->estado != "EN MANTENCION")
                                                                                    <button class="btn btn-sm btn-success flex-fill mb-1" type="submit" data-bs-toggle="" data-bs-target="#user-form-modal">Confirmación FINAL</button>
                                                                                @endif
                                                                                <button class="btn btn-sm btn-danger flex-fill" type="button"><i class="fe fe-trash-2"></i></button>
                                                                            </div>
                                                                        </form>
                                                                    </div>
                                                                </td>
                                                                
                                                            </tr>
                                                        @endforeach
                                                    @endif
                                                </tbody>
                                            </table>
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











    <link href="https://nightly.datatables.net/css/jquery.dataTables.css" rel="stylesheet" type="text/css" />


    <script>
        document.addEventListener("DOMContentLoaded", function () {
            var empresaSelect = document.getElementById("empresa");
            var proyectoSelect = document.getElementById("proyecto");
            var proyectos = {!! $proyectos->toJson() !!}; // Convierte la colección de sub_familias a un array JavaScript
            
            // Función para actualizar las opciones del input de sub_familias
            function actualizarProyectos() {
                var selectedEmpresaId = empresaSelect.value;
    
                // Limpiar las opciones actuales
                proyectoSelect.innerHTML = '';
    
                // Agregar la opción predeterminada
                var defaultOption = document.createElement("option");
                defaultOption.value = {{!! null !!}};
                defaultOption.text = "Seleccione alguno de los proyectos";
                proyectoSelect.appendChild(defaultOption);
    
                // Agregar las sub_familias correspondientes a la familia seleccionada
                proyectos[selectedEmpresaId].forEach(function (proyecto) {
                    var option = document.createElement("option");
                    option.value = proyecto.id;
                    option.text = "[ "+proyecto.codigo_sap+" ] "+proyecto.nombre_sap;
                    proyectoSelect.appendChild(option);
                });
            }
    
            // Asignar el evento change al input de familias
            empresaSelect.addEventListener("change", function () {
                actualizarProyectos();
            });
    
        });
    </script>

    <script type="text/javascript">
        $(document).ready(function () {

            //FILTROS
            var table = $('.datatable').DataTable({
                orderCellsTop: true,
                fixedHeader: true,
                columnDefs: [
                    {
                        targets: [0,1,2], // El índice de la columna que quieres ocultar (cambia esto al índice de tu columna)
                        visible: false, // Establece esta columna como no visible
                        searchable: true // Opcional: permite buscar en esta columna
                    }
                ]
            });

            var table_venta = $('.datatable_venta').DataTable({
                orderCellsTop: true,
                fixedHeader: true,
                columnDefs: [
                    {
                        targets: [0,1,2], // El índice de la columna que quieres ocultar (cambia esto al índice de tu columna)
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
                if ( table_venta.column(0).search() !== this.value ) {
                    table_venta
                        .column(0)
                        .search( this.value )
                        .draw();
                }
            });

            $('#empresa').on( 'keyup change', function () {
                if ( table.column(2).search() !== this.value ) {
                    table
                        .column(2)
                        .search( this.value )
                        .draw();
                }
                if ( table_venta.column(2).search() !== this.value ) {
                    table_venta
                        .column(2)
                        .search( this.value )
                        .draw();
                }
            });

            $('#proyecto').on( 'keyup change', function () {
                if ( table.column(1).search() !== this.value ) {
                    table
                        .column(1)
                        .search( this.value )
                        .draw();
                }
                if ( table_venta.column(1).search() !== this.value ) {
                    table_venta
                        .column(1)
                        .search( this.value )
                        .draw();
                }
            });
            
        });

    </script>

@endsection
