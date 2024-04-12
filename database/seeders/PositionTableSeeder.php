<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class PositionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $arrayPosition = [
            'Chủ nhiệm khoa',
            'Phó chủ nhiệm khoa',
            'Trưởng phòng',
            'Phó Trưởng phòng',
            'Trưởng bộ phận',
            'Chuyên viên',
            'Giảng viên',
        ];

        foreach ($arrayPosition as $key => $position) {
            DB::table('positions')->insert([
                'id' => $key + 1,
                'name' => $position,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
