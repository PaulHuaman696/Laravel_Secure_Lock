<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    use HasFactory;

    protected $table = 'areas';

    protected $fillable = [
        'codigo',
        'nombre',
        'encargado',
        'bolsista',
        'referencia'
    ];

    public function cursoArea(){
        return $this->hasMany(CursoArea::class,'id_area');
    }

    public function horarioPersonalLimpiezaArea(){
        return $this->belongsTo(HorarioPersonalLimpiezaArea::class,'id_area');
    }

}
