@extends('layouts.app')

@section('content')

    <div class="container">

        <h1 class="fw-bold">Title: {{$post->title}}</h1>
        <h2 class="fw-bold">Slug: {{$post->slug}}</h2>
        {{-- 
            stampo la categoria usando la funzione <category()> del model <post>,
            che si utilizza come se fosse un normale attributo\proprietà di <post>.
        --}}
        <h2 class="fw-bold">Category: {{($post->category)?$post->category->name:'No category'}}</h2>
        <div>
            <h3 class="fw-bold">Content:</h3>
            <p>{{$post->content}}</p>
        </div>
        
        <a href="{{route('admin.posts.index')}}" class="btn btn-primary">Back to index</a>

    </div>

@endsection