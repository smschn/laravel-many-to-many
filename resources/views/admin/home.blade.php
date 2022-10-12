@extends('layouts.app')

@section('content')

    <div class="container">
        <h1>Benvenuto nell'area amministrativa {{$user->name}} - {{$user->email}}</h1> {{-- in alternativa posso scrivere, senza passare variabili dal controller: {{Auth::user()->name}} --}}
    </div>

@endsection