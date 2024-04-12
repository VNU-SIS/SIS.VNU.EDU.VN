<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        $this->call([
            CategoryTableSeeder::class,
            UserTableSeeder::class,
            LevelTableSeeder::class,
            PositionTableSeeder::class
        ]);
        // \App\Models\User::factory(100)->create();
        // \App\Models\Category::factory(10)->create();
    }
}
