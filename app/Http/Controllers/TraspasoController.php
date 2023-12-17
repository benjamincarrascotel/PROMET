<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Schema;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

use App\Models\Activo;
use App\Models\ArriendoActivo;
use App\Models\Venta;
use App\Models\FamiliaProducto;
use App\Models\SubFamiliaProducto;
use App\Models\Proyecto;
use App\Models\Traspaso;
use App\Models\TraspasoVenta;
use App\Models\Empresa;
use App\Models\CambioFaseArriendo;
use App\Models\CambioFaseVenta;
use App\Models\BajaActivo;
use App\Models\Mantencion;

use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

use Maatwebsite\Excel\Facades\Excel;
use App\Imports\ImportExcel;
use Barryvdh\DomPDF\Facade\Pdf;

use DataTables;

use Illuminate\Support\Facades\File;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

use App\Exports\ProcesosExport;


use Validator;

class TraspasoController extends Controller
{
    public function traspaso_arriendo_create($id){

        $arriendo = ArriendoActivo::where('id', $id)->whereNotIn('estado', ["TERMINADO"])->first();
        $proyectos = Proyecto::whereNotIn('id', [$arriendo->proyecto_id])->where('estado', 'ACTIVO')->get()->groupBy('empresa_id');
        $empresas = Empresa::get();
        $selectedID = 0;

        if($arriendo->estado == "EN CLIENTE"){
            $proceso = $arriendo;
            $proceso['proceso_flag'] = 0;
            return view('traspaso.create')
                ->with('empresas', $empresas)
                ->with('selectedID', $selectedID)
                ->with('proyectos', $proyectos)
                ->with('proceso',  $proceso);
        }else{
            flash("No es posible traspasar este arriendo.", "danger");
            return redirect()->back();
        }
    }

    public function traspaso_venta_create($id){

        $venta = Venta::where('id', $id)->whereNotIn('estado', ["TERMINADO"])->first();
        $proyectos = Proyecto::whereNotIn('id', [$venta->proyecto_id])->where('estado', 'ACTIVO')->get()->groupBy('empresa_id');
        $empresas = Empresa::get();
        $selectedID = 0;

        if($venta->estado == "EN CLIENTE"){
            $proceso = $venta;
            $proceso['proceso_flag'] = 1;
            return view('traspaso.create')
                ->with('empresas', $empresas)
                ->with('selectedID', $selectedID)
                ->with('proyectos', $proyectos)
                ->with('proceso',  $proceso);
        }else{
            flash("No es posible traspasar este arriendo.", "danger");
            return redirect()->back();
        }
    }

