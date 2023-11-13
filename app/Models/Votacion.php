<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Votacion extends Model
{
    use HasFactory;
    protected $table = 'votaciones';
    protected $fillable = [
        'user_id',
        'audiovisual_id',
        'voto',
    ];

    protected $primaryKey = ['user_id', 'audiovisual_id']; // Clave primaria compuesta

    public $incrementing = false; // Indicar que no es una clave primaria autoincremental

    //Relación uno a muchos (inversa):

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function audiovisual()
    {
        return $this->belongsTo(Audiovisual::class);
    }
}
