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


    <!--Page header-->
    <div class="page-header">
        <div class="page-leftheader">
            <h4 class="page-title mb-0 text-primary">Vista de Arriendo [ {{"ID : ".$arriendo->id}} ]</h4>
        </div>
        <div class="page-rightheader">
            <div class="btn-list">
                <button class="btn btn-outline-primary"><i class="fe fe-download"></i>
                    Exportar Información
                </button>
            </div>
        </div>
    </div>
    <!--End Page header-->

    <!-- Row -->
    <div class="row">
        <div class="col-xl-3 col-lg-4">
            <div class="card box-widget widget-user">
                <div class="mx-auto mt-5 rounded-circle-container">
                    @if($arriendo->activo->foto)
                        <img alt="Activo Avatar" class="rounded-circle img-rounded" src="{{asset('storage/activos/'.$arriendo->activo->id.'/'.$arriendo->activo->foto)}}">
                    @else
                        <img alt="Activo Avatar" class="rounded-circle img-rounded" src="{{asset('assets/images/brand/favicon1.png')}}">
                    @endif
                </div>
                <div class="card-body text-center pt-2 mt-2">
                    <div class="pro-user">
                        <h3 class="pro-user-username  mb-1 fs-22">{{$arriendo->activo->marca." - ".$arriendo->activo->modelo}}</h3>
                        <h6 class="pro-user-desc text-muted">Estado: <b>{{$arriendo->estado}}</b></h6>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-9 col-lg-8">
            <div class="card">
                <div class="card-header ">
                    <div class="card-title">Información del Arriendo</div>
                </div>

                <div class="card-body">
                    <div class="card-title font-weight-bold">DATOS GENERALES</div>
                    <form action="{{ route('arriendo.update', $arriendo->id) }}" method="post" id="myform" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-sm-6 col-md-6">
                                <div class="row">
                                    <label class="form-label">Monto:</label>
                                    <div class="col form-group">
                                        <input type="number" id="monto" name="monto" min="0" class="form-control" required="" value="{{$arriendo->monto}}">
                                    </div>
                                    <div class="col form-group">
                                        <div class="dropdown">
                                            <select class="form-control " id="tipo_moneda" name="tipo_moneda" required>
                                                <option @if($arriendo->tipo_moneda == "CLP") selected @endif value="CLP">CLP</option>
                                                <option @if($arriendo->tipo_moneda == "UF")  selected @endif value="UF">UF</option>
                                                <option @if($arriendo->tipo_moneda == "USD") selected @endif value="USD">USD</option>
                                            </select>
                                        </div>                                
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-sm-6 col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Fecha Inicio:</label>
                                    <input class="form-control" id="fecha_inicio" name="fecha_inicio" placeholder="Ingrese la fecha de inicio" required="" type="date" value="{{Carbon\Carbon::parse($arriendo->fecha_inicio)->format('Y-m-d')}}" >
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Encargado:</label>
                                    <input type="text" id="encargado" name="encargado"  class="form-control" required="" value="{{$arriendo->encargado}}">
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Fecha Término Arriendo:</label>
                                    <input class="form-control" id="fecha_termino" name="fecha_termino" placeholder="Ingrese la fecha de término" type="date" @if($arriendo->fecha_termino) value="{{Carbon\Carbon::parse($arriendo->fecha_termino)->format('Y-m-d')}}" @endif>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <label for="proyecto_id" class="form-control-label">Proyecto:</label>
                                <select id="proyecto_id" class="form-control block mt-1 w-full" name="proyecto_id" required>
                                    <option value="{{ $arriendo->proyecto->id }}">
                                        {{ "[ ".$arriendo->proyecto->codigo_sap." ] ".$arriendo->proyecto->nombre_sap." - "."Empresa: ".$arriendo->proyecto->empresa->nombre." - "."RUT: ".$arriendo->proyecto->empresa->rut}}
                                    </option>
                                </select>
                            </div>
                        </div>

                        <div class="row mt-4">
                            <div class="col">
                                <label class="form-control-label">Observaciones: </label>
                                <textarea class="form-control mb-4 " name='observaciones' id="observaciones" placeholder="Observaciones" rows="3" maxlength="249" >{{$arriendo->observaciones}}</textarea>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="card-footer text-end">
                    <input type="submit" form="myform" class="btn  btn-success" value="Actualizar Información" />
                    <a href="{{route('activo.trazabilidad')}}" class="btn btn-danger">Cancel</a>
                </div>
            </div>
        </div>
    </div>
    <!-- End Row-->

    <div class="row">
        <div class="card">
            <div class="card-header ">
                <div class="card-title">Cambios de Fases</div>
            </div>
            <div class="card-body">
                <div class="offer offer-warning">
                    <div class="shape">
                        <div class="shape-text">
                            
                        </div>
                    </div>
                    <div class="offer-content">
                        <h3 class="lead font-weight-semibold">
                            @if($arriendo->estado == "EN CLIENTE" && $arriendo->activo->estado == "ARRENDADO")
                                Etapa Actual: EN CLIENTE (ARRENDADO)
                            @elseif($arriendo->estado == "EN CLIENTE" && $arriendo->activo->estado == "PARA RETIRO")
                                Etapa Actual: EN CLIENTE (PARA RETIRO)
                            @else
                                Etapa Actual: {{$arriendo->estado}}
                            @endif
                        </h3>
                        <div class="panel panel-primary">
                            <div class=" tab-menu-heading p-0 bg-light">
                                <div class="tabs-menu1 ">
                                    <!-- Tabs -->
                                    <ul class="nav panel-tabs">
                                        <li class=""><a href="#tab_1" class="active" data-bs-toggle="tab">EN CAMINO IDA</a></li>
                                        <li><a href="#tab_2" data-bs-toggle="tab">EN CLIENTE (ARRENDADO)</a></li>
                                        <li><a href="#tab_3" data-bs-toggle="tab">EN CLIENTE (PARA RETIRO)</a></li>
                                        <li><a href="#tab_4" data-bs-toggle="tab">EN CAMINO VUELTA</a></li>
                                        <li><a href="#tab_5" data-bs-toggle="tab">BODEGA DE VUELTA</a></li>
                                        <li><a href="#tab_6" data-bs-toggle="tab">TERMINADO</a></li>

                                    </ul>
                                </div>
                            </div>
                            <div class="panel-body tabs-menu-body">
                                <div class="tab-content">
                                    <div class="tab-pane active " id="tab_1">
                                        @if(isset($cambios_fases[1]))
                                            <div class="row">
                                                <div class="col">
                                                    <p class="fs-14 font-weight-bold">Etapa anterior: <b>{{$cambios_fases[1][0]->fase_anterior}}</b></p>
                                                </div>
                                                <div class="col">
                                                    <p class="fs-14 font-weight-bold">Fecha: <b>{{Carbon\Carbon::parse($cambios_fases[1][0]->fecha)->format('d-m-Y')}}</b></p>
                                                </div>
                                                <div class="col">
                                                    <p class="fs-14 font-weight-bold">Encargado: <b>{{$cambios_fases[1][0]->encargado}}</b></p>
                                                </div>
                                                <div class="col">
                                                    <p class="fs-14 font-weight-bold">Firma: 
                                                        @if($cambios_fases[1][0]->firma)
                                                            <a target="_blank" href="{{ $_ENV['APP_URL'].'/storage/arriendos/'.$arriendo->id.'/'.$cambios_fases[1][0]->firma }}">
                                                                <svg width="70%" height="22" viewBox="0 0 17 17" xmlns="http://www.w3.org/2000/svg" class="si-glyph si-glyph-checked"><path d="M3.432 6.189a1 1 0 0 1 1.415 0L6.968 8.31l6.179-6.179a.99.99 0 0 1 1.401.013l2.122 2.122a.991.991 0 0 1 .014 1.4l-9.022 9.021a.99.99 0 0 1-1.401-.014l-4.95-4.95a.998.998 0 0 1 0-1.413l2.121-2.121Z" fill="#eb970a" fill="#434343"  class="si-glyph-fill" fill-rule="evenodd"/></svg>
                                                            </a>
                                                        @else
                                                            <svg width="70%" height="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 511.999 511.999" style="enable-background:new 0 0 511.999 511.999" xml:space="preserve"><path style="fill:#ff6465" d="m384.955 256 120.28-120.28c9.019-9.019 9.019-23.642 0-32.66L408.94 6.765c-9.019-9.019-23.642-9.019-32.66 0L256 127.045 135.718 6.765c-9.019-9.019-23.642-9.019-32.66 0L6.764 103.058c-9.019 9.019-9.019 23.642 0 32.66l120.28 120.28L6.764 376.28c-9.019 9.019-9.019 23.642 0 32.66l96.295 96.294c9.019 9.019 23.642 9.019 32.66 0l120.28-120.28 120.28 120.28c9.019 9.019 23.642 9.019 32.66 0l96.295-96.294c9.019-9.019 9.019-23.642 0-32.66L384.955 256z"/></svg>                                        
                                                        @endif
                                                    </p>
                                                </div>
                                            </div>
                                        @else
                                            NO EXISTEN REGISTROS DE ESTA ETAPA
                                        @endif
                                    </div>

                                    <div class="tab-pane" id="tab_2">
                                        @if(isset($cambios_fases[2]))
                                            <div class="row">
                                                <div class="col">
                                                    <p class="fs-14 font-weight-bold">Etapa anterior: <b>{{$cambios_fases[2][0]->fase_anterior}}</b></p>
                                                </div>
                                                <div class="col">
                                                    <p class="fs-14 font-weight-bold">Fecha: <b>{{Carbon\Carbon::parse($cambios_fases[2][0]->fecha)->format('d-m-Y')}}</b></p>
                                                </div>
                                                <div class="col">
                                                    <p class="fs-14 font-weight-bold">Encargado: <b>{{$cambios_fases[2][0]->encargado}}</b></p>
                                                </div>
                                                <div class="col">
                                                    <p class="fs-14 font-weight-bold">Firma: 
                                                        @if($cambios_fases[2][0]->firma)
                                                            <a target="_blank" href="{{ $_ENV['APP_URL'].'/storage/arriendos/'.$arriendo->id.'/'.$cambios_fases[2][0]->firma }}">
                                                                <svg width="70%" height="22" viewBox="0 0 17 17" xmlns="http://www.w3.org/2000/svg" class="si-glyph si-glyph-checked"><path d="M3.432 6.189a1 1 0 0 1 1.415 0L6.968 8.31l6.179-6.179a.99.99 0 0 1 1.401.013l2.122 2.122a.991.991 0 0 1 .014 1.4l-9.022 9.021a.99.99 0 0 1-1.401-.014l-4.95-4.95a.998.998 0 0 1 0-1.413l2.121-2.121Z" fill="#eb970a" fill="#434343"  class="si-glyph-fill" fill-rule="evenodd"/></svg>
                                                            </a>
                                                        @else
                                                            <svg width="70%" height="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 511.999 511.999" style="enable-background:new 0 0 511.999 511.999" xml:space="preserve"><path style="fill:#ff6465" d="m384.955 256 120.28-120.28c9.019-9.019 9.019-23.642 0-32.66L408.94 6.765c-9.019-9.019-23.642-9.019-32.66 0L256 127.045 135.718 6.765c-9.019-9.019-23.642-9.019-32.66 0L6.764 103.058c-9.019 9.019-9.019 23.642 0 32.66l120.28 120.28L6.764 376.28c-9.019 9.019-9.019 23.642 0 32.66l96.295 96.294c9.019 9.019 23.642 9.019 32.66 0l120.28-120.28 120.28 120.28c9.019 9.019 23.642 9.019 32.66 0l96.295-96.294c9.019-9.019 9.019-23.642 0-32.66L384.955 256z"/></svg>                                        
                                                        @endif
                                                    </p>
                                                </div>
                                            </div>
                                        @else
                                            NO EXISTEN REGISTROS DE ESTA ETAPA
                                        @endif
                                    </div>

                                    <div class="tab-pane" id="tab_3">
                                        @if(isset($cambios_fases[3]))
                                            <div class="row">
                                                <div class="col">
                                                    <p class="fs-14 font-weight-bold">Etapa anterior: <b>EN CLIENTE (ARRENDADO)</b></p>
                                                </div>
                                                <div class="col">
                                                    <p class="fs-14 font-weight-bold">Fecha: <b>{{Carbon\Carbon::parse($cambios_fases[3][0]->fecha)->format('d-m-Y')}}</b></p>
                                                </div>
                                                <div class="col">
                                                    <p class="fs-14 font-weight-bold">Encargado: <b>{{$cambios_fases[3][0]->encargado}}</b></p>
                                                </div>
                                                <div class="col">
                                                    <p class="fs-14 font-weight-bold">Firma: 
                                                        @if($cambios_fases[3][0]->firma)
                                                            <a target="_blank" href="{{ $_ENV['APP_URL'].'/storage/arriendos/'.$arriendo->id.'/'.$cambios_fases[3][0]->firma }}">
                                                                <svg width="70%" height="22" viewBox="0 0 17 17" xmlns="http://www.w3.org/2000/svg" class="si-glyph si-glyph-checked"><path d="M3.432 6.189a1 1 0 0 1 1.415 0L6.968 8.31l6.179-6.179a.99.99 0 0 1 1.401.013l2.122 2.122a.991.991 0 0 1 .014 1.4l-9.022 9.021a.99.99 0 0 1-1.401-.014l-4.95-4.95a.998.998 0 0 1 0-1.413l2.121-2.121Z" fill="#eb970a" fill="#434343"  class="si-glyph-fill" fill-rule="evenodd"/></svg>
                                                            </a>
                                                        @else
                                                            <svg width="70%" height="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 511.999 511.999" style="enable-background:new 0 0 511.999 511.999" xml:space="preserve"><path style="fill:#ff6465" d="m384.955 256 120.28-120.28c9.019-9.019 9.019-23.642 0-32.66L408.94 6.765c-9.019-9.019-23.642-9.019-32.66 0L256 127.045 135.718 6.765c-9.019-9.019-23.642-9.019-32.66 0L6.764 103.058c-9.019 9.019-9.019 23.642 0 32.66l120.28 120.28L6.764 376.28c-9.019 9.019-9.019 23.642 0 32.66l96.295 96.294c9.019 9.019 23.642 9.019 32.66 0l120.28-120.28 120.28 120.28c9.019 9.019 23.642 9.019 32.66 0l96.295-96.294c9.019-9.019 9.019-23.642 0-32.66L384.955 256z"/></svg>                                        
                                                        @endif
                                                    </p>
                                                </div>
                                            </div>
                                        @else
                                            NO EXISTEN REGISTROS DE ESTA ETAPA
                                        @endif
                                    </div>

                                    <div class="tab-pane" id="tab_4">
                                        @if(isset($cambios_fases[4]))
                                            <div class="row">
                                                <div class="col">
                                                    <p class="fs-14 font-weight-bold">Etapa anterior: <b>EN CLIENTE (PARA RETIRO)</b></p>
                                                </div>
                                                <div class="col">
                                                    <p class="fs-14 font-weight-bold">Fecha: <b>{{Carbon\Carbon::parse($cambios_fases[4][0]->fecha)->format('d-m-Y')}}</b></p>
                                                </div>
                                                <div class="col">
                                                    <p class="fs-14 font-weight-bold">Encargado: <b>{{$cambios_fases[4][0]->encargado}}</b></p>
                                                </div>
                                                <div class="col">
                                                    <p class="fs-14 font-weight-bold">Firma: 
                                                        @if($cambios_fases[4][0]->firma)
                                                            <a target="_blank" href="{{ $_ENV['APP_URL'].'/storage/arriendos/'.$arriendo->id.'/'.$cambios_fases[4][0]->firma }}">
                                                                <svg width="70%" height="22" viewBox="0 0 17 17" xmlns="http://www.w3.org/2000/svg" class="si-glyph si-glyph-checked"><path d="M3.432 6.189a1 1 0 0 1 1.415 0L6.968 8.31l6.179-6.179a.99.99 0 0 1 1.401.013l2.122 2.122a.991.991 0 0 1 .014 1.4l-9.022 9.021a.99.99 0 0 1-1.401-.014l-4.95-4.95a.998.998 0 0 1 0-1.413l2.121-2.121Z" fill="#eb970a" fill="#434343"  class="si-glyph-fill" fill-rule="evenodd"/></svg>
                                                            </a>
                                                        @else
                                                            <svg width="70%" height="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 511.999 511.999" style="enable-background:new 0 0 511.999 511.999" xml:space="preserve"><path style="fill:#ff6465" d="m384.955 256 120.28-120.28c9.019-9.019 9.019-23.642 0-32.66L408.94 6.765c-9.019-9.019-23.642-9.019-32.66 0L256 127.045 135.718 6.765c-9.019-9.019-23.642-9.019-32.66 0L6.764 103.058c-9.019 9.019-9.019 23.642 0 32.66l120.28 120.28L6.764 376.28c-9.019 9.019-9.019 23.642 0 32.66l96.295 96.294c9.019 9.019 23.642 9.019 32.66 0l120.28-120.28 120.28 120.28c9.019 9.019 23.642 9.019 32.66 0l96.295-96.294c9.019-9.019 9.019-23.642 0-32.66L384.955 256z"/></svg>                                        
                                                        @endif
                                                    </p>
                                                </div>
                                            </div>
                                        @else
                                            NO EXISTEN REGISTROS DE ESTA ETAPA
                                        @endif
                                    </div>

                                    <div class="tab-pane" id="tab_5">
                                        @if(isset($cambios_fases[5]))
                                            <div class="row">
                                                <div class="col">
                                                    <p class="fs-14 font-weight-bold">Etapa anterior: <b>{{$cambios_fases[5][0]->fase_anterior}}</b></p>
                                                </div>
                                                <div class="col">
                                                    <p class="fs-14 font-weight-bold">Fecha: <b>{{Carbon\Carbon::parse($cambios_fases[5][0]->fecha)->format('d-m-Y')}}</b></p>
                                                </div>
                                                <div class="col">
                                                    <p class="fs-14 font-weight-bold">Encargado: <b>{{$cambios_fases[5][0]->encargado}}</b></p>
                                                </div>
                                                <div class="col">
                                                    <p class="fs-14 font-weight-bold">Firma: 
                                                        @if($cambios_fases[5][0]->firma)
                                                            <a target="_blank" href="{{ $_ENV['APP_URL'].'/storage/arriendos/'.$arriendo->id.'/'.$cambios_fases[5][0]->firma }}">
                                                                <svg width="70%" height="22" viewBox="0 0 17 17" xmlns="http://www.w3.org/2000/svg" class="si-glyph si-glyph-checked"><path d="M3.432 6.189a1 1 0 0 1 1.415 0L6.968 8.31l6.179-6.179a.99.99 0 0 1 1.401.013l2.122 2.122a.991.991 0 0 1 .014 1.4l-9.022 9.021a.99.99 0 0 1-1.401-.014l-4.95-4.95a.998.998 0 0 1 0-1.413l2.121-2.121Z" fill="#eb970a" fill="#434343"  class="si-glyph-fill" fill-rule="evenodd"/></svg>
                                                            </a>
                                                        @else
                                                            <svg width="70%" height="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 511.999 511.999" style="enable-background:new 0 0 511.999 511.999" xml:space="preserve"><path style="fill:#ff6465" d="m384.955 256 120.28-120.28c9.019-9.019 9.019-23.642 0-32.66L408.94 6.765c-9.019-9.019-23.642-9.019-32.66 0L256 127.045 135.718 6.765c-9.019-9.019-23.642-9.019-32.66 0L6.764 103.058c-9.019 9.019-9.019 23.642 0 32.66l120.28 120.28L6.764 376.28c-9.019 9.019-9.019 23.642 0 32.66l96.295 96.294c9.019 9.019 23.642 9.019 32.66 0l120.28-120.28 120.28 120.28c9.019 9.019 23.642 9.019 32.66 0l96.295-96.294c9.019-9.019 9.019-23.642 0-32.66L384.955 256z"/></svg>                                        
                                                        @endif
                                                    </p>
                                                </div>
                                            </div>
                                        @else
                                            NO EXISTEN REGISTROS DE ESTA ETAPA
                                        @endif
                                    </div>

                                    <div class="tab-pane" id="tab_6">
                                        @if(isset($cambios_fases[6]))
                                            <div class="row">
                                                <div class="col">
                                                    <p class="fs-14 font-weight-bold">Etapa anterior: <b>{{$cambios_fases[6][0]->fase_anterior}}</b></p>
                                                </div>
                                                <div class="col">
                                                    <p class="fs-14 font-weight-bold">Fecha: <b>{{Carbon\Carbon::parse($cambios_fases[6][0]->fecha)->format('d-m-Y')}}</b></p>
                                                </div>
                                                <div class="col">
                                                    <p class="fs-14 font-weight-bold">Encargado: <b>{{$cambios_fases[6][0]->encargado}}</b></p>
                                                </div>
                                                <div class="col">
                                                    <p class="fs-14 font-weight-bold">Firma: 
                                                        @if($cambios_fases[6][0]->firma)
                                                            <a target="_blank" href="{{ $_ENV['APP_URL'].'/storage/arriendos/'.$arriendo->id.'/'.$cambios_fases[6][0]->firma }}">
                                                                <svg width="70%" height="22" viewBox="0 0 17 17" xmlns="http://www.w3.org/2000/svg" class="si-glyph si-glyph-checked"><path d="M3.432 6.189a1 1 0 0 1 1.415 0L6.968 8.31l6.179-6.179a.99.99 0 0 1 1.401.013l2.122 2.122a.991.991 0 0 1 .014 1.4l-9.022 9.021a.99.99 0 0 1-1.401-.014l-4.95-4.95a.998.998 0 0 1 0-1.413l2.121-2.121Z" fill="#eb970a" fill="#434343"  class="si-glyph-fill" fill-rule="evenodd"/></svg>
                                                            </a>
                                                        @else
                                                            <svg width="70%" height="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 511.999 511.999" style="enable-background:new 0 0 511.999 511.999" xml:space="preserve"><path style="fill:#ff6465" d="m384.955 256 120.28-120.28c9.019-9.019 9.019-23.642 0-32.66L408.94 6.765c-9.019-9.019-23.642-9.019-32.66 0L256 127.045 135.718 6.765c-9.019-9.019-23.642-9.019-32.66 0L6.764 103.058c-9.019 9.019-9.019 23.642 0 32.66l120.28 120.28L6.764 376.28c-9.019 9.019-9.019 23.642 0 32.66l96.295 96.294c9.019 9.019 23.642 9.019 32.66 0l120.28-120.28 120.28 120.28c9.019 9.019 23.642 9.019 32.66 0l96.295-96.294c9.019-9.019 9.019-23.642 0-32.66L384.955 256z"/></svg>                                        
                                                        @endif
                                                    </p>
                                                </div>
                                            </div>
                                        @else
                                            NO EXISTEN REGISTROS DE ESTA ETAPA
                                        @endif
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="card mt-4">
            <div class="card-header ">
                <div class="card-title">Registro de traspasos del arriendo</div>
            </div>

            @if(count($traspasos))
                @foreach ($traspasos as $traspaso)
                    <div class="card overflow-hidden">
                        <div class="card-header bg-primary ">
                            <h3 class="card-title text-white">{{"[ ".$traspaso->anterior->codigo_sap." ] ".$traspaso->anterior->nombre_sap}} <i class="fa fa-arrow-right text-white"></i> {{"[ ".$traspaso->actual->codigo_sap." ] ".$traspaso->actual->nombre_sap}}</h3>
                            <div class="card-options ">
                                <a href="javascript:void(0);" class="card-options-collapse me-2" data-bs-toggle="card-collapse"><i class="fe fe-chevron-up text-white"></i></a>
                                <a href="javascript:void(0);" class="card-options-remove" data-bs-toggle="card-remove"><i class="fe fe-x text-white"></i></a>
                            </div>
                        </div>
                        <div class="card-body">
                            <h3 class="card-title text-black"><i class="fa fa-calendar text-black"></i> FECHA: {{Carbon\Carbon::parse($traspaso->fecha_traspaso)->format('d-m-Y')}}</h3>
                            <h3 class="card-title text-black"><i class="fa fa-money text-black"></i> MONTO ANTERIOR: {{$traspaso->monto_anterior}} [{{$traspaso->tipo_moneda_anterior}}]</h3>


                        </div>
                        <!-- 
                        <div class="card-footer">
                            
                        </div>
                        -->
                    </div>
                @endforeach
            @else
                <div class="alert alert-danger">
                    <ul>
                        <h4 class="text-center mt-4"><b><i class="fa fa-ban text-white"></i> ESTE ARRIENDO NO HA SIDO TRASPASADO  <i class="fa fa-ban text-white"></i></b></h4>
                    </ul>
                </div>
            @endif
        </div>
    </div>

    

@endsection('content')

@section('scripts')

    <!-- INTERNAL Select2 js -->
    <script src="{{asset('assets/plugins/select2/select2.full.min.js')}}"></script>
    <script src="{{asset('assets/js/select2.js')}}"></script>

@endsection