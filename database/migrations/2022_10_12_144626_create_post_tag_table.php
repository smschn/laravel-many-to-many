<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostTagTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('post_tag', function (Blueprint $table) {

            // creo la tabella pivot (tabella ponte) con la struttura seguente.

            $table->unsignedBigInteger('post_id'); // creo una colonna <post_id>.
            $table->foreign('post_id')->references('id')->on('posts'); // imposto la colonna come foreign key; imposto l'id come colonna di riferimento; indico la tabella di riferimento.

            $table->unsignedBigInteger('tag_id'); // creo una seconda colonna <tag_id>.
            $table->foreign('tag_id')->references('id')->on('tags'); // imposto la colonna come foreign key; imposto l'id come colonna di riferimento; indico la tabella di riferimento.

            $table->primary(['post_id', 'tag_id']); // imposto le due colonne create come primary keys: in questo modo posso, in phpmyadmin, selezionare intere righe.
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('post_tag');
    }
}