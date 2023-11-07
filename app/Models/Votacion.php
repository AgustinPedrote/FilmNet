<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Votacion extends Model
{
    use HasFactory;

    //Relación uno a muchos (inversa):

    public function users()
    {
        return $this->belongsTo(User::class);
    }

    public function audiovisuales()
    {
        return $this->belongsTo(Audiovisual::class);
    }
}
