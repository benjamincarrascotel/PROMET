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
    
</style>

@section('content')

    @section('title')
    &nbsp;
    <h3>
        Catálogo
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
                    <h4 class="card-title">Todos los Activos</h4>    
                    <div class="btn-list flex-end">
                        <a class="btn btn-success btn-svgs btn-svg-white" href="{{url('/activo/create')}}">
                            <svg class="svg-icon" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24">
                                <path d="M0 0h24v24H0V0z" fill="none"></path>
                                <path d="M13 4H6v16h12V9h-5V4zm3 14H8v-2h8v2zm0-6v2H8v-2h8z" opacity=".3"></path>
                                <path d="M8 16h8v2H8zm0-4h8v2H8zm6-10H6c-1.1 0-2 .9-2 2v16c0 1.1.89 2 1.99 2H18c1.1 0 2-.9 2-2V8l-6-6zm4 18H6V4h7v5h5v11z"></path>
                            </svg>                                
                            <span class="btn-svg-text mt-1">Crear Activo</span>
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
                                        <th class="border-bottom-0 ">Elemento</th>
                                        <th class="border-bottom-0 ">Clasificación</th>
                                        <th class="border-bottom-0 ">Código Interno</th>
                                        <th class="border-bottom-0 " >Número De Serie</th>
                                        <th class="border-bottom-0 ">Horas De Uso Promedio</th>
                                        <th class="border-bottom-0 ">Acciones</th>
                                        <th class="border-bottom-0 ">Código QR</th>
                                        <th class="border-bottom-0 ">Mantención</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($activos as $activo)
                                        <tr>
                                            <td class="text-nowrap align-middle"><span>{{$activo->id}}</span></td>
                                            <td class="align-middle">
                                                <div class="d-flex">
                                                    @if($activo->foto)
                                                        @if($activo->estado != "DISPONIBLE")
                                                        <span class="avatar brround avatar-xxl d-block blurred-img" style="background-image: url({{Storage::url('activos/'.$activo->id."/".$activo->foto)}})"></span>
                                                        @else
                                                        <span class="avatar brround avatar-xxl d-block" style="background-image: url({{Storage::url('activos/'.$activo->id."/".$activo->foto)}})"></span>
                                                        @endif
                                                    @else
                                                        <span class="avatar brround avatar-xxl d-block" style="background-image: url({{asset('assets/images/brand/favicon1.png')}})"></span>
                                                    @endif
                                                    <div class="ms-3 mt-5">
                                                        <h6 class="mb-0 font-weight-bold mt-2">{{$activo->marca." - ".$activo->modelo." - ".$activo->año}}</h6>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="text-nowrap align-middle"><span>{{$activo->clasificacion}}</span></td>
                                            <td class="text-nowrap align-middle"><span>{{$activo->codigo_interno}}</span></td>
                                            <td class="text-nowrap align-middle"><span>{{$activo->numero_serie}}</span></td>
                                            <td class="text-nowrap align-middle"><span>{{$activo->horas_uso_promedio." [horas]"}}</span></td>
                                            <td class="align-middle text-center">
                                                <a class="btn btn-sm btn-primary" type="button" href="{{route('activo.show', [$activo->id])}}">Ver</a>
                                                <button class="btn btn-sm btn-danger" type="button"><i class="fe fe-trash-2"></i></button>
                                            </td>
                                            <td class="align-middle text-center">
                                                <a download href="{{ Storage::url('activos/'.$activo->id."/QR_CODE.svg") }}">
                                                    <button class="btn btn-sm btn-success" type="button" data-bs-toggle="" data-bs-target="#user-form-modal">
                                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" aria-labelledby="qrIconTitle" stroke="#000" stroke-linecap="square" color="#000"><path d="M10 3v7H3V3z"/><path d="M7 6H6v1h1zm3 8v7H3v-7z"/><path d="M6 17h1v1H6zm8 3h1v1h-1zm3-3h1v1h-1zm-3-3h1v1h-1zm6 3h1v1h-1zm0-3h1v1h-1zm0 6h1v1h-1zm1-17v7h-7V3z"/><path d="M17 6h1v1h-1z"/></svg>                                                                   
                                                </a>
                                            </td>
                                            @if($activo->estado == "DISPONIBLE")
                                                <td class="align-middle text-center">
                                                    <a href="{{ route('mantencion.create', [$activo->id]) }}">
                                                        <button id="iniciar_mantencion" class="btn btn-sm btn-success" type="button" data-bs-toggle="" data-bs-target="#user-form-modal">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 512 512" xml:space="preserve"><path d="m360.102 240.012 10.156-10.266s15.609-13.406 33.406-7.328c30.984 10.578 66.781-.875 91.609-25.734 7.063-7.063 15.641-21.234 15.641-21.234a5.596 5.596 0 0 0 .922-4.672l-1.922-7.906a5.671 5.671 0 0 0-2.625-3.531 5.566 5.566 0 0 0-4.344-.547l-60.984 16.969a5.648 5.648 0 0 1-6.063-2.109l-28.015-38.594a5.564 5.564 0 0 1-1.016-4.063l5.641-41a5.595 5.595 0 0 1 4.063-4.656l64.406-17.922c2.906-.813 4.672-3.813 3.953-6.766l-2.547-10.359a5.61 5.61 0 0 0-2.563-3.5s-5.047-3.344-8.719-5.234c-36.578-18.891-82.64-13.031-113.312 17.656-22.656 22.656-31.531 53.688-27.375 83.156 3.203 22.656 1.703 34.703-8.078 45.047-.891.922-3.703 3.734-8.047 8l45.813 44.593zm-148.719 55.406A183455.446 183455.446 0 0 1 68.461 433.715a13.135 13.135 0 0 0-4.047 9.313 13.092 13.092 0 0 0 3.813 9.375l31.938 31.938a13.071 13.071 0 0 0 9.391 3.813 13.018 13.018 0 0 0 9.281-4.031L258.165 343.17l-46.782-47.752zM501.43 451.371a13.008 13.008 0 0 0 3.813-9.375c-.031-3.516-1.5-6.859-4.031-9.297L227.415 166.246l-43.953 43.969L450.805 483.09c2.438 2.547 5.781 4 9.297 4.047s6.891-1.344 9.391-3.828l31.937-31.938zM254.196 32.621c-32.969-12.859-86.281-14.719-117.156 16.141a472188.334 472188.334 0 0 0-59.875 59.891c-12.672 12.656-.906 25.219-10.266 34.563-9.359 9.359-24.313 0-32.734 8.422L3.29 182.527c-4.391 4.375-4.391 11.5 0 15.891l43.016 43.016c4.391 4.391 11.516 4.391 15.906 0l30.875-30.875c8.438-8.422-.938-23.375 8.438-32.719 12.609-12.625 26.375-10.484 34.328-2.547l15.891 15.891 17.219 4.531 43.953-43.953-5.063-16.688c-14.016-14.031-16.016-30.266-7.234-39.047 13.594-13.594 36.047-33.234 57.078-41.656 13.405-5.359 9.358-18.703-3.501-21.75zm-59.625 70.859c-.063.047 5.859-7.281 5.969-7.375l-5.969 7.375z" style="fill:#000"/></svg>                                                                    
                                                        <h6 class="mb-0 font-weight-bold mt-2">Iniciar</h6>
                                                    </a>
                                                </td>
                                            @elseif($activo->estado == "EN MANTENCION")
                                                <td class="align-middle text-center">
                                                        <button id="terminar_mantencion" class="btn btn-sm btn-warning" type="button" data-bs-toggle="modal" data-bs-target="#terminarMantencionModal">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 512 512" xml:space="preserve"><path d="m360.102 240.012 10.156-10.266s15.609-13.406 33.406-7.328c30.984 10.578 66.781-.875 91.609-25.734 7.063-7.063 15.641-21.234 15.641-21.234a5.596 5.596 0 0 0 .922-4.672l-1.922-7.906a5.671 5.671 0 0 0-2.625-3.531 5.566 5.566 0 0 0-4.344-.547l-60.984 16.969a5.648 5.648 0 0 1-6.063-2.109l-28.015-38.594a5.564 5.564 0 0 1-1.016-4.063l5.641-41a5.595 5.595 0 0 1 4.063-4.656l64.406-17.922c2.906-.813 4.672-3.813 3.953-6.766l-2.547-10.359a5.61 5.61 0 0 0-2.563-3.5s-5.047-3.344-8.719-5.234c-36.578-18.891-82.64-13.031-113.312 17.656-22.656 22.656-31.531 53.688-27.375 83.156 3.203 22.656 1.703 34.703-8.078 45.047-.891.922-3.703 3.734-8.047 8l45.813 44.593zm-148.719 55.406A183455.446 183455.446 0 0 1 68.461 433.715a13.135 13.135 0 0 0-4.047 9.313 13.092 13.092 0 0 0 3.813 9.375l31.938 31.938a13.071 13.071 0 0 0 9.391 3.813 13.018 13.018 0 0 0 9.281-4.031L258.165 343.17l-46.782-47.752zM501.43 451.371a13.008 13.008 0 0 0 3.813-9.375c-.031-3.516-1.5-6.859-4.031-9.297L227.415 166.246l-43.953 43.969L450.805 483.09c2.438 2.547 5.781 4 9.297 4.047s6.891-1.344 9.391-3.828l31.937-31.938zM254.196 32.621c-32.969-12.859-86.281-14.719-117.156 16.141a472188.334 472188.334 0 0 0-59.875 59.891c-12.672 12.656-.906 25.219-10.266 34.563-9.359 9.359-24.313 0-32.734 8.422L3.29 182.527c-4.391 4.375-4.391 11.5 0 15.891l43.016 43.016c4.391 4.391 11.516 4.391 15.906 0l30.875-30.875c8.438-8.422-.938-23.375 8.438-32.719 12.609-12.625 26.375-10.484 34.328-2.547l15.891 15.891 17.219 4.531 43.953-43.953-5.063-16.688c-14.016-14.031-16.016-30.266-7.234-39.047 13.594-13.594 36.047-33.234 57.078-41.656 13.405-5.359 9.358-18.703-3.501-21.75zm-59.625 70.859c-.063.047 5.859-7.281 5.969-7.375l-5.969 7.375z" style="fill:#000"/></svg>                                                                    
                                                        <h6 class="mb-0 font-weight-bold mt-2">Terminar</h6>
                                                </td>
                                            @else
                                                <td class="align-middle text-center">
                                                    <a href="#">
                                                        <button disabled class="btn btn-sm btn-success" type="button" data-bs-toggle="" data-bs-target="#user-form-modal">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 512 512" xml:space="preserve"><path d="m360.102 240.012 10.156-10.266s15.609-13.406 33.406-7.328c30.984 10.578 66.781-.875 91.609-25.734 7.063-7.063 15.641-21.234 15.641-21.234a5.596 5.596 0 0 0 .922-4.672l-1.922-7.906a5.671 5.671 0 0 0-2.625-3.531 5.566 5.566 0 0 0-4.344-.547l-60.984 16.969a5.648 5.648 0 0 1-6.063-2.109l-28.015-38.594a5.564 5.564 0 0 1-1.016-4.063l5.641-41a5.595 5.595 0 0 1 4.063-4.656l64.406-17.922c2.906-.813 4.672-3.813 3.953-6.766l-2.547-10.359a5.61 5.61 0 0 0-2.563-3.5s-5.047-3.344-8.719-5.234c-36.578-18.891-82.64-13.031-113.312 17.656-22.656 22.656-31.531 53.688-27.375 83.156 3.203 22.656 1.703 34.703-8.078 45.047-.891.922-3.703 3.734-8.047 8l45.813 44.593zm-148.719 55.406A183455.446 183455.446 0 0 1 68.461 433.715a13.135 13.135 0 0 0-4.047 9.313 13.092 13.092 0 0 0 3.813 9.375l31.938 31.938a13.071 13.071 0 0 0 9.391 3.813 13.018 13.018 0 0 0 9.281-4.031L258.165 343.17l-46.782-47.752zM501.43 451.371a13.008 13.008 0 0 0 3.813-9.375c-.031-3.516-1.5-6.859-4.031-9.297L227.415 166.246l-43.953 43.969L450.805 483.09c2.438 2.547 5.781 4 9.297 4.047s6.891-1.344 9.391-3.828l31.937-31.938zM254.196 32.621c-32.969-12.859-86.281-14.719-117.156 16.141a472188.334 472188.334 0 0 0-59.875 59.891c-12.672 12.656-.906 25.219-10.266 34.563-9.359 9.359-24.313 0-32.734 8.422L3.29 182.527c-4.391 4.375-4.391 11.5 0 15.891l43.016 43.016c4.391 4.391 11.516 4.391 15.906 0l30.875-30.875c8.438-8.422-.938-23.375 8.438-32.719 12.609-12.625 26.375-10.484 34.328-2.547l15.891 15.891 17.219 4.531 43.953-43.953-5.063-16.688c-14.016-14.031-16.016-30.266-7.234-39.047 13.594-13.594 36.047-33.234 57.078-41.656 13.405-5.359 9.358-18.703-3.501-21.75zm-59.625 70.859c-.063.047 5.859-7.281 5.969-7.375l-5.969 7.375z" style="fill:#000"/></svg>                                                                    
                                                        <h6 class="mb-0 font-weight-bold mt-2">Iniciar</h6>

                                                    </a>
                                                </td>
                                            @endif
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


        <!-- Agrega este código al final de tu vista Blade para crear el modal -->
        <div class="modal fade" id="terminarMantencionModal" tabindex="-1" aria-labelledby="terminarMantencionModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form action="{{ route('mantencion.finish') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input hidden name="activo_id" id="activo_id" type="text" value="{{$activo->id}}">
                        <div class="modal-header">
                            <h5 class="modal-title" id="terminarMantencionModalLabel">Terminar Mantención</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="documento" class="form-label">Documento</label>
                                <input type="file" class="dropify" id="documento" name="documento">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Terminar Mantención</button>
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

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




        @overwrite
        @include('layouts.card')
    @endpush



    <script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
    <link href="https://nightly.datatables.net/css/jquery.dataTables.css" rel="stylesheet" type="text/css" />
    <script src="https://nightly.datatables.net/js/jquery.dataTables.js"></script>

@endsection
