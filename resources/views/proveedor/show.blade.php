@extends('layouts.app')
<link href="{{asset('assets/css/timeline.css')}}" rel="stylesheet">

@section('content')

    @section('title')
    &nbsp;
    <h3>
        Proveedor: {{$proveedor->nombre}} - Código SAP N°{{$proveedor->contrato_sap ?? '(Aún no ingresado)'}} - RUT: {{$proveedor->rut}}
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
                                    <li class=""><a href="#tab1" class="active" data-bs-toggle="tab">Datos Generales</a></li>
                                    <li class=""><a href="#tab2" data-bs-toggle="tab">Datos Comerciales</a></li>
                                    <li class=""><a href="#tab3" data-bs-toggle="tab">Datos Logísticos</a></li>
                                    <li class=""><a href="#tab4" data-bs-toggle="tab">Datos Bancarios</a></li>



                                </ul>
                            </div>
                        </div>
                        <div class="panel-body tabs-menu-body fs-13">
                            <div class="tab-content">
                                <div class="tab-pane active" id="tab1">
                                    <ul>
                                        <li class="row mb-5">
                                            <div class="col-sm-3 text-muted">Nombre</div>
                                            <div class="col-sm-9">{{$proveedor->nombre}}</div>
                                        </li>
                                        <li class="row mb-5">
                                            <div class="col-sm-3 text-muted">Código</div>
                                            <div class="col-sm-9">{{$proveedor->codigo}}</div>
                                        </li>
                                        <li class="row mb-5">
                                            <div class="col-sm-3 text-muted">RUT</div>
                                            <div class="col-sm-9">{{$proveedor->rut.'-'.$proveedor->rut_dv}}</div>
                                        </li>
                                        <li class="row mb-5">
                                            <div class="col-sm-3 text-muted">Giro</div>
                                            <div class="col-sm-9">{{$proveedor->giro}}</div>
                                        </li>
                                        <li class="row mb-5">
                                            <div class="col-sm-3 text-muted">Persona Natural u Organización</div>
                                            <div class="col-sm-9">{{$proveedor->natural_organizacion}}</div>
                                        </li>
                                        
                                    </ul>
                                </div>
                                <div class="tab-pane" id="tab2">
                                    <ul>
                                        <li class="row mb-5">
                                            <div class="col-sm-3 text-muted">Dirección (Comercial)</div>
                                            <div class="col-sm-9">{{$proveedor->direccion_com}}</div>
                                        </li>
                                        <li class="row mb-5">
                                            <div class="col-sm-3 text-muted">Comuna (Comercial)</div>
                                            <div class="col-sm-9">{{$proveedor->comuna_com}}</div>
                                        </li>
                                        <li class="row mb-5">
                                            <div class="col-sm-3 text-muted">Región (Comercial)</div>
                                            <div class="col-sm-9">{{$proveedor->region_com}}</div>
                                        </li>
                                        <li class="row mb-5">
                                            <div class="col-sm-3 text-muted">Email (Comercial)</div>
                                            <div class="col-sm-9">{{$proveedor->email_com}}</div>
                                        </li>
                                        <li class="row mb-5">
                                            <div class="col-sm-3 text-muted">Teléfono (Comercial)</div>
                                            <div class="col-sm-9">{{$proveedor->telefono_com}}</div>
                                        </li>
                                        <li class="row mb-5">
                                            <div class="col-sm-3 text-muted">Persona Contacto (Comercial)</div>
                                            <div class="col-sm-9">{{$proveedor->persona_contacto_com}}</div>
                                        </li>


                                    </ul>
                                </div>

                                <div class="tab-pane" id="tab3">
                                    <ul>
                                        <li class="row mb-5">
                                            <div class="col-sm-3 text-muted">Dirección (Logística)</div>
                                            <div class="col-sm-9">{{$proveedor->direccion_log}}</div>
                                        </li>
                                        <li class="row mb-5">
                                            <div class="col-sm-3 text-muted">Comuna (Logística)</div>
                                            <div class="col-sm-9">{{$proveedor->comuna_log}}</div>
                                        </li>
                                        <li class="row mb-5">
                                            <div class="col-sm-3 text-muted">Región (Logística)</div>
                                            <div class="col-sm-9">{{$proveedor->region_log}}</div>
                                        </li>
                                        <li class="row mb-5">
                                            <div class="col-sm-3 text-muted">Email (Logística)</div>
                                            <div class="col-sm-9">{{$proveedor->email_log}}</div>
                                        </li>
                                        <li class="row mb-5">
                                            <div class="col-sm-3 text-muted">Teléfono (Logística)</div>
                                            <div class="col-sm-9">{{$proveedor->telefono_log}}</div>
                                        </li>
                                        <li class="row mb-5">
                                            <div class="col-sm-3 text-muted">Persona Contacto (Logística)</div>
                                            <div class="col-sm-9">{{$proveedor->persona_contacto_log}}</div>
                                        </li>


                                    </ul>
                                </div>
                                <div class="tab-pane" id="tab4">
                                    <ul>

                                        <li class="row mb-5">
                                            <div class="col-sm-3 text-muted">N° Cuenta</div>
                                            <div class="col-sm-9">{{$proveedor->nro_cuenta}}</div>
                                        </li>
                                        <li class="row mb-5">
                                            <div class="col-sm-3 text-muted">Tipo de Cuenta</div>
                                            <div class="col-sm-9">{{$proveedor->tipo_cuenta}}</div>
                                        </li>
                                        <li class="row mb-5">
                                            <div class="col-sm-3 text-muted">Banco</div>
                                            <div class="col-sm-9">{{$proveedor->banco}}</div>
                                        </li>
                                        <li class="row mb-5">
                                            <div class="col-sm-3 text-muted">Moneda</div>
                                            <div class="col-sm-9">{{$proveedor->moneda}}</div>
                                        </li>
                                        <li class="row mb-5">
                                            <div class="col-sm-3 text-muted">Email Pago</div>
                                            <div class="col-sm-9">{{$proveedor->email_pago}}</div>
                                        </li>
                                        <li class="row mb-5">
                                            <div class="col-sm-3 text-muted">Cheque Nominativo y Cruzado</div>
                                            @if($proveedor->cheque_checkbox)
                                                <div class="col-sm-9">SI</div>
                                            @else
                                                <div class="col-sm-9">NO</div>
                                            @endif
                                        </li>
                                        <li class="row mb-5">
                                            <div class="col-sm-3 text-muted">Vale Vista Virtual</div>
                                            @if($proveedor->vale_vista_checkbox)
                                                <div class="col-sm-9">SI</div>
                                            @else
                                                <div class="col-sm-9">NO</div>
                                            @endif
                                        </li>
                                    </ul>
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
             Datos Obligatorios (Uso Interno)           
        @overwrite

        @section('card_content')
            <form id="store" class="container-fluid" action="{!! route('proveedor.store2') !!}" method="post">
                @csrf
                @include('proveedor.fields2')
                <input type="submit" class="btn btn-primary" form="store" value="Guardar" />
                <a class="btn btn-dark" href="{{route('proveedor.index')}}" >Cancelar</a>
            </form>
        @overwrite

        @include('layouts.card')
    @endpush








    @section('down_cards')
    
    @endsection

@endsection
