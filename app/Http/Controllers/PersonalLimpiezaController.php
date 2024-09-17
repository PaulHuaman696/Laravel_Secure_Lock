<?php

namespace App\Http\Controllers;

use App\Models\PersonalLimpieza;
use App\Models\Usuario;
use Illuminate\Http\Request;

class PersonalLimpiezaController extends Controller
{
    // Listar Personal de Limpieza
    public function index()
    {
        $personalLimpieza = PersonalLimpieza::with('usuario')->get();
        return $personalLimpieza;
    }

    // Ver un Miembro del Personal de Limpieza
    public function show($id)
    {
        $miembro = PersonalLimpieza::with('usuario')->find($id);
        if (is_null($miembro)) {
            return 'El miembro del personal de limpieza buscado no existe.';
        }
        return $miembro;
    }

    // Crear un Miembro del Personal de Limpieza
    public function store(Request $request)
    {
        $params = $request->all();
        if (isset($params['usuario']) && is_array($params['usuario'])) {
            $usuario = $params['usuario'];

            // Crear un nuevo usuario con los datos proporcionados
            $usuarioObj = Usuario::create([
                'email' => $usuario['email'],
                'pass' => $usuario['pass'],
                'nombre' => $usuario['nombre'],
                'apellido' => $usuario['apellido'],
                'telefono' => $usuario['telefono'],
                'genero' => $usuario['genero'],
                'huella' => $usuario['huella'],
                'tipo_user' => $usuario['tipo_user']
            ]);
            $miembro = PersonalLimpieza::create([
                'id_usuario' => $usuarioObj->id,
                'codigo' => $params['codigo']
            ]);

            return $miembro;
        }
    }

    // Eliminar un Miembro del Personal de Limpieza
    public function destroy($id)
    {
        $miembro = PersonalLimpieza::find($id)->delete();

        if ($miembro) {
            return 'Miembro del personal de limpieza eliminado.';
        } else {
            return 'No se pudo eliminar.';
        }
    }

    // Actualizar un Miembro del Personal de Limpieza
    public function update($id, Request $request)
    {
        $params = $request->all();
        $miembro = PersonalLimpieza::find($id)->update([
            'id_usuario' => $params['id_usuario'],
            'codigo' => $params['codigo']
        ]);
        return $miembro ? 'El miembro del personal de limpieza fue actualizado.' : 'No se pudo actualizar el miembro del personal de limpieza.';
    }
}
