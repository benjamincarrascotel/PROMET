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
                    <div class="btn-list flex-end">
                        <a class="btn btn-success btn-svgs btn-svg-white" href="{{url('/activo/create')}}">
                            <svg class="svg-icon" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24">
                                <path d="M0 0h24v24H0V0z" fill="none"></path>
                                <path d="M13 4H6v16h12V9h-5V4zm3 14H8v-2h8v2zm0-6v2H8v-2h8z" opacity=".3"></path>
                                <path d="M8 16h8v2H8zm0-4h8v2H8zm6-10H6c-1.1 0-2 .9-2 2v16c0 1.1.89 2 1.99 2H18c1.1 0 2-.9 2-2V8l-6-6zm4 18H6V4h7v5h5v11z"></path>
                            </svg>                                
                            <span class="btn-svg-text mt-1">Crear Activo</span>
                        </a>

                        <a class="btn btn-outline-success btn-svgs btn-svg-white carga-masiva-btn" data-toggle="modal" data-target="#cargaMasivaModal">
                            <svg width="24" height="24" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="M21 4a1 1 0 0 0-1-1h-3V2a1 1 0 0 0-1-1H8a1 1 0 0 0-1 1v1H4a1 1 0 0 0-1 1v18a1 1 0 0 0 1 1h16a1 1 0 0 0 1-1ZM9 3h6v2H9Zm10 18H5V5h2v1a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V5h2Zm-6-3a1 1 0 0 1-1 1H8a1 1 0 0 1 0-2h4a1 1 0 0 1 1 1Zm4-4a1 1 0 0 1-1 1H8a1 1 0 0 1 0-2h8a1 1 0 0 1 1 1Zm0-4a1 1 0 0 1-1 1H8a1 1 0 0 1 0-2h8a1 1 0 0 1 1 1Z"/></svg>
                            <span class="btn-svg-text mx-2 mt-1">Carga Masiva Activos</span>
                        </a>


                    </div>
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
                </div>

                <!-- Row -->
                <div class="e-panel card">
                    <div class="card-body">
                        <div class="table-responsive">

                            <table class='table table-bordered data-table-global datatable' id="datatable_activos">
                                <thead>
                                    <tr>
                                        <th >Estado</th>
                                        <th >ID</th>
                                        <th >Elemento</th>
                                        <th >Código Interno</th>
                                        <th >Número De Serie</th>
                                        
                                        <th >Acciones</th>
                                        <th >Código QR</th>
                                        <th >Arrendar</th>
                                        
                                        <th >Mantención</th>
                                        <th >Venta</th>

                                    </tr>
                                </thead>
                            </table>


                        </div>
                    </div>
                </div>
                <!-- End Row -->
            </div>
        </div>


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
                                <input type="file" class="dropify" id="documento" name="documento" required>
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

        <div class="modal fade" id="cargaMasivaModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Carga Masiva</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('activo.carga_masiva') }}" method="POST" enctype="multipart/form-data">
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

        <!-- Debo colocar el script dentro de la "section" para que logre acceder al input "foto" -->
        <script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
        <link href="https://nightly.datatables.net/css/jquery.dataTables.css" rel="stylesheet" type="text/css" />
        <script src="https://nightly.datatables.net/js/jquery.dataTables.js"></script>


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
                        url: "{{ route('activo.index') }}",
                        data: function (d) {
                                d.estado = $('#estado').val(),
                                d.search = $('input[type="search"]').val()
                            }
                        },
                        columns: [
                            {data: 'estado', name: 'estado'},
                            {data: 'id', name: 'id'},
                            {data: 'elemento', name: 'elemento'},
                            {data: 'codigo_interno', name: 'codigo_interno'},
                            {data: 'numero_serie', name: 'numero_serie'},
                            {data: 'acciones', name: 'acciones'},
                            {data: 'codigo_qr', name: 'codigo_qr'},
                            {data: 'arriendo', name: 'arriendo'},
                            {data: 'mantencion', name: 'mantencion'},
                            {data: 'venta', name: 'venta'},
                        ]
                    });

                    table.on('draw.dt', function() {
                        $('.terminar-mantencion-btn').on('click', function () {
                            var activoId = $(this).data('activo-id'); // Obtiene el valor de data-activo-id
                            $('#activo_id').val(activoId); // Establece el valor en el campo activo_id del formulario
                            $('#terminarMantencionModal').modal('show'); // Muestra el modal
                        });
                    });
                
                    $('#estado').change(function(){
                        table.draw();
                    });
                  
                });

                /* MÉTODO LOCAL
                $('#estado').on( 'keyup change', function () {
                    if ( table.column(0).search() !== this.value ) {
                        table
                            .column(0)
                            .search( this.value )
                            .draw();
                    }
                });
                */
                
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
