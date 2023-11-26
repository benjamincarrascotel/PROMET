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

class VentaController extends Controller
{

    public function show($id)
    {
        $venta = Venta::where('id', $id)->first();
        $traspasos = TraspasoVenta::where('venta_id', $id)->get();
        $cambios_fases = CambioFaseVenta::where('venta_id', $venta->id)->get()->groupBy('etapa');

        return view('venta.show')
            ->with('cambios_fases', $cambios_fases)
            ->with('traspasos', $traspasos)
            ->with('venta', $venta);
    }

    public function create($id)
    {
        $activo = Activo::where('id', $id)->first();
        $empresas = Empresa::get();
        $proyectos = Proyecto::where('estado', 'ACTIVO')->get()->groupBy('empresa_id');
        $selectedID = 0;
        return view('venta.create')
            ->with('empresas', $empresas)
            ->with('selectedID', $selectedID)
            ->with('proyectos', $proyectos)
            ->with('activo', $activo);
    }

    public function store(Request $request)
    {
        $input = $request->all();

        $validated = $request->validate([
            'proyecto_id' => 'required|integer',
        ]);

        $activo = Activo::where('id', $input['activo_id'])->first();

        if($activo->estado == "DISPONIBLE" && !$activo->venta_flag && !$activo->arriendo_flag){   
            $activo->estado = "PARA RETIRO";
            $activo->venta_flag = true;
            
            $activo->save();

            /* Manejo de imagen
            $file = null;
            if($request->hasFile('cotizacion_venta')){
                $file = $request->file('cotizacion_venta');
            }
            */

            $fecha_termino = null;
            if(isset($input['fecha_termino'])) $fecha_termino = $input['fecha_termino'];

            $observaciones = null;
            if(isset($input['observaciones'])){
                $observaciones = $input['observaciones'];
            }


            $venta = Venta::create([
                "activo_id" => $input['activo_id'],
                "precio_venta" => $input['precio_venta'],
                "tipo_moneda" => $input['tipo_moneda'],
                "fecha_inicio" => $input['fecha_inicio'],
                "fecha_termino" => $fecha_termino,
                "proyecto_id" => $input['proyecto_id'],
                "encargado" => $input['encargado'],
                "estado" => "BODEGA",
                "observaciones" => $observaciones,
            ]);

            //Creamos la ruta pública primero
            File::makeDirectory(public_path('storage/ventas/'.$venta->id));

            /* Guardamos la imagen
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

            flash("La venta del activo se ha sido realizado correctamente", 'success');
            $activos = Activo::get();

            return redirect()->route('activo.index')
                ->with('activos', $activos);
        }else{
            flash("El activo ya está en un proceso de venta o arriendo.", "danger");
            return redirect()->back();
        }
    }


    public function update(Request $request, $id)
    {
        $request->request->remove('_token');
        $input = $request->all();
        $venta = Venta::where('id', $id)->update($request->all());
        $venta = Venta::where('id', $id)->first();

        flash("Los datos se han actualizado correctamente", "success");

        return redirect()->back();

    }

    public function carga_masiva(Request $request)
    {

        $validated = $request->validate([
            'documento' => 'required|mimes:xlsx,xls',
        ]);

        try{

            Venta::truncate();

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

                    $venta = Venta::firstOrCreate(['activo_id' => $row[$columnas_ids['activo_id']]],
                    [
                        "id" => $cont,
                        "activo_id" => $row[$columnas_ids['activo_id']],
                        "proyecto_id" => $proyecto->id,
                        "precio_venta" => $row[$columnas_ids['precio_venta']],
                        "tipo_moneda" => $row[$columnas_ids['tipo_moneda']],
                        "fecha_inicio" => new Carbon('2023-10-1'),
                        "fecha_termino" => null,
                        "encargado" => $row[$columnas_ids['encargado']],
                        "estado" => "EN CLIENTE",
                    ]);

                    $activo = Activo::where('id', $row[$columnas_ids['activo_id']])->first();
                    $activo->estado = "ARRENDADO";
                    $activo->arriendo_flag = false;
                    $activo->venta_flag = true;
                    $activo->inoperativo = false;
                    $activo->save();

                    if(!File::exists('storage/ventas/'.$venta->id)) {
                        //Creamos la ruta pública primero
                        File::makeDirectory(public_path('storage/ventas/'.$venta->id));
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
