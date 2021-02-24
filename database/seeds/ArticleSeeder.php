<?php

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use App\Article;

class ArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        for ($i=0; $i < 20; $i++) { 
            $newArticle = new Article();
            $newArticle->category_id = $faker->randomDigitNotNull(); // numeri da 1 a 9
            $newArticle->title = $faker->sentence();
            $newArticle->body = $faker->paragraph();
            $newArticle->save();
        }
    }
}
