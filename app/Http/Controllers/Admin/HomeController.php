<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // importo Auth solo per far sparire l'errore in vscode: in teoria viene importato automaticamente in tutti i file all'avvio di un nuovo progetto laravel

class HomeController extends Controller
{
    public function index() {
    // recupero l'utente loggato (cioè che possiede l'auth).
    $user = Auth::user(); // in alternativa, senza passare variabili alla view, posso scrivere direttamente nella view '\admin\home.blade.php': <{{Auth::user()->name}}> per recuperare il nome dell'utente.
    return view('admin.home', ['user' => $user]);
    }
}