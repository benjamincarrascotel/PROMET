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

use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;


use Maatwebsite\Excel\Facades\Excel;
use App\Imports\ImportExcel;

use DataTables;




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
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Activo::select('*');
            return Datatables::of($data)

                    ->addColumn('estado', function($row){
                        //Operativo
                        if(! $row->inoperativo){
                            if($row->estado == "EN MANTENCION")
                                return '<td class="text-nowrap align-middle"><span>EN PROCESO DE MANTENCION</span></td>';
                            elseif($row->arriendo_flag)
                                return '<td class="text-nowrap align-middle"><span>EN PROCESO DE ARRIENDO</span></td>';
                            elseif($row->venta_flag)
                                return '<td class="text-nowrap align-middle"><span>EN PROCESO DE VENTA</span></td>';
                            elseif($row->estado == "DISPONIBLE")
                                return '<td class="text-nowrap align-middle"><span>DISPONIBLE</span></td>';
                        }
                        //Inoperativo
                        return '<td class="text-nowrap align-middle"><span>INOPERATIVO</span></td>';
                    })

                    ->addIndexColumn()

                    ->addColumn('elemento', function($row){
                        return $row->marca." - ".$row->modelo." - ".$row->año;
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
                        $url = $_ENV['APP_URL']."/storage/activos/".$row->id.'/QR_CODE.svg';
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
                            return 
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
                            return 
                                '<td class="align-middle text-center">
                                    <a href="'.$url.'">
                                        <button id="iniciar_mantencion" class="btn btn-sm btn-success" type="button" data-toggle="tooltip" data-placement="top" title="INICIAR MANTENCIÓN">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 512 512" xml:space="preserve"><path d="m360.102 240.012 10.156-10.266s15.609-13.406 33.406-7.328c30.984 10.578 66.781-.875 91.609-25.734 7.063-7.063 15.641-21.234 15.641-21.234a5.596 5.596 0 0 0 .922-4.672l-1.922-7.906a5.671 5.671 0 0 0-2.625-3.531 5.566 5.566 0 0 0-4.344-.547l-60.984 16.969a5.648 5.648 0 0 1-6.063-2.109l-28.015-38.594a5.564 5.564 0 0 1-1.016-4.063l5.641-41a5.595 5.595 0 0 1 4.063-4.656l64.406-17.922c2.906-.813 4.672-3.813 3.953-6.766l-2.547-10.359a5.61 5.61 0 0 0-2.563-3.5s-5.047-3.344-8.719-5.234c-36.578-18.891-82.64-13.031-113.312 17.656-22.656 22.656-31.531 53.688-27.375 83.156 3.203 22.656 1.703 34.703-8.078 45.047-.891.922-3.703 3.734-8.047 8l45.813 44.593zm-148.719 55.406A183455.446 183455.446 0 0 1 68.461 433.715a13.135 13.135 0 0 0-4.047 9.313 13.092 13.092 0 0 0 3.813 9.375l31.938 31.938a13.071 13.071 0 0 0 9.391 3.813 13.018 13.018 0 0 0 9.281-4.031L258.165 343.17l-46.782-47.752zM501.43 451.371a13.008 13.008 0 0 0 3.813-9.375c-.031-3.516-1.5-6.859-4.031-9.297L227.415 166.246l-43.953 43.969L450.805 483.09c2.438 2.547 5.781 4 9.297 4.047s6.891-1.344 9.391-3.828l31.937-31.938zM254.196 32.621c-32.969-12.859-86.281-14.719-117.156 16.141a472188.334 472188.334 0 0 0-59.875 59.891c-12.672 12.656-.906 25.219-10.266 34.563-9.359 9.359-24.313 0-32.734 8.422L3.29 182.527c-4.391 4.375-4.391 11.5 0 15.891l43.016 43.016c4.391 4.391 11.516 4.391 15.906 0l30.875-30.875c8.438-8.422-.938-23.375 8.438-32.719 12.609-12.625 26.375-10.484 34.328-2.547l15.891 15.891 17.219 4.531 43.953-43.953-5.063-16.688c-14.016-14.031-16.016-30.266-7.234-39.047 13.594-13.594 36.047-33.234 57.078-41.656 13.405-5.359 9.358-18.703-3.501-21.75zm-59.625 70.859c-.063.047 5.859-7.281 5.969-7.375l-5.969 7.375z" style="fill:#000"/></svg>                                                                    
                                    </a>
                                </td>'
                            ;
                        }else{
                            return 
                                '<td class="align-middle text-center">
                                    <a href="#">
                                        <button disabled class="btn btn-sm btn-success" type="button" data-toggle="tooltip" data-placement="top" title="INICIAR MANTENCIÓN">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 512 512" xml:space="preserve"><path d="m360.102 240.012 10.156-10.266s15.609-13.406 33.406-7.328c30.984 10.578 66.781-.875 91.609-25.734 7.063-7.063 15.641-21.234 15.641-21.234a5.596 5.596 0 0 0 .922-4.672l-1.922-7.906a5.671 5.671 0 0 0-2.625-3.531 5.566 5.566 0 0 0-4.344-.547l-60.984 16.969a5.648 5.648 0 0 1-6.063-2.109l-28.015-38.594a5.564 5.564 0 0 1-1.016-4.063l5.641-41a5.595 5.595 0 0 1 4.063-4.656l64.406-17.922c2.906-.813 4.672-3.813 3.953-6.766l-2.547-10.359a5.61 5.61 0 0 0-2.563-3.5s-5.047-3.344-8.719-5.234c-36.578-18.891-82.64-13.031-113.312 17.656-22.656 22.656-31.531 53.688-27.375 83.156 3.203 22.656 1.703 34.703-8.078 45.047-.891.922-3.703 3.734-8.047 8l45.813 44.593zm-148.719 55.406A183455.446 183455.446 0 0 1 68.461 433.715a13.135 13.135 0 0 0-4.047 9.313 13.092 13.092 0 0 0 3.813 9.375l31.938 31.938a13.071 13.071 0 0 0 9.391 3.813 13.018 13.018 0 0 0 9.281-4.031L258.165 343.17l-46.782-47.752zM501.43 451.371a13.008 13.008 0 0 0 3.813-9.375c-.031-3.516-1.5-6.859-4.031-9.297L227.415 166.246l-43.953 43.969L450.805 483.09c2.438 2.547 5.781 4 9.297 4.047s6.891-1.344 9.391-3.828l31.937-31.938zM254.196 32.621c-32.969-12.859-86.281-14.719-117.156 16.141a472188.334 472188.334 0 0 0-59.875 59.891c-12.672 12.656-.906 25.219-10.266 34.563-9.359 9.359-24.313 0-32.734 8.422L3.29 182.527c-4.391 4.375-4.391 11.5 0 15.891l43.016 43.016c4.391 4.391 11.516 4.391 15.906 0l30.875-30.875c8.438-8.422-.938-23.375 8.438-32.719 12.609-12.625 26.375-10.484 34.328-2.547l15.891 15.891 17.219 4.531 43.953-43.953-5.063-16.688c-14.016-14.031-16.016-30.266-7.234-39.047 13.594-13.594 36.047-33.234 57.078-41.656 13.405-5.359 9.358-18.703-3.501-21.75zm-59.625 70.859c-.063.047 5.859-7.281 5.969-7.375l-5.969 7.375z" style="fill:#000"/></svg>                                                                    
                                    </a>
                                </td>'
                            ;
                        }
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
                        if (!empty($request->get('search'))) {
                             $instance->where(function($w) use($request){
                                $search = $request->get('search');
                                $w->orWhere('estado', 'LIKE', "%$search%")
                                ->orWhere('marca', 'LIKE', "%$search%")
                                ->orWhere('id', 'LIKE', "%$search%");
                            });
                        }
                    })
                    ->rawColumns(['estado', 'id', 'elemento', 'codigo_interno', 'numero_serie', 'arriendo', 'mantencion', 'venta' ])
                    ->escapeColumns([])
                    ->make(true);
        }
        


        return view('activo.index');
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
                    return $row->activo->marca." - ".$row->activo->modelo." - ".$row->activo->año;
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
                    return 
                        '<div class="wrapper">
                            <p class="mt-2 text-muted ">'.Carbon::parse($row->fecha_termino)->format('d-m-Y').'</p>
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
                        $formContent .= '<button class="btn btn-sm btn-success flex-fill mb-1" type="submit"><i class="fe fe-check-square"></i> Disponibilizar para retiro</button>';
                        if(isset($row->monto))
                            $formContent .= '<a class="btn btn-sm btn-primary flex-fill mb-1" type="button" href="' . route('traspaso.create', [$row->id]) . '"><i class="fe fe-truck"></i> Traspasar</a>';
                        elseif(isset($row->precio_venta))
                            $formContent .= '<a class="btn btn-sm btn-primary flex-fill mb-1" type="button" href="' . route('traspaso_venta.create', [$row->id]) . '"><i class="fe fe-truck"></i> Traspasar</a>';
                    } elseif ($row->estado == "BODEGA DE VUELTA" && $row->activo->estado != "EN MANTENCION") {
                        $formContent .= '<button class="btn btn-sm btn-success flex-fill mb-1" type="submit" data-bs-toggle="" data-bs-target="#user-form-modal">Confirmación FINAL</button>';
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
                    if ($request->get('proyecto') && $request->get('proyecto') != "null") {
                        $instance->where('proyecto_id', $request->get('proyecto'));
                    }
                    //TODO filtrar por empresa
                    if (!empty($request->get('search'))) {
                        $instance->where(function($w) use($request){
                            $search = $request->get('search');
                            $w->orWhere('activo_id', 'LIKE', "%$search%")
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


    public function ingresar_arriendo_create($id)
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

    public function ingresar_arriendo_store(Request $request)
    {
        $input = $request->all();
        $activo = Activo::where('id', $input['activo_id'])->first();
        if($activo->estado == "DISPONIBLE" && !$activo->venta_flag && !$activo->arriendo_flag){           

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
                                <p>' . $row->activo->marca . ' -- ' . $row->activo->modelo . ' -- ' . $row->activo->año . '</p>
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
                                    <p class="mb-0 mt-1 fs-18 font-weight-semibold">' . $row->activo->marca . ' -- ' . $row->activo->modelo . ' -- ' . $row->activo->año . '</p>
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
                                <p class="mt-2 text-muted ">' . Carbon::parse($row->fecha_termino)->format('d-m-Y') . '</p>
                            </div>
                            <div class="text-white text-center">';

                    if ($row->estado == "BODEGA" || $row->estado == "EN CAMINO VUELTA") {
                        $formContent .= '<form method="GET" action="' . route('transporte.qr_reader', [$row->activo->id]) . '">
                            <td class="align-middle">';

                        $formContent .= '<button class="btn btn-xl btn-success me-2" type="submit" data-bs-toggle="" data-bs-target="#user-form-modal">Cambiar de fase</button>';
                        $formContent .= '<input type="hidden" name="_token" value="' . $csrfToken . '">';

                        $formContent .= '</td>
                            </form>';
                    } elseif ($row->estado == "EN CAMINO IDA" || $row->estado == "EN CLIENTE") {
                        $formContent .= '<form method="POST" action="' . route('transporte.cambio_fase') . '" enctype="multipart/form-data">
                            <input type="hidden" name="_token" value="' . $csrfToken . '">
                            
                            <input hidden type="integer" id="activo_id" name="activo_id" value="' . $row->activo->id . '">
                            <td class="align-middle">';

                        if ($row->estado == "EN CAMINO IDA") {
                            $formContent .= '<button class="btn btn-xl btn-success me-2" type="submit" data-bs-toggle="" data-bs-target="#user-form-modal">Cambiar de fase</button>';
                        } elseif ($row->estado == "EN CLIENTE" && $row->activo->estado == "ARRENDADO") {
                            $formContent .= '<button class="btn btn-xl btn-danger me-2" type="submit" data-bs-toggle="" data-bs-target="#user-form-modal">Disponibilizar para retiro</button>';
                        } elseif ($row->estado == "EN CLIENTE" && $row->activo->estado == "PARA RETIRO") {
                            $formContent .= '<button class="btn btn-xl btn-success me-2" type="submit" data-bs-toggle="" data-bs-target="#user-form-modal">Cambiar de fase</button>';
                        }

                        $formContent .= '</td>
                            </form>';
                    } else {
                        $formContent .= '<button disabled class="btn btn-xl btn-warning me-2" type="submit" data-bs-toggle="" data-bs-target="#user-form-modal">(ESPERANDO CONFIRMACIÓN)</button>';
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
                    if ($request->get('proyecto') && $request->get('proyecto') != "null") {
                        $instance->where('proyecto_id', $request->get('proyecto'));
                    }
                    //TODO filtrar por empresa
                    if (!empty($request->get('search'))) {
                        $instance->where(function($w) use($request){
                            $search = $request->get('search');
                            $w->orWhere('activo_id', 'LIKE', "%$search%")
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
            return redirect()->route('arriendo.transporte');
        }

        

    }

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
            //dd("entra");
            $arriendos = ArriendoActivo::whereNotIn('estado', ["TERMINADO"])->get();
            return view('bodega.transporte')
                ->with('arriendos', $arriendos);
            //Casos en que se pueda cambiar directamente de fase (REDIRECT A OTRA RUTA POST)
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
        $empresas = Empresa::get();
        $proyectos = Proyecto::where('estado', 'ACTIVO')->get()->groupBy('empresa_id');
        $selectedID = 0;
        return view('venta.create')
            ->with('empresas', $empresas)
            ->with('selectedID', $selectedID)
            ->with('proyectos', $proyectos)
            ->with('activo', $activo);
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

            //dd($request->all());
            $venta = Venta::create([
                "activo_id" => $input['activo_id'],
                "precio_venta" => $input['precio_venta'],
                "tipo_moneda" => $input['tipo_moneda'],
                "fecha_inicio" => $input['fecha_inicio'],
                "fecha_termino" => $input['fecha_termino'],
                "proyecto_id" => $input['proyecto_id'],
                "encargado" => $input['encargado'],
                
                "estado" => "BODEGA",
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

    public function show_venta($id)
    {
        $venta = Venta::where('id', $id)->first();
        $traspasos = TraspasoVenta::where('venta_id', $id)->get();

        return view('venta.show')
                ->with('traspasos', $traspasos)
                ->with('venta', $venta);
    }

    public function update_venta(Request $request, $id)
    {
        $request->request->remove('_token');
        $input = $request->all();
        $venta = Venta::where('id', $id)->update($request->all());
        $venta = Venta::where('id', $id)->first();

        flash("Los datos se han actualizado correctamente", "success");

        return redirect()->back();
        

    }


    //TODO traspasos
    public function traspaso_create($id){

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
    
            flash("El traspaso del arriendo se ha sido realizado correctamente", 'success');

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
    
            flash("El traspaso de la venta se ha sido realizado correctamente", 'success');

        }else{
            flash("Error: No hay concordancia en nuestros registros.", 'danger');
            return back();
        }


        $arriendos = ArriendoActivo::get();
        $ventas = Venta::get();

        return redirect()->route('activo.trazabilidad')
            ->with('ventas', $ventas)
            ->with('arriendos', $arriendos);
    }

    public function carga_masiva(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($input,[
            'documento' => 'required|mimes:xlsx,xls',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $rows = Excel::toArray(new ImportExcel(), $request->file('documento'))[0];
        $column_list = $rows[0];
        $indices = [0,1,2,3,4,5,6,7,8,9,10,11,12,13,14,18];
        $columnas_ids = array_intersect_key($column_list, array_flip($indices));
        // nombre_columna => posicion_excel
        $columnas_ids = array_flip($columnas_ids);

        $row = $rows[1];
        //dd($row[$columnas_ids['sub_familia_id']]);
        $cont = 0;
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
                    "id" => $cont,
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
            }
            $cont +=1;
        }

        flash("Los datos se han registrado correctamente", "success");
        return back();
    }


    public function carga_masiva_arriendo(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($input,[
            'documento' => 'required|mimes:xlsx,xls',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $rows = Excel::toArray(new ImportExcel(), $request->file('documento'))[0];
        $column_list = $rows[0];

        $indices = [0,1,2,3,4,5,6,7];
        $columnas_ids = array_intersect_key($column_list, array_flip($indices));
        // nombre_columna => posicion_excel
        $columnas_ids = array_flip($columnas_ids);

        $row = $rows[2];
        $activo = Activo::where('id', $row[$columnas_ids['activo_id']])->first();

        $delimiter = ' '; // The character to split the string by
        $codigo_sap = explode($delimiter, $row[$columnas_ids['proyecto_id']])[0];
        //dd($codigo_sap);

        $proyecto = Proyecto::where('codigo_sap', $codigo_sap)->first();
        dd($proyecto);
        
        //dd($row[$columnas_ids['sub_familia_id']]);
        $cont = 0;
        foreach($rows as $row){
            if($cont > 0 ){

                /*
                if($row[$columnas_ids['precio_compra']] != "SIN REGISTRO" && $row[$columnas_ids['precio_compra']] != "SIN COBRO" && $row[$columnas_ids['precio_compra']] != "NO DETALLA")
                    $precio_compra = $row[$columnas_ids['precio_compra']];
                else $precio_compra = 0;

                if($row[$columnas_ids['año']] != "NO DETALLA") $año = $row[$columnas_ids['año']];
                else $año = 2000;
                */

                $activo = Activo::firstOrCreate(['codigo_interno' => $row[$columnas_ids['codigo_interno']]],
                //$activo = Activo::create(
                [
                    "id" => $cont,
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
            }
            $cont +=1;
        }

        flash("Los datos se han registrado correctamente", "success");
        return back();
    }

}
