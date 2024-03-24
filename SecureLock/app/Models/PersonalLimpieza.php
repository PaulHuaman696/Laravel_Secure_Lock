<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PersonalLimpieza extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'personales_limpieza';

    protected $fillable = [
        'id_usuario',
        'codigo'
    ];

    public function usuario(){
        return $this->belongsTo(Usuario::class,'id_usuario');
    }
    public function horarioPersonalLimpieza(){
        return $this->hasMany(HorarioPersonalLimpieza::class,'id_personalLimpieza');
    }
}
