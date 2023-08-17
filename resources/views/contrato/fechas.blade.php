@extends('layouts.app')

@section('content')

    @section('title')
    &nbsp;
    <h3>
        Fechas de Contratos
    </h3>
    &nbsp;
    @endsection

    @push('cards')
        @section('card_title')
            Filtros e Información
        @overwrite
        
        @section('card_content')
            
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
                                        <label class="col-md-3 form-label">Criticidad de contrato</label>
                                        
                                        <div class="col-md-9">
                                            <div class="dropdown">
                                                <select class="form-control " id="criticidad"  >
                                                    <option value="{{null}}">Todos los contratos</option>
                                                    <option value="Alta criticidad">Alta criticidad</option>
                                                    <option value="Criticidad por admin">Criticidad por admin</option>
                                                    <option value="Baja criticidad">Baja criticidad</option>
                                                    <option value="Criticidad por impacto">Criticidad por impacto</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group row">
                                        <label class="col-md-3 form-label">Tipo de Contrato</label>
                                        
                                        <div class="col-md-9">
                                            <div class="dropdown">
                                                <select class="form-control " id="tipo_contrato"  >
                                                    <option value="{{null}}">Todos los contratos</option>
                                                    <option value="Bienes">Bienes</option>
                                                    <option value="Servicios">Servicios</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-md-3 form-label">Servicio / Bien</label>
                                        
                                        <div class="col-md-9">
                                            <div class="dropdown">
                                                <select class="form-control " id="servicio_bien"  >
                                                    <option value="{{null}}">Todos los contratos</option>
                                                    @foreach ($servicios_bienes as $key => $value)   
                                                        <option value="{{ $value }}" {{ ( $key == 1) }}> 
                                                            {{ $value }} 
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
                                        <label class="col-md-3 form-label">Faena</label>
                                        
                                        <div class="col-md-9">
                                            <div class="dropdown">
                                                <select class="form-control " id="faena"  >
                                                    <option value="{{null}}">Todos los contratos</option>
                                                    @foreach ($faenas as $key => $value)   
                                                        <option value="{{ $value }}" {{ ( $key == 1) }}> 
                                                            {{ $value }} 
                                                        </option>
                                                    @endforeach 
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-md-3 form-label">Transversal</label>
                                        
                                        <div class="col-md-9">
                                            <div class="dropdown">
                                                <select class="form-control " id="transversal"  >
                                                    <option value="{{null}}">Todos los contratos</option>
                                                    <option value="SI">SI</option>
                                                    <option value="NO">NO</option>
                                                    <option value="MED">MED</option>

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




        <div class="row">
            <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Todos los Contratos</h4>    
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="table-responsive">
                                <table class='table text-nowrap datatable'>
                                    
                                    <thead>
                                        <tr>
                                            <th>Contrato SAP</th>
                                            <th>Criticidad</th>
                                            <th>Tipo de contrato</th>
                                            <th>Servicios / Bienes</th>
                                            <th>Faena</th>
                                            <th>Transversal</th>
                                            <th>Fecha de inicio</th>
                                            <th>Fecha de término</th>
                                            <th>Inicio de licitación</th>
                                            <th>Fecha de Adjudicación</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($contratos as $contrato)
                                        <tr>
                                            <td>{{$contrato->contrato_sap}}</td>
                                            @switch($contrato->criticidad)
                                                @case(1)
                                                    <td>Alta criticidad</td>

                                                    @break
                                                @case(2)
                                                    <td>Criticidad por admin</td>

                                                    @break
                                                @case(3)
                                                    <td>Baja criticidad</td>

                                                    @break
                                                @case(4)
                                                    <td>Criticidad por impacto</td>

                                                    @break
                                                @default
                                                    
                                            @endswitch
                                            <td>{{$contrato->tipo_contrato_general}}</td>
                                            <td>{{$contrato->servicio_bien->nombre_servicio_bien}}</td>
                                            <td>{{$contrato->faena->nombre_faena}}</td>

                                            <td>{{$contrato->detalle_contrato[0]->transversal}}</td>

                                            <td>{{Carbon\Carbon::parse($contrato->detalle_contrato[0]->fecha_inicio)->format('d-m-Y')}}</td>
                                            <td>{{Carbon\Carbon::parse($contrato->detalle_contrato[0]->fecha_termino)->format('d-m-Y')}}</td>
                                            
                                            <td>
                                            @if($contrato->clasificacion->nombre_clasificacion == "Estrategico")
                                            {{Carbon\Carbon::parse($contrato->detalle_contrato[0]->fecha_termino)->subMonths(5)->format('d-m-Y')}}</td>
                                            @elseif($contrato->clasificacion->nombre_clasificacion == "N/E")
                                            {{Carbon\Carbon::parse($contrato->detalle_contrato[0]->fecha_termino)->subMonths(3)->format('d-m-Y')}}
                                            @else
                                            {{Carbon\Carbon::parse($contrato->detalle_contrato[0]->fecha_termino)->format('d-m-Y')}}
                                            @endif
                                            </td>
                                            
                                            <td>
                                            @if($contrato->tipo_renovacion == "Permanente")
                                                {{Carbon\Carbon::parse($contrato->detalle_contrato[0]->fecha_termino)->subMonth()->format('d-m-Y')}}
                                            @else
                                                No definida
                                            @endif
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



        @overwrite
        @include('layouts.card')
    @endpush

    <script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
    <link href="https://nightly.datatables.net/css/jquery.dataTables.css" rel="stylesheet" type="text/css" />
    <script src="https://nightly.datatables.net/js/jquery.dataTables.js"></script>

    <script type="text/javascript">

    $(document).ready(function(){
        var table = $('.datatable').DataTable({
            orderCellsTop: true,
            fixedHeader: true,
        });

        $('#criticidad').on('change', function () {
            if ( table.column(1).search() !== this.value ) {
                table
                    .column(1)
                    .search( this.value )
                    .draw();
            }
        });

        $('#tipo_contrato').on('change', function () {
            if ( table.column(2).search() !== this.value ) {
                table
                    .column(2)
                    .search( this.value )
                    .draw();
            }
        });

        $('#servicio_bien').on('change', function () {
            if ( table.column(3).search() !== this.value ) {
                table
                    .column(3)
                    .search( this.value )
                    .draw();
            }
        });

        $('#faena').on('change', function () {
            if ( table.column(4).search() !== this.value ) {
                table
                    .column(4)
                    .search( this.value )
                    .draw();
            }
        });

        $('#transversal').on('change', function () {
            if ( table.column(5).search() !== this.value ) {
                table
                    .column(5)
                    .search( this.value )
                    .draw();
            }
        });

        
    });

    


    </script>

@endsection
