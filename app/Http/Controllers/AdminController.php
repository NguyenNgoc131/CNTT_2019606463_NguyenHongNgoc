<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\Password;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Support\Facades\DB;

use Carbon\Carbon;

use App\Models\ThongBaoMoiThau;
use App\Models\User;
use App\Models\AccountVerification;
use App\Models\Expert;
use App\Models\ChiTietTBMT;
use App\Models\Follow;
use App\Models\Appointment;

use App\Http\Controllers\VerificationController;

use App\Jobs\SendVerificationEmail;
use App\Jobs\SendNewPasswordEmail;
use App\Jobs\SendResetPasswordConfirmationEmail;


use Hash;
use Auth;
use Str;

class AdminController extends Controller
{
    public function getIndex(){

        // Lấy danh sách người dùng từ bảng users
        $datas = User::paginate(10);

        $variablesToCompact = [
            //bảng users
            'datas'
        ];

        return view("admin.index", compact($variablesToCompact));
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        
        // Cập nhật thông tin từ request
        $name = $request->input('nameInput' . $id);
        $role = $request->input('roleInput' . $id);

        if (!($name)) {
            return back()->with('error', 'Trường name trống!');
        } else {
            # code...
        }
        

        if ($role == 'admin') {
            $user->status = 2;
        }
        elseif($role == 'user') {
            $user->status = 1;
        }
        
        else {
            return back()->with('error', 'Trường không hợp lệ!');
        }
        // Lưu thông tin người dùng sau khi sửa
        $user->name = $name;
        $user->role = $role;
        $user->save();

        // Hiển thị thông báo xác nhận
        return redirect()->back()->with('success', 'Thông tin người dùng đã được cập nhật.');

    }


    public function deleteUser($id)
    {
        $user = User::findOrFail($id);
        $verification = AccountVerification::where('user_id', $id)->first();
        if ($verification) {
            $verification->delete();
        }
        $user->delete();
    
        return redirect()->back()->with('success', 'Người dùng đã được xoá.');
    }

    public function getExperts(){

        // Lấy danh sách người dùng từ bảng users
        $datas = Expert::paginate(10);

        $variablesToCompact = [
            //bảng users
            'datas'
        ];

        return view("admin.experts", compact($variablesToCompact));
    }

    public function deleteExpert($id)
    {
        $expert = Expert::findOrFail($id);
        $expert->delete();
    
        return redirect()->back()->with('success', 'Đã xoá chuyên gia.');
    }

    public function addExpert(Request $request) {
        // Kiểm tra và xử lý dữ liệu được gửi từ form
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'degree' => 'required|string|max:255',
            'experience' => 'required|integer|min:0',
            'email' => 'required|email|unique:experts', // Đảm bảo rằng email là duy nhất trong database
            'appointment_bids' => 'required|integer|min:0',
            'successful_bids' => 'required|integer|min:0',
            'success_rate' => 'required|numeric|min:0|max:100'
        ]);
    
        // Lưu thông tin chuyên gia vào database
        Expert::create($data);
    
        // Chuyển hướng trở lại trang danh sách chuyên gia hoặc bạn có thể trả về thông báo thành công tùy ý
        return redirect()->back()->with('success', 'Chuyên gia đã được thêm thành công!');
    }

    public function getLinhVuc(){

        $year = now()->year; // Lấy năm hiện tại
    
        // Khởi tạo mảng để lưu tổng giá trị cho mỗi lĩnh vực
        $datas = ThongBaoMoiThau::all();
        $linhVucTotals = [];
    
        foreach ($datas as $item) {
            $linhVuc = $item['LinhVuc'];
            $price = $item['GiaGoiThau'];
    
            if (!isset($linhVucTotals[$linhVuc])) {
                $linhVucTotals[$linhVuc] = [
                    'name' => $linhVuc,
                    'totalValue' => 0,
                    'totalCount' => 0,
                    'newCount' => 0,
                ];
            }
    
            // Loại bỏ dấu chấm và chuyển đổi thành số hợp lệ
            $price = str_replace('.', '', $price);
            $price = (float) $price;
    
            // Kiểm tra xem $price là số hợp lệ trước khi thực hiện phép cộng
            if (is_numeric($price)) {
                $linhVucTotals[$linhVuc]['totalValue'] += $price;
            }
    
            // Đếm số lượng TBMT
            $linhVucTotals[$linhVuc]['totalCount']++;
    
            // Đếm số lượng TBMT mới trong tháng này
            if (Carbon::parse($item['NgayDang'])->isCurrentMonth()) {
                $linhVucTotals[$linhVuc]['newCount']++;
            }
        }
    
        // Chuyển dữ liệu sang view
        $variablesToCompact = [
            'year',
            'linhVucTotals'
        ];
    
        return view("admin.linhvuc", compact($variablesToCompact));
    }
    

    public function getCity(){

        $year = now()->year; // Lấy năm hiện tại
    
        // Lấy danh sách TBMT từ bảng ThongBaoMoiThau
        $datas_count = ThongBaoMoiThau::all();
        $linhVucTotals = [];
        $allCategories = [];
    
        foreach ($datas_count as $item) {
            $province = $item['TinhThanh'];
            $category = $item['LinhVuc'];
            $price = $item['GiaGoiThau'];
    
            if (!isset($linhVucTotals[$province])) {
                $linhVucTotals[$province] = [
                    'totalCount' => 0,
                    'totalValue' => 0,
                    'newCount' => 0,
                    'categories' => []
                ];
            }
    
            // Loại bỏ dấu chấm và chuyển đổi thành số hợp lệ
            $price = str_replace('.', '', $price);
            $price = (float) $price;
    
            if (is_numeric($price)) {
                $linhVucTotals[$province]['totalValue'] += $price;
            }
    
            $linhVucTotals[$province]['totalCount']++;
            $linhVucTotals[$province]['categories'][$category] = isset($linhVucTotals[$province]['categories'][$category]) ? $linhVucTotals[$province]['categories'][$category] + 1 : 1;
    
            if (Carbon::parse($item['NgayDang'])->isCurrentMonth()) {
                $linhVucTotals[$province]['newCount']++;
            }
            // Thêm loại lĩnh vực vào mảng nếu nó chưa tồn tại
            if (!in_array($category, $allCategories)) {
                $allCategories[] = $category;
            }
        }
    
        $variablesToCompact = [
            'year',
            'linhVucTotals',
            'allCategories'
        ];
    
        return view("admin.city", compact($variablesToCompact));
    }
    
}
