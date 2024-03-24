<?php

namespace App\Http\Controllers;
use App\Models\Curso;
use Illuminate\Http\Request;

class CursoController extends Controller
{
    /// Listar Cursos
    public function index()
    {
        $cursos = Curso::get();
        return $cursos;
    }

    // Ver un Curso
    public function show($id)
    {
        $curso = Curso::find($id);
        if (is_null($curso)) {
            return 'El curso buscado no existe.';
        }
        return $curso;
    }

    // Crear un Curso
    public function store(Request $request)
    {
        $params = $request->all();
        $curso = Curso::create([
            'codigo' => $params['codigo'],
            'nombre' => $params['nombre'],
            'creditos' => $params['creditos']
        ]);

        return $curso;
    }

    // Eliminar Curso
    public function destroy($id)
    {
        $curso = Curso::find($id)->delete();

        if ($curso) {
            return 'Curso eliminado.';
        } else {
            return 'No se pudo eliminar.';
        }
    }

    // Actualizar Curso
    public function update($id, Request $request)
    {
        $params = $request->all();
        $curso = Curso::find($id)->update([
            'codigo' => $params['codigo'],
            'nombre' => $params['nombre'],
            'creditos' => $params['creditos']
        ]);
        return $curso ? 'El curso fue actualizado.' : 'No se pudo actualizar el curso.';
    }
}
