<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Matricula extends Model
{
    use HasFactory;
    protected $table = 'matriculas';
    public $timestamps = false;
    protected $fillable = [
        'id_curso',
        'id_alumno'
    ];

    public function alumno(){
        return $this->belongsTo(Alumno::class,'id_alumno');
    }

    public function curso(){
        return $this->belongsTo(Curso::class,'id_curso');
    }
}
