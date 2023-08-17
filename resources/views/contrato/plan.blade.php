@extends('layouts.app')

@section('content')

    @section('title')
    &nbsp;
    <h3>
        Plan de Contratos
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
                        <div class="row" id="form_filtros">
                            <div class="col-lg-6 col-md-12">
                                <form class="form-horizontal" >

                                    <div class="form-group row">
                                        <label class="col-md-3 form-label">Criticidad de contrato</label>
                                        
                                        <div class="col-md-9">
                                            <div class="dropdown">
                                                <select class="form-control " id="criticidad"  >
                                                    <option value="{{null}}">Todos los contratos</option>
                                                    <option value="1">Alta criticidad</option>
                                                    <option value="2">Criticidad por admin</option>
                                                    <option value="3">Baja criticidad</option>
                                                    <option value="4">Criticidad por impacto</option>
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
                        <h4 class="card-title">Gráfica</h4>    
                    </div>
                    <div class="card-body">
                        <div id="chartContainer" style="height: 500px; width: 100%;"></div>
                            <div class="row mb-3 mt-4" id="axis_filtros">

                                <div class="mt-1 mb-3 col-sm-3">
                                    <form id="asintotas" class="form-horizontal" action="{!! route('contrato.axis_update') !!}" method="post">
                                        @csrf
                                        <div class="form-group row">
                                            <label class="col-md-3 form-label mt-2">Asintota X</label>
                                            
                                            <div class="col-md-9">
                                                <input name="axis_x" id='axis_x' type="number" min="0" max="100"  class="form-control" value="{{$axis_x}}" required>
                                            </div>
                                        </div>
                                </div>

                                <div class="mt-1 mb-3 col-sm-3">
                                        <div class="form-group row">
                                            <label class="col-md-3 form-label mt-2">Asintota Y</label>
                                            
                                            <div class="col-md-9">
                                                <input name="axis_y" id='axis_y' type="number" min="0" max="100" class="form-control" value="{{$axis_y}}"  required>
                                            </div>
                                        </div>
                                </div>

                                <div class="mt-1 mb-3 col-sm-3">
                                    <input type="submit" class="btn btn-primary" form="asintotas" value="Actualizar" />
                                </div>

                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>




        @overwrite
        @include('layouts.card')
    @endpush

    <script src="https://cdn.canvasjs.com/canvasjs.min.js"></script>

    <script type="text/javascript">

    $(document).ready(function(){



        var dataPoints = {!! json_encode($dataPoints) !!};
        var axis_x = {!! json_encode($axis_x) !!};
        var axis_y = {!! json_encode($axis_y) !!};
        var dataPoints_aux = dataPoints;
        
        $('#form_filtros').on('change', function () {
            console.log(dataPoints);

            dataPoints_aux = dataPoints;

            //Aplicación de los filtros a dataPoints_aux
            
            if($('#criticidad').val() != ""){
                dataPoints_aux = dataPoints_aux.filter(function (data){
                    return data.criticidad == $('#criticidad').val();
                });
            }
            if($('#faena').val() != ""){
                dataPoints_aux = dataPoints_aux.filter(function (data){
                    return data.faena == $('#faena').val();
                });
            }
            if($('#servicio_bien').val() != ""){
                dataPoints_aux = dataPoints_aux.filter(function (data){
                    return data.servicio_bien == $('#servicio_bien').val();
                });
            }
            if($('#tipo_contrato').val() != ""){
                dataPoints_aux = dataPoints_aux.filter(function (data){
                    return data.tipo_contrato == $('#tipo_contrato').val();
                });
            }
            if($('#transversal').val() != ""){
                dataPoints_aux = dataPoints_aux.filter(function (data){
                    return data.transversal == $('#transversal').val();
                });
            }
            
            chart.options.data[0].dataPoints = dataPoints_aux;
            chart.render();
        });


        var chart = new CanvasJS.Chart("chartContainer", {
            animationEnabled: true,
            exportEnabled: true,
            theme: "light", 
            title:{
                text: "Plan de Contratos"
            },
            axisX:{
                minimum: 0,
                maximum: 105,
                title: "Porcentaje X",
                suffix: "%",
            },
            axisY:{
                minimum: 0,
                maximum: 105,
                title: "Porcentaje Y",
                suffix: "%",
                gridThickness: 0,
                lineThickness: 1,
            },

            legend:{
                verticalAlign: "top",
                fontSize: 16,
                dockInsidePlotArea: true
            },

            annotation: {
                annotations: [{
                    type: 'line',
                    mode: 'horizontal',
                    scaleID: 'y-axis-0',
                    value: 5,
                    borderColor: 'rgb(75, 192, 192)',
                    borderWidth: 10,
                    label: {
                        enabled: true,
                        content: 'Test label'
                    }
                }]
                },

            data: [
                {
                    type: "scatter",
                    markerType: "square",
                    markerSize: 10,
                    //showInLegend: true,
                    //name: "Log Scale",
                    toolTipContent: "Contrato: {servicio_bien}<br>Porcentaje Y: {y} %<br>Porcentaje X: {x} %",
                    dataPoints: dataPoints
                },
                {
                    type: "line",
                    markerType: "square",
                    markerSize: 1,
                    showInLegend: false,
                    //name: "Log Scale",
                    toolTipContent: " Asintota Y ",
                    dataPoints: [
                        {
                            x : -50,
                            y : axis_y
                        },
                        {
                            x : 110,
                            y : axis_y
                        },
                    ]
                },
                {
                    type: "line",
                    markerType: "square",
                    markerSize: 1,
                    showInLegend: false,
                    //name: "Log Scale",
                    toolTipContent: " Asintota X ",
                    dataPoints: [
                        {
                            x : axis_x,
                            y : -10
                        },
                        {
                            x : axis_x,
                            y : 105
                        },
                    ]
                },
            ],
        });
        

        chart.render();
        
    });

    
    
</script>


@endsection

