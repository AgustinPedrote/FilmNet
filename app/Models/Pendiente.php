<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pendiente extends Model
{
    use HasFactory;

    protected $table = 'pendientes';

    protected $fillable = [
        'audiovisual_id',
        'user_id'];

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
