@extends('layouts.app-guest') 

@section('content')
    <div class="page" style="max-width:90%; margin-right:2%; padding: 1em;">
        <div class="page-content">
            <!-- LOGO -->
            <div class="container">
                <div class="row">
                    <div class="col mx-auto">
                        <div class="row justify-content-center">
                            <div class="col-sm-12 col-xs-12 ">
                                <div class="text-center mb-5 mt-0">
                                    <img src="{{asset('assets/images/brand/LogoMOS.png')}}" alt="MOS logo">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- LOGO -->

            @section('card_title')
                <h1 class="card-title" style="width: 100%">
                    Gestión para transporte
                </h1>
            @overwrite
                
            @section('card_content')

                <!-- Row -->
                <div class="row flex-lg-nowrap">
                    <div class="col-12">
                        <div class="row flex-lg-nowrap">
                            <div class="col-12 mb-3">
                                <div class="">
                                    <div class="">
                                        <div class="row">
                                            <div class="col-6 mb-4">

                                            </div>
                                        </div>
                                        <div class="row">
                                            @foreach ($arriendos as $arriendo)
                                            <div class="col-xl-3 col-lg-6">
                                                <div class="card text-start user-contact-list">
                                                    <div class="">
                                                        <div class="card-header border-bottom text-white p-5" style="background: linear-gradient(135deg, rgb(241, 196, 111) 60%, rgb(214, 87, 2));">
                                                            @if($arriendo->activo->foto)
                                                                    <span class="avatar brround avatar-xxl d-block" style="background-image: url({{Storage::url('activos/'.$arriendo->activo->id."/".$arriendo->activo->foto)}})"></span>
                                                                @else
                                                                    <span class="avatar brround avatar-xxl d-block" style="background-image: url({{asset('assets/images/brand/favicon1.png')}})"></span>
                                                                @endif 
                                                            <div class=" ms-3 text-white">
                                                                <p class="mb-0 mt-1 fs-18 font-weight-semibold">{{$arriendo->activo->marca}}<br>{{$arriendo->activo->modelo}}<br>{{$arriendo->activo->año}}</p>

                                                                <small class="">ID ARRIENDO: {{$arriendo->id}}</small>
                                                            </div>
                                                        </div>
                                                        <div class="p-5">
                                                            <div class="wrapper">
                                                                <p class="fs-14 font-weight-bold">ESTADO ARRIENDO :</p>
                                                                <!-- State 1 -->
                                                                @if($arriendo->estado == "BODEGA")
                                                                <p class="mt-2 text-info ">BODEGA</p>
                                                                @elseif($arriendo->estado == "EN CAMINO IDA")
                                                                <!-- State 2 -->
                                                                <p class="mt-2 text-info ">EN CAMINO IDA</p>
                                                                @elseif($arriendo->estado == "EN CLIENTE")
                                                                <!-- State 3 -->
                                                                <p class="mt-2 text-info ">
                                                                    EN CLIENTE 
                                                                    @if($arriendo->activo->estado == "PARA RETIRO")
                                                                    (PARA RETIRO)
                                                                    @endif
                                                                </p>
                                                                @elseif($arriendo->estado == "EN CAMINO VUELTA")
                                                                <!-- State 4 -->
                                                                <p class="mt-2 text-info ">EN CAMINO VUELTA</p>
                                                                @elseif($arriendo->estado == "BODEGA DE VUELTA")
                                                                <!-- State 5 -->
                                                                <p class="mt-2 text-info ">BODEGA DE VUELTA</p>
                                                                @endif
                                                            </div>

                                                            <div class="wrapper">
                                                                <p class="fs-14 font-weight-bold">Código Interno (Activo) :</p>
                                                                <p class="mt-2 text-muted ">{{$arriendo->activo->codigo_interno}}</p>
                                                            </div>

                                                            <div class="wrapper">
                                                                <p class="fs-14 font-weight-bold">Clasificación :</p>
                                                                <p class="mt-2 text-muted ">{{$arriendo->activo->clasificacion}}</p>
                                                            </div>
                                                            <div class="text-white text-center">
                                                                <form method="GET" action="{{ route('arriendo.cambio_fase_create', [$arriendo->activo->id]) }}">
                                                                    <td class="align-middle">
                                                                        <!-- State 1 -->
                                                                        @if($arriendo->estado == "BODEGA")
                                                                            <button class="btn btn-xl btn-success me-2" type="submit" data-bs-toggle="" data-bs-target="#user-form-modal">Cambiar de fase</button>
                                                                        <!-- State 2 -->
                                                                        @elseif($arriendo->estado == "EN CAMINO IDA")
                                                                            <button class="btn btn-xl btn-success me-2" type="submit" data-bs-toggle="" data-bs-target="#user-form-modal">Cambiar de fase</button>
                                                                        <!-- State 3 -->
                                                                        @elseif($arriendo->estado == "EN CLIENTE" && $arriendo->activo->estado == "PARA RETIRO")
                                                                            <button class="btn btn-xl btn-success me-2" type="submit" data-bs-toggle="" data-bs-target="#user-form-modal">Cambiar de fase</button>
                                                                        <!-- State 4 -->
                                                                        @elseif($arriendo->estado == "EN CAMINO VUELTA")
                                                                            <button class="btn btn-xl btn-success me-2" type="submit" data-bs-toggle="" data-bs-target="#user-form-modal">Cambiar de fase</button>
                                                                        @else
                                                                            <button disabled class="btn btn-xl btn-warning me-2" type="submit" data-bs-toggle="" data-bs-target="#user-form-modal">(ESPERANDO CONFIRMACIÓN)</button>
                                                                        @endif

                                                                    </td>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @overwrite
        
            @include('layouts.card')

        </div>
    </div>

@endsection('content')
