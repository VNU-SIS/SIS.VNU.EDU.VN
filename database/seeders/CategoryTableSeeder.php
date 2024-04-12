<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Enums\DBConstant;
use DB;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            // Cấp 1
		    [
                "id" => DBConstant::INTRODUCTION,
			    "name" => "GIỚI THIỆU",
			    "parent_id" => 0,
                "order" => 0
            ],
            [
                "id" => DBConstant::ADMISSIONS,
			    "name" => "TUYỂN SINH",
			    "parent_id" => 0,
                "order" => 1
            ],
            [
                "id" => DBConstant::EDUCATION,
			    "name" => "ĐÀO TẠO",
			    "parent_id" => 0,
                "order" => 2
            ],
            [
                "id" => DBConstant::NEWS,
			    "name" => "TIN TỨC",
			    "parent_id" => 0,
                "order" => 3
            ],
            [
                "id" => DBConstant::COOPERATION,
			    "name" => "HỢP TÁC PHÁT TRIỂN",
			    "parent_id" => 0,
                "order" => 4
            ],
            [
                "id" => DBConstant::SCIENTIFIC_RESEARCH,
			    "name" => "NGHIÊN CỨU KHOA HỌC",
			    "parent_id" => 0,
                "order" => 5
            ],
            [
                "id" => DBConstant::SIS_ALUMNI,
			    "name" => "SIS ALUMNI",
			    "parent_id" => 0,
                "order" => 6
            ],
            [
                "id" => DBConstant::SIS_STUDENT,
			    "name" => "SINH VIÊN SIS",
			    "parent_id" => 0,
                "order" => 7
            ],

            // Cấp 2
            // GIỚI THIỆU
            [
                "id" => 9,
			    "name" => "Những dấu mốc trên hành trình phát triển",
			    "parent_id" => DBConstant::INTRODUCTION,
                "order" => 0
            ],
            [
                "id" => 10,
			    "name" => "Tầm nhìn, sứ mệnh và giá trị cốt lõi",
			    "parent_id" => DBConstant::INTRODUCTION,
                "order" => 1
            ],
            [
                "id" => 11,
			    "name" => "Thông điệp của CNK",
			    "parent_id" => DBConstant::INTRODUCTION,
                "order" => 2
            ],
            [
                "id" => 12,
			    "name" => "Cơ cấu tổ chức",
			    "parent_id" => DBConstant::INTRODUCTION,
                "order" => 3
            ],
            [
                "id" => 13,
			    "name" => "Tư liệu hình ảnh - video",
			    "parent_id" => DBConstant::INTRODUCTION,
                "order" => 4
            ],
            [
                "id" => 14,
			    "name" => "Báo chí nói gì về VNU-SIS",
			    "parent_id" => DBConstant::INTRODUCTION,
                "order" => 5
            ],

            // TUYỂN SINH
            [
                "id" => 15,
			    "name" => "Các ngành đại học chính quy",
			    "parent_id" => DBConstant::ADMISSIONS,
                "order" => 0
            ],
            [
                "id" => 16,
			    "name" => "Các chuyên ngành sau đại học",
			    "parent_id" => DBConstant::ADMISSIONS,
                "order" => 1
            ],

            // ĐÀO TẠO
            [
                "id" => 17,
			    "name" => "Cử nhân",
			    "parent_id" => DBConstant::EDUCATION,
                "order" => 0
            ],
            [
                "id" => 18,
			    "name" => "Thạc sĩ",
			    "parent_id" => DBConstant::EDUCATION,
                "order" => 1
            ],
            [
                "id" => 19,
			    "name" => "Tiến sĩ",
			    "parent_id" => DBConstant::EDUCATION,
                "order" => 2
            ],
            [
                "id" => 20,
			    "name" => "Luận văn - Luận án",
			    "parent_id" => DBConstant::EDUCATION,
                "order" => 3
            ],
            [
                "id" => 21,
			    "name" => "Công tác sinh viên",
			    "parent_id" => DBConstant::EDUCATION,
                "order" => 4
            ],

            // TIN TỨC
            [
                "id" => 22,
			    "name" => "Tin về ĐHQGHN",
			    "parent_id" => DBConstant::NEWS,
                "order" => 0
            ],
            [
                "id" => 23,
			    "name" => "Tin nội bộ",
			    "parent_id" => DBConstant::NEWS,
                "order" => 1
            ],
            [
                "id" => 24,
			    "name" => "Tin chuyên ngành",
			    "parent_id" => DBConstant::NEWS,
                "order" => 2
            ],
            [
                "id" => 25,
			    "name" => "Thông cáo báo chí",
			    "parent_id" => DBConstant::NEWS,
                "order" => 3
            ],
            [
                "id" => 26,
			    "name" => "Tin tuyển dụng",
			    "parent_id" => DBConstant::NEWS,
                "order" => 4
            ],

            // HỢP TÁC PHÁT TRIỂN
            [
                "id" => 27,
			    "name" => "Thông tin hợp tác phát triển",
			    "parent_id" => DBConstant::COOPERATION,
                "order" => 0
            ],
            [
                "id" => 28,
			    "name" => "Đối tác trong nước và quốc tế",
			    "parent_id" => DBConstant::COOPERATION,
                "order" => 1
            ],
            [
                "id" => 29,
			    "name" => "Chương trình đào tạo quốc tế",
			    "parent_id" => DBConstant::COOPERATION,
                "order" => 2
            ],

            // NGHIÊN CỨU KHOA HỌC
            [
                "id" => 30,
			    "name" => "Tài nguyên số",
			    "parent_id" => DBConstant::SCIENTIFIC_RESEARCH,
                "order" => 0
            ],
            [
                "id" => 31,
			    "name" => "Danh mục đề tài nghiên cứu",
			    "parent_id" => DBConstant::SCIENTIFIC_RESEARCH,
                "order" => 1
            ],

            // SIS ALUMNI
            [
                "id" => 32,
			    "name" => "Hoạt động của CLB",
			    "parent_id" => DBConstant::SIS_ALUMNI,
                "order" => 0
            ],
            [
                "id" => 33,
			    "name" => "Ban Chủ nhiệm của CLB",
			    "parent_id" => DBConstant::SIS_ALUMNI,
                "order" => 1
            ],
            [
                "id" => 34,
			    "name" => "Thành viên tiêu biểu",
			    "parent_id" => DBConstant::SIS_ALUMNI,
                "order" => 2
            ],
            [
                "id" => 35,
			    "name" => "Tuyển dụng của cựu học viên",
			    "parent_id" => DBConstant::SIS_ALUMNI,
                "order" => 3
            ],

            // SINH VIÊN SIS
            [
                "id" => 36,
			    "name" => "Đoàn - Hội",
			    "parent_id" => DBConstant::SIS_STUDENT,
                "order" => 0
            ],
            [
                "id" => 37,
			    "name" => "Các hoạt động tình nguyện",
			    "parent_id" => DBConstant::SIS_STUDENT,
                "order" => 1
            ],
            [
                "id" => 38,
			    "name" => "Các Câu lạc bộ",
			    "parent_id" => DBConstant::SIS_STUDENT,
                "order" => 2
            ],
            [
                "id" => 39,
			    "name" => "Đời sống sinh viên",
			    "parent_id" => DBConstant::SIS_STUDENT,
                "order" => 3
            ],

            // Cấp 3
            // Các ngành đại học chính quy
            [
                "id" => 40,
			    "name" => "Cử nhân Quản trị thương hiệu (BBM)",
			    "parent_id" => 15,
                "order" => 0
            ],
            [
                "id" => 41,
			    "name" => "Cử nhân Quản trị tài nguyên di sản (HRM)",
			    "parent_id" => 15,
                "order" => 1
            ],

            // Các chuyên ngành sau đại học
            [
                "id" => 42,
			    "name" => "Thạc sĩ Biến đổi khí hậu",
			    "parent_id" => 16,
                "order" => 0
            ],
            [
                "id" => 43,
			    "name" => "Thạc sĩ Khoa học bền vững",
			    "parent_id" => 16,
                "order" => 1
            ],
            [
                "id" => 44,
			    "name" => "Thạc sĩ Quản lí phát triển đô thị",
			    "parent_id" => 16,
                "order" => 2
            ],
            [
                "id" => 45,
			    "name" => "Thạc sĩ Di sản học",
			    "parent_id" => 16,
                "order" => 3
            ],
            [
                "id" => 46,
			    "name" => "Tiến sĩ Biến đổi khí hậu và phát triển bền vững",
			    "parent_id" => 16,
                "order" => 4
            ],

            // Cử nhân
            [
                "id" => 47,
			    "name" => "Cử nhân Quản trị thương hiệu (BBM)",
			    "parent_id" => 17,
                "order" => 0
            ],
            [
                "id" => 48,
			    "name" => "Cử nhân Quản trị tài nguyên di sản (HRM)",
			    "parent_id" => 17,
                "order" => 1
            ],
            [
                "id" => 49,
			    "name" => "Hoạt động của sinh viên",
			    "parent_id" => 17,
                "order" => 2
            ],

            // Thạc sĩ
            [
                "id" => 50,
			    "name" => "Thạc sĩ Biến đổi khí hậu",
			    "parent_id" => 18,
                "order" => 0
            ],
            [
                "id" => 51,
			    "name" => "Thạc sĩ Khoa học bền vững",
			    "parent_id" => 18,
                "order" => 1
            ],
            [
                "id" => 52,
			    "name" => "Thạc sĩ Quản lí phát triển đô thị",
			    "parent_id" => 18,
                "order" => 2
            ],
            [
                "id" => 53,
			    "name" => "Thạc sĩ Di sản học",
			    "parent_id" => 18,
                "order" => 3
            ],
            [
                "id" => 54,
			    "name" => "Thực địa liên ngành",
			    "parent_id" => 18,
                "order" => 4
            ],

            // Tiến sĩ
            [
                "id" => 55,
			    "name" => "Tiến sĩ Biến đổi khí hậu và phát triển bền vững",
			    "parent_id" => 19,
                "order" => 0
            ],

            // Công tác sinh viên
            [
                "id" => 56,
			    "name" => "Biểu mẫu",
			    "parent_id" => 21,
                "order" => 0
            ],
            [
                "id" => 57,
			    "name" => "Văn bản liên quan",
			    "parent_id" => 21,
                "order" => 1
            ],

            // Tài nguyên số
            [
                "id" => 58,
			    "name" => "Luận văn, luận án",
			    "parent_id" => 30,
                "order" => 0
            ],
            [
                "id" => 59,
			    "name" => "Các công trình khoa học",
			    "parent_id" => 30,
                "order" => 1
            ],

	    ];

	    DB::table('categories')->insert($data);
    }
}
