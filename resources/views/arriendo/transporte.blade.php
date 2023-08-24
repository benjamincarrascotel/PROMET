@extends('layouts.app-guest') 

@section('content')
    <div class="page" style="max-width:90%; margin-right:2%; padding: 1em;">
        <div class="page-content">
            @section('card_title')
                <h1 class="card-title" style="width: 100%">
                    Gestión para transporte
                </h1>
                <img src="{{asset('assets/images/brand/LogoMOS.png')}}" class="header-brand-img desktop-lgo" style="margin-left:60%; width:30%; " alt="CEMIN logo">

            @overwrite
                
            @section('card_content')
                <!-- Row -->
                <div class="row flex-lg-nowrap">
                    <div class="col-12">
                        <div class="row flex-lg-nowrap">
                            <div class="col-12 mb-3">
                                <div class="e-panel card">
                                    <div class="card-body">


                                        @if(isset($redirected))
                                            <p class="alert alert-success mt-4">{{ $redirected }}</p>
                                        @endif



                                        <div class="e-table">
                                            <div class="table-responsive table-lg mt-3">
                                                <table class="table table-bordered border-top text-nowrap">
                                                    <thead>
                                                        <tr>
                                                            <th class="align-top border-bottom-0">ID</th>
                                                            <th class="border-bottom-0">Elemento</th>
                                                            <th class="border-bottom-0">Código Interno</th>
                                                            <th class="border-bottom-0">Estado Arriendo</th>
                                                            <th class="border-bottom-0">Acciones</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($arriendos as $arriendo)
                                                            <tr>
                                                                <td class="align-middle"><span>{{$arriendo->activo->id}}</span></td>
                                                                <td class="align-middle">
                                                                    <div class="d-flex align-items-center"> <!-- Adjusted here -->
                                                                        @if($arriendo->activo->foto)
                                                                        <span class="avatar brround avatar-xxl d-block" style="background-image: url({{Storage::url('activos/'.$arriendo->activo->id."/".$arriendo->activo->foto)}})"></span>
                                                                        @else
                                                                            <span class="avatar brround avatar-xxl d-block" style="background-image: url({{asset('assets/images/brand/favicon1.png')}})"></span>
                                                                        @endif                                                                          <div class="ms-3"> <!-- Adjusted here -->
                                                                            <h6 class="mb-0 font-weight-bold">{{$arriendo->activo->marca." - ".$arriendo->activo->modelo." - ".$arriendo->activo->año}}</h6>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                                <td class="align-middle"><span>{{$arriendo->activo->codigo_interno}}</span></td>
                                                                <td class="align-middle">

                                                                    <!-- State 1 -->
                                                                    @if($arriendo->estado == "BODEGA")
                                                                    <h6 class="mb-0 font-weight-bold">BODEGA</h6>
                                                                    @elseif($arriendo->estado == "EN CAMINO IDA")
                                                                    <!-- State 2 -->
                                                                    <h6 class="mb-0 font-weight-bold">EN CAMINO IDA</h6>
                                                                    @elseif($arriendo->estado == "EN CLIENTE")
                                                                    <!-- State 3 -->
                                                                    <h6 class="mb-0 font-weight-bold">
                                                                        EN CLIENTE 
                                                                        @if($arriendo->activo->estado == "PARA RETIRO")
                                                                        (PARA RETIRO)
                                                                        @endif
                                                                    </h6>
                                                                    @elseif($arriendo->estado == "EN CAMINO VUELTA")
                                                                    <!-- State 4 -->
                                                                    <h6 class="mb-0 font-weight-bold">EN CAMINO VUELTA</h6>
                                                                    @elseif($arriendo->estado == "BODEGA DE VUELTA")
                                                                    <!-- State 5 -->
                                                                    <h6 class="mb-0 font-weight-bold">BODEGA DE VUELTA</h6>
                                                                    @endif

                                                                </td>

                                                                
                                                                <form method="GET" action="{{ route('arriendo.cambio_fase_create', [$arriendo->activo->id]) }}">
                                                                    <td class="align-middle">
                                                                        <!-- State 1 -->
                                                                        @if($arriendo->estado == "BODEGA")
                                                                        <button class="btn btn-sm btn-primary me-2" type="submit" data-bs-toggle="" data-bs-target="#user-form-modal">Cambiar de fase</button>
                                                                        <!-- State 2 -->
                                                                        @elseif($arriendo->estado == "EN CAMINO IDA")
                                                                        <button class="btn btn-sm btn-primary me-2" type="submit" data-bs-toggle="" data-bs-target="#user-form-modal">Cambiar de fase</button>
                                                                        <!-- State 3 -->
                                                                        @elseif($arriendo->estado == "EN CLIENTE" && $arriendo->activo->estado == "PARA RETIRO")
                                                                        <button class="btn btn-sm btn-primary me-2" type="submit" data-bs-toggle="" data-bs-target="#user-form-modal">Cambiar de fase</button>
                                                                        <!-- State 4 -->
                                                                        @elseif($arriendo->estado == "EN CAMINO VUELTA")
                                                                        <button class="btn btn-sm btn-primary me-2" type="submit" data-bs-toggle="" data-bs-target="#user-form-modal">Cambiar de fase</button>
                                                                        @else
                                                                        <h6 class="mb-0 font-weight-bold">(ESPERANDO CONFIRMACIÓN)</h6>
                                                                        @endif

                                                                    </td>
                                                                </form>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- End Row -->
            @overwrite
        
            @include('layouts.card')

        </div>
    </div>

@endsection('content')
