@extends('layouts.app')

@section('content')

    <div class="container">

        <h3 class="fw-bold">Title:</h3>
        <p>{{$post->title}}</p>

        <h3 class="fw-bold">Slug:</h3>
        <p>{{$post->slug}}</p>
        
        {{-- 
            stampo la categoria usando la funzione <category()> del model <post>,
            che si utilizza come se fosse un normale attributo\proprietà di <post>.
        --}}
        <h3 class="fw-bold">Category:</h3>
        <p>{{($post->category)?$post->category->name:'No category'}}</p>

        {{--
            ciclo i tag relativi al post e stampo, di ciascuno, il nome.
            accedo ai tag del post come se fossero un attributo del post.
        --}}
        <h3 class="fw-bold">Tags:</h3>
        <p>
            @foreach ($post->tags as $tag)
                <span class="btn btn-secondary disabled">{{$tag->name}}</span>
            @endforeach
        </p>

        <div>
            <h3 class="fw-bold">Content:</h3>
            <p>{{$post->content}}</p>
        </div>
        
        <a href="{{route('admin.posts.index')}}" class="btn btn-primary">Back to index</a>

    </div>

@endsection