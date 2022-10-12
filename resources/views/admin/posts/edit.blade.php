@extends('layouts.app')

@section('content')

    <div class="container">
        <form action="{{route('admin.posts.update', ['post' => $post->id])}}" method="POST">

            @csrf
            @method('PUT')

            <div class="form-group mb-3">
                <label for="categoryId">Category:</label>

                {{-- nelle <option> uso l'id delle categorie per identificarle in modo univoco --}}
                <select id="categoryId" name="category_id" class="form-control @error('category_id') is-invalid @enderror">
                    <option {{(old('category_id')=="")?'selected':''}} value="">No category selected</option>
                    @foreach ($categories as $category)
                        {{-- usare doppio parametro con <old()> e operatore ternario per precompilare correttamente la <select> --}}
                        <option {{(old('category_id', $post->category_id)==$category->id)?'selected':''}} value="{{$category->id}}">{{$category->name}}</option>
                    @endforeach
                </select>

                @error('category_id')
                    <div class="alert alert-danger mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group mb-3">
                <label for="titleT">Title:</label>
                <input type="text" class="form-control @error('title') is-invalid @enderror" id="titleT" name="title" required max="255" value="{{old('title', $post->title)}}">

                @error('title')
                    <div class="alert alert-danger mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group mb-3">
                <label for="contentC">Content:</label>
                <textarea class="form-control @error('title') is-invalid @enderror" id="contentC" name="content" required>{{old('content', $post->content)}}</textarea>

                @error('content')
                    <div class="alert alert-danger mt-1">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Edit post</button>

        </form>

        <a href="{{route('admin.posts.index')}}" class="btn btn-primary mt-4">Back to index</a>

    </div>

@endsection