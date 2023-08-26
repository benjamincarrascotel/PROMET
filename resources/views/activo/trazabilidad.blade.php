@extends('layouts.app')

<style>
    .flex-end {
        display: block;
        margin-left: auto;
        margin-right: 0;
      }

    table, th, td {
        border: 1px solid black;
        border-collapse: collapse;
    }
    table{
        width: 100%;
    }
</style>

@section('content')

    @section('title')
    &nbsp;
    <h3>
        Trazabilidad de Arriendos
    </h3>
    &nbsp;
    @endsection

    @push('cards')
        @section('card_title')
            Arriendo de Activos
        @overwrite
        
        @section('card_content')

        <div class="row">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Estado de Activos</h4>    
                    <div class="btn-list flex-end">
                        <a class="btn btn-success btn-svgs btn-svg-white" href="{{url('/arriendo/create')}}">
                            <svg class="svg-icon" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24">
                                <path d="M0 0h24v24H0V0z" fill="none"></path>
                                <path d="M13 4H6v16h12V9h-5V4zm3 14H8v-2h8v2zm0-6v2H8v-2h8z" opacity=".3"></path>
                                <path d="M8 16h8v2H8zm0-4h8v2H8zm6-10H6c-1.1 0-2 .9-2 2v16c0 1.1.89 2 1.99 2H18c1.1 0 2-.9 2-2V8l-6-6zm4 18H6V4h7v5h5v11z"></path>
                            </svg>                                
                            <span class="btn-svg-text mt-1">Ingresar Arriendo</span>
                        </a>
                    </div>
                </div>

                <!-- Row -->
                <div class="row flex-lg-nowrap">
                    <div class="col-12">
                        <div class="row flex-lg-nowrap">
                            <div class="col-12 mb-3">
                                <div class="e-panel card">
                                    <div class="card-body">
                                        <div class="e-table">
                                            <div class="table-responsive table-lg mt-3">
                                                <table class="table table-bordered border-top text-nowrap">
                                                    <thead>
                                                        <tr>
                                                            <th class="align-top border-bottom-0">ID Arriendo</th>
                                                            <th class="border-bottom-0">Activo</th>
                                                            <th class="border-bottom-0">Código Interno</th>
                                                            <th class="border-bottom-0">Estado Arriendo</th>
                                                            <th class="border-bottom-0">Fecha Inicio</th>
                                                            <th class="border-bottom-0">Fecha Término</th>
                                                            <th class="border-bottom-0">Acciones</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @if($arriendos)
                                                            @foreach ($arriendos as $arriendo)
                                                                <tr>
                                                                    <td class="align-middle"><span>{{$arriendo->id}}</span></td>
                                                                    <td class="align-middle">
                                                                        <div class="d-flex align-items-center"> <!-- Adjusted here -->
                                                                            @if($arriendo->activo->foto)
                                                                                <span class="avatar brround avatar-xxl d-block" style="background-image: url({{Storage::url('activos/'.$arriendo->activo->id."/".$arriendo->activo->foto)}})"></span>
                                                                            @else
                                                                                <span class="avatar brround avatar-xxl d-block" style="background-image: url({{asset('assets/images/brand/favicon1.png')}})"></span>
                                                                            @endif                                                                        
                                                                            <div class="ms-3"> <!-- Adjusted here -->
                                                                                <h6 class="mb-0 font-weight-bold">{{$arriendo->activo->marca." - ".$arriendo->activo->modelo." - ".$arriendo->activo->año}}</h6>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                    <td class="align-middle"><span>{{$arriendo->activo->codigo_interno}}</span></td>
                                                                    <td class="align-middle">
                                                                        <!-- State 1 -->
                                                                        @if($arriendo->estado == "BODEGA")
                                                                        <img src="{{ asset('assets/images/arriendo/state1.svg') }}" alt="State 1">
                                                                        @elseif($arriendo->estado == "EN CAMINO IDA")
                                                                        <!-- State 2 -->
                                                                        <img src="{{ asset('assets/images/arriendo/state2.svg') }}" alt="State 2">
                                                                        @elseif($arriendo->estado == "EN CLIENTE")
                                                                        <!-- State 3 -->
                                                                        <img src="{{ asset('assets/images/arriendo/state3.svg') }}" alt="State 3">
                                                                        @elseif($arriendo->estado == "EN CAMINO VUELTA")
                                                                        <!-- State 4 -->
                                                                        <img src="{{ asset('assets/images/arriendo/state4.svg') }}" alt="State 4">
                                                                        @elseif($arriendo->estado == "BODEGA DE VUELTA")
                                                                        <!-- State 5 -->
                                                                        <img src="{{ asset('assets/images/arriendo/state5.svg') }}" alt="State 5">
                                                                        @else
                                                                        <h6 class="mb-0 font-weight-bold">TERMINADO</h6>
                                                                        @endif

                                                                    </td>
                                                                    <td>
                                                                        <div class="wrapper">
                                                                            <p class="mt-2 text-muted ">{{Carbon\Carbon::parse($arriendo->fecha_termino)->format('d-m-Y')}}</p>
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="wrapper">
                                                                            <p class="mt-2 text-muted ">{{Carbon\Carbon::parse($arriendo->fecha_termino)->format('d-m-Y')}}</p>
                                                                        </div>
                                                                    </td>
                                                                    <td class="align-middle">
                                                                        <div class="d-flex"> <!-- Adjusted here -->
                                                                            <form method="POST" action="{{ route('arriendo.cambio_fase') }}">
                                                                                <button class="btn btn-sm btn-primary me-2" type="button" data-bs-toggle="" data-bs-target="#user-form-modal">Ver</button>
                                                                                @csrf
                                                                                <input hidden type="integer" id="arriendo_id" name="arriendo_id" value="{{$arriendo->id}}">
                                                                                @if($arriendo->estado == "EN CLIENTE" && $arriendo->activo->estado == "ARRENDADO")
                                                                                    <button class="btn btn-sm btn-success me-2" type="submit"><i class="fe fe-check-square"></i> Disponibilizar para retiro </button>
                                                                                @elseif($arriendo->estado == "BODEGA DE VUELTA")
                                                                                    <button class="btn btn-sm btn-success me-2" type="submit" data-bs-toggle="" data-bs-target="#user-form-modal">Confirmación FINAL</button>
                                                                                @endif
                                                                                
                                                                                <button class="btn btn-sm btn-danger" type="button"><i class="fe fe-trash-2"></i></button>
                                                                            </form>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                        @endif
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
            </div>
        </div>



        @overwrite
        @include('layouts.card')
    @endpush

    <script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
    <link href="https://nightly.datatables.net/css/jquery.dataTables.css" rel="stylesheet" type="text/css" />
    <script src="https://nightly.datatables.net/js/jquery.dataTables.js"></script>

@endsection
