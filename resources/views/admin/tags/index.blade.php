@extends('layouts.app')

@section('content')

    <div class="container">
        <table class="table table-striped">
            <thead>
                <tr>
                  <th scope="col">Tag ID #</th>
                  <th scope="col">Tag name</th>
                  <th scope="col">Tag slug</th>
                  <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
            @foreach ($tags as $tag)
                <tr>
                    <th scope="row">{{$tag->id}}</th>
                    <td>{{$tag->name}}</td>
                    <td>{{$tag->slug}}</td>
                    <td>
                        <a href="{{route('admin.tags.show', ['tag' => $tag->id])}}" class="btn btn-primary">Show</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

@endsection