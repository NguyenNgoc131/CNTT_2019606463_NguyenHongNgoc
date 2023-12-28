<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Controller;
use App\Http\Controllers\AdminController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::prefix('admin')->group(function () {

    # User
    Route::get('index', [AdminController::class, 'getIndex'])->name('admin.getIndex');
    // Sửa
    Route::post('update/{id}', [AdminController::class, 'update'])->name('admin.update');
    // Xoá
    Route::post('delete/{id}', [AdminController::class, 'deleteUser'])->name('admin.delete');

    # Chuyên gia
    Route::get('experts', [AdminController::class, 'getExperts'])->name('admin.getExperts');
    // Xoá chuyên gia
    Route::post('deleteExpert/{id}', [AdminController::class, 'deleteExpert'])->name('admin.deleteExpert');
    // Thêm chuyên gia
    Route::post('experts/add', [AdminController::class, 'addExpert'])->name('admin.addExpert');

    # Lĩnh vực
    Route::get('linhvuc', [AdminController::class, 'getLinhVuc'])->name('admin.getLinhVuc');

    # Tỉnh thành
    Route::get('city', [AdminController::class, 'getCity'])->name('admin.getCity');
});


// Trang chủ
Route::get('/', [Controller::class, 'getDashboard'])->name('user.getDashboard');

Route::prefix('user')->group(function () {


    // Đăng nhập
    Route::get('login', [Controller::class, 'getLogin'])->name('user.getLogin');
    Route::post('login', [Controller::class, 'login'])->name('user.login');

    // Đăng xuất
    Route::get('logout', [Controller::class, 'getLogout'])->name('user.getLogout');

    // Đăng ký
    Route::get('register', [Controller::class, 'getSignup'])->name('user.getSignup');
    Route::post('register', [Controller::class, 'register'])->name('user.register');

    // Xác nhận email
    Route::get('verify', [Controller::class, 'getVerify'])->name('user.getVerify');
    Route::post('verify', [Controller::class, 'verify'])->name('user.verify');

    // Cập nhật thông tin tài khoản sau khi xác nhận email
    Route::get('update-info/{token}', [Controller::class, 'updateInfo'])->name('user.updateInfo');

    // Quên mật khẩu
    Route::get('password-forget', [Controller::class, 'getPasswordForget'])->name('user.getPasswordForget');
    Route::post('password-reset-request', [Controller::class, 'postPasswordResetRequest'])->name('user.postPasswordResetRequest');

    // Xác nhận đặt lại mật khẩu
    Route::get('password-reset-confirm/{token}', [Controller::class, 'getPasswordResetConfirm'])->name('user.getPasswordResetConfirm');
    Route::post('password-reset-confirm', [Controller::class, 'postPasswordResetConfirm'])->name('user.postPasswordResetConfirm');

    // User
    Route::get('profile', [Controller::class, 'getProfile'])->name('user.getProfile');
    Route::post('profile', [Controller::class, 'updateProfile'])->name('user.profile');

    // Giới thiệu
    Route::get('help', [Controller::class, 'getHelp'])->name('user.getHelp');

    // Hỏi đáp
    Route::get('faq', [Controller::class, 'getSupport'])->name('user.getSupport');

    // Tư vấn advice
    Route::get('advice', [Controller::class, 'getAdvice'])->name('user.getAdvice');
    // Thông tin chuyên gia
    Route::get('expert/{id}', [Controller::class, 'getExpertInfo'])->name('user.getExpertInfo');
    // Đặt lịch
    Route::post('expert/{id}', [Controller::class, 'appointment'])->name('user.appointment');
    // Huỷ hẹn
    Route::post('profile/appointments/{id}/cancel', [Controller::class, 'cancelAppointment'])->name('user.cancelAppointment');

});




