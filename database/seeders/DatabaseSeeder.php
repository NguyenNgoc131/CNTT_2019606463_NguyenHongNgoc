<?php

namespace Database\Seeders;

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
        // User::factory(10)->create();
         // Lấy dữ liệu từ cơ sở dữ liệu MySQL
        $mysqlData = DB::connection('mysql')->select('SELECT * FROM tbl_thongbaomoithau_layout');
        $id = 'id';
        $MaTBMT = 'MaTBMT';
        $TenGoiThau = 'TenGoiThau';
        $LinhVuc = 'LinhVuc';
        $TrangThai = 'TrangThai';
        $TinhThanh = 'TinhThanh';
        $GiaGoiThau = 'GiaGoiThau';
        $ThoiGianThucHien = 'ThoiGianThucHien';

        
        // Thêm dữ liệu từ MySQL vào cơ sở dữ liệu Laravel
        foreach ($mysqlData as $row) {
            DB::table('my_table')->insert([
                'Mã TBMT' => $row->$MaTBMT,
                'Tên gói thầu' => $row->$TenGoiThau,
                'Lĩnh vực' => $row->$LinhVuc,
                'Trạng thái' => $row->$TrangThai,
                'Tỉnh thành' => $row->$TinhThanh,
                'Giá gói thầu' => $row->$GiaGoiThau,
                'Thời gian thực hiện' => $row->$ThoiGianThucHien,
            ]);
        }
    }
}
