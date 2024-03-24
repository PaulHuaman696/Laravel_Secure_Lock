<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Alumno extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'alumnos';

    protected $fillable = [
        'id_usuario',
        'codigo',
        'facultad',
        'especialidad',
        'ciclo'
    ];

    public function usuario(){
        return $this->belongsTo(Usuario::class,'id_usuario');
    }
    public function matricula(){
        return $this->hasMany(Matricula::class,'id_alumno');
    }
    public function alumnoAsistencia(){
        return $this->hasMany(AlumnoAsistencia::class,'id_usuario');
    }
}
