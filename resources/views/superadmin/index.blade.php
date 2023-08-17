@extends('layouts.app')

@section('content')

    @section('title')
    &nbsp;
    <h3>
        Bienvenido {{auth()->user()->name}}
    </h3>
    &nbsp;
    @endsection

    @push('cards')
    @section('card_title')
        Conteo de Licitaciones
        <!--
        <span title="TOOL TIP DE AYUDA PARA ESTA TABLA.">
            <svg width="20px" height="20px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" clip-rule="evenodd" d="M2 7C2 4.23858 4.23858 2 7 2H17C19.7614 2 22 4.23858 22 7V17C22 19.7614 19.7614 22 17 22H7C4.23858 22 2 19.7614 2 17V7ZM7 4C5.34315 4 4 5.34315 4 7V17C4 18.6569 5.34315 20 7 20H17C18.6569 20 20 18.6569 20 17V7C20 5.34315 18.6569 4 17 4H7ZM12 7.5C10.5523 7.5 10 8.55229 10 9C10 9.55229 9.55228 10 9 10C8.44772 10 8 9.55229 8 9C8 7.44772 9.44771 5.5 12 5.5C13.1557 5.5 14.1702 5.78891 14.9085 6.43492C15.6643 7.09623 16 8.01748 16 9C16 10.1875 15.6945 11.0279 15.1178 11.6677C14.8502 11.9645 14.5539 12.1844 14.2896 12.3608C14.1648 12.4442 14.0375 12.524 13.9223 12.5962L13.9043 12.6075C13.7803 12.6853 13.6678 12.7561 13.5575 12.8302C13.2061 13.0662 13.0643 13.2421 13.0061 13.3563C12.9615 13.4436 12.9296 13.5614 12.9786 13.7942C13.0922 14.3347 12.7462 14.865 12.2058 14.9786C11.6653 15.0922 11.135 14.7462 11.0214 14.2058C10.8952 13.6054 10.938 13.0088 11.2247 12.4472C11.4975 11.9124 11.9434 11.505 12.4425 11.1698C12.5822 11.076 12.7197 10.9896 12.8418 10.9131L12.851 10.9073C12.9733 10.8306 13.0787 10.7646 13.1791 10.6975C13.3836 10.561 13.5248 10.4478 13.6322 10.3286C13.8055 10.1363 14 9.81253 14 9C14 8.48252 13.8357 8.15377 13.5915 7.94008C13.3298 7.71109 12.8443 7.5 12 7.5ZM12 15.7812C11.4477 15.7812 11 16.229 11 16.7812C11 17.3335 11.4477 17.7812 12 17.7812C12.5523 17.7812 13 17.3335 13 16.7812C13 16.229 12.5523 15.7812 12 15.7812Z" fill="black"/>
            </svg>
        </span>
        -->
    @overwrite
    
    @section('card_content')

    <div class="row">
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title" >A tiempo</h3>
                </div>
                <div class="card-body text-center">
                    <span class="avatar avatar-xl brround bg-success-transparent border-success text-success"><i class="p-3 las fa-hourglass-1"></i></span>
                    <h5 class="mt-4 text-muted"></h5>
                    <h2 class="counter text-success">{{$a_tiempo_sum}}</h2>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title"> Por Vencer</h3>
                </div>
                <div class="card-body text-center">
                    <span class="avatar avatar-xl brround bg-primary-transparent border-primary text-primary"><i class="p-3 las fa-hourglass-2"></i></span>
                    <h5 class="mt-4 text-muted"></h5>
                    <h2 class="counter text-primary">{{$por_vencer_sum}}</h2>
                </div>
            </div>
        </div>
        
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Retrasadas</h3>
                </div>
                <div class="card-body text-center">
                    <span class="avatar avatar-xl brround bg-danger-transparent border-danger text-danger"><i class="p-3 las fa-hourglass-3"></i></span>
                    <h5 class="mt-4 text-muted"></h5>
                    <h2 class="counter text-danger">{{$retrasadas_sum}}</h2>
                </div>
            </div>
        </div>
    </div>

    @overwrite
    @include('layouts.card')
