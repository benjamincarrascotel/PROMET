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

use DataTables;

use Illuminate\Support\Facades\File;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class ArriendoController extends Controller
{

    public function cambio_fase_create($id){
        //EN TODOS LOS CASOS "TRANSPORTE" DEBE INGRESAR DATOS PARA EL CAMBIO DE FASE
        //[FIRMA EL QUE PASA y RECIBE] (BODEGA), (EN CAMINO IDA) (FIRMA BODEGA Y CLIENTE)
        //[FIRMA EL QUE PASA y RECIBE] (EN CLIENTE y PARA RETIRO), (EN CAMINO VUELTA) (FIRMA CLIENTE Y BODEGA)
        //Verificación de proceso actual
        $activo = Activo::where('id', $id)->first();
        if($activo->arriendo_flag && !$activo->venta_flag)
            $proceso = ArriendoActivo::where('activo_id', $id)->whereNotIn('estado', ["TERMINADO"])->first();
        elseif($activo->venta_flag && !$activo->arriendo_flag)
            $proceso = Venta::where('activo_id', $id)->whereNotIn('estado', ["TERMINADO"])->first();
        else{
            flash("Error: Los registros de trazabilidad no coinciden.", "danger");
            return redirect()->back();
        }
            

        if(  $proceso->estado == "BODEGA" || $proceso->estado == "EN CAMINO IDA" || 
            ($proceso->estado == "EN CLIENTE" && $proceso->activo->estado == "PARA RETIRO") ||
             $proceso->estado == "EN CAMINO VUELTA"){

            return view('bodega.cambio_fase')
                ->with('proceso',  $proceso);
        }else{
            flash("Error: Asegúrese de haber disponibilizado el proceso para su retiro (EN CLIENTE).", "danger");
            $empresas = Empresa::get();
            $proyectos = Proyecto::get()->groupBy('empresa_id');
            $selectedID = 0;

            $arriendos = ArriendoActivo::whereNotIn('estado', ["TERMINADO"])->get()->reverse();
            $ventas = Venta::whereNotIn('estado', ["TERMINADO"])->get()->reverse();
            return view('bodega.transporte')
                ->with('empresas', $empresas)
                ->with('proyectos', $proyectos)
                ->with('selectedID', $selectedID)
                ->with('ventas', $ventas)
                ->with('arriendos', $arriendos);
            }
    }

    public function show($id)
    {
        $arriendo = ArriendoActivo::where('id', $id)->first();
        $traspasos = Traspaso::where('arriendo_id', $id)->get();
        $cambios_fases = CambioFaseArriendo::where('arriendo_id', $arriendo->id)->get()->groupBy('etapa');

        return view('arriendo.show')
            ->with('cambios_fases', $cambios_fases)
            ->with('traspasos', $traspasos)
            ->with('arriendo', $arriendo);
    }


    public function create($id)
    {
        $selectedID = $id;
        $activos = Activo::where('estado', "DISPONIBLE")->where('inoperativo', 0)->get();
        $empresas = Empresa::get();
        $proyectos = Proyecto::where('estado', 'ACTIVO')->get()->groupBy('empresa_id');

        return view('arriendo.create')
            ->with('empresas', $empresas)
            ->with('proyectos', $proyectos)
            ->with('activos', $activos)
            ->with('selectedID', $selectedID);
    }

    public function store(Request $request)
    {
        $input = $request->all();

        $validated = $request->validate([
            'proyecto_id' => 'required|integer',
        ]);

        $activo = Activo::where('id', $input['activo_id'])->first();
        $observaciones = null;
        if(isset($input['observaciones'])){
            $observaciones = $input['observaciones'];
        }
        if($activo->estado == "DISPONIBLE" && !$activo->venta_flag && !$activo->arriendo_flag){           

            $fecha_termino = null;
            if(isset($input['fecha_termino'])) $fecha_termino = $input['fecha_termino'];
            $arriendo = ArriendoActivo::create([
                "activo_id" => $input['activo_id'],
                "proyecto_id" => $input['proyecto_id'],
                "monto" => $input['monto'],
                "tipo_moneda" => $input['tipo_moneda'],
                "fecha_inicio" => $input['fecha_inicio'],
                "fecha_termino" => $fecha_termino,
                "encargado" => $input['encargado'],
                "estado" => 'BODEGA',
                "observaciones" => $observaciones,
            ]);

            if(!File::exists('storage/arriendos/'.$arriendo->id)) {
                //Creamos la ruta pública primero
                File::makeDirectory(public_path('storage/arriendos/'.$arriendo->id));
            }

            $activo->estado = 'PARA RETIRO';
            $activo->arriendo_flag = true;
            $activo->save();

            flash('Arriendo registrado correctamente.', 'success');

            $activos = Activo::get();

            return redirect()->route('activo.index')
                ->with('activos', $activos);
        }else{

            flash("El activo ya está en un proceso de arriendo o venta.", "danger");
            return redirect()->back();
        }
    }

    public function update(Request $request, $id)
    {
        $request->request->remove('_token');
        $input = $request->all();
        $arriendo = ArriendoActivo::where('id', $id)->update($request->all());
        $arriendo = ArriendoActivo::where('id', $id)->first();

        flash("Los datos se han actualizado correctamente", "success");

        return redirect()->back();
        

    }

    public function carga_masiva(Request $request)
    {
        
        $validated = $request->validate([
            'documento' => 'required|mimes:xlsx,xls',
        ]);

        try {

            ArriendoActivo::truncate();

            $input = $request->all();

            $rows = Excel::toArray(new ImportExcel(), $request->file('documento'))[0];
            
            $column_list = $rows[0];

            $indices = [0,1,2,3,4,5,6,7];
            $columnas_ids = array_intersect_key($column_list, array_flip($indices));
            // nombre_columna => posicion_excel
            $columnas_ids = array_flip($columnas_ids);
            
            //dd($row[$columnas_ids['sub_familia_id']]);
            $cont = 0;
            foreach($rows as $row){
                if($cont > 0 ){

                    $proyecto = Proyecto::where('codigo_sap', $row[$columnas_ids['codigo_sap']])->first();

                    $arriendo = ArriendoActivo::firstOrCreate(['activo_id' => $row[$columnas_ids['activo_id']]],
                    [
                        "id" => $cont,
                        "activo_id" => $row[$columnas_ids['activo_id']],
                        "proyecto_id" => $proyecto->id,
                        "monto" => $row[$columnas_ids['monto']],
                        "tipo_moneda" => $row[$columnas_ids['tipo_moneda']],
                        "fecha_inicio" => new Carbon('2023-10-1'),
                        "fecha_termino" => null,
                        "encargado" => $row[$columnas_ids['encargado']],
                        "estado" => "EN CLIENTE",
                    ]);

                    $activo = Activo::where('id', $row[$columnas_ids['activo_id']])->first();
                    $activo->estado = "ARRENDADO";
                    $activo->arriendo_flag = true;
                    $activo->venta_flag = false;
                    $activo->inoperativo = false;
                    $activo->save();

                    if(!File::exists('storage/arriendos/'.$arriendo->id)) {
                        //Creamos la ruta pública primero
                        File::makeDirectory(public_path('storage/arriendos/'.$arriendo->id));
                    }


                }
                $cont +=1;
            }

            flash("Los datos se han registrado correctamente", "success");
            return back();
        }catch (Exception $e) {
            return response()->json(['message' => 'Something went wrong. Please try again later.'], 500);
        }
    }
}
