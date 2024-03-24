<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Horario extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'horarios';

    protected $fillable = [
        'dia',
        'hora_inicio',
        'hora_fin'
    ];

    public function cursoHorario(){
        return $this->hasMany(CursoHorario::class,'id_horario');
    }

    public function horarioPersonalLimpieza(){
        return $this->hasMany(HorarioPersonalLimpieza::class,'id_horario');
    }
}
