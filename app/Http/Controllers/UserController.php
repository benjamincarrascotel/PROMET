<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\SuperAdmin;
use App\Models\Admin;
use App\Models\BodegaUser;



class UserController extends Controller
{
    public function index()
    {
        $usuarios = User::get();   
        return view('usuarios.index', compact('usuarios'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('usuarios.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'apellido1' => 'required|string|max:255',
            'apellido2' => 'required|string|max:255',
            'rut' => 'required|string|max:255',
            'rut_dv' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users|unique:superadmins|unique:admins|unique:bodega_users',
            'password' => 'required|string|confirmed|min:8',
        ]);

        $input = $request->all();
        
        // dd($input);

        if($input['password']===$input['password_confirmation'])
        {
            $usuario = new User();
            $usuario->name = $input['nombre'];
            $usuario->email = $input['email'];
                
            $usuario->salt = md5(sprintf("%d%d%d%dGAC%s", random_int(1,9), random_int(1,9), random_int(1,9), random_int(1,9), strtotime(date("Y-m-d H:i:s"))));
            $usuario->password = hash_pbkdf2('haval256,5', $input['password'], $usuario->salt, 5, false, false);

            if(isset($input['superadmin'])){
                $usuario->superadmin = true;
                $usuario->admin = true;
                $usuario->bodega = true;
            }
            elseif(isset($input['admin'])){
                $usuario->admin = true;
                $usuario->bodega = true;
            }
            elseif(isset($input['bodega'])){
                $usuario->bodega = true;
            }
            $usuario->save();

            if(isset($input['superadmin']) && intval($input['superadmin']))
            {
                $superadmin = new SuperAdmin();
                $superadmin->email = $input['email'];
                $superadmin->password = $usuario->password;
                $superadmin->rut = $input['rut'];
                $superadmin->rut_dv = $input['rut_dv'];
                $superadmin->nombre = $input['nombre'];
                $superadmin->apellido1 = $input['apellido1'];
                $superadmin->apellido2 = $input['apellido2'];
                $superadmin->save();
            }
            elseif(isset($input['admin']) && intval($input['admin']))
            {
                $admin = new Admin();
                $admin->email = $input['email'];
                $admin->password = $usuario->password;
                $admin->rut = $input['rut'];
                $admin->rut_dv = $input['rut_dv'];
                $admin->nombre = $input['nombre'];
                $admin->apellido1 = $input['apellido1'];
                $admin->apellido2 = $input['apellido2'];
                $admin->save();
            }
            elseif(isset($input['bodega']) && intval($input['bodega']))
            {
                $bodega = new BodegaUser();
                $bodega->email = $input['email'];
                $bodega->password = $usuario->password;
                $bodega->rut = $input['rut'];
                $bodega->rut_dv = $input['rut_dv'];
                $bodega->nombre = $input['nombre'];
                $bodega->apellido1 = $input['apellido1'];
                $bodega->apellido2 = $input['apellido2'];
                $bodega->save();
            }
            

            flash('Usuario guardado exitosamente')->success();
            // return view('usuarios.show', compact('usuarios'));

            $usuarios = User::get();   
            return redirect()->route('usuarios.index');
        }
        else
        {
            flash('Las claves no coinciden, trate nuevamente')->error();
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User $User
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::where('id', $id)->first();
        if($user->superadmin)
            $usuario = SuperAdmin::where('email', $user->email)->first();
        elseif($user->admin || $user->bodega)
            $usuario = Admin::where('email', $user->email)->first();
        else{
            flash("El usuario no tiene un rol asignado")->error();
            return redirect()->back();
        }

        return view('usuarios.show', compact('usuario', 'user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User $User
     * @return \Illuminate\Http\Response
     */
    public function edit(User $usuario)
    {

        return view('usuarios.edit', compact('usuario'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\User $User
     * @return \Illuminate\Http\Response
     */

    public function update(Request $request, $id)
    {
        if($request->get('cambiarContraseña'))
        {
            $request->validate([
                'nombre' => 'required|string|max:255',
                'apellido1' => 'required|string|max:255',
                'apellido2' => 'required|string|max:255',
                'rut' => 'required|string|max:255',
                'rut_dv' => 'required|string|max:255',
                'password' => 'required|string|confirmed|min:8',
            ]);
            $request->request->remove('cambiarContraseña');
            $request->request->remove('password_confirmation');
        }else{
            $request->validate([
                'nombre' => 'required|string|max:255',
                'apellido1' => 'required|string|max:255',
                'apellido2' => 'required|string|max:255',
                'rut' => 'required|string|max:255',
                'rut_dv' => 'required|string|max:255',
            ]);
        }
        $request->request->remove('_token');
        $input = $request->all();

        $user = User::where('id', $id)->first();
        if(isset($input['password'])){
            $input['password'] = hash_pbkdf2('haval256,5', $input['password'], $user->salt, 5, false, false);
            $user->password = $input['password'];
        }
        
        if($user->superadmin){
            $superadmin = SuperAdmin::where('email', $user->email)->update($input);
        }elseif($user->admin){
            $admin = Admin::where('email', $user->email)->update($input);
        }elseif($user->bodega){
            $bodega = Bodega::where('email', $user->email)->update($input);
        }else{
            flash("El usuario no tiene un rol asignado")->error();
            return redirect()->back();
        }

        $user->name = $input['nombre'];

        $user->save();

        $usuarios = User::get();

        flash('Usuario [ ID : '.$id.'] actualizado correctamente')->success();
        return view('usuarios.index', compact('usuarios', 'user'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User $usuarios
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
        $usuario = User::where('id', $id)->first();
        
        if($usuario->superadmin)
            $datos_usuario = SuperAdmin::where('email', $usuario->email)->first();
        elseif($usuario->admin)
            $datos_usuario = Admin::where('email', $usuario->email)->first();
        elseif($usuario->bodega)
            $datos_usuario = BodegaUser::where('email', $usuario->email)->first();
        else{
            flash("El usuario no tiene un rol asignado")->error();
            return redirect()->back();
        }

        $datos_usuario->delete();

        $usuario->delete();

        flash('Usuario eliminado exitosamente', 'success');

        return redirect()->back();
    }
}
