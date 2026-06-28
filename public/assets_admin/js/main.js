// public/admin/js/main.js

document.addEventListener("DOMContentLoaded", function () {
    
    // 1. Chức năng Toggle (Đóng/Mở) Sidebar
    const toggleBtn = document.getElementById("menu-toggle");
    const sidebar = document.getElementById("sidebar");
    const contentArea = document.getElementById("page-content-wrapper");

    if (toggleBtn) {
        toggleBtn.addEventListener("click", function (e) {
            e.preventDefault();
            sidebar.classList.toggle("toggled");
            contentArea.classList.toggle("toggled");
        });
    }

    // 2. Tự động ẩn thông báo thành công (Alert) sau 3 giây để giao diện gọn gàng
    const successAlert = document.getElementById("success-alert");
    if (successAlert) {
        setTimeout(function () {
            // Sử dụng API của Bootstrap 5 để đóng alert mượt mà
            let alertInstance = new bootstrap.Alert(successAlert);
            alertInstance.close();
        }, 3000); // 3000ms = 3 giây
    }

    // 3. Preview hình ảnh khi upload (Dùng chung cho trang Thêm và Sửa sản phẩm)
    const imgUploadInput = document.getElementById("img_upload");
    const imgPreview = document.getElementById("img-preview");

    if (imgUploadInput && imgPreview) {
        imgUploadInput.addEventListener("change", function (evt) {
            const [file] = this.files;
            if (file) {
                imgPreview.src = URL.createObjectURL(file);
            }
        });
    }
});