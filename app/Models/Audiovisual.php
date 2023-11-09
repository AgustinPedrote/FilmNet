<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Audiovisual extends Model
{
    use HasFactory;

    protected $table = 'audiovisuales';

    protected $fillable = [
        'titulo',
        'titulo_original',
        'year',
        'duracion',
        'pais',
        'sinopsis',
        'img',
        'tipo_id'];

    //Relación muchos a muchos:

    public function repartos()
    {
        return $this->belongsToMany(Persona::class, 'repartos');
    }

    public function compositores()
    {
        return $this->belongsToMany(Persona::class, 'compositores');
    }

    public function directores()
    {
        return $this->belongsToMany(Persona::class, 'directores');
    }

    public function fotografias()
    {
        return $this->belongsToMany(Persona::class, 'fotografias');
    }

    public function guionistas()
    {
        return $this->belongsToMany(Persona::class, 'guionistas');
    }

    public function generos()
    {
        return $this->belongsToMany(Genero::class, 'audiovisual_genero');
    }

    public function companies()
    {
        return $this->belongsToMany(Company::class);
    }

    //Relación uno a muchos (inversa):

    public function tipo()
    {
        return $this->belongsTo(Tipo::class);
    }

    //Relación uno a muchos:

    public function premios()
    {
        return $this->hasMany(Premio::class);
    }

    public function criticas()
    {
        return $this->hasMany(Critica::class);
    }

    public function votaciones()
    {
        return $this->hasMany(Votacion::class);
    }

    public function pendientes()
    {
        return $this->hasMany(Pendiente::class);
    }
}
