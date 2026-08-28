<div class="container my-5 py-3">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card shadow border-0 rounded-4 p-4 p-sm-5 bg-white">
                <div class="text-center mb-4">
                    <h3 class="fw-bold text-primary">Quên mật khẩu</h3>
                    <p class="text-muted small">Nhập địa chỉ email đăng ký để nhận hướng dẫn khôi phục mật khẩu</p>
                </div>

                <form onsubmit="event.preventDefault(); alert('Liên kết đặt lại mật khẩu đã được gửi đến email của bạn nếu tài khoản tồn tại.'); window.location.href='?act=login';">
                    <div class="mb-4">
                        <label for="reset_email" class="form-label fw-bold">Địa chỉ Email</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light"><i class="fa-solid fa-envelope text-muted"></i></span>
                            <input type="email" class="form-control" id="reset_email" name="reset_email" placeholder="example@gmail.com" required>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary w-100 py-2 fw-bold shadow-sm rounded-pill mb-3">
                        Gửi liên kết khôi phục
                    </button>

                    <div class="text-center">
                        <a href="?act=login" class="small text-decoration-none"><i class="fa-solid fa-arrow-left me-1"></i> Quay lại đăng nhập</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
