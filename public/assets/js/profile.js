function toggleEdit(nameId, passwordId) {
    const nameElement = document.getElementById(nameId);
    const passwordElement = document.getElementById(passwordId);

    if (nameElement.readOnly) {
        nameElement.readOnly = false;
        passwordElement.readOnly = false;

        const buttonGroup = document.getElementById('buttonGroup');
        buttonGroup.innerHTML = `
            <label class="col-sm-3 control-label"></label>
            <div class="col-sm-9">
                <button class="btn-info" onclick="saveChanges()">Lưu</button>
                <button class="btn-info" onclick="cancelEdit('${nameId}', '${passwordId}')">Huỷ</button>
            </div>
        `;
    }
}

function saveChanges() {
    const confirmed = confirm("Bạn có chắc chắn muốn lưu thay đổi?");
    if (confirmed) {
        // Thực hiện gửi form để cập nhật thông tin
        document.getElementById('updateInfo').submit();
    }
}

function cancelEdit(nameId, passwordId) {
    const nameElement = document.getElementById(nameId);
    const passwordElement = document.getElementById(passwordId);
    nameElement.readOnly = true;
    passwordElement.readOnly = true;

    const buttonGroup = document.getElementById('buttonGroup');
    buttonGroup.innerHTML = `
        <label class="col-sm-3 control-label"></label>
        <div class="col-sm-9">
            <button class="btn-info" onclick="toggleEdit('${nameId}', '${passwordId}')">Sửa thông tin</button>
        </div>
        `;
}