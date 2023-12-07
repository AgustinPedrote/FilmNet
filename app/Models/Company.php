<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    protected $table = 'companies';

    protected $fillable = [
        'nombre'
    ];

    // Relación muchos a muchos:

    public function audiovisuales()
    {
        return $this->belongsToMany(Audiovisual::class);
    }
}
