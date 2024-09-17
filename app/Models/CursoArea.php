<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CursoArea extends Model
{
    use HasFactory;
    protected $table = 'curso_area';
    public $timestamps = false;
    protected $fillable = [
        'id_curso',
        'id_area'
    ];

    public function curso(){
        return $this->belongsTo(Curso::class,'id_curso');
    }

    public function area(){
        return $this->belongsTo(Area::class,'id_area');
    }
}
