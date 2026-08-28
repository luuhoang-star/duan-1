<div class="container my-5 py-3">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card shadow border-0 rounded-4 p-4 p-sm-5 bg-white">
                <div class="text-center mb-4">
                    <h3 class="fw-bold text-primary">Đăng nhập</h3>
                    <p class="text-muted small">Chào mừng bạn quay trở lại với <strong>8 Football</strong></p>
                </div>

                <form action="?act=login" method="POST">
                    <div class="mb-3">
                        <label for="email" class="form-label fw-bold">Địa chỉ Email</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light"><i class="fa-solid fa-envelope text-muted"></i></span>
                            <input type="email" class="form-control" id="email" name="email" placeholder="example@gmail.com" required>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label fw-bold">Mật khẩu</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light"><i class="fa-solid fa-lock text-muted"></i></span>
                            <input type="password" class="form-control" name="password" id="password" placeholder="Nhập mật khẩu của bạn" required>
                        </div>
                    </div>

                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="rememberMe">
                            <label class="form-check-label small" for="rememberMe">Ghi nhớ</label>
                        </div>
                        <a href="?act=register" class="small text-decoration-none">Chưa có tài khoản?</a>
                    </div>

                    <button type="submit" name="submit" class="btn btn-primary w-100 py-2 fw-bold shadow-sm rounded-pill">
                        <i class="fa-solid fa-right-to-bracket me-2"></i>Đăng nhập
                    </button>

                    <div class="text-center mt-4">
                        <span class="text-muted small">Bạn chưa có tài khoản? </span>
                        <a href="?act=register" class="fw-bold text-decoration-none">Đăng ký ngay</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>