@endpush

    @push('cards')
        @section('card_title')
            Todas las Licitaciones
            <!--
            <span title="TOOL TIP DE AYUDA PARA ESTA TABLA.">
                <svg width="20px" height="20px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M2 7C2 4.23858 4.23858 2 7 2H17C19.7614 2 22 4.23858 22 7V17C22 19.7614 19.7614 22 17 22H7C4.23858 22 2 19.7614 2 17V7ZM7 4C5.34315 4 4 5.34315 4 7V17C4 18.6569 5.34315 20 7 20H17C18.6569 20 20 18.6569 20 17V7C20 5.34315 18.6569 4 17 4H7ZM12 7.5C10.5523 7.5 10 8.55229 10 9C10 9.55229 9.55228 10 9 10C8.44772 10 8 9.55229 8 9C8 7.44772 9.44771 5.5 12 5.5C13.1557 5.5 14.1702 5.78891 14.9085 6.43492C15.6643 7.09623 16 8.01748 16 9C16 10.1875 15.6945 11.0279 15.1178 11.6677C14.8502 11.9645 14.5539 12.1844 14.2896 12.3608C14.1648 12.4442 14.0375 12.524 13.9223 12.5962L13.9043 12.6075C13.7803 12.6853 13.6678 12.7561 13.5575 12.8302C13.2061 13.0662 13.0643 13.2421 13.0061 13.3563C12.9615 13.4436 12.9296 13.5614 12.9786 13.7942C13.0922 14.3347 12.7462 14.865 12.2058 14.9786C11.6653 15.0922 11.135 14.7462 11.0214 14.2058C10.8952 13.6054 10.938 13.0088 11.2247 12.4472C11.4975 11.9124 11.9434 11.505 12.4425 11.1698C12.5822 11.076 12.7197 10.9896 12.8418 10.9131L12.851 10.9073C12.9733 10.8306 13.0787 10.7646 13.1791 10.6975C13.3836 10.561 13.5248 10.4478 13.6322 10.3286C13.8055 10.1363 14 9.81253 14 9C14 8.48252 13.8357 8.15377 13.5915 7.94008C13.3298 7.71109 12.8443 7.5 12 7.5ZM12 15.7812C11.4477 15.7812 11 16.229 11 16.7812C11 17.3335 11.4477 17.7812 12 17.7812C12.5523 17.7812 13 17.3335 13 16.7812C13 16.229 12.5523 15.7812 12 15.7812Z" fill="black"/>
                </svg>
            </span>
            -->
        @overwrite
        
        @section('card_content')
        <div class="table-responsive">
            <table class='table data-table-global datatable' id='datatable'>
                <thead>
                    <tr>
                        <th>Código SAP</th>
                        <th>Servicio / Bien</th>
                        <th>Proveedor</th>
                        <th>Faena</th>
                        <th>Administrador de Contrato</th>
                        <th>Estado licitación actual</th>
                        <th>Pasar a Siguiente Fase</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($contratos as $contrato)
                    <tr>
                        <td>{{$contrato->contrato_sap}}</td>
                        <td>{{$contrato->servicio_bien->nombre_servicio_bien}}</td>

                        <td>{{$contrato->proveedor->nombre}}</td>
                        <td>{{$contrato->faena->nombre_faena}}</td>
                        <td>{{$contrato->admin_contrato->nombre}}</td>
                        <td>{{$alertas_info[$contrato->id]['estado_actual']}}</td>

                        @if($contrato->estado_contrato != 15 && $contrato->estado_contrato != 16 && $contrato->estado_contrato != 17)
                            @if($alertas_info[$contrato->id]['semaforo'] == 0)
                                <td><span class="badge mt-2 fs-10 bg-success-transparent br-7 ms-auto">A TIEMPO</span></td>
                            @elseif($alertas_info[$contrato->id]['semaforo'] == 1)
                                <td><span class="badge mt-2 fs-10 bg-warning-transparent br-7 ms-auto">POR VENCER</span></td>
                            @else
                                <td><span class="badge mt-2 fs-10 bg-danger-transparent br-7 ms-auto">RETRASADO</span></td>
                            @endif
                        @elseif($contrato->estado_contrato != 16 && $contrato->estado_contrato != 17)
                            <td><span class="badge mt-2 fs-10 bg-info-transparent br-7 ms-auto">TERMINADA</span></td>
                        @elseif($contrato->estado_contrato != 17)
                            <td><span class="badge mt-2 fs-10 bg-info-transparent br-7 ms-auto">STAND BY</span></td>
                        @else
                            <td><span class="badge mt-2 fs-10 bg-info-transparent br-7 ms-auto">ADJUDICACIÓN DIRECTA</span></td>
                        @endif

                        <td>
                            <div class="btn-group" role="group">
                                <a class="btn btn-primary" href="{{route('contrato.show', [$contrato->id])}}" title="Mostrar Contrato"><i class='mt-1 fa fa-info'></i></a>
                                <button class="btn btn-danger" @if($alertas_info[$contrato->id]['semaforo'] == 0) disabled @endif href="javascript:void(0)" onclick="enviarAlerta({{$contrato->id}})" title="Enviar Alerta"><i class='fa fa-envelope'></i></button>
                                
        
                                {{-- <a class="btn btn-primary" href="{!! route('solicitud.edit', [$solicitud->id]) !!}"><i class='fas fa-edit'></i></a> --}}
                            </div>
                        </td>
                    </tr>
                    @endforeach
        
                </tbody>
            </table>
        </div>
        @overwrite
        @include('layouts.card')
    @endpush


    @section('down_cards')
    <!-- Botones
    <div class="row">
        <div class="col">
            <a href="" class='btn btn-primary'>Opción 1</a>
        </div>
    </div>
    -->
    @endsection

    <!-- Edit Category Modal -->
    <div class="modal fade" id="enviarAlertaModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="enviarAlertaModal_title">Enviar Correo Electrónico de Alerta</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="enviarAlertaForm" >
                        @csrf
                        <input type="hidden" id="id" name="id" />
                        <div>
                            <h4 id="enviarAlertaModal_pregunta">¿Desea enviar un E-MAIL de notificación a /nombre/ con correo /email/?</h4>
                            <h5 id="enviarAlertaModal_estado_actual" class="mt-4">ESTADO LICITACIÓN ACTUAL: /estado/</h3>
                            <h5 id="enviarAlertaModal_mails_cant" class="mt-4">MAILS ENVIADOS ANTERIORMENTE: /num/</h3>
                        </div>
                        <div class="mt-4">
                            <button id="enviar" type="submit" class="btn btn-primary">Enviar E-MAIL</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>

        function changeTitle(id, value)
        {
            var heading = document.getElementById(id);
            if(value == 2){
                heading.innerHTML = "ENVÍO DE NOTIFICACIÓN - RETRASADO"
                heading.style.color = "red";
            }else{
                heading.innerHTML = "ENVÍO DE NOTIFICACIÓN - POR VENCER"
                heading.style.color = "goldenrod";
            }
        }

        function changeText(id, value)
        {
            var tag = document.getElementById(id);
            tag.innerHTML = value;
        }

        function enviarAlerta(id){
            /*
            $.get('/contrato/'+id+'/alerta_info', function(info){
                //$("#id").val(category.id);
                console.log(info);
                $("#enviarAlertaModal").modal('toggle');

            });
            */

            var alertas_info = {!! json_encode($alertas_info) !!};

            const alerta_info = alertas_info[id];
            changeTitle("enviarAlertaModal_title", alerta_info.semaforo);
            if(alerta_info.user_type != 2){
                changeText("enviarAlertaModal_pregunta", "¿Desea enviar un E-MAIL de notificación al usuario <b>'"+alerta_info.nombre_usuario+"'</b> con correo <b>'"+alerta_info.email_usuario+"'</b> ?");
                changeText("enviarAlertaModal_estado_actual", "ESTADO LICITACIÓN ACTUAL: <br> <b> '"+alerta_info.estado_actual+"'</b>");
                changeText("enviarAlertaModal_mails_cant", "MAILS ENVIADOS ANTERIORMENTE: <b> "+alerta_info.mails_cant+"</b>");
            }else{
                changeText("enviarAlertaModal_pregunta", "¿Desea enviar un E-MAIL de notificación al usuario de <b>'Abastecimiento'</b> y al <b>'Administrador de Contrato'</b>?");
                changeText("enviarAlertaModal_estado_actual", "ESTADO LICITACIÓN ACTUAL: <br> <b> '"+alerta_info.estado_actual+"'</b>");
                changeText("enviarAlertaModal_mails_cant", "MAILS ENVIADOS ANTERIORMENTE: <b> "+alerta_info.mails_cant+"</b>");
            }
            

            $("#id").val(id);

            console.log(alerta_info);

            $("#enviarAlertaModal").modal('toggle');

        }

        $("#enviarAlertaForm").submit(function(e){
            e.preventDefault();
            let id = $("#id").val();
            //let name = $("#name2").val();
            let _token = $("input[name=_token]").val();

            //Desactivamos botón "enviar"
            $("#enviar").prepend('<i class="fa fa-spinner fa-spin px-1"></i>');
            $("#enviar").attr("disabled", 'disabled');

            $.ajax({
                url:"{{route('contrato.enviar_alerta')}}",
                type:"POST",
                data:{
                    id:id,
                    //name:name,
                    _token:_token
                },
                success:function(response){
                    if(response.error){
                        alert("Ha ocurrido un error: " + response.error);
                    }else{
                        //alert("Se ha enviado una alerta exitosamente.");
                        //location.reload();
                        window.location.href = "/superadmin/1";
                    }
                    
                }
            });
        });
        
    </script>

@endsection
