@extends('layouts.app')

@section('content')

    <div class="container">

        <h3 class="fw-bold">Tag name:</h3>
        <p>{{$tag->name}}</p>

        <h3 class="fw-bold">Tag slug:</h3>
        <p>{{$tag->slug}}</p>

        {{-- 
            se il tag selezionato ha dei post (cioè se ha una relazione con dei post),
            allora stampo la tabella, ciclo tutti i post con questo tag e
            per ogni post stampo le informazioni necessarie.
            (ricorda: alla relazione tra le tabelle, che è stabilita da un metodo interno ai due model,
            accedo come se fosse un attributo\proprietà: $tag->posts == "i post con questo tag").
        --}}
        @if (count($tag->posts))
            <h3>Posts with "{{$tag->name}}" tag:</h3>
            <table class="table table-striped">
                <thead>
                    <tr>
                    <th scope="col">#</th>
                    <th scope="col">Title</th>
                    <th scope="col">Slug</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($tag->posts as $post)
                        <tr>
                            <th scope="row">{{$post->id}}</th>
                            <td>{{$post->title}}</td>
                            <td>{{$post->slug}}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
        
        <a href="{{route('admin.tags.index')}}" class="btn btn-primary">Back to tag index</a>

    </div>

@endsection