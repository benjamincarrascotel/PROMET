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
                        <div class="row" id="form_filtros">
                            <div class="col-lg-6 col-md-12">
                                <form class="form-horizontal">

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
                        <h4 class="card-title">Todos los Contratos</h4>    
                    </div>

                    @foreach($dataPoints as $contrato)

                    <!-- Contrato -->
                    <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12" id="container_{{$contrato['id']}}">
                        <div class="card card-collapsed overflow-hidden">
                            <div class="card-header">
                                <h3 class="card-title">{{$contrato['servicio_bien']}}</h3>
                                <div class="card-options">
                                    <a href="javascript:void(0);" class="card-options-collapse me-2" data-bs-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a>
                                </div>
                            </div>
                            <div class="card-body">
                                <canvas id="myChart_{{$contrato['id']}}" style="height: 10ex; width: 100%;"></canvas>
                            </div>
                        </div>
                    </div>
                    <!-- Contrato -->

                    @endforeach
                        
                    </div>
                </div>
            </div>
        </div>


        

        @overwrite
        @include('layouts.card')

        <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/chart.js/dist/chart.umd.min.js"></script>
        <script>
            // setup 
            const data = {
                labels: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
                datasets: [
                    {
                        type: 'line',
                        label: 'Proyectada',
                        //data: ['ON', 'OFF','ON', 'OFF','ON', 'OFF', 'OFF', 'ON', 'OFF','ON', 'OFF','ON'],
                        backgroundColor: 'rgba(243, 156, 18, 1)',
                        borderColor: 'rgba(243, 156, 18, 1)',
                        yAxisID: 'power',
                        stepped: true
                    },
                    {
                        type: 'line',
                        label: 'Real',
                        //data: ['ON', 'ON','ON', 'OFF','ON', 'OFF', 'OFF', 'ON', 'ON','ON', 'OFF','ON'],
                        backgroundColor: 'rgba(255, 30, 60, 0.2)',
                        borderColor: 'rgba(255, 30, 60, 1)',
                        yAxisID: 'power2',
                        stepped: true
                    }
                ]
            };
        
            // config 
            const config = {
                data,
                options: {
                    scales: {
                        power2: {
                            type:'category',
                            labels: ['Activo', 'No activo'],
                            stack: 'water',
                            stackWeight: 1,
                            offset: true,
                            grid: {
                                borderColor: 'rgba(243, 156, 18, 1)'
                            }

                        },
                        power: {
                            type:'category',
                            labels: ['Activo', 'No activo'],
                            stack: 'water',
                            stackWeight: 1,
                            offset: true,
                            grid: {
                                borderColor: 'rgba(54, 159, 235, 1)'
                            }

                        },
                        
                    }
                }
            };
            
            var contratos_data = {!! json_encode($dataPoints) !!};
            

            contratos_data.forEach(element => {
                // render init block
                const myChart = new Chart(
                    document.getElementById('myChart_'+ element.id),
                    config
                );

                //Inicializamos la info del chart
                myChart.data.datasets[0].data = element['proyectada'];
                myChart.data.datasets[1].data = element['real'];
                myChart.update();
                
            });
            
            
        </script>
    @endpush

    

    <script type="text/javascript">

    $(document).ready(function(){


        $('#form_filtros').on('change', function () {
            
            let dataPoints_aux = contratos_data;

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

            console.log(dataPoints_aux);

            contratos_data.forEach(element => {

                if(!dataPoints_aux.includes(element)) document.getElementById('container_'+ element.id).hidden = true;
                else document.getElementById('container_'+ element.id).hidden = false;

                //Modificamos atributo hidden
                
            });


        });

    });

    </script>

    <script type="text/javascript" src="https://canvasjs.com/assets/script/jquery-1.11.1.min.js"></script>
    <script type="text/javascript" src="https://cdn.canvasjs.com/jquery.canvasjs.min.js"></script>

@endsection
