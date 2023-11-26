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

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

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
                    <div class="btn-list flex-end">

                        <!--

                        <a class="btn btn-info btn-svgs btn-svg-white carga-masiva-arriendo-btn" data-toggle="modal" data-target="#cargaMasivaArriendoModal">
                            <svg width="24" height="24" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="M21 4a1 1 0 0 0-1-1h-3V2a1 1 0 0 0-1-1H8a1 1 0 0 0-1 1v1H4a1 1 0 0 0-1 1v18a1 1 0 0 0 1 1h16a1 1 0 0 0 1-1ZM9 3h6v2H9Zm10 18H5V5h2v1a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V5h2Zm-6-3a1 1 0 0 1-1 1H8a1 1 0 0 1 0-2h4a1 1 0 0 1 1 1Zm4-4a1 1 0 0 1-1 1H8a1 1 0 0 1 0-2h8a1 1 0 0 1 1 1Zm0-4a1 1 0 0 1-1 1H8a1 1 0 0 1 0-2h8a1 1 0 0 1 1 1Z"/></svg>
                            <span class="btn-svg-text mx-2 mt-1">Carga Masiva Arriendos</span>
                        </a>

                        <a class="btn btn-danger btn-svgs btn-svg-white carga-masiva-venta-btn" data-toggle="modal" data-target="#cargaMasivaVentaModal">
                            <svg width="24" height="24" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="M21 4a1 1 0 0 0-1-1h-3V2a1 1 0 0 0-1-1H8a1 1 0 0 0-1 1v1H4a1 1 0 0 0-1 1v18a1 1 0 0 0 1 1h16a1 1 0 0 0 1-1ZM9 3h6v2H9Zm10 18H5V5h2v1a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V5h2Zm-6-3a1 1 0 0 1-1 1H8a1 1 0 0 1 0-2h4a1 1 0 0 1 1 1Zm4-4a1 1 0 0 1-1 1H8a1 1 0 0 1 0-2h8a1 1 0 0 1 1 1Zm0-4a1 1 0 0 1-1 1H8a1 1 0 0 1 0-2h8a1 1 0 0 1 1 1Z"/></svg>
                            <span class="btn-svg-text mx-2 mt-1">Carga Masiva Ventas</span>
                        </a>

                        -->


                    </div>
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
                                                    <option value="{{ $value->id }}">
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
                                            <option value="CAMBIO DE PROCESO">CAMBIO DE PROCESO</option>
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
            Procesos de Arriendos y Ventas
        @overwrite
        
        @section('card_content')

        <div class="row">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title" id="table_header">Procesos de Arriendos</h4>
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
                                                    <th >PROCESO ID</th>
                                                    <th >Activo</th>
                                                    <th >Código Interno</th>
                                                    <th style="width: 40%">Estado Arriendo</th>
                                                    <th >Fecha Inicio</th>
                                                    <th >Fecha Término</th>
                                                    <th >Acciones</th>
                                                </tr>
                                            </thead>
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

        <div class="modal fade" id="cargaMasivaArriendoModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Carga Masiva Arriendos</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('arriendo.carga_masiva') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="file">Seleccionar Archivo</label>
                                <input type="file" class="dropify" id="documento" name="documento" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Subir Archivo</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="cargaMasivaVentaModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Carga Masiva Ventas</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('venta.carga_masiva') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="file">Seleccionar Archivo</label>
                                <input type="file" class="dropify" id="documento" name="documento" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Subir Archivo</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>  


        @overwrite
        @include('layouts.card')
    @endpush

    <link href="https://nightly.datatables.net/css/jquery.dataTables.css" rel="stylesheet" type="text/css" />
    <script src="{{ asset('dropify/js/dropify.js' )}}"></script>
    <!-- INTERNAL File Uploads css-->
    <link href="{{asset('assets/plugins/fileupload/css/fileupload.css')}}" rel="stylesheet" type="text/css" />

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

            //Inicializamos DROPIFY
            $('.dropify').dropify();

            $('.carga-masiva-btn').on('click', function () {
                $('#cargaMasivaModal').modal('show'); // Muestra el modal
            });

            $('.carga-masiva-arriendo-btn').on('click', function () {
                $('#cargaMasivaArriendoModal').modal('show'); // Muestra el modal
            });

            $('.carga-masiva-venta-btn').on('click', function () {
                $('#cargaMasivaVentaModal').modal('show'); // Muestra el modal
            });


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
                        url: "{{ route('trazabilidad.datatable') }}",
                        data: function (d) {
                                d.tipo_proceso = $('#tipo_proceso').val(),
                                d.estado = $('#estado').val(),
                                d.empresa = $('#empresa').val(),
                                d.proyecto = $('#proyecto').val(),
                                d.search = $('input[type="search"]').val()
                            }
                    },
                    columns: [
                        {data: 'id', name: 'id'},
                        {data: 'activo', name: 'activo'},
                        {data: 'codigo_interno', name: 'codigo_interno'},
                        {data: 'imagen', name: 'imagen'},
                        {data: 'fecha_inicio', name: 'fecha_inicio'},
                        {data: 'fecha_termino', name: 'fecha_termino'},
                        {data: 'acciones', name: 'acciones'},
                    ]
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
