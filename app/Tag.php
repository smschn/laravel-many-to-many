<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    // aggiungo la relazione MANY TO MANY con la tabella (e quindi il model) <posts>.
    // la funzione ha il nome della tabella con cui sussiste la relazione.
    public function posts() {
        return $this->belongstoMany('App\Post'); // ritorno il model della tabella con cui c'è la relazione.
        // 'leggendo il codice' è come dire: ad un tag appartengono più post.
    }
}