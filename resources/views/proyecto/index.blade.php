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
        Proyectos
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
                    <h4 class="card-title">Todos los Proyectos</h4>    
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
                </div>

                <!-- Row -->
                <div class="e-panel card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class='table table-bordered data-table-global datatable' id='datatable'>
                                <thead>
                                    <tr>
                                        <th class="border-bottom-0 ">ID</th>
                                        <th>Nombre</th>
                                        <th>Centro de costo</th>
                                        <th>Estado</th>
                                        <th>Acción</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($proyectos as $proyecto)
                                        <tr>
                                            <td>{{$proyecto->id}}</td>
                                            <td>{{$proyecto->nombre}}</td>
                                            <td>{{$proyecto->centro_costo}}</td>
                                            <td>{{$proyecto->estado}}</td>
                                            
                                            <td>
                                                <div class="btn-group" role="group">
                                                    <a  class="btn btn-danger disabled" id="delete" onClick="alert('El proyecto ha sido eliminado.')" href="{!! route('proyecto.destroy') !!}"><i class='fa fa-ban'></i>  Eliminar</a>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach                                                           
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- End Row -->
            </div>
        </div>

        @overwrite
        @include('layouts.card')
    @endpush

    

@endsection

@section('scripts')

    <script src="{{ asset('dropify/js/dropify.js' )}}"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            $('.dropify').dropify();
        });
    </script>
    <script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
    <link href="https://nightly.datatables.net/css/jquery.dataTables.css" rel="stylesheet" type="text/css" />
    <script src="https://nightly.datatables.net/js/jquery.dataTables.js"></script>
@endsection
