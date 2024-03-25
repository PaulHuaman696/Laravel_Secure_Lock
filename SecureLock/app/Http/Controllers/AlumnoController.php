<?php

namespace App\Http\Controllers;

use App\Models\Alumno;
use App\Models\Usuario;
use Illuminate\Http\Request;

class AlumnoController extends Controller
{
    // Listar Alumnos
    public function index()
    {
        $alumnos = Alumno::with('usuario')->get();
        return $alumnos;
    }

    // Ver un Alumno
    public function show($id)
    {
        $alumno = Alumno::with('usuario')->find($id);
        if (is_null($alumno)) {
            return 'El alumno buscado no existe.';
        }
        return $alumno;
    }

    // Crear un Alumno
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
            $alumno = Alumno::create([
                'id_usuario' => $usuarioObj->id,
                'codigo' => $params['codigo'],
                'facultad' => $params['facultad'],
                'especialidad' => $params['especialidad'],
                'ciclo' => $params['ciclo']
            ]);

            return $alumno;
        }
    }

    // Eliminar Alumno
    public function destroy($id)
    {
        $alumno = Alumno::find($id)->delete();

        if ($alumno) {
            return 'Alumno eliminado.';
        } else {
            return 'No se pudo eliminar.';
        }
    }

    // Actualizar Alumno
    public function update($id, Request $request)
    {
        $params = $request->all();
        $alumno = Alumno::find($id)->update([
            'id_usuario' => $params['id_usuario'],
            'codigo' => $params['codigo'],
            'facultad' => $params['facultad'],
            'especialidad' => $params['especialidad'],
            'ciclo' => $params['ciclo']
        ]);
        return $alumno ? 'El alumno fue actualizado.' : 'No se pudo actualizar al alumno.';
    }
}
