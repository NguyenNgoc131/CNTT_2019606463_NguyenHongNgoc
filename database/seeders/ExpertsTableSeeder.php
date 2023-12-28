<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class ExpertsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('experts')->insert([
            'name' => 'Nguyen Van A',
            'degree' => 'Kỹ sư Định giá xây dựng hạng I - BXD',
            'experience' => 10,
            'office' => 'Phố X, Phường Y, Quận Z, Hà Nội',
            'appointment_bids' =>0,
            'successful_bids' => 50,
            'success_rate' => 85.5,
            'image_url' => '../assets/images/advicer/trend-avatar-1.jpg',
            'email' => 'nguyenA.VietBidding@gmail.com',
            'ngayhen' => '30/12/2023 14:00, 10/01/2023 10:00, 19/01/2024 09:00, 30/01/2023 14:00, 10/02/2023 10:00, 19/02/2024 09:00',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('experts')->insert([
            'name' => 'Tran Van B',
            'degree' => 'Kỹ sư Định giá xây dựng hạng I - BXD',
            'experience' => 7,
            'office' => 'Phố X, Phường Y, Quận Z, Hà Nội',
            'appointment_bids' =>2,
            'successful_bids' => 30,
            'success_rate' => 60,
            'image_url' => '../assets/images/advicer/trend-avatar-1.jpg',
            'email' => 'tranB.Vietbidding@gmail.com',
            'ngayhen' => '20/01/2023 14:00, 29/01/2023 10:00, 04/02/2024 08:00, 30/02/2023 14:00, 10/03/2023 10:00, 19/03/2024 09:00',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('experts')->insert([
            'name' => 'Luu Van C',
            'degree' => 'Kỹ sư Định giá xây dựng hạng I - BXD',
            'experience' => 7,
            'office' => 'Phố X, Phường Y, Quận Z, Hà Nội',
            'appointment_bids' =>2,
            'successful_bids' => 35,
            'success_rate' => 60,
            'image_url' => '../assets/images/advicer/trend-avatar-1.jpg',
            'email' => 'luuC.Vietbidding@gmail.com',
            'ngayhen' => '20/01/2023 14:00, 29/01/2023 10:00, 04/02/2024 08:00, 30/02/2023 14:00, 10/03/2023 10:00, 19/03/2024 09:00',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('experts')->insert([
            'name' => 'Nguyen Trung D',
            'degree' => 'Kỹ sư Định giá xây dựng hạng II - BXD',
            'experience' => 5,
            'office' => 'Phố X, Phường Y, Quận Z, Hà Nội',
            'appointment_bids' =>2,
            'successful_bids' => 25,
            'success_rate' => 65,
            'image_url' => '../assets/images/advicer/trend-avatar-1.jpg',
            'email' => 'nguyenD.Vietbidding@gmail.com',
            'ngayhen' => '20/01/2023 14:00, 29/01/2023 10:00, 04/02/2024 08:00, 30/02/2023 14:00, 10/03/2023 10:00, 19/03/2024 09:00',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('experts')->insert([
            'name' => 'Tran Van E',
            'degree' => 'Kỹ sư Định giá xây dựng hạng II - BXD',
            'experience' => 4,
            'office' => 'Phố X, Phường Y, Quận Z, Hà Nội',
            'appointment_bids' =>2,
            'successful_bids' => 20,
            'success_rate' => 50,
            'image_url' => '../assets/images/advicer/trend-avatar-1.jpg',
            'email' => 'tranE.Vietbidding@gmail.com',
            'ngayhen' => '20/01/2023 14:00, 29/01/2023 10:00, 04/02/2024 08:00, 30/02/2023 14:00, 10/03/2023 10:00, 19/03/2024 09:00',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('experts')->insert([
            'name' => 'Tran Chinh F',
            'degree' => 'Kỹ sư Định giá xây dựng hạng III - BXD',
            'experience' => 4,
            'office' => 'Phố X, Phường Y, Quận Z, Hà Nội',
            'appointment_bids' =>2,
            'successful_bids' => 18,
            'success_rate' => 50,
            'image_url' => '../assets/images/advicer/trend-avatar-1.jpg',
            'email' => 'tranF.Vietbidding@gmail.com',
            'ngayhen' => '20/01/2023 14:00, 29/01/2023 10:00, 04/02/2024 08:00, 30/02/2023 14:00, 10/03/2023 10:00, 19/03/2024 09:00',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('experts')->insert([
            'name' => 'Le Van G',
            'degree' => 'Kỹ sư Định giá xây dựng hạng III - BXD',
            'experience' => 4,
            'office' => 'Phố X, Phường Y, Quận Z, Hà Nội',
            'appointment_bids' =>2,
            'successful_bids' => 16,
            'success_rate' => 40,
            'image_url' => '../assets/images/advicer/trend-avatar-1.jpg',
            'email' => 'leG.Vietbidding@gmail.com',
            'ngayhen' => '20/01/2023 14:00, 29/01/2023 10:00, 04/02/2024 08:00, 30/02/2023 14:00, 10/03/2023 10:00, 19/03/2024 09:00',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
