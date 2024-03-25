<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AlumnoAsistenciaCursoHorario extends Model
{
    use HasFactory;

    protected $table = 'alumno_asistencia_curso_horario';
    public $timestamps = false;
    protected $fillable = [
        'id_alumno_asistencia',
        'id_curso_horario'
    ];

    public function alumnoAsistencias(){
        return $this->belongsTo(AlumnoAsistencia::class,'id_alumno_asistencia');
    }

    public function cursoHorarios(){
        return $this->belongsTo(CursoHorario::class,'id_curso_horario');
    }
}
