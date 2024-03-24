<?php

namespace App\Http\Controllers;

use App\Models\Horario;
use Illuminate\Http\Request;

class HorarioController extends Controller
{
    // Listar Horarios
    public function index()
    {
        $horarios = Horario::get();
        return $horarios;
    }

    // Ver un Horario
    public function show($id)
    {
        $horario = Horario::find($id);
        if (is_null($horario)) {
            return 'El horario buscado no existe.';
        }
        return $horario;
    }

    // Crear un Horario
    public function store(Request $request)
    {
        $params = $request->all();
        $horario = Horario::create([
            'dia' => $params['dia'],
            'hora_inicio' => $params['hora_inicio'],
            'hora_fin' => $params['hora_fin']
        ]);

        return $horario;
    }

    // Eliminar Horario
    public function destroy($id)
    {
        $horario = Horario::find($id)->delete();

        if ($horario) {
            return 'Horario eliminado.';
        } else {
            return 'No se pudo eliminar.';
        }
    }

    // Actualizar Horario
    public function update($id, Request $request)
    {
        $params = $request->all();
        $horario = Horario::find($id)->update([
            'dia' => $params['dia'],
            'hora_inicio' => $params['hora_inicio'],
            'hora_fin' => $params['hora_fin']
        ]);
        return $horario ? 'El horario fue actualizado.' : 'No se pudo actualizar el horario.';
    }
}
