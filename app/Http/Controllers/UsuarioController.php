<?php

namespace App\Http\Controllers;

use App\Models\Usuario as Usuario;
use Illuminate\Http\Request;

class UsuarioController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function mostrarTodosUsuarios()
    {
        return response()->json(Usuario::all());
    }

    public function cadastrarUsuario(Request $request)
    {
        $this->validate($request, [
            'usuario'  => 'required|min:5|max:40',
            'email'    => 'required|email|unique:usuarios,email',
            'password' => 'required',
        ]);

        $usuario = new Usuario;
        $usuario->usuario = $request->usuario;
        $usuario->email = $request->email;
        $usuario->password = $request->password;

        $usuario->save();

        return response()->json($usuario);
    }

    public function mostrarUmUsuario($id)
    {
        return response()->json(Usuario::find($id));
    }

    public function atualizarUsuario($id, Request $request)
    {
        $usuario = Usuario::find($id);

        $usuario->usuario = $request->usuario;
        $usuario->email = $request->email;
        $usuario->password = $request->password;

        $usuario->save();

        return response()->json($usuario);
    }

    public function deletarUsuario($id)
    {
        $usuario = Usuario::find($id);

        $usuario->delete();

        return response()->json("Usuário deletado com sucesso!", 200);
    }

}
