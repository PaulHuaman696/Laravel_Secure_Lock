<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Administrador extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'administradores';

    protected $fillable = [
        'id_usuario',
        'codigo',
        'rol'
    ];

    public function usuario(){
        return $this->belongsTo(Usuario::class,'id_usuario');
    }
}
