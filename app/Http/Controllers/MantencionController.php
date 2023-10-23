<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Activo;
use App\Models\Mantencion;
use App\Models\ArriendoActivo;
use App\Models\Venta;
use App\Models\Empresa;
use App\Models\Proyecto;

use Illuminate\Support\Facades\File;

class MantencionController extends Controller
{
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
    public function create($id)
    {
        $activo = Activo::where('id', $id)->first();
        return view('mantencion.create')
                ->with('activo', $activo);
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
        if($request->hasFile('cotizacion_mantencion')){
            $file = $request->file('cotizacion_mantencion');
        }

        $fecha_termino = null;
        if(isset($input['fecha_termino'])) $fecha_termino = $input['fecha_termino'];

        $observaciones = null;
        if(isset($input['observaciones'])){
            $observaciones = $input['observaciones'];
        }

        $mantencion = Mantencion::create([
            "activo_id" => $input['activo_id'],
            "costo_mantencion" => $input['costo_mantencion'],
            "tipo_moneda" => $input['tipo_moneda'],
            "fecha_inicio" => $input['fecha_inicio'],
            "fecha_termino" => $fecha_termino,
            "rut_proveedor" => $input['rut_proveedor'],
            "nombre_proveedor" => $input['nombre_proveedor'],
            "contacto_proveedor" => $input['contacto_proveedor'],
            "estado" => "EN PROCESO",
            "observaciones" => $observaciones,
        ]);

        // Guardamos la imagen
        if($request->hasFile('cotizacion_mantencion'))
        {
            $type = $file->guessExtension();
            $nombre = 'cotizacion_mantencion_'.$input['activo_id']."_".time().'.'.$type;

            $ruta = public_path("storage/mantenciones/".$input['activo_id'].'/'.$nombre);
            copy($file,$ruta);

            $mantencion->cotizacion_mantencion = $nombre;
            $mantencion->save();
        }

        // Actualizamos estado del activo
        $activo = Activo::where('id', $input['activo_id'])->first();
        $activo->estado = "EN MANTENCION";
        $activo->save();

        $activos = Activo::get();

        flash("La mantención ha sido registrada correctamente", 'success');

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
        //
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

    public function finish(Request $request)
    {
        $input = $request->all();

        $mantencion = Mantencion::where('activo_id', $input['activo_id'])->where('estado', 'EN PROCESO')->first();
        $mantencion->estado = "TERMINADA";
        
        // Manejo de imagen
        $file = null;
        if($request->hasFile('documento')){
            $file = $request->file('documento');

            $type = $file->guessExtension();
            $nombre = 'comprobante_termino_'.$input['activo_id']."_".time().'.'.$type;

            $ruta = public_path("storage/mantenciones/".$input['activo_id'].'/'.$nombre);
            copy($file,$ruta);

            $mantencion->comprobante_termino = $nombre;
            

        }

        $mantencion->save();

        $activo = Activo::where('id', $input['activo_id'])->first();
        //$arriendo = ArriendoActivo::where('activo_id', $input['activo_id'])->where("estado", "BODEGA DE VUELTA")->first();
        //$venta = Venta::where('activo_id', $input['activo_id'])->first();


        if($activo->arriendo_flag || $activo->venta_flag){
            $activo->estado = "RECIBIDO";
        }else{
            $activo->estado = "DISPONIBLE";
        }
        $activo->save();

        flash("Se ha terminado la mantención correctamente.", "success");

        if(isset($input['estado-checkbox'])){
            $empresas = Empresa::get();
            $proyectos = Proyecto::get()->groupBy('empresa_id');

            return view('baja_activo.create')
                ->with('empresas', $empresas)
                ->with('proyectos', $proyectos)
                ->with('activo', $activo);
        }

        return redirect()->back();
    }
}
