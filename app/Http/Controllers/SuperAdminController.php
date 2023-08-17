<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Contrato;
use App\Models\DetalleContrato;
use App\Models\FaseContrato;
use App\Models\FaseProyectadaContrato;
use App\Models\UserContratoMails;

class SuperAdminController extends Controller
{

    public $identificador_estados = [
        '0'=>'creado',
        '1'=>'solicitud_de_base',
        '2'=>'envio_bases_primera_revision',
        '3'=>'primera_revision_bases_por_abastecimiento',
        '4'=>'envio_bases_segunda_revision',
        '5'=>'segunda_revision_bases_por_abastecimiento',
        '6'=>'recopilacion_de_informacion',
        '7'=>'invitacion_a_oferentes',
        '8'=>'visita_a_terreno',
        '9'=>'preguntas_y_consultas_proponente',
        '10'=>'respuestas_del_mandante',
        '11'=>'recepcion_de_ofertas_tecnicas_economicas',
        '12'=>'evaluacion_ofertas_tecnicas',
        '13'=>'evaluacion_ofertas_economicas',
        '14'=>'comite_de_inversiones',
        '15'=>'adjudicacion',
        '16'=>'stand_by',
        '17'=>'adjudicacion_directa',
    ];
    public $identificador_estados_nombres = [
        '0'=>'Creado',
        '1'=>'Solicitud de base',
        '2'=>'Envio bases primera revisión',
        '3'=>'Primera revisión bases por abastecimiento',
        '4'=>'Envío bases segunda revisión',
        '5'=>'Segunda revisión bases por abastecimiento',
        '6'=>'Recopilación de información',
        '7'=>'Invitación a oferentes',
        '8'=>'Visita a terreno',
        '9'=>'Preguntas y consultas proponente',
        '10'=>'Respuestas del mandante',
        '11'=>'Recepción de ofertas técnicas económicas',
        '12'=>'Evaluación ofertas técnicas',
        '13'=>'Evaluación ofertas económicas',
        '14'=>'Comité de inversiones',
        '15'=>'Adjudicación',
        '16'=>'Stand By',
        '17'=>'Adjudicación directa',
    ];

    public $identificador_estados_user_type = [ // Según el estado en el que estoy
        '0'=>['abastecimiento'],
        '1'=>['administrador'],
        '2'=>['abastecimiento'],
        '3'=>['administrador'],
        '4'=>['abastecimiento'],
        '5'=>['abastecimiento'],
        '6'=>['abastecimiento'],
        '7'=>['administrador', 'abastecimiento'],
        '8'=>['abastecimiento'],
        '9'=>['administrador'],
        '10'=>['abastecimiento'],
        '11'=>['administrador'],
        '12'=>['abastecimiento'],
        '13'=>['abastecimiento'],
        '14'=>['abastecimiento'],
    ];


    public function index($flag)
    {
        $contratos_all = Contrato::with('clasificacion')
            ->with('faena')
            ->with('area')
            ->with('centro')
            ->with('servicio_bien')
            ->with('proveedor')
            ->with('admin_contrato')
            ->with('tipo_contrato')
            ->with('detalle_contrato')
            ->with('fase_contrato')
            ->get();

        $fases_proyectadas_contratos = FaseProyectadaContrato::pluck('id','contrato_id');

        $contratos = collect();
        foreach($contratos_all as $contrato){
            if(in_array( $contrato['id'] , array_keys($fases_proyectadas_contratos->toArray()))){
                $contratos->push($contrato);
            }
        }

        $alertas_info = collect();

        // Contadores
        $a_tiempo_sum = 0;
        $por_vencer_sum = 0;
        $retrasadas_sum = 0;


        foreach($contratos as $contrato){
            $alerta_info = collect();
            // Cálculo de semaforo
            $alerta_info->put('semaforo',  0);
            if($contrato->estado_contrato < 15 ){

                $fase_sig_proyectada = Carbon::parse(FaseProyectadaContrato::where('contrato_id', $contrato->id)->value($this->identificador_estados[$contrato->estado_contrato+1]));
                $fecha_actual = Carbon::now();

                //Verificamos casos
                $diferencia = $fecha_actual->diffInDays($fase_sig_proyectada, false);
                //dd($diferencia);
                if($diferencia > 3){
                    $alerta_info->put('semaforo',  0);
                    $a_tiempo_sum +=1 ;
                }else if( $diferencia >= 0){
                    $alerta_info->put('semaforo',  1);
                    $por_vencer_sum += 1;
                }else{
                    $alerta_info->put('semaforo',  2);
                    $retrasadas_sum += 1;
                }

                // Cálculo de cant alertas enviadas
                $mails_cant = count(UserContratoMails::where('contrato_id', $contrato->id)->where('estado_contrato', $contrato->estado_contrato+1)->get());
                $alerta_info->put( 'mails_cant' , $mails_cant);

                // Obtención datos Usuario
                $alerta_info->put( 'user_type', 2);
                if($this->identificador_estados_user_type[$contrato->estado_contrato] == ['administrador']){
                    $alerta_info->put( 'user_type', 0);
                    $alerta_info->put( 'nombre_usuario', $contrato->admin_contrato->nombre);
                    $alerta_info->put( 'email_usuario', $contrato->admin_contrato->email);
                }else if($this->identificador_estados_user_type[$contrato->estado_contrato] == ['abastecimiento']){
                    $alerta_info->put( 'user_type', 1);
                    $alerta_info->put( 'nombre_usuario', $contrato->abastecimiento_user->nombre);
                    $alerta_info->put( 'email_usuario', $contrato->abastecimiento_user->email);
                }

            }

            // Cálculo estado actual
            $alerta_info->put( 'estado_actual', $this->identificador_estados_nombres[$contrato->estado_contrato]);
            

            $alertas_info->put($contrato->id, $alerta_info);

        }

        if($flag)flash('Correo electrónico de alerta enviado.', 'success');

        //dd($alertas_info);

        return view('superadmin.index')
            ->with('a_tiempo_sum', $a_tiempo_sum)
            ->with('por_vencer_sum', $por_vencer_sum)
            ->with('retrasadas_sum', $retrasadas_sum)

            ->with('alertas_info', $alertas_info)
            ->with('contratos', $contratos);
    }

}
