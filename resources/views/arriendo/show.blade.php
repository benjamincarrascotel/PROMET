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
                                    <input class="form-control" id="fecha_inicio" name="fecha_inicio" placeholder="Ingrese la fecha de inicio" required="" type="date" value="{{$arriendo->fecha_inicio}}" >
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
                                    <input class="form-control" id="fecha_termino" name="fecha_termino" placeholder="Ingrese la fecha de término" required="" type="date" value="{{$arriendo->fecha_termino}}">
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