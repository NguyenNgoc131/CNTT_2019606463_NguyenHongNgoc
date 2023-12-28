<!-- Nội dung email xác nhận đặt lại mật khẩu -->
@if (session('success'))
<div class="alert alert-success" role="alert">
    {{ session('success') }}
</div>
@endif

@if (session('error'))
<div class="alert alert-danger" role="alert">
    {{ session('error') }}
</div>
@endif
<p>Xin chào {{ $user->name }},</p>
<p>Chúng tôi nhận được yêu cầu đặt lại mật khẩu cho tài khoản của bạn.</p>
<p>Nếu bạn đồng ý đặt lại mật khẩu, vui lòng nhấn vào liên kết bên dưới:</p>
<a href="{{ route('user.getPasswordResetConfirm', ['token' => $token]) }}">Xác nhận đặt lại mật khẩu</a>
<p>Nếu bạn không thực hiện yêu cầu này, bạn có thể bỏ qua email này.</p>

