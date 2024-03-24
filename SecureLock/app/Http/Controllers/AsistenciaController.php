<?php

namespace App\Http\Controllers;
use App\Models\Asistencia;
use Illuminate\Http\Request;

class AsistenciaController extends Controller
{
    // Listar Asistencias
    public function index()
    {
        $asistencias = Asistencia::get();
        return $asistencias;
    }

    // Ver una Asistencia
    public function show($id)
    {
        $asistencia = Asistencia::find($id);
        if (is_null($asistencia)) {
            return 'La asistencia buscada no existe.';
        }
        return $asistencia;
    }

    // Crear una Asistencia
    public function store(Request $request)
    {
        $params = $request->all();
        $asistencia = Asistencia::create([
            'fecha' => $params['fecha'],
            'hora' => $params['hora'],
            'estado' => $params['estado']
        ]);

        return $asistencia;
    }

    // Eliminar Asistencia
    public function destroy($id)
    {
        $asistencia = Asistencia::find($id)->delete();

        if ($asistencia) {
            return 'Asistencia eliminada.';
        } else {
            return 'No se pudo eliminar.';
        }
    }

    // Actualizar Asistencia
    public function update($id, Request $request)
    {
        $params = $request->all();
        $asistencia = Asistencia::find($id)->update([
            'fecha' => $params['fecha'],
            'hora' => $params['hora'],
            'estado' => $params['estado']
        ]);
        return $asistencia ? 'La asistencia fue actualizada.' : 'No se pudo actualizar la asistencia.';
    }
}
