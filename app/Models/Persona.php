<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Persona extends Model
{
    use HasFactory;

    protected $table = 'personas';

    protected $fillable = [
        'nombre'
    ];

    //Relación muchos a muchos:

    public function repartos()
    {
        return $this->belongsToMany(Audiovisual::class, 'repartos');
    }

    public function compositores()
    {
        return $this->belongsToMany(Audiovisual::class, 'compositores');
    }

    public function directores()
    {
        return $this->belongsToMany(Audiovisual::class, 'directores');
    }

    public function fotografias()
    {
        return $this->belongsToMany(Audiovisual::class, 'fotografias');
    }

    public function guionistas()
    {
        return $this->belongsToMany(Audiovisual::class, 'guionistas');
    }
}
