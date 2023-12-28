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


class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests, SendsPasswordResetEmails;

    public function getDashboard(Request $request){
        # Phân trang
        // Lấy tham số 'pageSize' từ URL hoặc lấy giá trị đã lưu trong session, mặc định là 10 nếu không có
        $pageSize = $request->input('pageSize', session('pageSize', 10));

        // Lưu giá trị 'pageSize' vào session để giữ nguyên giá trị qua các trang
        session(['pageSize' => $pageSize]);

        // Lấy dữ liệu và phân trang với số lượng dòng trên mỗi trang đã chọn
        $data = ThongBaoMoiThau::orderBy('NgayDang', 'desc')->paginate($pageSize); // Sắp xếp theo thời gian mới nhất

        # So sánh hàng tuần

        // Tính ngày hiện tại
        $currentDate = Carbon::today();

        
        
        # Tổng giá trị các tỉnh thành
        //Lấy dữ liệu ngày hiện tại
        $datas = ThongBaoMoiThau::whereDate('NgayDang', $currentDate)->get();
        
        // Tính tổng giá trị gói thầu cho từng tỉnh thành
        $provinceTotals = [];

        foreach ($datas as $province) {
            $provinceName = $province['TinhThanh'];
            $price = $province['GiaGoiThau'];

            if (!isset($provinceTotals[$provinceName])) {
                $provinceTotals[$provinceName] = 0;
            }

            // Loại bỏ dấu chấm và chuyển đổi thành số hợp lệ
            $price = str_replace('.', '', $price);
            $price = (float) $price;

            // Kiểm tra xem $price là số hợp lệ trước khi thực hiện phép cộng
            if (is_numeric($price)) {
                $provinceTotals[$provinceName] += $price;
            }
        }

        // Sắp xếp các tỉnh thành theo tổng giá trị giảm dần
        arsort($provinceTotals);

        // Lấy 6 tỉnh thành có tổng giá trị lớn nhất
        $topProvinces = array_slice($provinceTotals, 0, 6);


        # Tổng số TBMT
        // Lấy tổng số thông báo mời thầu cho ngày hiện tại
        $totalNotificationsToday = ThongBaoMoiThau::whereDate('NgayDang', $currentDate)->count();
        

        // Lấy danh sách các giá trị từ cột 'GiaGoiThau' theo ngày
        $prices = ThongBaoMoiThau::whereDate('NgayDang', $currentDate)->pluck('GiaGoiThau');

        // Chuyển đổi và tính tổng
        $totalPriceToday = 0;
        foreach ($prices as $price) {
            // Loại bỏ dấu chấm và chuyển đổi thành số hợp lệ
            $price = str_replace('.', '', $price);
            $price = (float) $price;

            // Thêm giá vào tổng
            $totalPriceToday += $price;
        }
        

        // Tính ngày hiện tại
        $currentDate2 = Carbon::today();
        // Trừ đi 8 ngày
        $eightDaysAgo = $currentDate2->modify('-8 days')->format('Y-m-d');
        // Tính tổng số TBMT cho ngày 7 ngày trước
        $sevenDaysAgoTotal = ThongBaoMoiThau::whereDate('NgayDang', $eightDaysAgo)->count();
        
        // Tính tổng giá trị gói thầu cho ngày 7 ngày trước
        $sevenDaysAgoTotalPriceTake = ThongBaoMoiThau::whereDate('NgayDang', $eightDaysAgo)->pluck('GiaGoiThau');
        // Chuyển đổi và tính tổng
        $sevenDaysAgoTotalPrice = 0;
        foreach ($sevenDaysAgoTotalPriceTake as $price) {
            // Loại bỏ dấu chấm và chuyển đổi thành số hợp lệ
            $price = str_replace('.', '', $price);
            $price = (float) $price;

            // Thêm giá vào tổng
            $sevenDaysAgoTotalPrice += $price;
        }

        // Kiểm tra nếu cả hai đều bằng 0
        if ($sevenDaysAgoTotal == 0 && $sevenDaysAgoTotalPrice == 0) {
            $textTBMT = '';
            $classTBMT = '';
            $messageTBMT = 'Không có dữ liệu';

            $textPrice = '';
            $classPrice = '';
            $messagePrice = 'Không có dữ liệu';
        } else {
            // So sánh tổng số TBMT của ngày hiện tại với 7 ngày trước
            $percentageChangeTBMT = ($totalNotificationsToday - $sevenDaysAgoTotal) / ($sevenDaysAgoTotal == 0 ? 1 : $sevenDaysAgoTotal) * 100;

            // Đổi tên class và chuỗi thông báo tương ứng
            if ($percentageChangeTBMT > 0) {
                $textTBMT = 'text-primary';
                $classTBMT = 'fa fa-long-arrow-up m-r-xs';
                $messageTBMT = number_format($percentageChangeTBMT, 2) . '% so với tuần trước';
            } elseif ($percentageChangeTBMT < 0) {
                $textTBMT = 'text-danger';
                $classTBMT = 'fa fa-long-arrow-down m-r-xs';
                $messageTBMT = number_format(abs($percentageChangeTBMT), 2) . '% so với tuần trước';
            } else {
                $textTBMT = '';
                $classTBMT = '';
                $messageTBMT = 'Không thay đổi so với tuần trước';
            }

            // So sánh tổng giá trị gói thầu của ngày hiện tại với 7 ngày trước
            $percentageChangePrice = ($totalPriceToday - $sevenDaysAgoTotalPrice) / ($sevenDaysAgoTotalPrice == 0 ? 1 : $sevenDaysAgoTotalPrice) * 100;

            // Đổi tên class và chuỗi thông báo tương ứng
            if ($percentageChangePrice > 0) {
                $textPrice = 'text-primary';
                $classPrice = 'fa fa-long-arrow-up m-r-xs';
                $messagePrice = number_format($percentageChangePrice, 2) . '% so với tuần trước';
            } elseif ($percentageChangePrice < 0) {
                $textPrice = 'text-danger';
                $classPrice = 'fa fa-long-arrow-down m-r-xs';
                $messagePrice = number_format(abs($percentageChangePrice), 2) . '% so với tuần trước';
            } else {
                $textPrice = '';
                $classPrice = '';
                $messagePrice = 'Không thay đổi so với tuần trước';
            }
        }
        
        // Tạo một mảng lưu trữ 6 ngày trước đó
        $sevenDaysAgo = [];
        for ($i = 0; $i < 7; $i++) {
            $sevenDaysAgo[] = $currentDate->format('Y-m-d');
            $currentDate = $currentDate->subDays(1);
        }

        // Đảo ngược mảng để đảm bảo thứ tự từ cũ đến mới
        $sevenDaysAgo = array_reverse($sevenDaysAgo);



        # Tính tổng số TBMT theo ngày đăng
        $TBMT_count = [];
        foreach ($sevenDaysAgo as $day) {
            $TBMT_count[] = ThongBaoMoiThau::whereDate('NgayDang', $day)->count();
        }
        $TBMT_count = json_encode($TBMT_count);
        
        # Tính tổng giá trị gói thầu theo ngày đăng
        $tong_gia = [];
        foreach ($sevenDaysAgo as $day) {
            // Trước khi tính tổng, loại bỏ dấu chấm và dấu phẩy, sau đó chuyển đổi thành số.
            $totalPrice = ThongBaoMoiThau::whereDate('NgayDang', $day)
                ->get()
                ->sum(function ($item) {
                    return (float) str_replace(['.', ','], '', $item->GiaGoiThau);
                });
        
            $tong_gia[] = $totalPrice;
        }
        $tong_gia = json_encode($tong_gia);

        // dd($TBMT_count, $tong_gia);


        # Lấy dữ liệu cho bar chart
        $xay_lap = [];
        $hang_hoa = [];
        $tu_van = [];
        $phi_tu_van = [];

        // Tính tổng mỗi lịch vực theo ngày đăng
        foreach ($sevenDaysAgo as $day) {
            $xay_lap[] = ThongBaoMoiThau::whereDate('NgayDang', $day)->where('LinhVuc', 'Xây lắp')->count();
            $hang_hoa[] = ThongBaoMoiThau::whereDate('NgayDang', $day)->where('LinhVuc', 'Hàng hóa')->count();
            $tu_van[] = ThongBaoMoiThau::whereDate('NgayDang', $day)->where('LinhVuc', 'Tư vấn')->count();
            $phi_tu_van[] = ThongBaoMoiThau::whereDate('NgayDang', $day)->where('LinhVuc', 'Phi tư vấn')->count();
        }

        $sevenDaysAgo = str_replace('"', "'", json_encode($sevenDaysAgo));
        $xay_lap = json_encode($xay_lap);
        $hang_hoa = json_encode($hang_hoa);
        $tu_van = json_encode($tu_van);
        $phi_tu_van = json_encode($phi_tu_van);

        // dd($sevenDaysAgo, $xay_lap);


        # Lấy dữ liệu cho pie chart
        // Lấy tổng số TBMT từng lĩnh vực
        $xayLap_count = ThongBaoMoiThau::where('LinhVuc', "Xây lắp")->count();
        $xayLap_count = json_encode($xayLap_count);

        $hangHoa_count = ThongBaoMoiThau::where('LinhVuc', "Hàng hóa")->count();
        $hangHoa_count = json_encode($hangHoa_count);

        $tuVan_count = ThongBaoMoiThau::where('LinhVuc', "Tư vấn")->count();
        $tuVan_count = json_encode($tuVan_count);

        $phiTuVan_count = ThongBaoMoiThau::where('LinhVuc', "Phi tư vấn")->count();
        $phiTuVan_count = json_encode($phiTuVan_count);


        
        

        # Tìm kiếm
        $searchTerm = $request->input('searchTerm');
        $searchColumn = $request->input('searchColumn');

        if ($searchTerm && $searchColumn) {
            // Tùy chỉnh điều kiện tìm kiếm dựa trên yêu cầu
            if ($searchColumn === "LinhVuc") {
                // Nếu tìm kiếm theo "Lĩnh Vực"
                $data = ThongBaoMoiThau::where($searchColumn, 'LIKE', '%' . $searchTerm . '%')
                                    ->orWhere($searchColumn, 'LIKE', '%' . str_replace('hóa', 'hoá', $searchTerm) . '%')
                                    ->orderBy('NgayDang', 'desc')
                                    ->paginate($pageSize);
            } elseif ($searchColumn === "something_else") {
                // Các điều kiện tìm kiếm khác
            } else {
                // Mặc định
                $data = ThongBaoMoiThau::where($searchColumn, 'LIKE', '%' . $searchTerm . '%')
                                    ->orderBy('NgayDang', 'desc')
                                    ->paginate($pageSize);
            }
        }
        // Kiểm tra số lượng bản ghi trả về
        $noDataMessage = '';
        $alert1 = '';
        if ($data->isEmpty()) {
            // Gán thông báo cho biến $noDataMessage để truyền sang view
            $noDataMessage = "Không có dữ liệu! Hãy chắc chắn rằng từ khoá đúng theo loại cột bạn muốn tìm kiếm";
            $alert1 = "Ví dụ: chọn Tìm kiếm theo Lĩnh vực rồi mới nhập từ khoá tìm kiếm Xây lắp";
        }
        

        $variablesToCompact = [
            //Phân trang
            'data',
            'pageSize',
            //Tổng giá trị gói thầu
            'provinceTotals',
            'topProvinces',
            'totalNotificationsToday',
            'totalPriceToday',
            //Bar chart
            'sevenDaysAgo',
            'TBMT_count',
            'tong_gia',
            'xay_lap',
            'hang_hoa',
            'tu_van',
            'phi_tu_van',
            //Pie chart
            'xayLap_count',
            'hangHoa_count',
            'tuVan_count',
            'phiTuVan_count',
            //So sánh hàng tuần
            'textTBMT',
            'classTBMT',
            'messageTBMT',
            'textPrice',
            'classPrice',
            'messagePrice',
            //Tìm kiếm
            'searchTerm',
            'searchColumn',
            'noDataMessage',
            'alert1'
        ];

        return view("user.dashboard2", compact($variablesToCompact));
    }

    public function getLogin(){

        return view("user.login");
    }

    public function login(Request $request)
    {
        // Validate input
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|min:8',
        ]);

        if ($validator->fails()) {
            return redirect()
                ->route('user.getLogin')
                ->withErrors($validator)
                ->withInput();
        }

        // Kiểm tra xem email có tồn tại trong hệ thống không
        $user = User::where('email', $request->email)->first();

        if (!$user) {
            // Email không tồn tại trong hệ thống
            return back()->with('error', 'Email chưa được đăng ký!');
        }
        


        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){
            // Kiểm tra xem người dùng đã xác minh tài khoản chưa
            $user = Auth::user();

            // Kiểm tra "Ghi nhớ đăng nhập"
            $remember = $request->has('remember') ? true : false;
            
            #Tài khoản user
            if ($user->status == 1) {
                // Tài khoản đã được xác minh, đăng nhập thành công
                return redirect()->route("user.getDashboard");
            }

            #Tài khoản admin
            elseif ($user->status == 2){
                return redirect()->route("admin.getIndex");
            }
            else {
                // Tài khoản chưa được xác minh
                Auth::logout(); // Đăng xuất người dùng
                return back()->with('error', 'Tài khoản chưa được xác minh!');
            }
        }
        else{
            // Đăng nhập thất bại
            return back()->with('error','Đăng nhập không thành công!');
        }

        
    }


    public function getSignup(){
        return view("user.signup");
    }

    public function register(Request $request)
    {
        try {
            // Validate input
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|unique:users,email|max:255',
                'password' => 'required|string|min:8',
            ]);

            if ($validator->fails()) {
                return redirect()
                    ->route('user.getSignup')
                    ->withErrors($validator)
                    ->withInput();
            }

            // Lưu vào database
            $user = User::create([
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'password' => bcrypt($request->input('password')),
                'role' => 'user',
            ]);

            // Lưu vào database với thời gian hết hạn là 5 phút sau thời điểm tạo
            $verification = AccountVerification::create([
                'user_id' => $user->id,
                'token' => Str::random(40),
                'expires_at' => Carbon::now()->addMinutes(5),
            ]);
            // Gửi email bất đồng bộ sử dụng Laravel Jobs
            $this->dispatch(new SendVerificationEmail($user, $verification));

            return back()->with('success', 'Vui lòng đến email của bạn để xác nhận!');
        } catch (\Throwable $th) {
            dd($th);
        }
    }

    public function getLogout(Request $request)
    {
        Auth::logout();
        return redirect(route("user.getDashboard"));
    }

    public function getVerify()
    {
        return view("user.account-verification");
    }

    public function verify(Request $request)
    {
        // Logic để xác nhận email của người dùng
        $token = $request->input('token');

        $verification = AccountVerification::where('token', $token)->first();

        if (!$verification) {
            // Token không tồn tại, xử lý tùy theo yêu cầu (ví dụ, hiển thị thông báo lỗi)
            return redirect()->route('user.getLogin')->with('error', 'Mã xác nhận không hợp lệ.');
        }


        // Cập nhật trạng thái tài khoản người dùng hoặc thực hiện các hành động khác cần thiết
        $user = $verification->user;
        $user->accountVerification()->update(['verify_at' => now()]);
        $user->update(['status' => 1]);
        
        // Tuỳ chọn: Đăng nhập người dùng sau khi xác nhận email
        // Auth::login($user);
       
        return redirect()->route('user.getVerify', compact('verification'))->with('success', 'Email đã được xác nhận thành công.');
    }

    public function updateInfo(Request $request, $token)
    {
        // Logic để cập nhật thông tin sau khi nhấn vào liên kết từ email
        $verification = AccountVerification::where('token', $token)->first();

        $user = $verification->user;

        // Token không tồn tại hoặc đã hết hạn, xử lý tùy theo yêu cầu
        if (!$verification || $verification->expires_at < now()) {

            // Xoá thông tin tài khoản xác nhận vì đã sử dụng hoặc đã hết hạn
            $verification->delete();
           
            // Xoá tài khoản người dùng
            $user->delete();
           
            return redirect()->route('user.getSignup')->with('error', 'Link xác nhận đã hết hạn! Vui lòng đăng ký lại.');
        }
        

        // Cập nhật thông tin
        
        
        // Chỉ cập nhật trạng thái và không xác nhận nếu đã xác minh qua Google
        if ($user->email_verified_at === null && $user->google_id === null) {
            $user->update(['status' => 1]); #0-chưa xác minh email #1-đã xác minh email->user #2-tài khoản admin
        }

        // Cập nhật trạng thái xác minh email
        $verification->update(['verified_at' => now()]);

        return redirect()->route('user.getLogin')->with('success', 'Email đã được xác nhận thành công.');
    }
    
    public function getPasswordForget(){
        return view("user.password-forget");
    }

    public function postPasswordResetRequest(Request $request)
    {
        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return redirect()->back()->with('error', 'Email không tồn tại');
        }

        $token = Str::random(40);

        DB::table('password_resets')->insert([
            'email' => $user->email,
            'token' => $token,
            'created_at' => now(),
        ]);

        // Gửi email với liên kết xác nhận đặt lại mật khẩu, sử dụng Job nếu cần
        $this->dispatch(new SendResetPasswordConfirmationEmail($user, $token));

        return redirect()->back()->with('success', 'Chúng tôi đã gửi một liên kết xác nhận đặt lại mật khẩu qua email của bạn');
    }

    public function getPasswordResetConfirm($token)
    {
        $tokenData = DB::table('password_resets')->where('token', $token)->first();

        if (!$tokenData) {
            return redirect()->route('user.login')->with('error', 'Token không hợp lệ');
        }

        return view('user.password-reset', ['token' => $token]);
    }

    public function postPasswordResetConfirm(Request $request)
    {
        $tokenData = DB::table('password_resets')->where('token', $request->token)->first();

        if (!$tokenData) {
            return redirect()->route('user.login')->with('error', 'Token không hợp lệ');
        }

        $user = User::where('email', $tokenData->email)->first();

        if (!$user) {
            return redirect()->route('user.login')->with('error', 'Người dùng không tồn tại');
        }

        if ($request->action == 'accept') {
            // Đặt lại mật khẩu và gửi email kèm mật khẩu mới
            $newPassword = Str::random(8); // Tạo mật khẩu mới ngẫu nhiên

            DB::table('users')->where('email', $user->email)->update(['password' => Hash::make($newPassword)]);
            DB::table('users')->where('email', $user->email)->update(['updated_at' => now()]);

            // Gửi email kèm mật khẩu mới, sử dụng Job nếu cần
            $this->dispatch(new SendNewPasswordEmail($user, $newPassword));

            // Xóa token đã sử dụng
            DB::table('password_resets')->where('email', $user->email)->delete();

            return redirect()->route('user.login')->with('success', 'Mật khẩu đã được đặt lại và gửi về email của bạn');
        } else {
            // Từ chối, xóa token yêu cầu
            DB::table('password_resets')->where('email', $user->email)->delete();

            return redirect()->route('user.login')->with('success', 'Yêu cầu đặt lại mật khẩu đã bị từ chối');
        }
    }

    public function getSupport(){

        return view("user.support");
    }

    public function getHelp(){

        return view("user.help");
    }

    public function getAdvice(){

        // Lấy tất cả thông tin chuyên gia từ bảng 'experts'
        $experts = DB::table('experts')->get();

        return view("user.advice", compact('experts'));
    }

    public function getExpertInfo(Request $request, $id)
    {
        // Lấy tất cả thông tin chuyên gia từ bảng 'experts'
        $experts = Expert::all();

        if (!$id) {
            return view('user.advice');
        }
        
        // Lấy chuyên gia theo id
        $selectedExpert = Expert::findOrFail($id);

        foreach ($experts as $expert) {
            $dates = explode(', ', $expert->ngayhen); // Chuyển chuỗi thành mảng ngày
    
            foreach ($dates as $key => $dateStr) {
                $date = Carbon::createFromFormat('d/m/Y H:i', $dateStr);
    
                // Kiểm tra nếu ngày đó đã qua thì xoá nó khỏi mảng
                if ($date->isPast()) {
                    unset($dates[$key]);
                }
            }
    
            // Cập nhật lại cột ngayhen với chuỗi đã xoá các ngày đã qua
            $expert->ngayhen = implode(', ', $dates);
            $expert->save();
        }
        
    
        $datas = [
            'experts',
            'selectedExpert',
        ];
    
        return view('user.advice', compact($datas));
    }

    public function appointment(Request $request, $id) {
        
        // Lấy thông tin từ request
        $name = $request->input('name');
        $email = $request->input('email');
        $phone = $request->input('phone');
        $date = $request->input('date');
        $MaTBMT = $request->input('MaTBMT');

        // Tìm gói thầu theo TBMT
        $data = ThongBaoMoiThau::where('MaTBMT', $MaTBMT)->first();

        if (!$data) {
            // Xử lý khi không tìm thấy ThongBaoMoiThau
            
            return redirect()->back()->with('error', 'Không tìm thấy thông báo mới thầu với Mã TBMT đã cung cấp.');
        }else{
            // Lấy thông tin chuyên gia
            $selectedExpert = Expert::findOrFail($id);
            
            //Lấy cột ngayhen
            $dates = explode(', ', $selectedExpert->ngayhen);
            //Tìm ngày vừa đặt lịch
            $key = array_search($date, $dates);
            //Xoá ngày vừa đặt lịch
            unset($dates[$key]);

            // Cập nhật lại chuỗi ngày
            $selectedExpert->ngayhen = implode(', ', $dates);
            // Cập nhật cột appointment_bids
            $selectedExpert->appointment_bids += 1;
            $selectedExpert->save();

            $chiphi = $data->GiaGoiThau;
            // Loại bỏ dấu chấm và chuyển đổi thành số hợp lệ
            $chiphi = str_replace('.', '', $chiphi);
            $chiphi = (float) $chiphi;
            $chiphi = $chiphi *0.01;
            
            // Kiểm tra giới hạn của chiphi
            if ($chiphi < 1000000) {
                $chiphi = 1000000;
            } elseif ($chiphi > 50000000) {
                $chiphi = 50000000;
            }

            // Lưu thông tin hẹn đã đặt vào bảng 'appointments'
            Appointment::create([
                'user_id' => auth()->id(),  // Lấy ID của user đang đăng nhập
                'MaTBMT' => $MaTBMT,
                'TenGoiThau' => $data->TenGoiThau,
                'GiaGoiThau' => $data->GiaGoiThau,
                'TenChuyenGia' => $selectedExpert->name,
                'Email' => $selectedExpert->email,
                'NgayHen' => $date,
                'ChiPhi' => $chiphi
            ]);
        }
        

        // Trả về thông báo và redirect
        return redirect()->back()->with('success', 'Đã đăng ký lịch hẹn thành công! Chuyên gia sẽ phản hồi trong vòng từ 3-5 ngày, hãy theo dõi email của bạn để cập nhật địa điểm hẹn!');
    }

    public function getProfile(){
        $userAppointments = Appointment::where('user_id', auth()->id())->get();
        
        return view("user.profile", compact('userAppointments'));
    }

    public function updateProfile(Request $request){
        $request->validate([
            'email' => 'required|email',
            'name' => 'required|string|max:255',
            'password' => 'required|string|min:8',
        ]);
    
        $user = User::where('email', $request->email)->first();
    
        if (!$user) {
            return redirect()->back()->with('error', 'Không tìm thấy user với email này.');
        }
    
        $user->name = $request->name;
        $user->password = Hash::make($request->password);
        $user->save();
    
        return redirect()->back()->with('success', 'Thông tin đã được cập nhật thành công.');
    }

    public function cancelAppointment($id)
    {
        $appointment = Appointment::findOrFail($id);

        // Lấy thông tin chuyên gia dựa trên Email của Appointment
        $expert = $appointment->expert;

        
        if (!$expert) {
            return redirect()->back()->with('expert-error', 'Không tìm thấy thông tin chuyên gia.');
        }

        // Lấy thông tin ngày hẹn cần huỷ
        $cancelDate = $appointment->NgayHen;

        // Xoá bản ghi hẹn
        $appointment->delete();

        // Thêm lại ngày hẹn vào chuỗi ngày hẹn của chuyên gia và sắp xếp
        $expert->ngayhen .= ', ' . $cancelDate;
        $dates = explode(', ', $expert->ngayhen);
        rsort($dates, SORT_STRING);
        $expert->ngayhen = implode(', ', $dates);
        $expert->save();

        // Giảm số lượng hẹn của chuyên gia
        $expert->appointment_bids -= 1;
        $expert->save();

        return redirect()->back()->with('expert-success', 'Đã huỷ hẹn thành công!');
    }
    
}
