<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Admin;
use App\Models\SuperAdmin;


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
            'email' => 'required|string|email|max:255|unique:users',
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
            } else {
                $usuario->superadmin = false;
            }

            if(isset($input['admin'])){
                $usuario->admin = true;
            } else {
                $usuario->admin = false;
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
            else if(isset($input['admin']))
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
            

            // flash('Usuario guardado exitosamente')->success();
            // return view('usuarios.show', compact('usuarios'));

            $usuarios = User::get();   
            return view('usuarios.index', compact('usuarios'));
        }
        else
        {
            // flash('Las claves no coinciden, trate nuevamente')->error();
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User $User
     * @return \Illuminate\Http\Response
     */
    public function show(User $usuario)
    {
        return view('usuarios.show', compact('usuario'));
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

     /*TODO POR BORRAR
    public function update(Request $request, User $usuario)
    {
        $input = $request->all();

        if((!empty($input['password']) || !empty($input['password2'])) && $input['password2'] != $input['password'])
        {
            flash('Las claves no coinciden, trate nuevamente')->error();
            return redirect()->back();
        }
        elseif(!empty($input['password']) && !empty($input['password2']))
        {
            $usuario->salt = md5(sprintf("%d%d%d%dAMPLIFICA%s", random_int(1,9), random_int(1,9), random_int(1,9), random_int(1,9), strtotime(date("Y-m-d H:i:s"))));
            $usuario->password = hash_pbkdf2('haval256,5', $input['password'], $usuario->salt, 5, false, false);
        }

        $usuario->name = $input['name'];
        $usuario->email = $input['email'];

        $car = 0;

        if(isset($request->flags))
        {
            foreach($request->flags as $carD)
                $car += $carD;
        }

        $usuario->flags = $car;

        if(intval($input['proveedor']))
        {
            $usuario->proveedor = true;
            if(!array_key_exists('cliente_rol_id', $input))
                $usuario->rol_id = null;
            else
            {
                $rol = Rol::find($input['cliente_rol_id']);
                if($rol->rol_cliente)
                {
                    $usuario->rol_id = $input['cliente_rol_id'];
                }
            }
        }
        else
        {
            $usuario->proveedor = false;
            if(!array_key_exists('rol_id', $input))
                $usuario->rol_id = null;
            else
                $usuario->rol_id = $input['rol_id'];
        }

        $usuario->save();

        UserCliente::where('user_id', $usuario->id)->delete();
        UserSucursal::where('user_id', $usuario->id)->delete();

        if(intval($input['proveedor']))
        {
            if(array_key_exists('tienda_id', $input))
            {
                foreach($input['tienda_id'] as $tienda_id)
                {
                    $uc = new UserCliente();
                    $uc->tienda_id = $tienda_id;
                    $uc->user_id = $usuario->id;
                    $uc->save();
                }
            }
        }
        else
        {
            if(array_key_exists('sucursal_id', $input))
            {
                foreach($input['sucursal_id'] as $sucursal_id)
                {
                    $us = new UserSucursal();
                    $us->sucursal_id = $sucursal_id;
                    $us->user_id = $usuario->id;
                    $us->save();
                }
            }
        }

        // $redis = LRedis::connection();
        // $redis->publish(CANAL_SOCKET_USUARIO, json_encode([
        //                                 'tipo'=>'UsuarioCreado',
        //                                 'motivo'=>'success',
        //                                 'mensaje'=>'Se ha editado un Usuario con éxito.'
        //                                 ]));

        flash('Usuario actualizado correctamente')->success();
        return view('usuarios.show', compact('usuario'));
    }
    */

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User $usuarios
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $usuario = User::where('id', $id)->first();
        $usuario->delete();

        // $redis = LRedis::connection();
        // $redis->publish(CANAL_SOCKET_USUARIO, json_encode([
        //                                 'tipo'=>'UsuarioCreado',
        //                                 'motivo'=>'warn',
        //                                 'mensaje'=>'Se ha eliminado un Usuario con éxito.'
        //                                 ]));
        return back()->with('message', 'User deleted successfully');
    }
}
