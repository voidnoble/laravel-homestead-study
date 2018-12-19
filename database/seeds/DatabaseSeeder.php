<?php

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();
        DB::statement('SET FOREIGN_KEY_CHECKS=0');

        $this->call(UsersTableSeeder::class);
        $this->command->info('users table seeded');

        $this->call(PostsTableSeeder::class);
        $this->command->info('posts table seeded');

        $this->call(ArticlesTableSeeder::class);
        $this->command->info('articles table seeded');

        $this->call(CommentsTableSeeder::class);
        $this->command->info('comments table seeded');

        $this->call(TagsTableSeeder::class);
        $this->command->info('tags table seeded');

        $this->call(AttachmentTableSeeder::class);
        $this->command->info('attachments table seeded');

        DB::statement('SET FOREIGN_KEY_CHECKS=1');
        Model::reguard();
    }
}
