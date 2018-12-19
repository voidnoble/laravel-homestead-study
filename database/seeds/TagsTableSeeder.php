<?php

use Illuminate\Database\Seeder;

class TagsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Tag::truncate();
        DB::table('article_tag')->truncate();

        $articles = \App\Article::all();

        $articles->each(function ($article) {
            $article->tags()->save(
                factory(\App\Tag::class)->make()
            );
        });
    }
}
