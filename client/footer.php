    <footer class="footer bg-dark text-light pt-5 pb-3 mt-5">
        <div class="container">
            <div class="row g-4">
                <div class="col-lg-3 col-md-6">
                    <img src="https://theme.hstatic.net/200000278317/1000929405/14/logo_medium.png?v=1170" alt="Logo" class="bg-white p-2 rounded mb-3" style="max-width: 150px;">
                    <h5 class="fw-bold text-white">8 Football Store</h5>
                    <p class="small text-muted mb-1"><i class="fa-solid fa-phone me-2"></i>Điện thoại: 0339381785</p>
                    <p class="small text-muted mb-1"><i class="fa-solid fa-envelope me-2"></i>Email: hotro@8football.vn</p>
                    <p class="small text-muted"><i class="fa-solid fa-location-dot me-2"></i>Phố Trịnh Văn Bô, Nam Từ Liêm, Hà Nội</p>
                </div>

                <div class="col-lg-3 col-md-6">
                    <h5 class="fw-bold text-white mb-3">Về chúng tôi</h5>
                    <ul class="list-unstyled">
                        <li class="mb-2"><a href="index.php" class="text-muted text-decoration-none small">Trang chủ</a></li>
                        <li class="mb-2"><a href="index.php?act=all-product" class="text-muted text-decoration-none small">Tất cả sản phẩm</a></li>
                        <li class="mb-2"><a href="index.php?act=khach-hang" class="text-muted text-decoration-none small">Khách hàng tiêu biểu</a></li>
                        <li class="mb-2"><a href="#" class="text-muted text-decoration-none small">Chính sách bảo mật</a></li>
                    </ul>
                </div>

                <div class="col-lg-3 col-md-6">
                    <h5 class="fw-bold text-white mb-3">Kết nối với chúng tôi</h5>
                    <div class="d-flex flex-column gap-2">
                        <a href="#" class="text-muted text-decoration-none small"><i class="fa-brands fa-square-facebook text-primary me-2 fs-5"></i> Facebook</a>
                        <a href="#" class="text-muted text-decoration-none small"><i class="fa-brands fa-youtube text-danger me-2 fs-5"></i> Youtube</a>
                        <a href="#" class="text-muted text-decoration-none small"><i class="fa-brands fa-tiktok text-white me-2 fs-5"></i> TikTok</a>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6">
                    <h5 class="fw-bold text-white mb-3">Nhận thông báo ưu đãi</h5>
                    <p class="small text-muted">Đăng ký email để nhận thông tin khuyến mãi mới nhất từ 8 Football.</p>
                    <form onsubmit="event.preventDefault(); alert('Cảm ơn bạn đã đăng ký nhận tin!');">
                        <div class="input-group">
                            <input type="email" class="form-control form-control-sm" placeholder="Nhập email của bạn..." required>
                            <button class="btn btn-primary btn-sm" type="submit">Đăng ký</button>
                        </div>
                    </form>
                </div>
            </div>

            <hr class="border-secondary my-4">
            <div class="text-center small text-muted">
                &copy; <?= date('Y') ?> 8 Football. Tất cả các quyền được bảo lưu.
            </div>
        </div>
    </footer>

    <!-- Bootstrap 5 JS & jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>