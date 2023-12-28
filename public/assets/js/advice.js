function confirmAppointment() {
    if (validateForm()) { // Kiểm tra form trước khi hiển thị hộp thoại xác nhận
        if (confirm('Bạn có chắc chắn muốn đặt lịch không?')) {
            document.getElementById('appointmentForm').submit();
        } else {
            return false;
        }
    } else {
        return false;
    }
}

function validateForm() {
    var name = document.getElementById('name').value;
    var email = document.getElementById('email').value;
    var phone = document.getElementById('phone').value;
    var date = document.getElementById('date').value;

    if (name.trim() === '' || email.trim() === '' || phone.trim() === '' || date.trim() === '') {
        alert('Kiểm tra lại thông tin đăng ký');
        return false; // Dừng việc gửi form
    }
    return true; // Cho phép gửi form
}