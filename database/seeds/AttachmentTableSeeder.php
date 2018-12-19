<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class AttachmentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Attachment::truncate();

        if (!File::isDirectory(attachment_path())) {
            File::deleteDirectory(attachment_path(), true);
        }

        $articles = \App\Article::all();

        $articles->each(function ($article) {
            $article->attachments()->save(
                factory(\App\Attachment::class)->make()
            );
        });

        $files = \App\Attachment::lists('name');

        if (!File::isDirectory(attachment_path())) {
            File::makeDirectory(attachment_path(), 777, true);
        }

        foreach ($files as $file) {
            File::put(attachment_path($file), '');
        }
    }
}
