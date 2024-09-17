<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;

class UsuarioController extends Controller
{
    // Listar Usuarios
    public function index()
    {
        $usuarios = Usuario::get();
        return $usuarios;
    }

    // Ver un Usuario
    public function show($id)
    {
        $usuario = Usuario::find($id);
        if (is_null($usuario)) {
            return 'El usuario buscado no existe.';
        }
        return $usuario;
    }

    // Crear un Usuario
    public function store(Request $request)
    {
        $params = $request->all();
        $usuario = Usuario::create([
            'email' => $params['email'],
            'pass' => $params['pass'],
            'nombre' => $params['nombre'],
            'apellido' => $params['apellido'],
            'telefono' => $params['telefono'],
            'genero' => $params['genero'],
            'huella' => $params['huella'],
            'tipo_user' => $params['tipo_user']
        ]);


        return $usuario;
    }

    // Eliminar Usuario
    public function destroy($id)
    {
        $usuario = Usuario::find($id)->delete();

        if ($usuario) {
            return 'Usuario eliminado.';
        } else {
            return 'No se pudo eliminar.';
        }
    }

    // Actualizar Usuario
    public function update($id, Request $request)
    {
        $params = $request->all();
        $usuario = Usuario::find($id)->update([
            'email' => $params['email'],
            'pass' => $params['pass'],
            'nombre' => $params['nombre'],
            'apellido' => $params['apellido'],
            'telefono' => $params['telefono'],
            'genero' => $params['genero'],
            'huella' => $params['huella']
        ]);
        return $usuario ? 'El usuario fue actualizado.' : 'No se pudo actualizar el usuario.';
    }
}
