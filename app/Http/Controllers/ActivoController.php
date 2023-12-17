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


class ActivoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Activo::select('*');
            return Datatables::of($data)

                    ->addColumn('estado', function($row){
                        //Operativo
                        if(! $row->inoperativo){
                            if($row->estado == "EN MANTENCION")
                                return '<td class="text-nowrap align-middle">EN PROCESO DE MANTENCION</td>';
                            elseif($row->arriendo_flag)
                                return '<td class="text-nowrap align-middle">EN PROCESO DE ARRIENDO</td>';
                            elseif($row->venta_flag)
                                return '<td class="text-nowrap align-middle">EN PROCESO DE VENTA</td>';
                            elseif($row->estado == "DISPONIBLE")
                                return '<td class="text-nowrap align-middle">DISPONIBLE</td>';
                        }
                        //Inoperativo
                        return '<td class="text-nowrap align-middle">INOPERATIVO</td>';
                    })

                    ->addIndexColumn()

                    ->addColumn('elemento', function($row){
                        return $row->marca." - ".$row->modelo;
                    })

                    ->addColumn('codigo_interno', function($row){
                        return $row->codigo_interno;
                    })

                    ->addColumn('numero_serie', function($row){
                        return $row->numero_serie;
                    })

                    ->addColumn('acciones', function($row){

                        return  
                            '<td class="align-middle text-center">
                                <a class="btn btn-sm btn-primary" type="button" href="/activo/show/'.$row->id.'">Ver</a>
                                <button class="btn btn-sm btn-danger" type="button"><i class="fe fe-trash-2"></i></button>
                            </td>'
                        ;
                    })

                    ->addColumn('codigo_qr', function($row){
                        $url = $_ENV['APP_URL']."/storage/activos/".$row->id.'/QR_CODE_'.$row->id.'.svg';
                        return  
                            '<td class="align-middle text-center">
                                <a data-toggle="tooltip" data-placement="top" title="DESCARGAR" download href="'.$url.'") }}">
                                    <button class="btn btn-sm btn-warning" type="button" data-bs-toggle="" data-bs-target="#user-form-modal">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" aria-labelledby="qrIconTitle" stroke="#000" stroke-linecap="square" color="#000"><path d="M10 3v7H3V3z"/><path d="M7 6H6v1h1zm3 8v7H3v-7z"/><path d="M6 17h1v1H6zm8 3h1v1h-1zm3-3h1v1h-1zm-3-3h1v1h-1zm6 3h1v1h-1zm0-3h1v1h-1zm0 6h1v1h-1zm1-17v7h-7V3z"/><path d="M17 6h1v1h-1z"/></svg>                                                                   
                                </a>
                            </td>'
                        ;
                    })

                    ->addColumn('arriendo', function($row){
                        if($row->estado == "DISPONIBLE" && !$row->arriendo_flag && !$row->venta_flag && !$row->inoperativo){
                            $url = $_ENV['APP_URL'].'/arriendo/create/'.$row->id;
                            return 
                                '<td class="align-middle text-center">
                                    <a data-toggle="tooltip" data-placement="top" title="ARRENDAR" href="'.$url.'">
                                        <button class="btn btn-sm btn-success" type="button">
                                        <svg width="24" height="24" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 372.372 372.372" style="enable-background:new 0 0 372.372 372.372" xml:space="preserve"><path d="M368.712 219.925c-5.042-8.951-14.563-14.511-24.848-14.511-4.858 0-9.682 1.27-13.948 3.672l-83.024 46.756a4.502 4.502 0 0 0-2.163 2.85c-1.448 5.911-4.857 14.164-12.865 19.911-8.864 6.361-20.855 7.686-35.466 3.939a4.652 4.652 0 0 1-.252-.071L148.252 267.6a5.505 5.505 0 0 1-3.621-6.882 5.476 5.476 0 0 1 5.251-3.872c.55 0 1.101.084 1.634.249l47.645 14.794c.076.023.154.045.232.065 11.236 2.836 20.011 2.047 26.056-2.288 7.637-5.48 8.982-15.113 9.141-16.528a2.02 2.02 0 0 0 .014-.136l.005-.039.003-.044.002-.029c.909-11.878-6.756-22.846-18.24-26.089l-.211-.064c-.35-.114-35.596-11.626-58.053-18.034-2.495-.711-9.37-2.366-19.313-2.366-13.906 0-34.651 3.295-54.549 19.025L1.67 292.159a4.5 4.5 0 0 0-.758 6.215l44.712 59.06a4.508 4.508 0 0 0 3.588 1.784c.987 0 1.954-.325 2.745-.935l57.592-44.345c1.294-.995 3.029-1.37 4.619-.995l93.02 21.982c6.898 1.63 14.353.578 20.523-2.9l130.16-73.304c13.684-7.709 18.547-25.111 10.841-38.796zm-51.731-206.77h-170c-5.522 0-10 4.477-10 10v45.504c0 5.523 4.478 10 10 10h3.735v96.623c0 5.523 4.477 10 10 10h142.526c5.523 0 10-4.477 10-10V78.658h3.738c5.522 0 10-4.477 10-10V23.155c.001-5.523-4.477-10-9.999-10zm-63.965 89.262h-42.072c-4.411 0-8-3.589-8-8s3.589-8 8-8h42.072c4.411 0 8 3.589 8 8s-3.589 8-8 8zm53.965-43.759h-150V33.155h150v25.503z"/></svg>                                                
                                    </a>
                                </td>'
                            ;
                        }else{
                            return 
                                '<td class="align-middle text-center">
                                    <a class="disabled" data-toggle="tooltip" data-placement="top" title="ARRENDAR" href="#">
                                        <button disabled class="btn btn-sm btn-success" type="button">
                                        <svg width="24" height="24" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 372.372 372.372" style="enable-background:new 0 0 372.372 372.372" xml:space="preserve"><path d="M368.712 219.925c-5.042-8.951-14.563-14.511-24.848-14.511-4.858 0-9.682 1.27-13.948 3.672l-83.024 46.756a4.502 4.502 0 0 0-2.163 2.85c-1.448 5.911-4.857 14.164-12.865 19.911-8.864 6.361-20.855 7.686-35.466 3.939a4.652 4.652 0 0 1-.252-.071L148.252 267.6a5.505 5.505 0 0 1-3.621-6.882 5.476 5.476 0 0 1 5.251-3.872c.55 0 1.101.084 1.634.249l47.645 14.794c.076.023.154.045.232.065 11.236 2.836 20.011 2.047 26.056-2.288 7.637-5.48 8.982-15.113 9.141-16.528a2.02 2.02 0 0 0 .014-.136l.005-.039.003-.044.002-.029c.909-11.878-6.756-22.846-18.24-26.089l-.211-.064c-.35-.114-35.596-11.626-58.053-18.034-2.495-.711-9.37-2.366-19.313-2.366-13.906 0-34.651 3.295-54.549 19.025L1.67 292.159a4.5 4.5 0 0 0-.758 6.215l44.712 59.06a4.508 4.508 0 0 0 3.588 1.784c.987 0 1.954-.325 2.745-.935l57.592-44.345c1.294-.995 3.029-1.37 4.619-.995l93.02 21.982c6.898 1.63 14.353.578 20.523-2.9l130.16-73.304c13.684-7.709 18.547-25.111 10.841-38.796zm-51.731-206.77h-170c-5.522 0-10 4.477-10 10v45.504c0 5.523 4.478 10 10 10h3.735v96.623c0 5.523 4.477 10 10 10h142.526c5.523 0 10-4.477 10-10V78.658h3.738c5.522 0 10-4.477 10-10V23.155c.001-5.523-4.477-10-9.999-10zm-63.965 89.262h-42.072c-4.411 0-8-3.589-8-8s3.589-8 8-8h42.072c4.411 0 8 3.589 8 8s-3.589 8-8 8zm53.965-43.759h-150V33.155h150v25.503z"/></svg>                                                
                                    </a>
                                </td>'
                            ;
                        }
                    })

                    ->addColumn('mantencion', function($row){
                        if($row->estado == "EN MANTENCION"){
                            $content = 
                                '<td class="align-middle text-center">
                                    <button id="terminar_mantencion" data-activo-id="'.$row->id.'" class="btn btn-sm btn-danger terminar-mantencion-btn" data-toggle="tooltip" data-placement="top" title="TERMINAR MANTENCIÓN" type="button">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 512 512" xml:space="preserve"><path d="m360.102 240.012 10.156-10.266s15.609-13.406 33.406-7.328c30.984 10.578 66.781-.875 91.609-25.734 7.063-7.063 15.641-21.234 15.641-21.234a5.596 5.596 0 0 0 .922-4.672l-1.922-7.906a5.671 5.671 0 0 0-2.625-3.531 5.566 5.566 0 0 0-4.344-.547l-60.984 16.969a5.648 5.648 0 0 1-6.063-2.109l-28.015-38.594a5.564 5.564 0 0 1-1.016-4.063l5.641-41a5.595 5.595 0 0 1 4.063-4.656l64.406-17.922c2.906-.813 4.672-3.813 3.953-6.766l-2.547-10.359a5.61 5.61 0 0 0-2.563-3.5s-5.047-3.344-8.719-5.234c-36.578-18.891-82.64-13.031-113.312 17.656-22.656 22.656-31.531 53.688-27.375 83.156 3.203 22.656 1.703 34.703-8.078 45.047-.891.922-3.703 3.734-8.047 8l45.813 44.593zm-148.719 55.406A183455.446 183455.446 0 0 1 68.461 433.715a13.135 13.135 0 0 0-4.047 9.313 13.092 13.092 0 0 0 3.813 9.375l31.938 31.938a13.071 13.071 0 0 0 9.391 3.813 13.018 13.018 0 0 0 9.281-4.031L258.165 343.17l-46.782-47.752zM501.43 451.371a13.008 13.008 0 0 0 3.813-9.375c-.031-3.516-1.5-6.859-4.031-9.297L227.415 166.246l-43.953 43.969L450.805 483.09c2.438 2.547 5.781 4 9.297 4.047s6.891-1.344 9.391-3.828l31.937-31.938zM254.196 32.621c-32.969-12.859-86.281-14.719-117.156 16.141a472188.334 472188.334 0 0 0-59.875 59.891c-12.672 12.656-.906 25.219-10.266 34.563-9.359 9.359-24.313 0-32.734 8.422L3.29 182.527c-4.391 4.375-4.391 11.5 0 15.891l43.016 43.016c4.391 4.391 11.516 4.391 15.906 0l30.875-30.875c8.438-8.422-.938-23.375 8.438-32.719 12.609-12.625 26.375-10.484 34.328-2.547l15.891 15.891 17.219 4.531 43.953-43.953-5.063-16.688c-14.016-14.031-16.016-30.266-7.234-39.047 13.594-13.594 36.047-33.234 57.078-41.656 13.405-5.359 9.358-18.703-3.501-21.75zm-59.625 70.859c-.063.047 5.859-7.281 5.969-7.375l-5.969 7.375z" style="fill:#000"/></svg>                                                                    
                                </td>'
                            ;

                        }
                        elseif( ($row->estado == "DISPONIBLE" && !$row->arriendo_flag && !$row->venta_flag && !$row->inoperativo) ||
                            ($row->estado == "RECIBIDO" && ($row->arriendo_flag || $row->venta_flag)))
                        {
                            $url = $_ENV['APP_URL'].'/mantencion/create/'.$row->id;
                            $content = 
                                '<td class="align-middle text-center">
                                    <a href="'.$url.'">
                                        <button id="iniciar_mantencion" class="btn btn-sm btn-success" type="button" data-toggle="tooltip" data-placement="top" title="INICIAR MANTENCIÓN">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 512 512" xml:space="preserve"><path d="m360.102 240.012 10.156-10.266s15.609-13.406 33.406-7.328c30.984 10.578 66.781-.875 91.609-25.734 7.063-7.063 15.641-21.234 15.641-21.234a5.596 5.596 0 0 0 .922-4.672l-1.922-7.906a5.671 5.671 0 0 0-2.625-3.531 5.566 5.566 0 0 0-4.344-.547l-60.984 16.969a5.648 5.648 0 0 1-6.063-2.109l-28.015-38.594a5.564 5.564 0 0 1-1.016-4.063l5.641-41a5.595 5.595 0 0 1 4.063-4.656l64.406-17.922c2.906-.813 4.672-3.813 3.953-6.766l-2.547-10.359a5.61 5.61 0 0 0-2.563-3.5s-5.047-3.344-8.719-5.234c-36.578-18.891-82.64-13.031-113.312 17.656-22.656 22.656-31.531 53.688-27.375 83.156 3.203 22.656 1.703 34.703-8.078 45.047-.891.922-3.703 3.734-8.047 8l45.813 44.593zm-148.719 55.406A183455.446 183455.446 0 0 1 68.461 433.715a13.135 13.135 0 0 0-4.047 9.313 13.092 13.092 0 0 0 3.813 9.375l31.938 31.938a13.071 13.071 0 0 0 9.391 3.813 13.018 13.018 0 0 0 9.281-4.031L258.165 343.17l-46.782-47.752zM501.43 451.371a13.008 13.008 0 0 0 3.813-9.375c-.031-3.516-1.5-6.859-4.031-9.297L227.415 166.246l-43.953 43.969L450.805 483.09c2.438 2.547 5.781 4 9.297 4.047s6.891-1.344 9.391-3.828l31.937-31.938zM254.196 32.621c-32.969-12.859-86.281-14.719-117.156 16.141a472188.334 472188.334 0 0 0-59.875 59.891c-12.672 12.656-.906 25.219-10.266 34.563-9.359 9.359-24.313 0-32.734 8.422L3.29 182.527c-4.391 4.375-4.391 11.5 0 15.891l43.016 43.016c4.391 4.391 11.516 4.391 15.906 0l30.875-30.875c8.438-8.422-.938-23.375 8.438-32.719 12.609-12.625 26.375-10.484 34.328-2.547l15.891 15.891 17.219 4.531 43.953-43.953-5.063-16.688c-14.016-14.031-16.016-30.266-7.234-39.047 13.594-13.594 36.047-33.234 57.078-41.656 13.405-5.359 9.358-18.703-3.501-21.75zm-59.625 70.859c-.063.047 5.859-7.281 5.969-7.375l-5.969 7.375z" style="fill:#000"/></svg>                                                                    
                                    </a>
                                </td>'
                            ;
                        }else{
                            $content = 
                                '<td class="align-middle text-center">
                                    <a href="#">
                                        <button disabled class="btn btn-sm btn-success" type="button" data-toggle="tooltip" data-placement="top" title="INICIAR MANTENCIÓN">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 512 512" xml:space="preserve"><path d="m360.102 240.012 10.156-10.266s15.609-13.406 33.406-7.328c30.984 10.578 66.781-.875 91.609-25.734 7.063-7.063 15.641-21.234 15.641-21.234a5.596 5.596 0 0 0 .922-4.672l-1.922-7.906a5.671 5.671 0 0 0-2.625-3.531 5.566 5.566 0 0 0-4.344-.547l-60.984 16.969a5.648 5.648 0 0 1-6.063-2.109l-28.015-38.594a5.564 5.564 0 0 1-1.016-4.063l5.641-41a5.595 5.595 0 0 1 4.063-4.656l64.406-17.922c2.906-.813 4.672-3.813 3.953-6.766l-2.547-10.359a5.61 5.61 0 0 0-2.563-3.5s-5.047-3.344-8.719-5.234c-36.578-18.891-82.64-13.031-113.312 17.656-22.656 22.656-31.531 53.688-27.375 83.156 3.203 22.656 1.703 34.703-8.078 45.047-.891.922-3.703 3.734-8.047 8l45.813 44.593zm-148.719 55.406A183455.446 183455.446 0 0 1 68.461 433.715a13.135 13.135 0 0 0-4.047 9.313 13.092 13.092 0 0 0 3.813 9.375l31.938 31.938a13.071 13.071 0 0 0 9.391 3.813 13.018 13.018 0 0 0 9.281-4.031L258.165 343.17l-46.782-47.752zM501.43 451.371a13.008 13.008 0 0 0 3.813-9.375c-.031-3.516-1.5-6.859-4.031-9.297L227.415 166.246l-43.953 43.969L450.805 483.09c2.438 2.547 5.781 4 9.297 4.047s6.891-1.344 9.391-3.828l31.937-31.938zM254.196 32.621c-32.969-12.859-86.281-14.719-117.156 16.141a472188.334 472188.334 0 0 0-59.875 59.891c-12.672 12.656-.906 25.219-10.266 34.563-9.359 9.359-24.313 0-32.734 8.422L3.29 182.527c-4.391 4.375-4.391 11.5 0 15.891l43.016 43.016c4.391 4.391 11.516 4.391 15.906 0l30.875-30.875c8.438-8.422-.938-23.375 8.438-32.719 12.609-12.625 26.375-10.484 34.328-2.547l15.891 15.891 17.219 4.531 43.953-43.953-5.063-16.688c-14.016-14.031-16.016-30.266-7.234-39.047 13.594-13.594 36.047-33.234 57.078-41.656 13.405-5.359 9.358-18.703-3.501-21.75zm-59.625 70.859c-.063.047 5.859-7.281 5.969-7.375l-5.969 7.375z" style="fill:#000"/></svg>                                                                    
                                    </a>
                                </td>'
                            ;
                        }
                        if(!$row->inoperativo){
                            $baja_url = $_ENV['APP_URL'].'/activo/baja_activo/'.$row->id;
                            $content .= 
                                    '<a class="ml-2" href="'.$baja_url.'">
                                        <button id="baja_activo" class="btn btn-sm btn-danger" type="button" data-toggle="tooltip" data-placement="top" title="DAR DE BAJA">
                                        <svg width="24" height="24" viewBox="0 0 64 64" xmlns="http://www.w3.org/2000/svg" stroke-width="3" stroke="#000" fill="none"><path d="m39.75 19-4.92-3.68 4.79-2.84-4.24-4.74h16.78V43.4L40.21 56.26H14.55V7.74h12.13l3.7 4-3.27 3.91 4.54 4-3.84 9.25a.1.1 0 0 0 .14.13Z" stroke-linecap="round"/><path d="m40.19 56.26.02-12.86h11.95"/></svg>                                
                                    </a>'
                            ;
                        }else{
                            $baja_url = $_ENV['APP_URL'].'/activo/baja_activo/'.$row->id;
                            $content .= 
                                    '<a class="ml-2 disabled" href="'.$baja_url.'">
                                        <button disabled id="baja_activo" class="btn btn-sm btn-danger" type="button" data-toggle="tooltip" data-placement="top" title="ACTUALMENTE INOPERATIVO">
                                        <svg width="24" height="24" viewBox="0 0 64 64" xmlns="http://www.w3.org/2000/svg" stroke-width="3" stroke="#000" fill="none"><path d="m39.75 19-4.92-3.68 4.79-2.84-4.24-4.74h16.78V43.4L40.21 56.26H14.55V7.74h12.13l3.7 4-3.27 3.91 4.54 4-3.84 9.25a.1.1 0 0 0 .14.13Z" stroke-linecap="round"/><path d="m40.19 56.26.02-12.86h11.95"/></svg>                                
                                    </a>'
                            ;
                        }

                        return $content;
                    })

                    ->addColumn('venta', function($row){
                        if($row->estado == "DISPONIBLE" && !$row->arriendo_flag && !$row->venta_flag && !$row->inoperativo){
                            $url = $_ENV['APP_URL'].'/venta/create/'.$row->id;
                            return 
                                '<td class="align-middle text-center">
                                    <a href="'.$url.'">
                                        <button id="iniciar_venta" class="btn btn-sm btn-success" type="button" data-toggle="tooltip" data-placement="top" title="VENDER">
                                        <svg width="24" height="24" viewBox="0 0 30 30" xmlns="http://www.w3.org/2000/svg"><path d="M5.5 5c-.655 0-.66 1.01 0 1h22c.286 0 .5.214.5.5v13c0 .66 1 .66 1 0v-13c0-.822-.678-1.5-1.5-1.5h-22zm-2 2c-.654 0-.654 1 0 1h22c.286 0 .5.214.5.5v13c0 .665 1.01.66 1 0v-13c0-.822-.678-1.5-1.5-1.5h-22zm-2 2C.678 9 0 9.678 0 10.5v12c0 .822.678 1.5 1.5 1.5h22c.822 0 1.5-.678 1.5-1.5v-12c0-.822-.678-1.5-1.5-1.5h-22zm0 1h22c.286 0 .5.214.5.5v12c0 .286-.214.5-.5.5h-22a.488.488 0 0 1-.5-.5v-12c0-.286.214-.5.5-.5zm1 1a.5.5 0 0 0-.5.5v2c0 .672 1 .656 1 0V12h1.5c.672 0 .656-1 0-1h-2zm10 0C9.468 11 7 13.468 7 16.5S9.468 22 12.5 22s5.5-2.468 5.5-5.5-2.468-5.5-5.5-5.5zm8 0c-.656 0-.672 1 0 1H22v1.5c0 .656 1 .672 1 0v-2a.5.5 0 0 0-.5-.5h-2zm-8 1c2.49 0 4.5 2.01 4.5 4.5S14.99 21 12.5 21 8 18.99 8 16.5s2.01-4.5 4.5-4.5zm0 1c-.277 0-.5.223-.5.5v.594c-.578.21-1 .76-1 1.406 0 .82.68 1.5 1.5 1.5.28 0 .5.212.5.5 0 .288-.22.5-.5.5h-1c-.338-.005-.5.248-.5.5s.162.505.5.5h.5v.5a.499.499 0 1 0 1 0v-.594c.578-.21 1-.76 1-1.406 0-.82-.68-1.5-1.5-1.5a.49.49 0 0 1-.5-.5c0-.288.22-.5.5-.5h1c.338.005.5-.248.5-.5s-.162-.505-.5-.5H13v-.5c0-.277-.223-.5-.5-.5zm-10 6.002c-.25-.002-.5.162-.5.498v2a.5.5 0 0 0 .5.5h2c.656 0 .672-1 0-1H3v-1.5c0-.328-.25-.496-.5-.498zm20 0c-.25.002-.5.17-.5.498V21h-1.5c-.672 0-.656 1 0 1h2a.5.5 0 0 0 .5-.5v-2c0-.336-.25-.5-.5-.498z"/></svg>                                                        
                                    </a>
                                </td>'
                            ;
                        }else{
                            return 
                                '<td class="align-middle text-center">
                                    <button disabled id="iniciar_venta" class="btn btn-sm btn-success" data-toggle="tooltip" data-placement="top" title="VENDER" type="button">
                                    <svg width="24" height="24" viewBox="0 0 30 30" xmlns="http://www.w3.org/2000/svg"><path d="M5.5 5c-.655 0-.66 1.01 0 1h22c.286 0 .5.214.5.5v13c0 .66 1 .66 1 0v-13c0-.822-.678-1.5-1.5-1.5h-22zm-2 2c-.654 0-.654 1 0 1h22c.286 0 .5.214.5.5v13c0 .665 1.01.66 1 0v-13c0-.822-.678-1.5-1.5-1.5h-22zm-2 2C.678 9 0 9.678 0 10.5v12c0 .822.678 1.5 1.5 1.5h22c.822 0 1.5-.678 1.5-1.5v-12c0-.822-.678-1.5-1.5-1.5h-22zm0 1h22c.286 0 .5.214.5.5v12c0 .286-.214.5-.5.5h-22a.488.488 0 0 1-.5-.5v-12c0-.286.214-.5.5-.5zm1 1a.5.5 0 0 0-.5.5v2c0 .672 1 .656 1 0V12h1.5c.672 0 .656-1 0-1h-2zm10 0C9.468 11 7 13.468 7 16.5S9.468 22 12.5 22s5.5-2.468 5.5-5.5-2.468-5.5-5.5-5.5zm8 0c-.656 0-.672 1 0 1H22v1.5c0 .656 1 .672 1 0v-2a.5.5 0 0 0-.5-.5h-2zm-8 1c2.49 0 4.5 2.01 4.5 4.5S14.99 21 12.5 21 8 18.99 8 16.5s2.01-4.5 4.5-4.5zm0 1c-.277 0-.5.223-.5.5v.594c-.578.21-1 .76-1 1.406 0 .82.68 1.5 1.5 1.5.28 0 .5.212.5.5 0 .288-.22.5-.5.5h-1c-.338-.005-.5.248-.5.5s.162.505.5.5h.5v.5a.499.499 0 1 0 1 0v-.594c.578-.21 1-.76 1-1.406 0-.82-.68-1.5-1.5-1.5a.49.49 0 0 1-.5-.5c0-.288.22-.5.5-.5h1c.338.005.5-.248.5-.5s-.162-.505-.5-.5H13v-.5c0-.277-.223-.5-.5-.5zm-10 6.002c-.25-.002-.5.162-.5.498v2a.5.5 0 0 0 .5.5h2c.656 0 .672-1 0-1H3v-1.5c0-.328-.25-.496-.5-.498zm20 0c-.25.002-.5.17-.5.498V21h-1.5c-.672 0-.656 1 0 1h2a.5.5 0 0 0 .5-.5v-2c0-.336-.25-.5-.5-.498z"/></svg>                                                        
                                </td>'
                            ;
                        }
                    })


                    ->filter(function ($instance) use ($request) {
                        if ($request->get('estado')) {
                            if($request->get('estado') == "INOPERATIVO")
                                $instance->where('inoperativo', true);
                            elseif($request->get('estado') == "DISPONIBLE")
                                $instance->where('estado', "DISPONIBLE");
                            elseif($request->get('estado') == "EN PROCESO DE MANTENCION")
                                $instance->where('estado', "EN MANTENCION");
                            elseif($request->get('estado') == "EN PROCESO DE ARRIENDO")
                                $instance->where('arriendo_flag', true);
                            elseif($request->get('estado') == "EN PROCESO DE VENTA")
                                $instance->where('venta_flag', true);
                            
                        }
                        if ($request->get('familia')) {
                            $familiaId = $request->get('familia');
                            $sub_familias = SubFamiliaProducto::where('familia_id', $familiaId)->pluck('id')->toArray();
                            $instance->whereIn('sub_familia_id', $sub_familias);
                        }
                        if ($request->get('sub_familia') && $request->get('sub_familia') != "null") {
                            $instance->where('sub_familia_id', $request->get('sub_familia'));
                        }
                        if (!empty($request->get('search'))) {
                             $instance->where(function($w) use($request){
                                $search = $request->get('search');
                                $w->orWhere('estado', 'LIKE', "%$search%")
                                ->orWhere('marca', 'LIKE', "%$search%")
                                ->orWhere('modelo', 'LIKE', "%$search%")
                                ->orWhere('clasificacion', 'LIKE', "%$search%")
                                ->orWhere('codigo_interno', 'LIKE', "%$search%")
                                ->orWhere('numero_serie', 'LIKE', "%$search%")
                                ->orWhere('id', 'LIKE', "%$search%");
                            });
                        }
                    })
                    ->rawColumns(['estado', 'id', 'elemento', 'codigo_interno', 'numero_serie', 'arriendo', 'mantencion', 'venta' ])
                    ->escapeColumns([])
                    ->make(true);
        }
        

        $familias = FamiliaProducto::get();
        $sub_familias = SubFamiliaProducto::get()->groupBy('familia_id');
        $selectedID = 0;

        return view('activo.index')
            ->with('familias', $familias)
            ->with('sub_familias', $sub_familias);
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
        QrCode::generate($_ENV['APP_URL'].'/inventario/'.$activo->id, public_path("storage/activos/".$activo->id.'/QR_CODE_'.$activo->id.'.svg'));
        $activo->codigo_qr = 'QR_CODE_'.$activo->id.'.svg';

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
        $mantenciones = Mantencion::where('activo_id', $id)->get();

        $cont = 1;
        foreach($mantenciones as $mantencion){
            $mantencion['n'] = $cont;
            $cont += 1;
        }

        $n_arriendos = ArriendoActivo::where('activo_id', $id)->get()->count();
        return view('activo.show')
                ->with('familias', $familias)
                ->with('mantenciones', $mantenciones)
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
        $ventas = Venta::get()->reverse();
        $empresas = Empresa::get();
        $proyectos = Proyecto::get()->groupBy('empresa_id');
        $selectedID = 0;
        return view('activo.trazabilidad')
            ->with('selectedID', $selectedID)
            ->with('empresas', $empresas)
            ->with("proyectos", $proyectos)
            ->with("ventas", $ventas)
            ->with('arriendos', $arriendos);
    }

    public function trazabilidad_datatable(Request $request)
    {
        if ($request->ajax()) {
            if($request->get('tipo_proceso') == "Arriendos"){
                $data = ArriendoActivo::select('*');
            }elseif($request->get('tipo_proceso') == "Ventas"){
                $data = Venta::select('*');
            }
            
            return Datatables::of($data)

                ->addIndexColumn()

                ->addColumn('activo', function($row){
                    return $row->activo->marca." - ".$row->activo->modelo;
                })

                ->addColumn('codigo_interno', function($row){
                    return $row->activo->codigo_interno;
                })

                ->addColumn('imagen', function($row){
                    if($row->estado == "TERMINADO"){
                        return
                            '<td class="align-middle">
                                <h6 class="mb-0 font-weight-bold">TERMINADO</h6>
                            </td>'
                        ;
                    }elseif($row->estado == "CAMBIO DE PROCESO"){
                        return
                            '<td class="align-middle">
                                <h6 class="mb-0 font-weight-bold">CAMBIO DE PROCESO</h6>
                            </td>'
                        ;
                    }else{
                        if($row->estado == "BODEGA")
                            return
                                '<td class="align-middle image-cell">
                                    <img src="'.asset('assets/images/arriendo/state1.svg').'" alt="State 1">
                                </td>'
                            ;
                        elseif($row->estado == "EN CAMINO IDA")
                            return
                                '<td class="align-middle image-cell">
                                    <img src="'.asset('assets/images/arriendo/state2.svg').'" alt="State 2">
                                </td>'
                            ;
                        elseif($row->estado == "EN CLIENTE")
                            return
                                '<td class="align-middle image-cell">
                                    <img src="'.asset('assets/images/arriendo/state3.svg').'" alt="State 3">
                                </td>'
                            ;
                        elseif($row->estado == "EN CAMINO VUELTA")
                            return
                                '<td class="align-middle image-cell">
                                    <img src="'.asset('assets/images/arriendo/state4.svg').'" alt="State 4">
                                </td>'
                            ;
                        elseif($row->estado == "BODEGA DE VUELTA")
                            return
                                '<td class="align-middle image-cell">
                                    <img src="'.asset('assets/images/arriendo/state5.svg').'" alt="State 5">
                                </td>'
                            ;

                        
                    }
                })

                ->addColumn('fecha_inicio', function($row){
                    return 
                        '<div class="wrapper">
                            <p class="mt-2 text-muted ">'.Carbon::parse($row->fecha_inicio)->format('d-m-Y').'</p>
                        </div>'
                    ;
                })

                ->addColumn('fecha_termino', function($row){
                    if($row->fecha_termino != null){
                        $fecha_termino = Carbon::parse($row->fecha_termino)->format('d-m-Y');
                    }else{
                        $fecha_termino = null;
                    }

                    return 
                        '<div class="wrapper">
                            <p class="mt-2 text-muted ">'.$fecha_termino.'</p>
                        </div>'
                    ;
                })


                ->addColumn('acciones', function($row){

                    $csrfToken = csrf_token(); // Genera el token CSRF manualmente
                    $formContent = '<form method="POST" action="' . route('transporte.cambio_fase') . '">
                        <input type="hidden" name="_token" value="' . $csrfToken . '">';
                    $formContent .='<input hidden type="integer" id="activo_id" name="activo_id" value="'.$row->activo->id.'">
                                    <div class="button-container">';
                    if(isset($row->monto))
                        $formContent .= '<a class="btn btn-sm btn-primary mb-1" type="button" href="' . route('arriendo.show', [$row->id]) . '">Ver</a>';
                    elseif(isset($row->precio_venta))
                        $formContent .= '<a class="btn btn-sm btn-primary mb-1" type="button" href="' . route('venta.show', [$row->id]) . '">Ver</a>';
                    $formContent .= '<button class="btn btn-sm btn-danger flex-fill" type="button"><i class="fe fe-trash-2"></i></button>';

                    if ($row->estado == "EN CLIENTE" && $row->activo->estado == "ARRENDADO") {
                        $formContent .= '<button class="btn btn-sm btn-success flex-fill mb-1 confirm-submit" type="submit"><i class="fe fe-check-square"></i> Disponibilizar para retiro</button>';
                        if(isset($row->monto))
                            $formContent .= '<a class="btn btn-sm btn-primary flex-fill mb-1" type="button" href="' . route('traspaso.create', [$row->id]) . '"><i class="fe fe-truck"></i> Traspasar</a>';
                        elseif(isset($row->precio_venta))
                            $formContent .= '<a class="btn btn-sm btn-primary flex-fill mb-1" type="button" href="' . route('traspaso_venta.create', [$row->id]) . '"><i class="fe fe-truck"></i> Traspasar</a>';
                    } elseif ($row->estado == "BODEGA DE VUELTA" && $row->activo->estado != "EN MANTENCION") {
                        $formContent .= '<button class="btn btn-sm btn-success flex-fill mb-1 confirm-submit" type="submit" data-bs-toggle="" data-bs-target="#user-form-modal">Confirmación FINAL</button>';
                    }

                    $formContent .= '</form>';
                    $formContent .= '</div>';

                    return 
                        '<td class="align-middle">
                            <div class="d-flex flex-column align-items-center">
                                ' . $formContent . '
                            </div>
                        </td>';
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
                ->rawColumns(['id', 'activo', 'codigo_interno', 'imagen', 'fecha_inicio', 'fecha_termino', 'acciones'])
                ->escapeColumns([])
                ->make(true)
            ;
        }
        
    }


    public function reportes()
    {
        $arriendos = ArriendoActivo::get()->reverse();
        $ventas = Venta::get()->reverse();
        $empresas = Empresa::get();
        $proyectos = Proyecto::get()->groupBy('empresa_id');

        $familias = FamiliaProducto::get();
        $sub_familias = SubFamiliaProducto::get()->groupBy('familia_id');

        $selectedID = 0;
        return view('activo.reportes')
            ->with('selectedID', $selectedID)
            ->with('familias', $familias)
            ->with("sub_familias", $sub_familias)
            ->with('empresas', $empresas)
            ->with("proyectos", $proyectos)
            ->with("ventas", $ventas)
            ->with('arriendos', $arriendos);
    }

    public function reportes_datatable(Request $request)
    {
        if ($request->ajax()) {
            //dd($request->get('familia'));

            if(!$request->get('tipo_proceso')){
                $data = [];
            }elseif(count($request->get('tipo_proceso')) == 1){
                if($request->get('tipo_proceso')[0] == "Arriendos"){
                    $data = ArriendoActivo::select('*');
                }elseif($request->get('tipo_proceso')[0] == "Ventas"){
                    $data = Venta::select('*');
                }
                
                // Filtramos (CASO: ARRIENDO || VENTA)

                if (!is_null($request->get('estado')) && !is_null($request->get('estado')[0])) {
                    $data->whereIn('estado', $request->get('estado'));
                }
                
                if (!is_null($request->get('empresa'))) {
                    // Obtén el ID de la empresa desde la solicitud
                    $empresaId = $request->get('empresa');
                
                    // Consulta Eloquent para obtener los proyectos de la empresa
                    $proyectos = Proyecto::where('empresa_id', $empresaId)->pluck('id')->toArray();
                
                    // Filtra los registros de activos que pertenecen a los proyectos de la empresa
                    $data->whereIn('proyecto_id', $proyectos);
                }

                if (!is_null($request->get('proyecto')) && $request->get('proyecto')[0] != "null" && $request->get('proyecto')[0] != null) {
                    $data->whereIn('proyecto_id', $request->get('proyecto'));
                }

                if (!is_null($request->get('familia'))) {
                    // Obtén el ID de la familia desde la solicitud
                    $familiaId = $request->get('familia');
                
                    // Consulta Eloquent para obtener los proyectos de la familia
                    $sub_familias = SubFamiliaProducto::where('familia_id', $familiaId)->pluck('id')->toArray();
                
                    // Filtra los registros de activos que pertenecen a las sub_familias de la familia
                    $data->whereHas('activo', function($q) use ($sub_familias) {
                        $q->whereIn('sub_familia_id', $sub_familias);
                    });
                }

                if (!is_null($request->get('sub_familia')) && $request->get('sub_familia')[0] != "null" && $request->get('sub_familia')[0] != null) {
                    // Filtra los registros de activos que pertenecen a las sub_familias de la familia
                    $sub_familias = $request->get('sub_familia');
                    $data->whereHas('activo', function($q) use ($sub_familias) {
                        $q->whereIn('sub_familia_id', $sub_familias);
                    });
                }



            }elseif(count($request->get('tipo_proceso')) == 2){
                $arriendos = ArriendoActivo::select(['id', 'activo_id', 'proyecto_id', 'monto', 'tipo_moneda', 'fecha_inicio', 'fecha_termino', 'encargado', 'estado', 'observaciones']);
                $data = collect();
                // Filtramos ARRIENDOS

                if (!is_null($request->get('estado')) && !is_null($request->get('estado')[0])) {
                    $arriendos->whereIn('estado', $request->get('estado'));
                }
                
                if (!is_null($request->get('empresa'))) {
                    // Obtén el ID de la empresa desde la solicitud
                    $empresaId = $request->get('empresa');
                
                    // Consulta Eloquent para obtener los proyectos de la empresa
                    $proyectos = Proyecto::where('empresa_id', $empresaId)->pluck('id')->toArray();
                
                    // Filtra los registros de activos que pertenecen a los proyectos de la empresa
                    $arriendos->whereIn('proyecto_id', $proyectos);
                }
                
                if (!is_null($request->get('proyecto')) && $request->get('proyecto')[0] != "null" && $request->get('proyecto')[0] != null) {
                    $arriendos->whereIn('proyecto_id', $request->get('proyecto'));
                }

                if (!is_null($request->get('familia'))) {
                    // Obtén el ID de la familia desde la solicitud
                    $familiaId = $request->get('familia');
                
                    // Consulta Eloquent para obtener los proyectos de la familia
                    $sub_familias = SubFamiliaProducto::where('familia_id', $familiaId)->pluck('id')->toArray();
                
                    // Filtra los registros de activos que pertenecen a las sub_familias de la familia
                    $arriendos->whereHas('activo', function($q) use ($sub_familias) {
                        $q->whereIn('sub_familia_id', $sub_familias);
                    });
                }

                if (!is_null($request->get('sub_familia')) && $request->get('sub_familia')[0] != "null" && $request->get('sub_familia')[0] != null) {
                    // Filtra los registros de activos que pertenecen a las sub_familias de la familia
                    $sub_familias = $request->get('sub_familia');
                    $arriendos->whereHas('activo', function($q) use ($sub_familias) {
                        $q->whereIn('sub_familia_id', $sub_familias);
                    });
                }

                $arriendos = $arriendos->get();
                $arriendos = $arriendos->map(function ($item) {
                    $item['tipo_proceso'] = 'ARRIENDO';
                    return $item;
                });

                $ventas = Venta::select(['id', 'activo_id', 'proyecto_id', 'precio_venta', 'tipo_moneda', 'fecha_inicio', 'fecha_termino', 'encargado', 'estado', 'observaciones']);

                // Filtramos VENTAS

                if (!is_null($request->get('estado')) && !is_null($request->get('estado')[0])) {
                    $ventas->whereIn('estado', $request->get('estado'));
                }
                
                if (!is_null($request->get('empresa'))) {
                    // Obtén el ID de la empresa desde la solicitud
                    $empresaId = $request->get('empresa');
                
                    // Consulta Eloquent para obtener los proyectos de la empresa
                    $proyectos = Proyecto::where('empresa_id', $empresaId)->pluck('id')->toArray();
                
                    // Filtra los registros de activos que pertenecen a los proyectos de la empresa
                    $ventas->whereIn('proyecto_id', $proyectos);
                }
                
                if (!is_null($request->get('proyecto')) && $request->get('proyecto')[0] != "null" && $request->get('proyecto')[0] != null) {
                    $ventas->whereIn('proyecto_id', $request->get('proyecto'));
                }

                if (!is_null($request->get('familia'))) {
                    // Obtén el ID de la familia desde la solicitud
                    $familiaId = $request->get('familia');
                
                    // Consulta Eloquent para obtener los proyectos de la familia
                    $sub_familias = SubFamiliaProducto::where('familia_id', $familiaId)->pluck('id')->toArray();
                
                    // Filtra los registros de activos que pertenecen a las sub_familias de la familia
                    $ventas->whereHas('activo', function($q) use ($sub_familias) {
                        $q->whereIn('sub_familia_id', $sub_familias);
                    });
                }

                if (!is_null($request->get('sub_familia')) && $request->get('sub_familia')[0] != "null" && $request->get('sub_familia')[0] != null) {
                    // Filtra los registros de activos que pertenecen a las sub_familias de la familia
                    $sub_familias = $request->get('sub_familia');
                    $ventas->whereHas('activo', function($q) use ($sub_familias) {
                        $q->whereIn('sub_familia_id', $sub_familias);
                    });
                }

                $ventas = $ventas->get();
                $ventas = $ventas->map(function ($item) {
                    $item['tipo_proceso'] = 'VENTA';
                    return $item;
                });

                // UNIMOS ARRIENDOS Y VENTAS
                foreach($arriendos as $arriendo){
                    $data->push($arriendo);
                }
                foreach($ventas as $venta){
                    $data->push($venta);
                }
                //$data = $arriendos->union($ventas);

            }
            
            return Datatables::of($data)

                ->addColumn('tipo', function($row){
                    if(intval($row->monto)){
                        return "ARRIENDO";
                    }else{
                        return "VENTA";
                    }
                })

                ->addColumn('estado', function($row){
                    return $row->estado;
                })
                ->addIndexColumn()

                ->addColumn('activo_id', function($row){
                    return $row->activo->id;
                })

                ->addColumn('activo', function($row){
                    return $row->activo->marca." - ".$row->activo->modelo;
                })

                ->addColumn('codigo_interno', function($row){
                    return $row->activo->codigo_interno;
                })

                ->addColumn('fecha_inicio', function($row){
                    return 
                        '<div class="wrapper">
                            <p class="mt-2 text-muted ">'.Carbon::parse($row->fecha_inicio)->format('d-m-Y').'</p>
                        </div>'
                    ;
                })

                ->addColumn('fecha_termino', function($row){
                    if($row->fecha_termino != null){
                        $fecha_termino = Carbon::parse($row->fecha_termino)->format('d-m-Y');
                    }else{
                        $fecha_termino = null;
                    }

                    return 
                        '<div class="wrapper">
                            <p class="mt-2 text-muted ">'.$fecha_termino.'</p>
                        </div>'
                    ;
                })

                ->rawColumns(['tipo', 'estado', 'id', 'activo_id', 'activo', 'codigo_interno', 'fecha_inicio', 'fecha_termino'])
                ->escapeColumns([])
                ->make(true)
            ;
        }
        
    }

    public function reportes_exportar(Request $request){
        
        $input = $request->all();
        //dd($input);
        // Parámetros de la consulta
        $exportar_flag = $input['exportar_flag'];
        $tipo_proceso = explode(',', $input['tipo_proceso']);
        $empresa = explode(',', $input['empresa']);
        $estado = explode(',', $input['estado']);
        $proyecto = explode(',', $input['proyecto']);
        $familia = explode(',', $input['familia']);
        $sub_familia = explode(',', $input['sub_familia']);

        // Obtenemos los datos
        if($tipo_proceso[0] == ""){
            $data = collect();
        }elseif(count($tipo_proceso) == 1){
            if($tipo_proceso[0] == "Arriendos"){
                $data = ArriendoActivo::select(['id', 'activo_id', 'proyecto_id', 'monto', 'tipo_moneda', 'fecha_inicio', 'fecha_termino', 'encargado', 'estado', 'observaciones']);
            }elseif($tipo_proceso[0] == "Ventas"){
                $data = Venta::select(['id', 'activo_id', 'proyecto_id', 'precio_venta', 'tipo_moneda', 'fecha_inicio', 'fecha_termino', 'encargado', 'estado', 'observaciones']);
            }
            
            // Filtramos (CASO: ARRIENDO || VENTA)

            if ($estado[0] != "") {
                $data->whereIn('estado', $estado);
            }
            
            if ($empresa[0] != "") {
                // Obtén el ID de la empresa desde la solicitud
                $empresaId = $empresa[0];
            
                // Consulta Eloquent para obtener los proyectos de la empresa
                $proyectos = Proyecto::where('empresa_id', $empresaId)->pluck('id')->toArray();
            
                // Filtra los registros de activos que pertenecen a los proyectos de la empresa
                $data->whereIn('proyecto_id', $proyectos);
            }

            if ($proyecto[0] != "" &&  $proyecto[0] != "null") {
                $data->whereIn('proyecto_id', $proyecto);
            }

            if ($familia[0] != "") {
                // Obtén el ID de la familia desde la solicitud
                $familiaId = $request->get('familia');
            
                // Consulta Eloquent para obtener los proyectos de la familia
                $sub_familias = SubFamiliaProducto::where('familia_id', $familiaId)->pluck('id')->toArray();
            
                // Filtra los registros de activos que pertenecen a las sub_familias de la familia
                $data->whereHas('activo', function($q) use ($sub_familias) {
                    $q->whereIn('sub_familia_id', $sub_familias);
                });
            }

            if ($sub_familia[0] != "" &&  $sub_familia[0] != "null") {
                // Filtra los registros de activos que pertenecen a las sub_familias de la familia
                $data->whereHas('activo', function($q) use ($sub_familia) {
                    $q->whereIn('sub_familia_id', $sub_familia);
                });
            }

            $data = $data->get();

            if($tipo_proceso[0] == "Arriendos"){
                $data = $data->map(function ($item) {
                    $item['tipo_proceso'] = 'ARRIENDO';
                return $item;
                });
            }elseif($tipo_proceso[0] == "Ventas"){
                $data = $data->map(function ($item) {
                    $item['tipo_proceso'] = 'VENTA';
                return $item;
                });
            }

        }elseif(count($tipo_proceso) == 2){
            $arriendos = ArriendoActivo::select('*');
            $data = collect();
            // Filtramos ARRIENDOS

            if ($estado[0] != "") {
                $arriendos->whereIn('estado', $estado);
            }
            
            if ($empresa[0] != "") {
                // Obtén el ID de la empresa desde la solicitud
                $empresaId = $empresa[0];
            
                // Consulta Eloquent para obtener los proyectos de la empresa
                $proyectos = Proyecto::where('empresa_id', $empresaId)->pluck('id')->toArray();
            
                // Filtra los registros de activos que pertenecen a los proyectos de la empresa
                $arriendos->whereIn('proyecto_id', $proyectos);
            }
            
            if ($proyecto[0] != "" &&  $proyecto[0] != "null") {
                $arriendos->whereIn('proyecto_id', $proyecto);
            }

            if ($familia[0] != "") {
                // Obtén el ID de la familia desde la solicitud
                $familiaId = $request->get('familia');
            
                // Consulta Eloquent para obtener los proyectos de la familia
                $sub_familias = SubFamiliaProducto::where('familia_id', $familiaId)->pluck('id')->toArray();
            
                // Filtra los registros de activos que pertenecen a las sub_familias de la familia
                $arriendos->whereHas('activo', function($q) use ($sub_familias) {
                    $q->whereIn('sub_familia_id', $sub_familias);
                });
            }

            if ($sub_familia[0] != "" &&  $sub_familia[0] != "null") {
                // Filtra los registros de activos que pertenecen a las sub_familias de la familia
                $arriendos->whereHas('activo', function($q) use ($sub_familia) {
                    $q->whereIn('sub_familia_id', $sub_familia);
                });
            }

            $arriendos = $arriendos->get();

            $arriendos = $arriendos->map(function ($item) {
                $item['tipo_proceso'] = 'ARRIENDO';
                return $item;
            });

            $ventas = Venta::select('*');

            // Filtramos VENTAS

            if ($estado[0] != "") {
                $ventas->whereIn('estado', $estado);
            }
            
            if ($empresa[0] != "") {
                // Obtén el ID de la empresa desde la solicitud
                $empresaId = $empresa[0];
            
                // Consulta Eloquent para obtener los proyectos de la empresa
                $proyectos = Proyecto::where('empresa_id', $empresaId)->pluck('id')->toArray();
            
                // Filtra los registros de activos que pertenecen a los proyectos de la empresa
                $ventas->whereIn('proyecto_id', $proyectos);
            }
            
            if ($proyecto[0] != "" &&  $proyecto[0] != "null") {
                $ventas->whereIn('proyecto_id', $proyecto);
            }

            if ($familia[0] != "") {
                // Obtén el ID de la familia desde la solicitud
                $familiaId = $request->get('familia');
            
                // Consulta Eloquent para obtener los proyectos de la familia
                $sub_familias = SubFamiliaProducto::where('familia_id', $familiaId)->pluck('id')->toArray();
            
                // Filtra los registros de activos que pertenecen a las sub_familias de la familia
                $ventas->whereHas('activo', function($q) use ($sub_familias) {
                    $q->whereIn('sub_familia_id', $sub_familias);
                });
            }

            if ($sub_familia[0] != "" &&  $sub_familia[0] != "null") {
                // Filtra los registros de activos que pertenecen a las sub_familias de la familia
                $ventas->whereHas('activo', function($q) use ($sub_familia) {
                    $q->whereIn('sub_familia_id', $sub_familia);
                });
            }

            $ventas = $ventas->get();

            $ventas = $ventas->map(function ($item) {
                    $item['tipo_proceso'] = 'VENTA';
                return $item;
            });

            // UNIMOS ARRIENDOS Y VENTAS
            foreach($arriendos as $arriendo){
                $data->push($arriendo);
            }
            foreach($ventas as $venta){
                $data->push($venta);
            }

        }

        if($data->count() == 0){
            flash("No hay datos para exportar", "danger");
            return redirect()->back();
        }else{
            // Eliminamos las columnas que no queremos exportar
            $columns_to_delete = ['created_at', 'updated_at', 'deleted_at'];
            $data = $data->map(function ($item) use ($columns_to_delete) {
                // Use the except method to exclude specified columns
                return collect($item)->except($columns_to_delete)->all();
            });

            // CASO EXCEL
            if($exportar_flag == 1){
                $filename = 'exportacion_'.Carbon::now()->format('d-m-Y_H:i:s').'.xlsx';
                return Excel::download(new ProcesosExport($data), $filename);
            }else{ // CASO PDF

                $filename = 'exportacion_'.Carbon::now()->format('d-m-Y_H:i:s').'.pdf';
                // Create a PDF using laravel-dompdf
                $pdf = Pdf::loadView('pdf.exportacion_procesos', ['data' => $data])
                    ->setOptions(['enable_php' => true])
                    ->setPaper('letter', 'landscape');
                // Download the PDF
                return $pdf->download($filename);
            }
        }
    }


    public function cambio_fase_create_view($id){

        //EN TODOS LOS CASOS "TRANSPORTE" DEBE INGRESAR DATOS PARA EL CAMBIO DE FASE
        //[FIRMA EL QUE PASA y RECIBE] (BODEGA), (EN CAMINO IDA) (FIRMA BODEGA Y CLIENTE)
        //[FIRMA EL QUE PASA y RECIBE] (EN CLIENTE y PARA RETIRO), (EN CAMINO VUELTA) (FIRMA CLIENTE Y BODEGA)
        dd("entra");
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

    public function venta_store(Request $request)
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


    public function carga_masiva(Request $request)
    {
        ini_set('max_execution_time', 300);
        
        $validated = $request->validate([
            'documento' => 'required|mimes:xlsx,xls',
        ]);

        try {
            $input = $request->all();

            $rows = Excel::toArray(new ImportExcel(), $request->file('documento'))[0];
            $column_list = $rows[0];
            $indices = [0,1,2,3,4,5,6,7,8,9,10,11,12,13,14,18];
            $columnas_ids = array_intersect_key($column_list, array_flip($indices));
            // nombre_columna => posicion_excel
            $columnas_ids = array_flip($columnas_ids);

            $row = $rows[1];
            //dd($row[$columnas_ids['sub_familia_id']]);
            $cont = 0;

            /*
            if(isset($input['estado-checkbox_carga'])){
                Activo::truncate();
                ArriendoActivo::truncate();
                Venta::truncate();
            }
            */
             
            foreach($rows as $row){
                if($cont > 0 ){

                    if($row[$columnas_ids['precio_compra']] != "SIN REGISTRO" && $row[$columnas_ids['precio_compra']] != "SIN COBRO" && $row[$columnas_ids['precio_compra']] != "NO DETALLA")
                        $precio_compra = $row[$columnas_ids['precio_compra']];
                    else $precio_compra = 0;

                    if($row[$columnas_ids['año']] != "NO DETALLA") $año = $row[$columnas_ids['año']];
                    else $año = 2000;

                    $activo = Activo::firstOrCreate(['codigo_interno' => $row[$columnas_ids['codigo_interno']]],
                    //$activo = Activo::create(
                    [
                        //"id" => $cont,
                        "sub_familia_id" => $row[$columnas_ids['sub_familia_id']],
                        "marca" => $row[$columnas_ids['marca']],
                        "modelo" => $row[$columnas_ids['modelo']],
                        "año" => $año,
                        "clasificacion" => $row[$columnas_ids['clasificacion']],
                        "codigo_interno" => $row[$columnas_ids['codigo_interno']],
                        "numero_serie" => $row[$columnas_ids['numero_serie']],
                        "horas_uso_promedio" => $row[$columnas_ids['horas_uso_promedio']],
                        "precio_compra" => $precio_compra,
                        "orden_compra" => $row[$columnas_ids['orden_compra']],
                        "vida_util" => $row[$columnas_ids['vida_util']],
                        "valor_residual" => $row[$columnas_ids['valor_residual']],
                        "estado" => "DISPONIBLE",
            
                        "tiempo_uso_meses" => $row[$columnas_ids['tiempo_uso_meses']],
                        "centro_costos" => $row[$columnas_ids['centro_costos']],
                        "tipo_moneda" => $row[$columnas_ids['tipo_moneda']],
                    ]);

                    if(!File::exists('storage/activos/'.$activo->id)) {
                        //Creamos la ruta pública del activo
                        File::makeDirectory(public_path('storage/activos/'.$activo->id));
                        //Generamos QR
                        QrCode::generate($_ENV['APP_URL'].'/inventario/'.$activo->id, public_path("storage/activos/".$activo->id.'/QR_CODE_'.$activo->id.'.svg'));
                    }
    
                    if(!File::exists('storage/mantenciones/'.$activo->id)) {
                        //Creamos la ruta pública para mantenciones
                        File::makeDirectory(public_path('storage/mantenciones/'.$activo->id));
                    }
    
                    $activo->codigo_qr = 'QR_CODE_'.$activo->id.'.svg';
                    $activo->save();

                }
                $cont +=1;
            }

            flash("Los datos se han registrado correctamente", "success");
            return back();
        }catch (Exception $e) {
            return response()->json(['message' => 'Something went wrong. Please try again later.'], 500);
        }
    }


    public function baja_activo_create($id)
    {
        $activo = Activo::where('id', $id)->first();
        if($activo){
            $empresas = Empresa::get();
            $proyectos = Proyecto::get()->groupBy('empresa_id');

            return view('baja_activo.create')
                ->with('empresas', $empresas)
                ->with('proyectos', $proyectos)
                ->with('activo', $activo);
        }else{
            flash("El activo que intentas dar de baja no existe.", "danger");
            return redirect()->route('activo.index');
        }
    }


    public function baja_activo_store(Request $request): RedirectResponse
    {
        $input = $request->all();

        $activo = Activo::where('id', $input['activo_id'])->first();

        if(!$activo->inoperativo){
            $activo->inoperativo = true;
            $baja_activo = BajaActivo::create([
                "activo_id" => $input['activo_id'],
                "fecha" => $input['fecha'],
                "proyecto_id" => $input['proyecto_id'],
                "observaciones" => $input['observaciones'],
            ]);
    
    
            // Guardamos los archivos
            if($request->hasFile('archivo1'))
            {
                $archivo1 = $request->file('archivo1');
                $type = $archivo1->guessExtension();
                $nombre = 'archivo1_'.$activo->id.time().'.'.$type;
    
                $ruta = public_path("storage/activos/".$activo->id.'/'.$nombre);
                copy($archivo1,$ruta);
    
                $baja_activo->archivo1 = $nombre;
            }
    
            if($request->hasFile('archivo2'))
            {
                $archivo2 = $request->file('archivo2');
                $type = $archivo2->guessExtension();
                $nombre = 'archivo2_'.$activo->id.time().'.'.$type;
    
                $ruta = public_path("storage/activos/".$activo->id.'/'.$nombre);
                copy($archivo2,$ruta);
    
                $baja_activo->archivo2 = $nombre;
            }
    
            if($request->hasFile('archivo3'))
            {
                $archivo3 = $request->file('archivo3');
                $type = $archivo3->guessExtension();
                $nombre = 'archivo3_'.$activo->id.time().'.'.$type;
    
                $ruta = public_path("storage/activos/".$activo->id.'/'.$nombre);
                copy($archivo3,$ruta);
    
                $baja_activo->archivo3 = $nombre;
            }
    
            $activo->save();
            $baja_activo->save();
            
    
            $activos = Activo::get();
    
            flash("El activo se ha dado de baja correctamente", "success");
    
            return redirect()->route('activo.index');

        }else{
            flash("El activo ya ha sido dado de baja.", "danger");
            return redirect()->route('activo.index');
        }
        

    }


}
