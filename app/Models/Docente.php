<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Docente extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'docentes';

    protected $fillable = [
        'id_usuario',
        'codigo',
        'grado',
        'facultad'
    ];

    public function usuario(){
        return $this->belongsTo(Usuario::class,'id_usuario');
    }

    public function cursoDocente(){
        return $this->hasMany(CursoDocente::class,'id_docente');
    }
}
