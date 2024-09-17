<?php

namespace App\Http\Controllers;

use App\Models\Administrador;
use App\Models\Usuario;

use Illuminate\Http\Request;

class AdministradorController extends Controller
{
    // Listar Administradores
    public function index()
    {
        $administradores = Administrador::with('usuario')->get();
        return $administradores;
    }

    // Ver un Administrador
    public function show($id)
    {
        $administrador = Administrador::with('usuario')->find($id);
        if (is_null($administrador)) {
            return 'El administrador buscado no existe.';
        }
        return $administrador;
    }

    // Crear un Administrador
    public function store(Request $request)
    {
        $params = $request->all();
        // Verificar si se proporcionaron datos de usuario
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

            // Crear el registro de administrador asociado al usuario
            $administrador = Administrador::create([
                'id_usuario' => $usuarioObj->id,
                'codigo' => $params['codigo'],
                'rol' => $params['rol']
            ]);


            #Acceder a atributos de variables
            /* (object) $variableA = [
            'atributoA' => 1
        ];
        $variableA['atributoA']; // Acceder en un arreglo
        $variableA->atributoA; // Acceder en un objeto
        */


            return $administrador;
        }
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
