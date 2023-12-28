function toggleEdit(userId) {
    // Hiển thị input và ẩn span tương ứng
    document.getElementById('name' + userId).style.display = 'none';
    document.getElementById('nameInput' + userId).style.display = 'inline-block';

    // document.getElementById('email' + userId).style.display = 'none';
    // document.getElementById('emailInput' + userId).style.display = 'inline-block';

    document.getElementById('role' + userId).style.display = 'none';
    document.getElementById('roleInput' + userId).style.display = 'inline-block';

    // Hiển thị nút "Lưu" và "Thoát", ẩn nút "Sửa" và "Xoá"
    document.getElementById('editBtn' + userId).style.display = 'none';
    document.getElementById('cancelBtn' + userId).style.display = 'inline-block';
    document.getElementById('saveBtn' + userId).style.display = 'inline-block';
    document.getElementById('confirmDeleteBtn' + userId).style.display = 'none';
}

function cancelEdit(userId) {
    // Ẩn input và hiển thị span tương ứng
    document.getElementById('name' + userId).style.display = 'inline-block';
    document.getElementById('nameInput' + userId).style.display = 'none';

    // document.getElementById('email' + userId).style.display = 'inline-block';
    // document.getElementById('emailInput' + userId).style.display = 'none';

    document.getElementById('role' + userId).style.display = 'inline-block';
    document.getElementById('roleInput' + userId).style.display = 'none';

    // Hiển thị nút "Sửa" và "Xoá", ẩn nút "Lưu" và "Thoát"
    document.getElementById('editBtn' + userId).style.display = 'inline-block';
    document.getElementById('cancelBtn' + userId).style.display = 'none';
    document.getElementById('saveBtn' + userId).style.display = 'none';
    document.getElementById('confirmDeleteBtn' + userId).style.display = 'inline-block';
}

function saveChanges(userId) {
    const confirmed = confirm("Bạn có chắc chắn muốn lưu thay đổi?");
    if (confirmed) {
        // Thực hiện gửi form để cập nhật thông tin
        document.getElementById('updateInfo' + userId).submit();
    }

    // Ẩn input và hiển thị span tương ứng
    document.getElementById('name' + userId).style.display = 'inline-block';
    document.getElementById('nameInput' + userId).style.display = 'none';

    // document.getElementById('email' + userId).style.display = 'inline-block';
    // document.getElementById('emailInput' + userId).style.display = 'none';

    document.getElementById('role' + userId).style.display = 'inline-block';
    document.getElementById('roleInput' + userId).style.display = 'none';

    // Hiển thị nút "Sửa" và "Xoá", ẩn nút "Lưu" và "Thoát"
    document.getElementById('editBtn' + userId).style.display = 'inline-block';
    document.getElementById('cancelBtn' + userId).style.display = 'none';
    document.getElementById('saveBtn' + userId).style.display = 'none';
    document.getElementById('confirmDeleteBtn' + userId).style.display = 'inline-block';
}

