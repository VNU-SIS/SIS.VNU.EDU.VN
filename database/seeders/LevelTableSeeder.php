<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class LevelTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $arrayLevel = [
            'Chi ủy',
            'Hội đồng khoa học và đào tạo',
            'Ban chủ nhiêm khoa',
            'Tổ chức đoàn thể xã hội',
            'Tổ chuyên môn',
            'Phòng ban chức năng',
            'Tổ liên ngành khoa học quản lí kinh tế luật',
            'Tổ liên ngành khoa học xã hội và nhân văn',
            'Phòng tổ chức - hành chính',
            'Phòng kế hoạch tài chính',
            'Tổ liên ngành học tự nhiên, công nghệ và kỹ thuật',
            'Phòng khoa học công nghệ và hợp tác phát triển',
            'Phòng đào tạo và công tác sinh viên',
            'Phòng truyền thông và tuyển sinh',
        ];

        foreach ($arrayLevel as $key => $level) {
            DB::table('levels')->insert([
                'id' => $key + 1,
                'title' => $level,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
