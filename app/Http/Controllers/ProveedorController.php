<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Proveedor;

class ProveedorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $proveedores = Proveedor::get();
        //dd("hola");
        return view('proveedor.index', compact('proveedores'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $selectedID = 0;
        $error = null;
        
        return view('proveedor.create', compact('selectedID', 'error'));

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

        //dd(strlen($input['rut']));
        if(strlen($input['rut'])>= 10){

            $rut_parsed = explode('-',$input['rut']);
            //Seteamos valores de checkboxes
            if(!isset($input['cheque_checkbox'])){
                $input['cheque_checkbox'] = 0;
                $request['cheque_checkbox'] = 0;
            }
            if(!isset($input['vale_vista_checkbox'])){
                $input['vale_vista_checkbox'] = 0;
                $request['vale_vista_checkbox'] = 0;
            }
            //dd($input);


            // Verificamos si existe y actualizamos o creamos nuevo registro
            $data = $request->except('_token');
            $data['rut'] = $rut_parsed[0];
            $data['rut_dv'] = $rut_parsed[1];
            $existente = Proveedor::where('rut', $rut_parsed[0])->first();
            $actualizado_flag = 0;
            //dd($data);
            if($existente === null){
                $nuevo = Proveedor::create($data);
                return view('proveedor.created_success')->with('nombre', $nuevo['nombre']);

            }else{
                $actualizado_flag = 1;
                $existente->update($data);
                return view('proveedor.created_success')->with('nombre', $existente['nombre']);

            }        
            
        }else{
            return view('proveedor.create')->with('error', "Error en el formato del rut.");
        }
        
    }

    public function store2(Request $request)
    {
        $input = $request->all();

        
        //dd($input);


        // Verificamos si existe y actualizamos o creamos nuevo registro
        $data = $request->except('_token');
        $existente = Proveedor::where('id', $input['id'])->first();
        $actualizado_flag = 0;
        if($existente === null){
            flash("Error, proveedor no encontrado.", 'danger');
            return redirect()->route('proveedor.index');
        }else{
            $actualizado_flag = 1;
            $existente->update($data);
        }

        flash("Datos de Proveedor actualizados con éxito.", 'success');

        return redirect()->route('proveedor.show', [$existente->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $proveedor = Proveedor::find($id);
        return view('proveedor.show', compact('proveedor'));
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
