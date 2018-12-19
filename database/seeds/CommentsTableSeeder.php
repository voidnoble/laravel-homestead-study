<?php

use Illuminate\Database\Seeder;

class CommentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Comment::truncate();

        $articles = \App\Article::all();
        $users = \App\User::all();
        $faker = \Faker\Factory::create();

        $articles->each(function ($article) use ($faker, $users) {
            $article->comments()->save(
                factory(\App\Comment::class)->make([
                    'author_id' => $faker->randomElement($users->lists('id')->toArray())
                ])
            );
        });
    }
}
