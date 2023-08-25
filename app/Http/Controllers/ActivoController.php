<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Activo;
use App\Models\ArriendoActivo;

use Illuminate\Support\Facades\Auth;




use Illuminate\Support\Facades\File;
use SimpleSoftwareIO\QrCode\Facades\QrCode;


class ActivoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $activos = Activo::all();
        return view('activo.index')
            ->with('activos', $activos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('activo.create');
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

        // Manejo de imagen
        $file = null;
        if($request->hasFile('foto')){
            $file = $request->file('foto');
        }

        //dd($request->all());
        $activo = Activo::create([
            "marca" => $input['marca'],
            "modelo" => $input['modelo'],
            "año" => $input['año'],
            "clasificacion" => $input['clasificacion'],
            "codigo_interno" => $input['codigo_interno'],
            "numero_serie" => $input['numero_serie'],
            "horas_uso_promedio" => $input['horas_uso_promedio'],
            "precio_compra" => $input['precio_compra'],
            "orden_compra" => $input['orden_compra'],
            "vida_util" => $input['vida_util'],
            "valor_residual" => $input['valor_residual'],
            "estado" => "DISPONIBLE",
        ]);

        //Creamos la ruta pública primero
        File::makeDirectory(public_path('storage/activos/'.$activo->id));

        //Generamos QR
        QrCode::generate('http://217.61.97.143/inventario/'.$activo->id, public_path("storage/activos/".$activo->id.'/QR_CODE.svg'));
        $activo->codigo_qr = 'QR_CODE.svg';
        $activo->save();

        // Guardamos la imagen
        if($request->hasFile('foto'))
        {
            $type = $file->guessExtension();
            $nombre = 'activo_'.$activo->id.time().'.'.$type;

            $ruta = public_path("storage/activos/".$activo->id.'/'.$nombre);
            copy($file,$ruta);

            $activo->foto = $nombre;
            $activo->save();
        }

        $activos = Activo::get();

        return redirect()->route('activo.index')
            ->with('activos', $activos);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $activo = Activo::where('id', $id)->first();
        return $activo;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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

    public function trazabilidad()
    {
        $arriendos = ArriendoActivo::get()->reverse();
        return view('activo.trazabilidad')
            ->with('arriendos', $arriendos);
    }

    public function ingresar_arriendo_create()
    {
        $selectedID = 0;
        $activos = Activo::where('estado', "DISPONIBLE")->get();

        return view('arriendo.create')
            ->with('activos', $activos)
            ->with('selectedID', $selectedID);
    }

    public function ingresar_arriendo_store(Request $request)
    {

        //TODO verificar que no exista otro arriendo en curso de este activo
        $input = $request->all();

        //dd($request->all());
        $arriendo = ArriendoActivo::create([
            "activo_id" => $input['activo_id'],
            "monto" => $input['monto'],
            "fecha_inicio" => $input['fecha_inicio'],
            "fecha_termino" => $input['fecha_termino'],
            "cliente_area" => $input['cliente_area'],
            "encargado" => $input['encargado'],
            "estado" => 'BODEGA',
        ]);

        // Actualizamos estado del activo arrendado
        $activo = Activo::where('id', $input['activo_id'])->first();
        $activo->estado = 'PARA RETIRO';
        $activo->save();

        flash('Arriendo registrado correctamente.', 'success');

        $arriendos = ArriendoActivo::whereNotIn('estado', ["TERMINADO"])->get();

        return redirect()->route('activo.trazabilidad')
            ->with('arriendos', $arriendos);
    }

    public function transporte()
    {
        $arriendos = ArriendoActivo::whereNotIn('estado', ["TERMINADO"])->get()->reverse();
        return view('arriendo.transporte')
            ->with('arriendos', $arriendos);
    }


    public function cambio_fase(Request $request)
    {
        //dd($request->all());
        $input = $request->all();
        $arriendo = ArriendoActivo::where('id', $input['arriendo_id'])->first();
        $activo = Activo::where('id', $arriendo->activo->id)->first();
        //dd($activo);
        switch ($arriendo->estado) {
            case 'BODEGA':
                if($activo->estado == "PARA RETIRO"){
                    $arriendo->estado = "EN CAMINO IDA";
                    $arriendo->save();
                    $activo->estado = "EN RUTA IDA";
                    $activo->save();
                }
                break;
            case 'EN CAMINO IDA':
                if($activo->estado == "EN RUTA IDA"){
                    $arriendo->estado = "EN CLIENTE";
                    $arriendo->save();
                    $activo->estado = "ARRENDADO";
                    $activo->save();
                }
                break;
            case 'EN CLIENTE':
                if($activo->estado == "ARRENDADO"){
                    $activo->estado = "PARA RETIRO";
                    $activo->save();
                }elseif($activo->estado == "PARA RETIRO"){
                    $arriendo->estado = "EN CAMINO VUELTA";
                    $arriendo->save();
                    $activo->estado = "EN RUTA VUELTA";
                    $activo->save();
                }
                break;
            case 'EN CAMINO VUELTA':
                if($activo->estado == "EN RUTA VUELTA"){
                    $arriendo->estado = "BODEGA DE VUELTA";
                    $arriendo->save();
                    $activo->estado = "RECIBIDO";
                    $activo->save();
                }
                break;
            case 'BODEGA DE VUELTA':
                if($activo->estado == "RECIBIDO"){
                    $arriendo->estado = "TERMINADO";
                    $arriendo->save();
                    $activo->estado = "DISPONIBLE";
                    $activo->save();
                }
                break;
            default:    //CASO AÚN NO DEFINIDO
                # code...
                break;
        }

        $redirected = 'Cambio de fase registrado correctamente.';

        //CASO SUPERADMIN
        $user = Auth::user();
        if (isset($user)) {
            flash('Cambio de fase registrado correctamente.', 'success');
            $arriendos = ArriendoActivo::get();

            return redirect()->route('activo.trazabilidad');
        }

        //CASO TRANSPORTE
        $arriendos = ArriendoActivo::whereNotIn('estado', ["TERMINADO"])->get();
        return redirect()->route('arriendo.transporte');

    }

    public function cambio_fase_create($id){

        //EN TODOS LOS CASOS "TRANSPORTE" DEBE INGRESAR DATOS PARA EL CAMBIO DE FASE
        //[FIRMA EL QUE PASA y RECIBE] (BODEGA), (EN CAMINO IDA) (FIRMA BODEGA Y CLIENTE)
        //[FIRMA EL QUE PASA y RECIBE] (EN CLIENTE y PARA RETIRO), (EN CAMINO VUELTA) (FIRMA CLIENTE Y BODEGA)
        $arriendo = ArriendoActivo::where('activo_id', $id)->whereNotIn('estado', ["TERMINADO"])->first();

        if(  $arriendo->estado == "BODEGA" || $arriendo->estado == "EN CAMINO IDA" || 
            ($arriendo->estado == "EN CLIENTE" && $arriendo->activo->estado == "PARA RETIRO") ||
             $arriendo->estado == "EN CAMINO VUELTA"){
            //dd($arriendo);
            return view('arriendo.cambio_fase')
                ->with('arriendo',  $arriendo);
        }else{
            //dd("entra");
            $arriendos = ArriendoActivo::whereNotIn('estado', ["TERMINADO"])->get();
            return view('arriendo.transporte')
                ->with('arriendos', $arriendos);
            //Casos en que se pueda cambiar directamente de fase (REDIRECT A OTRA RUTA POST)
            return redirect()->route('arriendo.cambio_fase');
        }
    }

    public function qr_reader(){
        return view('arriendo.qr_reader');
    }
}
