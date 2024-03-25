<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HorarioPersonalLimpiezaArea extends Model
{
    use HasFactory;
    protected $table = 'hora_personal_limpieza_area';
    public $timestamps = false;
    protected $fillable = [
        'id_horario_personalLimpieza',
        'id_area'
    ];

    public function area(){
        return $this->belongsTo(Area::class,'id_area');
    }

    public function horarioPersonalLimpieza(){
        return $this->belongsTo(HorarioPersonalLimpieza::class,'id_horario_personalLimpieza');
    }
}
