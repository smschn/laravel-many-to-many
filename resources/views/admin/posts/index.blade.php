@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="d-flex justify-content-end mb-4">
            <a class="btn btn-primary" href="{{route('admin.posts.create')}}">Add new post</a>
        </div>
        <table class="table table-striped">
            <thead>
                <tr>
                  <th scope="col">ID #</th>
                  <th scope="col">Title</th>
                  <th scope="col">Slug</th>
                  <th scope="col">Category</th>
                  <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
            @foreach ($posts as $post)
                <tr>
                    <th scope="row">{{$post->id}}</th>
                    <td>{{$post->title}}</td>
                    <td>{{$post->slug}}</td>
                    {{--
                        accedo alla funzione <category> del model <post> come se fosse un attributo\proprietà:
                        laravel, in automatico, parte dall'id della foreign key,
                        va alla tabella <categories> alla relativa riga e restituisce il valore richiesto (->name).
                    --}}
                    <td>{{($post->category)?$post->category->name:'No category'}}</td>
                    <td class="d-flex">
                        <a href="{{route('admin.posts.show', ['post' => $post->id])}}" class="btn btn-primary mx-1">View</a>
                        <a href="{{route('admin.posts.edit', ['post' => $post->id])}}" class="btn btn-warning mx-1">Edit</a>
                        <form action="{{route('admin.posts.destroy', ['post' => $post->id])}}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger mx-1">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

@endsection