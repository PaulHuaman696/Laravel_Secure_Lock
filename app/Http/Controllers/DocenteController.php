<?php

namespace App\Http\Controllers;

use App\Models\Docente;
use App\Models\Usuario;
use Illuminate\Http\Request;

class DocenteController extends Controller
{
    // Listar Docentes
    public function index()
    {
        $docentes = Docente::with('usuario')->get();
        return $docentes;
    }

    // Ver un Docente
    public function show($id)
    {
        $docente = Docente::with('usuario')->find($id);
        if (is_null($docente)) {
            return 'El docente buscado no existe.';
        }
        return $docente;
    }

    // Crear un Docente
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
            $docente = Docente::create([
                'id_usuario' => $usuarioObj->id,
                'codigo' => $params['codigo'],
                'grado' => $params['grado'],
                'facultad' => $params['facultad']
            ]);

            return $docente;
        }
    }

    // Eliminar Docente
    public function destroy($id)
    {
        $docente = Docente::find($id)->delete();

        if ($docente) {
            return 'Docente eliminado.';
        } else {
            return 'No se pudo eliminar.';
        }
    }

    // Actualizar Docente
    public function update($id, Request $request)
    {
        $params = $request->all();
        $docente = Docente::find($id)->update([
            'id_usuario' => $params['id_usuario'],
            'codigo' => $params['codigo'],
            'grado' => $params['grado'],
            'facultad' => $params['facultad']
        ]);
        return $docente ? 'El docente fue actualizado.' : 'No se pudo actualizar el docente.';
    }
}
