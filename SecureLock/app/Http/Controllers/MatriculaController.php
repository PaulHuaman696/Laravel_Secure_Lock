<?php

namespace App\Http\Controllers;

use App\Models\Matricula;
use Illuminate\Http\Request;

class MatriculaController extends Controller
{
    // Listar Matriculas
    public function index()
    {
        $matriculas = Matricula::get();
        return $matriculas;
    }

    // Ver una Matricula
    public function show($id)
    {
        $matricula = Matricula::find($id);
        if (is_null($matricula)) {
            return 'La matrícula buscada no existe.';
        }
        return $matricula;
    }

    // Crear una Matricula
    public function store(Request $request)
    {
        $params = $request->all();
        $matricula = Matricula::create([
            'id_curso' => $params['id_curso'],
            'id_alumno' => $params['id_alumno']
        ]);

        return $matricula;
    }

    // Eliminar Matricula
    public function destroy($id)
    {
        $matricula = Matricula::find($id)->delete();

        if ($matricula) {
            return 'Matrícula eliminada.';
        } else {
            return 'No se pudo eliminar.';
        }
    }

    // Actualizar Matricula
    public function update($id, Request $request)
    {
        // La actualización de una matrícula puede no tener sentido, pero se deja el método para mantener la consistencia
        return 'Actualización de matrícula no permitida.';
    }
}
