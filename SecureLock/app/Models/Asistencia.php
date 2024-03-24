<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asistencia extends Model
{
    use HasFactory;
    protected $table = 'asistencias';

    protected $fillable = [
        'fecha',
        'hora',
        'estado'
    ];

    public function alumnoAsistencia(){
        return $this->hasMany(AlumnoAsistencia::class,'id_asistencia');
    }

}
