<?php

namespace App\Http\Controllers;

use App\Models\Matricula;
use App\Models\Alumno;
use App\Models\Curso;
use Illuminate\Http\Request;

class MatriculaController extends Controller
{
    // Listar Matriculas
    public function index()
    {
        $matriculas = Matricula::with(['alumno', 'curso'])->get();
        return $matriculas;
    }

    // Ver una Matricula
    public function show($id)
    {
        $matricula = Matricula::with(['alumno', 'curso'])->find($id);
        if (is_null($matricula)) {
            return 'La matrícula buscada no existe.';
        }
        return $matricula;
    }

    // Crear una Matricula
    public function store(Request $request)
    {
        $params = $request->all();

        $alumno = Alumno::find($params['id_alumno']);
        $curso = Curso::find($params['id_curso']);
        if (is_null($alumno)) {
            return "El alumno no existe.";
        } else {
            if (!is_null($curso)) {
                $matriculaExistente = Matricula::where('id_alumno', $params['id_alumno'])
                    ->where('id_curso', $params['id_curso'])
                    ->first();

                if (!is_null($matriculaExistente)) {
                    return "Ya existe una matrícula para este alumno y curso.";
                } else {
                    // Si no existe una matrícula duplicada, crear un nuevo registro de matrícula
                    $matricula = Matricula::create([
                        'id_curso' => $params['id_curso'],
                        'id_alumno' => $params['id_alumno']
                    ]);

                    return $matricula;
                }
            } else {
                return "El curso no existe.";
            }
        };
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
