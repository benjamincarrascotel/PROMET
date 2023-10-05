<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Proyecto;
use App\Models\Empresa;

class ProyectoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $proyectos = Proyecto::get();
        $empresas = Empresa::pluck('nombre', 'id');
        return view('proyecto.index')
                ->with('empresas', $empresas)
                ->with('proyectos', $proyectos);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $empresas = Empresa::get();
        return view('proyecto.create')
                ->with('empresas', $empresas);
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
        $proyecto = Proyecto::create([
            "nombre" => $input['nombre'],
            "empresa_id" => $input['empresa_id'],
            "centro_costo" => $input['centro_costo'],

            "objeto_imputacion" => $input['objeto_imputacion'],
            "area" => $input['area'],
            "sociedad_sap" => $input['sociedad_sap'],
            "codigo_sap" => $input['codigo_sap'],
            "nombre_sap" => $input['nombre_sap'],

            "estado" => "ACTIVO",
        ]);

        flash("El proyecto se ha creado correctamente", "success");

        $proyectos = Proyecto::get();

        return redirect()->route('proyecto.index')
            ->with('proyectos', $proyectos);
    }

    public function cambio_estado(Request $request)
    {
        $proyecto = Proyecto::where('id', $request->input("proyecto_id"))->first();
        switch ($proyecto->estado) {
            case 'ACTIVO':
                $proyecto->estado="INACTIVO";
                break;
            default:
                $proyecto->estado="ACTIVO";
                break;
        }
        $proyecto->save();
        
        return $proyecto->estado;
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
}
