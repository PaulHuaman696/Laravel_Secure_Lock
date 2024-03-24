<?php

namespace App\Http\Controllers;

use App\Models\Alumno;
use Illuminate\Http\Request;

class AlumnoController extends Controller
{
    // Listar Alumnos
    public function index()
    {
        $alumnos = Alumno::get();
        return $alumnos;
    }

    // Ver un Alumno
    public function show($id)
    {
        $alumno = Alumno::find($id);
        if (is_null($alumno)) {
            return 'El alumno buscado no existe.';
        }
        return $alumno;
    }

    // Crear un Alumno
    public function store(Request $request)
    {
        $params = $request->all();
        $alumno = Alumno::create([
            'id_usuario' => $params['id_usuario'],
            'codigo' => $params['codigo'],
            'facultad' => $params['facultad'],
            'especialidad' => $params['especialidad'],
            'ciclo' => $params['ciclo']
        ]);

        return $alumno;
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