    public function traspaso_store(Request $request)
    {
        $validated = $request->validate([
            'proyecto_actual_id' => 'required|integer',
        ]);

        $input = $request->all();

        if(isset($input['estado-checkbox_traspaso'])){

            // Determinamos que tipo de proceso es
            if(isset($input['arriendo_id'])){
                

                $arriendo = ArriendoActivo::where('id', $input['arriendo_id'])->first();

                // Creamos una nueva venta
                $venta = Venta::create([
                    "activo_id" => $arriendo['activo_id'],
                    "precio_venta" => $input['monto'],
                    "tipo_moneda" => $input['tipo_moneda'],
                    "fecha_inicio" => $arriendo['fecha_inicio'],
                    "fecha_termino" => $arriendo['fecha_termino'],
                    "proyecto_id" => $input['proyecto_actual_id'],
                    "encargado" => $arriendo['encargado'],
                    "estado" => $arriendo['estado'],
                    "observaciones" => $arriendo['observaciones'],
                ]);
    
                if(!File::exists('storage/ventas/'.$venta->id)) {
                    // Creamos la ruta pública primero
                    File::makeDirectory(public_path('storage/ventas/'.$venta->id));
                }

                // Registramos traspaso

                $traspaso = TraspasoVenta::create([
                    "venta_id" => $venta->id,
                    "fecha_traspaso" => $input['fecha_traspaso'],
                    "precio_venta_anterior" => $arriendo->monto,
                    "tipo_moneda_anterior" => $arriendo->tipo_moneda,
                    "proyecto_anterior_id" => $input['proyecto_anterior_id'],
                    "proyecto_actual_id" => $input['proyecto_actual_id'],
                    "proceso_cambio_flag" => true,
                    "proceso_anterior_id" => $arriendo['id'],
                ]);

                // Actualizamos el Activo
                $activo = Activo::where('id', $arriendo->activo_id)->first();
                $activo->arriendo_flag = false;
                $activo->venta_flag = true;
                $activo->save();

                // Cambiamos de estado el arriendo anterior
                $arriendo->estado = "CAMBIO DE PROCESO";
                $arriendo->save();
        
                flash("El traspaso desde el ARRIENDO [ID:".$arriendo->id."] a la VENTA [ID:".$venta->id."] se ha realizado correctamente", 'success');

            }elseif(isset($input['venta_id'])){

                $venta = Venta::where('id', $input['venta_id'])->first();

                // Creamos un nuevo arriendo
                $arriendo = ArriendoActivo::create([
                    "activo_id" => $venta['activo_id'],
                    "monto" => $input['precio_venta'],
                    "tipo_moneda" => $input['tipo_moneda'],
                    "fecha_inicio" => $venta['fecha_inicio'],
                    "fecha_termino" => $venta['fecha_termino'],
                    "proyecto_id" => $input['proyecto_actual_id'],
                    "encargado" => $venta['encargado'],
                    "estado" => $venta['estado'],
                    "observaciones" => $venta['observaciones'],
                ]);
    

                if(!File::exists('storage/arriendos/'.$arriendo->id)) {
                    // Creamos la ruta pública primero
                    File::makeDirectory(public_path('storage/arriendos/'.$arriendo->id));
                }

                // Registramos traspaso
                $traspaso = Traspaso::create([
                    "arriendo_id" => $arriendo->id,
                    "fecha_traspaso" => $input['fecha_traspaso'],
                    "monto_anterior" => $venta->precio_venta,
                    "tipo_moneda_anterior" => $venta->tipo_moneda,
                    "proyecto_anterior_id" => $input['proyecto_anterior_id'],
                    "proyecto_actual_id" => $input['proyecto_actual_id'],
                    "proceso_cambio_flag" => true,
                    "proceso_anterior_id" => $venta['id'],
                ]);

                // Actualizamos el Activo
                $activo = Activo::where('id', $venta->activo_id)->first();
                $activo->arriendo_flag = true;
                $activo->venta_flag = false;
                $activo->save();

                // Cambiamos de estado de la venta anterior
                $venta->estado = "CAMBIO DE PROCESO";
                $venta->save();
        
                flash("El traspaso desde la VENTA [ID:".$venta->id."] al ARRIENDO [ID:".$arriendo->id."] se ha realizado correctamente", 'success');

            }else{
                flash("Error: No hay concordancia en nuestros registros.", 'danger');
                return back();
            }


        }else{

            if(isset($input['arriendo_id'])){
                $arriendo = ArriendoActivo::where('id', $input['arriendo_id'])->first();
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
        
                flash("El traspaso del arriendo ha sido realizado correctamente", 'success');
    
            }elseif(isset($input['venta_id'])){
                $venta = Venta::where('id', $input['venta_id'])->first();
                //dd($venta);
                $traspaso = TraspasoVenta::create([
                    "venta_id" => $input['venta_id'],
                    "fecha_traspaso" => $input['fecha_traspaso'],
                    "precio_venta_anterior" => $venta->precio_venta,
                    "tipo_moneda_anterior" => $venta->tipo_moneda,
                    "proyecto_anterior_id" => $input['proyecto_anterior_id'],
                    "proyecto_actual_id" => $input['proyecto_actual_id'],
                ]);
        
                // Actualizamos el arriendo
                $venta->proyecto_id = $input['proyecto_actual_id'];
                $venta->precio_venta = $input['precio_venta'];
                $venta->tipo_moneda = $input['tipo_moneda'];
                $venta->save();
        
                flash("El traspaso de la venta ha sido realizado correctamente", 'success');
    
            }else{
                flash("Error: No hay concordancia en nuestros registros.", 'danger');
                return back();
            }

        }

        return redirect()->route('activo.trazabilidad');
    }

    

}
