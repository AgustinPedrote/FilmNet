<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    use Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'sexo',
        'ciudad',
        'pais',
        'nacimiento',
        'rol_id'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    //Relación uno a muchos:

    public function criticas()
    {
        return $this->hasMany(Critica::class);
    }

    public function votaciones()
    {
        return $this->hasMany(Votacion::class);
    }

    //Relación uno a muchos (inversa):

    public function rol()
    {
        return $this->belongsTo(Rol::class);
    }

    //Relación muchos a muchos:

    //Seguidos (Follows) usuarios que son tus amigos
    public function users()
    {
        return $this->belongsToMany(User::class, 'amigos', 'user_id', 'amigo_id');
    }

    public function seguidores()
    {
        return $this->belongsToMany(User::class, 'amigos', 'amigo_id', 'user_id');
    }

    // Audiovisuales que tengo en seguimiento
    public function usuariosSeguimientos()
    {
        return $this->belongsToMany(Audiovisual::class, 'seguimientos');
    }

    // Edad del usuario logueado.
    public function getEdadAttribute()
    {
        return now()->year - $this->nacimiento;
    }
}
