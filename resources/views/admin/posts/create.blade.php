@extends('layouts.app')

@section('content')

    <div class="container">
        <form action="{{route('admin.posts.store')}}" method="POST">

            @csrf {{-- aggiunge un token all'invio del form --}}

            <div class="form-group mb-3">
                <label for="categoryId">Category:</label>

                {{-- nelle <option> uso l'id delle categorie per identificarle in modo univoco --}}
                <select id="categoryId" name="category_id" class="form-control @error('category_id') is-invalid @enderror">
                    <option {{(old('category_id')=="")?'selected':''}} value="">No category selected</option>
                    @foreach ($categories as $category)
                        <option {{(old('category_id')==$category->id)?'selected':''}} value="{{$category->id}}">{{$category->name}}</option> {{-- value è il valore passato relativo al campo <category_id> --}}
                    @endforeach
                </select>

                @error('category_id')
                    <div class="alert alert-danger mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group mb-3">
                <label for="titleT">Title:</label>
                <input type="text" class="form-control @error('title') is-invalid @enderror" id="titleT" name="title" required max="255" value="{{old('title')}}"> {{-- aggiungo required e max come 'validazioni' semplici: cambiando html da browser possono essere tolti (= metodo insicuro) --}}
                
                @error('title')
                    <div class="alert alert-danger mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group mb-3">
                <label for="contentC">Content:</label>
                <textarea class="form-control @error('content') is-invalid @enderror" id="contentC" name="content" required>{{old('content')}}</textarea>
                
                @error('content')
                    <div class="alert alert-danger mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="card p-3">
                {{-- ciclo i tag, creando una checkbox ciascuno --}}
                @foreach ($tags as $tag)
                    <div class="form-group form-check">
                        {{-- 
                            <id> e <for> uguali affinché, cliccando sulla label, venga portato il focus sul relativo input + univoci per ciascun tag (grazie all'id del tag).
                            <value> univoco.
                            <name> invia al backend (alla store()) un array contenente i <value> dei checkbox selezionati, ma NON invia l'array se non viene selezionato alcun checkbox.
                            per preselezionare le checkbox al ricaricamento della view create a seguito di validazione fallita, si deve usare l'attributo html <checked> e la funzione php <in_array()>:
                            <in_array()> cerca un valore dentro un array ed accetta due parametri: il secondo è l'array in cui cercare, il primo è il valore da cercare in dato array:
                            come secondo parametro inserisco la funzione old() che recupera l'array precedentemente creato dall'attributo <name>, come primo parametro l'id del tag ciclato:
                            qualora non fosse stato selezionato alcun checkbox, l'array NON esisterebbe e quindi non avrei un secondo parametro dentro <in_array()>:
                            essendo il secondo parametro di <in_array()> obbligatorio, deve sempre esserci un array in cui cercare per cui come secondo parametro della old() inserisco un array vuoto:
                            in questo modo se non ci fosse un array <tags>, la old() restituisce come valore di default un array vuoto: in tal modo ho sempre un array come secondo parametro della <in_array()>.
                        --}}
                        <input class="form-check-input" type="checkbox" id="tag_{{$tag->id}}" value="{{$tag->id}}" name="tags[]" {{(in_array($tag->id, old('tags', [])))?'checked':''}}>
                        <label class="form-check-label" for="tag_{{$tag->id}}">{{$tag->name}}</label>
                    </div>
                @endforeach

                @error('tags')
                    <div class="alert alert-danger mt-1">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary mt-3">Create post</button>

        </form>

        <a href="{{route('admin.posts.index')}}" class="btn btn-primary mt-3">Back to index</a>

    </div>

@endsection