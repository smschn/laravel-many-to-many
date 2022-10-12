<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Post; // importo il model <post> per poterlo usare in questo file.
use App\Category; // importo il model <category> per poterlo usare in questo file.
use App\Tag; // importo il model <tag> per poter usare i metodi statici in questo file.
use Illuminate\Support\Str; // importo questa classe per poterla usare nella creazione dello <slug>.

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // ritorno tutti i post nella pagina amministrativa nella view index degli admin (di ha effettuato l'accesso)
        $posts = Post::all();
        return view('admin.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all(); // recupero tutte le categorie (ricorda: importa il model) e le passo alla view <create>.
        $tags = Tag::all(); // recupero tutti i tag (ricorda: importa il model) e li passo alla view <create>.
        return view('admin.posts.create', compact('categories', 'tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'title' => 'required|max:255|min:5',
                'content' => 'required|max:65535|min:5',
                // aggiungo validazione della nuova colonna (foreign key).
                // può non essere selezionata (nullable).
                // exists = l'<id> di <category_id> deve esistere nella tabella <categories>, nella colonna <id>.
                'category_id' => 'nullable|exists:categories,id',
                // aggiungo validazione dell'array tags[] (se esistente) proveniente dalla checkbox della view create:
                // ogni <id> contenuto nell'array deve esistere nella tabella <tags>, alla colonna <id>.
                'tags' => 'exists:tags,id' 
            ]
        );
        $data = $request->all();
        $newPost = new Post();
        $newPost->fill($data); // ricorda: aggiungi nella $fillable del model <post> la colonna <category_id> affinché fill() funzioni correttamente.
        $newSlug = $this->createSlug($newPost->title); // ricorda: usare $this-> dentro le classi; creo un nuovo slug richiamando la funzione.
        $newPost->slug = $newSlug; // assegno il nuovo slug al nuovo post.
        $newPost->save();
        // gestire il caso in cui NON venga selezionata alcuna checkbox (non esisterebbe la chiave <tags> nell'array $data):
        // uso un <if> + <array_key_exists> per verificare che nell'array $data ci sia la chiave <tags>: se c'è, eseguo il codice interno:
        // con ->tags() indico l'altra tabella con cui sussiste la relazione many to many (richiamando la funzione tags() interna al model <post>).
        // con ->sync() aggiungo alla tabella pivot i tag associati al post tramite (sync accetta come parametro un array di id).
        // così facendo si crea la relazione dentro la tabella pivot.
        if (array_key_exists('tags', $data)) {
            $newPost->tags()->sync($data['tags']);
        }
        return redirect()->route('admin.posts.index')->with('status', 'Post created!'); // aggiunto messaggio di avvenuta creazione.
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post) // utilizzo la dependency injection (Post $post) invece di: <public function show($id)> + metodo <::find()>.
    {
        return view('admin.posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post) // utilizzo la dependency injection.
    {
        $categories = Category::all(); // recupero tutte le categorie dal db e le passo alla view <edit> assieme al <post>.
        return view('admin.posts.edit', compact('post', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post) // utilizzo la dependency injection.
    {
        $request->validate(
            [
                'title' => 'required|max:255|min:5',
                'content' => 'required|max:65535|min:5',
                'category_id' => 'nullable|exists:categories,id' // aggiungo validazione della nuova colonna (foreign key).
            ]
        );
        $data = $request->all();
        
        // se il titolo è stato modificato, devo creare un nuovo slug relativo al nuovo titolo.
        if ($post->title !== $data['title']) {
            $data['slug'] = $this->createSlug($data['title']); // assegno il nuovo slug creato a $data, aggiungedone all'array associativo la chiave 'slug' con il relativo valore appena creato.
        }
        $post->update($data); // usando l'update() non c'è bisogno di usare anche il metodo ->save() perché viene fatto in automatico.
        return redirect()->route('admin.posts.index')->with('status', 'Post updated!'); // aggiunto messaggio di avvenuta modifica.
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post) // utilizzo la dependency injection.
    {
        $post->delete();
        return redirect()->route('admin.posts.index')->with('status', 'Post deleted!'); // aggiunto messaggio di avvenuta cancellazione.
    }

    // creo una funzione per calcolare lo slug, al fine di non ripetere il codice sia nella store() sia nella update().
    protected function createSlug($titleP) {
        // per evitare problemi di nomenclatura con lo slug (che deve essere UNIQUE - vedere migration), serve implementare quanto scritto sotto.
        $newSlug = Str::slug($titleP, '-'); // creo lo slug partendo dal titolo; importo la classe <Str> per usarla.
        $checkPosts = Post::where('slug', $newSlug)->first(); // cerco nella tabella <posts> nel database se lo slug appena creato esiste e lo assegno (se non esiste, la variabile è NULL).
        $counter = 1; // imposto un contatore
        while ($checkPosts) { // se lo slug esiste già, entro nel ciclo per crearne uno nuovo; altrimenti passo direttamente alla return.
            $newSlug = Str::slug($titleP . '-' . $counter, '-'); // creo dinamicamente un nuovo slug aggiungendo il contatore alla fine.
            $counter++; // incremento il contatore.
            // per uscire dal ciclo, cerco nella tabella <posts> nel database se esiste già uno slug con il nome appena creato:
            // se esiste, torno nel ciclo (creando un nuovo slug), altrimenti esco dal ciclo (perché il nuovo slug dinamico non viene trovato nel database).
            $checkPosts = Post::where('slug', $newSlug)->first();
        }
        return $newSlug;
    }
}