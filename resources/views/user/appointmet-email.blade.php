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
<p>Xin chào chuyên gia,</p>
<p>Khách hàng {{ $user->name }} đã hẹn lịch tư vấn với bạn</p>
