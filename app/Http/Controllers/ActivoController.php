<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Activo;
use App\Models\ArriendoActivo;



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
        $arriendos = ArriendoActivo::whereNotIn('estado', ["TERMINADO"])->get();
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
}
