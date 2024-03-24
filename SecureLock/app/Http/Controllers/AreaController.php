<?php

namespace App\Http\Controllers;

use App\Models\Area;
use Illuminate\Http\Request;

class AreaController extends Controller
{
    // Listar Áreas
    public function index()
    {
        $areas = Area::get();
        return $areas;
    }

    // Ver un Área
    public function show($id)
    {
        $area = Area::find($id);
        if (is_null($area)) {
            return 'El área buscada no existe.';
        }
        return $area;
    }

    // Crear un Área
    public function store(Request $request)
    {
        $params = $request->all();
        $area = Area::create([
            'codigo' => $params['codigo'],
            'nombre' => $params['nombre'],
            'encargado' => $params['encargado'],
            'bolsista' => $params['bolsista'],
            'referencia' => $params['referencia']
        ]);

        return $area;
    }

    // Eliminar Área
    public function destroy($id)
    {
        $area = Area::find($id)->delete();

        if ($area) {
            return 'Área eliminada.';
        } else {
            return 'No se pudo eliminar.';
        }
    }

    // Actualizar Área
    public function update($id, Request $request)
    {
        $params = $request->all();
        $area = Area::find($id)->update([
            'codigo' => $params['codigo'],
            'nombre' => $params['nombre'],
            'encargado' => $params['encargado'],
            'bolsista' => $params['bolsista'],
            'referencia' => $params['referencia']
        ]);
        return $area ? 'El área fue actualizada.' : 'No se pudo actualizar el área.';
    }
}
