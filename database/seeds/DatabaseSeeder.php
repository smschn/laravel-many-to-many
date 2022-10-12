<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);

        // inserisco la lista dei seeder da eseguire con un unico comando da terminale <php artisan db:seed>.
        $this->call(CategorySeeder::class);
    }
}