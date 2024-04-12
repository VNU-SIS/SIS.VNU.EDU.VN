<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class AddLevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('levels')->insert([
          'id' => 18,
          'title' => 'Phòng thí nghiệm',
          'created_at' => now(),
          'updated_at' => now(),
        ]);
        DB::table('levels')->insert([
          'id' => 19,
          'title' => 'Phòng thí nghiệm kỹ thuật đồng vị phóng xạ ứng dụng',
          'created_at' => now(),
          'updated_at' => now(),
        ]);
        DB::table('levels')->insert([
          'id' => 20,
          'title' => 'Phòng thí nghiệm công nghệ không gian phục vụ phát triển bền vững',
          'created_at' => now(),
          'updated_at' => now(),
        ]);
    }
}
