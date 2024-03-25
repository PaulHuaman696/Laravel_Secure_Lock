<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CursoDocente extends Model
{
    use HasFactory;
    protected $table = 'curso_docente';
    public $timestamps = false;
    protected $fillable = [
        'id_curso',
        'id_docente'
    ];

    public function curso(){
        return $this->belongsTo(Curso::class,'id_curso');
    }

    public function docente(){
        return $this->belongsTo(Docente::class,'id_docente');
    }
}
