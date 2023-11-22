<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Premio extends Model
{
    use HasFactory;

    protected $table = 'premios';

    protected $fillable = [
        'nombre',
        'year',
        'audiovisual_id'
    ];

    //Relación uno a muchos (inversa):

    public function audiovisual()
    {
        return $this->belongsTo(Audiovisual::class);
    }
}
