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
                            <div class="row mt-4" id="axis_filtros">

                                <div class="col-lg-6 col-md-12">
                                    <form class="form-horizontal" >

                                        <div class="form-group row">
                                            <label class="col-md-3 form-label">Asintota X</label>
                                            
                                            <div class="col-md-9">
                                                <input name="axis_x" id='axis_x' type="number" min="0" max="100"  class="form-control" value="{{$axis_x}}" required>
                                            </div>
                                        </div>
                                    </form>
                                </div>

                                <div class="col-lg-6 col-md-12">
                                    <form class="form-horizontal" >
                                        <div class="form-group row">
                                            <label class="col-md-3 form-label">Asintota Y</label>
                                            
                                            <div class="col-md-9">
                                                <input name="axis_y" id='axis_y' type="number" min="0" max="100" class="form-control" value="{{$axis_y}}"  required>
                                            </div>
                                        </div>
                                    </form>
                                </div>

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

        //Verificamos los cambios en alguna de las asintotas
        $('#axis_filtros').on('keyup change', function () {
            const axis_y = parseInt($('#axis_y').val());

            chart.options.data[1].dataPoints = [
                {
                    x : -50,
                    y : axis_y
                },
                {
                    x : 110,
                    y : axis_y
                },
            ];

            const axis_x = parseInt($('#axis_x').val());
            
            chart.options.data[2].dataPoints = [
                {
                    x : axis_x,
                    y : -10
                },
                {
                    x : axis_x,
                    y : 105
                },
            ];
        
            dataPoints_aux2 = [];
            criticidad_actual = $('#criticidad').val();
            

            console.log(dataPoints);
            
            Object.values(dataPoints).forEach(val => {
                
                //console.log("val: " + val.servicio_bien);
                const index = dataPoints.findIndex(obj => {
                    return obj.servicio_bien === val.servicio_bien;
                });

                //console.log(index);

                //Calculamos criticidad para cada contrato
                var criticidad = 0;
                if(val.x >= axis_x && val.y >=axis_y) criticidad = 1;
                else if(val.x <= axis_x && val.y >= axis_y) criticidad = 2;
                else if(val.x <= axis_x && val.y <= axis_y) criticidad = 3;
                else if(val.x >= axis_x && val.y <= axis_y) criticidad = 4;

                dataPoints[index].criticidad = criticidad;

                if(criticidad_actual){
                    if(criticidad_actual == criticidad){
                        dataPoints_aux2.push(val);
                    }
                }else{
                    dataPoints_aux2.push(val);
                }

            });

            //Aplicación de los filtros a dataPoints_aux

            if($('#criticidad').val() != ""){
                dataPoints_aux2 = dataPoints_aux2.filter(function (data){
                    return data.criticidad == $('#criticidad').val();
                });
            }
            if($('#faena').val() != ""){
                dataPoints_aux2 = dataPoints_aux2.filter(function (data){
                    return data.faena == $('#faena').val();
                });
            }
            if($('#servicio_bien').val() != ""){
                dataPoints_aux2 = dataPoints_aux2.filter(function (data){
                    return data.servicio_bien == $('#servicio_bien').val();
                });
            }
            if($('#tipo_contrato').val() != ""){
                dataPoints_aux2 = dataPoints_aux2.filter(function (data){
                    return data.tipo_contrato == $('#tipo_contrato').val();
                });
            }
            if($('#transversal').val() != ""){
                dataPoints_aux2 = dataPoints_aux2.filter(function (data){
                    return data.transversal == $('#transversal').val();
                });
            }

            chart.options.data[0].dataPoints = dataPoints_aux2;
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
                            y : 50
                        },
                        {
                            x : 110,
                            y : 50
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
                            x : 50,
                            y : -10
                        },
                        {
                            x : 50,
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

