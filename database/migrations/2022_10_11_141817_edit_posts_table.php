<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class EditPostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('posts', function (Blueprint $table) {
            
            // passaggi per creare la colonna per la foreign key nella tabella <posts>.

            $table->unsignedBigInteger('category_id')->nullable()->after('slug'); // creo la colonna per la foreign key con nome <category_id>; può essere <NULL>; viene creata dopo la colonna <slug>.

            $table->foreign('category_id') // indico che la colonna <category_id> è una foreign key.
                ->references('id') // indico che contiene come valore l'id (della categoria preso dalla tabella <categories>).
                ->on('categories') // indico che la relazione sussiste con la tabella <categories>.
                ->onDelete('set null'); // indico che, alla cancellazione di una categoria nella tabella <categories>, il campo <category_id> nella tabella <posts> diventa <NULL>.
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('posts', function (Blueprint $table) {
            
            // aggiorno la funzione down() affinché l'eventuale rollback di questa migration cancelli quanto creato con la funzione up().

            $table->dropForeign('posts_category_id_foreign'); // cancello il legame (sintassi: <tabellaDipendente_colonna_foreign>).
            $table->dropColumn('category_id'); // cancello la colonna.
        });
    }
}