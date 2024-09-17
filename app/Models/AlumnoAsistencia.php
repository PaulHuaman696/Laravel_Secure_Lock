<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AlumnoAsistencia extends Model
{
    use HasFactory;

    protected $table = 'alumno_asistencia';
    public $timestamps = false;
    protected $fillable = [
        'id_alumno',
        'id_asistencia'
    ];

    public function alumno(){
        return $this->belongsTo(Alumno::class,'id_alumno');
    }

    public function asistencia(){
        return $this->belongsTo(Asistencia::class,'id_asistencia');
    }
    public function alumnoAsistenciaCursoHorario(){
        return $this->hasOne(AlumnoAsistenciaCursoHorario::class,'id_alumno_asistencia');
    }
    
}
