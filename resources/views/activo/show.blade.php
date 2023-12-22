@extends('layouts.app')

@section('styles')

		<!-- INTERNAL Select2 css -->
		<link href="{{asset('assets/plugins/select2/select2.min.css')}}" rel="stylesheet" />

        <style>
            .rounded-circle-container {
                width: 150px; /* Ajusta el valor según tus necesidades */
                height: 150px; /* Ajusta el valor según tus necesidades */
                overflow: hidden;
            }
            
            .img-rounded {
                width: 100%;
                height: 100%;
                object-fit: cover; /* Para asegurarte de que la imagen se ajuste sin deformarse */
            }
        </style>

        

@endsection

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


    <!--Page header-->
    <div class="page-header">
        <div class="page-leftheader">
            <h4 class="page-title mb-0 text-primary">Vista de Activo [ {{"ID : ".$activo->id}} ]</h4>
        </div>
        <div class="page-rightheader">
            <div class="btn-list">
                <button class="btn btn-outline-primary"><i class="fe fe-download"></i>
                    Exportar Información
                </button>
                <!--
                <a href="javascript:void(0);"  class="btn btn-primary btn-pill" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fa fa-calendar me-2 fs-14"></i> Search By Date</a>
                <div class="dropdown-menu border-0">
                        <a class="dropdown-item" href="javascript:void(0);">Today</a>
                        <a class="dropdown-item" href="javascript:void(0);">Yesterday</a>
                        <a class="dropdown-item active bg-primary text-white" href="javascript:void(0);">Last 7 days</a>
                        <a class="dropdown-item" href="javascript:void(0);">Last 30 days</a>
                        <a class="dropdown-item" href="javascript:void(0);">Last Month</a>
                        <a class="dropdown-item" href="javascript:void(0);">Last 6 months</a>
                        <a class="dropdown-item" href="javascript:void(0);">Last year</a>
                </div>
                -->
            </div>
        </div>
    </div>
    <!--End Page header-->

    <!-- Row -->
    <div class="row">
        <div class="col-xl-3 col-lg-4">
            <div class="card box-widget widget-user">
                <div class="mx-auto mt-5 rounded-circle-container">
                    @if($activo->foto)
                        <img alt="Activo Avatar" class="rounded-circle img-rounded" src="{{asset('storage/activos/'.$activo->id.'/'.$activo->foto)}}">
                    @else
                        <img alt="Activo Avatar" class="rounded-circle img-rounded" src="{{asset('assets/images/brand/favicon1.png')}}">
                    @endif
                </div>
                <div class="card-body text-center pt-2 mt-2">
                    <div class="pro-user">
                        <h3 class="pro-user-username  mb-1 fs-22">{{$activo->marca." - ".$activo->modelo}}</h3>
                        <h6 class="pro-user-desc text-muted">{{$activo->clasificacion}}</h6>
                        <!--
                        <div class="text-center mb-4">
                            <span><i class="fa fa-star text-warning"></i></span>
                            <span><i class="fa fa-star text-warning"></i></span>
                            <span><i class="fa fa-star text-warning"></i></span>
                            <span><i class="fa fa-star-half-o text-warning"></i></span>
                            <span><i class="fa fa-star-o text-warning"></i></span>
                        </div>
                        <a href="javascript:void(0);" class="btn btn-primary mt-3">View Profile</a>
                        -->
                    </div>
                </div>
                <div class="card-footer p-0">
                    <div class="row">
                        <div class="text-center">
                            <div class="description-block p-4">
                                @if($proceso)
                                    @if($proceso->arriendo_venta_flag == 1)
                                        <span class="text-muted">Proceso:</span>
                                        <h5 class="description-header mb-1 font-weight-bold  number-font">{{'[ARRIENDO ID : '.$proceso->id.' ]'}}<br>{{'[PROYECTO: '.$proceso->proyecto->nombre_sap.' ]'}}</h5>
                                    @elseif($proceso->arriendo_venta_flag == 0)
                                    <span class="text-muted">Proceso:</span>
                                    <h5 class="description-header mb-1 font-weight-bold  number-font">{{'[VENTA ID : '.$proceso->id.' ]'}}<br>{{'[PROYECTO: '.$proceso->proyecto->nombre_sap.' ]'}}</h5>
                                    @endif
                                @else
                                    <span class="text-muted">Cantidad de procesos totales:</span>
                                    <h5 class="description-header mb-1 font-weight-bold  number-font">{{$n_procesos}}</h5>
                                @endif
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
            <!--
                <div class="card">
                    <div class="card-header ">
                        <div class="card-title">Edit Password</div>
                    </div>
                    <div class="card-body">
                        <div class="text-center mb-5">
                            <div class="widget-user-image mx-auto mt-5 rounded-circle-container">
                                <img alt="User Avatar" class="rounded-circle img-rounded" src="{{asset('assets/images/users/2.jpg')}}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Change Password</label>
                            <input type="password" class="form-control" value="password">
                        </div>
                        <div class="form-group">
                            <label class="form-label">New Password</label>
                            <input type="password" class="form-control" value="password">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Confirm Password</label>
                            <input type="password" class="form-control" value="password">
                        </div>
                    </div>
                    <div class="card-footer text-end">
                        <a href="javascript:void(0);" class="btn btn-success">Updated</a>
                        <a href="javascript:void(0);" class="btn btn-danger">Cancel</a>
                    </div>
                </div>
            -->
        </div>
        <div class="col-xl-9 col-lg-8">
            <div class="card">
                <div class="card-header ">
                    <div class="card-title">Información del Activo</div>
                </div>

                <div class="card-body">
                    <div class="card-title font-weight-bold">DATOS GENERALES:</div>
                    <form action="{{ route('activo.update', $activo->id) }}" method="post" id="myform" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-sm-6 col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Marca</label>
                                    <input class="form-control" id="marca" name="marca" placeholder="Ingrese la marca del activo" required="" type="text" value="{{$activo->marca}}">
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Modelo</label>
                                    <input class="form-control" id="modelo" name="modelo" placeholder="Ingrese el modelo del activo" required="" type="text" value="{{$activo->modelo}}">
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Año</label>
                                    <input type="number" id="año" name="año" min="1950" max="2023" class="form-control" required="" value="{{$activo->año}}">
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Clasificación</label>
                                    <input class="form-control" id="clasificacion" name="clasificacion" placeholder="Ingrese el modelo del activo" required="" type="text" value="{{$activo->clasificacion}}">
                                </div>
                            </div>											
                            <div class="col-sm-6 col-md-4">
                                <div class="form-group">
                                    <label class="form-label">Código Interno</label>
                                    <input type="text" id="codigo_interno" name="codigo_interno" placeholder="Ingrese el código interno del activo" class="form-control" required="" value="{{$activo->codigo_interno}}">
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-3">
                                <div class="form-group">
                                    <label class="form-label">Número de serie</label>
                                    <input class="form-control" id="numero_serie" name="numero_serie" placeholder="Ingrese el número de serie del activo" type="text" value="{{$activo->numero_serie}}">
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label class="form-label">Horas de uso promedio</label>
                                    <input type="number" id="horas_uso_promedio" name="horas_uso_promedio" min="0" class="form-control" required="" value="{{$activo->horas_uso_promedio}}">
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label class="form-label">Tiempo de uso (Meses)</label>
                                    <input type="number" id="tiempo_uso_meses" name="tiempo_uso_meses" min="0" class="form-control" value="{{$activo->tiempo_uso_meses}}">
                                </div>
                            </div>
                            
                            <div class="row">

                                <div class="col-sm-6 col-md-6">
                                    <div class="form-group">
                                        <label for="familia_id" class="form-label">Familia de Productos: </label>
                                        <select id="familia_id" class="form-control block mt-1 w-full" name="familia_id" required>
                                            <option value={{null}}>Seleccione alguna de las opciones</option>
                                            @foreach ($familias as $value)
                                                <option value="{{ $value->id }}" {{ $value->id == $activo->sub_familia->familia->id ? 'selected' : '' }}>
                                                    {{ "[ ".$value->id." ] - ".$value->acronimo." - ".$value->nombre }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-6">
                                    <div class="form-group">
                                        <label for="sub_familia_id" class="form-label">Familia de Productos: </label>
                                        <select id="sub_familia_id" class="form-control block mt-1 w-full" name="sub_familia_id" required>
                                            <option value={{null}}>Seleccione alguna de las opciones</option>
                                            @foreach ($sub_familias[$activo->sub_familia->familia->id] as $value)
                                                <option value="{{ $value->id }}" {{ $value->id == $activo->sub_familia->id ? 'selected' : '' }}>
                                                    {{ "[ ".$value->id." ] - ".$value->acronimo." - ".$value->nombre }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-title font-weight-bold mt-5">Imagen del activo:</div>
                        <div class="row">
                            @if($activo->foto)
                                <input type="file" class="dropify" id='foto' name="foto" data-height="180" data-default-file="{{asset('storage/activos/'.$activo->id.'/'.$activo->foto)}}"  />
                            @else
                                <input type="file" class="dropify" id='foto' name="foto" data-height="180" />
                            @endif
                        </div>


                        <div class="card-title font-weight-bold mt-5">DATOS FINANCIEROS:</div>
                        <div class="row">
                            <div class="col-sm-6 col-md-6">
                                <div class="row">
                                    <label class="form-label">Precio de compra</label>
                                    <div class="col form-group">
                                        <input type="number" id="precio_compra" name="precio_compra" min="0" class="form-control" required="" value="{{$activo->precio_compra}}">
                                    </div>
                                    <div class="col form-group">
                                        <div class="dropdown">
                                            <select class="form-control " id="tipo_moneda" name="tipo_moneda" required>
                                                <option @if($activo->tipo_moneda == "CLP") selected @endif value="CLP">CLP</option>
                                                <option @if($activo->tipo_moneda == "UF")  selected @endif value="UF">UF</option>
                                                <option @if($activo->tipo_moneda == "USD") selected @endif value="USD">USD</option>
                                            </select>
                                        </div>                                
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Orden de compra</label>
                                    <input class="form-control" id="orden_de_compra" name="orden_compra" placeholder="Ingrese la orden de compra del activo" required="" type="text" value="{{$activo->orden_compra}}">
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Vida útil (Meses)</label>
                                    <input type="number" id="vida_util" name="vida_util" min="0" class="form-control" required="" value="{{$activo->vida_util}}">
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Valor residual (%)</label>
                                    <input type="number" id="valor_residual" name="valor_residual" min="0" max="100" class="form-control" value="{{$activo->valor_residual}}">
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Centro de costos</label>
                                    <input class="form-control" id="centro_costos" name="centro_costos" type="text" value="{{$activo->centro_costos}}">
                                </div>
                            </div>
                        </div>

                        <div class="card-title font-weight-bold mt-5">Archivos (OC, Guía de Despacho u otros): </div>
                        <div class="row">
                            <div class="col">
                                @if($activo->archivo)
                                    <input type="file" class="dropify" id='archivo' name="archivo" data-height="180" data-default-file="{{asset('storage/activos/'.$activo->id.'/'.$activo->archivo)}}"  />
                                @else
                                    <input type="file" class="dropify" id='archivo' name="archivo" data-height="180" />
                                @endif
                            </div>
                            <div class="col">
                                @if($activo->archivo2)
                                    <input type="file" class="dropify" id='archivo2' name="archivo2" data-height="180" data-default-file="{{asset('storage/activos/'.$activo->id.'/'.$activo->archivo2)}}"  />
                                @else
                                    <input type="file" class="dropify" id='archivo2' name="archivo2" data-height="180" />
                                @endif
                            </div>
                            <div class="col">
                                @if($activo->archivo3)
                                    <input type="file" class="dropify" id='archivo3' name="archivo3" data-height="180" data-default-file="{{asset('storage/activos/'.$activo->id.'/'.$activo->archivo3)}}"  />
                                @else
                                    <input type="file" class="dropify" id='archivo3' name="archivo3" data-height="180" />
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
                <div class="card-footer text-end">
                    <input type="submit" form="myform" class="btn  btn-success" value="Actualizar Información" />
                    <a href="{{route('activo.index')}}" class="btn btn-danger">Cancel</a>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header ">
                <div class="card-title">Historial de Mantenciones</div>
            </div>
            <div class="card-body">
                @if(count($mantenciones) > 0 )
                    @foreach($mantenciones as $mantencion)
                        <div class="offer offer-warning">
                            <div class="shape">
                                <div class="shape-text">
                                    N°{{$mantencion->n}}
                                </div>
                            </div>
                            <div class="offer-content">
                                <h3 class="lead font-weight-semibold">
                                    Proveedor: {{$mantencion->nombre_proveedor." / ".$mantencion->rut_proveedor." / ".$mantencion->contacto_proveedor}}
                                </h3>
                                <div class="panel panel-primary">
                                    <div class=" tab-menu-heading p-0 bg-light">
                                        <div class="tabs-menu1 ">
                                            <!-- Tabs -->
                                            <ul class="nav panel-tabs">
                                                <li class=""><a href="#tab_{{$mantencion->id}}_1" class="active" data-bs-toggle="tab">Información General</a></li>
                                                <li><a href="#tab_{{$mantencion->id}}_2" data-bs-toggle="tab">Observaciones</a></li>
                                                <li><a href="#tab_{{$mantencion->id}}_3" data-bs-toggle="tab">Documentos</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="panel-body tabs-menu-body">
                                        <div class="tab-content">
                                            <div class="tab-pane active " id="tab_{{$mantencion->id}}_1">
                                                <div class="row">
                                                    <div class="col">
                                                        <p class="fs-14 font-weight-bold">ESTADO: <b>{{$mantencion->estado}}</b></p>

                                                        <p class="fs-14 font-weight-bold">Costo: <b>{{$mantencion->costo_mantencion." [".$mantencion->tipo_moneda."]"}}</b></p>
                                                        
                                                    </div>
                                                    <div class="col">
                                                        <p class="fs-14 font-weight-bold">Fecha de inicio: <b>{{Carbon\Carbon::parse($mantencion->fecha_inicio)->format('d-m-Y')}}</b></p>
                                                        <p class="fs-14 font-weight-bold">Fecha de término: 
                                                            <b>
                                                                @if($mantencion->fecha_termino)
                                                                    {{Carbon\Carbon::parse($mantencion->fecha_termino)->format('d-m-Y')}}
                                                                @else
                                                                    NO REGISTRADA
                                                                @endif
                                                            </b>
                                                        </p>                                                        
                                                    </div>
                                                    <div class="col">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="tab-pane " id="tab_{{$mantencion->id}}_2">
                                                @if($mantencion->observaciones)
                                                    <p>{{'"'.$mantencion->observaciones.'"'}}</p>
                                                @else
                                                    <p>NO SE REGISTRAN OBSERVACIONES</p>
                                                @endif
                                            </div>
                                            <div class="tab-pane " id="tab_{{$mantencion->id}}_3">
                                                <div class="row">
                                                    <div class="col">
                                                        <p class="fs-14 font-weight-bold">Cotización: </p>
                                                    </div>
                                                    <div class="col">
                                                        @if($mantencion->cotizacion_mantencion)
                                                            <a target="_blank" href="{{ $_ENV['APP_URL'].'/storage/mantenciones/'.$mantencion->activo->id.'/'.$mantencion->cotizacion_mantencion }}">
                                                                <svg width="70%" height="22" viewBox="0 -0.5 17 17" xmlns="http://www.w3.org/2000/svg" class="si-glyph si-glyph-checked"><path d="M3.432 6.189a1 1 0 0 1 1.415 0L6.968 8.31l6.179-6.179a.99.99 0 0 1 1.401.013l2.122 2.122a.991.991 0 0 1 .014 1.4l-9.022 9.021a.99.99 0 0 1-1.401-.014l-4.95-4.95a.998.998 0 0 1 0-1.413l2.121-2.121Z" fill="#eb970a" fill="#434343"  class="si-glyph-fill" fill-rule="evenodd"/></svg>
                                                            </a>
                                                        @else
                                                            <svg width="70%" height="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 511.999 511.999" style="enable-background:new 0 0 511.999 511.999" xml:space="preserve"><path style="fill:#ff6465" d="m384.955 256 120.28-120.28c9.019-9.019 9.019-23.642 0-32.66L408.94 6.765c-9.019-9.019-23.642-9.019-32.66 0L256 127.045 135.718 6.765c-9.019-9.019-23.642-9.019-32.66 0L6.764 103.058c-9.019 9.019-9.019 23.642 0 32.66l120.28 120.28L6.764 376.28c-9.019 9.019-9.019 23.642 0 32.66l96.295 96.294c9.019 9.019 23.642 9.019 32.66 0l120.28-120.28 120.28 120.28c9.019 9.019 23.642 9.019 32.66 0l96.295-96.294c9.019-9.019 9.019-23.642 0-32.66L384.955 256z"/></svg>                                        
                                                        @endif
                                                    </div>
                                                    <div class="col">
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col">
                                                        <p class="fs-14 font-weight-bold">Comprobante de término: </p>
                                                    </div>
                                                    <div class="col">
                                                        @if($mantencion->comprobante_termino)
                                                        <a target="_blank" href="{{ $_ENV['APP_URL'].'/storage/mantenciones/'.$mantencion->activo->id.'/'.$mantencion->comprobante_termino }}">
                                                                <svg width="70%" height="22" viewBox="0 -0.5 17 17" xmlns="http://www.w3.org/2000/svg" class="si-glyph si-glyph-checked"><path d="M3.432 6.189a1 1 0 0 1 1.415 0L6.968 8.31l6.179-6.179a.99.99 0 0 1 1.401.013l2.122 2.122a.991.991 0 0 1 .014 1.4l-9.022 9.021a.99.99 0 0 1-1.401-.014l-4.95-4.95a.998.998 0 0 1 0-1.413l2.121-2.121Z" fill="#eb970a" fill="#434343"  class="si-glyph-fill" fill-rule="evenodd"/></svg>
                                                            </a>
                                                        @else
                                                            <svg width="70%" height="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 511.999 511.999" style="enable-background:new 0 0 511.999 511.999" xml:space="preserve"><path style="fill:#ff6465" d="m384.955 256 120.28-120.28c9.019-9.019 9.019-23.642 0-32.66L408.94 6.765c-9.019-9.019-23.642-9.019-32.66 0L256 127.045 135.718 6.765c-9.019-9.019-23.642-9.019-32.66 0L6.764 103.058c-9.019 9.019-9.019 23.642 0 32.66l120.28 120.28L6.764 376.28c-9.019 9.019-9.019 23.642 0 32.66l96.295 96.294c9.019 9.019 23.642 9.019 32.66 0l120.28-120.28 120.28 120.28c9.019 9.019 23.642 9.019 32.66 0l96.295-96.294c9.019-9.019 9.019-23.642 0-32.66L384.955 256z"/></svg>                                        
                                                        @endif
                                                    </div>
                                                    <div class="col">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="alert alert-danger">
                        <ul>
                            <h4 class="text-center mt-4"><b><i class="fa fa-ban text-white"></i> ESTE ACTIVO NO REGISTRA MANTENCIONES  <i class="fa fa-ban text-white"></i></b></h4>
                        </ul>
                    </div>
                @endif
            </div>
        </div>

    </div>
    <!-- End Row-->

    

    

@endsection('content')

@section('scripts')

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            var familiaSelect = document.getElementById("familia_id");
            var subFamiliaSelect = document.getElementById("sub_familia_id");
            var subFamilias = {!! $sub_familias->toJson() !!}; // Convierte la colección de sub_familias a un array JavaScript
            
            // Función para actualizar las opciones del input de sub_familias
            function actualizarSubFamilias() {
                var selectedFamiliaId = familiaSelect.value;

                // Limpiar las opciones actuales
                subFamiliaSelect.innerHTML = '';

                // Agregar la opción predeterminada
                var defaultOption = document.createElement("option");
                defaultOption.value = null;
                defaultOption.text = "Seleccione alguna de las opciones";
                subFamiliaSelect.appendChild(defaultOption);

                // Agregar las sub_familias correspondientes a la familia seleccionada
                subFamilias[selectedFamiliaId].forEach(function (subFamilia) {
                    var option = document.createElement("option");
                    option.value = subFamilia.id;
                    option.text = "[ "+subFamilia.id+" ] - "+subFamilia.acronimo+" - "+subFamilia.nombre ;
                    subFamiliaSelect.appendChild(option);
                });
            }

            // Asignar el evento change al input de familias
            familiaSelect.addEventListener("change", function () {
                actualizarSubFamilias();
            });

        });
    </script>

    <!-- Debo colocar el script dentro de la "section" para que logre acceder al input "foto" -->
    <script>
        var uploadField = document.getElementById("foto");
            uploadField.onchange = function() {
                console.log("entra");
                if(this.files[0].size > 2097152){
                    alert("Ingresa un archivo de máximo 2 [Mb]");
                    this.value = "";
                };
            };
    </script>

    <script src="{{ asset('dropify/js/dropify.js' )}}"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            $('.dropify').dropify();
        });
    </script>
    <!-- INTERNAL File Uploads css-->
    <link href="{{asset('assets/plugins/fileupload/css/fileupload.css')}}" rel="stylesheet" type="text/css" />

    <!-- INTERNAL Select2 js -->
    <script src="{{asset('assets/plugins/select2/select2.full.min.js')}}"></script>
    <script src="{{asset('assets/js/select2.js')}}"></script>

@endsection