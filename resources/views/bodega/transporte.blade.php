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
    
</style>

@section('content')

    @section('title')
    &nbsp;
    <h3>
        Gestión de Transporte
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
                                    <label class="col-md-3 form-label mt-2">Tipo de Proceso:</label>
                                    
                                    <div class="col-md-9">
                                        <div class="dropdown">
                                            <select class="form-control " id="tipo_proceso" name="tipo_proceso" >
                                                <option selected value="Arriendos">Arriendos</option>
                                                <option value="Ventas">Ventas</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

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

                        <div class="col-lg-6 col-md-12">
                            <form class="form-horizontal">
                                <div class="form-group row">
                                    <label class="col-md-3 form-label mt-2">Estado del proceso: </label>
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

                        
                    </div>
                </div>
            </div>
        </div>
    </div>


    @push('cards')
        @section('card_title')
            <h4 class="card-title" id="table_header">Procesos de Arriendos</h4>
        @overwrite
        
        @section('card_content')

            <!-- Row -->
            <div class="table-responsive">
                <table class='table table-bordered data-table-global datatable'>
                    <thead>
                        <tr>
                            <th >DETALLES</th>
                        </tr>
                    </thead>
                </table>
            </div>
            <!-- End Row -->

        @overwrite
        @include('layouts.card')
    @endpush


    {{-- @push('cards')
        @section('card_title')
            Procesos de <b>Arriendo</b>
        @overwrite
            
        @section('card_content')

        <div class="row">
            <div class="card">
                <!--
                <div class="card-header">
                    <h4 class="card-title">Todos los Arriendos</h4>    
                    
                    <div class="btn-list flex-end">
                        <a class="btn btn-success btn-svgs btn-svg-white" href="{{url('/proyecto/create')}}">
                            <svg class="svg-icon" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24">
                                <path d="M0 0h24v24H0V0z" fill="none"></path>
                                <path d="M13 4H6v16h12V9h-5V4zm3 14H8v-2h8v2zm0-6v2H8v-2h8z" opacity=".3"></path>
                                <path d="M8 16h8v2H8zm0-4h8v2H8zm6-10H6c-1.1 0-2 .9-2 2v16c0 1.1.89 2 1.99 2H18c1.1 0 2-.9 2-2V8l-6-6zm4 18H6V4h7v5h5v11z"></path>
                            </svg>                                
                            <span class="btn-svg-text mt-1">Crear Proyecto</span>
                        </a>
                    </div>
                    
                </div>
                -->

                @if(count($arriendos))
                    <!-- Row -->
                    <div class="row flex-lg-nowrap">
                        <div class="col-12">
                            <div class="row flex-lg-nowrap">
                                <div class="col-12 mb-3">
                                    <div class="">
                                        <div class="">
                                            <div class="row">
                                                <div class="col-6 mb-4">

                                                </div>
                                            </div>
                                            <div class="row">
                                                @foreach ($arriendos as $arriendo)
                                                <div class="col-xl-3 col-lg-6">
                                                    <div class="card text-start user-contact-list">
                                                        <div class="">
                                                            <div class="card-header border-bottom text-white p-5" style="background: linear-gradient(135deg, rgb(241, 196, 111) 60%, rgb(214, 87, 2));">
                                                                @if($arriendo->activo->foto)
                                                                        <span class="avatar brround avatar-xxl d-block" style="background-image: url({{Storage::url('activos/'.$arriendo->activo->id."/".$arriendo->activo->foto)}})"></span>
                                                                    @else
                                                                        <span class="avatar brround avatar-xxl d-block" style="background-image: url({{asset('assets/images/brand/favicon1.png')}})"></span>
                                                                    @endif 
                                                                <div class=" ms-3 text-white">
                                                                    <p class="mb-0 mt-1 fs-18 font-weight-semibold">{{$arriendo->activo->marca}}<br>{{$arriendo->activo->modelo}}<br>{{$arriendo->activo->año}}</p>

                                                                    <small class="">ID ARRIENDO: {{$arriendo->id}}</small>
                                                                </div>
                                                            </div>
                                                            <div class="p-5">
                                                                <div class="wrapper">
                                                                    <p class="fs-14 font-weight-bold">ESTADO ARRIENDO :</p>
                                                                    <!-- State 1 -->
                                                                    @if($arriendo->estado == "BODEGA")
                                                                    <p class="mt-2 text-info ">BODEGA</p>
                                                                    @elseif($arriendo->estado == "EN CAMINO IDA")
                                                                    <!-- State 2 -->
                                                                    <p class="mt-2 text-info ">EN CAMINO IDA</p>
                                                                    @elseif($arriendo->estado == "EN CLIENTE")
                                                                    <!-- State 3 -->
                                                                    <p class="mt-2 text-info ">
                                                                        EN CLIENTE 
                                                                        @if($arriendo->activo->estado == "PARA RETIRO")
                                                                        (PARA RETIRO)
                                                                        @endif
                                                                    </p>
                                                                    @elseif($arriendo->estado == "EN CAMINO VUELTA")
                                                                    <!-- State 4 -->
                                                                    <p class="mt-2 text-info ">EN CAMINO VUELTA</p>
                                                                    @elseif($arriendo->estado == "BODEGA DE VUELTA")
                                                                    <!-- State 5 -->
                                                                    <p class="mt-2 text-info ">BODEGA DE VUELTA</p>
                                                                    @endif
                                                                </div>

                                                                <div class="wrapper">
                                                                    <p class="fs-14 font-weight-bold">Código Interno (Activo) :</p>
                                                                    <p class="mt-2 text-muted ">{{$arriendo->activo->codigo_interno}}</p>
                                                                </div>

                                                                <div class="wrapper">
                                                                    <p class="fs-14 font-weight-bold">Fecha Inicio :</p>
                                                                    <p class="mt-2 text-muted ">{{Carbon\Carbon::parse($arriendo->fecha_inicio)->format('d-m-Y')}}</p>
                                                                </div>
                                                                <div class="wrapper">
                                                                    <p class="fs-14 font-weight-bold">Fecha Término :</p>
                                                                    <p class="mt-2 text-muted ">{{Carbon\Carbon::parse($arriendo->fecha_termino)->format('d-m-Y')}}</p>
                                                                </div>
                                                                <div class="text-white text-center">
                                                                    @if($arriendo->estado == "BODEGA" || $arriendo->estado == "EN CAMINO VUELTA")
                                                                        <form method="GET" action="{{ route('transporte.qr_reader', [$arriendo->activo->id]) }}">
                                                                            <td class="align-middle">
                                                                                <!-- State 1 -->
                                                                                @if($arriendo->estado == "BODEGA")
                                                                                    <button class="btn btn-xl btn-success me-2" type="submit" data-bs-toggle="" data-bs-target="#user-form-modal">Cambiar de fase</button>
                                                                                <!-- State 4 -->
                                                                                @elseif($arriendo->estado == "EN CAMINO VUELTA")
                                                                                    <button class="btn btn-xl btn-success me-2" type="submit" data-bs-toggle="" data-bs-target="#user-form-modal">Cambiar de fase</button>
                                                                                @endif

                                                                            </td>
                                                                        </form>
                                                                    @elseif($arriendo->estado == "EN CAMINO IDA" || $arriendo->estado == "EN CLIENTE")
                                                                        <form method="POST" action="{{ route('transporte.cambio_fase') }}" enctype="multipart/form-data">
                                                                            @csrf
                                                                            <input hidden type="integer" id="activo_id" name="activo_id" value="{{$arriendo->activo->id}}">
                                                                            <td class="align-middle">
                                                                                <!-- State 2 -->
                                                                                @if($arriendo->estado == "EN CAMINO IDA")
                                                                                    <button class="btn btn-xl btn-success me-2" type="submit" data-bs-toggle="" data-bs-target="#user-form-modal">Cambiar de fase</button>
                                                                                <!-- State 3 -->
                                                                                @elseif($arriendo->estado == "EN CLIENTE" && $arriendo->activo->estado == "ARRENDADO")
                                                                                    <button class="btn btn-xl btn-danger me-2" type="submit" data-bs-toggle="" data-bs-target="#user-form-modal">Disponibilizar para retiro</button>
                                                                                @elseif($arriendo->estado == "EN CLIENTE" && $arriendo->activo->estado == "PARA RETIRO")
                                                                                    <button class="btn btn-xl btn-success me-2" type="submit" data-bs-toggle="" data-bs-target="#user-form-modal">Cambiar de fase</button>

                                                                                @endif
                                                                            </td>
                                                                        </form>
                                                                    @else
                                                                        <form method="GET" action="{{ route('transporte.qr_reader', [$arriendo->activo->id]) }}">
                                                                            <td class="align-middle">
                                                                                <!-- State 5 -->
                                                                                <button disabled class="btn btn-xl btn-warning me-2" type="submit" data-bs-toggle="" data-bs-target="#user-form-modal">(ESPERANDO CONFIRMACIÓN)</button>
                                                                            </td>
                                                                        </form>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Row -->
                @else
                    <div class="alert alert-warning">
                        <ul>
                            <h4 class="text-center mt-4"><b>NO EXISTEN PROCESOS DE ARRIENDO ACTUALMENTE ACTIVOS</b></h4>
                        </ul>
                    </div>
                @endif

            </div>
        </div>

        @overwrite
        @include('layouts.card')
    @endpush --}}

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
                defaultOption.value = "null";
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

            $(function () {
                var table = $('.datatable').DataTable({
                    orderCellsTop: true,
                    fixedHeader: true,
                    /* columnDefs: [
                        {
                            targets: [0], // El índice de la columna que quieres ocultar (cambia esto al índice de tu columna)
                            visible: false, // Establece esta columna como no visible
                            searchable: true // Opcional: permite buscar en esta columna
                        }
                    ], */

                    processing: true,
                    serverSide: true,
                    ajax: {
                        url: "{{ route('transporte.datatable') }}",
                        data: function (d) {
                                d.tipo_proceso = $('#tipo_proceso').val(),
                                d.estado = $('#estado').val(),
                                d.empresa = $('#empresa').val(),
                                d.proyecto = $('#proyecto').val(),
                                d.search = $('input[type="search"]').val()
                            }
                    },
                    columns: [
                        {data: 'detalles', name: 'detalles'},
                    ],
                    
                    "language": {
                        "sProcessing":     "Procesando...",
                        "sLengthMenu":     "Mostrar _MENU_ registros",
                        "sZeroRecords":    "No se encontraron resultados",
                        "sEmptyTable":     "Ningún dato disponible en esta tabla",
                        "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                        "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
                        "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
                        "sInfoPostFix":    "",
                        "sSearch":         "Buscar:",
                        "sUrl":            "",
                        "sInfoThousands":  ",",
                        "sLoadingRecords": "Cargando...",
                        "oPaginate": {
                            "sFirst":    "Primero",
                            "sLast":     "Último",
                            "sNext":     "Siguiente",
                            "sPrevious": "Anterior"
                        },
                        "oAria": {
                            "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                            "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                        }
                    },
                });

                table.on('draw.dt', function() {

                    $('.confirm-submit').on('click', function (event) {
                        if (!confirm('¿Estás seguro de realizar el cambio de fase?')) {
                            event.preventDefault(); // Detiene el envío del formulario si el usuario hace clic en "Cancelar".
                        }
                    });

                });

                $('#tipo_proceso').change(function(){
                    var selectedValue = $(this).val();
                    // Actualiza el texto del elemento h4
                    $('#table_header').text('Procesos de ' + selectedValue);

                    table.draw();
                });

                $('#estado').change(function(){
                    table.draw();
                });

                $('#empresa').change(function(){
                    table.draw();
                });

                $('#proyecto').change(function(){
                    table.draw();
                });

            });

        });

    </script>

    

@endsection
