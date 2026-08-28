<div class="container my-5 py-3">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card shadow border-0 rounded-4 p-4 p-sm-5 bg-white">
                <div class="text-center mb-4">
                    <h3 class="fw-bold text-primary">Tạo tài khoản mới</h3>
                    <p class="text-muted small">Trở thành thành viên của <strong>8 Football</strong> ngay hôm nay</p>
                </div>

                <form action="?act=register" method="POST" onsubmit="return validateRegisterForm()">
                    <div class="mb-3">
                        <label for="name" class="form-label fw-bold">Họ và tên <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <span class="input-group-text bg-light"><i class="fa-solid fa-user text-muted"></i></span>
                            <input type="text" class="form-control" name="name" id="name" placeholder="Nguyễn Văn A" required>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label fw-bold">Địa chỉ Email <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <span class="input-group-text bg-light"><i class="fa-solid fa-envelope text-muted"></i></span>
                            <input type="email" class="form-control" id="email" name="email" placeholder="example@gmail.com" required>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label for="password" class="form-label fw-bold">Mật khẩu <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <span class="input-group-text bg-light"><i class="fa-solid fa-lock text-muted"></i></span>
                            <input type="password" class="form-control" name="password" id="password" placeholder="Tối thiểu 6 ký tự" required minlength="6">
                        </div>
                    </div>

                    <button type="submit" name="btn-register" class="btn btn-success w-100 py-2 fw-bold shadow-sm rounded-pill">
                        <i class="fa-solid fa-user-plus me-2"></i>Đăng ký tài khoản
                    </button>

                    <div class="text-center mt-4">
                        <span class="text-muted small">Đã có tài khoản? </span>
                        <a href="?act=login" class="fw-bold text-decoration-none">Đăng nhập</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
function validateRegisterForm() {
    var name = document.getElementById("name").value.trim();
    var email = document.getElementById("email").value.trim();
    var password = document.getElementById("password").value;

    if (name === "") {
        alert("Họ và tên không được để trống!");
        return false;
    }
    if (email === "") {
        alert("Email không được để trống!");
        return false;
    }
    if (password.length < 6) {
        alert("Mật khẩu phải từ 6 ký tự trở lên!");
        return false;
    }
    return true;
}
</script>
