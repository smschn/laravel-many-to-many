<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    // aggiungo la relazione one (categories) to many (posts).
    // la funzione ha il nome della tabella con cui sussiste la relazione, al plurale (per ogni categoria ho più post).
    public function posts() {
        return $this->hasMany('App\Post'); // ritorno il model della tabella con cui c'è la relazione.
    }
}