<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){
        $this->middleware('auth');       

        //TODO Redireccionamiento según Role de usuario
        if(auth()->user()->superadmin){
            return redirect()->route('activo.index', [0]);
        }else if(auth()->user()->admin){
            return redirect()->route('activo.index', [0]);
        }else if(auth()->user()->bodega){
            return redirect()->route('transporte.transporte');
        }else 
            return redirect('/login');
    }
}