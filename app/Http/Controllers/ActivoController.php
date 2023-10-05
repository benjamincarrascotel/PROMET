<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

use App\Models\Activo;
use App\Models\ArriendoActivo;
use App\Models\Venta;
use App\Models\FamiliaProducto;
use App\Models\SubFamiliaProducto;
use App\Models\Proyecto;
use App\Models\Traspaso;
use App\Models\Empresa;
use App\Models\CambioFaseArriendo;

use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;




use Illuminate\Support\Facades\File;
use SimpleSoftwareIO\QrCode\Facades\QrCode;


use Validator;


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
        $familias = FamiliaProducto::get();
        $sub_familias = SubFamiliaProducto::get()->groupBy('familia_id');
        $selectedID = 0;
        return view('activo.create')
                ->with('selectedID', $selectedID)
                ->with('sub_familias', $sub_familias)
                ->with('familias', $familias);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request): RedirectResponse
    {
        $input = $request->all();

        $validated = $request->validate([
            'codigo_interno' => 'required|string|unique:activos',
            'sub_familia_id' => 'required|integer',
        ]);

        //dd($request->all());
        $activo = Activo::create([
            "sub_familia_id" => $input['sub_familia_id'],
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

            "tiempo_uso_meses" => $input['tiempo_uso_meses'],
            "centro_costos" => $input['centro_costos'],
            "tipo_moneda" => $input['tipo_moneda'],
        ]);

        //Creamos la ruta pública del activo
        File::makeDirectory(public_path('storage/activos/'.$activo->id));
        //Creamos la ruta pública para mantenciones
        File::makeDirectory(public_path('storage/mantenciones/'.$activo->id));

        //Generamos QR
        QrCode::generate($_ENV['APP_URL'].'/inventario/'.$activo->id, public_path("storage/activos/".$activo->id.'/QR_CODE.svg'));
        $activo->codigo_qr = 'QR_CODE.svg';

        // Guardamos la imagen
        if($request->hasFile('foto'))
        {
            $file = $request->file('foto');
            $type = $file->guessExtension();
            $nombre = 'activo_'.$activo->id.time().'.'.$type;

            $ruta = public_path("storage/activos/".$activo->id.'/'.$nombre);
            copy($file,$ruta);

            $activo->foto = $nombre;
        }

        // Guardamos los archivos
        if($request->hasFile('archivo'))
        {
            $archivo = $request->file('archivo');
            $type = $archivo->guessExtension();
            $nombre = 'archivo_'.$activo->id.time().'.'.$type;

            $ruta = public_path("storage/activos/".$activo->id.'/'.$nombre);
            copy($archivo,$ruta);

            $activo->archivo = $nombre;
        }

        if($request->hasFile('archivo2'))
        {
            $archivo2 = $request->file('archivo2');
            $type = $archivo2->guessExtension();
            $nombre = 'archivo2_'.$activo->id.time().'.'.$type;

            $ruta = public_path("storage/activos/".$activo->id.'/'.$nombre);
            copy($archivo2,$ruta);

            $activo->archivo2 = $nombre;
        }

        if($request->hasFile('archivo3'))
        {
            $archivo3 = $request->file('archivo3');
            $type = $archivo3->guessExtension();
            $nombre = 'archivo3_'.$activo->id.time().'.'.$type;

            $ruta = public_path("storage/activos/".$activo->id.'/'.$nombre);
            copy($archivo3,$ruta);

            $activo->archivo3 = $nombre;
        }

        $activo->save();

        $activos = Activo::get();

        flash("El activo se ha creado correctamente", "success");

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
        $familias = FamiliaProducto::get();
        $sub_familias = SubFamiliaProducto::get()->groupBy('familia_id');

        $n_arriendos = ArriendoActivo::where('activo_id', $id)->get()->count();
        return view('activo.show')
                ->with('familias', $familias)
                ->with('sub_familias', $sub_familias)
                ->with('n_arriendos', $n_arriendos)
                ->with('activo', $activo);
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
        $request->request->remove('_token');
        $request->request->remove('familia_id');
        $input = $request->all();

        $validated = $request->validate([
            'sub_familia_id' => 'required|integer',
        ]);

        $activo = Activo::where('id', $id)->update($request->all());
        $activo = Activo::where('id', $id)->first();

        //dd($input);

        // Manejo de imagen
        $file = null;
        if($request->hasFile('foto')){
            $file = $request->file('foto');
        }

        // Guardamos la imagen
        if($request->hasFile('foto'))
        {
            $type = $file->guessExtension();
            $nombre = 'activo_'.$activo->id.time().'.'.$type;

            $ruta = public_path("storage/activos/".$activo->id.'/'.$nombre);
            copy($file,$ruta);

            $activo->foto = $nombre;
            
        }

        // Guardamos los archivos
        if($request->hasFile('archivo'))
        {
            $archivo = $request->file('archivo');
            $type = $archivo->guessExtension();
            $nombre = 'archivo_'.$activo->id.time().'.'.$type;

            $ruta = public_path("storage/activos/".$activo->id.'/'.$nombre);
            copy($archivo,$ruta);

            $activo->archivo = $nombre;
        }

        if($request->hasFile('archivo2'))
        {
            $archivo2 = $request->file('archivo2');
            $type = $archivo2->guessExtension();
            $nombre = 'archivo2_'.$activo->id.time().'.'.$type;

            $ruta = public_path("storage/activos/".$activo->id.'/'.$nombre);
            copy($archivo2,$ruta);

            $activo->archivo2 = $nombre;
        }

        if($request->hasFile('archivo3'))
        {
            $archivo3 = $request->file('archivo3');
            $type = $archivo3->guessExtension();
            $nombre = 'archivo3_'.$activo->id.time().'.'.$type;

            $ruta = public_path("storage/activos/".$activo->id.'/'.$nombre);
            copy($archivo3,$ruta);

            $activo->archivo3 = $nombre;
        }

        $activo->save();

        flash("Los datos se han actualizado correctamente", "success");

        return redirect()->back();
        

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
        $proyectos = Proyecto::pluck('nombre', 'id');
        return view('activo.trazabilidad')
            ->with("proyectos", $proyectos)
            ->with('arriendos', $arriendos);
    }

    public function ingresar_arriendo_create($id)
    {
        $selectedID = $id;
        $activos = Activo::where('estado', "DISPONIBLE")->where('inoperativo', 0)->get();
        $proyectos = Proyecto::where('estado', 'ACTIVO')->get();

        return view('arriendo.create')
            ->with('proyectos', $proyectos)
            ->with('activos', $activos)
            ->with('selectedID', $selectedID);
    }

    public function ingresar_arriendo_store(Request $request)
    {
        $input = $request->all();
        $activo = Activo::where('id', $input['activo_id'])->first();
        if($activo->estado == "DISPONIBLE"){           

            //dd($request->all());
            $arriendo = ArriendoActivo::create([
                "activo_id" => $input['activo_id'],
                "proyecto_id" => $input['proyecto_id'],
                "monto" => $input['monto'],
                "tipo_moneda" => $input['tipo_moneda'],
                "fecha_inicio" => $input['fecha_inicio'],
                "fecha_termino" => $input['fecha_termino'],
                "encargado" => $input['encargado'],
                "estado" => 'BODEGA',
            ]);

            //Creamos la ruta pública primero
            File::makeDirectory(public_path('storage/arriendos/'.$arriendo->id));

            $activo->estado = 'PARA RETIRO';
            $activo->save();

            flash('Arriendo registrado correctamente.', 'success');

            $activos = Activo::get();

            return redirect()->route('activo.index')
                ->with('activos', $activos);
        }else{

            flash("El activo ya está en un proceso de arriendo.", "danger");
            return redirect()->back();
        }
    }

    public function transporte()
    {
        $arriendos = ArriendoActivo::whereNotIn('estado', ["TERMINADO"])->get()->reverse();
        return view('bodega.transporte')
            ->with('arriendos', $arriendos);
    }


    public function cambio_fase(Request $request)
    {
        //dd($request->all());
        $input = $request->all();
        //dd($input);
        $arriendo = ArriendoActivo::where('id', $input['arriendo_id'])->first();
        $activo = Activo::where('id', $arriendo->activo->id)->first();
        //dd($activo);

        //Dejar registro de cambio de fase
        $cambio_fase = CambioFaseArriendo::create([
            "arriendo_id" => $input['arriendo_id'],
            "fecha" => Carbon::now(),
        ]);

        if(isset($input['encargado']) && isset($input['firma'])){
            
            $cambio_fase->encargado = $input['encargado'];

            if(isset($input['firma'])){
                $nombre = 'firma_'.($arriendo->id)."_".time();
                //$ruta = storage_path("app/solicituds/".$solicitud->id.'/'.$nombre);
    
                //Storage::makeDirectory('solicituds/'.$solicitud->id);
    
                $base64_image = $input['firma']; // your base64 encoded     
                @list($type, $file_data) = explode(';', $base64_image);
                @list(, $file_data) = explode(',', $file_data); 
                $imageName = 'arriendos/'.$arriendo->id.'/'.$nombre.'.png';
    
                //Storage::disk('local')->put($imageName, base64_decode($file_data));
                Storage::disk('public')->put($imageName, base64_decode($file_data));
    
                // copy(base64_decode($input['plano_marcado']), $ruta);
                $cambio_fase->firma = $nombre.'.png';
                $cambio_fase->save();
            }

        }

        //Guardamos fase anterior
        $cambio_fase->fase_anterior = $arriendo->estado;

        switch ($arriendo->estado) {

            case 'BODEGA':
                if($activo->estado == "PARA RETIRO"){
                    $cambio_fase->etapa = 1;
                    $arriendo->estado = "EN CAMINO IDA";
                    $arriendo->save();
                    $activo->estado = "EN RUTA IDA";
                    $activo->save();
                }
                break;
            case 'EN CAMINO IDA':
                if($activo->estado == "EN RUTA IDA"){
                    $cambio_fase->etapa = 2;
                    $arriendo->estado = "EN CLIENTE";
                    $arriendo->save();
                    $activo->estado = "ARRENDADO";
                    $activo->save();
                }
                break;
            case 'EN CLIENTE':
                if($activo->estado == "ARRENDADO"){
                    $cambio_fase->etapa = 3;
                    $activo->estado = "PARA RETIRO";
                    $activo->save();
                }elseif($activo->estado == "PARA RETIRO"){
                    $cambio_fase->etapa = 4;
                    $arriendo->estado = "EN CAMINO VUELTA";
                    $arriendo->save();
                    $activo->estado = "EN RUTA VUELTA";
                    $activo->save();
                }
                break;
            case 'EN CAMINO VUELTA':
                if($activo->estado == "EN RUTA VUELTA"){
                    $cambio_fase->etapa = 5;
                    $arriendo->estado = "BODEGA DE VUELTA";
                    $arriendo->save();
                    $activo->estado = "RECIBIDO";
                    $activo->save();
                }
                break;
            case 'BODEGA DE VUELTA':
                if($activo->estado == "RECIBIDO"){
                    $cambio_fase->etapa = 6;
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
        $cambio_fase->fase_actual = $arriendo->estado;
        $cambio_fase->save();

        flash('Cambio de fase registrado correctamente.', 'success');

        //CASO SUPERADMIN
        $user = Auth::user();
        if (isset($user) && $user->superadmin) {
            $arriendos = ArriendoActivo::get();
            return redirect()->back();

        }else{
            //CASO BODEGA O ADMIN
            $arriendos = ArriendoActivo::whereNotIn('estado', ["TERMINADO"])->get();
            return redirect()->route('arriendo.transporte');
        }

        

    }

    public function cambio_fase_create($id){

        //EN TODOS LOS CASOS "TRANSPORTE" DEBE INGRESAR DATOS PARA EL CAMBIO DE FASE
        //[FIRMA EL QUE PASA y RECIBE] (BODEGA), (EN CAMINO IDA) (FIRMA BODEGA Y CLIENTE)
        //[FIRMA EL QUE PASA y RECIBE] (EN CLIENTE y PARA RETIRO), (EN CAMINO VUELTA) (FIRMA CLIENTE Y BODEGA)
        $arriendo = ArriendoActivo::where('activo_id', $id)->whereNotIn('estado', ["TERMINADO"])->first();

        if(  $arriendo->estado == "BODEGA" || $arriendo->estado == "EN CAMINO IDA" || 
            ($arriendo->estado == "EN CLIENTE" && $arriendo->activo->estado == "PARA RETIRO") ||
             $arriendo->estado == "EN CAMINO VUELTA"){

            //TODO dejar registro de cambio de fase


            return view('bodega.cambio_fase')
                ->with('arriendo',  $arriendo);
        }else{
            //dd("entra");
            $arriendos = ArriendoActivo::whereNotIn('estado', ["TERMINADO"])->get();
            return view('bodega.transporte')
                ->with('arriendos', $arriendos);
            //Casos en que se pueda cambiar directamente de fase (REDIRECT A OTRA RUTA POST)
            return redirect()->route('arriendo.cambio_fase');
        }
    }

    public function qr_reader(){
        return view('bodega.qr_reader');
    }


    public function show_arriendo($id)
    {
        $arriendo = ArriendoActivo::where('id', $id)->first();
        $traspasos = Traspaso::where('arriendo_id', $id)->get();

        return view('arriendo.show')
                ->with('traspasos', $traspasos)
                ->with('arriendo', $arriendo);
    }

    public function update_arriendo(Request $request, $id)
    {
        $request->request->remove('_token');
        $input = $request->all();
        $arriendo = ArriendoActivo::where('id', $id)->update($request->all());
        $arriendo = ArriendoActivo::where('id', $id)->first();

        flash("Los datos se han actualizado correctamente", "success");

        return redirect()->back();
        

    }

    public function venta_create($id)
    {
        $activo = Activo::where('id', $id)->first();
        $proyectos = Proyecto::where('estado', 'ACTIVO')->get();
        $selectedID = 0;
        return view('venta.create')
                ->with('selectedID', $selectedID)
                ->with('proyectos', $proyectos)
                ->with('activo', $activo);
    }

    public function venta_store(Request $request)
    {
        $input = $request->all();

        $activo = Activo::where('id', $input['activo_id'])->first();
        $activo->estado = "VENDIDO";
        $activo->save();

        // Manejo de imagen
        $file = null;
        if($request->hasFile('cotizacion_venta')){
            $file = $request->file('cotizacion_venta');
        }

        //dd($request->all());
        $venta = Venta::create([
            "activo_id" => $input['activo_id'],
            "precio_venta" => $input['precio_venta'],
            "tipo_moneda" => $input['tipo_moneda'],
            "fecha_venta" => $input['fecha_venta'],
            "proyecto_id" => $input['proyecto_id'],
            "contacto_cliente" => $input['contacto_cliente'],
            "estado" => "EN PROCESO",
        ]);

        // Guardamos la imagen
        if($request->hasFile('cotizacion_venta'))
        {
            $type = $file->guessExtension();
            $nombre = 'cotizacion_venta_'.$input['activo_id']."_".time().'.'.$type;

            $ruta = public_path("storage/activos/".$input['activo_id'].'/'.$nombre);
            copy($file,$ruta);

            $venta->cotizacion_venta = $nombre;
            $venta->save();
        }

        flash("La venta del activo se ha sido realizado correctamente", 'success');
        $activos = Activo::get();

        return redirect()->route('activo.index')
            ->with('activos', $activos);
    }


    public function venta_finish(Request $request)
    {
        $input = $request->all();

        $venta = Venta::where('activo_id', $input['activo_id_venta'])->where('estado', 'EN PROCESO')->first();
        $venta->estado = "TERMINADA";
        
        // Manejo de imagen
        $file = null;
        if($request->hasFile('documento')){
            $file = $request->file('documento');

            $type = $file->guessExtension();
            $nombre = 'comprobante_venta_'.$input['activo_id_venta']."_".time().'.'.$type;

            $ruta = public_path("storage/activos/".$input['activo_id_venta'].'/'.$nombre);
            copy($file,$ruta);

            $venta->comprobante_termino = $nombre;
            

        }

        $venta->save();

        $activo = Activo::where('id', $input['activo_id_venta'])->first();
        $activo->estado = "NO DISPONIBLE";
        $activo->save();

        $activos = Activo::get();

        flash("Se ha terminado el proceso de venta correctamente.", "success");

        return redirect()->back()->with('activos', $activos);
    }

    public function traspaso_create($id){

        $arriendo = ArriendoActivo::where('id', $id)->whereNotIn('estado', ["TERMINADO"])->first();
        $proyectos = Proyecto::whereNotIn('id', [$arriendo->proyecto_id])->where('estado', 'ACTIVO')->get()->groupBy('empresa_id');
        $empresas = Empresa::get();
        $selectedID = 0;

        if($arriendo->estado == "EN CLIENTE"){
            return view('traspaso.create')
                ->with('empresas', $empresas)
                ->with('selectedID', $selectedID)
                ->with('proyectos', $proyectos)
                ->with('arriendo',  $arriendo);
        }else{
            $arriendos = ArriendoActivo::get();
            flash("No es posible traspasar este arriendo.", "danger");
            return redirect()->back()->with('arriendos', $arriendos);
        }
    }

    public function traspaso_store(Request $request)
    {
        $validated = $request->validate([
            'proyecto_actual_id' => 'required|integer',
        ]);
        $input = $request->all();
        

        $arriendo = ArriendoActivo::where('id', $input['arriendo_id'])->first();

        // Manejo de imagen
        /*
        $file = null;
        if($request->hasFile('cotizacion_venta')){
            $file = $request->file('cotizacion_venta');
        }
        */

        //dd($request->all());
        $traspaso = Traspaso::create([
            "arriendo_id" => $input['arriendo_id'],
            "fecha_traspaso" => $input['fecha_traspaso'],
            "monto_anterior" => $arriendo->monto,
            "tipo_moneda_anterior" => $arriendo->tipo_moneda,
            "proyecto_anterior_id" => $input['proyecto_anterior_id'],
            "proyecto_actual_id" => $input['proyecto_actual_id'],
        ]);

        // Actualizamos el arriendo
        $arriendo->proyecto_id = $input['proyecto_actual_id'];
        $arriendo->monto = $input['monto'];
        $arriendo->tipo_moneda = $input['tipo_moneda'];
        $arriendo->save();

        // Guardamos la imagen
        /*
        if($request->hasFile('cotizacion_venta'))
        {
            $type = $file->guessExtension();
            $nombre = 'cotizacion_venta_'.$input['activo_id']."_".time().'.'.$type;

            $ruta = public_path("storage/activos/".$input['activo_id'].'/'.$nombre);
            copy($file,$ruta);

            $venta->cotizacion_venta = $nombre;
            $venta->save();
        }
        */

        flash("El traspaso del arriendo se ha sido realizado correctamente", 'success');
        $arriendos = ArriendoActivo::get();

        return redirect()->route('activo.trazabilidad')
            ->with('arriendos', $arriendos);
    }

}
