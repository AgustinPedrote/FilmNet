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

    // Clave primaria compuesta
    protected $primaryKey = ['user_id', 'audiovisual_id'];

    // Indicar que no es una clave primaria autoincremental
    public $incrementing = false;

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
