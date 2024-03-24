<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CursoHorario extends Model
{
    use HasFactory;
    protected $table = 'curso_horario';

    protected $fillable = [
        'id_curso',
        'id_horario'
    ];

    public function curso(){
        return $this->belongsTo(Curso::class,'id_curso');
    }

    public function horario(){
        return $this->belongsTo(Horario::class,'id_horario');
    }
    public function alumnoAsistenciaCursoHorario(){
        return $this->hasMany(AlumnoAsistenciaCursoHorario::class,'id_curso_horario');
    }
}
