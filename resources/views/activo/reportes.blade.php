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

    .dropdown-toggle{
        height: 40px;
        width: 100% !important;
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
        Reportes
    </h3>
    &nbsp;
    @endsection

    <div class="row">
        <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Filtros de búsqueda</h4>
                    <div class="btn-list flex-end">

                        <a class="btn btn-success btn-svgs btn-svg-white exportar_excel" id="exportar_excel" data-toggle="modal" data-target="#exportModal">
                            <svg width="24" height="24" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="M21 4a1 1 0 0 0-1-1h-3V2a1 1 0 0 0-1-1H8a1 1 0 0 0-1 1v1H4a1 1 0 0 0-1 1v18a1 1 0 0 0 1 1h16a1 1 0 0 0 1-1ZM9 3h6v2H9Zm10 18H5V5h2v1a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V5h2Zm-6-3a1 1 0 0 1-1 1H8a1 1 0 0 1 0-2h4a1 1 0 0 1 1 1Zm4-4a1 1 0 0 1-1 1H8a1 1 0 0 1 0-2h8a1 1 0 0 1 1 1Zm0-4a1 1 0 0 1-1 1H8a1 1 0 0 1 0-2h8a1 1 0 0 1 1 1Z"/></svg>
                            <span class="btn-svg-text mx-2 mt-1">Exportar Excel</span>
                        </a>

                        <a class="btn btn-danger btn-svgs btn-svg-white exportar_pdf" id="exportar_pdf" >
                            <svg width="24" height="24" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="M21 4a1 1 0 0 0-1-1h-3V2a1 1 0 0 0-1-1H8a1 1 0 0 0-1 1v1H4a1 1 0 0 0-1 1v18a1 1 0 0 0 1 1h16a1 1 0 0 0 1-1ZM9 3h6v2H9Zm10 18H5V5h2v1a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V5h2Zm-6-3a1 1 0 0 1-1 1H8a1 1 0 0 1 0-2h4a1 1 0 0 1 1 1Zm4-4a1 1 0 0 1-1 1H8a1 1 0 0 1 0-2h8a1 1 0 0 1 1 1Zm0-4a1 1 0 0 1-1 1H8a1 1 0 0 1 0-2h8a1 1 0 0 1 1 1Z"/></svg>
                            <span class="btn-svg-text mx-2 mt-1">Exportar PDF</span>
                        </a>

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
                                            <select class="form-control selectpicker" multiple id="tipo_proceso" name="tipo_proceso" >
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
                                            <select class="form-control" id="empresa" name="empresa" placeholder="Buscar por empresa.">
                                                <option value="{{null}}" selected>Todas las empresas</option>
                                                @foreach ($empresas as $value)
                                                    <option value="{{ $value->id }}">{{$value->nombre." - ".$value->rut}}</option>
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
                                    <label class="col-md-3 form-label">Estado del proceso: </label>
                                    <div class="col-md-9">
                                        <select class="form-control selectpicker" multiple id="estado" name="estado" placeholder="Buscar por estado del arriendo.">
                                            <option value="{{null}}" selected>Todos los arriendos y ventas</option>
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
                                            <select class="form-control selectpicker" multiple id="proyecto" name="proyecto" >
                                                <option value="{{null}}" selected>Todos los proyectos</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>

                        
                    </div>

                    <div class="btn-list">

                        <a class="btn btn-outline-dark btn-svgs btn-svg-white generar_datatable" data-toggle="modal" data-target="#cargaMasivaVentaModal">
                            <svg width="24" height="24" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="M21 4a1 1 0 0 0-1-1h-3V2a1 1 0 0 0-1-1H8a1 1 0 0 0-1 1v1H4a1 1 0 0 0-1 1v18a1 1 0 0 0 1 1h16a1 1 0 0 0 1-1ZM9 3h6v2H9Zm10 18H5V5h2v1a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V5h2Zm-6-3a1 1 0 0 1-1 1H8a1 1 0 0 1 0-2h4a1 1 0 0 1 1 1Zm4-4a1 1 0 0 1-1 1H8a1 1 0 0 1 0-2h8a1 1 0 0 1 1 1Zm0-4a1 1 0 0 1-1 1H8a1 1 0 0 1 0-2h8a1 1 0 0 1 1 1Z"/></svg>
                            <span class="btn-svg-text mx-2 mt-1">Generar</span>
                        </a>

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
                                                    <th >Tipo</th>
                                                    <th >Estado</th>
                                                    <th >Proceso ID</th>
                                                    <th >Activo ID</th>
                                                    <th >Activo</th>
                                                    <th >Código Interno</th> 
                                                    <th >Fecha Inicio</th>
                                                    <th >Fecha Término</th>
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

        <div class="modal fade" id="exportModal" tabindex="-1" role="dialog" aria-labelledby="exportModal" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exportLabel">Exportación</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('reportes.exportar') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <input id="exportar_flag" name="exportar_flag" type="integer"  value="0" hidden>

                            <div class="form-group row">
                                <label class="col-md-3 form-label mt-2">Tipo de Proceso:</label>
                                
                                <div class="col-md-9 mt-2">
                                    <input type="text" class="form-control" id="tipo_proceso_modal" name="tipo_proceso" hidden>
                                    <input type="text" class="form-control" id="tipo_proceso_text" name="tipo_proceso_text" disabled>

                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-md-3 form-label mt-2">Empresa:</label>
                                
                                <div class="col-md-9 mt-2">
                                    <input type="text" class="form-control" id="empresa_modal" name="empresa" hidden>
                                    <input type="text" class="form-control" id="empresa_text" name="empresa_text" disabled>

                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-md-3 form-label mt-2">Estado del proceso:</label>
                                
                                <div class="col-md-9 mt-2">
                                    <input type="text" class="form-control" id="estado_modal" name="estado" hidden>
                                    <input type="text" class="form-control" id="estado_text" name="estado_text" disabled>

                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-md-3 form-label mt-2">Proyecto:</label>
                                
                                <div class="col-md-9 mt-2">
                                    <input type="text" class="form-control" id="proyecto_modal" name="proyecto" hidden>
                                    <input type="text" class="form-control" id="proyecto_text" name="proyecto_text" disabled>

                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">Exportar</button>
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

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.css"/>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>
    

    <script>
        document.addEventListener("DOMContentLoaded", function () {
        var empresaSelect = document.getElementById("empresa");
        var proyectoSelect = document.getElementById("proyecto");
        var proyectos = {!! $proyectos->toJson() !!};

        // Function to update the options of the proyecto selectpicker
        function actualizarProyectos() {
            var selectedEmpresaId = empresaSelect.value;

            // Destroy and reinitialize the selectpicker on the proyecto dropdown
            $('#proyecto').selectpicker('destroy');
            proyectoSelect.innerHTML = '';

            // Add the default option
            var defaultOption = document.createElement("option");
            defaultOption.value = "null";
            defaultOption.text = "Todos los proyectos";
            defaultOption.selected = true;
            proyectoSelect.appendChild(defaultOption);

            if(proyectos[selectedEmpresaId]){
                // Add the projects corresponding to the selected empresa
                proyectos[selectedEmpresaId].forEach(function (proyecto) {
                    var option = document.createElement("option");
                    option.value = proyecto.id;
                    option.text = "[ " + proyecto.codigo_sap + " ] " + proyecto.nombre_sap;
                    proyectoSelect.appendChild(option);
                });
            }
            
            // Reinitialize the selectpicker on the proyecto dropdown
            $('#proyecto').selectpicker('refresh');
        }

        // Assign the change event to the empresa selectpicker
        $('#empresa').on('changed.bs.select', function () {
            actualizarProyectos();
        });

        // Initialize the selectpickers
        $('#empresa, #proyecto').selectpicker();
    });
    </script>

    <script type="text/javascript">
        $(document).ready(function () {

            $('#exportModal').on('show.bs.modal', function () {

                var tipo_proceso = $('#tipo_proceso').val();
                $('#exportModal #tipo_proceso_modal').val(tipo_proceso);

                var selectedOptions = $('#tipo_proceso').find(':selected');
                var tipo_proceso_text = selectedOptions.map(function () {
                    return $(this).text();
                }).get();

                $('#exportModal #tipo_proceso_text').val(tipo_proceso_text);

                var empresa = $('#empresa').val();
                $('#exportModal #empresa_modal').val(empresa);
                var selectedOptions = $('#empresa').find(':selected');
                var empresa_text = selectedOptions.map(function () {
                    return $(this).text();
                }).get();
                $('#exportModal #empresa_text').val(empresa_text);
                
                var estado = $('#estado').val();
                $('#exportModal #estado_modal').val(estado);
                var selectedOptions = $('#estado').find(':selected');
                var estado_text = selectedOptions.map(function () {
                    return $(this).text();
                }).get();
                $('#exportModal #estado_text').val(estado_text);

                var proyecto = $('#proyecto').val();
                $('#exportModal #proyecto_modal').val(proyecto);
                var selectedOptions = $('#proyecto').find(':selected');
                var proyecto_text = selectedOptions.map(function () {
                    return $(this).text();
                }).get();
                $('#exportModal #proyecto_text').val(proyecto_text);

            });

            $('.exportar_excel').on('click', function () {
                $('#exportModal').modal('show'); // Muestra el modal
                var exportarFlagInput = document.getElementById("exportar_flag");
                exportarFlagInput.value = 1;

                // Actualiza el título del modal
                $('#exportLabel').text('Exportación de Excel');

            });

            $('.exportar_pdf').on('click', function () {
                $('#exportModal').modal('show'); // Muestra el modal
                var exportarFlagInput = document.getElementById("exportar_flag");
                exportarFlagInput.value = 2;

                // Actualiza el título del modal
                $('#exportLabel').text('Exportación de PDF');

            });

            $('.selectpicker').selectpicker();

            $(function () {
                var table = $('.datatable').DataTable({

                    orderCellsTop: true,
                    fixedHeader: true,
                    searching: false,
                    ordering: false,
                    processing: true,
                    serverSide: true,
                    ajax: {
                        url: "{{ route('reportes.datatable') }}",
                        data: function (d) {
                                d.exportar_flag = $('#exportar_flag').val(),
                                d.tipo_proceso = $('#tipo_proceso').val(),
                                d.estado = $('#estado').val(),
                                d.empresa = $('#empresa').val(),
                                d.proyecto = $('#proyecto').val(),
                                d.search = $('input[type="search"]').val()
                            }
                    },
                    columns: [

                        {data: 'tipo', name: 'tipo'},
                        {data: 'estado', name: 'estado'},
                        {data: 'id', name: 'id'},
                        {data: 'activo_id', name: 'activo_id'},
                        {data: 'activo', name: 'activo'},
                        {data: 'codigo_interno', name: 'codigo_interno'},
                        {data: 'fecha_inicio', name: 'fecha_inicio'},
                        {data: 'fecha_termino', name: 'fecha_termino'},
                    ]
                });

                /* // Función a ejecutar cuando se cambia el valor del select de tipo de proceso
                table.on('draw.dt', function() {

                });
                 */

                $('.generar_datatable').on('click', function () {
                    var exportarFlagInput = document.getElementById("exportar_flag");
                    exportarFlagInput.value = 0;

                    // Actualiza el texto del elemento h4
                    var selectedValue = $('#tipo_proceso').val();
                    $('#table_header').text('Procesos de ' + selectedValue);

                    table.draw();
                });

                $('#tipo_proceso').change(function(){
                    if ($.inArray('Ventas', $(this).val()) !== -1) {
                        $('#exportar_pdf').addClass('disabled');
                        $('#exportar_pdf').click(function(e) {
                            e.preventDefault();
                        });
                    } else {
                        $('#exportar_pdf').removeClass('disabled');
                        $('#exportar_pdf').unbind('click');

                        $('.exportar_pdf').on('click', function () {
                            $('#exportModal').modal('show'); // Muestra el modal
                            var exportarFlagInput = document.getElementById("exportar_flag");
                            exportarFlagInput.value = 2;

                            // Actualiza el título del modal
                            $('#exportLabel').text('Exportación de PDF');
                        });
                    }
                });

                

            });

        });

    </script>

@endsection
