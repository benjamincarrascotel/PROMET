@extends('layouts.app')

@section('content')

    @section('title')
    &nbsp;
    <h3>
        Detalles de Contratos
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
                                    <!--TODO añadir filtro clasificación dotacion -->

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
                        <h4 class="card-title">Información</h4>    
                    </div>
                    <div class="card-body">
                        <!-- Row -->
						<div class="row">
								<div class="card" style="height: 100%">
									<div class="card-header">
										<div class="card-title">Estadísticas</div>
									</div>
									<div class="card-body">
										
                                        <!--Row-->
                                        <div class="row">
                                            <div class="col-lg-6 col-md-12">

                                                <div class="card overflow-hidden bg-primary text-white">
                                                    <div class="card-body">
                                                        
                                                        <div class="mb-2 fs-18">
                                                            Suma Facturación Mensual
                                                        </div>
                                                        <h1 id="sum_facturacion_mensual" class="font-weight-bold mb-1">{{round($sum_facturacion_mensual)/1000000}} M</h1>
                                                            
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-12">
                                                <div class="card overflow-hidden bg-danger text-white">
                                                    <div class="card-body">
                                                        <div class="mb-2 fs-18">
                                                            Suma % Dotación
                                                        </div>
                                                        <h1 id="sum_dotacion" class="font-weight-bold mb-1">{{$sum_dotacion}} %</h1>
                                                            
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-12">
                                                <div class="card overflow-hidden bg-success text-white">
                                                    <div class="card-body">
                                                
                                                        <div class="mb-2 fs-18">
                                                            KPI by KPI
                                                        </div>
                                                        <h1 id="kpi_by_kpi" class="font-weight-bold mb-1">{{round($kpi_by_kpi, 2)}}</h1>
                                                            
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-12">
                                                <div class="card overflow-hidden bg-warning text-white">
                                                    <div class="card-body">
                                                         
                                                        <div class="mb-2 fs-18">
                                                            Gasto 12 Meses Móviles
                                                        </div>
                                                        <h1 id="sum_gasto_12_meses_moviles" class="font-weight-bold mb-1">{{$sum_gasto_12_meses_moviles/1000000}} M</h1>
                                                            
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

									</div>
								</div>
								<div class="card" style="height: 100%">
									<div class="card-header">
										<div class="card-title">Gráfica de torta</div>
									</div>
									<div class="card-body">
                                            <div id="chartContainer" style="height: 600px; width: 100%;"></div>
									</div>
								</div>
						</div>
						<!-- /Row -->
                    </div>
                </div>
            </div>
        </div>




        @overwrite
        @include('layouts.card')
    @endpush

    <script src="https://cdn.canvasjs.com/canvasjs.min.js"></script>

    <script type="text/javascript">

    function changeH1Text(id, value)
    {
        var heading = document.getElementById(id);
        heading.innerHTML = value;
    }

    $(document).ready(function(){

        var dataPoints = {!! json_encode($dataPoints) !!};
        var porcentajes = {!! json_encode($porcentajes) !!};
        
        $('#form_filtros').on('change', function () {

            let dataPoints_aux = dataPoints;

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


            //Porcentajes de criticidad
            var suma_criticidad_1 = 0;
            var suma_criticidad_2 = 0;
            var suma_criticidad_3 = 0;
            var suma_criticidad_4 = 0;
            var counter = 0;

            //Cálculo de estadísticas
            var sum_facturacion_mensual = 0;
            var sum_dotacion = 0;
            var sum_dotacion_sum = 0;
            var kpi_by_kpi_sum = 0;
            var kpi_by_kpi = 0;
            var sum_gasto_12_meses_moviles = 0;

            Object.values(dataPoints_aux).forEach(val => {

                //Estadísticas
                sum_facturacion_mensual += val['facturacion_mensual'];
                sum_dotacion_sum += val['dotacion'];
                kpi_by_kpi_sum += val['kpi'];
                sum_gasto_12_meses_moviles += val['gasto_12_meses_moviles'];

                //Porcentajes de Gŕafica
                switch (val['criticidad']) {
                    case 1:
                        suma_criticidad_1 +=1;
                        break;
                    case 2:
                        suma_criticidad_2 +=1;
                        break;
                    case 3:
                        suma_criticidad_3 +=1;
                        break;
                    
                    default:
                        suma_criticidad_4 +=1;
                        break;
                }
                counter +=1;

            })

            kpi_by_kpi = kpi_by_kpi_sum/counter;
            sum_dotacion = sum_dotacion_sum/counter;
            

            const porcentajes = [
                {"y" : (suma_criticidad_1/counter*100).toFixed(2), "label" : "Alta criticidad", "cant" : suma_criticidad_1},
                {"y" : (suma_criticidad_2/counter*100).toFixed(2), "label" : "Criticidad por admin", "cant" : suma_criticidad_2},
                {"y" : (suma_criticidad_3/counter*100).toFixed(2), "label" : "Baja criticidad", "cant" : suma_criticidad_3},
                {"y" : (suma_criticidad_4/counter*100).toFixed(2), "label" : "Criticidad por impacto", "cant" : suma_criticidad_4}
            ];

            console.log(porcentajes);

            changeH1Text("sum_facturacion_mensual", sum_facturacion_mensual.toFixed(0)/1000000 + " M");
            changeH1Text("sum_dotacion", sum_dotacion);
            changeH1Text("kpi_by_kpi", kpi_by_kpi.toFixed(2));
            changeH1Text("sum_gasto_12_meses_moviles", sum_gasto_12_meses_moviles/1000000 + " M");
            
            if(dataPoints_aux.length == 0){
                chart.options.data[0].dataPoints = [
                    {"y" : 0, "label" : "Alta criticidad", "cant" : 0},
                    {"y" : 0, "label" : "Criticidad por admin", "cant" : 0},
                    {"y" : 0, "label" : "Baja criticidad", "cant" : 0},
                    {"y" : 0, "label" : "Criticidad por impacto", "cant" : 0}
                ];
                chart.render();
            }else{
                chart.options.data[0].dataPoints = porcentajes;
                chart.render();
            }
        });

        //TODO corregir el tooltip cuando muestra otra categoria de criticidad que no es


        var chart = new CanvasJS.Chart("chartContainer", {
            animationEnabled: true,
            exportEnabled: true,
            //theme: "dark2", 
            title:{
                text: "Detalles"
            },
            axisX:{
                minimum: 0,
                maximum: 105,
                title: "Porcetaje X",
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
                fontSize: 16,
            },


            data: [{
                type: "pie",
                startAngle: 40,
                toolTipContent: "<b>{label}</b>: ({cant}) {y}%",

                showInLegend: "true",
                legendText: "{label}: {y}% ({cant})",
                indexLabelFontSize: 16,

                indexLabelPlacement: "inside",
                indexLabel: " ",
                dataPoints: porcentajes
            }]
        });

        chart.render();
        
    });

    
    
</script>


@endsection

