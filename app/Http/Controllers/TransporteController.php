<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Schema;

use Illuminate\Http\Request;

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

use DataTables;

use Illuminate\Support\Facades\File;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

use App\Exports\ProcesosExport;


use Validator;


class TransporteController extends Controller
{
    
    public function transporte()
    {
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


    public function cambio_fase(Request $request)
    {
        $input = $request->all();

        $arriendo_venta_flag = 0;

        //Verificación de proceso actual
        $activo = Activo::where('id', $input['activo_id'])->first();
        if($activo->arriendo_flag && !$activo->venta_flag){
            $proceso = ArriendoActivo::where('activo_id', $input['activo_id'])->whereNotIn('estado', ["TERMINADO"])->first();
            $cambio_fase = CambioFaseArriendo::create([
                "arriendo_id" => $proceso->id,
                "fecha" => Carbon::now(),
            ]);
            $arriendo_venta_flag = 1;
        }
        elseif($activo->venta_flag && !$activo->arriendo_flag){
            $proceso = Venta::where('activo_id', $input['activo_id'])->whereNotIn('estado', ["TERMINADO"])->first();
            $cambio_fase = CambioFaseVenta::create([
                "venta_id" => $proceso->id,
                "fecha" => Carbon::now(),
            ]);
            $arriendo_venta_flag = 2;
        }
        else{
            flash("Error: Los registros de trazabilidad no coinciden.", "danger");
            return redirect()->back();
        }

        //Guardamos la firma y encargado
        if(isset($input['encargado']) && isset($input['firma'])){
            
            $cambio_fase->encargado = $input['encargado'];

            if(isset($input['firma'])){
                $nombre = 'firma_'.($proceso->id)."_".time();
                //$ruta = storage_path("app/solicituds/".$solicitud->id.'/'.$nombre);
    
                //Storage::makeDirectory('solicituds/'.$solicitud->id);
    
                $base64_image = $input['firma']; // your base64 encoded     
                @list($type, $file_data) = explode(';', $base64_image);
                @list(, $file_data) = explode(',', $file_data); 

                if($arriendo_venta_flag == 1)
                    $imageName = 'arriendos/'.$proceso->id.'/'.$nombre.'.png';
                elseif($arriendo_venta_flag == 2)
                    $imageName = 'ventas/'.$proceso->id.'/'.$nombre.'.png';
    
                //Storage::disk('local')->put($imageName, base64_decode($file_data));
                Storage::disk('public')->put($imageName, base64_decode($file_data));
    
                // copy(base64_decode($input['plano_marcado']), $ruta);
                $cambio_fase->firma = $nombre.'.png';
                $cambio_fase->save();
            }

        }

        //Guardamos fase anterior
        $cambio_fase->fase_anterior = $proceso->estado;

        switch ($proceso->estado) {

            case 'BODEGA':
                if($activo->estado == "PARA RETIRO"){
                    $cambio_fase->etapa = 1;
                    $proceso->estado = "EN CAMINO IDA";
                    $proceso->save();
                    $activo->estado = "EN RUTA IDA";
                    $activo->save();
                }
                break;
            case 'EN CAMINO IDA':
                if($activo->estado == "EN RUTA IDA"){
                    $cambio_fase->etapa = 2;
                    $proceso->estado = "EN CLIENTE";
                    $proceso->save();
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
                    $proceso->estado = "EN CAMINO VUELTA";
                    $proceso->save();
                    $activo->estado = "EN RUTA VUELTA";
                    $activo->save();
                }
                break;
            case 'EN CAMINO VUELTA':
                if($activo->estado == "EN RUTA VUELTA"){
                    $cambio_fase->etapa = 5;
                    $proceso->estado = "BODEGA DE VUELTA";
                    $proceso->save();
                    $activo->estado = "RECIBIDO";
                    $activo->save();
                }
                break;
            case 'BODEGA DE VUELTA':
                if($activo->estado == "RECIBIDO"){
                    $cambio_fase->etapa = 6;
                    $proceso->estado = "TERMINADO";
                    $proceso->save();
                    $activo->estado = "DISPONIBLE";

                    if($activo->arriendo_flag && !$activo->venta_flag)
                        $activo->arriendo_flag = false;
                    elseif($activo->venta_flag && !$activo->arriendo_flag)
                        $activo->venta_flag = false;
                    $activo->save();
                }
                break;
            default:    //CASO AÚN NO DEFINIDO
                # code...
                break;
        }
        $cambio_fase->fase_actual = $proceso->estado;
        $cambio_fase->save();

        flash('Cambio de fase registrado correctamente.', 'success');

        //CASO SUPERADMIN
        $user = Auth::user();
        if (isset($user) && $user->superadmin) {
            return redirect()->route('activo.trazabilidad');
        }else{
            //CASO BODEGA O ADMIN
            return redirect()->route('transporte.transporte');
        }

        

    }

    public function qr_reader(){
        return view('bodega.qr_reader');
    }

    public function transporte_datatable(Request $request)
    {
        if ($request->ajax()) {
            if($request->get('tipo_proceso') == "Arriendos"){
                $data = ArriendoActivo::whereNotIn('estado', ["TERMINADO"])->select('*');
            }elseif($request->get('tipo_proceso') == "Ventas"){
                $data = Venta::whereNotIn('estado', ["TERMINADO"])->select('*');
            }
            
            return Datatables::of($data)

                ->addColumn('detalles', function($row){
                    $csrfToken = csrf_token();
                    
                    $formContent = '<div class="card text-start user-contact-list">
                                        <div class="">
                                            <div class="card-header border-bottom text-white p-5" style="background: linear-gradient(135deg, rgb(241, 196, 111) 60%, rgb(214, 87, 2));">';
                                            
                    if (!empty($row->activo->foto)) {
                        $formContent .= '<span class="avatar brround avatar-xxl d-block" style="background-image: url(' . asset('storage/activos/'.$row->activo->id.'/'.$row->activo->foto) . ')"></span>';
                    } else {
                        $formContent .= '<span class="avatar brround  " style="background-image: url(' . asset('assets/images/brand/favicon1.png') . '); height: 100px; width: 100px;"></span>';
                    }

                    if($row->activo->arriendo_flag){
                        $formContent .= '<div class=" ms-3 text-white">
                                <p class="mb-0 mt-1 fs-18 font-weight-semibold">' . $row->activo->marca . ' -- ' . $row->activo->modelo . '</p>
                                <small class="">ID ARRIENDO: ' . $row->id . '</small>
                                <br>
                                <small class="">ID ACTIVO: ' . $row->activo->id . '</small>
                            </div>
                        </div>
                        <div class="p-5">
                            <div class="wrapper">
                                <p class="fs-14 font-weight-bold">ESTADO ARRIENDO :</p>';
                    }elseif($row->activo->venta_flag){
                        $formContent .= '<div class=" ms-3 text-white">
                                    <p class="mb-0 mt-1 fs-18 font-weight-semibold">' . $row->activo->marca . ' -- ' . $row->activo->modelo . '</p>
                                    <small class="">ID VENTA: ' . $row->id . '</small>
                                    <br>
                                    <small class="">ID ACTIVO: ' . $row->activo->id . '</small>
                                </div>
                            </div>
                            <div class="p-5">
                                <div class="wrapper">
                                    <p class="fs-14 font-weight-bold">ESTADO VENTA :</p>';
                    }

                    // Estado del arriendo
                    $estado = "";
                    if ($row->estado == "BODEGA") {
                        $estado = "BODEGA";
                    } elseif ($row->estado == "EN CAMINO IDA") {
                        $estado = "EN CAMINO IDA";
                    } elseif ($row->estado == "EN CLIENTE") {
                        if($row->activo->estado == "ARRENDADO")
                        {
                            $estado = "EN CLIENTE";
                        }elseif($row->activo->estado == "PARA RETIRO"){
                            $estado = "EN CLIENTE (PARA RETIRO)";
                        }
                    }elseif ($row->activo->estado == "PARA RETIRO") {
                        $estado .= "PARA RETIRO";
                    } elseif ($row->estado == "EN CAMINO VUELTA") {
                        $estado = "EN CAMINO VUELTA";
                    } elseif ($row->estado == "BODEGA DE VUELTA") {
                        $estado = "BODEGA DE VUELTA";
                    }

                    if($row->fecha_termino != null){
                        $fecha_termino = Carbon::parse($row->fecha_termino)->format('d-m-Y');
                    }else{
                        $fecha_termino = null;
                    }

                    $formContent .= '<p class="mt-2 text-info ">' . $estado . '</p>
                            </div>
                            <div class="wrapper">
                                <p class="fs-14 font-weight-bold">Código Interno (Activo) :</p>
                                <p class="mt-2 text-muted ">' . $row->activo->codigo_interno . '</p>
                            </div>
                            <div class="wrapper">
                                <p class="fs-14 font-weight-bold">Fecha Inicio :</p>
                                <p class="mt-2 text-muted ">' . Carbon::parse($row->fecha_inicio)->format('d-m-Y') . '</p>
                            </div>
                            <div class="wrapper">
                                <p class="fs-14 font-weight-bold">Fecha Término :</p>
                                <p class="mt-2 text-muted ">' . $fecha_termino . '</p>
                            </div>
                            <div class="text-white text-center">';

                    if ($row->estado == "BODEGA" || $row->estado == "EN CAMINO VUELTA") {
                        $formContent .= '<form method="GET" action="' . route('transporte.qr_reader', [$row->activo->id]) . '">
                            <td class="align-middle">';

                        $formContent .= '<button class="btn btn-xl btn-success me-2 confirm-submit" type="submit" data-bs-toggle="" data-bs-target="#user-form-modal">Cambiar de fase</button>';
                        $formContent .= '<input type="hidden" name="_token" value="' . $csrfToken . '">';

                        $formContent .= '</td>
                            </form>';
                    } elseif ($row->estado == "EN CAMINO IDA" || $row->estado == "EN CLIENTE") {
                        $formContent .= '<form method="POST" action="' . route('transporte.cambio_fase') . '" enctype="multipart/form-data">
                            <input type="hidden" name="_token" value="' . $csrfToken . '">
                            
                            <input hidden type="integer" id="activo_id" name="activo_id" value="' . $row->activo->id . '">
                            <td class="align-middle">';

                        if ($row->estado == "EN CAMINO IDA") {
                            $formContent .= '<button class="btn btn-xl btn-success me-2 confirm-submit" type="submit" data-bs-toggle="" data-bs-target="#user-form-modal">Cambiar de fase</button>';
                        } elseif ($row->estado == "EN CLIENTE" && $row->activo->estado == "ARRENDADO") {
                            $formContent .= '<button class="btn btn-xl btn-danger me-2 confirm-submit" type="submit" data-bs-toggle="" data-bs-target="#user-form-modal">Disponibilizar para retiro</button>';
                        } elseif ($row->estado == "EN CLIENTE" && $row->activo->estado == "PARA RETIRO") {
                            $formContent .= '<button class="btn btn-xl btn-success me-2 confirm-submit" type="submit" data-bs-toggle="" data-bs-target="#user-form-modal">Cambiar de fase</button>';
                        }

                        $formContent .= '</td>
                            </form>';
                    } else {
                        $formContent .= '<button disabled class="btn btn-xl btn-warning me-2 confirm-submit" type="submit" data-bs-toggle="" data-bs-target="#user-form-modal">(ESPERANDO CONFIRMACIÓN)</button>';
                    }

                    $formContent .= '</div>
                    </div>
                    </div>';

                    $columnContent = '<td class="align-middle">
                        <div class="d-flex flex-column align-items-center">
                            ' . $formContent . '
                        </div>
                    </td>';

                    return $columnContent;
                })


                ->filter(function ($instance) use ($request) {
                    if ($request->get('estado')) {
                            $instance->where('estado', $request->get('estado'));
                    }
                    if ($request->get('empresa') && $request->get('empresa') != "null") {
                        // Obtén el ID de la empresa desde la solicitud
                        $empresaId = $request->get('empresa');
                    
                        // Consulta Eloquent para obtener los proyectos de la empresa
                        $proyectos = Proyecto::where('empresa_id', $empresaId)->pluck('id')->toArray();
                    
                        // Filtra los registros de activos que pertenecen a los proyectos de la empresa
                        $instance->whereIn('proyecto_id', $proyectos);
                    }
                    if ($request->get('proyecto') && $request->get('proyecto') != "null") {
                        $instance->where('proyecto_id', $request->get('proyecto'));
                    }
                    if (!empty($request->get('search'))) {
                        $instance->where(function($w) use($request){
                            $search = $request->get('search');
                            $w->orWhereHas('activo', function($q) use($search) {
                                $q->where('codigo_interno', 'LIKE', "%$search%")
                                ->orWhere('marca', 'LIKE', "%$search%")
                                ->orWhere('modelo', 'LIKE', "%$search%")
                                ->orWhere('numero_serie', 'LIKE', "%$search%")
                                ->orWhere('id', 'LIKE', "%$search%");
                            })
                            ->orWhere('id', 'LIKE', "%$search%");
                        });
                    }
                })
                ->rawColumns(['detalles'])
                ->escapeColumns([])
                ->make(true)
            ;
        }
        
    }


}
