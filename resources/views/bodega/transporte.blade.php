@extends('layouts.app')

<style>
    .flex-end {
        display: block;
        margin-left: auto;
        margin-right: 0;
      }

    .blurred-img {
        opacity: 0.5;    
    }
    /* Add rounded corners to the table container */
    .table-responsive {
        border-radius: 10px; /* Adjust the radius as needed */
        overflow: hidden; /* Hide the overflowing content */
    }

    /* Style the table with borders and rounded corners */
    .table-bordered {
        border-radius: 10px; /* Adjust the radius as needed */
    }

    a.disabled {
        pointer-events: none;
        cursor: default;
    }
    
</style>

@section('content')

    @section('title')
    &nbsp;
    <h3>
        Gestión de Transporte
    </h3>
    &nbsp;
    @endsection

    @push('cards')
        @section('card_title')
            Información
        @overwrite
            
        @section('card_content')

        <div class="row">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Todos los Arriendos</h4>    
                    <!--
                    <div class="btn-list flex-end">
                        <a class="btn btn-success btn-svgs btn-svg-white" href="{{url('/proyecto/create')}}">
                            <svg class="svg-icon" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24">
                                <path d="M0 0h24v24H0V0z" fill="none"></path>
                                <path d="M13 4H6v16h12V9h-5V4zm3 14H8v-2h8v2zm0-6v2H8v-2h8z" opacity=".3"></path>
                                <path d="M8 16h8v2H8zm0-4h8v2H8zm6-10H6c-1.1 0-2 .9-2 2v16c0 1.1.89 2 1.99 2H18c1.1 0 2-.9 2-2V8l-6-6zm4 18H6V4h7v5h5v11z"></path>
                            </svg>                                
                            <span class="btn-svg-text mt-1">Crear Proyecto</span>
                        </a>
                    </div>
                    -->
                </div>

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
                                                                <p class="fs-14 font-weight-bold">Fecha Inicio :</p>
                                                                <p class="mt-2 text-muted ">{{Carbon\Carbon::parse($arriendo->fecha_inicio)->format('d-m-Y')}}</p>
                                                            </div>
                                                            <div class="wrapper">
                                                                <p class="fs-14 font-weight-bold">Fecha Término :</p>
                                                                <p class="mt-2 text-muted ">{{Carbon\Carbon::parse($arriendo->fecha_termino)->format('d-m-Y')}}</p>
                                                            </div>
                                                            <div class="text-white text-center">
                                                                <form method="GET" action="{{ route('arriendo.qr_reader', [$arriendo->activo->id]) }}">
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

            </div>
        </div>

        @overwrite
        @include('layouts.card')
    @endpush

    

@endsection

@section('scripts')
    <script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
    <link href="https://nightly.datatables.net/css/jquery.dataTables.css" rel="stylesheet" type="text/css" />
    <script src="https://nightly.datatables.net/js/jquery.dataTables.js"></script>
@endsection