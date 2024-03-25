<?php

namespace App\Http\Controllers;

use App\Models\Horario;
use App\Models\HorarioPersonalLimpieza;
use App\Models\HorarioPersonalLimpiezaArea;
use App\Models\PersonalLimpieza;
use App\Models\Usuario;
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

        # Horario Limpieza
        if (isset($params['personal_limpieza']) && is_array($params['personal_limpieza'])) {
            foreach ($params['personal_limpieza'] as $key => $personalLimpieza) {
                if (isset($params['personal_limpieza']['id'])) {
                    HorarioPersonalLimpieza::create([
                        'id_personalLimpieza' => $personalLimpieza,
                        'id_horario' => $horario->id
                    ]);
                } else {
                    if (isset($params['personal_limpieza']['usuario']) && is_array($params['personal_limpieza']['usuario'])) {
                        $usuario = $params['personal_limpieza']['usuario'];

                        #Crear un nuevo usuario con los datos proporcionados
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
                        $limpiezaObj = PersonalLimpieza::create([
                            'id_usuario' => $usuarioObj->id,
                            'codigo' => $params['codigo']
                        ]);
                        $horarioLimpieza = HorarioPersonalLimpieza::create([
                            'id_horario' => $horario->id,
                            'id_personalLimpieza' => $limpiezaObj->id
                        ]);

                        HorarioPersonalLimpiezaArea::create([
                            'id_horario_personalLimpieza' => $horarioLimpieza->id,
                            'id_area' => $params['id_area']
                        ]);
                    }
                };
            };
        };
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
