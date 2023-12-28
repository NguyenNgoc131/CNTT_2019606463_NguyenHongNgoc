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
<!-- Nội dung email với mật khẩu mới -->
<p>Xin chào {{ $user->name }},</p>
<p>Dưới đây là mật khẩu mới của bạn:</p>
<p><strong>{{ $newPassword }}</strong></p>
<p>Vui lòng đăng nhập bằng mật khẩu mới này. Đừng quên thay đổi mật khẩu sau khi đăng nhập.</p>
