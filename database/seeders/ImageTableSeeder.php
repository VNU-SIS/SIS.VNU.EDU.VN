<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;
use App\Enums\DBConstant;

class ImageTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $images = [
            'Tin tức về ĐHQGHN',
            'Chuyên gia từ các khoa học liên ngành',
            'Báo chí nói gì về khoa học liên ngành',
        ];

        foreach ($images as $image) {
            DB::table('images')->insert([
                'path' => '',
                'filename' => $image,
                'type' => DBConstant::BANNER_TEXT_TYPE,
                'created_by' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
