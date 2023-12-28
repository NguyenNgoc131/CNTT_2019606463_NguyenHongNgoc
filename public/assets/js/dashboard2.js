// ======== Hiển thị ngày hiện tại ========
// Tạo một đối tượng Date để lấy ngày hiện tại
var today = new Date();

// Lấy thông tin ngày, tháng và năm
var day = today.getDate();
var month = today.getMonth() + 1; // Tháng trong JavaScript bắt đầu từ 0
var year = today.getFullYear();

// Tạo một chuỗi chứa ngày hiện tại
var formattedDate = day + "-" + month + "-" + year;

// Lấy phần tử có lớp là "currentDate" và điền ngày hiện tại vào nó
var currentDateElements = document.querySelectorAll(".currentDate");
// Duyệt qua mảng phần tử và điền ngày hiện tại vào từng phần tử
for (var i = 0; i < currentDateElements.length; i++) {
    currentDateElements[i].textContent = formattedDate;
}



// ======== Phân trang ========
// Gán giá trị cho dropdown option
document.getElementById("pageSizeSelect").value = pageSizeFromSession;

document.getElementById("pageSizeSelect").addEventListener("change", function () {
    // Lấy giá trị được chọn
    var pageSize = this.value;

    // Lưu giá trị 'pageSize' vào session
    fetch('/save-page-size', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
        },
        body: JSON.stringify({ pageSize: pageSize }),
    });

    // Chuyển trang và truyền tham số số lượng dòng trên mỗi trang
    window.location.href = "?pageSize=" + pageSize;
});




