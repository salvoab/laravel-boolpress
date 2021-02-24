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
        $this->call([
                CategorySeeder::class, //Metto prima le categorie perché gli articoli hanno category_id come chiave esterna
                ArticleSeeder::class,
                TagSeeder::class
            ]);
    }
}
