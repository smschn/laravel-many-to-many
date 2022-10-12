<?php

use Illuminate\Database\Seeder;

use App\Tag; // importo il model per poterlo usare nel seeder creando un nuovo oggetto di tipo <tag>.
use Illuminate\Support\Str; // importo la classe <str> per poter usare il metodo statico ::slug nella creazione dello slug.

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // definisco una lista di tags da creare.
        $tags = ['HTML', 'Css', 'JS', 'VueJS', 'Php', 'MySql', 'Laravel'];

        // ciclo i tag, ad ogni ciclo creo un nuovo oggetto tag e assegno valore al <name> e allo <slug>.
        // infine salvo il tag nella tabella del db.
        foreach ($tags as $tag) {
            $newTag = new Tag();
            $newTag->name = $tag;
            $newTag->slug = Str::slug($tag);
            $newTag->save();
        }
    }
}