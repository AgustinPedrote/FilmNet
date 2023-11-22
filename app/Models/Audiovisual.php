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
        'trailer',
        'tipo_id',
        'recomendaciones'
    ];

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

    public function audiovisualSeguimientos()
    {
        return $this->belongsToMany(User::class, 'seguimientos');
    }

    //Relación uno a muchos (inversa):

    public function tipo()
    {
        return $this->belongsTo(Tipo::class);
    }

    public function recomendacion()
    {
        return $this->belongsTo(Recomendacion::class);
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

    // Consultar la tabla de votaciones para obtener la votación del usuario para el audiovisual específico
    public function obtenerVotacion($user_id, $audiovisual_id)
    {
        $votacion = Votacion::where('user_id', $user_id)
            ->where('audiovisual_id', $audiovisual_id)
            ->first();

        // Devolver el resultado de la consulta (puede ser un objeto Votacion o null si no se encuentra ninguna votación)
        return $votacion;
    }

    // Calcula la nota media
    public function obtenerNotaMedia()
    {
        $votaciones = $this->votaciones;

        $notaMedia = $votaciones->avg('voto');

        return $notaMedia;
    }

    // Número de votos realizados al audiovisual
    public function obtenerNumeroVotos()
    {
        return $this->votaciones->count();
    }

    // Obtiene el tipo de audiovisual.
    public function obtenerTipo()
    {
        if ($this->tipo->nombre == 'Película' || $this->tipo->nombre == 'Serie') {
            return "Vota esta " . $this->tipo->nombre;
        } else {
            return "Vota este " . $this->tipo->nombre;
        }
    }

    // Recomendación de edad
    public function getDescripcionEdad(): string
    {
        switch ($this->recomendacion_id) {
            case 1:
                return 'Todos los públicos';
            case 2:
                return 'Mayores de 13 años';
            case 3:
                return 'Mayores de 18 años';
            default:
                return 'Sin clasificación';
        }
    }
}
