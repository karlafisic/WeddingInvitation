<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rsvp extends Model
{
    use HasFactory;

    // Polja koja se mogu masovno upisivati
    protected $fillable = [
        'ime',
        'prezime',
        'dolazi',
        'broj_dodatnih',
        'dodatni_uzvanici',
    ];

    // Laravel će automatski konvertirati dodatni_uzvanici JSON u array i obrnuto
    protected $casts = [
        'dolazi' => 'boolean',
        'dodatni_uzvanici' => 'array',
    ];
}
