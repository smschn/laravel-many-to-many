<?php

use Illuminate\Database\Seeder;

// importo le classi <category> e <str> per poterle usare.
use App\Category;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // in un array inserisco la lista delle categorie.
        $categories = ['News', 'Backend', 'Frontend', 'Tutorial', 'Gestione Sistemistica', 'Sicurezza Informatica'];

        // tramite un ciclo: inizializzio un nuovo oggetto <category>, assegno valori ai campi, lo salvo.
        foreach ($categories as $category) {
            $newCategory = new Category();
            $newCategory->name = $category;
            $newCategory->slug = Str::slug($category);
            $newCategory->save();
        }
    }
}