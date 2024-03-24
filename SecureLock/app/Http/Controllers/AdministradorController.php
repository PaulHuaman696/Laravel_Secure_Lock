<?php

namespace App\Http\Controllers;

use App\Models\Administrador;

use Illuminate\Http\Request;

class AdministradorController extends Controller
{
    // Listar Administradores
    public function index()
    {
        $administradores = Administrador::get();
        return $administradores;
    }

    // Ver un Administrador
    public function show($id)
    {
        $administrador = Administrador::find($id);
        if (is_null($administrador)) {
            return 'El administrador buscado no existe.';
        }
        return $administrador;
    }

    // Crear un Administrador
    public function store(Request $request)
    {
        $params = $request->all();
        $administrador = Administrador::create([
            'id_usuario' => $params['id_usuario'],
            'codigo' => $params['codigo'],
            'rol' => $params['rol']
        ]);

        return $administrador;
    }

    // Eliminar Administrador
    public function destroy($id)
    {
        $administrador = Administrador::find($id)->delete();

        if ($administrador) {
            return 'Administrador eliminado.';
        } else {
            return 'No se pudo eliminar.';
        }
    }

    // Actualizar Administrador
    public function update($id, Request $request)
    {
        $params = $request->all();
        $administrador = Administrador::find($id)->update([
            'id_usuario' => $params['id_usuario'],
            'codigo' => $params['codigo'],
            'rol' => $params['rol']
        ]);
        return $administrador ? 'El administrador fue actualizado.' : 'No se pudo actualizar al administrador.';
    }
}
