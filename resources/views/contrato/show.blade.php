@extends('layouts.app')
<link href="{{asset('assets/css/timeline.css')}}" rel="stylesheet">

@section('content')

    @section('title')
    &nbsp;
    <h3>
        Contrato ID: {{$contrato->id}} - Código SAP N°{{$contrato->contrato_sap ?? ''}} - Proveedor "{{$contrato->proveedor->nombre}}"
    </h3>
    &nbsp;
    @endsection

    @push('cards')
        @section('card_title')
            Información
            <span title="TOOL TIP DE AYUDA PARA ESTA TABLA.">
                <svg width="20px" height="20px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M2 7C2 4.23858 4.23858 2 7 2H17C19.7614 2 22 4.23858 22 7V17C22 19.7614 19.7614 22 17 22H7C4.23858 22 2 19.7614 2 17V7ZM7 4C5.34315 4 4 5.34315 4 7V17C4 18.6569 5.34315 20 7 20H17C18.6569 20 20 18.6569 20 17V7C20 5.34315 18.6569 4 17 4H7ZM12 7.5C10.5523 7.5 10 8.55229 10 9C10 9.55229 9.55228 10 9 10C8.44772 10 8 9.55229 8 9C8 7.44772 9.44771 5.5 12 5.5C13.1557 5.5 14.1702 5.78891 14.9085 6.43492C15.6643 7.09623 16 8.01748 16 9C16 10.1875 15.6945 11.0279 15.1178 11.6677C14.8502 11.9645 14.5539 12.1844 14.2896 12.3608C14.1648 12.4442 14.0375 12.524 13.9223 12.5962L13.9043 12.6075C13.7803 12.6853 13.6678 12.7561 13.5575 12.8302C13.2061 13.0662 13.0643 13.2421 13.0061 13.3563C12.9615 13.4436 12.9296 13.5614 12.9786 13.7942C13.0922 14.3347 12.7462 14.865 12.2058 14.9786C11.6653 15.0922 11.135 14.7462 11.0214 14.2058C10.8952 13.6054 10.938 13.0088 11.2247 12.4472C11.4975 11.9124 11.9434 11.505 12.4425 11.1698C12.5822 11.076 12.7197 10.9896 12.8418 10.9131L12.851 10.9073C12.9733 10.8306 13.0787 10.7646 13.1791 10.6975C13.3836 10.561 13.5248 10.4478 13.6322 10.3286C13.8055 10.1363 14 9.81253 14 9C14 8.48252 13.8357 8.15377 13.5915 7.94008C13.3298 7.71109 12.8443 7.5 12 7.5ZM12 15.7812C11.4477 15.7812 11 16.229 11 16.7812C11 17.3335 11.4477 17.7812 12 17.7812C12.5523 17.7812 13 17.3335 13 16.7812C13 16.229 12.5523 15.7812 12 15.7812Z" fill="black"/>
                </svg>
            </span>
        @overwrite
        
        @section('card_content')
        <div class="row">
            <div class="card">
                <div class="card-body">
                    <div class="panel panel-light">
                        <div class="tab-menu-heading">
                            <div class="tabs-menu ">
                                <!-- Tabs -->
                                <ul class="nav panel-tabs shop-des-tabs">
                                    <li class=""><a href="#tab1" class="active" data-bs-toggle="tab">Descripción General</a></li>
                                    <li class=""><a href="#tab2" data-bs-toggle="tab">Detalles</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="panel-body tabs-menu-body fs-13">
                            <div class="tab-content">
                                <div class="tab-pane active" id="tab1">
                                    <ul>
                                        <li class="row mb-5">
                                            <div class="col-sm-3 text-muted">Clasificación</div>
                                            <div class="col-sm-9">{{$contrato->clasificacion->nombre_clasificacion}}</div>
                                        </li>
                                        <li class="row mb-5">
                                            <div class="col-sm-3 text-muted">Tipo de Contrato (General)</div>
                                            <div class="col-sm-9">{{$contrato->tipo_contrato_general}}</div>
                                        </li>
                                        <li class="row mb-5">
                                            <div class="col-sm-3 text-muted">Tipo de Contrato (Específico)</div>
                                            <div class="col-sm-9">{{$contrato->detalle_contrato[0]->tipo_contrato->nombre_tipo}}</div>
                                        </li>
                                        <li class="row mb-5">
                                            <div class="col-sm-3 text-muted">Tipo de Renovación</div>
                                            <div class="col-sm-9">{{$contrato->tipo_renovacion}}</div>
                                        </li>
                                        <li class="row mb-5">
                                            <div class="col-sm-3 text-muted">Faena</div>
                                            <div class="col-sm-9">{{$contrato->faena->nombre_faena}}</div>
                                        </li>
                                        <li class="row mb-5">
                                            <div class="col-sm-3 text-muted">Área</div>
                                            <div class="col-sm-9">{{$contrato->area->nombre_area}}</div>
                                        </li>
                                        <li class="row mb-5">
                                            <div class="col-sm-3 text-muted">Centro</div>
                                            <div class="col-sm-9">{{$contrato->centro->nombre_centro}}</div>
                                        </li>
                                        <li class="row mb-5">
                                            <div class="col-sm-3 text-muted">Servicio / Bien</div>
                                            <div class="col-sm-9">{{$contrato->servicio_bien->nombre_servicio_bien}}</div>
                                        </li>
                                        <li class="row mb-5">
                                            <div class="col-sm-3 text-muted">Proveedor</div>
                                            <div class="col-sm-9">{{$contrato->proveedor->nombre}}</div>
                                        </li>
                                        <li class="row mb-5">
                                            <div class="col-sm-3 text-muted">Contrato SAP</div>
                                            <div class="col-sm-9">{{$contrato->contrato_sap}}</div>
                                        </li>
                                        <li class="row mb-5">
                                            <div class="col-sm-3 text-muted">Admin de Contrato</div>
                                            <div class="col-sm-9">{{$contrato->admin_contrato->nombre}}</div>
                                        </li>
                                        <li class="row mb-5">
                                            <div class="col-sm-3 text-muted">Abastecimiento</div>
                                            <div class="col-sm-9">{{$contrato->abastecimiento_user->nombre}}</div>
                                        </li>
                                        <li class="row mb-5">
                                            <div class="col-sm-3 text-muted">Descripción</div>
                                            <div class="col-sm-9">{{$contrato->descripcion}}</div>
                                        </li>
                                        <li class="row mb-5">
                                            <div class="col-sm-3 text-muted">Estado Contrato</div>
                                            <div class="col-sm-9">{{$contrato->estatus}}</div>
                                        </li>
                                        
                                    </ul>
                                </div>
                                <div class="tab-pane" id="tab2">
                                    <ul>
                                        <li class="row mb-5">
                                            <div class="col-sm-3 text-muted">
                                                Gasto anual
                                            </div>
                                            <div class="col-sm-9">
                                                {{$contrato->detalle_contrato[0]->gasto_anual}}
                                            </div>
                                        </li>
                                        <li class="row mb-5">
                                            <div class="col-sm-3 text-muted">
                                                Fecha Inicio
                                            </div>
                                            <div class="col-sm-9">
                                                {{Carbon\Carbon::parse($contrato->detalle_contrato[0]->fecha_inicio)->format('d-m-Y')}}
                                            </div>
                                        </li>
                                        <li class="row mb-5">
                                            <div class="col-sm-3 text-muted">
                                                Fecha Término
                                            </div>
                                            <div class="col-sm-3">
                                                {{Carbon\Carbon::parse($contrato->detalle_contrato[0]->fecha_termino)->format('d-m-Y')}}
                                            </div>
                                        </li>
                                        <li class="row mb-5">
                                            <div class="col-sm-3 text-muted">
                                                Facturación Mensual
                                            </div>
                                            <div class="col-sm-3">
                                                {{$contrato->detalle_contrato[0]->facturacion_mensual}}
                                            </div>
                                        </li>
                                        <li class="row mb-5">
                                            <div class="col-sm-3 text-muted">
                                                Monto Factible
                                            </div>
                                            <div class="col-sm-3">
                                                {{$contrato->detalle_contrato[0]->monto_factible}}
                                            </div>
                                        </li>
                                        <li class="row mb-5">
                                            <div class="col-sm-3 text-muted">
                                                Interferencia Ops
                                            </div>
                                            <div class="col-sm-3">
                                                {{$contrato->detalle_contrato[0]->interferencia_ops}}
                                            </div>
                                        </li>
                                        <li class="row mb-5">
                                            <div class="col-sm-3 text-muted">
                                                Duración
                                            </div>
                                            <div class="col-sm-3">
                                                @if($contrato->detalle_contrato[0]->duracion == 1)
                                                    {{$contrato->detalle_contrato[0]->duracion}} [Mes]
                                                @else 
                                                    {{$contrato->detalle_contrato[0]->duracion}} [Meses]
                                                @endif

                                            </div>
                                        </li>
                                        <li class="row mb-5">
                                            <div class="col-sm-3 text-muted">
                                                Porcentaje 1
                                            </div>
                                            <div class="col-sm-3">
                                                {{$contrato->detalle_contrato[0]->porcentaje_1 *100}}%
                                            </div>
                                        </li>
                                        <li class="row mb-5">
                                            <div class="col-sm-3 text-muted">
                                                Riesgo Negocio
                                            </div>
                                            <div class="col-sm-3">
                                                {{$contrato->detalle_contrato[0]->riesgo_negocio}}
                                            </div>
                                        </li>
                                        <li class="row mb-5">
                                            <div class="col-sm-3 text-muted">
                                                Criticidad Ops
                                            </div>
                                            <div class="col-sm-3">
                                                {{$contrato->detalle_contrato[0]->criticidad_ops}}
                                            </div>
                                        </li>
                                        <li class="row mb-5">
                                            <div class="col-sm-3 text-muted">
                                                Criticidad Personas
                                            </div>
                                            <div class="col-sm-3">
                                                {{$contrato->detalle_contrato[0]->criticidad_personas}}
                                            </div>
                                        </li>
                                        <li class="row mb-5">
                                            <div class="col-sm-3 text-muted">
                                                Cantidad Áreas Involucradas
                                            </div>
                                            <div class="col-sm-3">
                                                {{$contrato->detalle_contrato[0]->cantidad_areas_invo}}
                                            </div>
                                        </li>
                                        <li class="row mb-5">
                                            <div class="col-sm-3 text-muted">
                                                Procentaje 2
                                            </div>
                                            <div class="col-sm-3">
                                                {{$contrato->detalle_contrato[0]->porcentaje_2*100}}%
                                            </div>
                                        </li>
                                        <li class="row mb-5">
                                            <div class="col-sm-3 text-muted">
                                                Transversal
                                            </div>
                                            <div class="col-sm-3">
                                                {{$contrato->detalle_contrato[0]->transversal}}
                                            </div>
                                        </li>
                                        <li class="row mb-5">
                                            <div class="col-sm-3 text-muted">
                                                Acción
                                            </div>
                                            <div class="col-sm-3">
                                                {{$contrato->detalle_contrato[0]->accion_contrato->nombre_accion}}
                                            </div>
                                        </li>
                                        <li class="row mb-5">
                                            <div class="col-sm-3 text-muted">
                                                KPI
                                            </div>
                                            <div class="col-sm-3">
                                                @if($contrato->detalle_contrato[0]->kpi)
                                                    SI
                                                @else
                                                    NO
                                                @endif
                                            </div>
                                        </li>
                                        <li class="row mb-5">
                                            <div class="col-sm-3 text-muted">
                                                Polinomio
                                            </div>
                                            <div class="col-sm-3">
                                                @if($contrato->detalle_contrato[0]->polinomio)
                                                    SI
                                                @else
                                                    NO
                                                @endif
                                            </div>
                                        </li>


                                    </ul>
                                <div class=""></div>
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



    @push('cards')
        @section('card_title')
            Fases Programadas de Licitación
            <span title="TOOL TIP DE AYUDA PARA ESTA TABLA.">
                <svg width="20px" height="20px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M2 7C2 4.23858 4.23858 2 7 2H17C19.7614 2 22 4.23858 22 7V17C22 19.7614 19.7614 22 17 22H7C4.23858 22 2 19.7614 2 17V7ZM7 4C5.34315 4 4 5.34315 4 7V17C4 18.6569 5.34315 20 7 20H17C18.6569 20 20 18.6569 20 17V7C20 5.34315 18.6569 4 17 4H7ZM12 7.5C10.5523 7.5 10 8.55229 10 9C10 9.55229 9.55228 10 9 10C8.44772 10 8 9.55229 8 9C8 7.44772 9.44771 5.5 12 5.5C13.1557 5.5 14.1702 5.78891 14.9085 6.43492C15.6643 7.09623 16 8.01748 16 9C16 10.1875 15.6945 11.0279 15.1178 11.6677C14.8502 11.9645 14.5539 12.1844 14.2896 12.3608C14.1648 12.4442 14.0375 12.524 13.9223 12.5962L13.9043 12.6075C13.7803 12.6853 13.6678 12.7561 13.5575 12.8302C13.2061 13.0662 13.0643 13.2421 13.0061 13.3563C12.9615 13.4436 12.9296 13.5614 12.9786 13.7942C13.0922 14.3347 12.7462 14.865 12.2058 14.9786C11.6653 15.0922 11.135 14.7462 11.0214 14.2058C10.8952 13.6054 10.938 13.0088 11.2247 12.4472C11.4975 11.9124 11.9434 11.505 12.4425 11.1698C12.5822 11.076 12.7197 10.9896 12.8418 10.9131L12.851 10.9073C12.9733 10.8306 13.0787 10.7646 13.1791 10.6975C13.3836 10.561 13.5248 10.4478 13.6322 10.3286C13.8055 10.1363 14 9.81253 14 9C14 8.48252 13.8357 8.15377 13.5915 7.94008C13.3298 7.71109 12.8443 7.5 12 7.5ZM12 15.7812C11.4477 15.7812 11 16.229 11 16.7812C11 17.3335 11.4477 17.7812 12 17.7812C12.5523 17.7812 13 17.3335 13 16.7812C13 16.229 12.5523 15.7812 12 15.7812Z" fill="black"/>
                </svg>
            </span>
        @overwrite
        
        @section('card_content')       
        
        @if($fases_proyectadas_contrato)
       
        <div class="row">
            <div class="card">
                <div class="card-body">
                    <!-- INICIO -->
                    <div class="Timeline">

                        <!-- Fase -->
                        <div class="event1">
                            <div class="event1Bubble">
                                <div class="eventTime">

                                    <div class="DayDigit">
                                        <svg width="70%" height="22" viewBox="0 -0.5 17 17" xmlns="http://www.w3.org/2000/svg" class="mt-2 si-glyph si-glyph-checked"><path d="M3.432 6.189a1 1 0 0 1 1.415 0L6.968 8.31l6.179-6.179a.99.99 0 0 1 1.401.013l2.122 2.122a.991.991 0 0 1 .014 1.4l-9.022 9.021a.99.99 0 0 1-1.401-.014l-4.95-4.95a.998.998 0 0 1 0-1.413l2.121-2.121Z" fill="#434343" class="si-glyph-fill" fill-rule="evenodd"/></svg>
                                    </div>

                                    <!-- Fecha -->
                                    <div class="Day">
                                        Fecha: <br> {{Carbon\Carbon::parse($contrato->detalle_contrato[0]->fecha_inicio)->format('d-m-Y')}}
                                        <!--
                                        <div class="MonthYear">
                                            Hora: None
                                        </div>
                                        -->
                                    </div>
                                    <!-- Fecha -->


                                </div>
                                <div class="eventTitle mt-1">
                                    Creado
                                </div>
                            </div>
                            <div class="eventAuthor">
                                
                            </div>

                            <!-- Punto -->
                            <svg height="20" width="20">
                                <circle cx="10" cy="11" r="5" fill="#ffbb00" />
                            </svg>
                            <!-- Punto -->

                            <div class="time">
                                <!--
                                9 : 27 AM
                                -->
                            </div>
                        </div>
                        <!-- Fase -->

                        <!-- Linea -->
                        <svg height="5" width="150">
                            <line x1="0" y1="0" x2="200" y2="0" style="stroke:#ffbb00;stroke-width:5" />
                            Sorry, your browser does not support inline SVG.
                        </svg>
                        <!-- Linea -->


                        <!-- Fase -->
                        <div class="event2">
                            <div class="event2Bubble">
                                <div class="eventTime">

                                    <div class="DayDigit">
                                        <svg width="70%" height="22" viewBox="0 -0.5 17 17" xmlns="http://www.w3.org/2000/svg" class="mt-2 si-glyph si-glyph-checked"><path d="M3.432 6.189a1 1 0 0 1 1.415 0L6.968 8.31l6.179-6.179a.99.99 0 0 1 1.401.013l2.122 2.122a.991.991 0 0 1 .014 1.4l-9.022 9.021a.99.99 0 0 1-1.401-.014l-4.95-4.95a.998.998 0 0 1 0-1.413l2.121-2.121Z" fill="#434343" class="si-glyph-fill" fill-rule="evenodd"/></svg>
                                    </div>

                                    <!-- Fecha -->
                                    <div class="Day">
                                        @if($fases_proyectadas_contrato->solicitud_de_base)
                                            Fecha:  <br>  {{Carbon\Carbon::parse($fases_proyectadas_contrato->solicitud_de_base)->format('d-m-Y')}}
                                                                                 
                                        @else
                                            Fecha: None
                                                                                    
                                        @endif
                                    </div>
                                    <!-- Fecha -->


                                </div>
                                <div class="eventTitle mt-1">
                                    Solicitud de base
                                </div>
                            </div>
                            <div class="eventAuthor">
                                
                            </div>

                            <!-- Punto -->
                            <svg height="20" width="20">
                                <circle cx="10" cy="11" r="5" fill="#ffbb00" />
                            </svg>
                            <!-- Punto -->

                            <div class="time">
                                <!--
                                9 : 27 AM
                                -->
                            </div>
                        </div>
                        <!-- Fase -->

                        <!-- Linea -->
                        <svg height="5" width="150">
                            <line x1="0" y1="0" x2="200" y2="0" style="stroke:#ffbb00;stroke-width:5" />
                            Sorry, your browser does not support inline SVG.
                        </svg>
                        <!-- Linea -->

                        <!-- Fase -->
                        <div class="event1">
                            <div class="event1Bubble">
                                <div class="eventTime">

                                    <div class="DayDigit">
                                        <svg width="70%" height="22" viewBox="0 -0.5 17 17" xmlns="http://www.w3.org/2000/svg" class="mt-2 si-glyph si-glyph-checked"><path d="M3.432 6.189a1 1 0 0 1 1.415 0L6.968 8.31l6.179-6.179a.99.99 0 0 1 1.401.013l2.122 2.122a.991.991 0 0 1 .014 1.4l-9.022 9.021a.99.99 0 0 1-1.401-.014l-4.95-4.95a.998.998 0 0 1 0-1.413l2.121-2.121Z" fill="#434343" class="si-glyph-fill" fill-rule="evenodd"/></svg>

                                    </div>

                                    <!-- Fecha -->
                                    <div class="Day">
                                        @if($fases_proyectadas_contrato->envio_bases_primera_revision)
                                            Fecha: <br> {{Carbon\Carbon::parse($fases_proyectadas_contrato->envio_bases_primera_revision)->format('d-m-Y')}}
                                                                                  
                                        @else
                                            Fecha: None
                                                                                  
                                        @endif
                                    </div>
                                    <!-- Fecha -->


                                </div>
                                <div class="eventTitle mt-1 ">
                                    Envio bases primera revision
                                </div>
                            </div>
                            <div class="eventAuthor">
                                
                            </div>

                            <!-- Punto -->
                            <svg height="20" width="20">
                                <circle cx="10" cy="11" r="5" fill="#ffbb00" />
                            </svg>
                            <!-- Punto -->

                            <div class="time">
                                <!--
                                9 : 27 AM
                                -->
                            </div>
                        </div>
                        <!-- Fase -->

                        <!-- Linea -->
                        <svg height="5" width="150">
                            <line x1="0" y1="0" x2="200" y2="0" style="stroke:#ffbb00;stroke-width:5" />
                            Sorry, your browser does not support inline SVG.
                        </svg>
                        <!-- Linea -->

                        <!-- Fase -->
                        <div class="event2">
                            <div class="event2Bubble">
                                <div class="eventTime">

                                    <div class="DayDigit">
                                        <svg width="70%" height="22" viewBox="0 -0.5 17 17" xmlns="http://www.w3.org/2000/svg" class="mt-2 si-glyph si-glyph-checked"><path d="M3.432 6.189a1 1 0 0 1 1.415 0L6.968 8.31l6.179-6.179a.99.99 0 0 1 1.401.013l2.122 2.122a.991.991 0 0 1 .014 1.4l-9.022 9.021a.99.99 0 0 1-1.401-.014l-4.95-4.95a.998.998 0 0 1 0-1.413l2.121-2.121Z" fill="#434343" class="si-glyph-fill" fill-rule="evenodd"/></svg>

                                    </div>

                                    <!-- Fecha -->
                                    <div class="Day">
                                        @if($fases_proyectadas_contrato->primera_revision_bases_por_abastecimiento)
                                            Fecha: <br> {{Carbon\Carbon::parse($fases_proyectadas_contrato->primera_revision_bases_por_abastecimiento)->format('d-m-Y')}}
                                                                                
                                        @else
                                            Fecha: None
                                                                                
                                        @endif
                                    </div>
                                    <!-- Fecha -->


                                </div>
                                <div class="eventTitle mt-1">
                                    Primera revision bases por abastecimiento
                                </div>
                            </div>
                            <div class="eventAuthor">
                                
                            </div>

                            <!-- Punto -->
                            <svg height="20" width="20">
                                <circle cx="10" cy="11" r="5" fill="#ffbb00" />
                            </svg>
                            <!-- Punto -->

                            <div class="time">
                                <!--
                                9 : 27 AM
                                -->
                            </div>
                        </div>
                        <!-- Fase -->

                        <!-- Linea -->
                        <svg height="5" width="150">
                            <line x1="0" y1="0" x2="200" y2="0" style="stroke:#ffbb00;stroke-width:5" />
                            Sorry, your browser does not support inline SVG.
                        </svg>
                        <!-- Linea -->

                        <!-- Fase -->
                        <div class="event1">
                            <div class="event1Bubble">
                                <div class="eventTime">

                                    <div class="DayDigit">
                                        <svg width="70%" height="22" viewBox="0 -0.5 17 17" xmlns="http://www.w3.org/2000/svg" class="mt-2 si-glyph si-glyph-checked"><path d="M3.432 6.189a1 1 0 0 1 1.415 0L6.968 8.31l6.179-6.179a.99.99 0 0 1 1.401.013l2.122 2.122a.991.991 0 0 1 .014 1.4l-9.022 9.021a.99.99 0 0 1-1.401-.014l-4.95-4.95a.998.998 0 0 1 0-1.413l2.121-2.121Z" fill="#434343" class="si-glyph-fill" fill-rule="evenodd"/></svg>

                                    </div>

                                    <!-- Fecha -->
                                    <div class="Day">
                                        @if($fases_proyectadas_contrato->envio_bases_segunda_revision)
                                            Fecha: <br> {{Carbon\Carbon::parse($fases_proyectadas_contrato->envio_bases_segunda_revision)->format('d-m-Y')}}
                                                                                   
                                        @else
                                            Fecha: None
                                                                                   
                                        @endif
                                    </div>
                                    <!-- Fecha -->


                                </div>
                                <div class="eventTitle mt-1">
                                    Envio bases segunda revision
                                </div>
                            </div>
                            <div class="eventAuthor">
                                
                            </div>

                            <!-- Punto -->
                            <svg height="20" width="20">
                                <circle cx="10" cy="11" r="5" fill="#ffbb00" />
                            </svg>
                            <!-- Punto -->

                            <div class="time">
                                <!--
                                9 : 27 AM
                                -->
                            </div>
                        </div>
                        <!-- Fase -->

                        <!-- Linea -->
                        <svg height="5" width="150">
                            <line x1="0" y1="0" x2="200" y2="0" style="stroke:#ffbb00;stroke-width:5" />
                            Sorry, your browser does not support inline SVG.
                        </svg>
                        <!-- Linea -->

                        <!-- Fase -->
                        <div class="event2">
                            <div class="event2Bubble">
                                <div class="eventTime">

                                    <div class="DayDigit">
                                        <svg width="70%" height="22" viewBox="0 -0.5 17 17" xmlns="http://www.w3.org/2000/svg" class="mt-2 si-glyph si-glyph-checked"><path d="M3.432 6.189a1 1 0 0 1 1.415 0L6.968 8.31l6.179-6.179a.99.99 0 0 1 1.401.013l2.122 2.122a.991.991 0 0 1 .014 1.4l-9.022 9.021a.99.99 0 0 1-1.401-.014l-4.95-4.95a.998.998 0 0 1 0-1.413l2.121-2.121Z" fill="#434343" class="si-glyph-fill" fill-rule="evenodd"/></svg>

                                    </div>

                                    <!-- Fecha -->
                                    <div class="Day">
                                        @if($fases_proyectadas_contrato->segunda_revision_bases_por_abastecimiento)
                                            Fecha: <br> {{Carbon\Carbon::parse($fases_proyectadas_contrato->segunda_revision_bases_por_abastecimiento)->format('d-m-Y')}}
                                                                                   
                                        @else
                                            Fecha: None
                                                                                    
                                        @endif
                                    </div>
                                    <!-- Fecha -->


                                </div>
                                <div class="eventTitle mt-1">
                                    Segunda revision bases por abastecimiento
                                </div>
                            </div>
                            <div class="eventAuthor">
                                
                            </div>

                            <!-- Punto -->
                            <svg height="20" width="20">
                                <circle cx="10" cy="11" r="5" fill="#ffbb00" />
                            </svg>
                            <!-- Punto -->

                            <div class="time">
                                <!--
                                9 : 27 AM
                                -->
                            </div>
                        </div>
                        <!-- Fase -->

                        <!-- Linea -->
                        <svg height="5" width="150">
                            <line x1="0" y1="0" x2="200" y2="0" style="stroke:#ffbb00;stroke-width:5" />
                            Sorry, your browser does not support inline SVG.
                        </svg>
                        <!-- Linea -->

                        <!-- Fase -->
                        <div class="event1">
                            <div class="event1Bubble">
                                <div class="eventTime">

                                    <div class="DayDigit">
                                        <svg width="70%" height="22" viewBox="0 -0.5 17 17" xmlns="http://www.w3.org/2000/svg" class="mt-2 si-glyph si-glyph-checked"><path d="M3.432 6.189a1 1 0 0 1 1.415 0L6.968 8.31l6.179-6.179a.99.99 0 0 1 1.401.013l2.122 2.122a.991.991 0 0 1 .014 1.4l-9.022 9.021a.99.99 0 0 1-1.401-.014l-4.95-4.95a.998.998 0 0 1 0-1.413l2.121-2.121Z" fill="#434343" class="si-glyph-fill" fill-rule="evenodd"/></svg>

                                    </div>

                                    <!-- Fecha -->
                                    <div class="Day">
                                        @if($fases_proyectadas_contrato->recopilacion_de_informacion)
                                            Fecha: <br> {{Carbon\Carbon::parse($fases_proyectadas_contrato->recopilacion_de_informacion)->format('d-m-Y')}}
                                                                                  
                                        @else
                                            Fecha: None
                                                                                    
                                        @endif
                                    </div>
                                    <!-- Fecha -->


                                </div>
                                <div class="eventTitle mt-1">
                                    Recopilacion de informacion
                                </div>
                            </div>
                            <div class="eventAuthor">
                                
                            </div>

                            <!-- Punto -->
                            <svg height="20" width="20">
                                <circle cx="10" cy="11" r="5" fill="#ffbb00" />
                            </svg>
                            <!-- Punto -->

                            <div class="time">
                                <!--
                                9 : 27 AM
                                -->
                            </div>
                        </div>
                        <!-- Fase -->

                        <!-- Linea -->
                        <svg height="5" width="150">
                            <line x1="0" y1="0" x2="200" y2="0" style="stroke:#ffbb00;stroke-width:5" />
                            Sorry, your browser does not support inline SVG.
                        </svg>
                        <!-- Linea -->

                        <!-- Fase -->
                        <div class="event2">
                            <div class="event2Bubble">
                                <div class="eventTime">

                                    <div class="DayDigit">
                                        <svg width="70%" height="22" viewBox="0 -0.5 17 17" xmlns="http://www.w3.org/2000/svg" class="mt-2 si-glyph si-glyph-checked"><path d="M3.432 6.189a1 1 0 0 1 1.415 0L6.968 8.31l6.179-6.179a.99.99 0 0 1 1.401.013l2.122 2.122a.991.991 0 0 1 .014 1.4l-9.022 9.021a.99.99 0 0 1-1.401-.014l-4.95-4.95a.998.998 0 0 1 0-1.413l2.121-2.121Z" fill="#434343" class="si-glyph-fill" fill-rule="evenodd"/></svg>

                                    </div>

                                    <!-- Fecha -->
                                    <div class="Day">
                                        @if($fases_proyectadas_contrato->invitacion_a_oferentes)
                                            Fecha: <br> {{Carbon\Carbon::parse($fases_proyectadas_contrato->invitacion_a_oferentes)->format('d-m-Y')}}
                                                                              
                                        @else
                                            Fecha: None
                                                                                     
                                        @endif
                                    </div>
                                    <!-- Fecha -->


                                </div>
                                <div class="eventTitle mt-1">
                                    Invitacion a oferentes
                                </div>
                            </div>
                            <div class="eventAuthor">
                                
                            </div>

                            <!-- Punto -->
                            <svg height="20" width="20">
                                <circle cx="10" cy="11" r="5" fill="#ffbb00" />
                            </svg>
                            <!-- Punto -->

                            <div class="time">
                                <!--
                                9 : 27 AM
                                -->
                            </div>
                        </div>
                        <!-- Fase -->

                        <!-- Linea -->
                        <svg height="5" width="150">
                            <line x1="0" y1="0" x2="200" y2="0" style="stroke:#ffbb00;stroke-width:5" />
                            Sorry, your browser does not support inline SVG.
                        </svg>
                        <!-- Linea -->

                        <!-- Fase -->
                        <div class="event1">
                            <div class="event1Bubble">
                                <div class="eventTime">

                                    <div class="DayDigit">
                                        <svg width="70%" height="22" viewBox="0 -0.5 17 17" xmlns="http://www.w3.org/2000/svg" class="mt-2 si-glyph si-glyph-checked"><path d="M3.432 6.189a1 1 0 0 1 1.415 0L6.968 8.31l6.179-6.179a.99.99 0 0 1 1.401.013l2.122 2.122a.991.991 0 0 1 .014 1.4l-9.022 9.021a.99.99 0 0 1-1.401-.014l-4.95-4.95a.998.998 0 0 1 0-1.413l2.121-2.121Z" fill="#434343" class="si-glyph-fill" fill-rule="evenodd"/></svg>

                                    </div>

                                    <!-- Fecha -->
                                    <div class="Day">
                                        @if($fases_proyectadas_contrato->visita_a_terreno)
                                            Fecha: <br> {{Carbon\Carbon::parse($fases_proyectadas_contrato->visita_a_terreno)->format('d-m-Y')}}
                                                                                 
                                        @else
                                            Fecha: None
                                                                                    
                                        @endif
                                    </div>
                                    <!-- Fecha -->


                                </div>
                                <div class="eventTitle mt-1">
                                    Visita a terreno
                                </div>
                            </div>
                            <div class="eventAuthor">
                                
                            </div>

                            <!-- Punto -->
                            <svg height="20" width="20">
                                <circle cx="10" cy="11" r="5" fill="#ffbb00" />
                            </svg>
                            <!-- Punto -->

                            <div class="time">
                                <!--
                                9 : 27 AM
                                -->
                            </div>
                        </div>
                        <!-- Fase -->

                        <!-- Linea -->
                        <svg height="5" width="150">
                            <line x1="0" y1="0" x2="200" y2="0" style="stroke:#ffbb00;stroke-width:5" />
                            Sorry, your browser does not support inline SVG.
                        </svg>
                        <!-- Linea -->

                        <!-- Fase -->
                        <div class="event2">
                            <div class="event2Bubble">
                                <div class="eventTime">

                                    <div class="DayDigit">
                                        <svg width="70%" height="22" viewBox="0 -0.5 17 17" xmlns="http://www.w3.org/2000/svg" class="mt-2 si-glyph si-glyph-checked"><path d="M3.432 6.189a1 1 0 0 1 1.415 0L6.968 8.31l6.179-6.179a.99.99 0 0 1 1.401.013l2.122 2.122a.991.991 0 0 1 .014 1.4l-9.022 9.021a.99.99 0 0 1-1.401-.014l-4.95-4.95a.998.998 0 0 1 0-1.413l2.121-2.121Z" fill="#434343" class="si-glyph-fill" fill-rule="evenodd"/></svg>

                                    </div>

                                    <!-- Fecha -->
                                    <div class="Day">
                                        @if($fases_proyectadas_contrato->preguntas_y_consultas_proponente)
                                            Fecha: <br> {{Carbon\Carbon::parse($fases_proyectadas_contrato->preguntas_y_consultas_proponente)->format('d-m-Y')}}
                                                                                   
                                        @else
                                            Fecha: None
                                                                                    
                                        @endif
                                    </div>
                                    <!-- Fecha -->


                                </div>
                                <div class="eventTitle mt-1">
                                    Preguntas y consultas proponente
                                </div>
                            </div>
                            <div class="eventAuthor">
                                
                            </div>

                            <!-- Punto -->
                            <svg height="20" width="20">
                                <circle cx="10" cy="11" r="5" fill="#ffbb00" />
                            </svg>
                            <!-- Punto -->

                            <div class="time">
                                <!--
                                9 : 27 AM
                                -->
                            </div>
                        </div>
                        <!-- Fase -->

                        <!-- Linea -->
                        <svg height="5" width="150">
                            <line x1="0" y1="0" x2="200" y2="0" style="stroke:#ffbb00;stroke-width:5" />
                            Sorry, your browser does not support inline SVG.
                        </svg>
                        <!-- Linea -->

                        <!-- Fase -->
                        <div class="event1">
                            <div class="event1Bubble">
                                <div class="eventTime">

                                    <div class="DayDigit">
                                        <svg width="70%" height="22" viewBox="0 -0.5 17 17" xmlns="http://www.w3.org/2000/svg" class="mt-2 si-glyph si-glyph-checked"><path d="M3.432 6.189a1 1 0 0 1 1.415 0L6.968 8.31l6.179-6.179a.99.99 0 0 1 1.401.013l2.122 2.122a.991.991 0 0 1 .014 1.4l-9.022 9.021a.99.99 0 0 1-1.401-.014l-4.95-4.95a.998.998 0 0 1 0-1.413l2.121-2.121Z" fill="#434343" class="si-glyph-fill" fill-rule="evenodd"/></svg>

                                    </div>

                                    <!-- Fecha -->
                                    <div class="Day">
                                        @if($fases_proyectadas_contrato->respuestas_del_mandante)
                                            Fecha: <br> {{Carbon\Carbon::parse($fases_proyectadas_contrato->respuestas_del_mandante)->format('d-m-Y')}}
                                                                               
                                        @else
                                            Fecha: None
                                                                                 
                                        @endif
                                    </div>
                                    <!-- Fecha -->


                                </div>
                                <div class="eventTitle mt-1">
                                    Respuestas del mandante
                                </div>
                            </div>
                            <div class="eventAuthor">
                                
                            </div>

                            <!-- Punto -->
                            <svg height="20" width="20">
                                <circle cx="10" cy="11" r="5" fill="#ffbb00" />
                            </svg>
                            <!-- Punto -->

                            <div class="time">
                                <!--
                                9 : 27 AM
                                -->
                            </div>
                        </div>
                        <!-- Fase -->

                        <!-- Linea -->
                        <svg height="5" width="150">
                            <line x1="0" y1="0" x2="200" y2="0" style="stroke:#ffbb00;stroke-width:5" />
                            Sorry, your browser does not support inline SVG.
                        </svg>
                        <!-- Linea -->

                        <!-- Fase -->
                        <div class="event2">
                            <div class="event2Bubble">
                                <div class="eventTime">

                                    <div class="DayDigit">
                                        <svg width="70%" height="22" viewBox="0 -0.5 17 17" xmlns="http://www.w3.org/2000/svg" class="mt-2 si-glyph si-glyph-checked"><path d="M3.432 6.189a1 1 0 0 1 1.415 0L6.968 8.31l6.179-6.179a.99.99 0 0 1 1.401.013l2.122 2.122a.991.991 0 0 1 .014 1.4l-9.022 9.021a.99.99 0 0 1-1.401-.014l-4.95-4.95a.998.998 0 0 1 0-1.413l2.121-2.121Z" fill="#434343" class="si-glyph-fill" fill-rule="evenodd"/></svg>

                                    </div>

                                    <!-- Fecha -->
                                    <div class="Day">
                                        @if($fases_proyectadas_contrato->recepcion_de_ofertas_tecnicas_economicas)
                                            Fecha: <br> {{Carbon\Carbon::parse($fases_proyectadas_contrato->recepcion_de_ofertas_tecnicas_economicas)->format('d-m-Y')}}
                                                                            
                                        @else
                                            Fecha: None
                                                                                  
                                        @endif
                                    </div>
                                    <!-- Fecha -->


                                </div>
                                <div class="eventTitle mt-1">
                                    Recepcion de ofertas tecnicas economicas
                                </div>
                            </div>
                            <div class="eventAuthor">
                                
                            </div>

                            <!-- Punto -->
                            <svg height="20" width="20">
                                <circle cx="10" cy="11" r="5" fill="#ffbb00" />
                            </svg>
                            <!-- Punto -->

                            <div class="time">
                                <!--
                                9 : 27 AM
                                -->
                            </div>
                        </div>
                        <!-- Fase -->

                        <!-- Linea -->
                        <svg height="5" width="150">
                            <line x1="0" y1="0" x2="200" y2="0" style="stroke:#ffbb00;stroke-width:5" />
                            Sorry, your browser does not support inline SVG.
                        </svg>
                        <!-- Linea -->

                        <!-- Fase -->
                        <div class="event1">
                            <div class="event1Bubble">
                                <div class="eventTime">

                                    <div class="DayDigit">
                                        <svg width="70%" height="22" viewBox="0 -0.5 17 17" xmlns="http://www.w3.org/2000/svg" class="mt-2 si-glyph si-glyph-checked"><path d="M3.432 6.189a1 1 0 0 1 1.415 0L6.968 8.31l6.179-6.179a.99.99 0 0 1 1.401.013l2.122 2.122a.991.991 0 0 1 .014 1.4l-9.022 9.021a.99.99 0 0 1-1.401-.014l-4.95-4.95a.998.998 0 0 1 0-1.413l2.121-2.121Z" fill="#434343" class="si-glyph-fill" fill-rule="evenodd"/></svg>

                                    </div>

                                    <!-- Fecha -->
                                    <div class="Day">
                                        @if($fases_proyectadas_contrato->evaluacion_ofertas_tecnicas)
                                            Fecha: <br> {{Carbon\Carbon::parse($fases_proyectadas_contrato->evaluacion_ofertas_tecnicas)->format('d-m-Y')}}
                                                                             
                                        @else
                                            Fecha: None
                                                                                 
                                        @endif
                                    </div>
                                    <!-- Fecha -->


                                </div>
                                <div class="eventTitle mt-1">
                                    Evaluacion ofertas tecnicas
                                </div>
                            </div>
                            <div class="eventAuthor">
                                
                            </div>

                            <!-- Punto -->
                            <svg height="20" width="20">
                                <circle cx="10" cy="11" r="5" fill="#ffbb00" />
                            </svg>
                            <!-- Punto -->

                            <div class="time">
                                <!--
                                9 : 27 AM
                                -->
                            </div>
                        </div>
                        <!-- Fase -->

                        <!-- Linea -->
                        <svg height="5" width="150">
                            <line x1="0" y1="0" x2="200" y2="0" style="stroke:#ffbb00;stroke-width:5" />
                            Sorry, your browser does not support inline SVG.
                        </svg>
                        <!-- Linea -->

                        <!-- Fase -->
                        <div class="event2">
                            <div class="event2Bubble">
                                <div class="eventTime">

                                    <div class="DayDigit">
                                        <svg width="70%" height="22" viewBox="0 -0.5 17 17" xmlns="http://www.w3.org/2000/svg" class="mt-2 si-glyph si-glyph-checked"><path d="M3.432 6.189a1 1 0 0 1 1.415 0L6.968 8.31l6.179-6.179a.99.99 0 0 1 1.401.013l2.122 2.122a.991.991 0 0 1 .014 1.4l-9.022 9.021a.99.99 0 0 1-1.401-.014l-4.95-4.95a.998.998 0 0 1 0-1.413l2.121-2.121Z" fill="#434343" class="si-glyph-fill" fill-rule="evenodd"/></svg>

                                    </div>

                                    <!-- Fecha -->
                                    <div class="Day">
                                        @if($fases_proyectadas_contrato->evaluacion_ofertas_economicas)
                                            Fecha: <br> {{Carbon\Carbon::parse($fases_proyectadas_contrato->evaluacion_ofertas_economicas)->format('d-m-Y')}}
                                                                             
                                        @else
                                            Fecha: None
                                                                              
                                        @endif
                                    </div>
                                    <!-- Fecha -->


                                </div>
                                <div class="eventTitle mt-1">
                                    Evaluacion ofertas economicas
                                </div>
                            </div>
                            <div class="eventAuthor">
                                
                            </div>

                            <!-- Punto -->
                            <svg height="20" width="20">
                                <circle cx="10" cy="11" r="5" fill="#ffbb00" />
                            </svg>
                            <!-- Punto -->

                            <div class="time">
                                <!--
                                9 : 27 AM
                                -->
                            </div>
                        </div>
                        <!-- Fase -->

                        <!-- Linea -->
                        <svg height="5" width="150">
                            <line x1="0" y1="0" x2="200" y2="0" style="stroke:#ffbb00;stroke-width:5" />
                            Sorry, your browser does not support inline SVG.
                        </svg>
                        <!-- Linea -->


                        <!-- Fase -->
                        <div class="event1">
                            <div class="event1Bubble">
                                <div class="eventTime">

                                    <div class="DayDigit">
                                        <svg width="70%" height="22" viewBox="0 -0.5 17 17" xmlns="http://www.w3.org/2000/svg" class="mt-2 si-glyph si-glyph-checked"><path d="M3.432 6.189a1 1 0 0 1 1.415 0L6.968 8.31l6.179-6.179a.99.99 0 0 1 1.401.013l2.122 2.122a.991.991 0 0 1 .014 1.4l-9.022 9.021a.99.99 0 0 1-1.401-.014l-4.95-4.95a.998.998 0 0 1 0-1.413l2.121-2.121Z" fill="#434343" class="si-glyph-fill" fill-rule="evenodd"/></svg>

                                    </div>

                                    <!-- Fecha -->
                                    <div class="Day">
                                        @if($fases_proyectadas_contrato->comite_de_inversiones)
                                            Fecha: <br> {{Carbon\Carbon::parse($fases_proyectadas_contrato->comite_de_inversiones)->format('d-m-Y')}}
                                                                       
                                        @else
                                            Fecha: None
                                                                                
                                        @endif
                                    </div>
                                    <!-- Fecha -->


                                </div>
                                <div class="eventTitle mt-1">
                                    Comite de inversiones
                                </div>
                            </div>
                            <div class="eventAuthor">
                                
                            </div>

                            <!-- Punto -->
                            <svg height="20" width="20">
                                <circle cx="10" cy="11" r="5" fill="#ffbb00" />
                            </svg>
                            <!-- Punto -->

                            <div class="time">
                                <!--
                                9 : 27 AM
                                -->
                            </div>
                        </div>
                        <!-- Fase -->

                        <!-- Linea -->
                        <svg height="5" width="150">
                            <line x1="0" y1="0" x2="200" y2="0" style="stroke:#ffbb00;stroke-width:5" />
                            Sorry, your browser does not support inline SVG.
                        </svg>
                        <!-- Linea -->


                        <!-- Fase -->
                        <div class="event2">
                            <div class="event2Bubble">
                                <div class="eventTime">

                                    <div class="DayDigit">
                                        <svg width="70%" height="22" viewBox="0 -0.5 17 17" xmlns="http://www.w3.org/2000/svg" class="mt-2 si-glyph si-glyph-checked"><path d="M3.432 6.189a1 1 0 0 1 1.415 0L6.968 8.31l6.179-6.179a.99.99 0 0 1 1.401.013l2.122 2.122a.991.991 0 0 1 .014 1.4l-9.022 9.021a.99.99 0 0 1-1.401-.014l-4.95-4.95a.998.998 0 0 1 0-1.413l2.121-2.121Z" fill="#434343" class="si-glyph-fill" fill-rule="evenodd"/></svg>

                                    </div>

                                    <!-- Fecha -->
                                    <div class="Day">
                                        @if($fases_proyectadas_contrato->adjudicacion)
                                            Fecha: <br> {{Carbon\Carbon::parse($fases_proyectadas_contrato->adjudicacion)->format('d-m-Y')}}
                                                              
                                        @else
                                            Fecha: None
                                                                            
                                        @endif
                                    </div>
                                    <!-- Fecha -->


                                </div>
                                <div class="eventTitle mt-1">
                                    Adjudicacion
                                </div>
                            </div>
                            <div class="eventAuthor">
                                
                            </div>

                            <!-- Punto -->
                            <svg height="20" width="20">
                                <circle cx="10" cy="11" r="5" fill="#ffbb00" />
                            </svg>
                            <!-- Punto -->

                            <div class="time">
                                <!--
                                9 : 27 AM
                                -->
                            </div>
                        </div>
                        <!-- Fase -->
                        
                      </div>

                    <!-- FINAL -->
                </div>
            </div>
        </div>

        @else
        <h1 style="position: center;">[ Fechas pendientes por ingresar... ]</h1>
        @endif


        @overwrite
        @include('layouts.card')
    @endpush


    @push('cards')
        @section('card_title')
            Fases ejecutadas de Licitación
            <span title="TOOL TIP DE AYUDA PARA ESTA TABLA.">
                <svg width="20px" height="20px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M2 7C2 4.23858 4.23858 2 7 2H17C19.7614 2 22 4.23858 22 7V17C22 19.7614 19.7614 22 17 22H7C4.23858 22 2 19.7614 2 17V7ZM7 4C5.34315 4 4 5.34315 4 7V17C4 18.6569 5.34315 20 7 20H17C18.6569 20 20 18.6569 20 17V7C20 5.34315 18.6569 4 17 4H7ZM12 7.5C10.5523 7.5 10 8.55229 10 9C10 9.55229 9.55228 10 9 10C8.44772 10 8 9.55229 8 9C8 7.44772 9.44771 5.5 12 5.5C13.1557 5.5 14.1702 5.78891 14.9085 6.43492C15.6643 7.09623 16 8.01748 16 9C16 10.1875 15.6945 11.0279 15.1178 11.6677C14.8502 11.9645 14.5539 12.1844 14.2896 12.3608C14.1648 12.4442 14.0375 12.524 13.9223 12.5962L13.9043 12.6075C13.7803 12.6853 13.6678 12.7561 13.5575 12.8302C13.2061 13.0662 13.0643 13.2421 13.0061 13.3563C12.9615 13.4436 12.9296 13.5614 12.9786 13.7942C13.0922 14.3347 12.7462 14.865 12.2058 14.9786C11.6653 15.0922 11.135 14.7462 11.0214 14.2058C10.8952 13.6054 10.938 13.0088 11.2247 12.4472C11.4975 11.9124 11.9434 11.505 12.4425 11.1698C12.5822 11.076 12.7197 10.9896 12.8418 10.9131L12.851 10.9073C12.9733 10.8306 13.0787 10.7646 13.1791 10.6975C13.3836 10.561 13.5248 10.4478 13.6322 10.3286C13.8055 10.1363 14 9.81253 14 9C14 8.48252 13.8357 8.15377 13.5915 7.94008C13.3298 7.71109 12.8443 7.5 12 7.5ZM12 15.7812C11.4477 15.7812 11 16.229 11 16.7812C11 17.3335 11.4477 17.7812 12 17.7812C12.5523 17.7812 13 17.3335 13 16.7812C13 16.229 12.5523 15.7812 12 15.7812Z" fill="black"/>
                </svg>
            </span>
        @overwrite
        
        @section('card_content')        
       
        <div class="row">
            <div class="card">
                <div class="card-body">
                    <!-- INICIO -->
                    <div class="Timeline">

                        <!-- Fase -->
                        <div class="event1">
                            <div class="event1Bubble">
                                <div class="eventTime">

                                    <div class="DayDigit">
                                        <svg width="70%" height="22" viewBox="0 -0.5 17 17" xmlns="http://www.w3.org/2000/svg" class="mt-2 si-glyph si-glyph-checked"><path d="M3.432 6.189a1 1 0 0 1 1.415 0L6.968 8.31l6.179-6.179a.99.99 0 0 1 1.401.013l2.122 2.122a.991.991 0 0 1 .014 1.4l-9.022 9.021a.99.99 0 0 1-1.401-.014l-4.95-4.95a.998.998 0 0 1 0-1.413l2.121-2.121Z" fill="#434343"  class="si-glyph-fill" fill-rule="evenodd"/></svg>

                                    </div>

                                    <!-- Fecha -->
                                    <div class="Day">
                                        Fecha: <br> {{Carbon\Carbon::parse($contrato->detalle_contrato[0]->fecha_inicio)->format('d-m-Y')}}
                                        
                                    </div>
                                    <!-- Fecha -->


                                </div>
                                <div class="eventTitle mt-1">
                                    Creado
                                </div>
                            </div>
                            <div class="eventAuthor">
                                
                            </div>

                            <!-- Punto -->
                            <svg height="20" width="20">
                                <circle cx="10" cy="11" r="5" fill="#ff0000" />
                            </svg>
                            <!-- Punto -->

                            <div class="time">
                                <!--
                                9 : 27 AM
                                -->
                            </div>
                        </div>
                        <!-- Fase -->

                        <!-- AHORA -->
                        @if($fase_actual == 0)
                            <svg height="5" width="150">
                                <line x1="0" y1="0" x2="200" y2="0" style="stroke:#ff0000;stroke-width:5" />
                                Sorry, your browser does not support inline SVG.
                            </svg>
                            <div class="now">
                                AHORA
                            </div>  
                        @endif
                        <!-- AHORA -->

                        <!-- Linea -->
                        <svg height="5" width="150">
                            <line x1="0" y1="0" x2="200" y2="0" style="stroke:#ff0000;stroke-width:5" />
                            Sorry, your browser does not support inline SVG.
                        </svg>
                        <!-- Linea -->


                        <!-- Fase -->
                        <div class="event2">
                            <div class="event2Bubble">
                                <div class="eventTime">

                                    <div class="DayDigit">
                                        @if($fases_contrato->solicitud_de_base)
                                            @if($contrato->fase_contrato_comprobante[0]->solicitud_de_base)
                                                <a target="_blank" href="{{ Storage::url('contratos/'.$contrato->id.'/'.$contrato->fase_contrato_comprobante[0]->solicitud_de_base) }}">
                                                    <svg width="70%" height="22" viewBox="0 -0.5 17 17" xmlns="http://www.w3.org/2000/svg" class="mt-2 si-glyph si-glyph-checked"><path d="M3.432 6.189a1 1 0 0 1 1.415 0L6.968 8.31l6.179-6.179a.99.99 0 0 1 1.401.013l2.122 2.122a.991.991 0 0 1 .014 1.4l-9.022 9.021a.99.99 0 0 1-1.401-.014l-4.95-4.95a.998.998 0 0 1 0-1.413l2.121-2.121Z" fill="#eb970a" fill="#434343"  class="si-glyph-fill" fill-rule="evenodd"/></svg>
                                                </a>
                                            @else
                                                <svg width="70%" height="22" viewBox="0 -0.5 17 17" xmlns="http://www.w3.org/2000/svg" class="mt-2 si-glyph si-glyph-checked"><path d="M3.432 6.189a1 1 0 0 1 1.415 0L6.968 8.31l6.179-6.179a.99.99 0 0 1 1.401.013l2.122 2.122a.991.991 0 0 1 .014 1.4l-9.022 9.021a.99.99 0 0 1-1.401-.014l-4.95-4.95a.998.998 0 0 1 0-1.413l2.121-2.121Z" fill="#434343" class="si-glyph-fill" fill-rule="evenodd"/></svg>
                                            @endif
                                        @else
                                        <svg width="100%" height="22" viewBox="0 -0.5 17 17" xmlns="http://www.w3.org/2000/svg" class=" mt-2 si-glyph si-glyph-time-reload"><g fill="#434343" fill-rule="evenodd"><path d="M9.549 1.046c-3.859 0-6.819 3.192-7.166 6.985H1.059l1.892 1.952 2.065-1.952H3.677c.331-3.229 2.747-5.958 5.937-5.958 3.412 0 6.189 2.888 6.189 6.437 0 3.549-2.777 6.438-6.189 6.438-1.695 0-3.232-.713-4.35-1.865l-.821.826a7.364 7.364 0 0 0 5.106 2.065c4.092 0 7.419-3.349 7.419-7.464s-3.327-7.464-7.419-7.464Z" class="si-glyph-fill"/><path d="M9 3.99V9h3.96V8H9.97V3.99H9Z" class="si-glyph-fill"/></g></svg>
                                        @endif
                                    </div>

                                    <!-- Fecha -->
                                    <div class="Day">
                                        @if($fases_contrato->solicitud_de_base)
                                            Fecha:  <br>  {{Carbon\Carbon::parse($fases_contrato->solicitud_de_base)->format('d-m-Y')}}
                                                                              
                                        @else
                                            Fecha: None
                                                                               
                                        @endif
                                    </div>
                                    <!-- Fecha -->


                                </div>
                                <div class="eventTitle mt-1">
                                    Solicitud de base
                                </div>
                            </div>
                            <div class="eventAuthor">
                                
                            </div>

                            <!-- Punto -->
                            <svg height="20" width="20">
                                <circle cx="10" cy="11" r="5" fill="#ff0000" />
                            </svg>
                            <!-- Punto -->

                            <div class="time">
                                <!--
                                9 : 27 AM
                                -->
                            </div>
                        </div>
                        <!-- Fase -->

                        <!-- AHORA -->
                        @if($fase_actual == 1)
                            <svg height="5" width="150">
                                <line x1="0" y1="0" x2="200" y2="0" style="stroke:#ff0000;stroke-width:5" />
                                Sorry, your browser does not support inline SVG.
                            </svg>
                            <div class="now">
                                AHORA
                            </div>  
                        @endif
                        <!-- AHORA -->

                        <!-- Linea -->
                        <svg height="5" width="150">
                            <line x1="0" y1="0" x2="200" y2="0" style="stroke:#ff0000;stroke-width:5" />
                            Sorry, your browser does not support inline SVG.
                        </svg>
                        <!-- Linea -->

                        <!-- Fase -->
                        <div class="event1">
                            <div class="event1Bubble">
                                <div class="eventTime">

                                    <div class="DayDigit">
                                        @if($fases_contrato->envio_bases_primera_revision)
                                            @if($contrato->fase_contrato_comprobante[0]->envio_bases_primera_revision)
                                                <a target="_blank" href="{{ Storage::url('contratos/'.$contrato->id."/".$contrato->fase_contrato_comprobante[0]->envio_bases_primera_revision) }}">
                                                    <svg width="70%" height="22" viewBox="0 -0.5 17 17" xmlns="http://www.w3.org/2000/svg" class="mt-2 si-glyph si-glyph-checked"><path d="M3.432 6.189a1 1 0 0 1 1.415 0L6.968 8.31l6.179-6.179a.99.99 0 0 1 1.401.013l2.122 2.122a.991.991 0 0 1 .014 1.4l-9.022 9.021a.99.99 0 0 1-1.401-.014l-4.95-4.95a.998.998 0 0 1 0-1.413l2.121-2.121Z" fill="#eb970a" fill="#434343"  class="si-glyph-fill" fill-rule="evenodd"/></svg>
                                                </a>
                                            @else
                                                <svg width="70%" height="22" viewBox="0 -0.5 17 17" xmlns="http://www.w3.org/2000/svg" class="mt-2 si-glyph si-glyph-checked"><path d="M3.432 6.189a1 1 0 0 1 1.415 0L6.968 8.31l6.179-6.179a.99.99 0 0 1 1.401.013l2.122 2.122a.991.991 0 0 1 .014 1.4l-9.022 9.021a.99.99 0 0 1-1.401-.014l-4.95-4.95a.998.998 0 0 1 0-1.413l2.121-2.121Z" fill="#434343" class="si-glyph-fill" fill-rule="evenodd"/></svg>
                                            @endif                                            
                                        @else
                                            <svg width="100%" height="22" viewBox="0 -0.5 17 17" xmlns="http://www.w3.org/2000/svg" class=" mt-2 si-glyph si-glyph-time-reload"><g fill="#434343" fill-rule="evenodd"><path d="M9.549 1.046c-3.859 0-6.819 3.192-7.166 6.985H1.059l1.892 1.952 2.065-1.952H3.677c.331-3.229 2.747-5.958 5.937-5.958 3.412 0 6.189 2.888 6.189 6.437 0 3.549-2.777 6.438-6.189 6.438-1.695 0-3.232-.713-4.35-1.865l-.821.826a7.364 7.364 0 0 0 5.106 2.065c4.092 0 7.419-3.349 7.419-7.464s-3.327-7.464-7.419-7.464Z" class="si-glyph-fill"/><path d="M9 3.99V9h3.96V8H9.97V3.99H9Z" class="si-glyph-fill"/></g></svg>
                                        @endif
                                    </div>

                                    <!-- Fecha -->
                                    <div class="Day">
                                        @if($fases_contrato->envio_bases_primera_revision)
                                            Fecha: <br> {{Carbon\Carbon::parse($fases_contrato->envio_bases_primera_revision)->format('d-m-Y')}}
                                                                                
                                        @else
                                            Fecha: None
                                                                              
                                        @endif
                                    </div>
                                    <!-- Fecha -->


                                </div>
                                <div class="eventTitle mt-1 ">
                                    Envio bases primera revision
                                </div>
                            </div>
                            <div class="eventAuthor">
                                
                            </div>

                            <!-- Punto -->
                            <svg height="20" width="20">
                                <circle cx="10" cy="11" r="5" fill="#ff0000" />
                            </svg>
                            <!-- Punto -->

                            <div class="time">
                                <!--
                                9 : 27 AM
                                -->
                            </div>
                        </div>
                        <!-- Fase -->

                        <!-- AHORA -->
                        @if($fase_actual == 2)
                            <svg height="5" width="150">
                                <line x1="0" y1="0" x2="200" y2="0" style="stroke:#ff0000;stroke-width:5" />
                                Sorry, your browser does not support inline SVG.
                            </svg>
                            <div class="now">
                                AHORA
                            </div>  
                        @endif
                        <!-- AHORA -->

                        <!-- Linea -->
                        <svg height="5" width="150">
                            <line x1="0" y1="0" x2="200" y2="0" style="stroke:#ff0000;stroke-width:5" />
                            Sorry, your browser does not support inline SVG.
                        </svg>
                        <!-- Linea -->

                        <!-- Fase -->
                        <div class="event2">
                            <div class="event2Bubble">
                                <div class="eventTime">

                                    <div class="DayDigit">
                                        @if($fases_contrato->primera_revision_bases_por_abastecimiento)
                                            @if($contrato->fase_contrato_comprobante[0]->primera_revision_bases_por_abastecimiento)
                                                <a target="_blank" href="{{ Storage::url('contratos/'.$contrato->id."/".$contrato->fase_contrato_comprobante[0]->primera_revision_bases_por_abastecimiento) }}">
                                                    <svg width="70%" height="22" viewBox="0 -0.5 17 17" xmlns="http://www.w3.org/2000/svg" class="mt-2 si-glyph si-glyph-checked"><path d="M3.432 6.189a1 1 0 0 1 1.415 0L6.968 8.31l6.179-6.179a.99.99 0 0 1 1.401.013l2.122 2.122a.991.991 0 0 1 .014 1.4l-9.022 9.021a.99.99 0 0 1-1.401-.014l-4.95-4.95a.998.998 0 0 1 0-1.413l2.121-2.121Z" fill="#eb970a" fill="#434343"  class="si-glyph-fill" fill-rule="evenodd"/></svg>
                                                </a>
                                            @else
                                                <svg width="70%" height="22" viewBox="0 -0.5 17 17" xmlns="http://www.w3.org/2000/svg" class="mt-2 si-glyph si-glyph-checked"><path d="M3.432 6.189a1 1 0 0 1 1.415 0L6.968 8.31l6.179-6.179a.99.99 0 0 1 1.401.013l2.122 2.122a.991.991 0 0 1 .014 1.4l-9.022 9.021a.99.99 0 0 1-1.401-.014l-4.95-4.95a.998.998 0 0 1 0-1.413l2.121-2.121Z" fill="#434343" class="si-glyph-fill" fill-rule="evenodd"/></svg>
                                            @endif                                            
                                        @else
                                            <svg width="100%" height="22" viewBox="0 -0.5 17 17" xmlns="http://www.w3.org/2000/svg" class=" mt-2 si-glyph si-glyph-time-reload"><g fill="#434343" fill-rule="evenodd"><path d="M9.549 1.046c-3.859 0-6.819 3.192-7.166 6.985H1.059l1.892 1.952 2.065-1.952H3.677c.331-3.229 2.747-5.958 5.937-5.958 3.412 0 6.189 2.888 6.189 6.437 0 3.549-2.777 6.438-6.189 6.438-1.695 0-3.232-.713-4.35-1.865l-.821.826a7.364 7.364 0 0 0 5.106 2.065c4.092 0 7.419-3.349 7.419-7.464s-3.327-7.464-7.419-7.464Z" class="si-glyph-fill"/><path d="M9 3.99V9h3.96V8H9.97V3.99H9Z" class="si-glyph-fill"/></g></svg>
                                        @endif
                                    </div>

                                    <!-- Fecha -->
                                    <div class="Day">
                                        @if($fases_contrato->primera_revision_bases_por_abastecimiento)
                                            Fecha: <br> {{Carbon\Carbon::parse($fases_contrato->primera_revision_bases_por_abastecimiento)->format('d-m-Y')}}
                                                                                
                                        @else
                                            Fecha: None
                                                                            
                                        @endif
                                    </div>
                                    <!-- Fecha -->


                                </div>
                                <div class="eventTitle mt-1">
                                    Primera revision bases por abastecimiento
                                </div>
                            </div>
                            <div class="eventAuthor">
                                
                            </div>

                            <!-- Punto -->
                            <svg height="20" width="20">
                                <circle cx="10" cy="11" r="5" fill="#ff0000" />
                            </svg>
                            <!-- Punto -->

                            <div class="time">
                                <!--
                                9 : 27 AM
                                -->
                            </div>
                        </div>
                        <!-- Fase -->

                        <!-- AHORA -->
                        @if($fase_actual == 3)
                            <svg height="5" width="150">
                                <line x1="0" y1="0" x2="200" y2="0" style="stroke:#ff0000;stroke-width:5" />
                                Sorry, your browser does not support inline SVG.
                            </svg>
                            <div class="now">
                                AHORA
                            </div>  
                        @endif
                        <!-- AHORA -->

                        <!-- Linea -->
                        <svg height="5" width="150">
                            <line x1="0" y1="0" x2="200" y2="0" style="stroke:#ff0000;stroke-width:5" />
                            Sorry, your browser does not support inline SVG.
                        </svg>
                        <!-- Linea -->

                        <!-- Fase -->
                        <div class="event1">
                            <div class="event1Bubble">
                                <div class="eventTime">

                                    <div class="DayDigit">
                                        @if($fases_contrato->envio_bases_segunda_revision)
                                            @if($contrato->fase_contrato_comprobante[0]->envio_bases_segunda_revision)
                                                <a target="_blank" href="{{ Storage::url('contratos/'.$contrato->id."/".$contrato->fase_contrato_comprobante[0]->envio_bases_segunda_revision) }}">
                                                    <svg width="70%" height="22" viewBox="0 -0.5 17 17" xmlns="http://www.w3.org/2000/svg" class="mt-2 si-glyph si-glyph-checked"><path d="M3.432 6.189a1 1 0 0 1 1.415 0L6.968 8.31l6.179-6.179a.99.99 0 0 1 1.401.013l2.122 2.122a.991.991 0 0 1 .014 1.4l-9.022 9.021a.99.99 0 0 1-1.401-.014l-4.95-4.95a.998.998 0 0 1 0-1.413l2.121-2.121Z" fill="#eb970a" fill="#434343"  class="si-glyph-fill" fill-rule="evenodd"/></svg>
                                                </a>
                                            @else
                                                <svg width="70%" height="22" viewBox="0 -0.5 17 17" xmlns="http://www.w3.org/2000/svg" class="mt-2 si-glyph si-glyph-checked"><path d="M3.432 6.189a1 1 0 0 1 1.415 0L6.968 8.31l6.179-6.179a.99.99 0 0 1 1.401.013l2.122 2.122a.991.991 0 0 1 .014 1.4l-9.022 9.021a.99.99 0 0 1-1.401-.014l-4.95-4.95a.998.998 0 0 1 0-1.413l2.121-2.121Z" fill="#434343" class="si-glyph-fill" fill-rule="evenodd"/></svg>
                                            @endif                                            
                                        @else
                                            <svg width="100%" height="22" viewBox="0 -0.5 17 17" xmlns="http://www.w3.org/2000/svg" class=" mt-2 si-glyph si-glyph-time-reload"><g fill="#434343" fill-rule="evenodd"><path d="M9.549 1.046c-3.859 0-6.819 3.192-7.166 6.985H1.059l1.892 1.952 2.065-1.952H3.677c.331-3.229 2.747-5.958 5.937-5.958 3.412 0 6.189 2.888 6.189 6.437 0 3.549-2.777 6.438-6.189 6.438-1.695 0-3.232-.713-4.35-1.865l-.821.826a7.364 7.364 0 0 0 5.106 2.065c4.092 0 7.419-3.349 7.419-7.464s-3.327-7.464-7.419-7.464Z" class="si-glyph-fill"/><path d="M9 3.99V9h3.96V8H9.97V3.99H9Z" class="si-glyph-fill"/></g></svg>
                                        @endif
                                    </div>

                                    <!-- Fecha -->
                                    <div class="Day">
                                        @if($fases_contrato->envio_bases_segunda_revision)
                                            Fecha: <br> {{Carbon\Carbon::parse($fases_contrato->envio_bases_segunda_revision)->format('d-m-Y')}}
                                                                                
                                        @else
                                            Fecha: None
                                                                                 
                                        @endif
                                    </div>
                                    <!-- Fecha -->


                                </div>
                                <div class="eventTitle mt-1">
                                    Envio bases segunda revision
                                </div>
                            </div>
                            <div class="eventAuthor">
                                
                            </div>

                            <!-- Punto -->
                            <svg height="20" width="20">
                                <circle cx="10" cy="11" r="5" fill="#ff0000" />
                            </svg>
                            <!-- Punto -->

                            <div class="time">
                                <!--
                                9 : 27 AM
                                -->
                            </div>
                        </div>
                        <!-- Fase -->

                        <!-- AHORA -->
                        @if($fase_actual == 4)
                            <svg height="5" width="150">
                                <line x1="0" y1="0" x2="200" y2="0" style="stroke:#ff0000;stroke-width:5" />
                                Sorry, your browser does not support inline SVG.
                            </svg>
                            <div class="now">
                                AHORA
                            </div>  
                        @endif
                        <!-- AHORA -->

                        <!-- Linea -->
                        <svg height="5" width="150">
                            <line x1="0" y1="0" x2="200" y2="0" style="stroke:#ff0000;stroke-width:5" />
                            Sorry, your browser does not support inline SVG.
                        </svg>
                        <!-- Linea -->

                        <!-- Fase -->
                        <div class="event2">
                            <div class="event2Bubble">
                                <div class="eventTime">

                                    <div class="DayDigit">
                                        @if($fases_contrato->segunda_revision_bases_por_abastecimiento)
                                            @if($contrato->fase_contrato_comprobante[0]->segunda_revision_bases_por_abastecimiento)
                                                <a target="_blank" href="{{ Storage::url('contratos/'.$contrato->id."/".$contrato->fase_contrato_comprobante[0]->segunda_revision_bases_por_abastecimiento) }}">
                                                    <svg width="70%" height="22" viewBox="0 -0.5 17 17" xmlns="http://www.w3.org/2000/svg" class="mt-2 si-glyph si-glyph-checked"><path d="M3.432 6.189a1 1 0 0 1 1.415 0L6.968 8.31l6.179-6.179a.99.99 0 0 1 1.401.013l2.122 2.122a.991.991 0 0 1 .014 1.4l-9.022 9.021a.99.99 0 0 1-1.401-.014l-4.95-4.95a.998.998 0 0 1 0-1.413l2.121-2.121Z" fill="#eb970a" fill="#434343"  class="si-glyph-fill" fill-rule="evenodd"/></svg>
                                                </a>
                                            @else
                                                <svg width="70%" height="22" viewBox="0 -0.5 17 17" xmlns="http://www.w3.org/2000/svg" class="mt-2 si-glyph si-glyph-checked"><path d="M3.432 6.189a1 1 0 0 1 1.415 0L6.968 8.31l6.179-6.179a.99.99 0 0 1 1.401.013l2.122 2.122a.991.991 0 0 1 .014 1.4l-9.022 9.021a.99.99 0 0 1-1.401-.014l-4.95-4.95a.998.998 0 0 1 0-1.413l2.121-2.121Z" fill="#434343" class="si-glyph-fill" fill-rule="evenodd"/></svg>
                                            @endif                                        
                                        @else
                                            <svg width="100%" height="22" viewBox="0 -0.5 17 17" xmlns="http://www.w3.org/2000/svg" class=" mt-2 si-glyph si-glyph-time-reload"><g fill="#434343" fill-rule="evenodd"><path d="M9.549 1.046c-3.859 0-6.819 3.192-7.166 6.985H1.059l1.892 1.952 2.065-1.952H3.677c.331-3.229 2.747-5.958 5.937-5.958 3.412 0 6.189 2.888 6.189 6.437 0 3.549-2.777 6.438-6.189 6.438-1.695 0-3.232-.713-4.35-1.865l-.821.826a7.364 7.364 0 0 0 5.106 2.065c4.092 0 7.419-3.349 7.419-7.464s-3.327-7.464-7.419-7.464Z" class="si-glyph-fill"/><path d="M9 3.99V9h3.96V8H9.97V3.99H9Z" class="si-glyph-fill"/></g></svg>
                                        @endif
                                    </div>

                                    <!-- Fecha -->
                                    <div class="Day">
                                        @if($fases_contrato->segunda_revision_bases_por_abastecimiento)
                                            Fecha: <br> {{Carbon\Carbon::parse($fases_contrato->segunda_revision_bases_por_abastecimiento)->format('d-m-Y')}}
                                                                              
                                        @else
                                            Fecha: None
                                                                                  
                                        @endif
                                    </div>
                                    <!-- Fecha -->


                                </div>
                                <div class="eventTitle mt-1">
                                    Segunda revision bases por abastecimiento
                                </div>
                            </div>
                            <div class="eventAuthor">
                                
                            </div>

                            <!-- Punto -->
                            <svg height="20" width="20">
                                <circle cx="10" cy="11" r="5" fill="#ff0000" />
                            </svg>
                            <!-- Punto -->

                            <div class="time">
                                <!--
                                9 : 27 AM
                                -->
                            </div>
                        </div>
                        <!-- Fase -->

                        <!-- AHORA -->
                        @if($fase_actual == 5)
                            <svg height="5" width="150">
                                <line x1="0" y1="0" x2="200" y2="0" style="stroke:#ff0000;stroke-width:5" />
                                Sorry, your browser does not support inline SVG.
                            </svg>
                            <div class="now">
                                AHORA
                            </div>  
                        @endif
                        <!-- AHORA -->

                        <!-- Linea -->
                        <svg height="5" width="150">
                            <line x1="0" y1="0" x2="200" y2="0" style="stroke:#ff0000;stroke-width:5" />
                            Sorry, your browser does not support inline SVG.
                        </svg>
                        <!-- Linea -->

                        <!-- Fase -->
                        <div class="event1">
                            <div class="event1Bubble">
                                <div class="eventTime">

                                    <div class="DayDigit">
                                        @if($fases_contrato->recopilacion_de_informacion)
                                            @if($contrato->fase_contrato_comprobante[0]->recopilacion_de_informacion)
                                                <a target="_blank" href="{{ Storage::url('contratos/'.$contrato->id."/".$contrato->fase_contrato_comprobante[0]->recopilacion_de_informacion) }}">
                                                    <svg width="70%" height="22" viewBox="0 -0.5 17 17" xmlns="http://www.w3.org/2000/svg" class="mt-2 si-glyph si-glyph-checked"><path d="M3.432 6.189a1 1 0 0 1 1.415 0L6.968 8.31l6.179-6.179a.99.99 0 0 1 1.401.013l2.122 2.122a.991.991 0 0 1 .014 1.4l-9.022 9.021a.99.99 0 0 1-1.401-.014l-4.95-4.95a.998.998 0 0 1 0-1.413l2.121-2.121Z" fill="#eb970a" fill="#434343"  class="si-glyph-fill" fill-rule="evenodd"/></svg>
                                                </a>
                                            @else
                                                <svg width="70%" height="22" viewBox="0 -0.5 17 17" xmlns="http://www.w3.org/2000/svg" class="mt-2 si-glyph si-glyph-checked"><path d="M3.432 6.189a1 1 0 0 1 1.415 0L6.968 8.31l6.179-6.179a.99.99 0 0 1 1.401.013l2.122 2.122a.991.991 0 0 1 .014 1.4l-9.022 9.021a.99.99 0 0 1-1.401-.014l-4.95-4.95a.998.998 0 0 1 0-1.413l2.121-2.121Z" fill="#434343" class="si-glyph-fill" fill-rule="evenodd"/></svg>
                                            @endif                                            
                                        @else
                                            <svg width="100%" height="22" viewBox="0 -0.5 17 17" xmlns="http://www.w3.org/2000/svg" class=" mt-2 si-glyph si-glyph-time-reload"><g fill="#434343" fill-rule="evenodd"><path d="M9.549 1.046c-3.859 0-6.819 3.192-7.166 6.985H1.059l1.892 1.952 2.065-1.952H3.677c.331-3.229 2.747-5.958 5.937-5.958 3.412 0 6.189 2.888 6.189 6.437 0 3.549-2.777 6.438-6.189 6.438-1.695 0-3.232-.713-4.35-1.865l-.821.826a7.364 7.364 0 0 0 5.106 2.065c4.092 0 7.419-3.349 7.419-7.464s-3.327-7.464-7.419-7.464Z" class="si-glyph-fill"/><path d="M9 3.99V9h3.96V8H9.97V3.99H9Z" class="si-glyph-fill"/></g></svg>
                                        @endif
                                    </div>

                                    <!-- Fecha -->
                                    <div class="Day">
                                        @if($fases_contrato->recopilacion_de_informacion)
                                            Fecha: <br> {{Carbon\Carbon::parse($fases_contrato->recopilacion_de_informacion)->format('d-m-Y')}}
                                                                              
                                        @else
                                            Fecha: None
                                                                                
                                        @endif
                                    </div>
                                    <!-- Fecha -->


                                </div>
                                <div class="eventTitle mt-1">
                                    Recopilacion de informacion
                                </div>
                            </div>
                            <div class="eventAuthor">
                                
                            </div>

                            <!-- Punto -->
                            <svg height="20" width="20">
                                <circle cx="10" cy="11" r="5" fill="#ff0000" />
                            </svg>
                            <!-- Punto -->

                            <div class="time">
                                <!--
                                9 : 27 AM
                                -->
                            </div>
                        </div>
                        <!-- Fase -->

                        <!-- AHORA -->
                        @if($fase_actual == 6)
                            <svg height="5" width="150">
                                <line x1="0" y1="0" x2="200" y2="0" style="stroke:#ff0000;stroke-width:5" />
                                Sorry, your browser does not support inline SVG.
                            </svg>
                            <div class="now">
                                AHORA
                            </div>  
                        @endif
                        <!-- AHORA -->

                        <!-- Linea -->
                        <svg height="5" width="150">
                            <line x1="0" y1="0" x2="200" y2="0" style="stroke:#ff0000;stroke-width:5" />
                            Sorry, your browser does not support inline SVG.
                        </svg>
                        <!-- Linea -->

                        <!-- Fase -->
                        <div class="event2">
                            <div class="event2Bubble">
                                <div class="eventTime">

                                    <div class="DayDigit">
                                        @if($fases_contrato->invitacion_a_oferentes)
                                            @if($contrato->fase_contrato_comprobante[0]->invitacion_a_oferentes)
                                                <a target="_blank" href="{{ Storage::url('contratos/'.$contrato->id."/".$contrato->fase_contrato_comprobante[0]->invitacion_a_oferentes) }}">
                                                    <svg width="70%" height="22" viewBox="0 -0.5 17 17" xmlns="http://www.w3.org/2000/svg" class="mt-2 si-glyph si-glyph-checked"><path d="M3.432 6.189a1 1 0 0 1 1.415 0L6.968 8.31l6.179-6.179a.99.99 0 0 1 1.401.013l2.122 2.122a.991.991 0 0 1 .014 1.4l-9.022 9.021a.99.99 0 0 1-1.401-.014l-4.95-4.95a.998.998 0 0 1 0-1.413l2.121-2.121Z" fill="#eb970a" fill="#434343"  class="si-glyph-fill" fill-rule="evenodd"/></svg>
                                                </a>
                                            @else
                                                <svg width="70%" height="22" viewBox="0 -0.5 17 17" xmlns="http://www.w3.org/2000/svg" class="mt-2 si-glyph si-glyph-checked"><path d="M3.432 6.189a1 1 0 0 1 1.415 0L6.968 8.31l6.179-6.179a.99.99 0 0 1 1.401.013l2.122 2.122a.991.991 0 0 1 .014 1.4l-9.022 9.021a.99.99 0 0 1-1.401-.014l-4.95-4.95a.998.998 0 0 1 0-1.413l2.121-2.121Z" fill="#434343" class="si-glyph-fill" fill-rule="evenodd"/></svg>
                                            @endif                                            
                                        @else
                                            <svg width="100%" height="22" viewBox="0 -0.5 17 17" xmlns="http://www.w3.org/2000/svg" class=" mt-2 si-glyph si-glyph-time-reload"><g fill="#434343" fill-rule="evenodd"><path d="M9.549 1.046c-3.859 0-6.819 3.192-7.166 6.985H1.059l1.892 1.952 2.065-1.952H3.677c.331-3.229 2.747-5.958 5.937-5.958 3.412 0 6.189 2.888 6.189 6.437 0 3.549-2.777 6.438-6.189 6.438-1.695 0-3.232-.713-4.35-1.865l-.821.826a7.364 7.364 0 0 0 5.106 2.065c4.092 0 7.419-3.349 7.419-7.464s-3.327-7.464-7.419-7.464Z" class="si-glyph-fill"/><path d="M9 3.99V9h3.96V8H9.97V3.99H9Z" class="si-glyph-fill"/></g></svg>
                                        @endif
                                    </div>

                                    <!-- Fecha -->
                                    <div class="Day">
                                        @if($fases_contrato->invitacion_a_oferentes)
                                            Fecha: <br> {{Carbon\Carbon::parse($fases_contrato->invitacion_a_oferentes)->format('d-m-Y')}}
                                                                             
                                        @else
                                            Fecha: None
                                                                              
                                        @endif
                                    </div>
                                    <!-- Fecha -->


                                </div>
                                <div class="eventTitle mt-1">
                                    Invitacion a oferentes
                                </div>
                            </div>
                            <div class="eventAuthor">
                                
                            </div>

                            <!-- Punto -->
                            <svg height="20" width="20">
                                <circle cx="10" cy="11" r="5" fill="#ff0000" />
                            </svg>
                            <!-- Punto -->

                            <div class="time">
                                <!--
                                9 : 27 AM
                                -->
                            </div>
                        </div>
                        <!-- Fase -->

                        <!-- AHORA -->
                        @if($fase_actual == 7)
                            <svg height="5" width="150">
                                <line x1="0" y1="0" x2="200" y2="0" style="stroke:#ff0000;stroke-width:5" />
                                Sorry, your browser does not support inline SVG.
                            </svg>
                            <div class="now">
                                AHORA
                            </div>  
                        @endif
                        <!-- AHORA -->

                        <!-- Linea -->
                        <svg height="5" width="150">
                            <line x1="0" y1="0" x2="200" y2="0" style="stroke:#ff0000;stroke-width:5" />
                            Sorry, your browser does not support inline SVG.
                        </svg>
                        <!-- Linea -->

                        <!-- Fase -->
                        <div class="event1">
                            <div class="event1Bubble">
                                <div class="eventTime">

                                    <div class="DayDigit">
                                        @if($fases_contrato->visita_a_terreno)
                                            @if($contrato->fase_contrato_comprobante[0]->visita_a_terreno)
                                                <a target="_blank" href="{{ Storage::url('contratos/'.$contrato->id."/".$contrato->fase_contrato_comprobante[0]->visita_a_terreno) }}">
                                                    <svg width="70%" height="22" viewBox="0 -0.5 17 17" xmlns="http://www.w3.org/2000/svg" class="mt-2 si-glyph si-glyph-checked"><path d="M3.432 6.189a1 1 0 0 1 1.415 0L6.968 8.31l6.179-6.179a.99.99 0 0 1 1.401.013l2.122 2.122a.991.991 0 0 1 .014 1.4l-9.022 9.021a.99.99 0 0 1-1.401-.014l-4.95-4.95a.998.998 0 0 1 0-1.413l2.121-2.121Z" fill="#eb970a" fill="#434343"  class="si-glyph-fill" fill-rule="evenodd"/></svg>
                                                </a>
                                            @else
                                                <svg width="70%" height="22" viewBox="0 -0.5 17 17" xmlns="http://www.w3.org/2000/svg" class="mt-2 si-glyph si-glyph-checked"><path d="M3.432 6.189a1 1 0 0 1 1.415 0L6.968 8.31l6.179-6.179a.99.99 0 0 1 1.401.013l2.122 2.122a.991.991 0 0 1 .014 1.4l-9.022 9.021a.99.99 0 0 1-1.401-.014l-4.95-4.95a.998.998 0 0 1 0-1.413l2.121-2.121Z" fill="#434343" class="si-glyph-fill" fill-rule="evenodd"/></svg>
                                            @endif                                            
                                        @else
                                            <svg width="100%" height="22" viewBox="0 -0.5 17 17" xmlns="http://www.w3.org/2000/svg" class=" mt-2 si-glyph si-glyph-time-reload"><g fill="#434343" fill-rule="evenodd"><path d="M9.549 1.046c-3.859 0-6.819 3.192-7.166 6.985H1.059l1.892 1.952 2.065-1.952H3.677c.331-3.229 2.747-5.958 5.937-5.958 3.412 0 6.189 2.888 6.189 6.437 0 3.549-2.777 6.438-6.189 6.438-1.695 0-3.232-.713-4.35-1.865l-.821.826a7.364 7.364 0 0 0 5.106 2.065c4.092 0 7.419-3.349 7.419-7.464s-3.327-7.464-7.419-7.464Z" class="si-glyph-fill"/><path d="M9 3.99V9h3.96V8H9.97V3.99H9Z" class="si-glyph-fill"/></g></svg>
                                        @endif
                                    </div>

                                    <!-- Fecha -->
                                    <div class="Day">
                                        @if($fases_contrato->visita_a_terreno)
                                            Fecha: <br> {{Carbon\Carbon::parse($fases_contrato->visita_a_terreno)->format('d-m-Y')}}
                                                                                 
                                        @else
                                            Fecha: None
                                                                                    
                                        @endif
                                    </div>
                                    <!-- Fecha -->


                                </div>
                                <div class="eventTitle mt-1">
                                    Visita a terreno
                                </div>
                            </div>
                            <div class="eventAuthor">
                                
                            </div>

                            <!-- Punto -->
                            <svg height="20" width="20">
                                <circle cx="10" cy="11" r="5" fill="#ff0000" />
                            </svg>
                            <!-- Punto -->

                            <div class="time">
                                <!--
                                9 : 27 AM
                                -->
                            </div>
                        </div>
                        <!-- Fase -->

                        <!-- AHORA -->
                        @if($fase_actual == 8)
                            <svg height="5" width="150">
                                <line x1="0" y1="0" x2="200" y2="0" style="stroke:#ff0000;stroke-width:5" />
                                Sorry, your browser does not support inline SVG.
                            </svg>
                            <div class="now">
                                AHORA
                            </div>  
                        @endif
                        <!-- AHORA -->

                        <!-- Linea -->
                        <svg height="5" width="150">
                            <line x1="0" y1="0" x2="200" y2="0" style="stroke:#ff0000;stroke-width:5" />
                            Sorry, your browser does not support inline SVG.
                        </svg>
                        <!-- Linea -->

                        <!-- Fase -->
                        <div class="event2">
                            <div class="event2Bubble">
                                <div class="eventTime">

                                    <div class="DayDigit">
                                        @if($fases_contrato->preguntas_y_consultas_proponente)
                                            @if($contrato->fase_contrato_comprobante[0]->preguntas_y_consultas_proponente)
                                                <a target="_blank" href="{{ Storage::url('contratos/'.$contrato->id."/".$contrato->fase_contrato_comprobante[0]->preguntas_y_consultas_proponente) }}">
                                                    <svg width="70%" height="22" viewBox="0 -0.5 17 17" xmlns="http://www.w3.org/2000/svg" class="mt-2 si-glyph si-glyph-checked"><path d="M3.432 6.189a1 1 0 0 1 1.415 0L6.968 8.31l6.179-6.179a.99.99 0 0 1 1.401.013l2.122 2.122a.991.991 0 0 1 .014 1.4l-9.022 9.021a.99.99 0 0 1-1.401-.014l-4.95-4.95a.998.998 0 0 1 0-1.413l2.121-2.121Z" fill="#eb970a" fill="#434343"  class="si-glyph-fill" fill-rule="evenodd"/></svg>
                                                </a>
                                            @else
                                                <svg width="70%" height="22" viewBox="0 -0.5 17 17" xmlns="http://www.w3.org/2000/svg" class="mt-2 si-glyph si-glyph-checked"><path d="M3.432 6.189a1 1 0 0 1 1.415 0L6.968 8.31l6.179-6.179a.99.99 0 0 1 1.401.013l2.122 2.122a.991.991 0 0 1 .014 1.4l-9.022 9.021a.99.99 0 0 1-1.401-.014l-4.95-4.95a.998.998 0 0 1 0-1.413l2.121-2.121Z" fill="#434343" class="si-glyph-fill" fill-rule="evenodd"/></svg>
                                            @endif                                            
                                        @else
                                            <svg width="100%" height="22" viewBox="0 -0.5 17 17" xmlns="http://www.w3.org/2000/svg" class=" mt-2 si-glyph si-glyph-time-reload"><g fill="#434343" fill-rule="evenodd"><path d="M9.549 1.046c-3.859 0-6.819 3.192-7.166 6.985H1.059l1.892 1.952 2.065-1.952H3.677c.331-3.229 2.747-5.958 5.937-5.958 3.412 0 6.189 2.888 6.189 6.437 0 3.549-2.777 6.438-6.189 6.438-1.695 0-3.232-.713-4.35-1.865l-.821.826a7.364 7.364 0 0 0 5.106 2.065c4.092 0 7.419-3.349 7.419-7.464s-3.327-7.464-7.419-7.464Z" class="si-glyph-fill"/><path d="M9 3.99V9h3.96V8H9.97V3.99H9Z" class="si-glyph-fill"/></g></svg>
                                        @endif
                                    </div>

                                    <!-- Fecha -->
                                    <div class="Day">
                                        @if($fases_contrato->preguntas_y_consultas_proponente)
                                            Fecha: <br> {{Carbon\Carbon::parse($fases_contrato->preguntas_y_consultas_proponente)->format('d-m-Y')}}
                                                                         
                                        @else
                                            Fecha: None
                                                                              
                                        @endif
                                    </div>
                                    <!-- Fecha -->


                                </div>
                                <div class="eventTitle mt-1">
                                    Preguntas y consultas proponente
                                </div>
                            </div>
                            <div class="eventAuthor">
                                
                            </div>

                            <!-- Punto -->
                            <svg height="20" width="20">
                                <circle cx="10" cy="11" r="5" fill="#ff0000" />
                            </svg>
                            <!-- Punto -->

                            <div class="time">
                                <!--
                                9 : 27 AM
                                -->
                            </div>
                        </div>
                        <!-- Fase -->

                        <!-- AHORA -->
                        @if($fase_actual == 9)
                            <svg height="5" width="150">
                                <line x1="0" y1="0" x2="200" y2="0" style="stroke:#ff0000;stroke-width:5" />
                                Sorry, your browser does not support inline SVG.
                            </svg>
                            <div class="now">
                                AHORA
                            </div>  
                        @endif
                        <!-- AHORA -->

                        <!-- Linea -->
                        <svg height="5" width="150">
                            <line x1="0" y1="0" x2="200" y2="0" style="stroke:#ff0000;stroke-width:5" />
                            Sorry, your browser does not support inline SVG.
                        </svg>
                        <!-- Linea -->

                        <!-- Fase -->
                        <div class="event1">
                            <div class="event1Bubble">
                                <div class="eventTime">

                                    <div class="DayDigit">
                                        @if($fases_contrato->respuestas_del_mandante)
                                            @if($contrato->fase_contrato_comprobante[0]->respuestas_del_mandante)
                                                <a target="_blank" href="{{ Storage::url('contratos/'.$contrato->id."/".$contrato->fase_contrato_comprobante[0]->respuestas_del_mandante) }}">
                                                    <svg width="70%" height="22" viewBox="0 -0.5 17 17" xmlns="http://www.w3.org/2000/svg" class="mt-2 si-glyph si-glyph-checked"><path d="M3.432 6.189a1 1 0 0 1 1.415 0L6.968 8.31l6.179-6.179a.99.99 0 0 1 1.401.013l2.122 2.122a.991.991 0 0 1 .014 1.4l-9.022 9.021a.99.99 0 0 1-1.401-.014l-4.95-4.95a.998.998 0 0 1 0-1.413l2.121-2.121Z" fill="#eb970a" fill="#434343"  class="si-glyph-fill" fill-rule="evenodd"/></svg>
                                                </a>
                                            @else
                                                <svg width="70%" height="22" viewBox="0 -0.5 17 17" xmlns="http://www.w3.org/2000/svg" class="mt-2 si-glyph si-glyph-checked"><path d="M3.432 6.189a1 1 0 0 1 1.415 0L6.968 8.31l6.179-6.179a.99.99 0 0 1 1.401.013l2.122 2.122a.991.991 0 0 1 .014 1.4l-9.022 9.021a.99.99 0 0 1-1.401-.014l-4.95-4.95a.998.998 0 0 1 0-1.413l2.121-2.121Z" fill="#434343" class="si-glyph-fill" fill-rule="evenodd"/></svg>
                                            @endif                                            
                                        @else
                                            <svg width="100%" height="22" viewBox="0 -0.5 17 17" xmlns="http://www.w3.org/2000/svg" class=" mt-2 si-glyph si-glyph-time-reload"><g fill="#434343" fill-rule="evenodd"><path d="M9.549 1.046c-3.859 0-6.819 3.192-7.166 6.985H1.059l1.892 1.952 2.065-1.952H3.677c.331-3.229 2.747-5.958 5.937-5.958 3.412 0 6.189 2.888 6.189 6.437 0 3.549-2.777 6.438-6.189 6.438-1.695 0-3.232-.713-4.35-1.865l-.821.826a7.364 7.364 0 0 0 5.106 2.065c4.092 0 7.419-3.349 7.419-7.464s-3.327-7.464-7.419-7.464Z" class="si-glyph-fill"/><path d="M9 3.99V9h3.96V8H9.97V3.99H9Z" class="si-glyph-fill"/></g></svg>
                                        @endif
                                    </div>

                                    <!-- Fecha -->
                                    <div class="Day">
                                        @if($fases_contrato->respuestas_del_mandante)
                                            Fecha: <br> {{Carbon\Carbon::parse($fases_contrato->respuestas_del_mandante)->format('d-m-Y')}}
                                                                             
                                        @else
                                            Fecha: None
                                                                             
                                        @endif
                                    </div>
                                    <!-- Fecha -->


                                </div>
                                <div class="eventTitle mt-1">
                                    Respuestas del mandante
                                </div>
                            </div>
                            <div class="eventAuthor">
                                
                            </div>

                            <!-- Punto -->
                            <svg height="20" width="20">
                                <circle cx="10" cy="11" r="5" fill="#ff0000" />
                            </svg>
                            <!-- Punto -->

                            <div class="time">
                                <!--
                                9 : 27 AM
                                -->
                            </div>
                        </div>
                        <!-- Fase -->

                        <!-- AHORA -->
                        @if($fase_actual == 10)
                            <svg height="5" width="150">
                                <line x1="0" y1="0" x2="200" y2="0" style="stroke:#ff0000;stroke-width:5" />
                                Sorry, your browser does not support inline SVG.
                            </svg>
                            <div class="now">
                                AHORA
                            </div>  
                        @endif
                        <!-- AHORA -->

                        <!-- Linea -->
                        <svg height="5" width="150">
                            <line x1="0" y1="0" x2="200" y2="0" style="stroke:#ff0000;stroke-width:5" />
                            Sorry, your browser does not support inline SVG.
                        </svg>
                        <!-- Linea -->

                        <!-- Fase -->
                        <div class="event2">
                            <div class="event2Bubble">
                                <div class="eventTime">

                                    <div class="DayDigit">
                                        @if($fases_contrato->recepcion_de_ofertas_tecnicas_economicas)
                                            @if($contrato->fase_contrato_comprobante[0]->recepcion_de_ofertas_tecnicas_economicas)
                                                <a target="_blank" href="{{ Storage::url('contratos/'.$contrato->id."/".$contrato->fase_contrato_comprobante[0]->recepcion_de_ofertas_tecnicas_economicas) }}">
                                                    <svg width="70%" height="22" viewBox="0 -0.5 17 17" xmlns="http://www.w3.org/2000/svg" class="mt-2 si-glyph si-glyph-checked"><path d="M3.432 6.189a1 1 0 0 1 1.415 0L6.968 8.31l6.179-6.179a.99.99 0 0 1 1.401.013l2.122 2.122a.991.991 0 0 1 .014 1.4l-9.022 9.021a.99.99 0 0 1-1.401-.014l-4.95-4.95a.998.998 0 0 1 0-1.413l2.121-2.121Z" fill="#eb970a" fill="#434343"  class="si-glyph-fill" fill-rule="evenodd"/></svg>
                                                </a>
                                            @else
                                                <svg width="70%" height="22" viewBox="0 -0.5 17 17" xmlns="http://www.w3.org/2000/svg" class="mt-2 si-glyph si-glyph-checked"><path d="M3.432 6.189a1 1 0 0 1 1.415 0L6.968 8.31l6.179-6.179a.99.99 0 0 1 1.401.013l2.122 2.122a.991.991 0 0 1 .014 1.4l-9.022 9.021a.99.99 0 0 1-1.401-.014l-4.95-4.95a.998.998 0 0 1 0-1.413l2.121-2.121Z" fill="#434343" class="si-glyph-fill" fill-rule="evenodd"/></svg>
                                            @endif                                            
                                        @else
                                            <svg width="100%" height="22" viewBox="0 -0.5 17 17" xmlns="http://www.w3.org/2000/svg" class=" mt-2 si-glyph si-glyph-time-reload"><g fill="#434343" fill-rule="evenodd"><path d="M9.549 1.046c-3.859 0-6.819 3.192-7.166 6.985H1.059l1.892 1.952 2.065-1.952H3.677c.331-3.229 2.747-5.958 5.937-5.958 3.412 0 6.189 2.888 6.189 6.437 0 3.549-2.777 6.438-6.189 6.438-1.695 0-3.232-.713-4.35-1.865l-.821.826a7.364 7.364 0 0 0 5.106 2.065c4.092 0 7.419-3.349 7.419-7.464s-3.327-7.464-7.419-7.464Z" class="si-glyph-fill"/><path d="M9 3.99V9h3.96V8H9.97V3.99H9Z" class="si-glyph-fill"/></g></svg>
                                        @endif
                                    </div>

                                    <!-- Fecha -->
                                    <div class="Day">
                                        @if($fases_contrato->recepcion_de_ofertas_tecnicas_economicas)
                                            Fecha: <br> {{Carbon\Carbon::parse($fases_contrato->recepcion_de_ofertas_tecnicas_economicas)->format('d-m-Y')}}
                                                                       
                                        @else
                                            Fecha: None
                                                                         
                                        @endif
                                    </div>
                                    <!-- Fecha -->


                                </div>
                                <div class="eventTitle mt-1">
                                    Recepcion de ofertas tecnicas economicas
                                </div>
                            </div>
                            <div class="eventAuthor">
                                
                            </div>

                            <!-- Punto -->
                            <svg height="20" width="20">
                                <circle cx="10" cy="11" r="5" fill="#ff0000" />
                            </svg>
                            <!-- Punto -->

                            <div class="time">
                                <!--
                                9 : 27 AM
                                -->
                            </div>
                        </div>
                        <!-- Fase -->

                        <!-- AHORA -->
                        @if($fase_actual == 11)
                            <svg height="5" width="150">
                                <line x1="0" y1="0" x2="200" y2="0" style="stroke:#ff0000;stroke-width:5" />
                                Sorry, your browser does not support inline SVG.
                            </svg>
                            <div class="now">
                                AHORA
                            </div>  
                        @endif
                        <!-- AHORA -->

                        <!-- Linea -->
                        <svg height="5" width="150">
                            <line x1="0" y1="0" x2="200" y2="0" style="stroke:#ff0000;stroke-width:5" />
                            Sorry, your browser does not support inline SVG.
                        </svg>
                        <!-- Linea -->

                        <!-- Fase -->
                        <div class="event1">
                            <div class="event1Bubble">
                                <div class="eventTime">

                                    <div class="DayDigit">
                                        @if($fases_contrato->evaluacion_ofertas_tecnicas)
                                            @if($contrato->fase_contrato_comprobante[0]->evaluacion_ofertas_tecnicas)
                                                <a target="_blank" href="{{ Storage::url('contratos/'.$contrato->id."/".$contrato->fase_contrato_comprobante[0]->evaluacion_ofertas_tecnicas) }}">
                                                    <svg width="70%" height="22" viewBox="0 -0.5 17 17" xmlns="http://www.w3.org/2000/svg" class="mt-2 si-glyph si-glyph-checked"><path d="M3.432 6.189a1 1 0 0 1 1.415 0L6.968 8.31l6.179-6.179a.99.99 0 0 1 1.401.013l2.122 2.122a.991.991 0 0 1 .014 1.4l-9.022 9.021a.99.99 0 0 1-1.401-.014l-4.95-4.95a.998.998 0 0 1 0-1.413l2.121-2.121Z" fill="#eb970a" fill="#434343"  class="si-glyph-fill" fill-rule="evenodd"/></svg>
                                                </a>
                                            @else
                                                <svg width="70%" height="22" viewBox="0 -0.5 17 17" xmlns="http://www.w3.org/2000/svg" class="mt-2 si-glyph si-glyph-checked"><path d="M3.432 6.189a1 1 0 0 1 1.415 0L6.968 8.31l6.179-6.179a.99.99 0 0 1 1.401.013l2.122 2.122a.991.991 0 0 1 .014 1.4l-9.022 9.021a.99.99 0 0 1-1.401-.014l-4.95-4.95a.998.998 0 0 1 0-1.413l2.121-2.121Z" fill="#434343" class="si-glyph-fill" fill-rule="evenodd"/></svg>
                                            @endif                                            
                                        @else
                                        <svg width="100%" height="22" viewBox="0 -0.5 17 17" xmlns="http://www.w3.org/2000/svg" class=" mt-2 si-glyph si-glyph-time-reload"><g fill="#434343" fill-rule="evenodd"><path d="M9.549 1.046c-3.859 0-6.819 3.192-7.166 6.985H1.059l1.892 1.952 2.065-1.952H3.677c.331-3.229 2.747-5.958 5.937-5.958 3.412 0 6.189 2.888 6.189 6.437 0 3.549-2.777 6.438-6.189 6.438-1.695 0-3.232-.713-4.35-1.865l-.821.826a7.364 7.364 0 0 0 5.106 2.065c4.092 0 7.419-3.349 7.419-7.464s-3.327-7.464-7.419-7.464Z" class="si-glyph-fill"/><path d="M9 3.99V9h3.96V8H9.97V3.99H9Z" class="si-glyph-fill"/></g></svg>
                                        @endif
                                    </div>

                                    <!-- Fecha -->
                                    <div class="Day">
                                        @if($fases_contrato->evaluacion_ofertas_tecnicas)
                                            Fecha: <br> {{Carbon\Carbon::parse($fases_contrato->evaluacion_ofertas_tecnicas)->format('d-m-Y')}}
                                                                    
                                        @else
                                            Fecha: None
                                                                    
                                        @endif
                                    </div>
                                    <!-- Fecha -->


                                </div>
                                <div class="eventTitle mt-1">
                                    Evaluacion ofertas tecnicas
                                </div>
                            </div>
                            <div class="eventAuthor">
                                
                            </div>

                            <!-- Punto -->
                            <svg height="20" width="20">
                                <circle cx="10" cy="11" r="5" fill="#ff0000" />
                            </svg>
                            <!-- Punto -->

                            <div class="time">
                                <!--
                                9 : 27 AM
                                -->
                            </div>
                        </div>
                        <!-- Fase -->

                        <!-- AHORA -->
                        @if($fase_actual == 12)
                            <svg height="5" width="150">
                                <line x1="0" y1="0" x2="200" y2="0" style="stroke:#ff0000;stroke-width:5" />
                                Sorry, your browser does not support inline SVG.
                            </svg>
                            <div class="now">
                                AHORA
                            </div>  
                        @endif
                        <!-- AHORA -->

                        <!-- Linea -->
                        <svg height="5" width="150">
                            <line x1="0" y1="0" x2="200" y2="0" style="stroke:#ff0000;stroke-width:5" />
                            Sorry, your browser does not support inline SVG.
                        </svg>
                        <!-- Linea -->

                        <!-- Fase -->
                        <div class="event2">
                            <div class="event2Bubble">
                                <div class="eventTime">

                                    <div class="DayDigit">
                                        @if($fases_contrato->evaluacion_ofertas_economicas)
                                            @if($contrato->fase_contrato_comprobante[0]->evaluacion_ofertas_economicas)
                                                <a target="_blank" href="{{ Storage::url('contratos/'.$contrato->id."/".$contrato->fase_contrato_comprobante[0]->evaluacion_ofertas_economicas) }}">
                                                    <svg width="70%" height="22" viewBox="0 -0.5 17 17" xmlns="http://www.w3.org/2000/svg" class="mt-2 si-glyph si-glyph-checked"><path d="M3.432 6.189a1 1 0 0 1 1.415 0L6.968 8.31l6.179-6.179a.99.99 0 0 1 1.401.013l2.122 2.122a.991.991 0 0 1 .014 1.4l-9.022 9.021a.99.99 0 0 1-1.401-.014l-4.95-4.95a.998.998 0 0 1 0-1.413l2.121-2.121Z" fill="#eb970a" fill="#434343"  class="si-glyph-fill" fill-rule="evenodd"/></svg>
                                                </a>
                                            @else
                                                <svg width="70%" height="22" viewBox="0 -0.5 17 17" xmlns="http://www.w3.org/2000/svg" class="mt-2 si-glyph si-glyph-checked"><path d="M3.432 6.189a1 1 0 0 1 1.415 0L6.968 8.31l6.179-6.179a.99.99 0 0 1 1.401.013l2.122 2.122a.991.991 0 0 1 .014 1.4l-9.022 9.021a.99.99 0 0 1-1.401-.014l-4.95-4.95a.998.998 0 0 1 0-1.413l2.121-2.121Z" fill="#434343" class="si-glyph-fill" fill-rule="evenodd"/></svg>
                                            @endif                                            
                                        @else
                                            <svg width="100%" height="22" viewBox="0 -0.5 17 17" xmlns="http://www.w3.org/2000/svg" class=" mt-2 si-glyph si-glyph-time-reload"><g fill="#434343" fill-rule="evenodd"><path d="M9.549 1.046c-3.859 0-6.819 3.192-7.166 6.985H1.059l1.892 1.952 2.065-1.952H3.677c.331-3.229 2.747-5.958 5.937-5.958 3.412 0 6.189 2.888 6.189 6.437 0 3.549-2.777 6.438-6.189 6.438-1.695 0-3.232-.713-4.35-1.865l-.821.826a7.364 7.364 0 0 0 5.106 2.065c4.092 0 7.419-3.349 7.419-7.464s-3.327-7.464-7.419-7.464Z" class="si-glyph-fill"/><path d="M9 3.99V9h3.96V8H9.97V3.99H9Z" class="si-glyph-fill"/></g></svg>
                                        @endif
                                    </div>

                                    <!-- Fecha -->
                                    <div class="Day">
                                        @if($fases_contrato->evaluacion_ofertas_economicas)
                                            Fecha: <br> {{Carbon\Carbon::parse($fases_contrato->evaluacion_ofertas_economicas)->format('d-m-Y')}}
                                                                   
                                        @else
                                            Fecha: None
                                                                       
                                        @endif
                                    </div>
                                    <!-- Fecha -->


                                </div>
                                <div class="eventTitle mt-1">
                                    Evaluacion ofertas economicas
                                </div>
                            </div>
                            <div class="eventAuthor">
                                
                            </div>

                            <!-- Punto -->
                            <svg height="20" width="20">
                                <circle cx="10" cy="11" r="5" fill="#ff0000" />
                            </svg>
                            <!-- Punto -->

                            <div class="time">
                                <!--
                                9 : 27 AM
                                -->
                            </div>
                        </div>
                        <!-- Fase -->

                        <!-- AHORA -->
                        @if($fase_actual == 13)
                            <svg height="5" width="150">
                                <line x1="0" y1="0" x2="200" y2="0" style="stroke:#ff0000;stroke-width:5" />
                                Sorry, your browser does not support inline SVG.
                            </svg>
                            <div class="now">
                                AHORA
                            </div>  
                        @endif
                        <!-- AHORA -->

                        <!-- Linea -->
                        <svg height="5" width="150">
                            <line x1="0" y1="0" x2="200" y2="0" style="stroke:#ff0000;stroke-width:5" />
                            Sorry, your browser does not support inline SVG.
                        </svg>
                        <!-- Linea -->


                        <!-- Fase -->
                        <div class="event1">
                            <div class="event1Bubble">
                                <div class="eventTime">

                                    <div class="DayDigit">
                                        @if($fases_contrato->comite_de_inversiones)
                                            @if($contrato->fase_contrato_comprobante[0]->comite_de_inversiones)
                                                <a target="_blank" href="{{ Storage::url('contratos/'.$contrato->id."/".$contrato->fase_contrato_comprobante[0]->comite_de_inversiones) }}">
                                                    <svg width="70%" height="22" viewBox="0 -0.5 17 17" xmlns="http://www.w3.org/2000/svg" class="mt-2 si-glyph si-glyph-checked"><path d="M3.432 6.189a1 1 0 0 1 1.415 0L6.968 8.31l6.179-6.179a.99.99 0 0 1 1.401.013l2.122 2.122a.991.991 0 0 1 .014 1.4l-9.022 9.021a.99.99 0 0 1-1.401-.014l-4.95-4.95a.998.998 0 0 1 0-1.413l2.121-2.121Z" fill="#eb970a" fill="#434343"  class="si-glyph-fill" fill-rule="evenodd"/></svg>
                                                </a>
                                            @else
                                                <svg width="70%" height="22" viewBox="0 -0.5 17 17" xmlns="http://www.w3.org/2000/svg" class="mt-2 si-glyph si-glyph-checked"><path d="M3.432 6.189a1 1 0 0 1 1.415 0L6.968 8.31l6.179-6.179a.99.99 0 0 1 1.401.013l2.122 2.122a.991.991 0 0 1 .014 1.4l-9.022 9.021a.99.99 0 0 1-1.401-.014l-4.95-4.95a.998.998 0 0 1 0-1.413l2.121-2.121Z" fill="#434343" class="si-glyph-fill" fill-rule="evenodd"/></svg>
                                            @endif                                            
                                        @else
                                            <svg width="100%" height="22" viewBox="0 -0.5 17 17" xmlns="http://www.w3.org/2000/svg" class=" mt-2 si-glyph si-glyph-time-reload"><g fill="#434343" fill-rule="evenodd"><path d="M9.549 1.046c-3.859 0-6.819 3.192-7.166 6.985H1.059l1.892 1.952 2.065-1.952H3.677c.331-3.229 2.747-5.958 5.937-5.958 3.412 0 6.189 2.888 6.189 6.437 0 3.549-2.777 6.438-6.189 6.438-1.695 0-3.232-.713-4.35-1.865l-.821.826a7.364 7.364 0 0 0 5.106 2.065c4.092 0 7.419-3.349 7.419-7.464s-3.327-7.464-7.419-7.464Z" class="si-glyph-fill"/><path d="M9 3.99V9h3.96V8H9.97V3.99H9Z" class="si-glyph-fill"/></g></svg>
                                        @endif
                                    </div>

                                    <!-- Fecha -->
                                    <div class="Day">
                                        @if($fases_contrato->comite_de_inversiones)
                                            Fecha: <br> {{Carbon\Carbon::parse($fases_contrato->comite_de_inversiones)->format('d-m-Y')}}
                                                                             
                                        @else
                                            Fecha: None
                                                                             
                                        @endif
                                    </div>
                                    <!-- Fecha -->


                                </div>
                                <div class="eventTitle mt-1">
                                    Comite de inversiones
                                </div>
                            </div>
                            <div class="eventAuthor">
                                
                            </div>

                            <!-- Punto -->
                            <svg height="20" width="20">
                                <circle cx="10" cy="11" r="5" fill="#ff0000" />
                            </svg>
                            <!-- Punto -->

                            <div class="time">
                                <!--
                                9 : 27 AM
                                -->
                            </div>
                        </div>
                        <!-- Fase -->

                        <!-- AHORA -->
                        @if($fase_actual == 14)
                            <svg height="5" width="150">
                                <line x1="0" y1="0" x2="200" y2="0" style="stroke:#ff0000;stroke-width:5" />
                                Sorry, your browser does not support inline SVG.
                            </svg>
                            <div class="now">
                                AHORA
                            </div>  
                        @endif
                        <!-- AHORA -->

                        <!-- Linea -->
                        <svg height="5" width="150">
                            <line x1="0" y1="0" x2="200" y2="0" style="stroke:#ff0000;stroke-width:5" />
                            Sorry, your browser does not support inline SVG.
                        </svg>
                        <!-- Linea -->


                        <!-- Fase -->
                        <div class="event2">
                            <div class="event2Bubble">
                                <div class="eventTime">

                                    <div class="DayDigit">
                                        @if($fases_contrato->adjudicacion)
                                            @if($contrato->fase_contrato_comprobante[0]->adjudicacion)
                                                <a target="_blank" href="{{ Storage::url('contratos/'.$contrato->id."/".$contrato->fase_contrato_comprobante[0]->adjudicacion) }}">
                                                    <svg width="70%" height="22" viewBox="0 -0.5 17 17" xmlns="http://www.w3.org/2000/svg" class="mt-2 si-glyph si-glyph-checked"><path d="M3.432 6.189a1 1 0 0 1 1.415 0L6.968 8.31l6.179-6.179a.99.99 0 0 1 1.401.013l2.122 2.122a.991.991 0 0 1 .014 1.4l-9.022 9.021a.99.99 0 0 1-1.401-.014l-4.95-4.95a.998.998 0 0 1 0-1.413l2.121-2.121Z" fill="#eb970a"  class="si-glyph-fill" fill-rule="evenodd"/></svg>
                                                </a>
                                            @else
                                                <svg width="70%" height="22" viewBox="0 -0.5 17 17" xmlns="http://www.w3.org/2000/svg" class="mt-2 si-glyph si-glyph-checked"><path d="M3.432 6.189a1 1 0 0 1 1.415 0L6.968 8.31l6.179-6.179a.99.99 0 0 1 1.401.013l2.122 2.122a.991.991 0 0 1 .014 1.4l-9.022 9.021a.99.99 0 0 1-1.401-.014l-4.95-4.95a.998.998 0 0 1 0-1.413l2.121-2.121Z" fill="#434343" class="si-glyph-fill" fill-rule="evenodd"/></svg>
                                            @endif                                            
                                        @else
                                            <svg width="100%" height="22" viewBox="0 -0.5 17 17" xmlns="http://www.w3.org/2000/svg" class=" mt-2 si-glyph si-glyph-time-reload"><g fill="#434343" fill-rule="evenodd"><path d="M9.549 1.046c-3.859 0-6.819 3.192-7.166 6.985H1.059l1.892 1.952 2.065-1.952H3.677c.331-3.229 2.747-5.958 5.937-5.958 3.412 0 6.189 2.888 6.189 6.437 0 3.549-2.777 6.438-6.189 6.438-1.695 0-3.232-.713-4.35-1.865l-.821.826a7.364 7.364 0 0 0 5.106 2.065c4.092 0 7.419-3.349 7.419-7.464s-3.327-7.464-7.419-7.464Z" class="si-glyph-fill"/><path d="M9 3.99V9h3.96V8H9.97V3.99H9Z" class="si-glyph-fill"/></g></svg>
                                        @endif
                                    </div>

                                    <!-- Fecha -->
                                    <div class="Day">
                                        @if($fases_contrato->adjudicacion)
                                            Fecha: <br> {{Carbon\Carbon::parse($fases_contrato->adjudicacion)->format('d-m-Y')}}
                                                                             
                                        @else
                                            Fecha: None
                                                                               
                                        @endif
                                    </div>
                                    <!-- Fecha -->


                                </div>
                                <div class="eventTitle mt-1">
                                    Adjudicacion
                                </div>
                            </div>
                            <div class="eventAuthor">
                                
                            </div>

                            <!-- Punto -->
                            <svg height="20" width="20">
                                <circle cx="10" cy="11" r="5" fill="#ff0000" />
                            </svg>
                            <!-- Punto -->

                            <div class="time">
                                <!--
                                9 : 27 AM
                                -->
                            </div>
                        </div>
                        <!-- Fase -->

                        <!-- AHORA -->
                        @if($fase_actual == 15)
                            <svg height="5" width="150">
                                <line x1="0" y1="0" x2="200" y2="0" style="stroke:#ff0000;stroke-width:5" />
                                Sorry, your browser does not support inline SVG.
                            </svg>
                            <div class="now">
                                TERMINADA
                            </div>  
                        @endif
                        <!-- AHORA -->
                        
                      </div>

                    <!-- FINAL -->
                </div>
            </div>
        </div>

        <form class="container-fluid" action="{!! route('fase.update', $contrato->id) !!}" method="post" enctype="multipart/form-data">
        @csrf
        @include('contrato.cambio_fase_fields')
        </form>

        @overwrite
        @include('layouts.card')
    @endpush

    @section('down_cards')
    
    @endsection

@endsection
