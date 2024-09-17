<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Usuario extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'usuarios';

    protected $fillable = [
        'email',
        'pass',
        'nombre',
        'apellido',
        'telefono',
        'genero',
        'huella',
        'tipo_user'
    ];

    public function alumno(){
        return $this->hasOne(Alumno::class,'id_usuario');
    }
    public function administrador(){
        return $this->hasOne(Administrador::class,'id_usuario');
    }
    public function docente(){
        return $this->hasOne(Docente::class,'id_usuario');
    }
    public function personalLimpieza(){
        return $this->hasOne(PersonalLimpieza::class,'id_usuario');
    }
}
