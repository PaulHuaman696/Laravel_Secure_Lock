<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\Curso;
use App\Models\CursoArea;
use App\Models\CursoDocente;
use App\Models\CursoHorario;
use App\Models\Docente;
use App\Models\Horario;
use App\Models\Usuario;

use Illuminate\Http\Request;

class CursoController extends Controller
{
    /// Listar Cursos
    public function index()
    {
        $cursos = Curso::with(['cursoDocente','cursoArea','cursoHorario'])->get();
        return $cursos;
    }

    // Ver un Curso
    public function show($id)
    {
        $curso = Curso::with(['cursoDocente','cursoArea','cursoHorario'])->find($id);
        if (is_null($curso)) {
            return 'El curso buscado no existe.';
        }
        return $curso;
    }

    // Crear un Curso
    public function store(Request $request)
    {
        $params = $request->all();
        // dd($params);
        $curso = Curso::create([
            'codigo' => $params['codigo'],
            'nombre' => $params['nombre'],
            'creditos' => $params['creditos']
        ]);

        # CursoDocente
        if (isset($params['docente']) && is_array($params['docente'])) {
            foreach ($params['docente'] as $key => $docente) {
                if (isset($params['docente']['id'])) {
                    CursoDocente::create([
                        'id_docente' => $params['docente']['id'],
                        'id_curso' => $curso->id
                    ]);
                } else {
                    if (isset($docente['usuario']) && is_array($params['usuario'])) {
                        $usuario = $params['usuario'];

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
                        $docenteObj = Docente::create([
                            'id_usuario' => $usuarioObj->id,
                            'codigo' => $params['codigo'],
                            'grado' => $params['grado'],
                            'facultad' => $params['facultad']
                        ]);
                        CursoDocente::create([
                        'id_curso' => $curso->id,
                        'id_docente' => $docenteObj->id
                    ]);
                    }

                    
                };
            };
        };

        # Curso Horario
        
        $tempHorario = $params['horario'];
        if (isset($tempHorario) && is_array($tempHorario)) {
            foreach ($tempHorario as $key => $horario) {
                
                if (isset($tempHorario['id'])) {
                    CursoHorario::create([
                        'id_horario' => $horario,
                        'id_curso' => $curso->id
                    ]);
                    
                } else {
                    
                    $horarioObj = Horario::create([
                        
                        'dia' => $tempHorario['dia'],
                        'hora_inicio' => $tempHorario['hora_inicio'],
                        'hora_fin' => $tempHorario['hora_fin']
                    ]);

                    CursoHorario::create([
                        'id_curso' => $curso->id,
                        'id_horario' => $horarioObj->id
                    ]);
                };
            };
        };

        #curso Area
        if (isset($params['area']) && is_array($params['area'])) {
            foreach ($params['area'] as $key => $area) {
                if (isset($params['area']['id'])) {
                    CursoArea::create([
                        'id_area' => $area,
                        'id_curso' => $curso->id
                    ]);
                } else {
                    $areaObj = Area::create([
                        'codigo' => $params['area']['codigo'],
                        'nombre' => $params['area']['nombre_area'],
                        'encargado' => $params['area']['encargado'],
                        'bolsista'=> $params['area']['bolsista'], 
                        'referencia' => $params['area']['referencia']
                    ]);

                    CursoArea::create([
                        'id_curso' => $curso->id,
                        'id_area' => $areaObj->id
                    ]);
                };
            };
        };

        

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
