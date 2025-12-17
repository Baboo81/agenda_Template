<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    //Les champs que l'on pourra remplir via create() ou update()
    protected $fillable = [
        'user_id',
        'email',
        'date',
        'hour',
        'status'
    ];
}
