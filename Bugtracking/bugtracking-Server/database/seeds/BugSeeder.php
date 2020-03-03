<?php

use Illuminate\Database\Seeder;

class BugSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\User::class, 5)->create()->each(function ($user) {
            $user->bugs()->saveMany(factory(\App\Bug::class, 5)->make())->each(function ($bug) {
                $bug->comments()->saveMany(factory(\App\Comment::class, 3)->make());
            });
        });
    }
}
