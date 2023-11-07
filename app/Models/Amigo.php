<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Amigo extends Model
{
    use HasFactory;

    protected $table = 'amigos';

    protected $fillable = [
        'user_id',
        'amigo_id'];

    //Relación muchos a muchos:

    /* public function users()
    {
        return $this->belongsToMany(User::class, 'amigos', 'amigo_id', 'user_id');
    } */

    /* public function amigos()
    {
        return $this->belongsToMany(User::class, 'amigos', 'user_id', 'amigo_id');
    } */
}
