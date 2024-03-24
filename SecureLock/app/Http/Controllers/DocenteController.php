<?php

namespace App\Http\Controllers;
use App\Models\Docente;
use Illuminate\Http\Request;

class DocenteController extends Controller
{
    // Listar Docentes
    public function index()
    {
        $docentes = Docente::get();
        return $docentes;
    }

    // Ver un Docente
    public function show($id)
    {
        $docente = Docente::find($id);
        if (is_null($docente)) {
            return 'El docente buscado no existe.';
        }
        return $docente;
    }

    // Crear un Docente
    public function store(Request $request)
    {
        $params = $request->all();
        $docente = Docente::create([
            'id_usuario' => $params['id_usuario'],
            'codigo' => $params['codigo'],
            'grado' => $params['grado'],
            'facultad' => $params['facultad']
        ]);

        return $docente;
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
