<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    // aggiungo la relazione MANY TO MANY con la tabella (e quindi il model) <posts>.
    public function posts() {
        return $this->belongstoMany('App\Post'); // ritorno il model della tabella con cui c'è la relazione.
    }
}