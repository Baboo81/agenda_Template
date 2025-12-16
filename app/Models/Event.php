<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    //Permet de créer des factories pour générer des évènements factices pour les tests
    use HasFactory;

    //Pour protéger contre les assignations de masse
    protected $fillable = [
        'title',
        'description',
        'start_time',
        'end_time',
    ];

    //Pour caster start_time et end_time en DateTime :
    protected $casts = [
        'start_time' => 'datetime',
        'end_time' => 'datetime',
    ];
}
