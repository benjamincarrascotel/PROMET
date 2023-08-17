<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Contrato;
use App\Models\DetalleContrato;
use App\Models\Clasificacion;
use App\Models\Faena;
use App\Models\Area;
use App\Models\Centro;
use App\Models\ServicioBien;
use App\Models\Proveedor;
use App\Models\Admin;
use App\Models\AdminContrato;
use App\Models\AbastecimientoUser;
use App\Models\AccionContrato;
use App\Models\TipoContrato;
use App\Models\FaseContrato;
use App\Models\FaseContratoComprobante;
use App\Models\FaseProyectadaContrato;
use App\Models\Axis;

use App\Models\UserContratoMails;
use Illuminate\Support\Facades\Mail;

use App\Mail\AlertasContrato;

use Carbon\Carbon;
use Validator;

use Maatwebsite\Excel\Facades\Excel;
use App\Imports\ImportExcel;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;


class ContratoController extends Controller
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



    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $selectedID = 0;
        //Clasificaciones
        $clasificaciones = Clasificacion::pluck('nombre_clasificacion', 'id');
        //Faenas
        $faenas = Faena::pluck('nombre_faena', 'id');
        //Areas
        $areas = Area::pluck('nombre_area', 'id');
        //Centros
        $centros = Centro::pluck('nombre_centro', 'id');
        //Servicios o Bienes
        $servicios_bienes = ServicioBien::orderBy('nombre_servicio_bien')->pluck('nombre_servicio_bien', 'id');
        //Proveedores
        $proveedores = Proveedor::pluck('nombre', 'id');
        //Admin Contratos
        $admin_contratos = AdminContrato::pluck('nombre', 'id');
        //Abastecimiento Users
        $abastecimiento_users = AbastecimientoUser::pluck('nombre', 'id');
        //Acciones
        $acciones = AccionContrato::pluck('nombre_accion', 'id');
        //Tipo de Contratos
        $tipo_contratos = TipoContrato::pluck('nombre_tipo', 'id');

        return view('contrato.create', compact('clasificaciones', 'faenas', 'areas', 'centros', 'servicios_bienes', 'proveedores', 'admin_contratos', 'abastecimiento_users', 'acciones', 'tipo_contratos', 'selectedID'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'contrato_sap' => 'required',
            'descripcion' => 'required|string',
            'gasto_anual' => 'required',
            'facturacion_mensual' => 'required',
            'monto_factible' => 'required',
            'dotacion' => 'required',
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());
        }

        if(!isset($input['kpi'])){
            $input['kpi'] = null;
        }
        if(!isset($input['polinomio'])){
            $input['polinomio'] = null;
        }

        //Cálculo de fecha termino

        $fecha_inicio = Carbon::parse(($input['fecha_inicio']))->format('d-m-Y');
        $fecha_termino = Carbon::parse(($input['fecha_inicio']))->addMonth($input['duracion'])->format('d-m-Y');

        // Cálculo de puntos y demaces

        $monto_factible = $input['monto_factible'];
        // PUNTOS FM
        $puntos_FM = (int)$input['puntos_FM'];
        // PUNTOS DOT
        if($input['dotacion']>40){
            $puntos_DOT = 10;
        }else if($input['dotacion']>= 15 && $input['dotacion']<=40){
            $puntos_DOT = 5;
        }else if($input['dotacion']<15){
            $puntos_DOT = 1;
        }else{
            $puntos_DOT = 0;
        }
        // PUNTOS INTERFERENCIA
        if($input['interferencia_ops']== 'Alta'){
            $puntos_interf = 10;
        }else if($input['dotacion']== 'Media'){
            $puntos_interf = 5;
        }else if($input['dotacion'] == 'Baja'){
            $puntos_interf = 1;
        }else{
            $puntos_interf = 0;
        }
        // PUNTOS DURACION
        if($input['duracion']>36){
            $puntos_duracion = 10;
        }else if($input['duracion']>= 24 && $input['duracion']<=36){
            $puntos_duracion = 7;
        }else if($input['duracion']>= 12 && $input['duracion']<=24){
            $puntos_duracion = 5;
        }else if($input['duracion']<12){
            $puntos_duracion = 1;
        }else{
            $puntos_duracion = 0;
        }
        // PUNTOS TIPO DE CONTRATO
        $tipo = TipoContrato::where('id',$input['tipo_contrato_id'])->first();
        if(isset($tipo->nombre_tipo)){
            $tipo = $tipo->nombre_tipo;
        }else{
            $tipo = null;
        }

        if($tipo == 'Operación'){
            $puntos_tipo_contrato = 10;
        }else if($tipo == 'Inversión'){
            $puntos_tipo_contrato = 5;
        }else if($tipo == 'Asesoria'){
            $puntos_tipo_contrato = 1;
        }else{
            $puntos_tipo_contrato = 0;
        }

        $porcentaje_1 = ($puntos_DOT*0.23 + $puntos_FM*0.23 + $puntos_interf*0.23 + $puntos_duracion*0.2 + $puntos_tipo_contrato*0.11)/10;

        // RIESGO NEGOCIO
        if($input['riesgo_negocio'] == '10'){
            $riesgo_negocio = 10;
        }else if($input['riesgo_negocio'] == '5'){
            $riesgo_negocio = 5;
        }else if($input['riesgo_negocio'] == '1'){
            $riesgo_negocio = 1;
        }else{
            $riesgo_negocio = 0;
        }
        // CRITICIDAD OPS
        if($input['criticidad_ops'] == 'Alta'){
            $criticidad_ops = 10;
        }else if($input['criticidad_ops'] == 'Media'){
            $criticidad_ops = 5;
        }else if($input['criticidad_ops'] == 'Baja'){
            $criticidad_ops = 1;
        }else{
            $criticidad_ops = 0;
        }
        // CRITICIDAD Personas
        if($input['criticidad_personas'] == 'Alta'){
            $criticidad_personas = 10;
        }else if($input['criticidad_personas'] == 'Media'){
            $criticidad_personas = 5;
        }else if($input['criticidad_personas'] == 'Baja'){
            $criticidad_personas = 1;
        }else{
            $criticidad_personas = 0;
        }
        // CANTIDAD ÁREAS INVOLUCRADAS
        if($input['cantidad_areas_invo'] == 'Todas'){
            $cantidad_areas_invo = 10;
        }else if($input['cantidad_areas_invo'] == 'Media'){
            $cantidad_areas_invo = 5;
        }else if($input['cantidad_areas_invo'] == 'Una'){
            $cantidad_areas_invo = 1;
        }else{
            $cantidad_areas_invo = 0;
        }

        $porcentaje_2 = ($riesgo_negocio*0.35 + $criticidad_ops*0.25 + $criticidad_personas*0.25 + $cantidad_areas_invo*0.15)/10;


        $contrato = Contrato::create([
            'clasificacion_id' => $input['clasificacion_id'],
            'tipo_contrato_general' => $input['tipo_contrato_general'],
            'faena_id' => $input['faena_id'],
            'area_id' => $input['area_id'],
            'centro_id' => $input['centro_id'],
            'servicio_bien_id' => $input['servicio_bien_id'],
            //'categoria_id' => 1, 
            'proveedor_id' => $input['proveedor_id'],
            'contrato_sap' => $input['contrato_sap'],
            'admin_contrato_id' => $input['admin_contrato_id'],
            'usuario' => $input['admin_contrato_id'],
            'abastecimiento_user_id' => $input['abastecimiento_user_id'],
            'descripcion' => $input['descripcion'],
            'estado_contrato' => 0, //"Estado dummy"
            'tipo_renovacion' => $input['tipo_renovacion'], 
            'estatus' => 0, //"SEMAFORO"
            'fase_proyectada_flag' => 0, 
        ]);

        $fase_contrato = FaseContrato::create([
            'contrato_id' => $contrato->id,
            'creado' => Carbon::now(),
            'actual' => 0,
        ]);

        $detalle_contrato = DetalleContrato::create([
            'contrato_id' => $contrato->id,
            'gasto_anual' => $input['gasto_anual'],
            'fecha_inicio' => $fecha_inicio,
            'fecha_termino' => $fecha_termino,
            'facturacion_mensual' => $input['facturacion_mensual'],
            'monto_factible' => $monto_factible, //CALCULABLE
            //'categoria_id' => 1, 
            'puntos_FM' => $puntos_FM, //Verrificar cálculo
            'dotacion' => $input['dotacion'],
            'puntos_DOT' => $puntos_DOT, //Verrificar cálculo
            'interferencia_ops' => $input['interferencia_ops'],
            'puntos_interf' => $puntos_interf, //Verrificar cálculo
            'duracion' => $input['duracion'],
            'puntos_duracion' => $puntos_duracion, //calculable
            'tipo_contrato_id' => $input['tipo_contrato_id'],
            'puntos_tipo_contrato' => $puntos_tipo_contrato, //calculable
            'porcentaje_1' => $porcentaje_1, //CALCULABLE
            'riesgo_negocio' => $input['riesgo_negocio'], 
            'criticidad_ops' => $input['criticidad_ops'], 
            'criticidad_personas' => $input['criticidad_personas'], 
            'cantidad_areas_invo' => $input['cantidad_areas_invo'], 
            'porcentaje_2' => $porcentaje_2, //CALCULABLE 
            'transversal' => $input['transversal'], 
            'accion_id' => $input['accion_id'], 
            'kpi' => $input['kpi'], //boolean
            'polinomio' => $input['polinomio'], //boolean
        ]);


        flash('Contrato creado con éxito', 'success');

        
        return view('fases.create_fase_proyectada')
                    ->with('selectedID', $contrato->id)
                    ->with('contratos', [$contrato]);

    }


    // Vistas de Power BI

    public function detalles()
    {

        $contratos = Contrato::get();
        $dataPoints = collect();
        $dataPoints_aux = collect();

        $estadisticas = collect();

        // Porcentajes fijos de cada eje
        $axis = Axis::first();
        if(! $axis){
            $axis = Axis::create([
                'axis_x' => 50,
                'axis_y' => 50,
            ]);
        }

        $axis_x = $axis->axis_x;
        $axis_y = $axis->axis_y;

        foreach($contratos as $contrato){
            //TODO verificar que porcentaje corresponde a cada uno
            $porcentaje_x = $contrato->detalle_contrato[0]->porcentaje_1*100;
            $porcentaje_y = $contrato->detalle_contrato[0]->porcentaje_2*100;

            //Calculamos criticidad para cada contrato
            $criticidad = 0;
            if($porcentaje_x >= $axis_x && $porcentaje_y >= $axis_y) $criticidad = 1;
            else if($porcentaje_x <= $axis_x && $porcentaje_y >= $axis_y) $criticidad = 2;
            else if($porcentaje_x <= $axis_x && $porcentaje_y <= $axis_y) $criticidad = 3;
            else if($porcentaje_x >= $axis_x && $porcentaje_y <= $axis_y) $criticidad = 4;


            //kpi
            $kpi=0;
            if($contrato->detalle_contrato[0]->kpi){
                $kpi = 1;
            }


            $dataPoints->push([
                "transversal" => $contrato->detalle_contrato[0]->transversal,
                "faena" => $contrato->faena->nombre_faena,
                "tipo_contrato" => $contrato->tipo_contrato_general,
                "criticidad" => $criticidad,
                "servicio_bien" => $contrato->servicio_bien->nombre_servicio_bien,
                "dotacion" => $contrato->detalle_contrato[0]->dotacion,

                //Estadísticas
                "facturacion_mensual" => $contrato->detalle_contrato[0]->gasto_anual/$contrato->detalle_contrato[0]->duracion,
                "dotacion" => $contrato->detalle_contrato[0]->dotacion,
                "kpi" => $kpi,
                "gasto_12_meses_moviles" => $contrato->detalle_contrato[0]->facturacion_mensual*12, //TODO verificar

            ]);
        }

        //Porcentajes de criticidad
        $suma_criticidad_1 = 0;
        $suma_criticidad_2 = 0;
        $suma_criticidad_3 = 0;
        $suma_criticidad_4 = 0;
        $counter = 0;

        //Cálculo de estadísticas
        $sum_facturacion_mensual = 0;
        $sum_dotacion = 0;
        $sum_dotacion_sum = 0;
        $kpi_by_kpi_sum = 0;
        $kpi_by_kpi = 0;
        $sum_gasto_12_meses_moviles = 0;

        foreach($dataPoints as $item){
            //Estadísticas
            $sum_facturacion_mensual += $item['facturacion_mensual'];
            $sum_dotacion_sum += $item['dotacion'];
            $kpi_by_kpi_sum += $item['kpi'];
            $sum_gasto_12_meses_moviles += $item['gasto_12_meses_moviles'];

            //Porcentajes de Gŕafica
            switch ($item['criticidad']) {
                case '1':
                    $suma_criticidad_1 +=1;
                    break;
                case '2':
                    $suma_criticidad_2 +=1;
                    break;
                case '3':
                    $suma_criticidad_3 +=1;
                    break;
                
                default:
                    $suma_criticidad_4 +=1;
                    break;
            }
            $counter +=1;

        }

        $kpi_by_kpi = $kpi_by_kpi_sum/$counter;
        $sum_dotacion = $sum_dotacion_sum/$counter;


        $porcentajes = collect([
            ["y" => round($suma_criticidad_1/$counter*100, 2), "label" => "Alta criticidad", "cant" => $suma_criticidad_1],
            ["y" => round($suma_criticidad_2/$counter*100, 2), "label" => "Criticidad por admin", "cant" => $suma_criticidad_2],
            ["y" => round($suma_criticidad_3/$counter*100, 2), "label" => "Baja criticidad", "cant" => $suma_criticidad_3],
            ["y" => round($suma_criticidad_4/$counter*100, 2), "label" => "Criticidad por impacto", "cant" => $suma_criticidad_4]
        ]);


        $servicios_bienes = ServicioBien::orderBy('nombre_servicio_bien')->pluck('nombre_servicio_bien', 'id');
        $faenas = Faena::pluck('nombre_faena', 'id');

        

        return view('contrato.detalles')
            //Estadisticas
            ->with('sum_facturacion_mensual', $sum_facturacion_mensual)
            ->with('sum_dotacion', $sum_dotacion)
            ->with('kpi_by_kpi', $kpi_by_kpi)
            ->with('sum_gasto_12_meses_moviles', $sum_gasto_12_meses_moviles)


            ->with('axis_x', $axis_x)
            ->with('axis_y', $axis_y)
            ->with('porcentajes', $porcentajes)
            ->with('dataPoints', $dataPoints)
            ->with('contratos', $contratos)
            ->with('faenas', $faenas)
            ->with('servicios_bienes' , $servicios_bienes);
    }

    public function plan()
    {

        $contratos = Contrato::get();
        $dataPoints = collect();
        $dataPoints_aux = collect();

        // Porcentajes fijos de cada eje

        $axis = Axis::first();
        if(! $axis){
            $axis = Axis::create([
                'axis_x' => 50,
                'axis_y' => 50,
            ]);
        }

        $axis_x = $axis->axis_x;
        $axis_y = $axis->axis_y;

        foreach($contratos as $contrato){
            //TODO verificar que porcentaje corresponde a cada uno
            $porcentaje_x = $contrato->detalle_contrato[0]->porcentaje_1*100;
            $porcentaje_y = $contrato->detalle_contrato[0]->porcentaje_2*100;

            //Calculamos criticidad para cada contrato
            $criticidad = 0;
            if($porcentaje_x >= $axis_x && $porcentaje_y >= $axis_y) $criticidad = 1;
            else if($porcentaje_x <= $axis_x && $porcentaje_y >= $axis_y) $criticidad = 2;
            else if($porcentaje_x <= $axis_x && $porcentaje_y <= $axis_y) $criticidad = 3;
            else if($porcentaje_x >= $axis_x && $porcentaje_y <= $axis_y) $criticidad = 4;


            $dataPoints->push([
                "transversal" => $contrato->detalle_contrato[0]->transversal,
                "faena" => $contrato->faena->nombre_faena,
                "tipo_contrato" => $contrato->tipo_contrato_general,
                "criticidad" => $criticidad,
                "servicio_bien" => $contrato->servicio_bien->nombre_servicio_bien,
                "x" => $porcentaje_x, 
                "y" => $porcentaje_y,
            ]);
        }

        $servicios_bienes = ServicioBien::orderBy('nombre_servicio_bien')->pluck('nombre_servicio_bien', 'id');
        $faenas = Faena::pluck('nombre_faena', 'id');

        return view('contrato.plan')
            ->with('dataPoints', $dataPoints)
            ->with('axis_x', $axis_x)
            ->with('axis_y', $axis_y)
            ->with('contratos', $contratos)
            ->with('faenas', $faenas)
            ->with('servicios_bienes' , $servicios_bienes);
    }

    public function fechas()
    {
        $contratos = Contrato::all();

        $axis = Axis::first();
        if(! $axis){
            $axis = Axis::create([
                'axis_x' => 50,
                'axis_y' => 50,
            ]);
        }

        $axis_x = $axis->axis_x;
        $axis_y = $axis->axis_y;

        foreach($contratos as $contrato){
            //TODO verificar que porcentaje corresponde a cada uno
            $porcentaje_x = $contrato->detalle_contrato[0]->porcentaje_1*100;
            $porcentaje_y = $contrato->detalle_contrato[0]->porcentaje_2*100;

            //Calculamos criticidad para cada contrato
            $criticidad = 0;
            if($porcentaje_x >= $axis_x && $porcentaje_y >= $axis_y) $criticidad = 1;
            else if($porcentaje_x <= $axis_x && $porcentaje_y >= $axis_y) $criticidad = 2;
            else if($porcentaje_x <= $axis_x && $porcentaje_y <= $axis_y) $criticidad = 3;
            else if($porcentaje_x >= $axis_x && $porcentaje_y <= $axis_y) $criticidad = 4;

            $contrato->criticidad = $criticidad;

        }



        $servicios_bienes = ServicioBien::orderBy('nombre_servicio_bien')->pluck('nombre_servicio_bien', 'id');
        $faenas = Faena::pluck('nombre_faena', 'id');

        return view('contrato.fechas')
            ->with('contratos', $contratos)
            ->with('faenas', $faenas)
            ->with('servicios_bienes' , $servicios_bienes);
    }

    public function cronograma()
    {
        $contratos = Contrato::all();


        $contratos = Contrato::get();
        $dataPoints = collect();
        $dataPoints_aux = collect();

        // Porcentajes fijos de cada eje
        $axis_x = 50;
        $axis_y = 50;

        foreach($contratos as $contrato){

            if(count($contrato->fase_proyectada_contrato) != 0){

                //TODO verificar que porcentaje corresponde a cada uno
                $porcentaje_x = $contrato->detalle_contrato[0]->porcentaje_1*100;
                $porcentaje_y = $contrato->detalle_contrato[0]->porcentaje_2*100;

                //Calculamos criticidad para cada contrato
                $criticidad = 0;
                if($porcentaje_x >= $axis_x && $porcentaje_y >= $axis_y) $criticidad = 1;
                else if($porcentaje_x <= $axis_x && $porcentaje_y >= $axis_y) $criticidad = 2;
                else if($porcentaje_x <= $axis_x && $porcentaje_y <= $axis_y) $criticidad = 3;
                else if($porcentaje_x >= $axis_x && $porcentaje_y <= $axis_y) $criticidad = 4;

                // Calcular arreglos de actividad fechas
                $fecha_proyectada_inicio = Carbon::parse($contrato->fase_proyectada_contrato[0]->solicitud_de_base)->format('m');
                $fecha_proyectada_termino = Carbon::parse($contrato->fase_proyectada_contrato[0]->adjudicacion)->format('m');
                

                //TODO Corregir con fechas correspondientes
                $fecha_real_inicio = Carbon::parse($contrato->detalle_contrato[0]->fecha_inicio)->format('m');
                $fecha_real_termino = Carbon::parse($contrato->detalle_contrato[0]->fecha_termino)->format('m');

                //dd($fecha_proyectada_termino);
                $datapoints_proyectada = ['No activo','No activo','No activo','No activo','No activo','No activo','No activo','No activo','No activo','No activo','No activo','No activo'];
                $datapoints_real = ['No activo','No activo','No activo','No activo','No activo','No activo','No activo','No activo','No activo','No activo','No activo','No activo'];

                if($fecha_proyectada_termino >= $fecha_proyectada_inicio){
                    for($i= (int)$fecha_proyectada_inicio -1; $i < (int)$fecha_proyectada_termino; $i++){
                        $datapoints_proyectada[$i] = 'Activo';
                    }
                } //TODO definir que hacer en caso de que las fechas no estén ordenadas cronologicamente

                if($fecha_real_termino >= $fecha_real_inicio){
                    for($i= (int)$fecha_real_inicio -1; $i < (int)$fecha_real_termino; $i++){
                        $datapoints_real[$i] = 'Activo';
                    }
                }


                $dataPoints->push([
                    "id" => $contrato->id,
                    "proyectada" => $datapoints_proyectada,
                    "real" => $datapoints_real,

                    "transversal" => $contrato->detalle_contrato[0]->transversal,
                    "faena" => $contrato->faena->nombre_faena,
                    "tipo_contrato" => $contrato->tipo_contrato_general,
                    "criticidad" => $criticidad,
                    "servicio_bien" => $contrato->servicio_bien->nombre_servicio_bien,
                ]);
            }
        }

        $servicios_bienes = ServicioBien::orderBy('nombre_servicio_bien')->pluck('nombre_servicio_bien', 'id');
        $faenas = Faena::pluck('nombre_faena', 'id');

        return view('contrato.cronograma')
            ->with('dataPoints', $dataPoints)
            ->with('contratos', $contratos)
            ->with('faenas', $faenas)
            ->with('servicios_bienes' , $servicios_bienes);
    }

    public function kpis()
    {
        return view('contrato.kpis');
    }





    public function excel(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($input,[
            'file' => 'required|mimes:xlsx,xls',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $rows = Excel::toArray(new ImportExcel(), $request->file('file'))[0];
        $column_list = $rows[0];
        dd($column_list);
        //Definir estándar
        //Ingresar los valores correspondientes de ejemplo


        //TODO ingresar entradas como nuevos contratos a la DB

        return back()->with('success', 'El archivo se ha subido correctamente.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $contrato = Contrato::where('id', $id)->first();

        //Creamos la ruta pública primero
        if(!File::exists('storage/contratos/'.$contrato->id)){
            File::makeDirectory(public_path('storage/contratos/'.$contrato->id));
        }

        $fase_comprobantes = FaseContratoComprobante::where('contrato_id', $contrato->id)->first();
        if(!$fase_comprobantes){
            $fase_comprobantes = FaseContratoComprobante::create([
                'contrato_id' => $contrato->id,
            ]);
        }

        $fases_contrato = $contrato->fase_contrato[0];
        if($contrato->fase_proyectada_flag){
            $fases_proyectadas_contrato = $contrato->fase_proyectada_contrato[0];
        }else{
            $fases_proyectadas_contrato = null;
        }
        
        //dd($fases_contrato);
        $fase_actual = $contrato->estado_contrato;
        return view('contrato.show')
            ->with('fases_contrato', $fases_contrato)
            ->with('fases_proyectadas_contrato', $fases_proyectadas_contrato)
            ->with('fase_actual', $fase_actual)
            ->with('contrato', $contrato);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function fase_update(Request $request, $id)
    {

        $fases = collect([
            'creado', //0
            'solicitud_de_base', //1
            'envio_bases_primera_revision', //2
            'primera_revision_bases_por_abastecimiento', //3
            'envio_bases_segunda_revision', //4
            'segunda_revision_bases_por_abastecimiento', //5
            'recopilacion_de_informacion', //6
            'invitacion_a_oferentes', //7
            'visita_a_terreno', //8
            'preguntas_y_consultas_proponente', //9
            'respuestas_del_mandante', //10
            'recepcion_de_ofertas_tecnicas_economicas', //11
            'evaluacion_ofertas_tecnicas', //12
            'evaluacion_ofertas_economicas', //13
            'comite_de_inversiones', //14
            'adjudicacion', //15
            'stand_by', //16
            'adjudicacion_directa', //17
        ]);

        $input = $request->all();
        
        $siguiente_fase_id = $input['siguiente_fase_id'];
        $nombre_fase = $fases[$siguiente_fase_id];
        $contrato = Contrato::where('id', $id)->first();

        $file = $request->file('foto');

        $fase_comprobantes = FaseContratoComprobante::where('contrato_id', $contrato->id)->first();
        if(!$fase_comprobantes){
            $fase_comprobantes = FaseContratoComprobante::create([
                'contrato_id' => $contrato->id,
            ]);
        }

        if($file){
            $type = $request->file('foto')->guessExtension();
            $nombre = $nombre_fase.'.'.$type;

            Storage::makeDirectory('contratos/'.$contrato->id);

            //$ruta = storage_path("app/solicituds/".$solicitud->id.'/'.$nombre);
            //copy($file,$ruta);
            $ruta = public_path("storage/contratos/".$contrato->id.'/'.$nombre);
            copy($file, $ruta);

            $fase_comprobantes[$nombre_fase] = $nombre;
            $fase_comprobantes->save();
        }
        


        $fases_contrato = FaseContrato::where('contrato_id', $id)->first();
        $fases_contrato[$nombre_fase] = $input['fecha'];
        $fases_contrato->save();

        $contrato->estado_contrato = $siguiente_fase_id;
        $contrato->estatus = $siguiente_fase_id; //TODO cambiar a string y guardar nombre de fase
        $contrato->save();

        
        flash('Cambio de fase realizado con éxito', 'success');

        return redirect()->route('contrato.show', $id);
    }

    public function create_fase_proyectada(){
        $contratos = Contrato::where('fase_proyectada_flag', 0)->get();
        $selectedID = 0;
        return view('fases.create_fase_proyectada', compact('selectedID', 'contratos'));
    }

    public function store_fase_proyectada(Request $request){
        $input = $request->all();

        //TODO Agregar Validator
        $fase_contrato = FaseProyectadaContrato::create([
            'contrato_id' => $input['contrato_id'],
            'solicitud_de_base' => $input['solicitud_de_base'], //1
            'envio_bases_primera_revision' => $input['envio_bases_primera_revision'], //2
            'primera_revision_bases_por_abastecimiento' => $input['primera_revision_bases_por_abastecimiento'], //3
            'envio_bases_segunda_revision' => $input['envio_bases_segunda_revision'], //4
            'segunda_revision_bases_por_abastecimiento' => $input['segunda_revision_bases_por_abastecimiento'], //5
            'recopilacion_de_informacion' => $input['recopilacion_de_informacion'], //6
            'invitacion_a_oferentes' => $input['invitacion_a_oferentes'], //7
            'visita_a_terreno' => $input['visita_a_terreno'], //8
            'preguntas_y_consultas_proponente' => $input['preguntas_y_consultas_proponente'], //9
            'respuestas_del_mandante' => $input['respuestas_del_mandante'], //10
            'recepcion_de_ofertas_tecnicas_economicas' => $input['recepcion_de_ofertas_tecnicas_economicas'], //11
            'evaluacion_ofertas_tecnicas' => $input['evaluacion_ofertas_tecnicas'], //12
            'evaluacion_ofertas_economicas' => $input['evaluacion_ofertas_economicas'], //13
            'comite_de_inversiones' => $input['comite_de_inversiones'], //14
            'adjudicacion' => $input['adjudicacion'], //15
        ]);

        $contrato = Contrato::where('id', $input['contrato_id'])->first();
        $contrato->fase_proyectada_flag = 1;
        $contrato->save();

        
        flash('Creación de fases proyectadas realizada con éxito', 'success');

        return redirect()->route('superadmin.index', [0]);
    }


    public function enviar_alerta(Request $request)
    {
        $input = $request->all();
        //dd($input);
        $contrato = Contrato::find($input['id']);

        $user_type = 0;
        if($this->identificador_estados_user_type[$contrato->estado_contrato] == ['administrador']){
            $user_type = 0;
        }else if($this->identificador_estados_user_type[$contrato->estado_contrato] == ['abastecimiento']){
            $user_type = 1;
        }else{
            $user_type = 2;
        }

        $mail_register = UserContratoMails::create([
            'contrato_id' => $contrato->id,
            'estado_contrato' => $contrato->estado_contrato+1,
            'user_type' => $user_type,
        ]);


        $mail_info = new \stdClass();
        $mail_info->contrato = $contrato;
        //Fase Actual
        $mail_info->fase_actual = $this->identificador_estados_nombres[$contrato->estado_contrato];
        //Fase Siguiente
        $mail_info->fase_siguiente = $this->identificador_estados_nombres[$contrato->estado_contrato +1];
        //Fecha Siguiente Fase Proyectada 
        $mail_info->fecha_proyectada = Carbon::parse($contrato->fase_proyectada_contrato[0][$this->identificador_estados[$contrato->estado_contrato +1]])->format('d-m-Y');
        //RETRASADO o POR VENCER
        $fase_sig_proyectada = Carbon::parse(FaseProyectadaContrato::where('contrato_id', $contrato->id)->value($this->identificador_estados[$contrato->estado_contrato+1]));
        $fecha_actual = Carbon::now();

        //Verificamos casos
        $diferencia = $fecha_actual->diffInDays($fase_sig_proyectada, false);

        if($diferencia >= 0){
            $mail_info->estado = 1;
            $mail_info->subject = 'Proceso de Licitación - Contrato '.$contrato->servicio_bien->nombre_servicio_bien.' / '.$contrato->faena->nombre_faena.' - FASE SIGUIENTE "POR VENCER".';

        }else if($diferencia < 0){
            $mail_info->estado = 0;
            $mail_info->subject = 'Proceso de Licitación - Contrato '.$contrato->servicio_bien->nombre_servicio_bien.' / '.$contrato->faena->nombre_faena.' - FASE SIGUIENTE "RETRASADA".';

        }

        $user_info = collect();
        if($user_type == 2){ //enviamos correos a ambos usuarios
            //User info
            $user_info = [
                'nombre' => $contrato->admin_contrato->nombre,
                'email' => $contrato->admin_contrato->email
            ];
            $mail_info->user_info = $user_info;
            Mail::to($mail_info->user_info['email'])->send(new AlertasContrato($mail_info));

            //User info
            $user_info = [
                'nombre' => $contrato->abastecimiento_user->nombre,
                'email' => $contrato->abastecimiento_user->email
            ];
            $mail_info->user_info = $user_info;
            Mail::to($mail_info->user_info['email'])->send(new AlertasContrato($mail_info));

        }else if($user_type == 1){ // enviamos correo a abastecimiento
            //User info
            $user_info = [
                'nombre' => $contrato->abastecimiento_user->nombre,
                'email' => $contrato->abastecimiento_user->email
            ];
            $mail_info->user_info = $user_info;
            Mail::to($contrato->abastecimiento_user->email)->send(new AlertasContrato($mail_info));

        }else{ //enviamos correo a admin de contrato
            //User info
            $user_info = [
                'nombre' => $contrato->admin_contrato->nombre,
                'email' => $contrato->admin_contrato->email
            ];
            $mail_info->user_info = $user_info;
            Mail::to($contrato->admin_contrato->email)->send(new AlertasContrato($mail_info));
        }

        //Correo de respaldo
        $user_info = [
            'nombre' => 'RESPALDO',
            'email' => 'mos.cemin@gmail.com'
        ];
        $mail_info->user_info = $user_info;

        Mail::to('mos.cemin@gmail.com')->send(new AlertasContrato($mail_info));

        return redirect()->route('superadmin.index', [0]);
    }

    public function axis_update(Request $request)
    {
        $input = $request->all();
        $axis = Axis::first();
        if(! $axis){
            $axis = Axis::create([
                'axis_x' => 50,
                'axis_y' => 50,
            ]);
        }
        $axis->axis_x = $input['axis_x'];
        $axis->axis_y = $input['axis_y'];
        $axis->save();

        return redirect()->route('contrato.plan');

    }
    

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
