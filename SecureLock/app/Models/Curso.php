<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Curso extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'cursos';

    protected $fillable = [
        'codigo',
        'nombre',
        'creditos'
    ];

    public function matricula(){
        return $this->hasMany(Matricula::class,'id_curso');
    }

    public function cursoDocente(){
        return $this->hasMany(CursoDocente::class,'id_curso');
    }
    public function cursoArea(){
        return $this->hasMany(CursoArea::class,'id_curso');
    }
    public function cursoHorario(){
        return $this->hasMany(CursoHorario::class,'id_curso');
    }
}
