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
                                <h5 class="description-header mb-1 font-weight-bold  number-font">{{$n_arriendos}}</h5>
                                <span class="text-muted">Total de Arriendos del Activo</span>
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
                        </div>
                        <div class="card-title font-weight-bold mt-5">DATOS FINANCIEROS:</div>
                        <div class="row">
                            <div class="col-sm-6 col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Precio de compra</label>
                                    <input type="number" id="precio_compra" name="precio_compra" min="0" class="form-control" required="" value="{{$activo->precio_compra}}">
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
                                    <input type="number" id="valor_residual" name="valor_residual" min="0" max="100" class="form-control" required="" value="{{$activo->valor_residual}}">
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
                    </form>
                </div>
                <div class="card-footer text-end">
                    <input type="submit" form="myform" class="btn  btn-success" value="Actualizar Información" />
                    <a href="{{route('activo.index')}}" class="btn btn-danger">Cancel</a>
                </div>
            </div>
        </div>
    </div>
    <!-- End Row-->

    

@endsection('content')

@section('scripts')

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