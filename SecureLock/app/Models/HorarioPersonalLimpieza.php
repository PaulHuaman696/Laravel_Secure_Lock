<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HorarioPersonalLimpieza extends Model
{
    use HasFactory;
    protected $table = 'horario_personal_limpieza';
    public $timestamps = false;
    protected $fillable = [
        'id_horario',
        'id_personalLimpieza'
    ];

    public function horario(){
        return $this->belonsTo(Horario::class,'id_horario');
    }

    public function personalLimpieza(){
        return $this->belongsTo(PersonalLimpieza::class,'id_personalLimpieza');
    }

    public function horarioPersonalLimpiezaArea(){
        return $this->hasMany(HorarioPersonalLimpiezaArea::class,'id_horario_personalLimpieza');
    }
}
