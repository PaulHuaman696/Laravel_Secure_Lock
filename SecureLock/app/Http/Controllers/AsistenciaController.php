<?php

namespace App\Http\Controllers;

use App\Models\Alumno;
use App\Models\AlumnoAsistencia;
use App\Models\AlumnoAsistenciaCursoHorario;
use App\Models\Asistencia;
use App\Models\CursoHorario;
use App\Models\Usuario;
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

        # Alumno Asistencia
        if (isset($params['alumno']) && is_array($params['alumno'])) {
            foreach ($params['alumno'] as $key => $alumno) {
                if (isset($params['alumno']['id'])) {
                    AlumnoAsistencia::create([
                        'id_alumno' => $alumno,
                        'id_asistencia' => $asistencia->id
                    ]);
                } else {
                    if (isset($params['alumno']['usuario']) && is_array($params['alumno']['usuario'])) {
                        $usuario = $params['alumno']['usuario'];

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
                        $alumnoObj = Alumno::create([
                            'id_usuario' => $usuarioObj->id,
                            'codigo' => $params['codigo'],
                            'especialidad' => $params['especialidad'],
                            'facultad' => $params['facultad'],
                            'creditos' => $params['creditos']
                        ]);
                        AlumnoAsistencia::create([
                            'id_asistencia' => $asistencia->id,
                            'id_alumno' => $alumnoObj->id
                        ]);
                    }
                };
            };
        };

        #alumno asistencia curso horario
        if (isset($params['asistenciaCurso']) && is_array($params['asistenciaCurso'])) {
            $alumnoAsistencia = AlumnoAsistencia::find($params['id_alumno_asistencia']);
            $cursoHorario = CursoHorario::find($params['id_curso_horario']);
            if (is_null($alumnoAsistencia)) {
                return "El alumno asistencia no existe.";
            } else {
                if (!is_null($cursoHorario)) {

                    AlumnoAsistenciaCursoHorario::create([
                        'id_alumno_asistencia' => $params['id_alumno_asistencia'],
                        'id_curso_horario' => $params['id_curso_horario'],
                    ]);
                } else {
                    return "El curso horario no existe.";
                }
            };
        };

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
